<?php

class M_banner extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function parent_menu() {
        $this->db->order_by('m_name', 'ASC');
        $this->db->where('m_type != ', 'Footer_menu');
        $this->db->where('m_type != ', 'Services');
        // $this->db->where('m_type', 'Special');
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    ///->Banner Start

    function banner_list() {
        $this->db->order_by('b_id', 'DESC');
        $data = $this->db->get('banner');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function banner_entry() {
        $dt = new DateTime();
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        if ($stdate != '1970-01-01 06:00:00') {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }
        //$start_date = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        $end_date = date('Y-m-d H:i:s', strtotime($this->input->post('end_date')));
        $data = array(
            'b_type' => $_POST['b_type'],
            'b_code' => $_POST['b_code'],
            'b_url' => $_POST['b_url'],
            'b_name' => $_POST['b_name'],
            'b_tab' => $_POST['b_tab'],
            'b_position' => $_POST['b_position'],
            'b_status' => $_POST['b_status'],
            'start_date' => $start_date,
            'end_date' => $end_date,
            'b_post_by' => $this->session->userdata('user_id'),
            'b_post_time' => $dt->format('Y-m-d H:i:s')
        );
        $this->db->insert('banner', $data);
        // print $this->db->last_query();exit;
        return $this->db->insert_id();
        
        
    }

    function banneraddPicture($picture, $b_id) {
        $data = array('b_location' => $picture);
        $this->db->where('b_id', $b_id);
        $this->db->update('banner', $data);
        // print $this->db->last_query();exit;
    }

    function banneraddPdf($picture, $b_id) {
        $data = array('b_link_location' => $picture);
        $this->db->where('b_id', $b_id);
        $this->db->update('banner', $data);
    }

    function getbannerbyid($b_id) {
        $this->db->where('b_id', $b_id);
        $data = $this->db->get('banner');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function banner_edit() {
        $dt = new DateTime();
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        if ($stdate != '1970-01-01 06:00:00') {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }
        //$start_date = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        $end_date = date('Y-m-d H:i:s', strtotime($this->input->post('end_date')));
        $data = array(
            'b_type' => $_POST['b_type'],
            'b_code' => $_POST['b_code'],
            'b_url' => $_POST['b_url'],
            'b_name' => $_POST['b_name'],
            'b_tab' => $_POST['b_tab'],
            'b_position' => $_POST['b_position'],
            'b_status' => $_POST['b_status'],
            'start_date' => $start_date,
            'end_date' => $end_date,
            'b_edit_by' => $this->session->userdata('user_id'),
            'b_edit_time' => $dt->format('Y-m-d H:i:s')
        );
        $this->db->where('b_id', $this->input->post('b_id'));
        $this->db->update('banner', $data);
        //print $this->db->last_query();
        
        
        
    }

    function banner_delete($b_id) {
        $this->db->where('b_id', $b_id);
        $this->db->delete('banner');
        
    }

    ////////////////////Banner Position//////////////

     function possition_create() {
        $this->db->where('position_name', $_POST['position_name']);
        $q = $this->db->get('banner_possition');
        if ($q->num_rows() > 0) {
            return 'EXIST';
        } else {
            
            $data = array(
                'position_name' => $_POST['position_name'],
                'position_view' => $_POST['position_view'],
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('banner_possition', $data);
        
        }
    }

    function showpossition() {
        $data = $this->db->get('banner_possition');
        if ($data->num_rows() > 0) {
            // print_r($data->result_array()); exit;
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function positionid($id) {
        $this->db->where('id', $id);
        $q = $this->db->get('banner_possition');
        return $q->row_array();
    }

    function position_update($id) {
        $data = array(
            'position_name' => $_POST['position_name'],
            'position_view' => $_POST['position_view']
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('banner_possition', $data);
        //print_r($this->db->last_query());
    }
    function positiondelete($id) {
        $this->db->where('id', $id);
        $this->db->delete('banner_possition');
    }

    ////-->Banner End
}