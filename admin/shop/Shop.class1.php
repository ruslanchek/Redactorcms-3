<?php
    Class Shop extends Core {
        public function __construct(){
            $this->init(array(
                'name' => 'shop'
            ));

            if(isset($_GET['option'])){
                switch($_GET['option']){
                    case 'test' : ; break;
                    default     : ; break;
                };
            };
        }

        public function __destruct(){
            $this->deInit();
        }

        /* Основные действия */
        
    };
?>