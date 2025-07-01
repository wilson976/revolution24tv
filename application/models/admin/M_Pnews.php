<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_Pnews extends CI_Model {

    function __construct() {
        parent::__construct();
    }



    function publish_date() {
        $data = $this->db->get('wsxq_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function news_list() {
        $dt = $this->publish_date();
        $this->db->where('article_type', 2);
        $this->db->where('n_date', $dt['pdt']);
        $this->db->join('menu', 'menu.m_id = news.n_category');
        $this->db->order_by('menu.m_id', 'ASC');
        $this->db->from('news');
        $data = $this->db->get();
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }
   

    function GetCategory($cat_id) {

        $this->db->where('m_id', $cat_id);
        $q = $this->db->get('menu');
//print $this->db->last_query();
        $cat_info = $q->row_array();

        return $cat_info;
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
        return $data['m_name'];
    }

    function update($n_id) {

        if ($this->input->post('page_position') != '') {
            foreach ($_POST['page_position'] as $keys => $values) {
                $temp2[] = $values;
            }
            $n_position = implode($temp2, ",");
        } else {
            $n_position = NULL;
        }

        $data = array(
            'n_position' => $n_position,
            
        );

        $this->db->where('n_id', $n_id);
        $this->db->update('news', $data);
        // print $this->db->last_query();
        // exit;
        
    }

   


}