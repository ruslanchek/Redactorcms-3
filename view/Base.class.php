<?php
    Class Base extends Core {
        public function __construct(){
            parent::__construct();

            $this->init();
        }

        public function __destruct(){
            $this->deInit();
        }

        /*
         * Base site functionality API
         * */

        //Get menu - list
        public function getMenuInline($menu_id, $parent_id){
            return $this->getStructureBranch($menu_id, $parent_id, false);
        }

        //Get menu - tree
        public function getMenuTree($menu_id, $parent_id){
            return $this->getStructureBranch($menu_id, $parent_id, true);
        }

        //Get branch
        private function getStructureBranch($menu_id, $parent_id, $get_children){
            if(intval($menu_id) > 0 || $menu_id === false){
                if(intval($parent_id) > 0){
                    $where = "`structure`.`pid` = ".intval($parent_id)." && ";
                }else{
                    $where = "`structure`.`id` = 1 && ";
                };

                if($menu_id !== false){
                    $where .= "`structure_data`.`menu_id` = ".intval($menu_id)." && ";
                };

                $query = "
                    SELECT
                        `structure`.`id`,
                        `structure_data`.`sort`,
                        `structure_data`.`name`,
                        `structure_data`.`path`,
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
                    if($get_children){
                        $row['children'] = $this->getMenuTree($menu_id, $row['id']);
                    };
                    $result[] = $row;
                };

                $sql->free();
                return $result;
            }else{
                return 'Ошибка 1283422: неправильный ID меню';
            };
        }

        //Return a breadcrumbs
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

        //Get HTML of the page
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

            return $data->content;
        }
    };
?>