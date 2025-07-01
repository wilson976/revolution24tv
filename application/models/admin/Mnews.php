<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mnews extends CI_Model {

    function __construct() {
        parent::__construct();
    }

//    function create_file($nid, $category) {
//        // start file system
//        $this->File_model->create_news($nid);
//        // find workable name by cat id
//        $this->db->select('m_bangla, m_id');
//        $this->db->from('menu');
//        $this->db->where('m_id', $category);
//        $menu_query = $this->db->get();
//
//        $menu_row = $menu_query->row_array();
//        //echo $menu_row['m_bangla'];
//        $this->File_model->create_morenews($menu_row['m_id'], $menu_row['m_bangla'], $nid);
//    }

    function create($cat_id) {       
        $dt = new DateTime();
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_publishing')));
        
        if ($stdate != '1970-01-01 06:00:00' ) {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }

        /* if ($this->input->post('n_related') != '') {
          foreach ($_POST['n_related'] as $key => $value) {
          $temp1[] = $value;
          }
          $related_tag_id = implode($temp1, ",");
          } else {
          $related_tag_id = NULL;
          } */
        if ($this->input->post('page_position') != '') {
            foreach ($_POST['page_position'] as $keys => $values) {
                $temp2[] = $values;
            }
            $n_position = implode(",",$temp2);
        } else {
            $n_position = NULL;
        }

        $data = array(
            'n_solder' => $this->input->post('n_solder'),
            'n_head' => $this->input->post('n_head'),
            'n_subhead' => $this->input->post('n_subhead'),
            'n_intro' => $this->input->post('n_intro'),
            'n_author' => $this->input->post('source_line'),
            'n_author_other' => $this->input->post('source_line_more'),
            'n_writer' => $this->input->post('n_writer'),
            'n_details' => $this->input->post('n_details'),
            'n_position' => $n_position,
            'n_category' => $cat_id,
            'n_sub_category' => $this->input->post('n_sub_category'),
            'article_type' => '1',
            'related_tag_id' => $this->input->post('n_related'),
            'n_date' => date("Y-m-d"),
            'start_date' => $start_date,
            'n_caption' => $this->input->post('n_caption'),
            'latest_news' => $this->input->post('latest_news'),
            'home_page' => $this->input->post('home_page'),
            'intro_image' => $this->input->post('intro_image'),
            'n_video' => $this->input->post('n_video'),
            'live_news' => $this->input->post('live_news'),
            'n_status' => $this->input->post('n_status'),
            'n_post_by' => $this->session->userdata('user_id'),
            'post_time' => $dt->format('Y-m-d H:i:s'),
            'update_time' => $dt->format('Y-m-d H:i:s'),
            'meta_keyword' => $this->input->post('meta_keywords'),
            'meta_description' => $this->input->post('meta_description'),
            'embedded_code' => $this->input->post('embed')
        );
        //'n_order' => $this->input->post('n_order'),
        $this->db->insert('news', $data);
        //print $this->db->last_query();

        return $this->db->insert_id();
    }

    function add_file($file_name, $id) {
        $data = array('main_image' => $file_name);
        $this->db->where('n_id', $id);
        $this->db->update('news', $data);
		
    }

    function GetCategory($cat_id) {

        $this->db->where('m_id', $cat_id);
        $q = $this->db->get('menu');
//print $this->db->last_query();
        $cat_info = $q->row_array();

        return $cat_info;
    }

    function updateOrderHr($id) {
        $data = array(
            'selected_hr' => $id,
            'event_hr' => $id,
            'home_lead_hr' => $id,
            'top_hr' => $id,
            'cat_slide' => $id
        );
        $this->db->where('n_id', $id);
        $this->db->update('news', $data);
        // print $this->db->last_query();
        // exit;
    }

    function update_file($file_name, $n_id) {
        $data = array('main_image' => $file_name);
        $this->db->where('n_id', $n_id);
        $this->db->update('news', $data);
		//print $this->db->last_query();
		//exit;
    }

    function ReturnNewshead($id) {
        $this->db->select('n_head');
        $this->db->where('n_id', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
        }
        $q->free_result();
        return $data['n_head'];
    }
	
	function ReturnStartDate($id) {
        $this->db->select('post_time');
        $this->db->where('n_id', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
        }
        $q->free_result();
        return $data['post_time'];
    }


    function get_cat_type($cat_id) {
        $this->db->where('m_id', $cat_id);
        $q = $this->db->get('menu');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
        }
        $q->free_result();
        return $data['m_type'];
    }

    function get_max_date() {
        $this->db->select_max('n_date');
        $this->db->where('article_type', 1);
        $md = $this->db->get('news');
        if ($md->num_rows() > 0) {
            $data = $md->row_array();
        }
        $md->free_result();
        return $data['n_date'];
    }

    function get_news($cat_id) {
        // $data = array();
        // $date = $this->get_max_date();
        $this->db->order_by('n_id', 'desc');
        $this->db->where('n_category', $cat_id);
        $this->db->limit(100);
        // $this->db->where('n_date', $date);
        $q = $this->db->get('news');
	//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
        }
        $q->free_result();
        return $data;
    }

    function new_get_news($cat_id, $nd) {
        $data = array();
        $date = $nd;
        $this->db->order_by('n_id', 'desc');
        $this->db->where('n_category', $cat_id);
        $this->db->where('n_date', $date);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
        }
        $q->free_result();
        return $data;
    }

    function get_by_id($n_id) {
        $data = array();
        $this->db->where('n_id', $n_id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
        }
        // echo $this->db->last_query();
        $q->free_result();
        return $data;
    }

    function get_cat_name($cat_id) {
        $this->db->where('m_id', $cat_id);
        $this->db->select('m_name');
        $cn = $this->db->get('menu');
        if ($cn->num_rows() > 0) {
            $data = $cn->row_array();
        }
        $cn->free_result();
        return $data['m_name'];
    }

    function update($n_id, $cat_id) {
        $dt = new DateTime();
        $stdate = date('Y-m-d H:i:s', strtotime($this->input->post('start_publishing')));

         if ($stdate != '1970-01-01 06:00:00' ) {
            $start_date = $stdate;
        } else {
            $start_date = date('Y-m-d H:i:s');
        }
        // $end_date = date('Y-m-d H:i:s', strtotime($this->input->post('end_publishing')));


        /* if ($this->input->post('n_related') != '') {
          foreach ($_POST['n_related'] as $key => $value) {
          $temp1[] = $value;
          }
          $related_tag_id = implode($temp1, ",");
          } else {
          $related_tag_id = NULL;
          } */

        if ($this->input->post('page_position') != '') {
            foreach ($_POST['page_position'] as $keys => $values) {
                $temp2[] = $values;
            }
            $n_position = implode(",",$temp2);
        } else {
            $n_position = NULL;
        }

        $data = array(
            'n_solder' => $this->input->post('n_solder'),
            'n_head' => $this->input->post('n_head'),
            'n_subhead' => $this->input->post('n_subhead'),
            'n_intro' => $this->input->post('n_intro'),
            'n_author' => $this->input->post('source_line'),
            'n_author_other' => $this->input->post('source_line_more'),
            'n_writer' => $this->input->post('n_writer'),
            'n_details' => $this->input->post('n_details'),
            'n_position' => $n_position,
            'n_category' => $this->input->post('n_category'),
            'n_sub_category' => $this->input->post('n_sub_category'),
            'related_tag_id' => $this->input->post('n_related'),
            'start_date' => $start_date,
            'n_caption' => $this->input->post('n_caption'),
            'latest_news' => $this->input->post('latest_news'),
            'home_page' => $this->input->post('home_page'),
            'intro_image' => $this->input->post('intro_image'),
            'n_video' => $this->input->post('n_video'),
            'live_news' => $this->input->post('live_news'),
            'n_status' => $this->input->post('n_status'),
            'n_edit_by' => $this->session->userdata('user_id'),
            'edit_time' => $dt->format('Y-m-d H:i:s'),
            'meta_keyword' => $this->input->post('meta_keywords'),
            'meta_description' => $this->input->post('meta_description'),
            'embedded_code' => $this->input->post('embed')
                //'post_time' => NOW()
        );

        $this->db->where('n_id', $n_id);
        $this->db->update('news', $data);
        //print $this->db->last_query();
		//exit;
        return $this->db->insert_id();
		
    }

    function delete($n_id, $data) {
        $data['deleted_by'] = $this->session->userdata('user_id');
        $data['deleted_time'] = date('Y-m-d H:i:s');
        $this->db->insert('trash', $data);
        $this->db->where('n_id', $n_id);
        $this->db->delete('news');
    }

    function SliderLeadNews() {
        // $this->db->order_by('start_date', 'DESC');
        $this->db->order_by("n_order ASC, start_date DESC");
        $this->db->like('n_position', 13);
        $this->db->where('n_status', 3);
        // $this->db->where('article_type', 1);
        $this->db->where('n_order !=', 0);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(10);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function create_live(){
        $data = array(
            'ref_news' => $this->input->post('ref_news'),
            'new_details' => $this->input->post('n_details_live'),
            'new_head' => $this->input->post('n_head_live'),
            'post_by' => $this->session->userdata('user_id'),
            'post_time' => date('Y-m-d H:i:s')
        );
        
        $this->db->insert('live_news', $data);
        //print $this->db->last_query();

        return $this->db->insert_id();
    
    }
    function edit_live($l_id){
        $data = array(
            'ref_news' => $this->input->post('ref_news'),
            'new_details' => $this->input->post('n_details_live'),
            'new_head' => $this->input->post('n_head_live'),
            'post_by' => $this->session->userdata('user_id'),
            'edit_time' => date('Y-m-d H:i:s')
        );
        $this->db->where('l_id', $l_id);
        $this->db->update('live_news', $data);
        //print $this->db->last_query();

        return $this->db->insert_id();
    
    }
    
    function get_live_by_id($l_id) {
        $data = array();
        $this->db->where('l_id', $l_id);
        $q = $this->db->get('live_news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
        }
        $q->free_result();
        return $data;
    }
    
    function getLivenewsbyID($n_id) {
        $data = array();
        $this->db->order_by('l_id', 'DESC');
        $this->db->where('ref_news', $n_id);
        $this->db->join('admin', 'admin.id = live_news.post_by');
        $q = $this->db->get('live_news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
        }
        $q->free_result();
        return $data;
    }
    
    function lndelete($id) {
        $this->db->where('l_id', $id);
        $this->db->delete('live_news');
        //print $this->db->last_query();
    }

    // function SliderorderUpdate() {
    //     for ($i = 1; $i < 16; $i++) {
    //         $data = array(
    //             'n_order' => $this->input->post('n_order' . $i)
    //         );
    //         $this->db->where('n_id', $this->input->post('n_id' . $i));
    //         $this->db->update('news', $data);
    //     }
    //     //print $this->db->last_query();
    // }
    function SliderorderUpdate() {

        $news_id = $_POST['news_id'];
        $n_order = $_POST['n_order'];
        for ($i = 0; $i < count($news_id); $i++) {
            $data = array(
                'n_order' => $n_order[$i]
            );
            $this->db->where('n_id', $news_id[$i]);
            $this->db->update('news', $data);
        }
        //print $this->db->last_query();
    }

    function newsedited_by($n_edited_person) {
        $this->db->select('u_name');
        $this->db->where('id', $n_edited_person);
        $q = $this->db->get('admin');
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
            echo $row['u_name'];
        }
    }

 function getcat() {
        $this->db->select('m_name,m_id');
        $this->db->where('m_type', 'online');
        $this->db->where('m_status', 'active');
        $this->db->order_by('m_tab', 'asc');
        $data = $this->db->get('menu');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function SliderCatNews($cat_id) {
        
         if($cat_id== 3 || $cat_id == 215){
            $sub_cat = $this->Model_menu->getChildCategory($cat_id);
            $sub_cat = array_column($sub_cat, 'm_id');
            $cat_ids = [];
            $cat_ids = $sub_cat;
            $cat_ids[] = $cat_id;
            
            $condition ="(`n_category` IN('".implode("','",$cat_ids)."'))";
            $this->db->where($condition);
        }else{
            $this->db->where('n_category',$cat_id);
        }
        
        
        $this->db->order_by("cat_slide DESC, start_date DESC");
        $this->db->like('n_position', 17);
        $this->db->where('n_status', 3);
        // $this->db->where('n_order !=', 0);
        $this->db->limit(15);
        $q = $this->db->get('news');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }


}