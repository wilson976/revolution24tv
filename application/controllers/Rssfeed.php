<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rssfeed extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_rssfeed');
    }

    public function common4all() {
        $data['services'] = $this->Model_home->servicesLegal();
        $data['scrolling'] = $this->Model_home->scrollNews();
        $data['banner'] = $this->Model_home->banner();
        $data['printmenu'] = $this->Model_menu->create_Printmenu();
        $this->load->vars($data);
    }

    public function index() {
        $data = array();
        $this->common4all();
        $data['class'] = 'rss';
        $data['title'] = 'First Bangla interactive newspaper - Deshe Bideshe';
        $this->load->view('template', $data);
    }

    public function rss($id) {
        $data['feed'] = $this->Model_rssfeed->getrssdata($id);
        $data['cat'] = $id;
        $this->load->view('rss/rss', $data);
    }

}
