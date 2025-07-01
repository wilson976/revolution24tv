<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mnews_p extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function newdate_list() {
        $data = $this->db->get('wsxq_c_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }
    
    function pubdate_list() {
        $data = $this->db->get('wsxq_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function magcreatedate() {
        $data = $this->db->get('wsxq_m_c_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }
    
    function magPubdate() {
        $data = $this->db->get('wsxq_m_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function create($cat_id) {
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_publishing')));
        if ($stdate != '1970-01-01 06:00:00') {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }
        if ($cat_id == '108' || $cat_id == '109') {
            $dt = $this->magcreatedate();
            $dt = $dt['cdt'];
        } else {
            $dt = $this->newdate_list();
            $dt = $dt['cdt'];
        }
        $dtime = new DateTime();
        
        if ($this->input->post('page_position') != '') {
            foreach ($_POST['page_position'] as $keys => $values) {
                $temp2[] = $values;
            }
            $n_position = implode($temp2, ",");
        } else {
            $n_position = NULL;
        }

        $data = array(
            'n_solder' => $this->input->post('n_solder'),
            'n_head' => $this->input->post('n_head'),
            'n_subhead' => $this->input->post('n_subhead'),
            'n_author' => $this->input->post('source_line'),
            'n_author_other' => $this->input->post('source_line_more'),
            'n_details' => $this->input->post('n_details'),
            'n_position' => $n_position,
            'n_category' => $cat_id,
            'article_type' => '2',
            'related_tag_id' => $this->input->post('n_related'),
            'n_date' => $dt,
            'start_date' => $dt,
            'n_caption' => $this->input->post('n_caption'),            
            'social_network' => $this->input->post('social_network'),
            'n_status' => $this->input->post('n_status'),
            'n_order' => $this->input->post('n_order'),
            'n_post_by' => $this->session->userdata('user_id'),
            'post_time' => $dtime->format('Y-m-d H:i:s'),
            'update_time' => $dtime->format('Y-m-d H:i:s'),
            'meta_keyword' => $this->input->post('meta_keywords'),
            'meta_description' => $this->input->post('meta_description')
        );
        $this->db->insert('news', $data);
        //print $this->db->last_query();
        return $this->db->insert_id();
    }

    function add_file($file_name, $id) {
        $data = array('main_image' => $file_name);
        $this->db->where('n_id', $id);
        $this->db->update('news', $data);
    }

    function update_file($file_name, $n_id) {
        $data = array('main_image' => $file_name);
        $this->db->where('n_id', $n_id);
        $this->db->update('news', $data);
    }

    function get_cat_type($cat_id) {
        $this->db->where('m_id', $cat_id);
        $q = $this->db->get('menu');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
        }
        $q->free_result();
        return $data['m_type'];
    }

    function get_max_date() {
        $this->db->select_max('n_date');
        $md = $this->db->get('news');
        if ($md->num_rows() > 0) {
            $data = $md->row_array();
        }
        $md->free_result();
        return $data['n_date'];
    }

    function get_news($cat_id) {
        $data = array();
        $date = $this->get_max_date();
        $this->db->order_by('n_id', 'desc');
        $this->db->where('n_category', $cat_id);
        $this->db->where('n_date', $date);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
        }
        $q->free_result();
        return $data;
    }

    function new_get_news($cat_id, $nd) {
        $data = array();
        $date = $nd;
        $this->db->order_by('n_id', 'desc');
        $this->db->where('n_category', $cat_id);
        $this->db->where('n_date', $date);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
        }
        $q->free_result();
        return $data;
    }

    function get_by_id($n_id) {
        $data = array();
        $this->db->where('n_id', $n_id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
        }
        // echo $this->db->last_query();
        $q->free_result();
        return $data;
    }

    function get_cat_name($cat_id) {
        $this->db->where('m_id', $cat_id);
        $this->db->select('m_name');
        $cn = $this->db->get('menu');
        if ($cn->num_rows() > 0) {
            $data = $cn->row_array();
        }
        $cn->free_result();
        // print_r($cn->free_result());
        
        return $data['m_name'];
    }

    function update($n_id, $cat_id) {
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_publishing')));

        if ($stdate != '1970-01-01 06:00:00') {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }
        if ($cat_id == '108' || $cat_id == '109') {
            $dt = $this->magcreatedate();
            $dt = $dt['cdt'];
        } else {
            $dt = $this->newdate_list();
            $dt = $dt['cdt'];
        }
        $dtime = new DateTime();


        if ($this->input->post('page_position') != '') {
            foreach ($_POST['page_position'] as $keys => $values) {
                $temp2[] = $values;
            }
            $n_position = implode($temp2, ",");
        } else {
            $n_position = NULL;
        }

        $data = array(            
            'n_solder' => $this->input->post('n_solder'),
            'n_head' => $this->input->post('n_head'),
            'n_subhead' => $this->input->post('n_subhead'),
            'n_author' => $this->input->post('source_line'),
            'n_author_other' => $this->input->post('source_line_more'),
            'n_details' => $this->input->post('n_details'),
            'n_position' => $n_position,
            'n_category' => $this->input->post('n_category'),
            'related_tag_id' => $this->input->post('n_related'),
            'n_caption' => $this->input->post('n_caption'),            
            'social_network' => $this->input->post('social_network'),
            'n_status' => $this->input->post('n_status'),
            'n_order' => $this->input->post('n_order'),
            'n_edit_by' => $this->session->userdata('user_id'),
            'edit_time' => $dtime->format('Y-m-d H:i:s'),
            'meta_keyword' => $this->input->post('meta_keywords'),
            'meta_description' => $this->input->post('meta_description')
        );

        $this->db->where('n_id', $n_id);
        $this->db->update('news', $data);
    }


    function delete($n_id, $data) {
        $data['deleted_by'] = $this->session->userdata('user_id');
        $data['deleted_time'] = date('Y-m-d H:i:s');
        $this->db->insert('trash', $data);
        $this->db->where('n_id', $n_id);
        $this->db->delete('news');
    }

}