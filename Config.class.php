<?php
//error_reporting(E_ALL | E_STRICT);

session_start();
date_default_timezone_set('Europe/Moscow');

Class Config{
    public
        $modules,
        $sections,
        $groups;

    //DB params
    public $db_vars = array(
        'host'  => 'localhost',
        'db'    => 'rdc3',
        'user'  => 'root',
        'pass'  => '123'
    );

    public function __construct(){
        /*******************************************************************************
         * Modules
        */
        require_once('Modules.conf.php');

        /*******************************************************************************
         * Groups
        */
        require_once('Groups.conf.php');

        /*******************************************************************************
         * Sections
        */
        require_once('Sections.conf.php');
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