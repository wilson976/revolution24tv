<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Photogallery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_menu');
        $this->load->model('Model_print');
        $this->load->model('Model_home');
        $this->load->model('Model_photogallery');
    }
    
    public function __destruct() {
        $this->db->close();
    }

    public function common4all() {
        $data['breakingnews'] = $this->Model_home->BreakingNews();
        $data['headllines'] = $this->Model_home->HeadlineNews();
        $data['latest_news'] = $this->Model_home->LatestNews();
        $data['most_read'] = $this->Model_home->most_read_count();
        $data['banner'] = $this->Model_home->banner();
        $data['horoscope'] = $this->Model_home->HoroscopeDaily();
        $data['ticker'] = $this->Model_home->HomeTicker();
        $data['online_menu'] = $this->Model_menu->create_Onlinemenu();
        $data['onlinemastHead_menu'] = $this->Model_menu->create_OnlineMastHeadmenu();
        $data['magazine_menu'] = $this->Model_menu->create_Magazinemenu();
        $data['pub_date'] = $this->Model_menu->pubdate_list();       
        $data['featurevid'] = $this->Model_home->FooterVideo();
        $data['lastNewsTime'] = $this->Model_home->TimeofLastNews();
        $data['footer_tag'] = $this->Model_home->FooterTag(); 
        $data['header_date'] = $this->Model_menu->topdate(); 
        $data['printmenu'] = $this->Model_menu->create_Printmenu(); 
        $this->load->vars($data);
    }

    public function index() {
        // echo $this->uri->segment(2);
        $data = array();
        $data['class'] = 'photogallery-home';
        // $data['photogallery'] = $this->Model_photogallery->PhotoGalleries(10);
        $config['base_url'] = base_url() .'photogallery';
        $config['total_rows'] = $this->Model_photogallery->search_total()-1;
        // print_r($config['total_rows'] );exit;
        $config['per_page'] = 11;
        $config['uri_segment'] = 2;        
        
        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';    
        $config["first_link"] = "&laquo;";
        $config["first_tag_open"] = "<li>";
        $config["first_tag_close"] = "</li>";
        $config["last_link"] = "&raquo;";
        $config["last_tag_open"] = "<li>";
        $config["last_tag_close"] = "</li>";
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '<li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '<li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        $limit = $config['per_page'];

        $data['links'] = $this->pagination->create_links();

        $data['photogallery'] = $this->Model_photogallery->PhotoGalleries($limit);
        
        $this->common4all();
        $this->output->cache(5);
        $this->load->vars($data);
        $this->load->view('template');
    }

    public function details($catid) {
        $data = array();
        $data['catname'] = $this->Model_photogallery->getCatName($catid);
        $data['allphoto'] = $this->Model_photogallery->GetPhotoByCategory($catid);
        $data['class'] = 'photogallery-details';
        $this->common4all();
        $this->output->cache(5);
        $this->load->vars($data);
        $this->load->view('template');
    }

}
