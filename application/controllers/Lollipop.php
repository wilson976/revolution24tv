<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lollipop extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('print/M_print_model');
    }

    public function index() {
        if ($this->input->post('email')) {
            $this->form_validation->set_rules('email', 'Username', 'valid_email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('email');
                $pw = substr(do_hash($this->input->post('password')), 0, 16);
                //     $this->load->model('m_admin_model');
                $this->M_print_model->verify($email, $pw);

                if ($this->session->userdata('type') == 10) {
                    redirect('print/dashboard', 'refresh');
                } else if (($this->session->userdata('type') == 6)) {
                    redirect('print/dashboard', 'refresh');
                } else {
                    redirect('lollipop', 'refresh');
                }
            } else {
                //redirect('apanel', 'refresh');
                $this->load->view('login_print');
                //$this->session->set_flashdata('error', 'User Name or Password field Cannot be Empty!');
            }
        } else {
            $this->load->view('login_print');
            $this->session->set_flashdata('error', 'User Name or Password field Cannot be Empty!');
        }
    }

    function logout() {
        $data = array();
        $data['user_id'] = $this->session->userdata('user_id');
        $data1 = array(
            'lastlogout' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $data['user_id']);
        $this->db->update('admin', $data1);
        $this->session->unset_userdata($data);
        $this->session->sess_destroy($data);
        $this->session->set_flashdata('error', "Logout Successful!");
        redirect('home', 'refresh');
    }

}
