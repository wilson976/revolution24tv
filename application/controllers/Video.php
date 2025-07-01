<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Video extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_menu');
        $this->load->model('Model_print');
        $this->load->model('Model_pages');
        $this->load->model('Model_video');
        $this->load->model('Model_common4all');
    }
    
    public function __destruct() {
        $this->db->close();
    }

    

    public function index() {
        $data['class'] = 'video-home';
        $this->Model_common4all->common();
        $data['lead_video'] = $this->Model_video->lead_video();
        $data['recent_video'] = $this->Model_video->recent_video();
        $data['populer_video'] = $this->Model_video->most_populer();
        $data['v_cat'] = $this->Model_video->video_cat();
		//$data['video'][] = $this->Model_video->video_by_cat($cat['id'], 6);
        //print_r($v_cat);
        
        $this->load->view('template', $data);
    }
    

    public function show($id ='') {
        $query = 'UPDATE video_gallery SET  v_hit  =  v_hit  + 1 where v_id = '.$id;
        $query = $this->db->query($query);
        
        $data['class'] = 'video-post';
        $data['video'] = $this->Model_video->get_by($id);
        $data['getCatName'] = $this->Model_video->VdCatname($data['video']['v_category']);
        $data['recent_video'] = $this->Model_video->recent_video();
        $data['related_video'] = $this->Model_video->related_video($data['video']['v_tag'],$data['video']['v_id']);
        $this->Model_common4all->common();
        $this->load->view('template', $data);
    }

    public function cat($id ='') {
        $data['class'] = 'video-cat';
        $data['catname'] = $this->Model_video->categoryName($id);
        $data['video'] = $this->Model_video->get_by_cat($id);
		$data['subcat'] = $this->Model_video->GetSubCategorybyID($id);
        $data['recent_video'] = $this->Model_video->recent_video();
        $this->Model_common4all->common();
        $this->load->view('template', $data);
    }
    
    

}
