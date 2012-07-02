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

        public function __construct($id, $name, $title, $group_id){
            $this->data = array(
                'id'            => $id,
                'name'          => $name,
                'title'         => $title,
                'group_id'      => $group_id,
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

        public function __construct($id, $name, $title){
            $this->data = array(
                'id'            => $id,
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
            $md->c_id_label = 'Страница';
            $md->action     = 'pages';
            $md->template   = 'page.simple.tpl';
            $mo->mode($md);

            $this->modules[] = $mo->getData();


            //Navigation
            $mo = new Module(2, 'navigation', 'Навигация');

            $md             = new stdClass();
            $md->id         = 1;
            $md->title      = 'Одноуровневое меню';
            $md->c_id_label = 'Меню';
            $md->action     = 'menu';
            $md->template   = 'navigation.menu.one_level.tpl';
            $mo->mode($md);

            $md             = new stdClass();
            $md->id         = 2;
            $md->title      = 'Древовидное меню';
            $md->c_id_label = 'Меню';
            $md->action     = 'menu';
            $md->template   = 'navigation.menu.multi_level.tpl';
            $mo->mode($md);

            $md             = new stdClass();
            $md->id         = 3;
            $md->title      = 'Меню второго уровня';
            $md->c_id_label = 'Меню';
            $md->action     = 'menu';
            $md->template   = 'navigation.menu.sub_level.tpl';
            $mo->mode($md);

            $md             = new stdClass();
            $md->id         = 4;
            $md->title      = 'Хлебные крошки';
            $md->action     = false;
            $md->template   = 'navigation.breadcrumbs.tpl';
            $mo->mode($md);

            $md             = new stdClass();
            $md->id         = 5;
            $md->title      = 'Карта сайта';
            $md->action     = false;
            $md->template   = 'navigation.sitemap.tpl';
            $mo->mode($md);

            $this->modules[] = $mo->getData();


            //News
            $mo = new Module(3, 'news', 'Новости');

            $md             = new stdClass();
            $md->id         = 1;
            $md->title      = 'Все новости';
            $md->action     = false;
            $md->template   = 'news.news_all_items.tpl';
            $md->options    = array(array('name' => 'limit', 'title' => 'Лимит'));
            $mo->mode($md);

            $md             = new stdClass();
            $md->id         = 2;
            $md->title      = 'Линейка';
            $md->c_id_label = 'Линейка';
            $md->action     = 'news_lines';
            $md->template   = 'news.news_items.tpl';
            $md->options    = array(array('name' => 'limit', 'title' => 'Лимит'));
            $mo->mode($md);

            $md             = new stdClass();
            $md->id         = 3;
            $md->title      = 'Список линеек';
            $md->action     = false;
            $md->template   = 'news.news_lines.tpl';
            $mo->mode($md);

            $md             = new stdClass();
            $md->id         = 4;
            $md->title      = 'Одна новость';
            $md->c_id_label = 'Новость';
            $md->action     = 'news';
            $md->template   = 'news.one_item.tpl';
            $mo->mode($md);

            $this->modules[] = $mo->getData();



            /*******************************************************************************
             * Groups
            */
            $g = new Group(1, 'structure', 'Структура');
            $this->groups[] = $g->getData();

            $g = new Group(2, 'publications', 'Публикации');
            $this->groups[] = $g->getData();

            $g = new Group(3, 'catalog', 'Каталог');
            $this->groups[] = $g->getData();

            $g = new Group(4, 'gallery', 'Фотогалерея');
            $this->groups[] = $g->getData();


            /*******************************************************************************
             * Sections
            */
            //Pages
            $s = new Section(1, 'pages', 'Страницы', 1);

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

/*
            $f              = new stdClass();
            $f->name        = 'publish';
            $f->label       = 'Публиковать';
            $f->type        = 'checkbox';
            $f->list        = true;
            $f->link        = true;
            $f->width       = '1%';
            $f->align       = 'center';
            $s->field($f);
*/

            $this->sections[] = $s->getData();

            //Menu
            $s = new Section(2, 'menu', 'Меню', 1);

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