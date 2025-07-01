<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ads_rate extends CI_Controller {
    public function index() {
        $this->load->view('ads_rate');
    }

}
