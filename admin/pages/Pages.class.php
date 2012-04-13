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
            $this->dsmdl->add(
                'id',
                array(
                    'label'         => 'Код',
                    'type'          => 'hidden',
                    'list'          => true,
                    'width'         => '1%',
                    'align'         => 'center'
                )
            );

            $this->dsmdl->add(
                'name',
                array(
                    'label'         => 'Название',
                    'type'          => 'text',
                    'list'          => true,
                    'link'          => true,
                    'width'         => '98%',
                    'align'         => 'left'
                )
            );

            $this->dsmdl->add(
                'publish',
                array(
                    'label'         => 'Публиковать',
                    'type'          => 'checkbox',
                    'list'          => true,
                    'width'         => '1%',
                    'align'         => 'center'
                )
            );

            if(isset($_GET['item_id']) && $_GET['item_id'] > 0){

            }else{
                $this->tmdl->setData($this->dataset);
                $this->smarty->assign('list', $this->tmdl->getList());
                $this->smarty->assign('cols', $this->tmdl->getCols());
            };
        }

        public function __destruct(){
            $this->deInit();
        }
    };
?>