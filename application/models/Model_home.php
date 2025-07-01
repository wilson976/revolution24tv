<?php

class Model_home extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_details');
    }

///new start

    function publish_date(){
        $date = $this->db->get('wsxq_p_dt');
        if($date->num_rows() > 0){
            return $date->row_array();
        } else {
            $date = NULL;
        }
    }
    
    function livenewsmore($n_id){
        $this->db->order_by('l_id', 'DESC');
        $this->db->where('ref_news', $n_id);
        $this->db->limit(5);
        $q = $this->db->get('live_news');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            // redirect();
            return NULL;
        }
    }

	
	
	public function electioncitycorp($type){
        $this->db->where('type', $type);
        $this->db->limit(1);
        $this->db->order_by('id', 'desc');
        $q = $this->db->get('wsxq_all_text');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;

        }
    }

    function getPrintCat() {
        $dt = $this->publish_date();
        $this->db->select('m.*');
        $this->db->where('n.n_date', $dt['pdt']);
        $this->db->where('m.m_status', 'active');
        $this->db->where('m.m_type', 'print');
        $this->db->from('news as n');
        $this->db->join('menu as m', 'n.n_category = m.m_id', 'left');
        $this->db->group_by('n.n_category');
        $this->db->order_by('m.m_tab', 'asc');
        $query = $this->db->get();
        // print $this->db->last_query();
        if ($query->num_rows() > 0){
            $data = $query->result_array();
            $query->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function getPrintCatNews($mid) {
        $dt = $this->publish_date();
        $this->db->order_by('n_order', 'ASC');
        $this->db->where('n_date', $dt['pdt']);
        $this->db->where('n_category', $mid);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }

    }

    function getCATLeadNews($n_category) {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->where($n_category);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(1);
        $q = $this->db->get('news');
// print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data['n_id'];
        } else {
            return NULL;
        }
    }

    function HeadlineNews() {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 16);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(8);
        $q = $this->db->get('news');
        //print $this->db->last_query(); exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function FooterTag() {
        $this->db->order_by('r_tag_id', 'desc');
        $data = $this->db->get('related_tags');
        if ($data->num_rows() > 0) {
            $q = $data->result_array();
            $data->free_result();
            return $q;
        } else {
            $data = NULL;
            return $data;
        }
    }
    
    function PhotoGalleries() {
        $this->db->order_by('p_id', 'DESC');
        // $this->db->group_by('p_category');
        $this->db->join('gallery_cat', 'gallery_cat.g_id = photo_gallery.p_category');
        $this->db->limit(10);
        $q = $this->db->get('photo_gallery');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
        return NULL;
    }
    
    function VideoCategoryname(){
        $this->db->order_by('id', 'ASC');
        $q = $this->db->get('video_gallery_cat');
         //print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function getTag($tag) {
        $this->db->like('related_tag_id', $tag);
        $this->db->order_by('start_date', 'DESC');
        $this->db->limit('5');
        $q = $this->db->get('news');
         //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function BreakingNews() {
        $this->db->order_by('s_id', 'desc');
        //$this->db->where('s_type', 'breaking');
        //$this->db->limit(1);
        $data = $this->db->get('scroll');
        //print $this->db->last_query();exit;
        if ($data->num_rows() > 0) {
            $q = $data->result_array();
            $data->free_result();
            return $q;
        } else {
            $data = NULL;
        }
    }
    
    
    function HomeAllNews_count(){
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->order_by('start_date', 'DESC');
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            $q->free_result();
            return $data;
        }
    }
    
    
    
    function HomeAllNews_perpage($limit=21){
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_status', '3');
        $this->db->where('article_type', 1);
        //$this->db->limit($limit);
        $q = $this->db->get('news', $limit, $this->uri->segment(2));
         //print $this->db->last_query();
        if (isset($q)) {
            if ($q->num_rows() > 0) {
                $data = $q->result_array();
                $q->free_result();
                return $data;
            }
        } else
            return NULL;
    }
    
    function HomeAllNews_countpost($titlen='',$catid='',$sdate='',$edate=''){
        if($titlen!=''){
            $this->db->like('n_head', $titlen);
        }
        if($catid>0){
            $this->db->where('n_category',$catid);
        }
        if($sdate!=''){
            if($edate==''){
                $this->db->where('n_date', $sdate);
            }else{
                $this->db->where('n_date >=', $sdate);
            }
        }
        if($edate!=''){
            if($sdate==''){
                $this->db->where('n_date', $edate);
            }else{
                $this->db->where('n_date <=', $edate);
            }
        }
        $this->db->where('article_type', 1);
        //$this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->order_by('start_date', 'DESC');
        $q = $this->db->get('news');
        //print $this->db->last_query(); exit;
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            $q->free_result();
            return $data;
        }
    }
    
    function HomeAllNews_perpagepost($limit=21,$titlen='',$catid='',$sdate='',$edate=''){
        
        $this->db->order_by('start_date', 'DESC');
        
        if($titlen!=''){
            $this->db->like('n_head', $titlen);
        }
        if($catid>0){
            $this->db->where('n_category',$catid);
        }
         if($sdate!=''){
            if($edate==''){
                $this->db->where('n_date', $sdate);
            }else{
                $this->db->where('n_date >=', $sdate);
            }
        }
        if($edate!=''){
            if($sdate==''){
                $this->db->where('n_date', $edate);
            }else{
                $this->db->where('n_date <=', $edate);
            }
        }
        $this->db->where('article_type', 1);
        $this->db->where('n_status', '3');
        //$this->db->limit($limit);
        $q = $this->db->get('news', $limit, $this->uri->segment(2));
        //print $this->db->last_query();
        if (isset($q)) {
            if ($q->num_rows() > 0) {
                $data = $q->result_array();
                $q->free_result();
                return $data;
            }
        } else
            return NULL;
    }
    
    
   



    function LeadNews() {
        $this->db->order_by("home_lead_hr DESC, start_date DESC");
        $this->db->like('n_position', 13);
        $this->db->where('n_status', 3);
//        $this->db->where('article_type', 1);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(9);
        $q = $this->db->get('news');
        // print $this->db->last_query(); exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    
	
	function LeadNews_more() {
        
        $this->db->order_by("home_lead_hr DESC, start_date DESC");
        $this->db->like('n_position', 13);
        $this->db->where('n_status', 3);
//        $this->db->where('article_type', 1);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(2,8);
        $q = $this->db->get('news');
        // print $this->db->last_query(); exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function HomeLeadNewsOther($n_id) {
        $this->db->order_by("home_lead_hr DESC, start_date DESC");
        $this->db->like('n_position', 13);
        $this->db->where('n_status', 3);
        $this->db->where('n_id !=', $n_id);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(5);
        $q = $this->db->get('news');
        // print $this->db->last_query(); exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }


    // function HomeNationalNews() {
    //     $this->db->where('n_category','1');
    //     $this->db->order_by('cat_slide', 'DESC');
    //     $this->db->like('n_position', 17);
    //     $this->db->where('n_status', 3);
    //     $this->db->where('start_date <=', date('Y-m-d H:i:s'));
    //     $this->db->limit(3);
    //     $q = $this->db->get('news');
    //     //print $this->db->last_query();
    //     if ($q->num_rows() > 0) {
    //         $data = $q->result_array();
    //         $q->free_result();
    //         return $data;
    //     } else {
    //         return NULL;
    //     }
    // }
    
    function HomeCrimeNews() {        
        $this->db->where('n_category','9');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(8);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    
   

    
    function HomeMedianews() {
        $this->db->where('n_category','8');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(4);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    
    function HomeSpecialNews() {
        $this->db->where('n_category','115');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(2);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    
     function HomeEurope() {
        $this->db->where('n_category','6');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(2);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function HomeEnglishNews() {
        $this->db->where('n_category','210');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(20);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function Homeculture() {
        $this->db->where('n_category','12');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(4);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function Hometop4news() {
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 14);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(4);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function Highlights() {
        //$this->db->where('n_category',$ncat);
        $this->db->order_by("selected_hr DESC, start_date DESC");
        //$this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 21);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(6);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function Editorschoise() {
        //$this->db->where('n_category',$ncat);
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 21);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(6);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    
    function HometopInterview() {
        $this->db->where('n_category','12');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 21);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(1);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    
    function HometopOpinion() {
        $this->db->where('n_category','11');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 21);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(1);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    
    
    function HomeInternational() {
        $this->db->where('n_category','4');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(5);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function HomenewsbyCat($n_cat) {
        if($n_cat== 3 || $n_cat == 215){
            $sub_cat = $this->Model_menu->getChildCategory($n_cat);
            $sub_cat = array_column($sub_cat, 'm_id');
            $cat_ids = [];
            $cat_ids = $sub_cat;
            $cat_ids[] = $n_cat;
            
            $condition ="(`n_category` IN('".implode("','",$cat_ids)."'))";
            $this->db->where($condition);
        }else{
            $this->db->where('n_category',$n_cat);
        }
        $this->db->order_by("cat_slide DESC, start_date DESC");
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(10);
        $q = $this->db->get('news');
        //print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    
    function Homeabroad() {
        $this->db->where('n_category','8');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(4);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function Homecolumns() {
        $this->db->where('n_category','62');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(3);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function HomeFoodies() {
        $this->db->where('n_category','3');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(3);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }


    function banner() {
        $this->db->select('end_date');
        $this->db->select('b_id');
        $this->db->order_by('b_tab', 'asc');
        $this->db->where('b_status', 'Active');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $r = $this->db->get('banner');
        //print $this->db->last_query();
        foreach ($r->result_array()as $row) {
            $this->db->order_by('b_tab', 'asc');
            $this->db->where('b_status', 'Active');
            $this->db->where('start_date <=', date('Y-m-d H:i:s'));
            if ($row['end_date'] != '1970-01-01 06:00:00') {
                $this->db->where('end_date >=', date('Y-m-d H:i:s'));
            }
            $q = $this->db->get('banner');
            // print $this->db->last_query();
            if ($q->num_rows() > 0) {
                $data = $q->result_array();
                $q->free_result();
                // print_r($data);
                // exit();
                return $data;
            } else {
                return NULL;
            }
        }
    }

    function HoroscopeDaily() {
        $this->db->order_by('h_id', 'asc');
        $q = $this->db->get('horoscope');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }


    function HomeTicker() {
        $this->db->select('m_id, m_name, m_bangla');
        $this->db->where('m_parent !=', 0);
        $this->db->where('m_status', 'active');
        $this->db->order_by('m_tab', 'asc');
        $this->db->limit(14);
        $q = $this->db->get('menu');
        //print $this->db->last_query();
        // print_r($q->result_array());
        if ($q->num_rows() > 0) {
            $menu = $q->result_array();
            $q->free_result();
            // return $data;
            //$data = [];
            $data = array();

            foreach ($menu as $value) {
                $this->db->select("n_id, n_date, n_head, n_details, main_image, start_date ");
                $this->db->order_by('start_date', 'DESC');
                $this->db->where('n_category', $value['m_id']);
                $this->db->where('n_status', 3);
                $this->db->where('article_type', 1);
                // $this->db->where('n_id !=', $n_id);
                $this->db->where('start_date <=', date('Y-m-d H:i:s'));
                $this->db->limit(1);
                $q = $this->db->get('news');
                $dd = $q->result_array();
                $q->free_result();
                if (isset($dd[0])) {
                    $dd[0]['m_name'] = $value['m_name'];
                    $dd[0]['m_bangla'] = $value['m_bangla'];
                    array_push($data, $dd[0]);
                }
            }
            return $data;
        }
    }
    
    
    
    function HomeTourism() {
		$this->db->where('n_category','11');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(6);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }


    function HomeSocialmedia() {
        $this->db->where('n_category','7');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(4);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }


    

    

    function Eventnews() {
        $this->db->order_by('event_hr', 'DESC');
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 14);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(4);
        $this->db->from('news');
        $this->db->join('menu', 'menu.m_id = news.n_category');
        $q = $this->db->get();
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    // function TopNews() {
    //     //$this->db->order_by('start_date', 'DESC');
    //     $this->db->order_by('top_hr', 'DESC');
    //     $this->db->like('n_position', 15);
    //     $this->db->where('n_status', 3);
    //     $this->db->where('start_date <=', date('Y-m-d H:i:s'));
    //     $this->db->limit(12);
    //     $this->db->from('news');
    //     $this->db->join('menu', 'menu.m_id = news.n_category');
    //     $q = $this->db->get();
    //     //print $this->db->last_query();
    //     if ($q->num_rows() > 0) {
    //         $data = $q->result_array();
    //         $q->free_result();
    //         return $data;
    //     } else {
    //         return NULL;
    //     }
    // }
    
    
    function TopNews() {
        $this->db->select('i.n_id,i.n_date,i.main_image,i.n_head,i.n_category,i.n_video,i.n_details,i.top_hr,i.start_date,i.end_date,i.n_position,i.n_status,i.update_time,m.m_bangla,m.m_id,m.m_name,m.m_type');
        //$this->db->order_by('i.start_date', 'DESC');
        $this->db->order_by('i.top_hr', 'DESC');
        $this->db->like('i.n_position', 15);
        $this->db->where('i.n_status', 3);
        $this->db->where('i.start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(12);
        $this->db->from('news as i');
        $this->db->join('menu as m', 'i.n_category = m.m_id', 'left');
        $q = $this->db->get();
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }


    function HomeLifestyle() {
        $this->db->where('n_category','3');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->where('n_status', 3);
        $this->db->like('n_position', 17);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(4);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }


    function HomeInternationalLead() {
        $this->db->where('n_category','7');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(1);
        $q = $this->db->get('news');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

     function HomeInternationalOther() {
        $where = "(n_category=7)";
        $n_id = $this->getCATLeadNews($where);
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->where($where);
        $this->db->where('n_status', 3);
        $this->db->like('n_position', 17);
        $this->db->where('n_id !=', $n_id);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(4);
        $q = $this->db->get('news');
        // print $this->db->last_query(); exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function LatestNews() {
        
        $this->db->where('latest_news', 'yes');
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->order_by('n_id', 'DESC');
        $this->db->limit(10);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function most_read($n_id) {
        $this->db->query('UPDATE news SET most_read = (most_read+1) WHERE n_id = '. $n_id);
        // print $this->db->last_query();
        // exit;
        
    }


    function most_read_count() {
        $this->db->where('n_status', 3);
       // $this->db->where('n_date', date('Y-m-d'));
        $this->db->where('most_read >', '0');
        $this->db->where("n_date >= DATE_SUB(NOW(),INTERVAL 2 DAY)", NULL, FALSE);
        $this->db->order_by("most_read desc, n_id desc");
        $this->db->limit(10);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }else{
            return NULL;
        }
        
    }

    function Feature() {
        $this->db->where('n_date', date('Y-m-d'));
        // $this->db->where("n_date >= DATE_SUB(NOW(),INTERVAL 1 DAY)", NULL, FALSE);
        $this->db->order_by("most_read desc, n_id desc");
        $this->db->limit(15);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function HomeChittagong() {
        $this->db->where('n_category','8');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->where('n_status', 3);
        $this->db->like('n_position', 17);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(3);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function HomeChannelSpecial() {
        $this->db->where('n_category','2');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->where('n_status', 3);
        $this->db->like('n_position', 17);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(20);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function HomeWritterNews() {
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_category', 11);
        $this->db->where('n_status', 3);
        $this->db->like('n_position', 17);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(5);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }


    function HomePhotoGallery() {
        $this->db->where('p_feature', '1');
        $this->db->order_by('p_id', 'DESC');
        $this->db->limit(10);
        $q = $this->db->get('photo_gallery');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

	
	function HomeBusiness() {
        $this->db->where('n_category','6');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(6);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    


    // function HomeDesh() {
    //     $this->db->select('n_id,n_date,main_image,n_head,n_category,cat_slide,n_video,n_position,n_status,start_date,end_date,article_type, SUBSTRING(CONVERT(`n_details` USING utf8), 1, 900) as n_details', FALSE);
    //     $this->db->where('n_category','5');
    //     $this->db->order_by('cat_slide', 'DESC');
    //     $this->db->where('n_status', 3);
    //     $this->db->like('n_position', 17);
    //     $this->db->where('start_date <=', date('Y-m-d H:i:s'));
    //     $this->db->limit(4);
    //     $q = $this->db->get('news');
    //     //print $this->db->last_query();
    //     if ($q->num_rows() > 0) {
    //         $data = $q->result_array();
    //         $q->free_result();
    //         return $data;
    //     } else {
    //         return NULL;
    //     }
    // }

        function Homeopinion() {
            $this->db->order_by('cat_slide', 'DESC');
            $this->db->where('n_category', 12);
            $this->db->where('n_status', 3);
            $this->db->like('n_position', 17);
            $this->db->where('start_date <=', date('Y-m-d H:i:s'));
            $this->db->limit(3);
            $q = $this->db->get('news');
            //print $this->db->last_query();
            if ($q->num_rows() > 0) {
                $data = $q->result_array();
                $q->free_result();
                return $data;
            } else {
                return NULL;
            }
    }

    function HomeSchedule() {
        $this->db->order_by('pro_time', 'ASC');
        $this->db->where('home_status', '1');
        $this->db->where('pro_date >=', date('Y-m-d'));
        $q = $this->db->get('program_schedule');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function HomeHealth() {
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->where('n_category', 12);
        $this->db->where('n_status', 3);
        $this->db->like('n_position', 17);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(2);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function HomeLaw() {
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->where('n_category', 117);
        $this->db->where('n_status', 3);
        $this->db->like('n_position', 17);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(1);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function HomeColumn() {
        $this->db->select('n_id,n_date,main_image,n_head,n_category,cat_slide,n_writer,n_video,n_position,n_status,start_date,end_date,article_type, SUBSTRING(CONVERT(`n_details` USING utf8), 1, 900) as n_details', FALSE);
        $this->db->distinct('n_writer');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->where('n_category', 11);
        $this->db->where('n_status', 3);
        $this->db->like('n_position', 17);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(6);
        $q = $this->db->get('news');
       // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function HomeCinta() {
        $dt = $this->publish_date();
        
        $this->db->order_by('n_id', 'DESC');
        $this->db->where('n_date', $dt['pdt']);
        $this->db->where('n_category', 58);
        $this->db->where('n_status', 3);
        $this->db->limit(5);
        $q = $this->db->get('news');
       // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function HomeEntertainment() {
        $this->db->where('n_category','10');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(4);
        $q = $this->db->get('news');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }


    function HoPolitics() {
        $this->db->where('n_category','5');
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(5);
        $q = $this->db->get('news');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    

    function poll() {
        $this->db->limit(1);
        $this->db->order_by('PK_PoolID', 'desc');
        $q = $this->db->get('opinion_pool');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        }
        return NULL;
        ;
    }


    function poll_vote($vote) {
        $this->db->limit(1);
        $this->db->order_by('PK_PoolID', 'desc');
        $q = $this->db->get('opinion_pool');
        $data2 = $q->num_rows();
        if ($data2 > 0) {
            $row = $q->row_array();
            $q->free_result();
            $sql = "UPDATE opinion_pool SET $vote = $row[$vote]+1 , PoolTotal = $row[PoolTotal]+1  WHERE PK_PoolID = $row[PK_PoolID]";
            $this->db->query($sql);
            $this->db->order_by('PK_PoolID', 'desc');
            $q2 = $this->db->get('opinion_pool');
            if ($q2->num_rows() > 0) {
                $data = $q2->result_array();
                $q2->free_result();
                return $data;
            }
        }
    }
    

    function get_totalVote_result() {
        // $this->db->limit(10);
        $q = $this->db->get('opinion_pool');
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            $q->free_result();
            return $data;
        }
    }

    function show_vote_perpage($limit) {
        $sql = 'SELECT * from opinion_pool ORDER BY PK_PoolID DESC ' . $limit;
        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
    }
    
    
    function HomeLeadVideo() {
        $this->db->order_by('v_id', 'DESC');
        $this->db->where('v_position', '1' );
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(2);
        $q = $this->db->get('video_gallery');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    

    function VideoCategorybyID() {
       $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->where('v_position', '1');
        $this->db->order_by('v_sort','DESC');
        $this->db->limit(5);
        $q = $this->db->get('video_gallery');
        //print $this->db->last_query();
		
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    
    function VideobyID($id) {
        $this->db->where('v_id', $id );
        $q = $this->db->get('video_gallery');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    
    function Allvideo($id) {
        $this->db->order_by('v_id', 'DESC');
        $this->db->where('v_id !=', $id );
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $q = $this->db->get('video_gallery');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function VideoCategoryall($id) {
        $this->db->order_by('v_id', 'DESC');
        $this->db->where('v_category', $id );
        //$this->db->where('v_lead', 1 );
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        //$this->db->limit(10);
        $q = $this->db->get('video_gallery');
       // print $this->db->last_query();exit;
		
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function Vidcatname($id){
        $this->db->where('id', $id);
        $this->db->limit(1);
        $q = $this->db->get('video_gallery_cat');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        }
    }
	
	
	function DailyNewsvideo() {
        $this->db->order_by('v_id', 'DESC');
		$this->db->where('v_category', '100000');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(10);
        $q = $this->db->get('video_gallery');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    
    
     function FooterVideo() {
        $this->db->order_by('v_id', 'DESC');
        $this->db->where('v_position', '1');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(4);
        $q = $this->db->get('video_gallery');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function getMenuname($n_category) {
        $this->db->select('m_bangla');
        $this->db->where('m_id', $n_category);
        $this->db->limit(1);
        $q = $this->db->get('menu');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data['m_bangla'];
        }
    }
    
    function getMenubangla($n_category) {
        $this->db->select('m_name');
        $this->db->where('m_id', $n_category);
        $this->db->limit(1);
        $q = $this->db->get('menu');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data['m_name'];
        }
    }

    function getColumnist($n_writer) {
        $this->db->select('p_name, p_pic');
        $this->db->where('p_id', $n_writer);
        $this->db->limit(1);
        $q = $this->db->get('profiles');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    function getColumnistName($n_writer) {
        $this->db->select('p_name');
        $this->db->where('p_id', $n_writer);
        $this->db->limit(1);
        $q = $this->db->get('profiles');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
             return $data['p_name'];
        }
    }


    function SpecialEvent() {
//check end date
        $this->db->select('end_date');
        $this->db->order_by('event_id', 'desc');
//        $this->db->where('event_status', '1');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(1);
        $r = $this->db->get('special_event');
        if ($r->num_rows() > 0) {
            $row = $r->row_array();
        } else {
            return NULL;
        }
        $this->db->order_by('event_id', 'desc');
        $this->db->where('event_status', '1');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        if ($row['end_date'] != '1970-01-01 06:00:00') {
            $this->db->where('end_date >=', date('Y-m-d H:i:s'));
        }
        $this->db->limit(1);
        $q = $this->db->get('special_event');
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function SpecialEventNews() {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 16);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(6);
        $q = $this->db->get('news');
//         print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            // print_r($data);
            // exit();
            return $data;
        } else {
            return NULL;
        }
    }
    
  

    
    
    function HomeHealth1111() {
        $this->db->where('n_category','8');
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_status', 3);
        $this->db->like('n_position', 17);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function InterView() {
        $this->db->select('n_id,n_date,main_image,n_head,n_author,n_author_other,n_category,cat_slide,n_video,n_position,n_status,start_date,end_date,article_type, SUBSTRING(CONVERT(`n_details` USING utf8), 1, 900) as n_details', FALSE);
        //$this->db->where('n_category','91');
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_status', 3);
        $this->db->like('n_position', 22);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(4);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
     function TimeofLastNews() {
        $this->db->select('update_time');
        $this->db->order_by('update_time', 'DESC');
        $this->db->limit(1);
        $q = $this->db->get('news');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        }else {
            return NULL;
        }
    }
	
	function rss() {
        $sql = 'SELECT *, DATE_FORMAT(post_time,"%a, %e %b %Y %T") as formatted_date FROM news WHERE `n_status` = 3 AND start_date <="' . date('Y-m-d H:i:s') . '" ORDER BY start_date DESC LIMIT 50';
        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

     function rssfb() {
         //$sql = 'SELECT news.*, `menu`.`m_bangla`, `menu`.`m_type`, `n_date`, DATE_FORMAT(post_time,"%a, %e %b %Y %T") as formatted_date FROM news JOIN `menu` ON `news`.`n_category`=`menu`.`m_id` WHERE  `news`.`n_position` LIKE "%19%" AND `news`.`n_status` = 3 AND `news`.`start_date` <="' . date('Y-m-d H:i:s') . '" ORDER BY start_date DESC LIMIT 5';
         $sql = 'SELECT news.*, `menu`.`m_bangla`, `menu`.`m_type`, `n_date`, DATE_FORMAT(post_time,"%a, %e %b %Y %T") as formatted_date FROM news JOIN `menu` ON `news`.`n_category`=`menu`.`m_id` WHERE  `news`.`n_status` = 3 AND `news`.`start_date` <="' . date('Y-m-d H:i:s') . '" ORDER BY start_date DESC LIMIT 5';
         $q = $this->db->query($sql);
         //print $this->db->last_query();
         if ($q->num_rows() > 0) {
             $data = $q->result_array();
             $q->free_result();
             return $data;
         }
         $q->free_result();
         return NULL;
     }
     
     function elecetion_seat($dist){
        $this->db->select('dist,seat');
        $this->db->where('dist', $dist);
        $this->db->group_by('seat');
        $q = $this->db->get('election_result');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
    }
    function elecetion_vote($seat, $dist){
        $this->db->select('party,vote');
        $this->db->where('dist', $dist);
        $this->db->where('seat', $seat);
        $this->db->order_by('vote','DESC');
        $q = $this->db->get('election_result');
        
        if ($q->num_rows() > 0) {
            echo '<div class="col-md-4 pieArea">
                <h2>আসন নং: '.$seat.'</h2>
                <ul data-pie-id="svg-'.$seat.'" class="details">';

            foreach ($q->result_array() as $value) {
                if($value['party']=='আওয়ামী লীগ'){
                    $src = '<img src="http://www.banglaoutlook.com/assets/images/election/awami_league.png">';
                }elseif($value['party']=='বিএনপি'){
                    $src = '<img src="http://www.banglaoutlook.com/assets/images/election/bnp.png">';
                }elseif($value['party']=='জাতীয় পাটি'){
                    $src = '<img src="http://www.banglaoutlook.com/assets/images/election/jatiya-party.png">';
                }elseif($value['party']=='স্বতন্ত্র'){
                    $src="স্বতন্ত্র";
                }else{
                    $src="অন্যান্য";
                }
                echo '<li data-value="'.$value['vote'].'"><span>'.$src.' ('.$value['vote'].')</span></li>';
            }

            echo '</ul>
                    <div class="svg" id="svg-'.$seat.'" style="width: 250px;"></div>
                </div>';
        }
    }
    
    function getCompactVote(){
        $data = $this->db->get('vote_result');
        if ($data->num_rows() > 0) {
            $q = $data->result_array();
            $data->free_result();
            return $q;
        } else {
            $data = NULL;
        } 
    }


}
