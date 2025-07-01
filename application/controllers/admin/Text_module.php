<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Text_module extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
		$this->load->model('File_model');
    }

    //Default Load
    public function index() {
        $this->load->model('print/Mtext');
        $data['body'] = 'text_module';
        $data['gettext'] = $this->Mtext->getAlltext();
        $this->load->view('admin/template', $data);
    }

    function create() {
        $this->load->model('print/Mtext');
        $this->Mtext->entry();
		$this->File_model->home1();
        $this->session->set_flashdata('message', 'Text Inserted Successfully');
        redirect('admin/text_module');
    }

    function edit($id = NULL) {
        $this->load->model('print/Mtext');
        if ($this->input->post('text')) {
            $this->Mtext->edit($id);
			$this->File_model->home1();
            $this->session->set_flashdata('message', 'Text updated');
            redirect('admin/text_module');
        } else {
            $data['body'] = "text_edit";
            $data['id']= $id;
            // $data['getalltext'] = $this->Mtext->getAlltext();
            // $data['allmenu'] = $this->Mmenu->getmenualls();
            $data['gettext'] = $this->Mtext->texttbyID($id);
            $this->load->vars($data);
            $this->load->view('admin/template');
        }
    }

}
