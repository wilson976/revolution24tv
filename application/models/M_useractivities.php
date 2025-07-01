<?php

class M_useractivities extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function video_entry() {
        $data = array(
            'v_name' => $this->input->post('v_name'),
            'v_category' => $this->input->post('v_category'),
            'v_caption' => $this->input->post('v_caption'),
            'v_source' => $this->input->post('v_source'),
            'appoval' => '0',
            'u_id' => $this->session->userdata('u_id'),
            'v_date' => date('Y-m-d h:i:s')
        );
        $this->db->insert('video', $data);
    }

    function video_list() {
        $this->db->order_by('v_id', 'DESC');
        $data = $this->db->get('video');
        if ($data->num_rows() > 0) {
            return $data->result_array();
            //print_r($mn);
            //$a = $q[0];            
        } else {
            $data = NULL;
        }
    }

    function video_category_list() {
        $this->db->order_by('vid_id', 'ASC');
        $data = $this->db->get('vid_cat');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function video_edit_page($v_id) {
        $this->db->where('v_id', $v_id);
        $data = $this->db->get('video');
        if ($data->num_rows() > 0) {
            return $data->row_array();
            //print_r($mn);
            //$a = $q[0];            
        } else {
            $data = NULL;
        }
    }

    function video_edit() {
        $data = array(
            'v_name' => $this->input->post('v_name'),
            'v_category' => $this->input->post('v_category'),
            'v_position' => $this->input->post('v_position'),
            'v_caption' => $this->input->post('v_caption'),
            'v_tab' => $this->input->post('v_tab'),
            'v_source' => $this->input->post('v_source'),
            'appoval' => '1',
            'v_date' => date('Y-m-d h:i:s')
        );
        $this->db->where('v_id', $this->input->post('v_id'));
        $this->db->update('video', $data);
    }

    function video_delete($v_id) {
        $this->db->where('v_id', $v_id);
        $this->db->delete('video');
    }

    ///Video End

    function photo_entry() {
        $data = array(
            'p_category' => $_POST['p_category'],
            'p_caption' => $_POST['p_caption'],
            'appoval' => '0',
            'u_id' => $this->session->userdata('u_id'),
            'p_date' => date('Y-m-d')
        );
        $this->db->insert('photo_gallery', $data);
        return $this->db->insert_id();
    }

    function addPicture($picture, $p_id) {
        $data = array('p_location' => $picture);
        $this->db->where('p_id', $p_id);
        $this->db->update('photo_gallery', $data);
    }

    function photo_category_list() {
        $this->db->order_by('g_id', 'asc');
        $data = $this->db->get('gallery_cat');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    ///Photo End

    function hashikhushi_entry() {
        $data = array(
            'head' => $this->input->post('head'),
            'category' => $this->input->post('category'),
            'details' => $this->input->post('details'),
            'pic' => $this->input->post('pic'),
            'status' => '0',
            'u_id' => $this->session->userdata('u_id'),
            'update' => date('Y-m-d h:i:s')
        );
        $this->db->insert('hashikhushi_club', $data);
    }

    function hashikhushi_category_list() {
        $this->db->order_by('hk_id', 'ASC');
        $data = $this->db->get('hashikhushi_cat');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

}