<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $loggedin = $this->session->userdata('user_id');
        if (!isset($loggedin) or $loggedin == '') {
            redirect('hotpanel');
        }
        $this->load->model('File_model');
    }

    //Default Load
    public function index() {
        $data['body'] = 'welcome';
        //$data['premission'] = $this->M_admin_model->check_permission();
        $data['newslist'] = $this->M_admin_model->news_list();
        $data['total_unpublished'] = $this->M_admin_model->unpublished();
        $data['user'] = $this->M_admin_model->user_list();
        $this->load->view('admin/template', $data);
    }

    public function publishenews($n_id = '') {
        $return = $this->M_admin_model->publishenews($n_id);

        //cache delete
        $this->db->select('news.n_id, news.n_category,news.n_date, menu.m_bangla, menu.m_id');
        $this->db->from('news');
        $this->db->where('n_id', $n_id);
        $this->db->join('menu', 'news.n_category = menu.m_id');
        $menu_query = $this->db->get();
        $menu_row = $menu_query->row_array();
                    
        $home_page = 'http://www.banglaoutlook.com';
        DeleteCache(md5($home_page));
       
        $home_page = 'http://www.banglaoutlook.com/index.php';
        DeleteCache(md5($home_page));
      

        $home = base_url();
        DeleteCache(md5($home));

        $catNews = base_url() . $menu_row['m_bangla'];
        $catsNews = base_url() . $menu_row['m_bangla'].'/';
        $ParentcatNews = base_url() . $menu_row['m_bangla'].'/article';
        $ParentcatsNews = base_url() . $menu_row['m_bangla'].'/article/';

        DeleteCache(md5($catNews));
        DeleteCache(md5($catsNews));
        DeleteCache(md5($ParentcatNews));
        DeleteCache(md5($ParentcatsNews));

        $detailsNews = base_url() . $menu_row['m_bangla'] . '/' . str_replace('-', '/', $menu_row['n_date']) . '/' . $n_id;
        $detailNews = base_url() . $menu_row['m_bangla'] . '/' . str_replace('-', '/', $menu_row['n_date']) . '/' . $n_id.'/';
        DeleteCache(md5($detailNews));
        DeleteCache(md5($detailsNews));
        
        redirect('./admin/dashboard/', 'refresh');
        
    }
    public function unpublish($n_id = '') {
        $return = $this->M_admin_model->unpublishenews($n_id);
        //cache delete
        $this->db->select('news.n_id, news.n_category,news.n_date, menu.m_bangla, menu.m_id');
        $this->db->from('news');
        $this->db->where('n_id', $n_id);
        $this->db->join('menu', 'news.n_category = menu.m_id');
        $menu_query = $this->db->get();
        $menu_row = $menu_query->row_array();
                    
        $home_page = 'http://www.banglaoutlook.com';
        DeleteCache(md5($home_page));
       
        $home_page = 'http://www.banglaoutlook.com/index.php';
        DeleteCache(md5($home_page));
      

        $home = base_url();
        DeleteCache(md5($home));

        $catNews = base_url() . $menu_row['m_bangla'];
        $catsNews = base_url() . $menu_row['m_bangla'].'/';
        $ParentcatNews = base_url() . $menu_row['m_bangla'].'/article';
        $ParentcatsNews = base_url() . $menu_row['m_bangla'].'/article/';

        DeleteCache(md5($catNews));
        DeleteCache(md5($catsNews));
        DeleteCache(md5($ParentcatNews));
        DeleteCache(md5($ParentcatsNews));

        $detailsNews = base_url() . $menu_row['m_bangla'] . '/' . str_replace('-', '/', $menu_row['n_date']) . '/' . $n_id;
        $detailNews = base_url() . $menu_row['m_bangla'] . '/' . str_replace('-', '/', $menu_row['n_date']) . '/' . $n_id.'/';
        DeleteCache(md5($detailNews));
        DeleteCache(md5($detailsNews));

        redirect('./admin/dashboard/', 'refresh');
        
    }

     public function unpublished() {
        $data['body'] = 'unpublished';
        $data['newslist'] = $this->M_admin_model->unpub_news();
        $data['total_unpublished'] = $this->M_admin_model->unpublished();
        $this->load->view('admin/template', $data);
    }


    public function search(){
        //print_r($_POST);
        // exit;
        if (isset($_POST['token']) == 1) {
            $_SESSION["POST"] = $_POST;
        }
        $data['body'] = 'welcome';
        $data['user'] = $this->M_admin_model->user_list();
        $config['base_url'] = base_url() .'admin/dashboard/search';
        $config['total_rows'] = $this->M_admin_model->search_total('',$_SESSION["POST"]['start_date'], $_SESSION["POST"]['title'], $_SESSION["POST"]['end_date'], $_SESSION["POST"]['user'], $_SESSION["POST"]['status']);
        $config['per_page'] = 50;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $limit = $config['per_page'];
        $data['links'] = $this->pagination->create_links();
        $data['newslist'] = $this->M_admin_model->news_list($limit, $_SESSION["POST"]['title'], $_SESSION["POST"]['start_date'], $_SESSION["POST"]['end_date'], $_SESSION["POST"]['user'], $_SESSION["POST"]['status']);
        $data['total_unpublished'] = $this->M_admin_model->unpublished();
        $this->load->view('admin/template', $data);

    }

    //-> Pool Module Start

    function pool_list() {
        $data['body'] = 'pool';
        $data['pool'] = $this->M_admin_model->pool_list();
        $this->load->view('admin/template', $data);
    }

    function pool_entry() {
        $this->M_admin_model->pool_entry();
        $this->File_model->home1();
        $this->session->set_flashdata('message', 'New Opinion Added Successfully');
        redirect('admin/dashboard/pool_list');
    }

    function pool_edit_page($PK_PoolID) {
        $data['body'] = 'edit_pool';
        $data['pool'] = $this->M_admin_model->getpoolbyid($PK_PoolID);
        $this->load->view('admin/template', $data);
    }

    function pool_edit() {
        $this->M_admin_model->pool_edit();
        $this->File_model->home1();
        $this->session->set_flashdata('message', 'Openion Pool Successfully Updated');
        redirect('admin/dashboard/pool_list');
    }

    function pool_delete($PK_PoolID) {
        $this->M_admin_model->pool_delete($PK_PoolID);
        $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/dashboard/pool_list');
    }

    //->End Pool Module
    ///->Scroll News Start

    function scroll_list() {
        $data['body'] = 'scroll';
        $data['scroll'] = $this->M_admin_model->scroll_list();
        $this->load->view('admin/template', $data);
    }

    function scroll_entry() {
        $this->M_admin_model->scroll_entry();                   
        
        $this->File_model->common4all();
        
        $home_page = 'https://www.revolution24.tv/';
        DeleteCache(md5($home_page));
        // file_get_contents($home_page);
        $home_page = 'https://www.revolution24.tv/';
        DeleteCache(md5($home_page));
        $home_page = 'https://www.revolution24.tv/index.php';
        DeleteCache(md5($home_page));
        
        $this->session->set_flashdata('message', 'Scroll News Added Successfully');
        redirect('admin/dashboard/scroll_list');
    }

    function scroll_edit_page($s_id) {
        $data['body'] = 'edit_scroll';
        $data['scroll'] = $this->M_admin_model->getscrollbyid($s_id);
        $this->load->view('admin/template', $data);
    }

    function scroll_edit() {
        $this->M_admin_model->scroll_edit();                   
        
        
        $this->File_model->common4all();
        
        $home_page = 'https://www.revolution24.tv/';
        DeleteCache(md5($home_page));
        // file_get_contents($home_page);
        $home_page = 'https://www.revolution24.tv/';
        DeleteCache(md5($home_page));
        $home_page = 'https://www.revolution24.tv/index.php';
        DeleteCache(md5($home_page));
        
        $this->session->set_flashdata('message', 'Scroll News Successfully Updated');
        redirect('admin/dashboard/scroll_list');
    }

    function scroll_delete($s_id) {
        $this->M_admin_model->scroll_delete($s_id);                   
        
        $this->File_model->common4all();
        
        $home_page = 'https://www.revolution24.tv/';
        DeleteCache(md5($home_page));
        // file_get_contents($home_page);
        $home_page = 'https://www.revolution24.tv/';
        DeleteCache(md5($home_page));
        $home_page = 'https://www.revolution24.tv/index.php';
        DeleteCache(md5($home_page));
        
        $this->session->set_flashdata('message', 'Data Deleted');
        redirect('admin/dashboard/scroll_list');
    }

    ///->Scroll News End

    //______________________________comment_________________________________________________
    public function comments($type='app') {

        $data['body'] = 'comment';
        $config['base_url'] = base_url() .'admin/dashboard/comments/app';
        $config['total_rows'] = $this->M_admin_model->search_total_comments($type, '0');
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        if($this->uri->segment(4)=='web'){
            $config['uri_segment'] = 5;
            $config['base_url'] = base_url() .'admin/dashboard/comments/web';
        }
        $this->pagination->initialize($config);
        $limit = $config['per_page'];
        $data['links'] = $this->pagination->create_links();
        $data['comments'] = $this->M_admin_model->comments('0','', $type, $limit);

        $this->load->view('admin/template', $data);
    }
    
    public function approved_comments($type='app'){
        $data['body'] = 'a_comments';
        $data['comments'] = $this->M_admin_model->comments('1','', $type);
        $this->load->view('admin/template', $data);
    }
    public function comment_approve($id){
        //status = 1 where = $id
        $status = $this->M_admin_model->comment_approve($id);
        redirect($_SERVER['HTTP_REFERER']);
        //echo $id;
    }
    
    public function rejected_comments(){
        $data['body'] = 'a_comments';
        $data['base_url'] = base_url() .'admin/dashboard/comments';
        $data['comments'] = $this->M_admin_model->comments('2');
        $this->load->view('admin/template', $data);
    }
    public function comment_reject($id){
        //status = 2 where = $id
        $status = $this->M_admin_model->comment_reject($id);
        redirect($_SERVER['HTTP_REFERER']);
        //echo $id;
    }
    public function ajax_comment_find($status,$date){
        $data['comments'] = $this->M_admin_model->comments($status,$date);
        return $this->load->view('admin/a_comment', $data);
    }
//____________________________comment_____________________
}
