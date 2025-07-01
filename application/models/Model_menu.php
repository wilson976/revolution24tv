<?php

class Model_menu extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function find_tbl($dt) {
        $this->db->select('table_name');
        $this->db->where('p_dt', $dt);
        $this->db->limit(1);
        $q = $this->db->get('wsxq_date_arc');
        $tbl = $q->row_array();
        if (isset($tbl['table_name']) && $tbl['table_name'] != '') {
            return $tbl['table_name'];
        } else {
            $table_name = 'news';
            return $table_name;
        }
    }

    function createsubmenu($id) {
        $this->db->where('m_parent', $id);
        $this->db->where('m_status', 'active');
        $this->db->where('m_masthead', '1');
        $this->db->order_by('m_tab', 'asc');
        $data = $this->db->get('menu');
        // print $this->db->last_query();
        // exit;
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function get_parent_menu($id) {
        $this->db->where('m_parent', $id);
        $this->db->where('m_status', 'active');
        $data = $this->db->get('menu');
        // print $this->db->last_query();
        if ($data->num_rows() > 0) {
             return '/article';
        } else {
           return NULL;        
        }
    }

    function mag_pubdate_date($id) {
        $this->db->select('n_date');
        $this->db->order_by('n_id', 'DESC');        
        $this->db->where('n_category', $id);
        $data = $this->db->get('news');
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            $data = $data->row_array();
            return str_replace('-', '/',$data['n_date']);
        } else {
            return NULL;
        }
    }

    function mag_name($id) {      
        $this->db->where('m_id', $id);
        $q = $this->db->get('menu');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function MenuNews2($id) {
        if ($id == 'news') {
            $ids = array(6, 8, 9, 10, 11, 13);
        } elseif ($id == 'sports') {
            $ids = array(14, 15, 16);
        } elseif ($id == 'entertainment') {
            $ids = array(27, 28, 29, 30, 31, 32, 33, 34);
        } elseif ($id == 'lifestyle') {
            $ids = array(35, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 36);
        }

        $this->db->order_by('start_date', 'desc');
        $this->db->limit('4');
        $this->db->like('n_position', 12);
        $this->db->where('n_status', 3);
        $this->db->where_in('n_category', $ids);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

    

      
    
    function create_Onlinemenu() {
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'online');
        $this->db->where('m_parent', 0);
		$this->db->where('m_masthead', '1');
        $this->db->order_by('m_tab', 'asc');
        //$this->db->limit(12);
        $q = $this->db->get('menu');
         //print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            return $q->result_array();
            
        }else {
            return NULL;
        }
    }
    
    function create_footermenu() {
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'online');
        $this->db->order_by('m_tab', 'asc');
        $q = $this->db->get('menu');
         //print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            return $q->result_array();
            
        }else {
            return NULL;
        }
    }
    
    function create_Onlinemenu_more() {
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'online');
		$this->db->where('m_masthead', '1');
        $this->db->order_by('m_tab', 'asc');
        $this->db->limit(20,8);
        $q = $this->db->get('menu');
         //print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            return $q->result_array();
            
        }else {
            return NULL;
        }
    }
	
	function MegaMenuNews($cat) {
        $this->db->order_by('cat_slide', 'DESC');
        $this->db->where('n_category', $cat);
        $this->db->where('n_status', 3);
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

    function create_OnlineMastHeadmenu() {
        $this->db->where('m_parent', 0);
        $this->db->where('m_masthead', '1');
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'online');
        $this->db->order_by('m_tab', 'asc');
        $q = $this->db->get('menu');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            return $q->result_array();
            
        }else {
            return NULL;
        }
    }

    function create_Magazinemenu() {
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'magazine');
        $this->db->order_by('m_tab', 'asc');
        $q = $this->db->get('menu');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            return $q->result_array();
            
        }else {
            return NULL;
        }
    }
    

     function create_Printmenu() {
        $dt = $this->pubdate_list();
        $this->db->select('m.*');
        $this->db->where('i.n_date', $dt['pdt']);
        $this->db->where('m.m_status', 'active');
        $this->db->where('m.m_type', 'print');
        $this->db->from('news as i');
        $this->db->join('menu as m', 'i.n_category = m.m_id', 'left');
        $this->db->group_by('i.n_category');
        $this->db->order_by('m.m_tab', 'asc');
        $q = $this->db->get();
       // print_r($this->db->last_query()) ;
        if ($q->num_rows() > 0) {
           $data = $q->result_array();
           return $data;
        } else {
            return NULL;
        }
    }

    function getSubCategory() {
        $this->db->where('m_parent', 1);
        $this->db->where('m_type', 'online');
        $this->db->where('m_status', 'active');
        $this->db->order_by('m_id', 'asc');
        $q = $this->db->get('menu');
         // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }
  
    


    function pubdate_list() {
        $data = $this->db->get('wsxq_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    public function topdate($dt=''){
        if($dt==''){
            $dt = $this->pubdate_list();
        }
        
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->where('type', 'tdate');
        $this->db->limit(1);
        $this->db->order_by('id', 'desc');
        $q = $this->db->get('wsxq_all_text');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;

        }
    }

   

    function create_menuPrint_arc($dt) {
        $dt = str_replace("-", "/", $dt);
//        echo $dt;
        $tbl = $this->find_tbl($dt);
        $this->db->select('m.*');
        $this->db->where('i.n_date', $dt);
        $this->db->where('m.m_status', 'active');
        $this->db->where('m.m_type', 'print');
        $this->db->from($tbl . ' as i');
        $this->db->join('menu as m', 'i.n_category = m.m_id', 'left');
        $this->db->group_by('i.n_category');
        $this->db->order_by('m.m_tab', 'asc');
        $q = $this->db->get();
//        print $this->db->last_query();

        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $row) {
                echo '<li><a href="' . $row['m_bangla'] . '/' . $dt . '">' . $row['m_name'] . '</a></li>';
            }
        }
    }

    function MenuPrintversion() {
        $this->db->where('m_parent', 0);
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'print');
        $this->db->order_by('m_tab', 'asc');
        $q = $this->db->get('menu');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $row) {
                echo '<li><a href="';
                if ($row['m_parent'] == 0)
                    echo $row['m_bangla'];
                else {
                    echo $row['m_bangla'];
                }
                echo '">' . $row['m_name'] . '</a>';
            }
        }
    }

    function getAllMenu() {
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'online');
        $this->db->where('m_parent', '0');
        $this->db->order_by('m_tab', 'asc');
        $q = $this->db->get('menu');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function getMenufirst() {
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'online');
        $this->db->where('m_parent', '0');
        $this->db->limit(6);
        $this->db->order_by('m_tab', 'asc');
        $q = $this->db->get('menu');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function getMenusecond() {
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'online');
        $this->db->where('m_parent', '0');
        $this->db->limit(100, 6);
        $this->db->order_by('m_tab', 'asc');
        $q = $this->db->get('menu');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function getSubmenusfirst($cat_id) {
        $this->db->where('m_parent', $cat_id);
        $this->db->where('m_type', 'online');
        $this->db->order_by('m_id', 'asc');
        $this->db->limit(10);
        $data = $this->db->get('menu');
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getSubmenussecond($cat_id) {
        $this->db->where('m_parent', $cat_id);
        $this->db->where('m_type', 'online');
        $this->db->order_by('m_id', 'asc');
        $this->db->limit(10, 10);
        $data = $this->db->get('menu');
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getCategory($m_name) {
        $m_name = replace_underscore($m_name);
        $this->db->where('m_bangla', $m_name);
        //$this->db->where('m_type', 'online');
        //$this->db->or_where('m_type', 'other');
        $this->db->limit(1);
        $q = $this->db->get('menu');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        } else {
            return NULL;
        }
    }

    

    function nubSubCategory($m_id) {
        $this->db->where('m_parent', $m_id);
        $this->db->where('m_type', 'online');
        $q = $this->db->get('menu');
        if ($q->num_rows() > 0) {
            return $q->num_rows();
        } else {
            return NULL;
        }
    }

    function getCategoryArtculture($m_name) {
        $this->db->where('m_name', $m_name);
        $this->db->where('m_type', 'online');
        $this->db->limit(1);
        $q = $this->db->get('menu');
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
        } else {
            return NULL;
        }
        $this->db->where('m_id', $row['m_parent']);
        $this->db->where('m_type', 'online');
        $this->db->limit(1);
        $r = $this->db->get('menu');
        //print $this->db->last_query();
        if ($r->num_rows() > 0) {
            $data = $r->row_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function getMenubyID($n_category) {
        $this->db->where('m_id', $n_category);
        $this->db->limit(1);
        $q = $this->db->get('menu');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
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
            echo $data['m_bangla'];
        }
    }

    function getMenuID($n_category) {
        $this->db->select('m_id');
        $this->db->where('m_bangla', $n_category);
        $this->db->limit(1);
        $q = $this->db->get('menu');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data['m_id'];
        }
    }
    
    function MegaCategory($m_id){
        $this->db->order_by('start_date', 'DESC');
		$this->db->limit(6);
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $q = $this->db->get('news');
 //print $this->db->last_query();
 //exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
                $q->free_result();
            return $data;
        } else {
            $q->free_result();
            return NULL;
        }
    }
	
    function Mega_video() {
        $this->db->limit(6);
        $this->db->order_by('v_id','DESC');
        $q = $this->db->get('video_gallery');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            //print $this->db->last_query();
            return $data;
        }
    }


    function getChildCategory($parent_menu) {
        $this->db->where('m_type', 'online');
        $this->db->where('m_parent', $parent_menu);
        $this->db->where('m_status', 'active');
        $this->db->order_by('m_id', 'asc');
        $q = $this->db->get('menu');
         // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

}
