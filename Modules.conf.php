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
 * Modules list
 * ***************************************************/

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