<?php

class Model_mukto extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all() {
        $q = $this->db->get('profiles');
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            return $data;
        }
    }

    function get_by($id) {
        $this->db->limit(1);
        $this->db->where('p_id', $id);
        $q = $this->db->get('profiles');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }else{
            return NULL;
        }
    }

    function get($limit) {
        $sql = 'SELECT * from profiles ' . $limit;
        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
    }

    function mukto_news($id, $limit) {
        $sql = 'SELECT * from news where n_writer = '. $id .' ORDER BY n_id DESC ' . $limit;       
        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }


    }

     function all_mukto_news($id) {
        $this->db->where('n_writer',$id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            return $data;
        }
    }
    

   

}