<?php
    //error_reporting(E_ALL | E_STRICT);

    Class Config{
        //DB params
        public $db_vars = array(
            'host'  => 'localhost',
            'db'    => 'rdclite',
            'user'  => 'root',
            'pass'  => ''
        );

        //Modules
        public $modules = array(
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
                        'action'    => 'get_pages',
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
                        'action'    => 'get_menu_list',
                        'template'  => 'menu.one_level.tpl'
                    ),
                    array(
                        'id'        => 2,
                        'title'     => 'Многоуровневое',
                        'action'    => 'get_menu_list',
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
                        'action'    => 'get_news_section',
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
                        'action'    => 'get_albums',
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
                        'action'    => 'get_categories',
                        'template'  => 'catalog.category_items.tpl'
                    ),
                    array(
                        'id'        => 2,
                        'title'     => 'Список категорий',
                        'action'    => false,
                        'template'  => 'catalog.categories.tpl'
                    )
            )),
        );
    };
?>