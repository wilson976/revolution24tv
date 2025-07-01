<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mtags extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function tag_create() {
        $data = array(
            'tag' => $this->input->post('tag')
        );
        $this->db->insert('related_tags', $data);
    }

    function get_tag() {
        $this->db->order_by('r_tag_id', 'DESC');
        $data = $this->db->get('related_tags');
        // print $this->db->last_query();exit;
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

 


    function tag_by_id($id) {
        $this->db->where('r_tag_id', $id);
        $q = $this->db->get('related_tags');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
        return null;
    }

    

    function tags_update($id) {
        $data = array(
            'tag' => $_POST['tag'],
        );
        $this->db->where('r_tag_id', $this->input->post('r_tag_id'));
        $this->db->update('related_tags', $data);
    }

    function Tag_delete($id) {
        $this->db->where('r_tag_id', $id);
        $this->db->delete('related_tags');
    }



}