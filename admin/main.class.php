<?php
    Class Main extends Core {
        public function __construct(){
            $this->init(array(
                'name' => 'main'
            ));

            if($this->ajax_mode){
                switch($this->ajax_action){
                    case 'test' : $this->ajaxTest(); break;
                };
            };
        }

        public function __destruct(){
            $this->deInit();
        }

        protected function ajaxTest(){
            
        }
    };
?>