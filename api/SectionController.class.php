<?
class SectionController extends Core
{
    protected $dataset, $section_name;

    public function __construct()
    {
        parent::__construct();
    }

    public function getList($table, $fields, $where, $order, $limit)
    {
        $this->table = $table;
        $this->dataset = $this->dsmdl->create($this->table);

        return $this->getSectionContent($table, $fields, $where, $order, $limit);
    }

    public function getSectionContent($table, $fields = false, $where = false, $order = array('id', 'DESC'), $limit = false, $current_page = false)
    {
        $data = new stdClass();

        if ($current_page === false) {
            $data->current_page = intval($_GET['page']);
        } else {
            $data->current_page = $current_page;
        }

        if ($data->current_page < 1) {
            $data->current_page = 1;
        }

        $data->table = $this->db->quote($table);

        $data->fields = $fields;
        $data->fields_query = '';

        $data->where = $where;
        $data->where_query = ' WHERE `publish` = 1';

        $data->order = $order;
        $data->order_query = '';

        $data->limit = intval($limit);
        $data->limit_query = '';

        $data->result = new stdClass();

        if (is_array($data->fields) && !empty($data->fields) && $data->fields != '*') {
            foreach ($data->fields as $item) {
                if (is_array($item)) {
                    $data->fields_query .= '`' . $item[0] . '` AS `' . $this->db->quote($item[1]) . '`, ';
                } else {
                    $data->fields_query .= '`' . $this->db->quote($item) . '`, ';
                }
            }

            $data->fields_query = substr($data->fields_query, 0, strlen($data->fields_query) - 2);
        } elseif ($data->fields != '*') {
            $data->fields_query .= $data->fields;
        } else {
            $data->fields_query .= '*';
        }

        if ($data->where && $data->where != '') {
            $data->where_query .= ' && ' . $data->where;
        }

        //TODO : Make a multiple orders here
        if (!empty($data->order)) {
            $data->order_query = 'ORDER BY ' . $data->order[0] . ' ' . $data->order[1];
        };

        if ($data->limit !== false && $data->limit > 0) {
            $data->per_page = $data->limit;
            $data->total_items = $this->dsmdl->dbGetRowsCount($data->where_query);

            $data->total_pages = ceil($data->total_items / $data->per_page);

            if ($data->current_page > $data->total_pages) {
                $data->current_page = $data->total_pages;
            }

            $data->start_item = ($data->current_page - 1) * $data->limit;
            $data->result->pagination = $this->getPagesArray($data->total_pages, $data->current_page);

            if (isset($data->start_item) && $data->start_item >= 0) {
                $data->limit_query = 'LIMIT ' . $this->db->quote($data->start_item) . ', ' . $this->db->quote($data->limit);
            } else {
                $data->limit_query = 'LIMIT ' . $this->db->quote($data->limit);
            }
        }

        $query = 'SELECT ' . $data->fields_query . ' FROM `' . $this->db->quote($data->table) . '` ' . $data->where_query . ' ' . $data->order_query . ' ' . $data->limit_query;

        $data->result->items = $this->db->assocMulti($query);

        return $data->result;
    }

    //Get pages array (for pagination)
    public function getPagesArray($total_pages, $current_page, $width = 5)
    {
        $data = new stdClass();

        $data->total_pages = $total_pages;
        $data->current_page = intval($current_page);
        $data->prev_page = false;
        $data->next_page = false;
        $data->pages = array();

        if ($data->current_page <= 0) {
            $data->current_page = 1;
        }

        if ($total_pages > $width) {
            $offset = ($width - 1) / 2;

            $p_from = $data->current_page - $offset;
            $p_to = $data->current_page + $offset;

            if ($p_to > $data->total_pages) {
                $p_to = $data->total_pages;
            }

            if ($p_from < 1) {
                $p_from = 1;
            }

            if ($p_from <= $offset - 1) {
                $p_to = $width - $p_from + 1;
            }

            if ($p_to >= $data->total_pages) {
                $p_from = $data->total_pages - $width + 1;
            }

            $i = $p_from - 1;

            if ($p_from > 1) {
                $data->pages[] = (object)array('num' => 1, 'name' => 1);
                $data->pages[] = (object)array('name' => '...');
            }

            while ($i < $p_to) {
                $i++;

                if ($data->current_page == $i) {
                    $data->pages[] = (object)array('num' => $i, 'name' => $i, 'current' => true);
                } else {
                    $data->pages[] = (object)array('num' => $i, 'name' => $i);
                }
            }

            if ($p_to < $data->total_pages) {
                $data->pages[] = (object)array('name' => '...');
                $data->pages[] = (object)array('num' => $data->total_pages, 'name' => $data->total_pages);
            }

            if ($data->current_page - 1 >= 1) {
                $data->prev_page = $data->current_page - 1;
            }

            if ($data->current_page + 1 <= $data->total_pages) {
                $data->next_page = $data->current_page + 1;
            }
        } else {
            for ($i = 1; $i < $data->total_pages + 1; $i++) {
                if ($data->current_page == $i) {
                    $data->pages[] = (object)array('num' => $i, 'name' => $i, 'current' => true);
                } else {
                    $data->pages[] = (object)array('num' => $i, 'name' => $i);
                }
            }
        }

        return $data;
    }
}