<?php

class Url_model extends CI_Model {

    public function __construct() {
        ini_set('memory_limit', '-1');
        parent::__construct();
    }

    function pubdate_list() {
        $this->db->select('pdt');
        $q = $this->db->get('wsxq_m_p_dt');
        return $q->row_array();
    }

    public function getURLS() {
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'online');
        $query = $this->db->get('menu');
//print $this->db->last_query();
        return $query->result_array();
    }


    public function getURLdetails($s_date, $e_date) {
        $this->db->select('news.n_id, news.n_category, news.main_image, news.post_time, news.n_date, menu.m_bangla, menu.m_name, menu.m_type');
        $q = "`n_date` BETWEEN '$s_date' AND '$e_date'";
        $this->db->where($q);
        $this->db->join('menu', 'menu.m_id = news.n_category');
        $query = $this->db->get('news');
    //            print $this->db->last_query();exit;
        return $query->result();
    }

    function getDate($s_date, $e_date) {
        $this->db->select('*');
        $query = "`news`.`n_date` BETWEEN '$s_date' AND '$e_date'";
        $this->db->where($query);
        $q = $this->db->get('news');
//        print $this->db->last_query();
        return $q->result();
    }
}

?>