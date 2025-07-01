<?php

class Muser_module extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create() {
        $data = array(
            'u_name' => $_POST['name'],
            'u_email' => $_POST['email'],
            'u_pass' => $_POST['password'],
            'u_sex' => $_POST['gender'],
            'u_city' => $_POST['city'],
            'u_country' => $_POST['country'],
            'u_status' => '0'
        );
        $this->db->insert('user_login', $data);
        return $this->db->insert_id();
    }

    function addPicture($picture, $u_id) {
        $data = array('u_pic_location' => $picture);
        $this->db->where('u_id', $u_id);
        $this->db->update('user_login', $data);
    }

    function getanaccount($u_id) {
        $this->db->where('u_id', $u_id);
        $q = $this->db->get('user_login');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function exist() {
        $this->db->where('u_email', $this->input->post('email'));
        $q = $this->db->get('user_login');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function updateAccount($id) {
        $data = array(
            'u_status' => '1'
        );

        $this->db->where('u_id', $id);
        $this->db->update('user_login', $data);
    }

    function verify($email, $pw) {
        $this->db->where('u_email', $email);
        $this->db->where('u_pass', $pw);
        $this->db->where('u_status', '1');
        $this->db->limit(1);
        $q = $this->db->get('user_login');
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
            $data['u_id'] = $row['u_id'];
            $data['u_email'] = $row['u_email'];
            $data['u_name'] = $row['u_name'];
            //'<pre>' . print_r($data) . '</pre>';
            // print $this->db->last_query();
            $this->session->set_userdata($data);
            return $data;
        } else {
            return NULL;
        }
    }

    function profile($u_id) {
        $this->db->where('u_id', $u_id);
        $this->db->limit('1');
        $q = $this->db->get('user_login');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function ProfileInfo($u_id) {
        $data = array(
            'u_name' => $_POST['name'],
            'u_occupation' => $_POST['occupation'],
            'd_birth' => $_POST['d_birth'],
            'u_sex' => $_POST['gender']
        );
        $this->db->where('u_id', $u_id);
        $this->db->update('user_login', $data);
    }
    
    function ProfileContact($u_id) {
        $data = array(
            'u_city' => $_POST['city'],
            'u_country' => $_POST['country'],
            'u_phone' => $_POST['phone']
        );
        $this->db->where('u_id', $u_id);
        $this->db->update('user_login', $data);
    }

    function ProfilePassword($u_id) {
        $data = array(
            'u_pass' => $_POST['password']
        );
        $this->db->where('u_id', $u_id);
        $this->db->update('user_login', $data);
    }

}