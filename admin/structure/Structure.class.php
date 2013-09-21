<?php

    Class Structure extends Core {
        private
            $new_node_prefix = 'Узел',
            $root_node_name = 'Корневой узел';

        public function __construct(){
            parent::__construct();

            $this->template = 'main.tpl';

            $this->init(array(
                'name'  => 'structure',
                'title' => 'Структура'
            ));

            if($this->ajax_mode){
                switch($_GET['action']){

                    case 'get_content_items' : {
                        header('Content-type: application/json');
                        print json_encode($this->getContentItems($_GET['module_action']));
                    }; break;

                    case 'check_part_ajax' : {
                        header('Content-type: application/json');
                        print json_encode($this->checkPartBoolean($_POST['id'], $_POST['pid'], $_POST['value']));
                    }; break;

                    case 'get_templates_list' : {
                        header('Content-type: application/json');
                        print json_encode($this->getTemplatesList());
                    }; break;

                    case 'get_node_data' : {
                        $result = array();
                        $result['node_data']        = $this->getNodeData($_GET['id']);
                        $result['templates']        = $this->getTemplatesList();
                        $result['menues']           = $this->getMenuesList();
                        $result['modules']          = $this->config->modules;
                        $result['blocks_templates'] = $this->getBlockTemplates();
                        $result['domain_name']      = $this->utils->getDomainName();

                        header('Content-type: application/json');
                        print json_encode($result);
                    }; break;

                    case 'set_node_data' : {
                        header('Content-type: application/json');
                        print json_encode($this->setNodeData());
                    }; break;

                    case 'publish' : {
                        $this->updateNode($_GET['id'], array(
                            'publish' => '1'
                        ));
                    }; break;

                    case 'hide' : {
                        $this->updateNode($_GET['id'], array(
                            'publish' => '0'
                        ));
                    }; break;

                    case 'del_child' : {
                        $this->deleteNode($_GET['id']);
                    }; break;

                    case 'add_child' : {
                        print $this->insertNode($_GET['id']);
                    }; break;

                    case 'move' : {
                        $this->moveBranch($_GET['id'], $_GET['pid']);
                    }; break;

                    case 'order' : {
                        $this->orderNodes(json_decode(urldecode($_GET['order']), true), $_GET['parent'], $_GET['id']);

                    }; break;

                    case 'get_tree' : {
                        print json_encode($this->getBranchArray());
                    }; break;

                    case 'get_all_structure_items' : {
                        print json_encode($this->getAllStructureItems());
                    }; break;
                };

                exit;
            };


            /* TODO
                DO NOT UNCOMMENT! THIS IS A DEBUG METHODS,
                IT WILL CLEAN YOUR STRUCTURE COMPLETELY,
                AND CREATE A NEW RANDOM STRUCTURE!

                $this->resetStructure();
                $this->createRandomStructure(15);
            */
        }

        public function __destruct(){
            $this->deInit();
        }

        //Get albums
        private function getContentItems($action){
            $query = "
                SELECT
                    `id`,
                    `name`
                FROM
                    `".$this->db->quote($action)."`
            ";

            return $this->db->assocMulti($query);
        }

        //Get all items
        private function getAllStructureItems(){
            $q = "
                SELECT
                    `structure`.`id`,
                    `structure_data`.`name`
                FROM
                    `structure`,
                    `structure_data`
                WHERE
                    `structure`.`id` = `structure_data`.`id`
                ORDER BY
                    `structure_data`.`sort` ASC
            ";

            return $this->db->assocMulti($q);
        }

        //Create ramdom structure
        private function createRandomStructure($leafs){
            $this->resetStructure();

            $this->insertNode(1);

            $i = 0;
            while($i < $leafs){
                $i++;

                $result = $this->db->getRandomItems('structure', 1, array('id'));

                $this->insertNode($result[0]['id']);
            };
        }

        //Reset structure
        private function resetStructure(){
            $query = "TRUNCATE TABLE `structure`";
            $this->db->query($query);

            $query = "TRUNCATE TABLE `structure_data`";
            $this->db->query($query);

            $this->insertNode(0);
            $this->updateNode(1, array('path' => '/', 'part' => ''));
        }

        //Check for path part existance linear
        private function checkSamePart($id, $part){
            $query = "
                SELECT
                    count(*) AS `count`
                FROM
                    `structure`,
                    `structure_data`
                WHERE
                    `structure`.`id` = `structure_data`.`id` &&
                    `structure`.`pid` = '".intval($id)."' &&
                    `structure_data`.`part` = '".$this->db->quote($part)."'
            ";

            $result = $this->db->assocItem($query);

            if($result['count'] > 0){
                return true;
            }else{
                return false;
            };
        }

        //Check for path part existance linear by AJAX
        public function checkPartBoolean($id, $pid, $part){
             $query = "
                SELECT
                    count(*) AS `count`
                FROM
                    `structure`,
                    `structure_data`
                WHERE
                    `structure`.`pid` = ".intval($pid)." &&
                    `structure`.`id` NOT IN (".intval($id).") &&
                    `structure_data`.`part` = '".$this->db->quote($part)."' &&
                    `structure`.`id` = `structure_data`.`id`
            ";

            $result = $this->db->assocItem($query);

            if($result['count'] > 0){
                return true;
            }else{
                return false;
            };
        }

        //Check for path part existance special
        private function checkPart($id, $part, $mode = false){
            if(!$mode){
                $query = "
                    SELECT
                        `structure`.`pid` AS `pid`
                    FROM
                        `structure`,
                        `structure_data`
                    WHERE
                        `structure`.`id` = '".intval($id)."' &&
                        `structure`.`id` = `structure_data`.`id`
                ";
                $result = $this->db->assocItem($query);

                $query = "
                    SELECT
                        count(*) AS `count`
                    FROM
                        `structure`,
                        `structure_data`
                    WHERE
                        `structure`.`pid` = ".intval($result['pid'])." &&
                        `structure_data`.`part` = '".$this->db->quote($part)."' &&
                        `structure`.`id` != ".intval($id)." &&
                        `structure`.`id` = `structure_data`.`id`
                ";
            }else{
                $query = "
                    SELECT
                        count(*) AS `count`
                    FROM
                        `structure`,
                        `structure_data`
                    WHERE
                        `structure`.`pid` = ".intval($id)." &&
                        `structure_data`.`part` = '".$this->db->quote($part)."' &&
                        `structure`.`id` = `structure_data`.`id`
                ";
            };

            $result = $this->db->assocItem($query);

            if($result['count'] > 0){
                $newpart = $part.'_'.rand();

                while($this->checkSamePart($id, $newpart)){
                    $newpart = $part.'_'.rand();
                };

                return $newpart;
            }else{
                return $part;
            };
        }

        //Returns a full node path
        private function getNodePath($id, $path = false, $part = false){
            $query = "
                SELECT
                    `structure`.`pid`,
                    `structure_data`.`part`
                FROM
                    `structure`,
                    `structure_data`
                WHERE
                    `structure`.`id` = '".intval($id)."' &&
                    `structure`.`id` = `structure_data`.`id`
            ";

            $result = $this->db->assocItem($query);

            if($result['pid'] >= 1){
                $path .= $this->getNodePath($result['pid'], $path);
            }else{
                $path .= '/';
            };

            if($result['pid'] >= 1){
                if($part){
                    $path .= $part.'/';
                }else{
                    $path .= $result['part'].'/';
                };
            };

            return $this->utils->removePathDoubleSlashes($path);
        }

        //Returns a branch array
        private function getChildrens($id){
            $query = "
                SELECT
                    `id`
                FROM
                    `structure`
                WHERE
                    `pid` = ".intval($id)."
            ";

            $sql = $this->db->query($query);
            $result = array();

            while($row = $sql->fetch_assoc()){
                array_push($result, array(
                    'childrens' => $this->getChildrens($row['id']),
                    'node'      => $row
                ));
            };

            $sql->free();
            return $result;
        }

        //Set path to the branch
        private function setPath($id){
            $query = "
                UPDATE
                    `structure_data`
                SET
                    `path` = '".$this->db->quote($this->getNodePath($id))."'
                WHERE
                    `id` = ".intval($id)."
            ";

            $this->db->query($query);
        }

        //Set full path to the branch and all it's childrens
        private function setPathR($id){
            $branch = $this->getChildrens($id);

            if(!empty($branch)){
                foreach($branch as $item){
                    $this->setPath($item['node']['id']);
                    $this->setPathR($item['node']['id']);
                };
            };
        }

        private function getDefaultTemplateId(){
            $query = "
                SELECT
                    `id`
                FROM
                    `templates`
                WHERE
                    `default` = 1
                LIMIT 1
            ";

            $result = $this->db->assocItem($query);

            return $result['id'];
        }

        //Creates a node in the tree, with specified parent
        public function insertNode($pid = 1){
            $query = "
                INSERT INTO `structure`
                    (`pid`)
                VALUES
                    (".intval($pid).")
            ";
            $this->db->query($query);


            $id = $this->db->getMysqlInsertId();

            $query = "
                INSERT INTO `structure_data`
                    (`id`)
                VALUES
                    (".intval($id).")
            ";
            $this->db->query($query);

            $part = $this->checkPart($id, $id);
            $path = $this->getNodePath($id, '', $part);

            if($id > 1 && $pid >= 1){
                $new_item_name = $this->new_node_prefix." ".$id;
            }else{
                $new_item_name = $this->root_node_name;
            };

            $query = "
                SELECT
                    MAX(`structure_data`.`sort`) AS `max_sort`
                FROM
                    `structure`,
                    `structure_data`
                WHERE
                    `structure`.`pid` = ".intval($pid)." &&
                    `structure`.`id` = `structure_data`.`id`
            ";

            $max_sort_item = $this->db->assocItem($query);

            // TODO: Сделать что-то с дефолтами для страницы (возможно настройка через конфиг или просто правильные значения...)
            $defaults = new stdClass();
            $defaults->module           = 1;
            $defaults->module_mode      = 1;
            $defaults->content_id       = 3;
            $defaults->mode_template    = 'page.simple.tpl';

            $query = "
                UPDATE
                    `structure_data`
                SET
                    `part` = '".$this->db->quote($part)."',
                    `path` = '".$this->db->quote($path)."',
                    `name` = '".$this->db->quote($new_item_name)."',
                    `sort` = '".(intval($max_sort_item['max_sort']) + 1)."',
                    `template_id` = " . intval($this->getDefaultTemplateId()) . ",
                    `blocks` = '[]',
                    `main_block` = '" . $this->db->quote(json_encode($defaults)) . "'
                WHERE
                    `id` = ".intval($id);

            $this->db->query($query);

            return $id;
        }

        //Moves a branch to the specified parent
        public function moveBranch($id, $pid){
            if($id != $pid){
                $query = "
                    SELECT
                        `structure_data`.`part` AS `part`,
                        `structure`.`pid` AS `pid`
                    FROM
                        `structure`,
                        `structure_data`
                    WHERE
                        `structure`.`id` = ".intval($id)." &&
                        `structure`.`id` = `structure_data`.`id`
                ";

                $result = $this->db->assocItem($query);

                if($result['pid'] != $pid){
                    $part = $this->checkPart($pid, $result['part'], true);

                    $query = "
                        UPDATE
                            `structure`
                        SET
                            `pid` = ".intval($pid)."
                        WHERE
                            `id` = ".intval($id)."
                    ";
                    $this->db->query($query);

                    $query = "
                        UPDATE
                            `structure_data`
                        SET
                            `part` = '".$this->db->quote($part)."'
                        WHERE
                            `id` = ".intval($id)."
                    ";
                    $this->db->query($query);

                    $this->setPath($id);
                    $this->setPathR($id);
                };
            };
        }

        //Updates a node data
        public function updateNode($id, $data){
            $dataline = '';
            $partupdate = false;

            foreach($data as $key => $value){
                if($key == 'part'){
                    $partupdate = true;
                    $dataline .= " `".$this->db->quote($key)."` = '".$this->db->quote($this->checkPart($id, $value))."',";
                }else{
                    $dataline .= " `".$this->db->quote($key)."` = '".$this->db->quote($value)."',";
                };
            };

            $dataline = substr($dataline, 0, strlen($dataline)-1).' ';

            $query = "
                UPDATE
                    `structure_data`
                SET
                    ".$dataline."
                WHERE
                    `id` = ".intval($id)."
            ";

            $this->db->query($query);

            if($partupdate){
                $this->setPath($id);
                $this->setPathR($id);
            };
        }

        //Deletes a node and all it's childrens
        public function deleteNode($id){
            $branch = $this->getChildrens($id);

            if(!empty($branch)){
                foreach($branch as $item){
                    $this->deleteNode($item['node']['id']);
                };
            };

            $query = "
                DELETE FROM
                    `structure`
                WHERE
                    `id` = ".intval($id)."
            ";
            
            $this->db->query($query);

            $query = "
                DELETE FROM
                    `structure_data`
                WHERE
                    `id` = ".intval($id)."
            ";
            
            $this->db->query($query);
        }

        //Returns array of specified branch
        public function getBranchArray($id = 0){
            if($id > 0){
                $where = "`structure`.`pid` = ".intval($id)." && ";
            }else{
                $where = "`structure`.`id` = 1 && ";
            };

            $query = "
                SELECT
                    `structure`.`id`,
                    `structure_data`.`sort`,
                    `structure_data`.`name`,
                    `structure_data`.`publish`
                FROM
                    `structure`,
                    `structure_data`
                WHERE
                    ".$where."
                    `structure`.`id` = `structure_data`.`id`
                ORDER BY
                    `structure_data`.`sort` ASC
            ";

            $sql = $this->db->query($query);
            $result = array();

            while($row = $sql->fetch_assoc()){
                $row['children'] = $this->getBranchArray($row['id']);
                $result[] = $row;
            };

            $sql->free();
            return $result;
        }

        //Save node data
        private function setNodeData(){
            if($_POST['name'] != ''){
                $name = $_POST['name'];
            }else{
                $name = $this->new_node_prefix.' '.$_POST['id'];
            };

            if($_POST['part'] != ''){
                $part = $this->utils->convertUrl($_POST['part']);
            }else{
                $part = $_POST['id'];
            };

            $this->updateNode($_POST['id'], array(
                'name'              => $name,
                'publish'           => $_POST['publish'],
                'part'              => $part,
                'menu_id'           => $_POST['menu_id'],
                'template_id'       => $_POST['template_id'],
                'blocks'            => urldecode($_POST['blocks']),
                'main_block'        => urldecode($_POST['main_block']),
                'seo_title'         => $_POST['seo_title'],
                'seo_keywords'      => $_POST['seo_keywords'],
                'seo_description'   => $_POST['seo_description']
            ));

            return $this->getNodeData($_POST['id']);
        }

        //Returns item data
		public function getNodeData($id){
			$query = "
			    SELECT
			        `structure`.`id`,
			        `structure`.`pid`,
			        `structure_data`.`name`,
			        `structure_data`.`publish`,
			        `structure_data`.`part`,
			        `structure_data`.`path`,
			        `structure_data`.`sort`,
			        `structure_data`.`menu_id`,
			        `structure_data`.`template_id`,
			        `structure_data`.`blocks`,
			        `structure_data`.`main_block`,
			        `structure_data`.`seo_title`,
			        `structure_data`.`seo_keywords`,
			        `structure_data`.`seo_description`
			    FROM
			        `structure`,
			        `structure_data`
			    WHERE
			        `structure`.`id` = ".intval($id)." &&
			        `structure_data`.`id` = ".intval($id)."
			";

            return $this->db->assocItem($query);
		}

        //Return a tree items count
		public function getTreeCount(){
			$query = "
                SELECT
                    count(*) AS `count`
                FROM
                    `structure`
            ";

            $result = $this->db->assocItem($query);
			return $result[0];
		}

        //Set order to the node
        public function orderNodes($order_items, $parent, $id){
            $this->moveBranch($id, $parent);

            foreach($order_items as $item){
                $this->updateNode($item['id'], array(
					'sort' => $item['sort']
				));
            };
        }

        //Взять список шаблонов
        private function getTemplatesList(){
            $query = "
                SELECT
                    *
                FROM
                    `templates`
            ";

            return $this->db->assocMulti($query);
        }

        //Взять список меню
        private function getMenuesList(){
            $query = "
                SELECT
                    *
                FROM
                    `menu`
            ";

            return $this->db->assocMulti($query);
        }

        public function getBranchClass($main_block_entry){
            $main = json_decode($main_block_entry, true);

            foreach($this->config->modules as $module){
                if($module['id'] == $main['module']){
                    return $module['class'];
                };
            };

            return 'regular';
        }

        private function getBlockTemplates(){
            $results = array();
            $handler = opendir($_SERVER['DOCUMENT_ROOT'].'/templates/blocks/');

            while($file = readdir($handler)){
                if($file != "." && $file != ".." && !is_dir($file) && pathinfo($file, PATHINFO_EXTENSION) == 'tpl'){
                    $results[] = $file;
                };
            };

            closedir($handler);
            return $results;
        }
    };
?>