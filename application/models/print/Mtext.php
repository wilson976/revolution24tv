<?php

class Mtext extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAlltext() {
        $this->db->order_by('id', 'desc');
        $this->db->from('wsxq_all_text');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }


    function texttbyID($id) {
        $this->db->where('id', $id);
        $this->db->from('wsxq_all_text');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }
    ///Create Event
    function entry() {
        //$start_date = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        if ($stdate != '1970-01-01 06:00:00') {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }
        $end_date = date('Y-m-d H:i:s', strtotime($this->input->post('end_date')));
        $data = array(
            'type' => $this->input->post('text_type'),
            'text' => $this->input->post('main_text'),
            'user' => $this->session->userdata('user_id'),
            'start_date' => $start_date,
            'end_date' => $end_date
        );
        $this->db->insert('wsxq_all_text', $data);
        //print $this->db->last_query();
    }

    function edit() {
        //$start_date = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        if ($stdate != '1970-01-01 06:00:00') {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }
        $end_date = date('Y-m-d H:i:s', strtotime($this->input->post('end_date')));
        $data = array(
            'type' => $this->input->post('text_type'),
            'text' => $this->input->post('text'),
            'edit_by' => $this->session->userdata('user_id'),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'edit_time' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('wsxq_all_text', $data);
    }
    function vote(){
        $this->db->where('v_id', '1');
        $this->db->from('vote_result');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function vote_edit($id= NULL) {
        
        $data = array(
            'awami_league' => $this->input->post('awamileague'),
            'bnp' => $this->input->post('bnp'),
            'national_party' => $this->input->post('national_party'),
            'other' => $this->input->post('other')
        );
        $this->db->where('v_id', 1);
        $this->db->update('vote_result', $data);
    }

}
