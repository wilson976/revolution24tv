<?php

class M_photo_gallery extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    ///->Photo Gallery Start

    function photo_category_entry() {
        $data = array(
            'g_cat' => $this->input->post('g_cat'),
            'g_parent' => $this->input->post('g_parent')
        );
        $this->db->insert('gallery_cat', $data);
    }

    function photo_entry() {
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        if ($stdate != '1970-01-01 06:00:00') {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }
        $data = array(
            'p_category' => $_POST['p_category'],
            'p_title' => $_POST['p_title'],
            'p_feature' => $_POST['p_feature'],
            'p_caption' => $_POST['p_caption'],
            'start_date' => $start_date,
            'meta_keyword' => $_POST['meta_keyword'],
            'meta_description' => $_POST['meta_description'],
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

    function photo_catwise($p_category) {
        $this->db->where('p_category', $p_category);
        $this->db->order_by('p_id', 'desc');
        $data = $this->db->get('photo_gallery');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function catbyid($p_category) {
        $this->db->where('g_id', $p_category);
        $data = $this->db->get('gallery_cat');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
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

    function photo_category_browse() {
        $this->db->group_by('p_category');
        $this->db->order_by('p_id', 'desc');
        $q = $this->db->get('photo_gallery');
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $row) {
                $this->db->where('g_id', $row['p_category']);
                $q1 = $this->db->get('gallery_cat');
                $data[] = $q1->result_array();
                //print_r($q1);
                //print_r($this->db->last_query());                
            }
            return $data;
        } else {
            $data = NULL;
        }
    }

    function photo_list() {
        $this->db->order_by('p_id', 'DESC');
        $data = $this->db->get('photo_gallery');
        if ($data->num_rows() > 0) {
            return $data->result_array();
            //print_r($mn);
            //$a = $q[0];            
        } else {
            $data = NULL;
        }
    }

    function photo_edit_page($p_id, $p_category) {
        $this->db->where('p_id', $p_id);
        $data = $this->db->get('photo_gallery');
        if ($data->num_rows() > 0) {
            return $data->row_array();
            //print_r($mn);
            //$a = $q[0];            
        } else {
            $data = NULL;
        }
    }

    function photo_edit() {
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        if ($stdate != '1970-01-01 06:00:00') {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }
        $data = array(
            'p_category' => $_POST['p_category1'],
            'p_title' => $_POST['p_title'],
            'p_feature' => $_POST['p_feature'],
            'p_caption' => $_POST['p_caption'],
            'start_date' => $start_date,
            'meta_keyword' => $_POST['meta_keyword'],
            'meta_description' => $_POST['meta_description'],
            'p_date' => date('Y-m-d')
        );
        $this->db->where('p_id', $this->input->post('p_id'));
        $this->db->update('photo_gallery', $data);
        //print $this->db->last_query();
    }

    function getphotobyid($p_id) {
        $this->db->where('p_id', $p_id);
        $data = $this->db->get('photo_gallery');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function photo_delete($p_id, $p_category) {
        $this->db->where('p_id', $p_id);
        $this->db->delete('photo_gallery');
    }

    function cat_edit_page($g_id) {
        $this->db->where('g_id', $g_id);
        $data = $this->db->get('gallery_cat');
        if ($data->num_rows() > 0) {
            return $data->row_array();
            //print_r($mn);
            //$a = $q[0];            
        } else {
            $data = NULL;
        }
    }

    function cat_edit() {
        $data = array(
            'g_cat' => $this->input->post('g_cat'),
            'g_parent' => $this->input->post('g_parent')
        );
        $this->db->where('g_id', $this->input->post('g_id'));
        $this->db->update('gallery_cat', $data);
    }

    function photo_cat_delete($g_id) {
        $this->db->where('g_id', $g_id);
        $this->db->delete('gallery_cat');
    }

    ///->Photo Gallery End
    
    ///video gallery

    function video_list() {
        $this->db->order_by('vid_id', 'DESC');
        $data = $this->db->get('wsxq_video');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function video_entry() {
        $data = array(
            'vid_src' => $this->input->post('vid_src'),
            'vid_caption' => $this->input->post('vid_caption')
        );
        $this->db->insert('wsxq_video', $data);
    }
    
    function video_delete($vid_id) {
        $this->db->where('vid_id', $vid_id);
        $this->db->delete('wsxq_video');
    }
}