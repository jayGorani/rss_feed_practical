<?php
class Db_operation extends CI_Model {

    public function select_data_by_condition($tablename, $condition_array = array(), $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $action = NULL) {
        $this->db->select($data);
        $this->db->from($tablename);
        if (!empty($join_str)) {
            foreach ($join_str as $join) {
                if (!isset($join['join_type'])) {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
                } else {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id'], $join['join_type']);
                }
            }
        }
        $this->db->where($condition_array);
        if ($limit != '' && $offset == 0) {
            $this->db->limit($limit);
        } else if ($limit != '' && $offset != 0) {
            $this->db->limit($limit, $offset);
        }
        if ($sortby != '' && $orderby != '') {
            $this->db->order_by($sortby, $orderby);
        } else if($sortby != '') {
            $this->db->order_by($sortby);
        }
        $query = $this->db->get();
        if ($limit == '') {
            $query->num_rows();
        }
        if ($action == 'count') {
            return $query->num_rows();
        } else {
            return $query->result_array();
        }
    }

    public function count_posts($where_arr = [],$platform = 0)
    {
        $this->db->from('posts');
        if(!empty($where_arr)){
            $this->db->where($where_arr);
        }
        if ($platform) {
            $this->db->where("FIND_IN_SET(".$this->db->escape_str($platform).", tagged_platform) !=", 0, FALSE);
        }
        return $this->db->count_all_results();
    }

    public function get_posts($limit, $offset, $platform = 0, $where_arr = array())
    {
        $this->db->select("
            id, title, content, char_count, tagged_platform, priority, image,
            DATE_FORMAT(pub_date, '%d %b %Y, %h:%i %p') AS pub_date
        ");
        $this->db->from('posts');
        if(!empty($where_arr)){
            $this->db->where($where_arr);
        }
        if ($platform) {
            $this->db->where("FIND_IN_SET(".$this->db->escape_str($platform).", tagged_platform) !=", 0);
        }
        $this->db->order_by('priority', 'ASC');
        $this->db->limit($limit, $offset);
        $postsData = $this->db->get()->result_array();
        return $postsData;
    }

    public function get_available_platforms()
    {
        $selected_fields = 'platform_id , platfrom_name , char_max_lenth, tagged_html';
        $condition_array = [
            'status' => 'enable'
        ];
        return $this->select_data_by_condition('posts_platform', $condition_array, $selected_fields, 'platfrom_name', 'ASC');
    }

    public function insert_posts_batch($records)
    {
        if (empty($records)) return false;
        $this->db->insert_batch('posts', $records);
        $first_id = $this->db->insert_id();
        $total = count($records);
        $update_data = [];
        for ($i = 0; $i < $total; $i++) {
            $update_data[] = [
                'id' => $first_id + $i,
                'priority' => $first_id + $i
            ];
        }
        $this->db->update_batch('posts', $update_data, 'id');
        return true;
    }

}
