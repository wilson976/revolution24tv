<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mtags_p extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_cat_tag($cat_id) {
        $data = array();
        $this->db->where('cat_id', $cat_id);
        $this->db->join('menu', 'menu.m_id = cat_tags.cat_id');
        $q = $this->db->get('cat_tags');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
        return Null;
    }

    function get_related_tag($cat_id) {
        $data = array();
        $this->db->where('cat_id', $cat_id);
        $this->db->join('menu', 'menu.m_id = related_tags.cat_id');
        $q = $this->db->get('related_tags');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
        return Null;
    }

    function cat_tag_create($cat_id) {
        $data = array(
            'cat_id' => $cat_id,
            'tag' => $this->input->post('tag')
        );
        $this->db->insert('cat_tags', $data);
    }

    function related_tag_create($cat_id) {
        $data = array(
            'cat_id' => $cat_id,
            'tag' => $this->input->post('tag')
        );
        $this->db->insert('related_tags', $data);
    }

    function tag_by_id($id) {
        $this->db->where('tag_id', $id);
        $q = $this->db->get('cat_tags');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
        return null;
    }

    function related_tag_by_id($id) {
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
        $this->db->where('tag_id', $this->input->post('tag_id'));
        $this->db->update('cat_tags', $data);
    }

    function related_tags_update($id) {
        $data = array(
            'tag' => $_POST['tag'],
        );
        $this->db->where('r_tag_id', $this->input->post('r_tag_id'));
        $this->db->update('related_tags', $data);
    }

}