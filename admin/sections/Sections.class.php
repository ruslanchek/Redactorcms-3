<?
Class Sections extends Core
{
    protected $dataset;

    public function __construct()
    {
        parent::__construct();

        $this->init(array(
            'name' => 'sections',
            'title' => 'Разделы'
        ));

        if (isset($_GET['section'])) {
            $this->processSection($_GET['section']);

            if ($this->ajax_mode) {
                switch ($_GET['action']) {
                    case 'getItemFieldsAndData' :
                    {
                        header('Content-type: application/json');
                        print json_encode($this->dataset);
                    }
                        break;

                    case 'saveData' :
                    {
                        $this->saveData();
                    }
                        break;
                }
            }
        }
    }

    private function saveData(){
        foreach($_POST as $key => $val){
            $this->dsmdl->updateCol($key, $val);
        }

        $this->dsmdl->dbUpdateItemCols();
    }

    private function getSection($section)
    {
        foreach ($this->config->sections as $s) {
            if ($section == $s['name']) {
                return $s;
            }
        }
    }

    private function processSection($section)
    {
        $section_data = $this->getSection($section);

        $this->dataset = $this->dsmdl->create($section_data['name']);

        foreach ($section_data['fields'] as $field) {
            $this->dsmdl->add($field);
        }

        if (!isset($_GET['item_id'])) {
            $this->tmdl->setData($this->dataset);
            $this->smarty->assign('list', $this->tmdl->getList());
            $this->smarty->assign('cols', $this->tmdl->getCols());
        } else {
            $this->dsmdl->fillItemData($_GET['item_id']);
        }
    }

    public function __destruct()
    {
        $this->deInit();
    }
}

;