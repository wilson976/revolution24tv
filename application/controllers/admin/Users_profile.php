<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
    }

    ///Edit Profile
    function profile($id) {
        $data = array();
        $data['body'] = 'profile';
        $data['user'] = $this->M_users_profile->get_userbyid($id);
        $this->load->view('admin/template', $data);
    }

    function edit() {
        $this->input->post('id');
        $this->M_users_profile->user_update();
        $this->session->set_flashdata('message', 'Profile Successfully updated');
        redirect('admin/dashboard');
    }

    public function password($id) {
        $data = array();
        $data['body'] = 'change_password';
        //$data['body'] = 'change_pass';
        $data['user'] = $this->M_users_profile->get_userbyid($id);
        $this->load->view('admin/template', $data);
    }

    function update() {
        if ($this->input->post('new_pass')) {
            $this->form_validation->set_rules('new_pass', 'New Password', 'required');
            $this->form_validation->set_rules('retype_pass', 'Retype Password', 'required');
            if ($this->form_validation->run() == TRUE) {
                if ($this->input->post('new_pass') == $this->input->post('retype_pass')) {
                    $this->M_users_profile->change_password();
                    $this->session->set_flashdata('message', 'Password Changed');
                    redirect('admin/dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Password Missmatched !!');
                    redirect('admin/dashboard');
                }
            } else {
                $this->session->set_flashdata('error', 'No Field can be empty');
                redirect('admin/dashboard');
            }
        }else{
           $this->session->set_flashdata('error', 'No Field can be empty');
           redirect('admin/dashboard');
        }
    }

}
