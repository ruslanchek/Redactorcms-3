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
        public function add($name, $params){
            $this->dataset->cols[$name] = array($name => $params);
        }
    }
?>