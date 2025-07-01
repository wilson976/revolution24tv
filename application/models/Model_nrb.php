<?php

class Model_nrb extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all() {
        // $this->db->limit(10);
        $q = $this->db->get('nrb');
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            return $data;
        }
    }

    function get_by($id) {
        $this->db->limit(1);
        $this->db->where('nrb_id', $id);
        $q = $this->db->get('nrb');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
    }

    function get($limit) {
        $sql = 'SELECT * from nrb ORDER BY nrb_tab asc ' . $limit;
        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
    }

}