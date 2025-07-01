<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_pages');
        $this->load->model('Model_menu');
        $this->load->model('Model_print');
        $this->load->model('ratings_model', 'ratings');
        $this->load->model('Model_common4all');
        $this->load->model('File_model');
    }
    
    public function __destruct() {
        $this->db->close();
    }

  

    // public function details($n_cat, $n_year, $n_month, $n_date, $n_id) {
    //     //$n_year = ''; $n_month=''; $n_date=''; 
    //     $dt = $n_year . '-' . $n_month . '-' . $n_date;
    //      // echo $dt;exit;
    //     $data = array();
    //     $data['dt'] = $dt;
    //     $data['getcat'] = $this->Model_menu->getCategory($n_cat);
    //     $data['class'] = 'post';
    //     //echo $n_cat;
    //     $db = & DB();
    //     $db->select('m_id');
    //     $db->from('menu');
    //     $db->where('m_bangla', str_replace('_', '-', $n_cat));
    //     $query = $db->get();
    //     $q = $query->row();
    //     $cat_id = '';
    //     if ($query->num_rows() == 0) {
    //         redirect('/my404');
    //     } else {
    //         $cat_id = $q->m_id;
    //     }
    //     $data['getnewsby_id'] = $this->Model_pages->getNewsbyID($cat_id, $n_id,$dt);
    //     $data['getmenu'] = $this->Model_menu->getMenubyID($data['getnewsby_id']['n_category']);
        
    //     $data['menu_name'] = $data['getmenu']['m_bangla'];

    //     if($data['getnewsby_id']['article_type']==1){
    //         $data['Cat_more_news'] = $this->Model_pages->getMorenewsbyCat_online($data['getnewsby_id']['n_category'], $n_id);
    //     }else{
    //         $data['Cat_more_news'] = $this->Model_pages->getMorenewsbyCat($data['getnewsby_id']['n_category'], $n_id, $dt);
    //     }
    //     $data['related'] = $this->Model_pages->related_news($n_id, $dt);
    //     // print_r($data['Cat_more_news']);
    //     $data['comments'] = $this->Model_pages->comments($n_id);
        
    //     $data['next'] = $this->Model_details->next($n_id, $data['getnewsby_id']['n_category']);
    //     $data['previous'] = $this->Model_details->previous($n_id, $data['getnewsby_id']['n_category']);
        
        
    //     $this->Model_common4all->common();
    //     $this->output->cache(10);
    //     $this->load->view('template', $data);
    // }
    
    
    public function details($n_cat, $n_year, $n_month, $n_date, $n_id) {
        $dt = $n_year . '-' . $n_month . '-' . $n_date;
        $details = $this->File_model->readfile($n_id,$dt);
        
        
        //echo $details['n_status'];
        
        if($details == NULL || $details['n_status'] !='3'){
            
            $cat = $this->Model_menu->getCategory($n_cat);
            
            $details = $this->Model_pages->getNewsbyID($cat['m_id'], $n_id,$dt);
            if($details == NULL || $details['n_status'] !='3'){
                echo '<meta http-equiv="refresh" content="0; url=https://www.revolution24.tv/404" />';
                exit;
                //  redirect('/my404'); 
                
            }
        }
        if($details['article_type']=='2'){
            if($details['n_category']=='108' OR $details['n_category']=='117'){
                $print_date['dt'] = $this->Model_print->pubdate_list_mag(); 
                if($dt > $print_date['dt']['pdt']){
                    echo '<meta http-equiv="refresh" content="0; url=https://www.revolution24.tv/404" />';
                    exit; 
                }
            }else{
                $print_date['dt'] = $this->Model_print->pubdate_list();
                if($dt > $print_date['dt']['pdt']){
                    echo '<meta http-equiv="refresh" content="0; url=https://www.revolution24.tv/404" />';
                    exit; 
                }
            }
        }
        $data = array();
        $data = $this->File_model->readCommon();
        $data['dt'] = $dt;
        $data['getcat'] = findMenuinfo($n_cat);
        $data['class'] = 'post';
        $data['editorchoise'] = $this->Model_home->Editorschoise();
        
        
        $data['getnewsby_id'] = $details;
        $data['getmenu'] = findMenu($data['getnewsby_id']['n_category']);
        $data['livenews'] = $this->Model_pages->livenewsmore($n_id);
        
        $data['menu_name'] = $data['getmenu']['m_bangla'];

        if($data['getnewsby_id']['article_type']==1){
            // $data['Cat_more_news'] = $this->Model_pages->getMorenewsbyCat_online($data['getnewsby_id']['n_category'], $n_id);
            $data['Cat_more_news'] = $this->File_model->read_morenews($n_cat);
        }else{
            $data['Cat_more_news'] = $this->Model_pages->getMorenewsbyCat($data['getnewsby_id']['n_category'], $n_id, $dt);
        }
        
        $data['related'] = $this->Model_pages->related_news($n_id, $dt);
        // print_r($data['Cat_more_news']);
        $data['comments'] = $this->Model_pages->comments($n_id);
        
        // $data['next'] = $this->Model_details->next($n_id, $data['getnewsby_id']['n_category']);
        // $data['previous'] = $this->Model_details->previous($n_id, $data['getnewsby_id']['n_category']);
        
        // $this->Model_common4all->common();
        $this->output->cache(10);
        $this->load->view('template', $data);
    }
    
    
    public function details1($slug) {
        $newsdetails = $this->Model_pages->getNewsbyID1($slug);
        
        
        $dt = $newsdetails['n_date'];
        $n_id = $newsdetails['n_id'];
        
        $details = $this->File_model->readfile($n_id,$dt);
        
        
        //echo $details['n_status'];
        
        if($details == NULL || $details['n_status'] !='3'){
            
            $cat = $this->Model_menu->getCategory($n_cat);
            
            $details = $this->Model_pages->getNewsbyID($cat['m_id'], $n_id,$dt);
            if($details == NULL || $details['n_status'] !='3'){
                echo '<meta http-equiv="refresh" content="0; url=https://www.revolution24.tv/404" />';
                exit;
                //  redirect('/my404'); 
                
            }
        }
        if($details['article_type']=='2'){
            if($details['n_category']=='108' OR $details['n_category']=='117'){
                $print_date['dt'] = $this->Model_print->pubdate_list_mag(); 
                if($dt > $print_date['dt']['pdt']){
                    echo '<meta http-equiv="refresh" content="0; url=https://www.revolution24.tv/404" />';
                    exit; 
                }
            }else{
                $print_date['dt'] = $this->Model_print->pubdate_list();
                if($dt > $print_date['dt']['pdt']){
                    echo '<meta http-equiv="refresh" content="0; url=https://www.revolution24.tv/404" />';
                    exit; 
                }
            }
        }
        $data = array();
        $data = $this->File_model->readCommon();
        $data['dt'] = $dt;
        $data['getcat'] = findMenuinfo($n_cat);
        $data['class'] = 'post';
        
        
        
        $data['getnewsby_id'] = $details;
        $data['getmenu'] = findMenu($data['getnewsby_id']['n_category']);
        
        $data['menu_name'] = $data['getmenu']['m_bangla'];

        if($data['getnewsby_id']['article_type']==1){
            // $data['Cat_more_news'] = $this->Model_pages->getMorenewsbyCat_online($data['getnewsby_id']['n_category'], $n_id);
            $data['Cat_more_news'] = $this->File_model->read_morenews($n_cat);
        }else{
            $data['Cat_more_news'] = $this->Model_pages->getMorenewsbyCat($data['getnewsby_id']['n_category'], $n_id, $dt);
        }
        
        $data['related'] = $this->Model_pages->related_news($n_id, $dt);
        // print_r($data['Cat_more_news']);
        $data['comments'] = $this->Model_pages->comments($n_id);
        
        // $data['next'] = $this->Model_details->next($n_id, $data['getnewsby_id']['n_category']);
        // $data['previous'] = $this->Model_details->previous($n_id, $data['getnewsby_id']['n_category']);
        
        // $this->Model_common4all->common();
        $this->output->cache(10);
        $this->load->view('template', $data);
    }
    
    

    function tag_topics($tag_name = ''){
        $data['class'] = 'tag_news';
        $data['gettagnews_name'] = $this->Model_details->getTagNews($tag_name);
        $this->Model_common4all->common();
        $this->load->view('template', $data);

    }
    
    public function c_submit($massage = ''){
                $this->form_validation->set_rules('comment_text', 'trim|Comment text', 'required|xss_clean|encode_php_tags|prep_for_form');
                $this->form_validation->set_rules('uname', 'Name', 'trim|required|xss_clean|min_length[3]|max_length[50]|alpha|encode_php_tags|prep_for_form');
                $this->form_validation->set_rules('email', 'Email', 'valid_email', 'trim|required|xss_clean|min_length[6]|max_length[80]|encode_php_tags|prep_for_form');
                if ($this->form_validation->run() == TRUE) {
                   //var_dump($cookie); exit;
                    //print_r($this->input->post()); exit;
                    $this->db->where('email', $this->input->post('email'));
                    $this->db->limit(1);
                    $q = $this->db->get('user');
                    if ($q->num_rows() > 0) {
                        $dd = $q->row_array();
                        $data['user_id'] = $dd['id'];
                        $q->free_result();
                    } else {
                        $user['full_name'] = $this->input->post('uname');
                        $user['email'] = $this->input->post('email');
                        $user['device_type'] = 'web';
                        $this->db->insert('user', $user);
                        $uid = $this->db->insert_id();
                        $data['user_id'] = $uid;
                        $q->free_result();
                        // return NULL;
                    }

                    $cookie_name = "comments_info";
                    $cookie_value = ['uname'=>$this->input->post('uname'),'email'=>$this->input->post('email')];
                    setcookie($cookie_name, serialize($cookie_value), time() + (86400 * 1), "/"); // 86400 = 1 day

                    $data['news_id'] = $this->input->post('n_id');
                    $data['comment_text'] = $this->input->post('comment_text');
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['status'] = '0';
                    $data['type'] = 'web';
                    if($this->input->post('cid')){
                        $data['parent'] = $this->input->post('cid');
                    }
                    //print_r($data); exit;
                    $this->db->insert('commennt', $data);
                    // redirect($_SERVER['HTTP_REFERER']);
                    
                }else{
                    // echo "error"; exit;
                    $this->session->set_flashdata('error', 'Please use a valid Name and Email...');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            
        
        $this->session->set_flashdata('error', 'Please check the captha box');
        redirect($_SERVER['HTTP_REFERER']);
    }

}
