<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tags extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '')
            redirect('hotpanel');
        $this->load->model('admin/Mtags');
    }

    function index() {
        $data['title'] = "Admin Panel/User";
        $data['body'] = 'tag/tags_add';
        $data['tags'] = $this->Mtags->get_tag();
        $this->load->vars($data);
        $this->load->view('admin/template');
    }

    function add_tag() {
        if ($this->input->post('tag')) {
            $this->form_validation->set_rules('tag', 'text', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->Mtags->tag_create();
                redirect('admin/tags');
            }
        }
        $data['title'] = "Add new tag";
        $data['heading'] = "Add new tag";
        $data['body'] = 'tag/tags_add';
        $this->load->vars($data);
        $this->load->view('admin/template');
    }

    

    function edit_tag($id=Null) {
        if ($this->input->post('tag')) {
            $this->Mtags->tags_update($id);
            $this->session->set_flashdata('message', 'Tag updated');
            redirect('admin/tags/');
        } else {
            $data['title'] = "Tag Edit";
            $data['body'] = "tag/tags_edit";
            $data['heading'] = "Edit tag";
            $data['tag_data'] = $this->Mtags->tag_by_id($id);
            $this->load->vars($data);
            $this->load->view('admin/template');
        }
    }

    function delete_tag($id) {
        $this->Mtags->Tag_delete($id);
        $this->session->set_flashdata('message', 'Tag Deleted');
        redirect('admin/tags/');
    }


}