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

        public function getMenuInline($menu_id, $parent_id){

        }

        public function getMenuTree($menu_id, $parent_id){
            if($parent_id > 0){
                $where = "`structure`.`pid` = ".intval($parent_id)." && ";
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
    };
?>