<?php
    Class Pages extends Core {
        protected $dataset;

        public function __construct(){
            parent::__construct();

            $this->init(array(
                'name'  => 'pages',
                'title' => 'Страницы'
            ));

            $this->dataset = $this->dsmdl->create('pages');
            $this->dsmdl->add(
                array(
                    'name'          => 'id',
                    'label'         => 'Код',
                    'type'          => 'hidden',
                    'list'          => true,
                    'width'         => '1%',
                    'align'         => 'center'
                )
            );

            $this->dsmdl->add(
                array(
                    'name'          => 'name',
                    'label'         => 'Название',
                    'type'          => 'text',
                    'list'          => true,
                    'link'          => true,
                    'width'         => '98%',
                    'align'         => 'left',
                    'validate'      => array(
                        array(
                            'method' => 'required',
                            'message' => 'Заполните название'
                        )
                    )
                )
            );

            $this->dsmdl->add(
                array(
                    'name'          => 'publish',
                    'label'         => 'Публиковать',
                    'type'          => 'checkbox',
                    'list'          => true,
                    'width'         => '1%',
                    'align'         => 'center'
                )
            );

            if(!isset($_GET['item_id'])){
                $this->tmdl->setData($this->dataset);
                $this->smarty->assign('list', $this->tmdl->getList());
                $this->smarty->assign('cols', $this->tmdl->getCols());
                $this->module['h1'] = 'Страницы';
            }else{
                $this->dsmdl->fillItemData($_GET['item_id']);
                $this->module['h1'] = '<a href="/admin/pages/">Страницы</a> &rarr; Редактирование страницы';
            };

            if($this->ajax_mode){
                switch($_GET['action']){
                    case 'getItemFieldsAndData' : {
                        header('Content-type: application/json');
                        print json_encode($this->dataset);
                    }; break;
                };
            };
        }

        public function __destruct(){
            $this->deInit();
        }
    };
?>