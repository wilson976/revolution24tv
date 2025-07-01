<?php

class Model_photogallery extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getFeaturephotoHome() {
        $this->db->where('p_feature', '1');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->order_by('p_id', 'desc');
        $this->db->limit(5);
        $data = $this->db->get('photo_gallery');
//print $this->db->last_query();
        if ($data->num_rows() > 0) {
            $data = $data->result_array();
            return $data;
        } else {
            $data = NULL;
        }
    }

    function GetPhotoByCategory($catid) {
        $this->db->where('p_category', $catid);
        //$this->db->limit(10);
        $data = $this->db->get('photo_gallery');
        //print $this->db->last_query();
        if ($data->num_rows() > 0) {
            $data = $data->result_array();
            return $data;
        } else {
            $data = NULL;
        }
    }

    function photoByID($id) {
        $this->db->where('p_id', $id);
        $data = $this->db->get('photo_gallery');
        if ($data->num_rows() > 0) {
            $data = $data->row_array();
            return $data;
        } else {
            $data = NULL;
        }
    }

    function getCat($id) {
        $this->db->select('p_category');
        $this->db->where('p_id', $id);
        $q = $this->db->get('photo_gallery');
        $cat = $q->row_array();
        if ($q->num_rows() > 0) {
            return $cat['p_category'];
        }
    }

    function getCatName($id) {
        $this->db->where('g_id', $id);
        $q = $this->db->get('gallery_cat');
        // print $this->db->last_query();
        $cat = $q->row_array();
        if ($q->num_rows() > 0) {
            return $cat['g_cat'];
        }
    }

    function getAllbyCat($id) {
        $cat = $this->getCat($id);
        $this->db->where('p_category', $cat);
        $q = $this->db->get('photo_gallery');
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            return $data = $q->result_array();
        }
        return NULL;
    }

    function PhotoNext($id) {
        $cat = $this->getCat($id);
        $this->db->limit(1);
        $this->db->where('p_id >', $id);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->where('p_category', $cat);
        $q = $this->db->get('photo_gallery');
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
        return NULL;
    }

    function PhotoPrevious($id) {
        $cat = $this->getCat($id);
        $this->db->limit(1);
        $this->db->order_by('p_id', 'desc');
        $this->db->where('p_id <', $id);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->where('p_category', $cat);
        $q = $this->db->get('photo_gallery');
// echo $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
        return NULL;
    }

    function totalGallery() {
        $this->db->order_by('p_id', 'desc');
        $this->db->group_by('p_category');
        $this->db->from('photo_gallery');
        $this->db->join('gallery_cat', 'gallery_cat.g_id = photo_gallery.p_category');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            $data = $data->num_rows();
            return $data;
        }
        return NULL;
    }

//     function PhotoGalleries($limit) {
//         $sql = 'SELECT *, MAX(`p_id`) AS max_pid FROM (`photo_gallery`) JOIN `gallery_cat` ON `gallery_cat`.`g_id` = `photo_gallery`.`p_category` GROUP BY `p_category` ORDER BY `p_id` desc LIMIT  ' . $limit;
//         $q = $this->db->query($sql);
// //print $this->db->last_query();
//         if ($q->num_rows() > 0) {
//             $data = $q->result_array();
//             return $data;
//         }
//     }

    function PhotoGalleries($limit="") {
        $this->db->order_by('p_id', 'DESC');
        $this->db->group_by('p_category');
        $this->db->where('p_feature', '1');
        $this->db->join('gallery_cat', 'gallery_cat.g_id = photo_gallery.p_category');
        $this->db->limit($limit, $this->uri->segment(2));
        $q = $this->db->get('photo_gallery');
        // print $this->db->last_query(); exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
        return NULL;
    }
    
     function search_total() {
        $q = $this->db->get('gallery_cat');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            return $data;
        }
    }

    function PhotoOwlslider1() {
        $this->db->select('p_category');
        $this->db->distinct('p_category');
        $this->db->order_by('p_id', 'desc');
        $this->db->limit(1);
        $q = $this->db->get('photo_gallery');
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
            $this->db->where('p_category', $row['p_category']);
            $this->db->order_by('p_id', 'desc');
            $this->db->from('photo_gallery');
            $this->db->join('gallery_cat', 'gallery_cat.g_id = photo_gallery.p_category');
            $r = $this->db->get();
            //print $this->db->last_query();
            if ($r->num_rows() > 0) {
                $data = $r->result_array();
                return $data;
            }
        }
    }

    function PhotoOwlslider2() {
        $this->db->select('p_category');
        $this->db->distinct('p_category');
        $this->db->order_by('p_id', 'desc');
        $this->db->limit(1, 1);
        $q = $this->db->get('photo_gallery');
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
            $this->db->where('p_category', $row['p_category']);
            $this->db->order_by('p_id', 'desc');
            $this->db->from('photo_gallery');
            $this->db->join('gallery_cat', 'gallery_cat.g_id = photo_gallery.p_category');
            $r = $this->db->get();
            if ($r->num_rows() > 0) {
                $data = $r->result_array();
                return $data;
            }
        }
    }

    function PhotoOwlslider3() {
        $this->db->select('p_category');
        $this->db->distinct('p_category');
        $this->db->order_by('p_id', 'desc');
        $this->db->limit(1, 2);
        $q = $this->db->get('photo_gallery');
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
            $this->db->where('p_category', $row['p_category']);
            $this->db->order_by('p_id', 'desc');
            $this->db->from('photo_gallery');
            $this->db->join('gallery_cat', 'gallery_cat.g_id = photo_gallery.p_category');
            $r = $this->db->get();
            if ($r->num_rows() > 0) {
                $data = $r->result_array();
                return $data;
            }
        }
    }

    function PhotoOwlslider4() {
        $this->db->select('p_category');
        $this->db->distinct('p_category');
        $this->db->order_by('p_id', 'desc');
        $this->db->limit(1, 3);
        $q = $this->db->get('photo_gallery');
        if ($q->num_rows() > 0) {
            $row = $q->row_array();
            $this->db->where('p_category', $row['p_category']);
            $this->db->order_by('p_id', 'desc');
            $this->db->from('photo_gallery');
            $this->db->join('gallery_cat', 'gallery_cat.g_id = photo_gallery.p_category');
            $r = $this->db->get();
            if ($r->num_rows() > 0) {
                $data = $r->result_array();
                return $data; 
            }
        }
    }


    function PhotoGalleriesFooter() {
        $sql = 'SELECT *, MAX(`p_id`) AS max_pid, `gallery_cat`.`g_cat` FROM (`photo_gallery`) JOIN `gallery_cat` ON `gallery_cat`.`g_id` = `photo_gallery`.`p_category` GROUP BY `p_category` ORDER BY `p_id` desc limit 12' ;
        $q = $this->db->query($sql);
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        $q->free_result();
    }
}