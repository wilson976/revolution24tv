<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ad_possition extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
    }

    function index() {
        $data['body'] = 'ad_possition';  
        $data['possition'] = $this->M_banner->showpossition(); 
        $this->load->view('admin/template', $data);
    }

    function create() {
        if ($this->input->post('position_name')) {
            $this->form_validation->set_rules('position_name','Ageny Name', 'required|is_unique[banner_possition.position_name]');
            if ($this->form_validation->run() == TRUE) {
                if ($this->M_banner->possition_create() == 'EXIST') {
                    $this->session->set_flashdata('error', 'Possition Already Exist');
                    redirect('admin/ad_possition', 'refresh');
                }else{
                    $this->M_banner->possition_create();
                    redirect('admin/ad_possition', 'refresh');
                }
            }else{
                $this->session->set_flashdata('error', 'Please Enter a Valid User Name');
                redirect('admin/ad_possition', 'refresh');
            }
        }else{
            $this->session->set_flashdata('error', 'Please Enter a User Name');
            redirect('admin/ad_possition', 'refresh');
        }
    }

    function positionedit($id) {
        //print_r($id);
        if ($this->input->post('position_name')) {
            $this->M_banner->position_update();
            $this->session->set_flashdata('message', 'User Updated');
            redirect('admin/ad_possition');
        } else {
            $data['body'] = "position_edit";
            $data['position'] = $this->M_banner->positionid($id);
            $this->load->view('admin/template', $data);
        }
    }


    function positiondelete($id) {
        $this->M_banner->positiondelete($id);
        redirect('admin/ad_possition');
    }

 
   
}