<?php

class Model_amp extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function pubdate_list() {
        $data = $this->db->get('wsxq_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function getMenuID($n_category) {
        $this->db->select('m_id');
        $this->db->where('m_bangla', $n_category);
        $this->db->limit(1);
        $q = $this->db->get('menu');
        //print $this->db->last_query();
        //exit;
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data['m_id'];
        }else{
            return NULL;
        }
    }

    function getNewsbyID($cat_id, $n_id, $dt="1970/01/01") {
        $this->db->where('n_date', $dt);
        $this->db->where('n_id', $n_id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
//echo "page not found";        
        redirect('my404');
        return NULL;
    }

    function getMenubyID($n_category) {
        $this->db->where('m_id', $n_category);
        $this->db->limit(1);
        $q = $this->db->get('menu');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function getMorenewsbyCat_online($n_category, $n_id) {
        //$dt = $this->pubdate_list();
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->where('n_category', $n_category);
        $this->db->where('n_status', 3);
        $this->db->where('n_id !=', $n_id);
        $this->db->limit(5);
        $q = $this->db->get('news');
// print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
        return NULL;
    }

    function getMorenewsbyCat($n_category, $n_id, $dt) {
        //$dt = $this->pubdate_list();
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->where('n_category', $n_category);
        $this->db->where('n_id !=', $n_id);
        $this->db->where('n_date', $dt);
        $this->db->limit(5);
        $q = $this->db->get('news');
// print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
        return NULL;
    }


    function related_news($n_id) {
        $this->db->limit(1);
        $this->db->where('n_id', $n_id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            if ($data['related_tag_id'] != "") {
                $rel = explode(',', $data['related_tag_id']);
                foreach ($rel as $v) {
                    $this->db->like('related_tag_id', $v);
                    $this->db->where('n_id !=', $n_id);
                    $this->db->where('start_date <=', date('Y-m-d H:i:s'));
                    $this->db->where('n_status', 3);
                    $this->db->limit(5);
                    $query = $this->db->get('news');
                }

                if ($query->num_rows() > 0) {
                    $related_news = $query->result_array();
                    return $related_news;
                }
                return NULL;
            }
        }
    }

    public function comments($n_id = 0){
        $this->db->select('user.id as uid, user.full_name, user.email, user.device_type,  user.registrationtype, commennt.id as c_id, commennt.news_id, commennt.comment_text, commennt.created_at, commennt.type, commennt.parent');
        $this->db->where('news_id', $n_id);
        $this->db->where('parent', NULL);
        $this->db->where('status', '1');
        $this->db->where('type', 'web');
        $this->db->join('user', 'commennt.user_id = user.id');
        $q = $this->db->get('commennt');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            // print_r($this->db->last_query());
            // echo "<pre>";
            // print_r($data); exit;
            return $data;
        } else {
            $q->free_result();
            return NULL;
        }
    }

    function previous($id, $n_category) {
        $this->db->limit(1);
        $this->db->where('n_category', $n_category);
        $this->db->where('n_id >', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
        return NULL;
    }

    function next($id, $n_category) {
        $this->db->limit(1);
        $this->db->order_by('n_id', 'desc');
        $this->db->where('n_category', $n_category);
        $this->db->where('n_id <', $id);
        $q = $this->db->get('news');
 //echo $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
        return NULL;
    }

    function getMenuname($n_category) {
        $this->db->select('m_bangla');
        $this->db->where('m_id', $n_category);
        $this->db->limit(1);
        $q = $this->db->get('menu');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data['m_bangla'];
        }
    }
    function create_Printmenu() {
        $dt = $this->pubdate_list();
        $this->db->select('m.*');
        $this->db->where('i.n_date', $dt['pdt']);
        $this->db->where('m.m_status', 'active');
        $this->db->where('m.m_type', 'print');
        $this->db->from('news as i');
        $this->db->join('menu as m', 'i.n_category = m.m_id', 'left');
        $this->db->group_by('i.n_category');
        $this->db->order_by('m.m_tab', 'asc');
        $q = $this->db->get();
        //print_r($this->db->last_query()) ;
        if ($q->num_rows() > 0) {
           $data = $q->result_array();
           return $data;
        } else {
            return NULL;
        }
    }
    function create_Onlinemenu() {
        $this->db->where('m_parent', 0);
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'online');
        $this->db->order_by('m_tab', 'asc');
        $q = $this->db->get('menu');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            return $q->result_array();
            
        }else {
            return NULL;
        }
    }


}
