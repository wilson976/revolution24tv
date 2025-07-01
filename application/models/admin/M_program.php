<?php

class M_program extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    ///->Profile Start


    function program_list() {
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get('program_schedule');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function p_entry() {
        $timestamp = $this->input->post('p_date');
        $splitTimeStamp = explode(" ",$timestamp);
        $date = $splitTimeStamp[0];
        $time = $splitTimeStamp[1];

        $date = date('Y-m-d',strtotime($timestamp));
        $time = date('H:i:s',strtotime($timestamp));       


        $data = array(
            'pro_name' => $_POST['name'],
            'pro_details' => $_POST['details'],
            'home_status' => $_POST['home_status'],
            'pro_date' => $date,
            'pro_time' => $time,
            'created_by' => $this->session->userdata('user_id'),
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('program_schedule', $data);
        return $this->db->insert_id();
    }

    function PaddPicture($picture, $p_id) {
        $data = array('pro_pic' => $picture);
        $this->db->where('id', $p_id);
        $this->db->update('program_schedule', $data);
    }
	
	function PictureNameUpdate($p_id) {
		$name= $p_id.'.jpg';
        $data = array('pro_pic' => $name);
        $this->db->where('id', $p_id);
        $this->db->update('program_schedule', $data);
    }

    function getPbyid($p_id) {
        $this->db->where('id', $p_id);
        $data = $this->db->get('program_schedule');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function p_update() {
        $timestamp = $this->input->post('p_date');
        $splitTimeStamp = explode(" ",$timestamp);
        $date = $splitTimeStamp[0];
        $time = $splitTimeStamp[1];

        $date = date('Y-m-d',strtotime($timestamp));
        $time = date('H:i:s',strtotime($timestamp));   
        $data = array(
            'pro_name' => $_POST['name'],
            'pro_details' => $_POST['details'],
            'home_status' => $_POST['home_status'],
            'pro_date' => $date,
            'pro_time' => $time,
            'created_by' => $this->session->userdata('user_id'),
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $this->input->post('p_id'));
        $this->db->update('program_schedule', $data);
        // print $this->db->last_query();exit;
    }

    function p_delete($p_id) {
        $this->db->where('id', $p_id);
        $this->db->delete('program_schedule');
    }

   
}