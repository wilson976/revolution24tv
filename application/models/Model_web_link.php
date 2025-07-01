<?php

class Model_web_link extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_by_cat($id) {
        $this->db->where('wl_id', $id);
        $data = $this->db->get('website_link');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    function get_paper_cat() {

        $data = $this->db->get('website_link_tag');
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function get_paper() {
        $this->db->order_by('wl_tab', 'ASC');
        // $this->db->where('wl_n_source', 1);
        $this->db->where('wl_type', 'News_paper');
        $data = $this->db->get('website_link');
        //  echo $this->db->last_query();
        if ($data->num_rows() > 0) {

            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function get_tv() {
        $this->db->order_by('wl_tab', 'ASC');
        $this->db->where('wl_type', 'TV');
        $data = $this->db->get('website_link');
        //echo $this->db->last_query();
        if ($data->num_rows() > 0) {

            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function get_radio() {
        $this->db->order_by('wl_tab', 'ASC');
        $this->db->where('wl_type', 'Radio');
        $data = $this->db->get('website_link');
        //echo $this->db->last_query();
        if ($data->num_rows() > 0) {

            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function get_blogs() {
        $this->db->order_by('wl_tab', 'ASC');
        $this->db->where('wl_type', 'Blog');
        $data = $this->db->get('website_link');
        //echo $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function get_albums() {
        $this->db->where('g_parent', '0');
        $data = $this->db->get('gallery_cat');
        //echo $this->db->last_query();
        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function get_album_subcat($id) {
        $this->db->where('g_parent', $id);
        $data = $this->db->get('gallery_cat');
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            foreach ($data->result_array() as $q) {
                echo '<div class="left_bar_inner_sub"><a href="photogallery/albumdetails/' . $q['g_id'] . '">';
                echo $q['g_cat'];
                echo '</a></div>';
            }
        }
    }

    function photo_by_id($id) {
        $this->db->where('p_id', $id);
        $data = $this->db->get('photo_gallery');
        if ($data->num_rows() > 0) {
            $data = $data->row_array();
            return $data;
        } else {
            $data = NULL;
        }
    }

    function get_uid($id) {
        $this->db->select('u_id');
        $this->db->where('p_id', $id);
        $data = $this->db->get('photo_gallery');
        if ($data->num_rows() > 0) {
            $data = $data->row_array();
            return $data;
        } else {
            $data = NULL;
        }
    }

    function getPhoto_bycat($p_category, $id) {
        $this->db->where('p_category', $p_category);
        $this->db->where('p_id != ', $id);
        $data = $this->db->get('photo_gallery');
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            $data = $data->result_array();
            return $data;
        } else {
            $data = NULL;
        }
    }

    function user_info($u_id) {
        $this->db->where('u_id', $u_id);
        $data = $this->db->get('user_login');
        if ($data->num_rows() > 0) {
            $data = $data->row_array();
            return $data;
        } else {
            $data = NULL;
        }
    }

    function getAllPhotos() {
        $this->db->where('appoval', '1');
        $this->db->order_by('p_id', 'desc');
        $q = $this->db->get('photo_gallery');
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
        } else {
            $data = NULL;
        }
    }

    function getAllPhotoslimit($limit) {
        $sql = "SELECT * from photo_gallery WHERE appoval='1' ORDER BY p_id DESC " . $limit;
        $q = $this->db->query($sql);
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
    }

    function album_by_id($id) {
        $this->db->where('g_id', $id);
        $data = $this->db->get('gallery_cat');
        if ($data->num_rows() > 0) {
            $name = $data->row_array();
            return $name['g_cat'];
        } else {
            $data = NULL;
        }
    }

    function picture_count($id) {
        $this->db->where('appoval', '1');
        $this->db->where('p_category', $id);
        $data = $this->db->get('photo_gallery');
        if ($data->num_rows() > 0) {
            return $data->num_rows();
        } else {
            $data = NULL;
        }
    }

    function album_details($id, $limit) {
        $sql = 'SELECT * from photo_gallery WHERE p_category =' . $id . ' AND  appoval ="' . 1 . '" ORDER BY p_id desc ' . $limit;
        $q = $this->db->query($sql);
        if ($q->num_rows() > 0) {
            $photos = $q->result_array();
            return $photos;
        }
    }

    function getsingleimg($id) {
        $this->db->where('p_id', $id);
        $data = $this->db->get('photo_gallery');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    ///Video
    function video_cat() {
        $this->db->order_by('vid_id', 'ASC');
        $data = $this->db->get('vid_cat');

        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getAllVideo() {
        $this->db->where('appoval', '1');
        $this->db->order_by('v_id', 'desc');
        $q = $this->db->get('video');
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
        } else {
            $data = NULL;
        }
    }

    function getAllVideolimit($limit) {
        $sql = "SELECT * from video WHERE appoval='1' ORDER BY v_id DESC " . $limit;
        $q = $this->db->query($sql);
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
    }

    function video_by_id($id) {
        $this->db->where('v_id', $id);
        $data = $this->db->get('video');
        if ($data->num_rows() > 0) {
            $data = $data->row_array();
            return $data;
        } else {
            $data = NULL;
        }
    }

    function video_count($id) {
        $this->db->where('v_category', $id);
        $data = $this->db->get('video');
        if ($data->num_rows() > 0) {
            return $data->num_rows();
        } else {
            $data = NULL;
        }
    }

    function video_cat_name($id) {
        $this->db->where('vid_id', $id);
        $data = $this->db->get('vid_cat');
        if ($data->num_rows() > 0) {
            $name = $data->row_array();
            return $name['vid_cat'];
        } else {
            $data = NULL;
        }
    }

    function video_details($id, $limit) {
        $sql = 'SELECT * from video WHERE v_category ="' . $id . '" ORDER BY v_id desc ' . $limit;
        $q = $this->db->query($sql);
        // echo $this->db->last_query();
        if ($q->num_rows() > 0) {
            $videos = $q->result_array();
            return $videos;
        }
    }

    ///Hashikhushi Club
    function hashikhushi_cat() {
        $this->db->order_by('hk_id', 'ASC');
        $data = $this->db->get('hashikhushi_cat');

        if ($data->num_rows() > 0) {
            return $data->result_array();
        } else {
            $data = NULL;
        }
    }

    function getAllhashikhushi() {
        $this->db->where('status', '1');
        $this->db->order_by('id', 'desc');
        $q = $this->db->get('hashikhushi_club');
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
        } else {
            $data = NULL;
        }
    }

    function getAllhashikhushilimit($limit) {
        $sql = "SELECT * from hashikhushi_club WHERE status='1' ORDER BY id DESC " . $limit;
        $q = $this->db->query($sql);
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
    }

    function hashikhushi_by_id($id) {
        $this->db->where('id', $id);
        $data = $this->db->get('hashikhushi_club');
        if ($data->num_rows() > 0) {
            $data = $data->row_array();
            return $data;
        } else {
            $data = NULL;
        }
    }

    function hashikhushi_count($id) {
        $this->db->where('category', $id);
        $data = $this->db->get('hashikhushi_club');
        if ($data->num_rows() > 0) {
            return $data->num_rows();
        } else {
            $data = NULL;
        }
    }

    function hashikhushi_cat_name($id) {
        $this->db->where('hk_id', $id);
        $data = $this->db->get('hashikhushi_cat');
        if ($data->num_rows() > 0) {
            $name = $data->row_array();
            return $name['hashikhushi_cat'];
        } else {
            $data = NULL;
        }
    }

    function hashikhushi_details($id, $limit) {
        $sql = 'SELECT * from hashikhushi_club WHERE category ="' . $id . '" ORDER BY id desc ' . $limit;
        $q = $this->db->query($sql);
        // echo $this->db->last_query();
        if ($q->num_rows() > 0) {
            $hashikhushi_clubs = $q->result_array();
            return $hashikhushi_clubs;
        }
    }

}