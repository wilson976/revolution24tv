<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_horoscope extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getbyID($id) {
        $this->db->where('h_id', $id);
        $q = $this->db->get('horoscope');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
        return NULL;
    }

    function getdaily() {        
        $q = $this->db->get('horoscope');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
        return NULL;
    }

    

    function edit() {
        $data = array(
            'h_category' => $_POST['h_category'],
            'h_details' => $_POST['h_details'],
            'last_update' => date('Y-m-d')
        );
        $this->db->where('h_type', $this->input->post('h_type'));
        $this->db->where('h_category', $this->input->post('h_category'));
        $this->db->update('horoscope', $data);
    }

    

}