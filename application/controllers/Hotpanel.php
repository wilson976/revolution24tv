<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotpanel extends CI_Controller {

    public function index() {
        if ($this->input->post('email')) {
            $this->form_validation->set_rules('email', 'Username', 'valid_email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('email');
                $pw = substr(do_hash($this->input->post('password')), 0, 16);
           //     $this->load->model('m_admin_model');
                $this->M_admin_model->verify($email, $pw);
                if ($this->session->userdata('type') == 10) {
                    
                    redirect('admin/dashboard', 'refresh');
                } else if (($this->session->userdata('type') == 5)) {
                    redirect('admin/dashboard', 'refresh');
                } else {
                    redirect('hotpanel', 'refresh');
                }
            } else {
                //redirect('apanel', 'refresh');
                $this->load->view('login');
                //$this->session->set_flashdata('error', 'User Name or Password field Cannot be Empty!');
            }
        } else {
            $this->load->view('login');
            $this->session->set_flashdata('error', 'User Name or Password field Cannot be Empty!');
        }
    }

    function logout() {
        $data = array();
        $data['user_id'] = $this->session->userdata('user_id');
        $this->session->unset_userdata($data);
        $this->session->sess_destroy($data);
        $this->session->set_flashdata('error', "Logout Successful!");
        redirect('home', 'refresh');
    }

}
