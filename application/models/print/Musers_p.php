<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Musers_p extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function showuserRmod() {
        $this->db->where('tag', 'print_user');
        $data = $this->db->get('admin');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function userbyid($id) {
        $this->db->where('id', $id);
        $q = $this->db->get('admin');
        return $q->row_array();
    }

    function create() {
        $this->db->where('email', $_POST['email']);
        $q = $this->db->get('admin');
        if ($q->num_rows() > 0) {
            return 'EXIST';
        } else {
            $pw = substr(do_hash($this->input->post('password')), 0, 16);
            $data = array(
                'email' => $_POST['email'],
                'password' => $pw,
                'u_name' => $_POST['u_name'],
                'designation' => $_POST['designation'],
                'tag' => $_POST['tag'],
                'type' => '6',
                'status' => $_POST['status'],
                'permission' => '1',
                'registered' => date('Y-m-d H:i:s')
            );
            $this->db->insert('admin', $data);
            $user_id = $this->db->insert_id();

            //print_r($this->db->last_query());
            //On Creating User Create a row and Set user ID on Access Control Table
            $q = array(
                'user_id' => $user_id
            );
            $this->db->insert('access_control', $q);
        }
    }

    function addPicture($picture, $id) {
        $data = array('image' => $picture);
        $this->db->where('id', $id);
        $this->db->update('admin', $data);
    }

    function user_update() {
        //$pw = substr(do_hash($this->input->post('password')), 0, 16);
        $data = array(
            'u_name' => $_POST['u_name'],
            'email' => $_POST['email'],
            'designation' => $_POST['designation'],
            'tag' => $_POST['tag'],
            'status' => $_POST['status']
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('admin', $data);
        //print_r($this->db->last_query());
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('admin');
    }

    /////User permission

    function getmenu() {
        //$this->db->where('m_type', 'Normal');
        $this->db->where('m_status', 'Active');
        $this->db->order_by('m_tab', 'asc');
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function checkuserAccess($id) {
        $this->db->where('user_id', $id);
        $data = $this->db->get('access_control');
        if ($data->num_rows() > 0) {
            $data = $data->row_array();
            return $data;
        }
    }

    function permission_add() {
        if ($this->input->post('ac_entrycontrol_module') != '') {
            foreach ($this->input->post('ac_entrycontrol_module') as $key => $value) {
                $data[] = $value;
                //print_r($data);
            }
            $ac_en = implode(',', $data);
        }
        else
            $ac_en = NULL;

        $data = array(
            'ac_menu_module' => $this->input->post('ac_menu_module'),
            'ac_pole_module' => $this->input->post('ac_pole_module'),
            'ac_scroll_module' => $this->input->post('ac_scroll_module'),
            'ac_banner_module' => $this->input->post('ac_banner_module'),
            'ac_photo_module' => $this->input->post('ac_photo_module'),
            'ac_profile_module' => $this->input->post('ac_profile_module'),
            'ac_entrycontrol_module' => $ac_en,
            'ac_news_entry_module' => $this->input->post('ac_news_entry_module'),
            'ac_horoscope' => $this->input->post('ac_horoscope'),
            'user_id' => $this->input->post('id')
        );
        $this->db->where('user_id', $this->input->post('id'));
        $this->db->update('access_control', $data);
        //print_r($this->db->last_query());
        ///On Update Permission Auto insert value to Admin Table
        $q = array(
            'permission' => 1
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('admin', $q);
    }

    function permissionAdmintable() {
        $data = array(
            'permission' => '1'
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('admin', $data);
    }

}

