<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sitemap extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
        $this->load->model('admin/url_model');
    }

    function index() {
        $data['body'] = 'sitemap';
        $this->load->view('admin/template', $data);
    }

    function create() {

        if ($this->input->post('s_date') != NULL && $this->input->post('e_date') != NULL) {
            $s_date = $this->input->post('s_date');
            $e_date = $this->input->post('e_date');
            $data = array();
            //$data['pubdate'] = $this->url_model->pubdate_list();
            $data['urlslist'] = $this->url_model->getURLS();
            $data['urldetails'] = $this->url_model->getURLdetails($s_date, $e_date);

            //header("Content-Type: text/xml;charset=iso-8859-1");
            $this->load->view("admin/sitemap_view", $data);
			$this->session->set_flashdata('message', 'Sucessfully Create');
            redirect('admin/sitemap', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Please Enter Start date or End Date');
            redirect('admin/sitemap', 'refresh');
        }
    }

}
