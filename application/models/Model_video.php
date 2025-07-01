<?php

class Model_video extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all() {
        // $this->db->limit(10);
        $q = $this->db->get('nrb_writer');
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            return $data;
        }
    }

    function get_by($id = '0') {
        $this->db->limit(1);
        $this->db->where('v_id', $id);
        $this->db->join('video_gallery_cat','video_gallery_cat.id=video_gallery.v_category');
        $q = $this->db->get('video_gallery');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            //print $this->db->last_query();
            return $data;
        }
    }

    function VdCatname($v_category) {
        $this->db->select('cat_name');
        $this->db->where('id', $v_category);
        $this->db->limit(1);
        $q = $this->db->get('video_gallery_cat');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            // echo $data['cat_name'];
            return $data;
        }
    }

    function get_by_cat($id) {
		$this->db->where('v_category',$id);
        $this->db->order_by('v_id','DESC');
        $q = $this->db->get('video_gallery');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            //print $this->db->last_query();
            return $data;
        }
    }

    function categoryName($id) {
	   $this->db->where('id',$id);
        $q = $this->db->get('video_gallery_cat');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            //print $this->db->last_query();
            return $data;
        }
    }

    function recent_video() {
        $this->db->limit(5);
        $this->db->order_by('v_id','DESC');
        $q = $this->db->get('video_gallery');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            //print $this->db->last_query();
            return $data;
        }
    }

    function most_populer() {
        $this->db->limit(8);
        $this->db->order_by('v_hit','DESC');
        $q = $this->db->get('video_gallery');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            //print $this->db->last_query();
            return $data;
        }
    }
    function related_video($tag='', $v_id='1') {
       
        if ($tag != "") {
            $rel = explode(',', $tag);
            foreach ($rel as $v) {
                $this->db->like('v_tag', $v);
                $this->db->where('v_id !=', $v_id);
                $this->db->where('start_date <=', date('Y-m-d H:i:s'));
                $this->db->order_by('v_id','DESC');
                $this->db->limit(5);
                $query = $this->db->get('video_gallery');
            }

            if ($query->num_rows() > 0) {
                $related_video = $query->result_array();
                return $related_video;
            }
            return NULL;
        }
    }


    function lead_video() {
        $this->db->limit(6);
        $this->db->order_by('v_id','DESC');
        $this->db->where('v_lead','1');
        $q = $this->db->get('video_gallery');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            //print $this->db->last_query();
            return $data;
        }
    }

    function video_by_cat($id, $limit='') {
        if($limit != ''){
            $this->db->limit($limit);
        }
        $this->db->order_by('v_id','DESC');
        $this->db->where_in('v_category', $id);
        $q = $this->db->get('video_gallery');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            //print $this->db->last_query();
            return $data;
        }
    }
    function video_cat() {
        $this->db->order_by('id','DESC');
        $this->db->where('v_parent','0');
        $q = $this->db->get('video_gallery_cat');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            //print $this->db->last_query();
            return $data;
        }
    }
	
	function GetSubCategorybyID($id) {
        $this->db->order_by('id','DESC');
        $this->db->where('v_parent',$id);
        $q = $this->db->get('video_gallery_cat');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            //print $this->db->last_query();
            return $data;
        }
    }
	
	function video_by_subcat($id = '') {        
        $this->db->limit(6);
        $this->db->order_by('v_id','DESC');
        $this->db->where('v_category', $id);
        $q = $this->db->get('video_gallery');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            //print $this->db->last_query();
            return $data;
        }
    }
    

}