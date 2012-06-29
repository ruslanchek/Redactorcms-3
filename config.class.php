<?php
    //error_reporting(E_ALL | E_STRICT);
    Class Module{
        private $data;

        public function __construct($id, $name, $title){
            $this->data = array(
                'id'            => $id,
                'name'          => $name,
                'title'         => $title,
                'modes'         => array()
            );
        }

        public function mode($m){
            array_push($this->data['modes'], (array) $m);
        }

        public function getData(){
            return $this->data;
        }
    }


    Class Section{
        private $data;

        public function __construct($name, $title, $group_name){
            $this->data = array(
                'name'          => $name,
                'title'         => $title,
                'group_name'    => $group_name,
                'fields'        => array()
            );
        }

        public function field($f){
            array_push($this->data['fields'], (array) $f);
        }

        public function getData(){
            return $this->data;
        }
    }


    Class Group{
        private $data;

        public function __construct($name, $title){
            $this->data = array(
                'name'          => $name,
                'title'         => $title
            );

            $this->getData();
        }

        public function getData(){
            return $this->data;
        }
    }


    Class Config{
        public
            $modules,
            $sections,
            $groups;

        //DB params
        public $db_vars = array(
            'host'  => 'localhost',
            'db'    => 'rdclite',
            'user'  => 'root',
            'pass'  => ''
        );

        public function __construct(){
            /*******************************************************************************
             * Modules
            */

            //Pages
            $mo = new Module(1, 'pages', 'Страницы');

            $md             = new stdClass();
            $md->id         = 1;
            $md->title      = 'HTML-страница';
            $md->action     = 'pages';
            $md->template   = 'page.simple.tpl';
            $mo->mode($md);

            $this->modules[] = $mo->getData();


            //Menu
            $mo = new Module(2, 'menu', 'Меню');

            $md             = new stdClass();
            $md->id         = 1;
            $md->title      = 'Одноуровневое';
            $md->action     = 'menu';
            $md->template   = 'menu.one_level.tpl';
            $mo->mode($md);

            $md             = new stdClass();
            $md->id         = 2;
            $md->title      = 'Многоуровневое';
            $md->action     = 'menu';
            $md->template   = 'menu.multi_level.tpl';
            $mo->mode($md);

            $this->modules[] = $mo->getData();


            /*******************************************************************************
             * Groups
            */
            $g = new Group('structure', 'Структура');
            $this->groups[] = $g->getData();

            $g = new Group('publications', 'Публикации');
            $this->groups[] = $g->getData();

            $g = new Group('catalog', 'Каталог');
            $this->groups[] = $g->getData();


            /*******************************************************************************
             * Sections
            */
            //Pages
            $s = new Section('pages', 'Страницы', 'structure');

            $f              = new stdClass();
            $f->name        = 'id';
            $f->label       = 'Код';
            $f->type        = 'hidden';
            $f->list        = true;
            $f->width       = '1%';
            $f->align       = 'center';
            $s->field($f);


            $f              = new stdClass();
            $f->name        = 'name';
            $f->label       = 'Название';
            $f->type        = 'text';
            $f->list        = true;
            $f->link        = true;
            $f->width       = '98%';
            $f->align       = 'left';
            $f->validate    = array(
                                array(
                                    'method'    => 'required',
                                    'message'   => 'Заполните название'
                                )
                              );
            $s->field($f);


            $f              = new stdClass();
            $f->name        = 'publish';
            $f->label       = 'Публиковать';
            $f->type        = 'checkbox';
            $f->list        = true;
            $f->link        = true;
            $f->width       = '1%';
            $f->align       = 'center';
            $s->field($f);


            $this->sections[] = $s->getData();

            //Menu
            $s = new Section('menu', 'Меню', 'structure');

            $f              = new stdClass();
            $f->name        = 'id';
            $f->label       = 'Код';
            $f->type        = 'hidden';
            $f->list        = true;
            $f->width       = '1%';
            $f->align       = 'center';
            $s->field($f);


            $f              = new stdClass();
            $f->name        = 'name';
            $f->label       = 'Название';
            $f->type        = 'text';
            $f->list        = true;
            $f->link        = true;
            $f->width       = '98%';
            $f->align       = 'left';
            $f->validate    = array(
                                array(
                                    'method'    => 'required',
                                    'message'   => 'Заполните название'
                                )
                              );
            $s->field($f);


            $this->sections[] = $s->getData();
        }

        //Modules
        /*$modules = array(
            array(
                'id'    => 1,
                'name'  => 'pages',
                'title' => 'Страницы',
                'fields'=> array(
                    array(
                        'name'          => 'id',
                        'label'         => 'Код',
                        'type'          => 'hidden',
                        'list'          => true,
                        'width'         => '1%',
                        'align'         => 'center'
                    ),
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
                    ),
                    array(
                        'name'          => 'publish',
                        'label'         => 'Публиковать',
                        'type'          => 'checkbox',
                        'list'          => true,
                        'width'         => '1%',
                        'align'         => 'center'
                    )
                ),
                'modes' => array(
                    array(
                        'id'        => 1,
                        'title'     => 'HTML-страница',
                        'action'    => 'pages',
                        'template'  => 'page.simple.tpl'
                    )
            )),

            array(
                'id'    => 2,
                'name'  => 'menu',
                'title' => 'Меню',
                'modes' => array(
                    array(
                        'id'        => 1,

                        'title'     => 'Одноуровневое',
                        'action'    => 'menu',
                        'template'  => 'menu.one_level.tpl'
                    ),
                    array(
                        'id'        => 2,
                        'title'     => 'Многоуровневое',
                        'action'    => 'menu',
                        'template'  => 'menu.multi_level.tpl'
                    )
            )),

            array(
                'id'    => 3,
                'name'  => 'news',
                'title' => 'Новости',
                'modes' => array(
                    array(
                        'id'        => 2,
                        'title'     => 'Линейка',
                        'action'    => 'news',
                        'template'  => 'news.section_items.tpl'
                    ),
                    array(
                        'id'        => 1,
                        'title'     => 'Список линеек',
                        'action'    => false,
                        'template'  => 'news.sections.tpl'
                    )
            )),

            array(
                'id'    => 4,
                'name'  => 'gallery',
                'title' => 'Галерея',
                'modes' => array(
                    array(
                        'id'        => 1,
                        'title'     => 'Вся галерея',
                        'action'    => false,
                        'template'  => 'gallery.full.tpl'
                    ),
                    array(
                        'id'        => 2,
                        'title'     => 'Альбом',
                        'action'    => 'albums',
                        'template'  => 'gallery.album.tpl'
                    ),
                    array(
                        'id'        => 3,
                        'title'     => 'Случайная фотография',
                        'action'    => false,
                        'template'  => 'gallery.random_photo.tpl'
                    )
            )),

            array(
                'id'    => 5,
                'name'  => 'catalog',
                'title' => 'Каталог',
                'modes' => array(
                    array(
                        'id'        => 1,
                        'title'     => 'Список содержимого категории',
                        'action'    => 'categories',
                        'template'  => 'catalog.category_items.tpl'
                    ),
                    array(
                        'id'        => 2,
                        'title'     => 'Список категорий',
                        'action'    => false,
                        'template'  => 'catalog.categories.tpl'
                    )
            ))
        );*/
    };
?>