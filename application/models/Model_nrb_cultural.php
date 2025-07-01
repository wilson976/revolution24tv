<?php

class Model_nrb_cultural extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all() {
        // $this->db->limit(10);
        $q = $this->db->get('nrb_cultural');
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            return $data;
        }
    }

    function get_by($nrb_cultural_id) {
        $this->db->limit(1);
        $this->db->where('nrb_cultural_id', $nrb_cultural_id);
        $q = $this->db->get('nrb_cultural');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
    }

    function get($limit) {
        $sql = 'SELECT * from nrb_cultural ORDER BY nrb_cultural_tab asc ' . $limit;
        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
    }

}