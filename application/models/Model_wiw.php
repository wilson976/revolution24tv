<?php

class Model_wiw extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    ///WIW
    function ww_cat() {
        $this->db->order_by('ww_id', 'ASC');
        $data = $this->db->get('ww_category');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function ww_catbyID($ww_id) {
        $this->db->where('ww_id', $ww_id);
        $data = $this->db->get('ww_category');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function countallwiw() {
        $this->db->order_by('wiw_id', 'desc');
        $data = $this->db->get('wiw');
        if ($data->num_rows() > 0) {
            return $data = $data->num_rows();
        } else {
            $data = NULL;
        }
    }
    
    function getlatestprofile($limit) {
        $sql = "SELECT * from wiw ORDER BY wiw_id DESC " . $limit;
        $q = $this->db->query($sql);
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
    }

    function countallprofile($ww_id) {
        $this->db->order_by('wiw_order', 'ASC');
        $this->db->where('wiw_cat', $ww_id);
        $q = $this->db->get('wiw');
        if ($q->num_rows() > 0) {
            return $data = $q->num_rows();
        } else {
            $data = NULL;
        }
    }

    function getallprofile($limit, $ww_id) {
        $sql = "SELECT * from wiw WHERE wiw_cat='$ww_id' ORDER BY wiw_order ASC " . $limit;
        $q = $this->db->query($sql);
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
    }

    function getdetailsbyID($wiw_id) {
        $this->db->where('wiw_id', $wiw_id);
        $q = $this->db->get('wiw');
        if ($q->num_rows() > 0) {
            return $data = $q->row_array();
        } else {
            $data = NULL;
        }
    }

}