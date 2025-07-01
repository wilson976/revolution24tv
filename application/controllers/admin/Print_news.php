<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Print_news extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
        $this->load->model('admin/M_Pnews');
        $this->load->model('File_model');
    }

    function index() {
        $data['title'] = 'Print News Section';
        $data['body'] = 'print_news_list';
        $data['printNews'] = $this->M_Pnews->news_list();
        $this->load->vars($data);
        $this->load->view('admin/template');
    }

    

    function edit($n_id = NULL, $cat_id = NULL) {
        if ($this->input->post()) {
            $this->M_Pnews->update($n_id, $cat_id);   
            $this->File_model->home1(); 
            $this->File_model->home2();        
            $this->session->set_flashdata('message', 'Successfully updated');
            redirect('./admin/print_news/', 'refresh');

        } else {
            
            $data['edit_data'] = $this->M_Pnews->get_by_id($n_id);
            $data['cat_name'] = $this->M_Pnews->get_cat_name($cat_id);
            $data['subcategory'] = $this->Mmenu->getSubmenus($cat_id);
            $data['writer_list'] = $this->M_profile->writer_list();
            $data['title'] = "Edit News";
            $data['body'] = "print_news_edit";
            $data['category_id'] = $cat_id;
            $this->load->vars($data);
            $this->load->view('admin/template');
        }
    }

    

    

}
