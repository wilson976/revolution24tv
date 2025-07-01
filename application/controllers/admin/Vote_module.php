<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vote_module extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
    }

    //Default Load
    public function index() {
        $this->load->model('admin/Mtext');
        $data['body'] = 'vote_module';
        $data['gettext'] = $this->Mtext->allseatinfo();
        $this->load->view('admin/template', $data);
    }

    

    function save_vote($id = NULL) {
        $this->load->model('admin/Mtext');
        if ($this->input->post()) {
            $this->Mtext->vote_save();
            $this->session->set_flashdata('message', 'Vote result Saved');
            redirect('admin/vote_module');
        } else {
            $data['body'] = "vote_module";
            $this->load->vars($data);
            $this->load->view('admin/template');
        }
    }

    function vote_edit($id = NULL) {
        $this->load->model('admin/Mtext');
        if ($this->input->post()) {
            $this->Mtext->vote_update($id);
            $this->session->set_flashdata('message', 'Vote result updated');
            redirect('admin/vote_module');
        } else {
            $data['body'] = "vote_edit";
            $data['getvote'] = $this->Mtext->vote_info($id);
            $this->load->vars($data);
            $this->load->view('admin/template');
        }
    }
    
    public function compact_vote() {
        $this->load->model('admin/Mtext');
        $data['getvote'] = $this->Mtext->compactVote();
        $data['body'] = 'compact_vote';
        $this->load->view('admin/template', $data);
    }
    
    
    function compact_edit($id = NULL) {
        $this->load->model('admin/Mtext');
        if ($this->input->post()) {
            $this->Mtext->vote_edit($id);
            $this->session->set_flashdata('message', 'Vote result updated');
            redirect('admin/vote_module/compact_vote');
        } else {
            $data['body'] = "compact_vote";
            $this->load->vars($data);
            $this->load->view('admin/template');
        }
    }
    
    function vote_delete($id) {
        $this->load->model('admin/Mtext');
        $this->Mtext->vote_delete($id);
        $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/vote_module');
    }
    


}
