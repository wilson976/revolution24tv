<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

class ApiController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: access");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Credentials: true");
        header("Content-Type: application/json; charset=UTF-8");
        // if(isset($_GET['csrf_token'])){
        //     $csrf_token = preg_replace("/[^a-zA-Z0-9]/", "", $_GET['csrf_token']);
        //     if($this->security->get_csrf_hash()!==$csrf_token){
        //         exit;
        //     }
        // }else{
        //     exit;
        // }
        
        $this->load->model('Api_Model');
        $this->load->library('form_validation');
    }

    public function nav_online(){
       // set response code - 200 OK
        http_response_code(200);
        echo json_encode($this->Api_Model->model_nav_online(),JSON_HEX_TAG | JSON_HEX_AMP);
    }
    public function nav_print(){
       // set response code - 200 OK
        http_response_code(200);
        echo json_encode($this->Api_Model->model_nav_print(),JSON_HEX_TAG | JSON_HEX_AMP);
    }

    public function gethome(){
        $news['code'] = '200';
        $news['status'] = '1';
        $news['msg'] = 'OK';
        $news['lead_news'] = $this->Api_Model->lead_news();
        $news['print_cat_news'] = $this->Api_Model->print_cat_news();
        $news['get_online_cat_news'] = $this->Api_Model->get_online_cat_news();
        $news['latestNews'] = $this->Api_Model->latestNews();
        $news['mostread'] = $this->Api_Model->mostRead();
        $news['PhotoGallery'] = $this->Api_Model->PhotoGalleryHome();
        $news['VideoGallery'] = $this->Api_Model->VideoGallery();
        $news['dt'] = "ঢাকা, ".onlyDateconverterbangla( date('l, j F, Y') );
        
       // set response code - 200 OK
        http_response_code(200);
        
        echo json_encode($news,JSON_HEX_TAG | JSON_HEX_AMP);
    }

    public function sub_cat($category){
        // GET m_id by m_bangla
        $this->db->select('m_id');
        $this->db->where('m_status', 'active');
        $this->db->where('m_bangla', $category);
        $this->db->where('m_type', 'online');
        $n = $this->db->get('menu');
        $cat_id = $n->row_array();
        // GET Sub menu m_id
        $this->db->select('m_id,m_name,m_bangla');
        $this->db->where('m_status', 'active');
        $this->db->where('m_parent', $cat_id['m_id']);
        $this->db->where('m_type', 'online');
        $q = $this->db->get('menu');
        $cat = [];
        foreach ($q->result_array() as $value) {
            $news=[];
            $news['m_id']=$value['m_id'];
            $news['m_name']=$value['m_name'];
            $news['m_bangla']=$value['m_bangla'];
            $news['news'] = $this->Api_Model->getNews($value['m_id'],'',4);
            if (!empty($news['news'])) {
                $cat[] = $news;
            }
        }
        echo json_encode($cat,JSON_HEX_TAG | JSON_HEX_AMP);
    }

    public function categorynews($category, $page='') {   
        $news = array();
        $news['code'] = '200';
        $news['status'] = '1';
        $news['msg'] = 'OK';
        $news['paginator'] = NULL;
        $menu = $this->Api_Model->getMenu(str_replace('_','-',$category));
        if($menu['m_type']=='print' || $menu['m_type'] =='feature'){
            $cat= $this->Api_Model->PrintCatNews($menu['m_id'], $menu['m_type']);
        }else{
            $page = ($page=='')?1:$page;
            $par_page = 30;
            $nextPage = $page+1;
            $prevPage = $page-1;
            $total_news = $this->Api_Model->NewsCount($menu['m_id']);
            $pageCount=  ceil($total_news/$par_page);
            $news['paginator'] = array('records'=>$total_news,'page'=>$page,'pageCount'=>$pageCount,'limit'=>$par_page,'prevPage'=>$prevPage,'nextPage'=>$nextPage);
            $cat= $this->Api_Model->getNews($menu['m_id'], $page,$par_page);
        }
        $news['cat_news'] = $cat;
        $news['cat'] = $menu['m_bangla'];
        $news['cat_name'] = $menu['m_name'];
        $news['m_type'] = $menu['m_type'];
        
       // set response code - 200 OK
        http_response_code(200);
        
        echo json_encode($news,JSON_HEX_TAG | JSON_HEX_AMP);
    }

    public function details($n_cat, $n_year, $n_month, $n_date, $n_id){
        $dt = $n_year . '-' . $n_month . '-' . $n_date;
        $db = & DB();
        $db->select('m_id,m_bangla,m_name');
        $db->from('menu');
        $db->where('m_bangla', str_replace('_','-',$n_cat));
        $query = $db->get();
        $q = $query->row();
        $cat_id='';
        if ($query->num_rows() == 0){
           echo json_encode("Empty");
           exit;
        }else{
            $cat_id = $q->m_id;
        }
        $get_data = $this->Api_Model->getNewsbyID($n_id);
        $data['test'] = '1';
        $get_data['n_details'] = stripslashes($get_data['n_details']);
        $data['getnews'] = $get_data;
        $data['getnews']['m_bangla'] = $q->m_bangla;
        $data['getnews']['m_name'] = $q->m_name;
        $data['getnews']['writer_name'] = $this->Api_Model->getWriter($get_data['n_writer']);
        
        $data['comments'] = $this->Api_Model->comments($n_id);
        
        $data['related'] = $this->Api_Model->related_news($n_id);
            $data['related_title'] = 'সংশ্লিষ্ট সংবাদ';
        
        if($data['related'] == NULL){
        if($data['getnews']['article_type']==1){
            $data['cat_title'] = 'এই পাতার আরো খবর ';
            $data['Cat_more_news'] = $this->Api_Model->getMorenewsbyCat_online($data['getnews']['n_category'], $n_id);
        }else{  
            $data['cat_title'] = 'এই পাতার আরো খবর ';
            $data['Cat_more_news'] = $this->Api_Model->getMorenewsbyCat($data['getnews']['n_category'], $n_id, $dt);
        }
        }
        
        $this->Api_Model->hit_count($n_id);
        
       // set response code - 200 OK
        http_response_code(200);
        
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }
    public function appsdetails($n_id){
        $get_data = $this->Api_Model->getNewsbyID($n_id);
        $get_data['n_details'] = stripslashes($get_data['n_details']);
        $data['getnews'] = $get_data;
        $data['comments'] = $this->Api_Model->comments($n_id);
        
        $db = & DB();
        $db->select('m_id,m_bangla,m_name');
        $db->from('menu');
        $db->where('m_id', $get_data['n_category']);
        $query = $db->get();
        $q = $query->row();
        $data['getnews']['news_url'] = 'http://www.banglaoutlook.com/'.$q->m_bangla.'/'.str_replace('-','/',$get_data['n_date']).'/'.$n_id;
        
       // set response code - 200 OK
        http_response_code(200);
        
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function photogalleryhomepage() {
        $data=$this->Api_Model->PhotoGalleryHome(30);
        
       // set response code - 200 OK
        http_response_code(200);
        
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }
    public function PhotoGalleryDetails($cat) {
        $this->db->where('p_category', $cat);
        $this->db->join('gallery_cat', 'photo_gallery.p_category = gallery_cat.g_id');
        $q = $this->db->get('photo_gallery');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $arr = $q->result_array();
            $data['gallery'] = $arr;
            $data['category'] = $arr[0]['g_cat'];
            $data['g_id'] = $arr[0]['g_id'];
            $data['meta_desc'] = $arr[0]['meta_description'];
            $data['meta_keyword'] = $arr[0]['meta_keyword'];
        }else{
            $data=[];
        }
        
       // set response code - 200 OK
        http_response_code(200);
        
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function videohomepage(){
        $data = $this->Api_Model->VideoGallery(30);
        
       // set response code - 200 OK
        http_response_code(200);
        
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function videoshowpage($vid){
        $news['code'] = '200';
        $news['status'] = '1';
        $news['msg'] = 'OK';
        $news['vid'] = $vid;
        $data['play'] = $this->Api_Model->getvideo($vid);
        $data['play_category'] = $data['play']['cat_name'];
        $data['more'] = $this->Api_Model->more_video($vid);
        
        // set response code - 200 OK
        http_response_code(200);
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP);
    }

    public function comment(){
        $value = array(
            'full_name' => ($this->input->get('full_name')=='undefined')?'':$this->input->get('full_name'),
            'email' => ($this->input->get('email')=='undefined')?'':$this->input->get('email'),
            'comment_text' => ($this->input->get('comment_text')=='undefined')?'':$this->input->get('comment_text'),
            'n_id' => ($this->input->get('n_id')=='undefined')?'':$this->input->get('n_id')
        );

        $this->form_validation->set_data($value);
        
        $this->form_validation->set_rules('full_name', 'Name', 'trim|required|xss_clean|min_length[3]|max_length[50]|alpha|encode_php_tags|prep_for_form');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|min_length[6]|max_length[80]|encode_php_tags|prep_for_form');
        $this->form_validation->set_rules('comment_text', 'Comment Text', 'trim|required|xss_clean|encode_php_tags|prep_for_form');

        if ($this->form_validation->run() == TRUE) {

            $this->db->where('email', $value['email']);
            $this->db->limit(1);
            $q = $this->db->get('user');

            if ($q->num_rows() > 0) {
                $dd = $q->row_array();
                $data['user_id'] = $dd['id'];
                $q->free_result();
            } else {
                $user['full_name'] = $value['full_name'];
                $user['email'] = $value['email'];
                $user['device_type'] = 'mob';
                $this->db->insert('user', $user);
                $uid = $this->db->insert_id();
                $data['user_id'] = $uid;
            }

            $data['news_id'] = $value['n_id'];
            $data['comment_text'] = $value['comment_text'];
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['status'] = '0';
            $data['type'] = 'mob';
            $this->db->insert('commennt', $data);

            $msg = "<div class='success-msg'><p>আপনার মন্তব্য সফলভাবে সম্পন্ন হয়েছে.</p></div>";
            $data = [
                    'msg'=>$msg,
                    'status'=>'1'
                ];
                
           // set response code - 200 OK
            http_response_code(200);
        
            echo json_encode($data, JSON_UNESCAPED_SLASHES);

        }else{
            $msg = '<div class="error-msg">';
            if (form_error('full_name')) {
                $msg .= form_error('full_name');
            }
            if (form_error('email')) {
                $msg .= form_error('email');
            }
            if (form_error('comment_text')) {
                $msg .= form_error('comment_text');
            }
            $msg .= '</div>';
            $data = [
                    'msg'=>$msg,
                    'status'=>'0'
                ];
                
           // set response code - 200 OK
            http_response_code(200);
        
            echo json_encode($data, JSON_UNESCAPED_SLASHES);
        }
    }
    
    public function appsearch($getvalue){
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
       // set response code - 200 OK
        http_response_code(200);
        
        echo json_encode($getvalue);
        // $input = file_get_contents('php://input');
        // $data = json_decode($input,true);
        exit;
        
        
        $value = array(
            'text' => ($getvalue=='undefined')?'':$getvalue
        );
        $this->form_validation->set_data($value);
        $this->form_validation->set_rules('text', 'Text', 'trim|required|xss_clean|encode_php_tags|prep_for_form');
        
        if ($this->form_validation->run() == TRUE) {
            $this->db->select('n_id, n_head, n_status');
            $this->db->where('n_status', 3);
            $this->db->like('n_head', $value['text']);
            $this->db->order_by('n_id', 'DESC');
            $this->db->limit(12);
            $this->db->from('news');
            // $this->db->join('menu', 'menu.m_id = news.n_category');
            $q = $this->db->get();
            // print $this->db->last_query();exit;
            $arr['data'] = $q->result_array();
            $arr['status'] = 1;
        }else{
            $arr['data'] = 'Empty';
            $arr['status'] = 0;
        }
        
       // set response code - 200 OK
        http_response_code(200);
        
        echo json_encode($arr, JSON_HEX_TAG | JSON_HEX_AMP);
    }


}