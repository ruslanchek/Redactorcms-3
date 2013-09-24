<?
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




/*****************************************************
 * Pages
 * ***************************************************/

$mo = new Module(1, 'pages', 'Документы');

$md             = new stdClass();
$md->id         = 1;
$md->title      = 'HTML-страница';
$md->c_id_label = 'Страница';
$md->table      = 'pages';
$md->sl_action  = true;
$md->template   = 'page.simple.tpl';
$mo->mode($md);

$this->modules[] = $mo->getData();




/*****************************************************
 * Navigation
 * ***************************************************/
$mo = new Module(2, 'navigation', 'Навигация');

$md             = new stdClass();
$md->id         = 1;
$md->title      = 'Одноуровневое меню';
$md->c_id_label = 'Меню';
$md->table      = 'menu';
$md->sl_action  = true;
$md->template   = 'navigation.menu.one_level.tpl';
$mo->mode($md);

$md             = new stdClass();
$md->id         = 2;
$md->title      = 'Древовидное меню';
$md->c_id_label = 'Меню';
$md->table      = 'menu';
$md->sl_action  = true;
$md->template   = 'navigation.menu.multi_level.tpl';
$mo->mode($md);

$md             = new stdClass();
$md->id         = 3;
$md->title      = 'Меню второго уровня';
$md->c_id_label = 'Меню';
$md->table      = 'menu';
$md->sl_action  = true;
$md->template   = 'navigation.menu.sub_level.tpl';
$mo->mode($md);

$md             = new stdClass();
$md->id         = 4;
$md->title      = 'Хлебные крошки';
$md->table      = 'menu';
$md->sl_action  = false;
$md->template   = 'navigation.breadcrumbs.tpl';
$mo->mode($md);

$md             = new stdClass();
$md->id         = 5;
$md->title      = 'Карта сайта';
$md->table      = 'menu';
$md->sl_action  = false;
$md->template   = 'navigation.sitemap.tpl';
$mo->mode($md);

$this->modules[] = $mo->getData();



/*****************************************************
 * News
 * ***************************************************/
$mo = new Module(3, 'news', 'Новости');

$md             = new stdClass();
$md->id         = 1;
$md->title      = 'Все новости';
$md->table      = 'news';
$md->sl_action  = false;
$md->template   = 'news.news_all_items.tpl';
$md->options    = array(array('name' => 'limit', 'title' => 'Лимит', 'default' => 10));
$mo->mode($md);

$md             = new stdClass();
$md->id         = 2;
$md->title      = 'Список всех линеек новостей';
$md->table      = 'news_lines';
$md->sl_action  = false;
$md->template   = 'news.news_lines.tpl';
$mo->mode($md);

$md             = new stdClass();
$md->id         = 3;
$md->title      = 'Линейка новостей';
$md->c_id_label = 'Линейка';
$md->table      = 'news_lines';
$md->sl_action  = true;
$md->template   = 'news.news_items.tpl';
$md->options    = array(array('name' => 'limit', 'title' => 'Лимит', 'default' => 10));
$mo->mode($md);

$md             = new stdClass();
$md->id         = 4;
$md->title      = 'Одна новость';
$md->c_id_label = 'Новость';
$md->table      = 'news';
$md->sl_action  = true;
$md->template   = 'news.one_item.tpl';
$mo->mode($md);

$this->modules[] = $mo->getData();