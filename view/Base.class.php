<?php
    Class Base extends Core {
        public function __construct(){
            parent::__construct();
            $this->init();
        }

        public function __destruct(){
            $this->deInit();
        }

        //Get structure branch
        private function getStructureBranch($menu_id, $parent_id, $get_children){
            if(intval($menu_id) > 0 || $menu_id === false){
                if(intval($parent_id) > 0){
                    $where = "`s`.`pid` = " . intval($parent_id) . " && ";
                }else{
                    $where = "`s`.`pid` = 1 && ";
                };

                if($menu_id !== false){
                    $where .= "`sd`.`menu_id` = " . intval($menu_id) . " && ";
                };

                $query = "
                    SELECT
                        `s`.`id`,
                        `sd`.`sort`,
                        `sd`.`name`,
                        `sd`.`path`,
                        `sd`.`publish`
                    FROM
                        `structure` `s`
                    LEFT JOIN
                        `structure_data` `sd`
                    ON
                        `s`.`id` = `sd`.`id`
                    WHERE
                        " . $where . "
                        `sd`.`publish` = 1
                    ORDER BY
                        `sd`.`sort` ASC
                ";

                $sql = $this->db->query($query);
                $result = array();

                while($row = $sql->fetch_assoc()){
                    if($get_children){
                        $row['children'] = $this->getMenuTree($menu_id, $row['id']);
                    };

                    $result[] = (object) $row;
                };

                $sql->free();

                return $result;
            }else{
                return $this->utils->displayError(
                    '2000',
                    'Ошибка вывода меню',
                    'Неверный ID меню'
                );
            };
        }

        private function getParentId($id){
            $query = "
                SELECT
                    `structure`.`pid` AS `pid`
                FROM
                    `structure`
                WHERE
                    `structure`.`id` = ".intval($id);

            $result = (object) $this->db->assocItem($query.intval($id));
            return $result->pid;
        }



        /***************************************************************************************************************
         * Base site functionality API
         **************************************************************************************************************/

        //Get menu - list
        public function getMenu($menu_id, $parent_id){
            return $this->getStructureBranch($menu_id, $parent_id, false);
        }

        //Get menu - tree
        public function getMenuTree($menu_id, $parent_id){
            return $this->getStructureBranch($menu_id, $parent_id, true);
        }

        //Get menu - second level list
        public function getSubMenu($menu_id, $parent_id){
            return $this->getStructureBranch($menu_id, $this->getParentId($parent_id), false);
        }

        //Get a breadcrumbs
        public function getBreadCrumbs($id){
            $query = "
                SELECT
                    `structure`.`pid`               AS `pid`,
                    `structure_data`.`id`           AS `id`,
                    `structure_data`.`name`         AS `name`,
                    `structure_data`.`path`         AS `path`
                FROM
                    `structure`,
                    `structure_data`
                WHERE
                    `structure`.`id` = `structure_data`.`id` &&
                    `structure`.`id` = ";

            $result = $this->db->assocItem($query.intval($id));

            $breadcrumbs = array();
            $result['current'] = true;
            array_push($breadcrumbs, $result);

            $pid = $result['pid'];

            while($pid > 0){
                $result = $this->db->assocItem($query.intval($pid));
                array_push($breadcrumbs, $result);
                $pid = $result['pid'];
            };

            return array_reverse($breadcrumbs);
        }


        //Parse taggets
        public function taggetsParse($str){
            $values = array();

            $tgt = new stdClass();
            $tgt->name = 'DATE';
            $tgt->title = 'Текущая дата';
            $tgt->title = 'Текущая дата';

            $values = array(
                'DATE',
                'TIME',
                'NODE_TITLE',
                'NODE_PATH',
                'SEO_TITLE'
            );

            foreach($values as $key)
            {
                $value = '';

                switch($key){
                    case 'DATE' : {
                        $value = date('d-m-Y');
                    } break;

                    case 'TIME' : {
                        $value = date('H-i-s');
                    } break;

                    case 'NODE_TITLE' : {
                        $value = $this->page->data->name;
                    } break;

                    case 'NODE_PATH' : {
                        $value = $this->page->data->path;
                    } break;

                    case 'SEO_TITLE' : {
                        $value = $this->page->seo->title;
                    } break;

                    default : {
                        $value = '';
                    } break;
                }

                $ttr = "{{$key}}";
                $str = str_replace($ttr, $value, $str);
            }

            return $str;
        }

        //Get HTML of the simple page
        public function getSimplePageContent($id){
            $query = "
                SELECT
                    `content`
                FROM
                    `pages`
                WHERE
                    `id` = ".intval($id)."
            ";

            $data = (object) $this->db->assocItem($query);

            $data->content = $this->taggetsParse($data->content);

            return $data->content;
        }

        //Get news full list
        public function getNewsList($limit){

        }
    };
?>