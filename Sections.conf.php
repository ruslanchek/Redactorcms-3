<?
Class Section{
    private $data;

    public function __construct($id, $name, $title, $group_id){
        $this->data = array(
            'id'            => $id,
            'name'          => $name, // Must be equal to SQL table name
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
$f->type        = 'separator';
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
$s->field($f);

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



/*****************************************************
 * News
 * ***************************************************/

$s = new Section(3, 'news', 'Новости', 2);

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
$f->label       = 'Заголовок';
$f->type        = 'text';
$f->list        = true;
$f->link        = true;
$f->width       = '40%';
$f->align       = 'left';
$f->validate    = array(
    array(
        'method'    => 'required',
        'message'   => 'Заполните заголовок'
    )
);
$s->field($f);

$f              = new stdClass();
$f->name        = 'path';
$f->label       = 'Путь';
$f->type        = 'text';
$f->list        = true;
$f->link        = false;
$f->width       = '23%';
$f->align       = 'left';
$f->validate    = array(
    array(
        'method'    => 'required',
        'message'   => 'Заполните путь'
    ),
    array(
        'method'    => 'unique',
        'message'   => 'Такой путь уже существует у другой новости'
    ),
    array(
        'method'    => 'url',
        'message'   => 'Недопустимые символы'
    )
);
$f->autofill    = array(
    'type'          => 'depends',
    'from_field'    => 'name',
    'method'        => 'url'
);
$s->field($f);

$f              = new stdClass();
$f->type        = 'separator';
$s->field($f);

$f              = new stdClass();
$f->name        = 'news_lines';
$f->label       = 'Линейка новостей';
$f->type        = 'select';
$f->list        = true;
$f->link        = false;
$f->align       = 'left';
$f->width       = '35%';
$f->options     = array(
    'type'  => 'table',
    'table' => 'news_lines'
);

/*$f->options     = array(
    'type'  => 'array',
    'data'  => array(
        array(
            'id' => 1,
            'name' => 'xxxx'
        ),

        array(
            'id' => 2,
            'name' => '112ddwre'
        )
    )
);*/

$f->multiple    = false;
$f->data        = 'news_lines';
$s->field($f);

$f              = new stdClass();
$f->type        = 'separator';
$s->field($f);

$f              = new stdClass();
$f->name        = 'announce';
$f->label       = 'Анонс';
$f->type        = 'textarea';
$f->visywig     = true;
$f->list        = false;
$f->link        = false;
$f->width       = '100%';
$f->align       = 'left';
$s->field($f);

$f              = new stdClass();
$f->name        = 'content';
$f->label       = 'Текст';
$f->type        = 'textarea';
$f->visywig     = true;
$f->list        = false;
$f->link        = false;
$f->width       = '100%';
$f->align       = 'left';
$s->field($f);

$f              = new stdClass();
$f->name        = 'publish';
$f->label       = 'Публиковать';
$f->type        = 'checkbox';
$f->list        = true;
$f->link        = true;
$f->width       = '1%';
$f->align       = 'center';
$s->field($f);

$this->sections[] = $s->getData();


/*****************************************************
 * News lines
 * ***************************************************/

$s = new Section(4, 'news_lines', 'Линейки новостей', 2);

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
$f->width       = '68%';
$f->align       = 'left';
$f->validate    = array(
    array(
        'method'    => 'required',
        'message'   => 'Заполните название'
    )
);
$s->field($f);

$f              = new stdClass();
$f->name        = 'publish';
$f->label       = 'Публиковать';
$f->type        = 'checkbox';
$f->list        = true;
$f->link        = true;
$f->width       = '1%';
$f->align       = 'center';
$s->field($f);

$this->sections[] = $s->getData();