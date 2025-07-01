<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Horoscope extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }

        $this->load->model('admin/M_horoscope');
    }

    function index() {
        $data['list'] = $this->M_horoscope->getdaily();
        $data['body'] = 'horoscope';
        $this->load->view('admin/template', $data);
    }

    function edit($id) {
        $data['val'] = $this->M_horoscope->getbyID($id);
        $data['body'] = 'horoscope_edit';
        $this->load->view('admin/template', $data);
    }

    function update() {
        $this->M_horoscope->edit();
        $this->session->set_flashdata('message', 'Saved Successfully');
        redirect('admin/horoscope', 'refresh');
    }

    function intro() {
        $data['list'] = $this->M_horoscope->intro_text();
        $data['body'] = 'horoscope_introtext';
        $this->load->view('admin/template', $data);
    }

    function intro_update() {
        $data['list'] = $this->M_horoscope->intro_text();
        $this->M_horoscope->edit_intro();
        $data['body'] = 'horoscope_introtext';
        $this->session->set_flashdata('message', 'Saved Successfully');
        redirect('admin/horoscope/intro', 'refresh');
    }

}

