<?php

class Model_pages_artculture extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getCategoryLeadNewsartCulture($m_id) {
        $this->db->select('end_date');
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->where('n_sub_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(1);
        $r = $this->db->get('news');
        $row = $r->row_array();
//end date check

        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->where('n_sub_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        if ($row['end_date'] != '1970-01-01 06:00:00') {
            $this->db->where('end_date >=', date('Y-m-d H:i:s'));
        }
        $this->db->limit(1);
        $this->db->from('news');
        $this->db->join('menu', 'menu.m_id = news.n_sub_category');
        $this->db->join('profiles', 'profiles.p_id = news.n_writer');
        $q = $this->db->get();
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function getCategoryNewsartCulture($m_id, $n_id) {
        $this->db->select('end_date');
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_sub_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('n_id !=', $n_id);
        $this->db->limit(20);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $r = $this->db->get('news');
        foreach ($r->result_array()as $row) {
            $this->db->order_by('start_date', 'DESC');
            $this->db->where('n_sub_category', $m_id);
            $this->db->where('n_status', 3);
            $this->db->where('n_id !=', $n_id);
            $this->db->where('start_date <=', date('Y-m-d H:i:s'));
            if ($row['end_date'] != '1970-01-01 06:00:00') {
                $this->db->where('end_date >=', date('Y-m-d H:i:s'));
            }
            $this->db->limit(20);
            $this->db->from('news');
            $this->db->join('menu', 'menu.m_id = news.n_sub_category');
            $this->db->join('profiles', 'profiles.p_id = news.n_writer');
            $q = $this->db->get();
            //print $this->db->last_query();
            if ($q->num_rows() > 0) {
                $data = $q->result_array();
                return $data;
            } else {
                return NULL;
            }
        }
    }

    function most_read_categoryartCulture($m_id) {
        $this->db->where('n_sub_category', $m_id);
        $this->db->order_by("most_read desc, n_id desc");
        $this->db->limit(8);
        $this->db->from('news');
        $this->db->join('profiles', 'profiles.p_id = news.n_writer');
        $q = $this->db->get();
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
        return NULL;
    }

}