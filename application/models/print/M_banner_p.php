<?php

class M_banner_p extends CI_Model {

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
            'b_flash_height' => $_POST['b_flash_height'],
            'start_date' => $start_date,
            'end_date' => $end_date
        );
        $this->db->insert('banner', $data);
        //print $this->db->last_query();
        return $this->db->insert_id();
    }

    function banneraddPicture($picture, $b_id) {
        $data = array('b_location' => $picture);
        $this->db->where('b_id', $b_id);
        $this->db->update('banner', $data);
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
            'b_flash_height' => $_POST['b_flash_height'],
            'start_date' => $start_date,
            'end_date' => $end_date
        );
        $this->db->where('b_id', $this->input->post('b_id'));
        $this->db->update('banner', $data);
        //print $this->db->last_query();
    }

    function banner_delete($b_id) {
        $this->db->where('b_id', $b_id);
        $this->db->delete('banner');
    }

    ////-->Banner End
}