<?php

class Model_nrb_w extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all() {
        // $this->db->limit(10);
        $q = $this->db->get('nrb_writer');
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            return $data;
        }
    }

      function get_by($id) {
        $this->db->limit(1);
        $this->db->where('nrbw_id', $id);
        $q = $this->db->get('nrb_writer');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            //print $this->db->last_query();
            return $data;
        }
    }
    
    function get($limit) {
        $sql = 'SELECT * from nrb_writer ORDER BY nrbw_tab asc ' . $limit;
        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
    }

}