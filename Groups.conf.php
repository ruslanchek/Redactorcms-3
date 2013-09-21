<?
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


/*****************************************************
 * Groups list
 * ***************************************************/

$g = new Group(1, 'structure', 'Структура');
$this->groups[] = $g->getData();

$g = new Group(2, 'publications', 'Публикации');
$this->groups[] = $g->getData();

$g = new Group(3, 'catalog', 'Каталог');
$this->groups[] = $g->getData();

$g = new Group(4, 'gallery', 'Фотогалерея');
$this->groups[] = $g->getData();