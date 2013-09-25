<?
class TableModel extends Core
{
    private $dataset;

    public function __construct()
    {
        parent::__construct();
    }

    public function setData($dataset)
    {
        $this->dataset = $dataset;
    }

    public function getCols()
    {
        $result = array();

        foreach ($this->dataset->cols as $item) {
            if ($item['list'] && $item['type'] != 'separator') {

                $result[] = array('name' => $item['name'], 'data' => $item);
            };
        };

        return $result;
    }

    public function getList()
    {
        $cols = "";
        $select_joins = "";

        foreach ($this->dataset->cols as $item) {
            if ($item['list']) {
                $cols .= "`" . $this->db->quote($item['name']) . "`, ";
            };
        };

        $cols = substr($cols, 0, strlen($cols) - 2);





        $query = "
                SELECT
                    " . $cols . "
                FROM
                    `" . $this->db->quote($this->dataset->table) . "` `main_table`" . $select_joins;

        $result = $this->db->assocMulti($query);

        print_r($result);
    }
}