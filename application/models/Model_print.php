<?php

class Model_print extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_details');
    }


    function find_tbl($dt) {
        $this->db->select('table_name');
        $this->db->where('p_dt', $dt);
        $this->db->limit(1);
        $q = $this->db->get('wsxq_date_arc');
        $tbl = $q->row_array();
        $q->free_result();
        if(isset($tbl['table_name']) && $tbl['table_name']!= ''){
            return $tbl['table_name'];
        }
        else{
            $table_name='news';
            return $table_name;
        }

        
    }

    ///new start
    
    function pubdate_list() {
        $data = $this->db->get('wsxq_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function pubdate_list_mag() {
        $data = $this->db->get('wsxq_m_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function getPrintMenu($dt) {
        $this->db->select('m.*');
        $this->db->where('n.n_date', $dt);
        $this->db->where('m.m_status', 'active');
        $this->db->where('m.m_type', 'print');        
        $this->db->where('m.m_id !=', 42);
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

    function PrintLeadNews($dt) {
        $this->db->like('n_position', 10);
        $this->db->where('n_date', $dt);
        $this->db->where('n_category', 42);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $this->db->limit(1);
        $q = $this->db->get('news');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            // redirect();
            return NULL;
        }
    }


    function Print_1stPageNews($n_id,$dt) {
        $n_id = ($n_id)?$n_id:0;
        $this->db->order_by('n_order', 'ASC');
        $this->db->where('n_date', $dt);
        $this->db->where('n_id !=', $n_id);
        $this->db->where('n_category', 42);
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


    function PrintcatLeadNews($mid,$dt) {
        $this->db->like('n_position', 10);
        $this->db->where('n_date', $dt);
         $this->db->where('n_category', $mid);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $this->db->limit(1);
        $q = $this->db->get('news');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            // redirect();
            return NULL;
        }
    }


    
    function PrintOtherNews($mid,$dt) {
        $where = "(n_position IS NULL OR n_position not like 10)";
        $this->db->where($where);
        $this->db->order_by('n_order', 'ASC');
        $this->db->where('n_date', $dt); 
        $this->db->where('n_category', $mid);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
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

    function most_read_count_print() {
        $dt = $this->pubdate_list();
        $this->db->where('n_date', $dt['pdt']);
        $this->db->where('article_type', 2);
        //$this->db->where("n_date >= DATE_SUB(NOW(),INTERVAL 1 DAY)", NULL, FALSE);
        $this->db->order_by("most_read desc, n_id desc");
        $this->db->limit(10);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function LeadNewsPrintversion() {
        $dt = $this->pubdate_list();
        $this->db->like('n_position', 10);
        $this->db->where('n_date', $dt['pdt']);
        $this->db->where('n_category', 13);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $this->db->limit(1);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            // redirect();
            return NULL;
        }
    }

    function Printversion_All_1stPageNews($n_id) {
        $n_id = ($n_id)?$n_id:0;
        $dt = $this->pubdate_list();
        $this->db->order_by('n_order', 'ASC');
        $this->db->where('n_date', $dt['pdt']);
        $this->db->where('n_id !=', $n_id);
        $this->db->where('n_category', 13);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $this->db->limit(8);
        $q = $this->db->get('news');
        ///print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function createHomeCat() {
        $dt = $this->pubdate_list();
        $this->db->select('m.*');
        $this->db->where('i.n_date', $dt['pdt']);
        $this->db->where('i.n_category !=', '13');
        $this->db->where('m.m_status', 'active');
        $this->db->where('m.m_type', 'print');
        $this->db->from('news as i');
        $this->db->join('menu as m', 'i.n_category = m.m_id', 'left');
        $this->db->group_by('i.n_category');
        $this->db->order_by('m.m_tab', 'asc');
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

    function SelectedNews() {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 14);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(10);
        $this->db->from('news');
        $this->db->join('menu', 'menu.m_id = news.n_category');
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

    function getCategoryLeadNews($m_id,$dt) {
        // $dt = $this->pubdate_list();
        $this->db->like('n_position', 10);
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('n_date', $dt);
        $this->db->where('article_type', 2);
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

  

    function getCategoryNews($m_id, $n_id, $dt) {
        $n_id = ($n_id)?$n_id:0;
        
        // $dt = $this->pubdate_list();
        
        $this->db->order_by('n_order', 'asc');
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('n_date', $dt);
        $this->db->where('article_type', 2);
        $this->db->where('n_id !=', $n_id);
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

    function related_news($n_id) {
        $n_id = ($n_id)?$n_id:0;
        $this->db->limit(1);
        $this->db->where('n_id', $n_id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            if ($data['related_tag_id'] != "") {
                $rel = explode(',', $data['related_tag_id']);
                foreach ($rel as $v) {
                    $this->db->like('related_tag_id', $v);
                    $this->db->where('n_id !=', $n_id);
                    $this->db->where('start_date <=', date('Y-m-d H:i:s'));
                    $this->db->where('n_status', 3);
                    $this->db->limit(5);
                    $query = $this->db->get('news');
                }

                if ($query->num_rows() > 0) {
                    $related_news = $query->result_array();
                    $query->free_result();
                    return $related_news;
                }
                return NULL;
            }
        }
    }

    function LatestNews() {
        $this->db->where('latest_news', 'yes');
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->order_by('n_id', 'DESC');
        $this->db->limit(20);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function most_read_count() {
        $this->db->where('article_type', 1);
        $this->db->where("n_date >= DATE_SUB(NOW(),INTERVAL 1 DAY)", NULL, FALSE);
        $this->db->order_by("most_read desc, n_id desc");
        $this->db->limit(20);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function HomenewsItem1() {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 12);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
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

    function HomenewsItem2() {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 12);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(6, 6);
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

    function HomeSportsNews() {
        $id = array('4', '37', '38', '39', '40', '41', '42', '43', '44', '45');
        $this->db->order_by('start_date', 'desc');
        $this->db->limit('12');
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->like('n_position', 18);
        $this->db->where_in('n_category', $id);
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

    function HomeEntertainmentNews() {
        $id = array('46', '47', '48', '49', '50', '51');
        $this->db->order_by('start_date', 'desc');
        $this->db->limit('6');
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->like('n_position', 18);
        $this->db->where_in('n_category', $id);
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

    function HomeEditorChoicce() {
        $this->db->order_by('start_date', 'desc');
        $this->db->limit('7');
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->like('n_position', 15);
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

    function HomePhotoNews() {
        $this->db->order_by('start_date', 'desc');
        $this->db->limit('10');
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->like('n_position', 16);
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

    function Horoscope() {
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

    function HomeBottomFeature() {
        $this->db->order_by('start_date', 'desc');
        $this->db->limit('10');
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->like('n_position', 17);
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

    function BreakingNews() {
        $this->db->order_by('s_id', 'desc');
        $data = $this->db->get('scroll');
        if ($data->num_rows() > 0) {
            $q = $data->result_array();
            $data->free_result();
            return $q;
        } else {
            $data = NULL;
        }
    }

    function HomeHindiSongs() {
        $this->db->where('n_category', 57);
        $this->db->order_by('n_id', 'desc');
        $this->db->limit(4);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function HomeMagCover() {
        $this->db->where('n_category', 58);
        $this->db->order_by('n_id', 'desc');
        $this->db->limit(4);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function HomeNews() {
        $this->db->where('home_page', 'yes');
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->not_like('n_position', 16);
        $this->db->not_like('n_position', 17);
        $this->db->limit(8);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function HomeNewsMore() {
        $this->db->where('home_page', 'yes');
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->not_like('n_position', 16);
        $this->db->not_like('n_position', 17);
        $this->db->limit(14, 8);
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

    function HomeGoodNews() {
        $this->db->like('n_position', 15);
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(2);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function HomeDialogueNews() {
        $this->db->where('n_category', 22);
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(5);
        $this->db->from('news');
        $this->db->join('profiles', 'profiles.p_id = news.n_writer');
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

    function DifferentNews() {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 18);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(3);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function last24hoursNews() {
        $this->db->select('n_id, n_head');
        $this->db->where("n_date >= DATE_SUB(NOW(),INTERVAL 2 DAY)", NULL, FALSE);
        $this->db->where('n_status', 3);
        $this->db->order_by('start_date', 'DESC');
        $this->db->limit(20);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function HomeLifeStyle() {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', 11);
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

    function HomeLifeStyleOther($n_id) {
        $n_id = ($n_id)?$n_id:0;
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_category', 11);
        $this->db->where('n_status', 3);
        $this->db->where('n_id !=', $n_id);
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

    function HomeBrave() {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', 13);
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

    function HomeBraveOther($n_id) {
        $n_id = ($n_id)?$n_id:0;
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_category', 13);
        $this->db->where('n_status', 3);
        $this->db->where('n_id !=', $n_id);
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

    function HomeEntertainment() {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', 4);
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

    function HomeEntertainmentOther($n_id) {
        $n_id = ($n_id)?$n_id:0;
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_category', 4);
        $this->db->where('n_status', 3);
        $this->db->where('n_id !=', $n_id);
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

    function HomeCountry() {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', 3);
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

    function HomeCountryOther($n_id) {
        $n_id = ($n_id)?$n_id:0;
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_category', 3);
        $this->db->where('n_status', 3);
        $this->db->where('n_id !=', $n_id);
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

    function HomeInternational() {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', 5);
        $this->db->where('n_status', 3);
        $this->db->limit(1);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
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

    function HomeInternationalOther($n_id) {
        $n_id = ($n_id)?$n_id:0;
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_category', 5);
        $this->db->where('n_status', 3);
        $this->db->where('n_id !=', $n_id);
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

    function HomePolitics() {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', 1);
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

    function HomePoliticsOther($n_id) {
        $n_id = ($n_id)?$n_id:0;
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_category', 1);
        $this->db->where('n_status', 3);
        $this->db->where('n_id !=', $n_id);
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

    ///Search Start
    function search_refreash($keyword) {
        $this->db->like('related_tag_id', $keyword);
        $this->db->or_like('n_head', $keyword);
        $this->db->order_by('start_date', 'DESC');
        $this->db->limit('5');
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function search_keyword($keyword, $limit) {
        $sql = 'SELECT * FROM (`news`) WHERE `related_tag_id` LIKE "%' . $keyword . '%" OR `n_details` LIKE "%' . $keyword . '%" OR `n_head` LIKE "%' . $keyword . '%" ORDER BY `start_date` DESC LIMIT ' . $limit;

        $q = $this->db->query($sql);
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
    }

    function search_keyword_total($keyword) {
        $this->db->like('related_tag_id', $keyword);
        $this->db->or_like('n_details', $keyword);
        $this->db->or_like('n_head', $keyword);
        $this->db->order_by('start_date', 'DESC');
        $q = $this->db->get('news');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            $q->free_result();
            return $data;
        }
    }

    ///Search End
    //
    //
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

///new end





    function banner() {
        $this->db->select('end_date');
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
            //print $this->db->last_query();
            if ($q->num_rows() > 0) {
                $data = $q->result_array();
                $q->free_result();
                return $data;
            } else {
                return NULL;
            }
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
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
            $sql = "UPDATE opinion_pool SET $vote = $row[$vote]+1 , PoolTotal = $row[PoolTotal]+1  WHERE PK_PoolID=$row[PK_PoolID]";
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

    function show_vote() {
        $this->db->order_by('PK_PoolID', 'desc');
        $q = $this->db->get('opinion_pool');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
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

///End Meta Query
    ////Archive
     ////Archive
    function getArchiveCat($n_date) {
        $n_date = replace_underscore($n_date);
        $this->db->group_by('n_category');
        $this->db->where('n_date', $n_date);
        $this->db->from('news');
        $this->db->join('menu', 'menu.m_id = news.n_category');
        $q = $this->db->get();
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
    }

    function arccatnews($n_category, $n_date) {
        $this->db->where('n_category', $n_category);
        $this->db->where('n_date', $n_date);
        $this->db->where('n_status', '3');
        $this->db->where('article_type', 1);
        $this->db->order_by('start_date', 'desc');
        $q2 = $this->db->get('news');
        //print $this->db->last_query();
        foreach ($q2->result_array() as $row2) {
            echo '<div class="latest_news_row">';
            echo '<div class="rig_img">';
            echo '<img alt="' . $row2['n_head'] . '" src="./assets/news_images/'.str_replace('-','/',$row2['n_date']).'/mob/' . $row2['main_image'] . '" class="img-responsive"></div>';
            echo '<h3>';
            echo '<a href="./post/' . $row2['n_id'] . '/' . replace_dashes($row2['n_head']) . '">';
            echo strip_tags($row2['n_head']);
            echo '</a></h3></div>';
        }
    }

    function dynamic_calendar() {
        $dt = $this->pubdate_list();
        $q = $this->db->query('SELECT DISTINCT `p_dt` FROM (`wsxq_date_arc`)WHERE `p_dt`!="' . $dt['pdt'] . '"');
        //$q = $this->db->query('SELECT DISTINCT `n_date` FROM (`news`)');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
           // print $this->db->last_query();
            return $data;
        }
        return NULL;
    }

    function archive_date($n_date) {
        $this->db->where('n_date', $n_date);
        $this->db->order_by('n_id', 'DESC');
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function PrintHomeCatNews($m_id) {
        $dt = $this->pubdate_list();
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', '3');
        $this->db->where('n_date', $dt['pdt']);
        $this->db->where('article_type', 2);
        $this->db->like('n_position', 10);
        $this->db->limit(1);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            //print $this->db->last_query();
            $row1 = $q->row_array();
            if ($row1['main_image'] != '') {
                echo '<div id="img" class="img-view">';
                echo '<img width="358" height="233" border="0" alt="' . strip_tags($row1['n_head']) . '" src="./assets/news_images/'.str_replace('-','/',$row1['n_date']).'/thumbnails/' . $row1['main_image'] . '" />';
                echo '</div>';
            }
            echo '<a href="'. $this->Model_home->getMenuname($row1['n_category']).'/'. datetoYear($row1['n_date']).'/'. datetomonth($row1['n_date']) . '/'. datetodate($row1['n_date']) . '/'. $row1['n_id'] .   '">';
            echo '<h1><div id="hl2"><font style="color:#005fbf">';
            echo $row1['n_head'];
            echo '</font></div></h1>';
            echo '</a>';
            echo '<div id="newsDtl">' . splitText(strip_tags($row1['n_details']), 300) . '</div>';
            echo '<div style="clear:both; height:0px; font-size:0px"></div>';


            echo '<ul class="ron_hl">';
            $this->db->where('n_category', $m_id);
            $this->db->where('n_status', '3');
            $this->db->where('n_id !=', $row1['n_id']);
            $this->db->where('n_date', $dt['pdt']);
            $this->db->where('article_type', 2);
            $this->db->limit(5);
            $this->db->order_by('n_order', 'asc');
            $q2 = $this->db->get('news');
            //print $this->db->last_query();
            foreach ($q2->result_array() as $row2) {
                echo '<li>';
                echo '<a href="'. $this->Model_home->getMenuname($row2['n_category']).'/'. datetoYear($row2['n_date']).'/'. datetomonth($row2['n_date']) . '/'. datetodate($row2['n_date']) .'/' . $row2['n_id'] . '"><font style="color:#005fbf">' . strip_tags($row2['n_head']) . '</font></a>';

                echo '</li>';
            }
            echo '</ul>';
        }
    }

    function getNewsbyID($cat_id, $n_year, $n_month, $n_date, $n_id) {
        $dt=$n_year.'/'.$n_month.'/'.$n_date;
       
        $tbl=$this->find_tbl($dt);
        
        $n_id = ($n_id)?$n_id:0;
        $date = $n_year.'-'.$n_month.'-'.$n_date;
        $this->db->where('n_id', $n_id);
        $this->db->where('n_category', $cat_id);
        $this->db->where('n_date', $date);
        $q = $this->db->get($tbl);
// print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        }
        // redirect('my404');
        return NULL;
    }

    function getMorenewsbyID($n_category, $n_id) {
        $n_id = ($n_id)?$n_id:0;
        if ($n_category == '28') {
            $dt = $this->pubdate_list_mag();
        } else {
            $dt = $this->pubdate_list();
        }
        $this->db->where('n_category', $n_category);
        $this->db->where('n_id !=', $n_id);
        $this->db->where('n_date', $dt['pdt']);
        $this->db->order_by('n_order', 'asc');
        $q = $this->db->get('news');
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

}