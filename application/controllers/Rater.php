<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rater extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ratings_model', 'ratings');
    }
    public function index() {
        $this->load->view('ratings/welcome_view');
    }

}
