<?php

class My404 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_pages');
        $this->load->model('Model_menu');
        $this->load->model('Model_home');
        $this->load->model('Model_print');
        $this->load->model('Model_common4all');
    }

    

    public function index() {
        $this->output->set_status_header('404');
        $this->Model_common4all->common();
        $data['class'] = 'error_404';         
        $this->load->view('template', $data);
    }

}

?>