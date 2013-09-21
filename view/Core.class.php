<?
Class Core
{
    protected
        $ajax_mode = false,
        $config;

    public
        $utilities,
        $ajax_action,
        $page,
        $error_404;

    // Свойства - Классы API
    private $classes = array(
        'utils' => 'Utilities',
        'db' => 'Database',
        'upload' => 'Upload'
    );

    // Созданные объекты
    private static $objects = array();

    public function __construct()
    {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/Config.class.php');
        $this->config = new Config();
        $this->page = new stdClass();
    }

    public function __get($name)
    {
        // Если такой объект уже существует, возвращаем его
        if (isset(self::$objects[$name])) {
            return (self::$objects[$name]);
        };

        // Если запрошенного API не существует - ошибка
        if (!array_key_exists($name, $this->classes)) {
            return null;
        };

        // Определяем имя нужного класса
        $class = $this->classes[$name];

        // Подключаем его
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/api/' . $class . '.class.php')) {
            include_once($_SERVER['DOCUMENT_ROOT'] . '/api/' . $class . '.class.php');
        } elseif (file_exists($_SERVER['DOCUMENT_ROOT'] . '/view/' . $class . '.class.php')) {
            include_once($_SERVER['DOCUMENT_ROOT'] . '/view/' . $class . '.class.php');
        };

        // Сохраняем для будущих обращений к нему
        self::$objects[$name] = new $class();

        // Возвращаем созданный объект
        return self::$objects[$name];
    }

    public function init()
    {
        //Если в запросе присутствует переменная ajax, ставим режим аякса
        if (isset($_GET['ajax'])) {
            $this->ajax_mode = true;
            $this->ajax_action = $_GET['action'];
        } else {
            require_once($_SERVER['DOCUMENT_ROOT'] . '/smarty/Smarty.class.php');

            //Подключаем и запускаем Смарти
            $this->smarty = new Smarty();

            $this->smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'] . '/templates');
            $this->smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'] . '/templates_c');
            $this->smarty->setConfigDir($_SERVER['DOCUMENT_ROOT'] . '/smarty/configs');
            $this->smarty->setCacheDir($_SERVER['DOCUMENT_ROOT'] . '/cache');

            $this->smarty->force_compile = false;
            $this->smarty->debugging = false;
            $this->smarty->caching = false;
            $this->smarty->cache_lifetime = 120;
        };

        $this->setRequest();
    }

    public function deInit()
    {
        $this->renderPage();
        $this->db->mySqlDisconnect();
    }

    //Render 404 error
    public function error404()
    {
        $sapi_name = php_sapi_name();

        if ($sapi_name == 'cgi' || $sapi_name == 'cgi-fcgi') {
            header('Status: 404 Not Found');
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        };

        $this->error_404 = true;
    }

    private function getSeoContentData()
    {
        $seo = new stdClass();

        $seo->title       = $this->page->data->seo_title          ? $this->page->data->seo_title          : $this->page->data->name;
        $seo->keywords    = $this->page->data->seo_keywords       ? $this->page->data->seo_keywords       : $this->page->data->name;
        $seo->description = $this->page->data->seo_description    ? $this->page->data->seo_description    : $this->page->data->name;

        return $seo;
    }

    //Check route and if it present - return the data, otherwise trigger the 404 error
    private function checkAndSetRouteData()
    {
        $query = "
                SELECT
                    `s`.`id`                AS `id`,
                    `s`.`pid`               AS `pid`,
                    `sd`.`name`             AS `name`,
                    `sd`.`path`             AS `path`,
                    `sd`.`part`             AS `part`,
                    `sd`.`menu_id`          AS `menu_id`,
                    `sd`.`template_id`      AS `template_id`,
                    `sd`.`blocks`           AS `blocks`,
                    `sd`.`main_block`       AS `main_block`,
                    `sd`.`seo_title`        AS `seo_title`,
                    `sd`.`seo_keywords`     AS `seo_keywords`,
                    `sd`.`seo_description`  AS `seo_description`,
                    `t`.`file`              AS `template_file`,
                    `t`.`blocks`            AS `template_blocks`
                FROM
                    `structure` `s`
                LEFT JOIN
                    `structure_data` `sd` ON (`sd`.`id` = `s`.`id`)
                LEFT JOIN
                    `templates` `t` ON (`t`.`id` = `sd`.`template_id`)
                WHERE
                    `sd`.`path` = '" . $this->db->quote($this->uri) . "' &&
                    `sd`.`publish` = 1
            ";

        $this->page->data = (object)$this->db->assocItem($query);

        if ($this->page->data->id > 0) {
            $this->page->template->template_file        = $this->page->data->template_file;
            $this->page->template->template_blocks      = $this->page->data->template_blocks;
            $this->page->template->blocks               = json_decode($this->page->data->blocks);
            $this->page->template->main_block           = json_decode($this->page->data->main_block);

            $this->page->seo = $this->getSeoContentData();
        } else {
            $this->page->template->template_file = '404.tpl';
            $this->error404();
        };
    }

    //Process the request URL vars
    private function setRequest()
    {
        $uri = mb_strtolower($_SERVER['REQUEST_URI'], "UTF-8");
        $this->uri = parse_url(preg_replace('/\/+/', "/", $uri, PHP_URL_PATH));
        $this->uri = preg_replace('/\/+/', "/", $this->uri['path'] . '/');
        $this->uri_chain = explode('/', trim($this->uri, '/'));
    }

    //Отправка переменных в шаблон и отрисовка страницы
    private function renderPage()
    {
        //Если не включен режим аякса, отрисовываем страницу с помощью Смарти
        if (!$this->ajax_mode) {
            $this->checkAndSetRouteData();
            $this->smarty->assign('core', $this);

            if(file_exists($this->smarty->template_dir[0] . $this->page->template->template_file)){
                $this->smarty->display($this->page->template->template_file);
            }else{
                $this->utils->fatalError(
                    '1000',
                    'Ошибка обработки шаблона страницы',
                    'Отсутствует файл шаблона <code>' . $this->page->template->template_file . '</code>'
                );
            }
        };
    }

    public function drawBlock($block_id)
    {
        if (
            intval($block_id) <= intval($this->page->template->template_blocks) ||
            $this->page->template->template_blocks == 'main'
        ) {
            if ($block_id == 'main') {
                $block_obj = $this->page->template->main_block;
            } else {
                foreach ($this->page->template->blocks as $block) {
                    if ($block->id == $block_id) {
                        $block_obj = (object)$block;
                    };
                };
            };

            $o = array();

            foreach ($block_obj->options as $option) {
                $o[$option->name] = $option->value;
            };

            $block_obj->options = (object)$o;

            $this->smarty->assign('block', $block_obj);

            if(file_exists($this->smarty->template_dir[0] . 'blocks/' . $block_obj->mode_template)){
                return $this->smarty->fetch('blocks/' . $block_obj->mode_template);
            }else{
                return $this->utils->displayError(
                    '1001',
                    'Ошибка блока',
                    'Отсутствует файл шаблона блока <strong>' . $block_obj->mode_template . '</strong>
                ');
            }
        };
    }
}