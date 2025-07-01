<?php

class Mtags_topics extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    ///->Profile Start


    function tags_list() {
        $data = $this->db->get('tag_topics');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function tags_entry() {

        $data = array(
            'tag_name' => $_POST['tag_name'],
            'tag_details' => $_POST['tag_details']
        );
        $this->db->insert('tag_topics', $data);
        return $this->db->insert_id();
    }

    function TaddPicture($picture, $tag_id) {
        $data = array('tag_image' => $picture);
        $this->db->where('tag_id', $tag_id);
        $this->db->update('tag_topics', $data);
    }

    function getTagbyid($tag_id) {
        $this->db->where('tag_id', $tag_id);
        $data = $this->db->get('tag_topics');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function tag_edit() {
        $data = array(
            'tag_name' => $_POST['tag_name'],
            'tag_details' => $_POST['tag_details']
        );
        $this->db->where('tag_id', $this->input->post('tag_id'));
        $this->db->update('tag_topics', $data);
    }

    function tag_delete($tag_id) {
        $this->db->where('tag_id', $tag_id);
        $this->db->delete('tag_topics');
    }

    
}