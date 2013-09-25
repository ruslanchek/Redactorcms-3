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
        $temp_tables = array();

        foreach ($this->dataset->cols as $item) {
            if ($item['list']) {
                switch ($item['type']) {
                    case 'select' :
                    {
                        if (!empty($item['options']) && $item['options']['type'] == 'table') {
                            $cols .= "`" . $this->db->quote($item['options']['table']) . "`.`name` AS `" . $this->db->quote($item['name']) . "`, ";
                            $select_joins .= "LEFT JOIN `" . $this->db->quote($item['options']['table']) . "` ON `main_table`.`" . $this->db->quote($item['name']) . "` = `" . $this->db->quote($item['options']['table']) . "`.`id`";

                        } elseif (!empty($item['options']) && $item['options']['type'] == 'array') {
                            if (!empty($item['options']['data'])) {
                                $tmp_table_name = md5($item['name'] . '_' . rand());

                                $query = "
                                    CREATE TEMPORARY TABLE `" . $this->db->quote($tmp_table_name) . "`
                                    (
                                        `id` INT UNSIGNED NOT NULL DEFAULT 0,
                                        `name` TEXT NOT NULL
                                    )
                                ";

                                $this->db->query($query);
                                $temp_tables[] = $tmp_table_name;

                                foreach($item['options']['data'] as $col){
                                    $query = "
                                        INSERT INTO `" . $this->db->quote($tmp_table_name) . "` (`id`, `name`) VALUES ('" . $col['id'] . "', '" . $col['name'] . "')
                                    ";

                                    $this->db->query($query);
                                }

                                $cols .= "`" . $this->db->quote($tmp_table_name) . "`.`name` AS `" . $this->db->quote($item['name']) . "`, ";
                                $select_joins .= "LEFT JOIN `" . $this->db->quote($tmp_table_name) . "` ON `main_table`.`" . $this->db->quote($item['name']) . "` = `" . $this->db->quote($tmp_table_name) . "`.`id`";

                            } else {
                                $cols .= "`main_table`.`" . $this->db->quote($item['name']) . "`, ";
                            }

                        } else {
                            $cols .= "`main_table`.`" . $this->db->quote($item['name']) . "`, ";
                        }

                    }
                        break;

                    default :
                    {
                        $cols .= "`main_table`.`" . $this->db->quote($item['name']) . "`, ";
                    }
                        break;
                }
            };
        };

        $cols = substr($cols, 0, strlen($cols) - 2);

        $query = "
                SELECT
                    " . $cols . "
                FROM
                    `" . $this->db->quote($this->dataset->table) . "` `main_table`
                " . $select_joins;

        $result = $this->db->assocMulti($query);

        foreach($temp_tables as $table){
            $query = "DROP TABLE `" . $this->db->quote($table). "`";
            $this->db->query($query);
        }

        return $result;
    }
}