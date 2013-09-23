<?
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


/*****************************************************
 * Pages
 * ***************************************************/

$s = new Section(1, 'pages', 'Документы', 1);

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
$f->width       = '100%';
$f->align       = 'left';
$f->validate    = array(
    array(
        'method'    => 'required',
        'message'   => 'Заполните название'
    )
);
$s->field($f);

$f              = new stdClass();
$f->name        = 'content';
$f->label       = 'Документ';
$f->type        = 'textarea';
$f->visywig     = true;
$f->list        = false;
$f->link        = false;
$f->width       = '100%';
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



/*****************************************************
 * Menu
 * ***************************************************/

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