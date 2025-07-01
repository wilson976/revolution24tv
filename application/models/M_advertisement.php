<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_advertisement extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function adCountrywise($id) {
        $this->db->where('b_menu', $id);
        $this->db->order_by('b_tab', 'asc');
        $data = $this->db->get('banner');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function addetailsnews($id) {
        $this->db->select('n_category');
        $this->db->where('n_id', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $q = $q->row_array();
            $this->db->where('b_menu', $q['n_category']);
            $this->db->order_by('b_tab', 'asc');
            $data = $this->db->get('banner');
            if ($data->num_rows() > 0) {
                return $data->result_array();
            } else {
                $data = NULL;
            }
        }
    }

}