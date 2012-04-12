<?php
    Class Pages extends Core {
        protected $dataset;

        public function __construct(){
            parent::__construct();

            $this->init(array(
                'name'  => 'pages',
                'title' => 'HTML-страницы'
            ));

            $this->dataset = $this->dsmdl->create('pages');
            $this->dsmdl->add('id',         array('label' => 'Код',         'type' => 'hidden'));
            $this->dsmdl->add('name',       array('label' => 'Название',    'type' => 'text'));
            $this->dsmdl->add('publish',    array('label' => 'Публиковать', 'type' => 'checkbox'));

            $this->getList();
        }

        public function __destruct(){
            $this->deInit();
        }

        public function getList(){
            $this->tmdl->setData($this->dataset);
            print_r($this->tmdl->getList());
        }
    };
?>