<?
class DatasetModel extends Core
{
    private $dataset;

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        return $this->dataset;
    }

    public function create($table)
    {
        $this->dataset = new stdClass();
        $this->dataset->table = $table;
        $this->dataset->cols = array();

        return $this->get();
    }

    /**
     * @param string $item имя столбца mysql
     * */
    public function add($item)
    {
        $this->dataset->cols[] = $item;
    }

    public function fillItemData($id)
    {
        $query = "SELECT ";

        foreach ($this->dataset->cols as $item) {
            $query .= "`" . $this->db->quote($item['name']) . "`, ";
        };

        $query = substr($query, 0, strlen($query) - 2);
        $query .= " FROM `" . $this->db->quote($this->dataset->table) . "` WHERE `id` = " . intval($id);

        $data = $this->db->assocItem($query);

        for ($i = 0, $l = count($this->dataset->cols); $i < $l; $i++) {
            foreach ($data as $key => $value) {
                if ($this->dataset->cols[$i]['name'] == $key) {
                    $this->dataset->cols[$i]['value'] = $value;
                };
            }
        };
    }

    public function updateCol($col_name, $col_value){
        for ($i = 0, $l = count($this->dataset->cols); $i < $l; $i++) {
            if ($this->dataset->cols[$i]['name'] == $col_name) {
                $this->dataset->cols[$i]['value'] = $col_value;
            };
        };
    }

    public function dbUpdateItemCols(){
        $cols = '';

        foreach ($this->dataset->cols as $item) {
            $cols .= "`" . $this->db->quote($item['name']) . "` = '" . $this->db->quote($item['value']) . "', ";
        };

        $cols = substr($cols, 0, strlen($cols) - 2);

        $query = "
            UPDATE
                `" . $this->db->quote($this->dataset->table) . "`
            SET
                " . $cols . "
        ";

        $this->db->query($query);
    }
}