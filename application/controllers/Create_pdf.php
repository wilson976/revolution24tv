<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Create_pdf extends CI_Controller {

    public function index()
    {
       if( $this->input->post('html')){
            $data['html']=$this->input->post('html');
            print_r($data['html']);
            exit();
            $this->load->view('pdf', $data);
        }
    }

}
