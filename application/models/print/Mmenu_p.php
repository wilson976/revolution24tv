<?php

class Mmenu_p extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getmenualls() {
        $this->db->where('m_type', 'print');
        $this->db->where('m_parent', '0');
        $this->db->order_by('m_id', 'asc');
        $data = $this->db->get('menu');
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getallSubmenu() {
        $this->db->select('u.m_id, u.m_tab, u.m_name, u.m_status, c.m_name as parent_menu');
        $this->db->from('menu as u');
        $this->db->join('menu as c', 'u.m_parent = c.m_id');
        $this->db->where('u.m_type', 'print');
        $this->db->where('u.m_parent >', '0');
        $this->db->order_by('u.m_parent', 'asc');
        $data = $this->db->get();
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getmenu() {
        $this->db->where('m_status','active');
        $this->db->where('m_type', 'print');
        $this->db->order_by('m_tab', 'asc');
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getSubmenus($cat_id) {
        $this->db->where('m_parent', $cat_id);
        $this->db->where('m_type', 'print');
        $this->db->order_by('m_id', 'asc');
        $data = $this->db->get('menu');
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    //Get Special Menu
    function getmenuspecial() {
        $this->db->where('m_type', 'Special');
        $this->db->order_by('m_tab', 'asc');
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }
    
    function getmenueditcategory(){
    	$this->db->where('m_status','active');
    	$this->db->where('m_type', 'print');
    	$this->db->or_where('m_type', 'magazine');
        $this->db->order_by('m_tab', 'asc');
        $data = $this->db->get('menu');
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    //Get Districtwist Menu
    function getmenudist() {
        $this->db->where('m_type', 'District');
        $this->db->order_by('m_tab', 'asc');
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    //Get Literature Menu
    function getmenuliterature() {
        $this->db->where('m_type', 'Literature');
        $this->db->order_by('m_tab', 'asc');
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getmenuMagazine() {
        $this->db->where('m_type', 'magazine');
        $this->db->order_by('m_tab', 'asc');
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getmenufooter() {
        $this->db->where('m_type', 'Footer_menu');
        $this->db->order_by('m_tab', 'asc');
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    ///Get Services and Legal Menu

    function getmenuservices() {
        $this->db->where('m_type', 'Services');
        $this->db->order_by('m_tab', 'asc');
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getExtra() {
        $this->db->where('m_type', 'Extra');
        $this->db->order_by('m_tab', 'asc');
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    ///get Menu By ID

    function getmenubyid($m_id) {
        $this->db->where('m_id', $m_id);
        $data = $this->db->get('menu');
        return $data->row_array();
    }

    ///Create Menu
    function entry() {
        $data = array(
            'm_name' => $this->input->post('m_name'),
            'm_bangla' => $this->input->post('m_bangla'),
            'm_type' => $this->input->post('m_type'),
            'm_title' => $this->input->post('m_title'),
            'm_keywords' => $this->input->post('m_keywords'),
            'm_desc' => $this->input->post('m_desc'),
            'm_parent' => $this->input->post('m_parent'),
            'm_status' => $this->input->post('m_status'),
            'm_tab' => $this->input->post('m_tab'),
            'm_notes' => $this->input->post('m_notes'),
            'm_special' => $this->input->post('m_special')
        );
        $this->db->insert('menu', $data);
        return $this->db->insert_id();
    }

    function addPicture($picture, $m_id) {
        $data = array('m_pic_location' => $picture);
        $this->db->where('m_id', $m_id);
        $this->db->update('menu', $data);
    }

    function edit() {
        $data = array(
            'm_name' => $this->input->post('m_name'),
            'm_bangla' => $this->input->post('m_bangla'),
            'm_type' => $this->input->post('m_type'),
            'm_title' => $this->input->post('m_title'),
            'm_keywords' => $this->input->post('m_keywords'),
            'm_desc' => $this->input->post('m_desc'),
            'm_parent' => $this->input->post('m_parent'),
            'm_status' => $this->input->post('m_status'),
            'm_tab' => $this->input->post('m_tab'),
            'm_notes' => $this->input->post('m_notes'),
            'm_special' => $this->input->post('m_special')
        );

        $this->db->where('m_id', $this->input->post('m_id'));
        $this->db->update('menu', $data);
        //print $this->db->last_query();
    }

    ///Category Section Close
    ///->For Display Menu
    function getMAgmenu() {
        $this->db->where('m_type', 'magazine');
        $this->db->order_by('m_tab', 'asc');
        $this->db->order_by('m_id', 'asc');
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getMenuall() {
        $this->db->where('m_type', 'print');
        $this->db->order_by('m_tab', 'asc');
        $this->db->order_by('m_id', 'asc');
        $data = $this->db->get('menu');
        // print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function delete_images($id) {
        $data = array(
            'm_pic_location' => ''
        );
        $this->db->where('m_id', $id);
        $this->db->update('menu', $data);
    }

    function footerMenuDel($m_id) {
        $this->db->where('m_id', $m_id);
        $this->db->delete('menu');
    }

}
