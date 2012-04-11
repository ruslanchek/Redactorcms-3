<?php
    Class Pages extends Core {
        public function __construct(){
            parent::__construct();

            $this->init(array(
                'name'  => 'pages',
                'title' => 'HTML-страницы'
            ));
        }

        public function __destruct(){
            $this->deInit();
        }
    };
?>