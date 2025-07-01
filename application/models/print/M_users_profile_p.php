<?php

class M_users_profile_p extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //Get user Information
    function get_userbyid($id) {
        $this->db->where('id', $id);
        $q = $this->db->get('admin');
        return $q->row_array();
    }

    ///Update User Info
    function user_update() {
        //$pw = substr(do_hash($this->input->post('password')), 0, 16);
        $data = array('u_name' => $this->input->post('u_name')
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('admin', $data);
        //print_r($this->db->last_query());
    }

    public function change_password() {
        $pw = substr(do_hash($this->input->post('new_pass')), 0, 16);
        $data = array('password' => $pw);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('admin', $data);
    }

}