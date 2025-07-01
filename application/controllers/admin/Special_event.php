<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Special_event extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
    }

    //Default Load
    public function index() {
        $data['body'] = 'event_create';
        $data['getevent'] = $this->Mevent->getAllEvent();
        $data['allmenu'] = $this->Mmenu->getmenualls();
        $this->load->view('admin/template', $data);
    }

    function create() {
        $this->Mevent->entry();
        $this->session->set_flashdata('message', 'Event Created Successfully');
        redirect('admin/special_event');
    }

    function edit($event_id = NULL) {
        if ($this->input->post('event_name')) {
            $this->Mevent->edit($event_id);
            $this->session->set_flashdata('message', 'Event updated');
            redirect('admin/special_event');
        } else {
            $data['body'] = "event_edit";
            $data['allmenu'] = $this->Mmenu->getmenualls();
            $data['getevent'] = $this->Mevent->eventbyID($event_id);
            $this->load->vars($data);
            $this->load->view('admin/template');
        }
    }

}
