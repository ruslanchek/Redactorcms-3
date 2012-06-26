<?php
    Class Sections extends Core {
        protected $dataset;

        public function __construct(){
            parent::__construct();

            $this->init(array(
                'name'  => 'sections',
                'title' => 'Разделы'
            ));

            if(isset($_GET['section'])){
                $this->processSection($_GET['section']);
            };
        }

        private function getSection($section){
            foreach($this->config->modules as $module){
                if($section == $module['name']){
                    return $module;
                };
            };
        }

        private function processSection($section){
            $section_data = $this->getSection($section);

            $this->dataset = $this->dsmdl->create($section_data['name']);

            foreach($section_data['fields'] as $field){
                $this->dsmdl->add($field);
            };

            /*$this->dsmdl->add(
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
            );*/

            if(!isset($_GET['item_id'])){
                $this->tmdl->setData($this->dataset);
                $this->smarty->assign('list', $this->tmdl->getList());
                $this->smarty->assign('cols', $this->tmdl->getCols());
            }else{
                $this->dsmdl->fillItemData($_GET['item_id']);
            };

            if($this->ajax_mode){
                switch($_GET['action']){
                    case 'getItemFieldsAndData' : {
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