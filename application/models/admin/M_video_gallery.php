<?php

class M_video_gallery extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    ///->Video Gallery Start

    
    function getCategory() {
        $q = $this->db->get('video_gallery_cat');
        $this->db->where('status', '1');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function getSubCategory() {
        $this->db->where('m_parent', 1);
        $this->db->where('m_type', 'online');
        $q = $this->db->get('menu');
         // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }
    function get_cat_name($cat_id) {
        $this->db->where('m_id', $cat_id);
        $cn = $this->db->get('menu');
        // print $this->db->last_query();exit;
        if ($cn->num_rows() > 0) {
            $data = $cn->row_array();
        }
        $cn->free_result();
        return $data['m_name'];
    }

    
    function video_entry() {
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        if ($stdate != '1970-01-01 06:00:00') {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }
        $data = array(
            'link' => $_POST['link'],
            'v_caption' => $_POST['v_caption'],
            'v_date' => date("Y-m-d"),
            'v_category' => $_POST['v_category'],
            'v_tag' => $_POST['v_tag'],
            'v_position' => $_POST['v_position'],
            'start_date' => $start_date
        );
        $this->db->insert('video_gallery', $data);
        return $this->db->insert_id();
    }

    function addPicture($picture, $v_id) {
        $data = array('v_location' => $picture);
        $this->db->where('v_id', $v_id);
        $this->db->update('video_gallery', $data);
    }



    function video_list() {
        $this->db->order_by('v_id', 'DESC');
        $data = $this->db->get('video_gallery');
        //print $this->db->last_query();exit;
        if ($data->num_rows() > 0) {
            return $data->result_array();
            //print_r($mn);
            //$a = $q[0];            
        } else {
            $data = NULL;
        }
    }

    function video_edit_page($v_id) {
        $this->db->where('v_id', $v_id);
        $data = $this->db->get('video_gallery');
        // print $this->db->last_query();exit;
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function showMenu() {
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }
    

    function video_update($img) {
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        if ($stdate != '1970-01-01 06:00:00') {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }

        $data = array(
            'link' => $_POST['link'],
            'v_caption' => $_POST['v_caption'],
            'v_tag' => $_POST['v_tag'],
            'v_category' => $_POST['v_category'],
            'v_position' => $_POST['v_position'],
            'start_date' => $start_date,
            'v_location' => $img
        );
        $this->db->where('v_id', $this->input->post('v_id'));
        $this->db->update('video_gallery', $data);
        //print $this->db->last_query();exit;
    }

    function updatevideo($v_id){
        $data = array(
            'v_sort' => $v_id
        );
        $this->db->where('v_id', $v_id);
        $this->db->update('video_gallery', $data);
    }

    function video_sortlist() {
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->where('v_position', '1');
        $this->db->order_by('v_sort','DESC');
        $this->db->limit(15);
        $q = $this->db->get('video_gallery');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }


   

   function video_delete($v_id) {
        $this->db->where('v_id', $v_id);
        $this->db->delete('video_gallery');
    }


    function OrderUpdate($hr='') {

        $v_id = $_POST['v_id'];
        $v_order = $_POST['v_sort'];

        for ($i = 0; $i < 15; $i++) {
            if(isset($v_id[$i])){
                $data = array(
                    'v_sort' => $v_order[$i]
                );
                $this->db->where('v_id', $v_id[$i]);
                $this->db->update('video_gallery', $data);
            }else{
                break;
            }
        }
        //print $this->db->last_query();
    }

    
    function cat_entry() {
        $data = array(
            'cat_name' => $_POST['cat_name'],
            'status' => $_POST['status'],
            'created_by' => $this->session->userdata('user_id'),
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('video_gallery_cat', $data);
        //print_r($this->db->last_query()); exit;
        return $this->db->insert_id();
    }
    
    function cat_update($id = '') {
        $data = array(
            'cat_name' => $_POST['cat_name'],
            'status' => $_POST['status']
        );
        
        $this->db->where('id', $_POST['id']);
        $this->db->update('video_gallery_cat', $data);
        //print_r($this->db->last_query()); exit;
        return $this->db->insert_id();
    }
    
    
    function cat_list() {
        $q = $this->db->get('video_gallery_cat');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function get_cat_byID($id = '') {
        $this->db->where('id', $id);
        $q = $this->db->get('video_gallery_cat');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function video_SubCat_entry() {
        $data = array(
            'cat_name' => $_POST['cat_name'],
            'v_parent' => $_POST['v_parent'],
            'created_by' => $this->session->userdata('user_id'),
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('video_gallery_cat', $data);
        //print_r($this->db->last_query()); exit;
        return $this->db->insert_id();
    }

    function video_cat_edit($id) {
        $this->db->where('id', $id);
        $data = $this->db->get('video_gallery_cat');
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
            'cat_name' => $_POST['cat_name'],
            'v_parent' => $_POST['v_parent']
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('video_gallery_cat', $data);
    }


    function video_cat_delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('video_gallery_cat');
    }

    function subcat_list() {
        $this->db->where('v_parent !=', '0');
        $q = $this->db->get('video_gallery_cat');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function parent_cat_list() {
        $this->db->where('v_parent =', '0');
        $q = $this->db->get('video_gallery_cat');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function video_category_browse() {
        $this->db->group_by('v_category');
        $this->db->order_by('v_id', 'desc');
        $q = $this->db->get('video_gallery');
        // print_r($this->db->last_query()); 
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $row) {
                $this->db->where('id', $row['v_category']);
                $q1 = $this->db->get('video_gallery_cat');
                $data[] = $q1->result_array();   
                // print_r($q1);
                // print_r($this->db->last_query());          
            }
            return $data;
        } else {
            $data = NULL;
        }
    }

    function catbyid($v_category) {
        $this->db->where('id', $v_category);
        $data = $this->db->get('video_gallery_cat');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function video_catwise($v_category) {
        $this->db->where('v_category', $v_category);
        $this->db->order_by('v_id', 'desc');
        $data = $this->db->get('video_gallery');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }


}