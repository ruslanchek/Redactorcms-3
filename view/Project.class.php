<?php
    Class Project extends Core {
        public function __construct(){
            parent::__construct();

            $this->init();

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
            print 'test';
        }
    };
?>