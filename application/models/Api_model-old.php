<?php

class Api_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_details');
    }

///new start



    function get_topNews() {
        $this->db->select('n_id, n_head,main_image,start_date,n_details');
        $this->db->order_by("n_order ASC, start_date DESC");
        $this->db->like('n_position', 13);
        $this->db->where('n_status', 3);
        //$this->db->where('article_type', 1);
        $this->db->where('n_order !=', 0);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(15);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        $result = array();
        foreach ($q->result() as $value) {
            $arr = array();
            $arr['item_id'] = $value->n_id;
            $arr['featured_image'] = base_url('assets/news_images/mediam/' . $value->main_image);
            $arr['main_news_url'] = base_url('api/newsdetails/' . $value->n_id);
            $arr['title'] = strip_tags($value->n_head);
            $arr['datetime'] = $value->start_date;
            $arr['summery'] = splitText(strip_tags($value->n_details), 100);
            $arr['main_url'] = base_url('api/topnews/');
            $result[] = $arr;
        }
        return $result;
    }

    function newsdetails($nid) {
        $this->db->where('n_id', $nid);
        $q = $this->db->get('news');
        $value = $q->row();
                $arr['item_id'] = $value->n_id;
		$arr['featured_image'] = base_url('assets/news_images/mediam/' . $value->main_image);
		$arr['main_news_url'] = base_url('post/' . $value->n_id);
		$arr['title'] = strip_tags($value->n_head);
		$arr['datetime'] = $value->start_date;
		$arr['summery'] = $value->n_details;
		$arr['main_url'] = base_url('api/topnews/');

        return $arr;
        //return $value;
    }

    function getNews($cat_id) {

        $this->db->select('n_id, n_head,main_image,start_date,n_details,n_category');
        $this->db->order_by("n_order ASC, start_date DESC");
        $this->db->where('n_status', 3);
        $this->db->where('n_category', $cat_id);
        // $this->db->where('n_order !=', 0);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(15);
        $q = $this->db->get('news');
        $result = array();
        foreach ($q->result() as $value) {
            $arr = array();
            $arr['item_id'] = $value->n_id;
            $arr['featured_image'] = base_url('assets/news_images/mediam/' . $value->main_image);
            $arr['main_news_url'] = base_url('api/newsdetails/' . $value->n_id);
            $arr['title'] = strip_tags($value->n_head);
            $arr['datetime'] = $value->start_date;
            $arr['summery'] = splitText(strip_tags($value->n_details), 100);
            $arr['main_url'] = base_url('api/categorynews/' . $value->n_category);
            $result[] = $arr;
        }
        return $result;
    }

    function getTopNews() {
        //$this->db->select('n_id, n_head, main_image,start_date,n_details');
        $this->db->order_by("n_order ASC, start_date DESC");
        $this->db->like('n_position', 13);
        $this->db->where('n_status', 3);
        //$this->db->where('article_type', 1);
        $this->db->where('n_order !=', 0);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(15);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            // print_r($data);
            // exit();
            return $data;
        } else {
            return NULL;
        }
    }

    function getCatNews($m_id) {
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', '3');
        $this->db->where('article_type', 1);
        $this->db->order_by('start_date', 'desc');
        $this->db->limit(10);
        $q2 = $this->db->get('news');
        //print $this->db->last_query();
        foreach ($q2->result_array() as $row2) {
            echo '<div class="list_new">';
            echo '<div class="img"><img  alt="' . strip_tags($row2['n_head']) . '" src="./assets/news_images/thumbs/' . $row2['main_image'] . '"></div>';
            echo '<div class="title">';
            echo '<a href="apps/detailnews/'.$row2['n_id'].'" title=""><h2>';
            echo $row2['n_head'];
            echo "</h2></a><small>";
            echo $row2['start_date'];
            echo "</small>";
            //echo '</h2></a><small>2015-08-25 16:10:10</small>';
            //echo '<p>' . splitText(strip_tags($row2['n_details']), 200) . '</p>';
            echo '</div><div class="clr"></div></div> <!-- end list_new -->';
        }
    }


    // function detailnews($news_id){
    //     $this->db->where('n_id', $news_id);
    //     $this->db->where('n_status', '3');
    //     $this->db->order_by('start_date', 'desc');
    //     $this->db->limit(10);
    //     $q = $this->db->get('news');
    //     if ($q->num_rows() > 0) {
    //         $data = $q->row_array();
    //         return $data;
    //     } else {
    //         return NULL;
    //     }
    // }

}