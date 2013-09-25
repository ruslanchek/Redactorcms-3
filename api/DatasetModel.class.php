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
            if($item['type'] != 'separator'){
                $query .= "`" . $this->db->quote($item['name']) . "`, ";
            }
        };

        $query = substr($query, 0, strlen($query) - 2);
        $query .= " FROM `" . $this->db->quote($this->dataset->table) . "` WHERE `id` = " . intval($id);

        $data = $this->db->assocItem($query);

        for ($i = 0, $l = count($this->dataset->cols); $i < $l; $i++) {
            foreach ($data as $key => $value) {
                if($this->dataset->cols[$i]['type'] != 'separator'){
                    if ($this->dataset->cols[$i]['name'] == $key) {
                        $this->dataset->cols[$i]['value'] = $value;
                    }
                }
            }
        }
    }

    public function updateCol($col_name, $col_value){
        for ($i = 0, $l = count($this->dataset->cols); $i < $l; $i++) {
            if ($this->dataset->cols[$i]['name'] == $col_name && $col_name != 'id') {
                $this->dataset->cols[$i]['value'] = $col_value;
            };
        };
    }

    // TODO: Попробовать сюда добавить потом сравнение с эталоном Cols (чтобы не записывать при обновлении лишь одного столбца все подряд)
    public function dbUpdateItemCols($item_id){
        $cols = '';

        foreach ($this->dataset->cols as $item) {
            if($item['name'] != 'id'){
                $cols .= "`" . $this->db->quote($item['name']) . "` = '" . $this->db->quote($item['value']) . "', ";
            }
        };

        $cols = substr($cols, 0, strlen($cols) - 2);

        $query = "
            UPDATE
                `" . $this->db->quote($this->dataset->table) . "`
            SET
                " . $cols . "
            WHERE
                `id` = " . intval($item_id);

        $this->db->query($query);
    }

    public function dbCreateItemRow(){
        $query = "INSERT INTO `" . $this->db->quote($this->dataset->table) . "` () VALUES ()";

        $this->db->query($query);

        return $this->db->getMysqlInsertId();
    }

    public function dbDeleteItemRow($item_id){
        $query = "
            DELETE FROM
                `" . $this->db->quote($this->dataset->table) . "`
            WHERE
                `id` = " . intval($item_id);

        $this->db->query($query);

        return $item_id;
    }

    public function dbGetRowsCount($where){
        $query = "SELECT count(*) AS `count` FROM `" . $this->db->quote($this->dataset->table) . "` " . $this->db->quote($where);

        $data = (object) $this->db->assocItem($query);

        return intval($data->count);
    }
}