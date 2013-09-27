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
                    case 'getDataset' :
                    {
                        header('Content-type: application/json');
                        print json_encode($this->getDataset());
                    }
                        break;

                    case 'updateCell' : {
                        header('Content-type: application/json');
                        $id = $this->updateCell($_GET['item_id'], $_POST['key'], $_POST['val']);

                        $result = new stdClass();

                        $result->status = true;
                        $result->operation = 'updateCell';
                        $result->id = $id;

                        print json_encode($result);
                    }
                        break;

                    case 'create' :
                    {
                        header('Content-type: application/json');
                        $id = $this->create();

                        $result = new stdClass();

                        $result->status = true;
                        $result->operation = 'create';
                        $result->id = $id;

                        print json_encode($result);
                    }
                        break;

                    case 'saveData' :
                    {
                        header('Content-type: application/json');

                        $id = $this->saveData($_GET['item_id']);

                        $result = new stdClass();

                        $result->status = true;
                        $result->operation = 'saveData';
                        $result->id = $id;

                        print json_encode($result);
                    }
                        break;

                    case 'deleteItemRow' :
                    {
                        header('Content-type: application/json');
                        $id = $this->dsmdl->dbDeleteItemRow($_GET['item_id']);

                        $result = new stdClass();

                        $result->status = true;
                        $result->operation = 'deleteItemRow';
                        $result->id = $id;

                        print json_encode($result);
                    }
                        break;

                    case 'checkUniqueRow' : {
                        $this->checkUniqueRow($_GET['colname'], $_GET['value'], $_GET['id']);
                    }
                        break;
                }
            }
        }
    }

    private function getDataset(){
        for($i = 0, $l = count($this->dataset->cols); $i < $l; $i++){
            if($this->dataset->cols[$i]['type'] == 'select' && $this->dataset->cols[$i]['options']['type'] == 'table'){
                $query = "
                    SELECT `id`, `name` FROM `" . $this->dataset->cols[$i]['options']['table'] . "`
                ";

                $this->dataset->cols[$i]['options']['data'] = $this->db->assocMulti($query);
            }
        }

        return $this->dataset;
    }

    private function updateCell($id, $key, $val){
        $this->dsmdl->updateCol($key, $val);
        $this->dsmdl->dbUpdateItemCols($id);

        return $id;
    }

    private function saveData($id){
        foreach($_POST as $key => $val){
            if($key != 'undefined'){
                $this->dsmdl->updateCol($key, $val);
            }
        }

        $this->dsmdl->dbUpdateItemCols($id);

        return $id;
    }

    private function create(){
        $id = $this->dsmdl->dbCreateItemRow();
        $this->saveData($id);

        return $id;
    }

    private function getSection($section)
    {
        foreach ($this->config->sections as $s) {
            if ($section == $s['name']) {
                return (object) $s;
            }
        }
    }

    private function processSection($section)
    {
        $section_data = $this->getSection($section);

        $this->dataset = $this->dsmdl->create($section_data->name);

        foreach ($section_data->fields as $field) {
            $this->dsmdl->add($field);
        }

        if (!isset($_GET['item_id'])) {
            $this->tmdl->setData($this->dataset);

            if(isset($this->smarty)){
                $this->smarty->assign('list', $this->tmdl->getList());
                $this->smarty->assign('cols', $this->tmdl->getCols());
            }
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