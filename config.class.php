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
            array('id' => 1, 'class' => 'page', 'name' => 'Страницы', 'modes' => array(
                array(
                    'id'        => 1,
                    'name'      => 'HTML-страница',
                    'action'    => 'get_pages',
                    'template'  => 'page.simple.tpl'
                )
            )),

            array('id' => 2, 'class' => 'menu', 'name' => 'Меню', 'modes' => array(
                array(
                    'id'        => 1,
                    'name'      => 'Одноуровневое',
                    'action'    => 'get_menu_list',
                    'template'  => 'menu.one_level.tpl'
                ),
                array(
                    'id'        => 2,
                    'name'      => 'Многоуровневое',
                    'action'    => 'get_menu_list',
                    'template'  => 'menu.multi_level.tpl'
                )
            )),

            array('id' => 3, 'class' => 'news', 'name' => 'Новости', 'modes' => array(
                array(
                    'id'        => 1,
                    'name'      => 'Список линеек',
                    'action'    => false,
                    'template'  => 'news.list.tpl'
                ),
                array(
                    'id'        => 2,
                    'name'      => 'Линейка',
                    'action'    => 'get_news_section',
                    'template'  => 'news.section.tpl'
                )
            )),

            array('id' => 4, 'class' => 'gallery', 'name' => 'Галерея', 'modes' => array(
                array(
                    'id'        => 1,
                    'name'      => 'Вся галерея',
                    'action'    => false,
                    'template'  => 'gallery.full.tpl'
                ),
                array(
                    'id'        => 2,
                    'name'      => 'Альбом',
                    'action'    => 'get_albums',
                    'template'  => 'gallery.album.tpl'
                ),
                array(
                    'id'        => 3,
                    'name'      => 'Случайная фотография',
                    'action'    => false,
                    'template'  => 'gallery.random_photo.tpl'
                )
            ))
        );
    };
?>