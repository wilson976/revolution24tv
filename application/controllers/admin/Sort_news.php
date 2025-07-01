<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sort_news extends CI_Controller {

    public $possition = array(
    "14" => "event_hr",
    "13" => "home_lead_hr",
    "21" => "selected_hr",
    "15" => "top_hr"
);

   public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
	    $this->load->model('admin/Mnews');
        $this->load->model('File_model');
       
    }

    function index() {
        $data['title'] = 'Arrange Slider News';
        $data['body'] = 'news/sort_news';
        $this->load->vars($data);
        $this->load->view('admin/template');
    }

    function arrangenews($id) {
        $data['title'] = 'Arrange Slider News';
        $data['possition'] = $id;
        $data['order'] = $this->possition[$id];
        $data['body'] = 'news/arrange_news';
        $data['slidernews'] = $this->SliderLeadNews($id);        
        $this->load->vars($data);
        $this->load->view('admin/template');
    }

    function orderupdate_slider(){
        $news_id = $_POST['news_id'];
        $n_order = $_POST['n_order'];
        $this->SliderorderUpdate($_POST['possition']);

        $this->File_model->common4all();
        $this->File_model->home1();
        $this->File_model->home2();
        
        $home_page = 'https://www.revolution24.tv';
        DeleteCache(md5($home_page));
        //echo md5($home_page);
        
         $home_page = 'https://www.revolution24.tv/';
        DeleteCache(md5($home_page));
        // echo md5($home_page);
        // exit;
        $home_page = 'https://www.revolution24.tv/index.php';
        DeleteCache(md5($home_page));
         //echo md5($home_page);
        //exit;
        
        $this->session->set_flashdata('message', 'Successfully updated');
        redirect('./admin/sort_news', 'refresh');
    }

    function SliderLeadNews($id) {
        $order = $this->possition[$id]." DESC, start_date DESC";
        $this->db->order_by($order);
        $this->db->like('n_position', $id);
        $this->db->where('n_status', 3);
        //$this->db->where('article_type', 1);
        // $this->db->where('n_order !=', 0);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(15);
        $q = $this->db->get('news');
        // print $this->db->last_query();
        // exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function SliderorderUpdate($hr) {

        $news_id = $_POST['news_id'];
        $n_order = $_POST['n_order'];
        for ($i = 0; $i < 14; $i++) {
        	if(isset($news_id[$i])){
	            $data = array(
	                $this->possition[$hr] => $n_order[$i]
	            );
	            $this->db->where('n_id', $news_id[$i]);
	            $this->db->update('news', $data);
        	}else{
        		break;
        	}
        }
        //print $this->db->last_query();
    }

    function all_cat(){
        $data['title'] = 'Arrange Slider News';
        $data['body'] = 'news/cat_news';
        $data['allcat'] = $this->Mnews->getcat();
        $this->load->vars($data);
        $this->load->view('admin/template');
    

    }

    function arrangeCatNews($cat_id) {
        $data['title'] = 'Arrange Slider News';
        $data['body'] = 'news/arrange_cat_news';
        $data['n_category'] = $cat_id;
        $data['slidercatnews'] = $this->Mnews->SliderCatNews($cat_id);
        $this->load->vars($data);
        $this->load->view('admin/template');
    }

    function arrangeCatNewsUpdate() {

        $news_id = $_POST['news_id'];
        $n_order = $_POST['n_order'];

        for ($i = 0; $i < count($news_id); $i++) {
            if ($n_order[$i]!='') {
                 $data = array(
                    'cat_slide' => $n_order[$i]
                );
                $this->db->where('n_id', $news_id[$i]);
                $this->db->update('news', $data);
            }
        }
        
        $this->File_model->common4all();
        $this->File_model->home1();
        $this->File_model->home2();
        
        $home_page = 'https://www.revolution24.tv';
        DeleteCache(md5($home_page));
         $home_page = 'https://www.revolution24.tv/';
        DeleteCache(md5($home_page));
        $home_page = 'https://www.revolution24.tv/index.php';
        DeleteCache(md5($home_page));
        
        
       redirect('./admin/sort_news/all_cat', 'refresh');
    }

}
