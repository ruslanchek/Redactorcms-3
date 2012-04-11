<?php
    //error_reporting(E_ALL | E_STRICT);

    Class Config{
        public $db_vars = array(
            'host'  => 'localhost',
            'db'    => 'rdclite',
            'user'  => 'root',
            'pass'  => ''
        );

        public $modules = array(
            array('id' => 1, 'name' => 'Страницы', 'modes' => array(
                array(
                    'id'        => 1,
                    'name'      => 'HTML-страница',
                    'action'    => 'get_pages',
                    'template'  => 'page.simple.tpl'
                )
            )),

            array('id' => 2, 'name' => 'Меню', 'modes' => array(
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

            array('id' => 3, 'name' => 'Новости', 'modes' => array(
                array(
                    'id'        => 1,
                    'name'      => 'Список линеек',
                    'action'    => false,
                    'template'  => 'news.sections.tpl'
                ),
                array(
                    'id'        => 2,
                    'name'      => 'Линейка',
                    'action'    => 'get_news_section',
                    'template'  => 'news.section.tpl'
                )
            )),

            array('id' => 4, 'name' => 'Галерея', 'modes' => array(
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
                    'id'        => 2,
                    'name'      => 'Случайная фотография',
                    'action'    => false,
                    'template'  => 'gallery.ramdom_photo.tpl'
                )
            ))
        );
    };
?>