<?php
	class DatasetModel extends Core {
        private $dataset;

        public function __construct(){
            parent::__construct();
        }

        public function get(){
            return $this->dataset;
        }

        public function create($table){
            $this->dataset = new stdClass();
            $this->dataset->table = $table;
            $this->dataset->cols = array();

            return $this->get();
        }

        /*
         * @param string $name имя столбца mysql
         * @param array $params параметры столбца
         * */
        public function add($item){
            $this->dataset->cols[] = $item;
        }

        public function fillItemData($id){
            $query = "SELECT ";

            foreach($this->dataset->cols as $item){
                $query .= "`{$this->db->quote($item['name'])}`, ";
            };

            $query = substr($query, 0, strlen($query)-2);
            $query .= " FROM `{$this->db->quote($this->dataset->table)}` WHERE `id` = {intval($id)}";

            $data = $this->db->assocItem($query);

            for($i = 0, $l = count($this->dataset->cols); $i < $l; $i++){
                foreach($data as $key => $value){
                    if($this->dataset->cols[$i]['name'] == $key){
                        $this->dataset->cols[$i]['value'] = $value;
                    };
                }
            };
        }
    }
?>