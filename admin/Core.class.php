<?php

Class Core{
    protected
        $template = 'main.tpl',
        $ajax_mode = false;

    public
        $config,
        $utilities,
        $ajax_action,
        $module,
        $main_menu = array(
            array('name' => 'structure',    'title' => 'Структура'),
            array('name' => 'sections',     'title' => 'Разделы'),
            array('name' => 'shop',         'title' => 'Магазин'),
            array('name' => 'users',        'title' => 'Пользователи'),
            array('name' => 'templates',    'title' => 'Шаблоны'),
            array('name' => 'config',       'title' => 'Настройка')
        );

    // Свойства - Классы API
    private $classes = array(
        'utils'         => 'Utilities',
        'db'            => 'Database',
        'upload'        => 'Upload',
        'tmdl'          => 'TableModel',
        'dsmdl'         => 'DatasetModel'
    );

    // Созданные объекты
    private static $objects = array();

    public function __construct(){
        require_once($_SERVER['DOCUMENT_ROOT'].'/Config.class.php');
        $this->config = new Config();
    }

    public function __get($name){
        // Если такой объект уже существует, возвращаем его
        if(isset(self::$objects[$name])){
            return(self::$objects[$name]);
        };

        // Если запрошенного API не существует - ошибка
        if(!array_key_exists($name, $this->classes)){
            return null;
        };

        // Определяем имя нужного класса
        $class = $this->classes[$name];

        // Подключаем его
        include_once($_SERVER['DOCUMENT_ROOT'].'/api/'.$class.'.class.php');

        // Сохраняем для будущих обращений к нему
        self::$objects[$name] = new $class();

        // Возвращаем созданный объект
        return self::$objects[$name];
    }

    //Функция запуска приложения
    protected function init($module){
        $this->module = $module;

        //Если в запросе присутствует переменная ajax, ставим режим аякса
        if(isset($_GET['ajax'])){
            $this->ajax_mode = true;
            $this->ajax_action = $_GET['action'];

            if(isset($_GET['get_taggets'])){
                $this->getTaggets();
            }
        }else{
            require_once($_SERVER['DOCUMENT_ROOT'].'/smarty/Smarty.class.php');

            //Подключаем и запускаем Смарти
            $this->smarty = new Smarty();

            $this->smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/admin/templates');
            $this->smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/admin/templates_c');
            $this->smarty->setConfigDir($_SERVER['DOCUMENT_ROOT'].'/smarty/configs');
            $this->smarty->setCacheDir($_SERVER['DOCUMENT_ROOT'].'/admin/cache');

            $this->smarty->force_compile    = false;
            $this->smarty->debugging        = false;
            $this->smarty->caching          = false;
            $this->smarty->cache_lifetime   = 120;
        };
    }

    //Функция окончания работы приложения
    protected function deInit(){
        $this->renderPage();
        $this->db->mySqlDisconnect();
    }

    //Отправка переменных в шаблон и отрисовка страницы
    private function renderPage(){
        //Если не включен режим аякса, отрисовываем страницу с помощью Смарти
        if(!$this->ajax_mode){
            $this->smarty->assign('core', $this);
            $this->smarty->display($this->template);
        };
    }

    //Отдача таггетов
    private function getTaggets(){
        header('Content-type: application/json');
        print json_encode($this->config->taggets);
    }
}