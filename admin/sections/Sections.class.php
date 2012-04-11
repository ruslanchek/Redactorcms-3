<?php
    Class Sections extends Core {
        public function __construct(){
            parent::__construct();

            $this->init(array(
                'name'  => 'sections',
                'title' => 'Разделы'
            ));
        }

        public function __destruct(){
            $this->deInit();
        }
    };
?>