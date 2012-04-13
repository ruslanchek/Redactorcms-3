<?php
	class TableModel extends Core {
        private $dataset;

        public function __construct(){
            parent::__construct();
        }

        public function setData($dataset){
            $this->dataset = $dataset;
        }

        public function getCols(){
            $result = array();

            foreach($this->dataset->cols as $key => $value){
                if($value[$key]['list']){
                    $result[] = array('name' => $key, 'data' => $value[$key]);
                };
            };

            return $result;
        }

        public function getList(){
            $cols = '';

            foreach($this->dataset->cols as $key => $value){
                $cols .= "`{$this->db->quote($this->db->quote($key))}`, ";
            };

            $cols = substr($cols, 0, strlen($cols) - 2);

            $query = "
                SELECT
                    {$cols}
                FROM
                    `{$this->db->quote($this->dataset->table)}`
            ";

            return $this->db->assocMulti($query);
        }
    }
?>