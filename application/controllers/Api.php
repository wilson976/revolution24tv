<?php

class Api extends CI_Controller {

    public function categorynews($category) {

        $this->load->model('Api_model');
        $news = array();
        $news = $this->Api_model->getNews($category);
        echo json_encode($news);
       
        //$this->api_model->getNews($category,$item_id);
    }

    public function topnews() {
        $this->load->model('Api_model');
        $news = $this->Api_model->get_topNews();
        echo json_encode($news);
    }

    public function newsdetails($news_id) {
        //$news_id = (int) $news_id;
        //$this->load->model('Api_model');
        //$this->load->model('Model_menu');
        //$data['getnewsby_id'] = $this->Api_model->newsdetails($news_id);
        //$data['getmenu'] = $this->Model_menu->getMenubyID($data['getnewsby_id']['n_category']);
        //echo json_encode($data);

        //$this->load->view('apps-newsdetails', $data);
        $this->load->model('Api_model');
        $this->load->model('Model_menu');
        $data['getnewsby_id'] = $this->Api_model->newsdetails($news_id);
        $data['getmenu'] = $this->Model_menu->getMenubyID($data['getnewsby_id']['n_category']);
        $this->load->view('apps-newsdetails', $data); 
    }
    public function detailnews($news_id) {
        $news_id = (int) $news_id;
        $this->load->model('Api_model');
        $this->load->model('Model_menu');
        $data['getnewsby_id'] = $this->Api_model->newsdetails($news_id);
        //$data['getmenu'] = $this->Model_menu->getMenubyID($data['getnewsby_id']['n_category']);

        echo json_encode($data);

        //$this->load->view('apps-newsdetails', $data);
        //$this->load->model('Api_model');
        //$this->load->model('Model_menu');
        //$data['getnewsby_id'] = $this->Api_model->newsdetails($news_id);
        //$data['getmenu'] = $this->Model_menu->getMenubyID($data['getnewsby_id']['n_category']);
        //$this->load->view('apps-newsdetails', $data); 
    }

}