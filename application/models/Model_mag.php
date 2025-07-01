<?php

class Model_mag extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_details');
    }

///new start

    function mag_pubdate_list() {
        $data = $this->db->get('wsxq_m_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    
    function getMagazine(){
        $dt = $this->mag_pubdate_list();
        $mag = ['108', '117'];
            foreach($mag as  $value) {
                $n_category = $value;
                // print_r($data['mag_date']);
                $data['category_leadnews'] = $this->getCategoryLeadNews($n_category);
                $data['catinfo'] = $this->getMenu($n_category);
                $data['get_news_bycat'] = $this->getCategoryNews($n_category, $data['category_leadnews']['n_id']);
                $news[] = $data;
            }
            return $news;
    }


    function getMenu($id){
        $this->db->where('m_id', $id);
        $this->db->limit(1);
        $r = $this->db->get('menu');
        // print $this->db->last_query();
        if ($r->num_rows() > 0) {
            $row = $r->row_array();
            $r->free_result();
            return $row;
        } else {
            return NULL;
        }
    }

    function getCategoryLeadNews($m_id) {
        $dt = $this->mag_pubdate_list();
        $this->db->select('n_date');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $condition = "(`n_date` ='" . $dt['pdt'] . "' OR `n_date` <= '" . $dt['pdt'] . "')";
        $this->db->where($condition);
        $this->db->order_by('n_id', 'desc');
        $this->db->limit(1);
        $r = $this->db->get('news');
        // print $this->db->last_query();
        if ($r->num_rows() > 0) {
            $row = $r->row_array();
            $r->free_result();
        } else {
            return NULL;
        }

        $this->db->like('n_position', 10);
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $this->db->where('n_date', $row['n_date']);

        $this->db->limit(1);
        $q = $this->db->get('news');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function getCategoryNews($m_id, $n_id) {
        $dt = $this->mag_pubdate_list();

        $this->db->select('n_date');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $condition = "(`n_date` ='" . $dt['pdt'] . "' OR `n_date` <= '" . $dt['pdt'] . "')";
        $this->db->where($condition);
        $this->db->order_by('n_id', 'desc');
        $this->db->limit(1);
        $r = $this->db->get('news');
        foreach ($r->result_array()as $row) {
            $this->db->order_by('n_order', 'asc');
            $this->db->where('n_category', $m_id);
            $this->db->where('n_status', 3);
            $this->db->where('n_date', $row['n_date']);
            $this->db->where('article_type', 2);
            $this->db->where('n_id !=', $n_id);
            //$this->db->limit(4);
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
    }

    function getNewsbyID($n_id) {
        $this->db->where('n_id', $n_id);
        $q = $this->db->get('news');
        //$this->db->join('admin', 'admin.id = news.n_post_by');
        //$q = $this->db->get();
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        }else{
            
            $this->db->where('n_id', $n_id);
            $q = $this->db->get('news2016');
            if ($q->num_rows() > 0) {
                $data = $q->row_array();
                return $data;
            }else{
                $this->db->where('n_id', $n_id);
                $q = $this->db->get('news2015');
                if ($q->num_rows() > 0) {
                    $data = $q->row_array();
                    return $data;
                }else{
                    $this->db->where('n_id', $n_id);
                    $q = $this->db->get('news14_0711');
                    if ($q->num_rows() > 0) {
                        $data = $q->row_array();
                        $q->free_result();
                        return $data;
                    }
                    
                }
                
            }
        }
        return NULL;
    }

    function getMorenewsbyID($n_category, $n_id) {
        $dt = $this->mag_pubdate_list();
        $this->db->select('n_date');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', $n_category);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $condition = "(`n_date` ='" . $dt['pdt'] . "' OR `n_date` <= '" . $dt['pdt'] . "')";
        $this->db->where($condition);
        $this->db->order_by('n_id', 'desc');
        $this->db->limit(1);
        $r = $this->db->get('news');
        foreach ($r->result_array()as $row) {
            $this->db->where('n_category', $n_category);
            $this->db->where('n_id !=', $n_id);
            $this->db->where('n_date', $row['n_date']);
            $this->db->order_by('n_order', 'asc');
            $q = $this->db->get('news');
//print $this->db->last_query();
            if ($q->num_rows() > 0) {
                $data = $q->result_array();
                $q->free_result();
                return $data;
            }
        }
        return NULL;
    }

    function get_Mag_screen($dt) {
        $mag = ['108', '109'];
        $this->db->where('ln_pubdate', $dt);
        $this->db->limit(1);
        $this->db->order_by('ln_id', 'DESC');
        $this->db->where_in('ln_type', $mag);
        $q = $this->db->get('wsxq_links');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    public function MagCatLeadNews($m_id, $mag_date){
        
        $this->db->select('n_date');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $condition = "(`n_date` ='" . $mag_date . "' OR `n_date` <= '" . $mag_date. "')";
        $this->db->where($condition);
        $this->db->order_by('n_id', 'desc');
        $this->db->limit(1);
        $r = $this->db->get('news');
        // print $this->db->last_query();
        if ($r->num_rows() > 0) {
            $row = $r->row_array();
            $r->free_result();
        } else {
            return NULL;
        }

        $this->db->like('n_position', 10);
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $this->db->where('n_date', $row['n_date']);

        $this->db->limit(1);
        $q = $this->db->get('news');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

public function MagCateMoreNews($m_id,$n_id, $dt){
        $this->db->select('n_date');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $condition = "(`n_date` ='" . $dt . "' OR `n_date` <= '" . $dt . "')";
        $this->db->where($condition);
        $this->db->order_by('n_id', 'desc');
        $this->db->limit(1);
        $r = $this->db->get('news');
        foreach ($r->result_array()as $row) {
            $this->db->order_by('n_order', 'asc');
            $this->db->where('n_category', $m_id);
            $this->db->where('n_status', 3);
            $this->db->where('n_date', $row['n_date']);
            $this->db->where('article_type', 2);
            $this->db->where('n_id !=', $n_id);
            //$this->db->limit(4);
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
    }

    


///////////////////////////////////archive magazin/////////////////////////////////////////


    function getArcMag($dt=''){
        $mag = ['73', '74', '75','131','132'];
            $data['lead'] = $this->getCatLeadNewsArc($mag, $dt);
            if($data['lead']!= NULL){
                $data['catinfo'] = $this->getMenuArc($data['lead']['n_category'], $data['lead']['n_date']);
                $data['other'] = $this->getCatNewsArc($data['lead']['n_category'], $data['lead']['n_id'], $data['lead']['n_date']);
                return $data;
            }else{
                return NULL;
            }
    }

    public function getCatLeadNewsArc($mag = '', $dt = ''){
        //print_r(str_replace('_', '-', $dt)); exit;
        // var_dump(str_replace('_', '-', $dt)); exit;
        $dt = str_replace('_', '-', $dt);
        $tbl = $this->find_tbl($dt);
        // print_r($tbl); exit;
        $this->db->like('n_position', 10);
        $this->db->where_in('n_category', $mag);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 2);
        $this->db->where('n_date', $dt);

        $this->db->limit(1);
        $q = $this->db->get($tbl);
        // print $this->db->last_query(); exit;
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }


    function getMenuArc($id){
        $this->db->where('m_id', $id);
        $this->db->limit(1);
        $r = $this->db->get('menu');
        //print $this->db->last_query();
        if ($r->num_rows() > 0) {
            $row = $r->row_array();
            $r->free_result();
            return $row;
        } else {
            return NULL;
        }
    }

    public function getCatNewsArc($m_id = '', $n_id='', $dt = ''){
        $tbl = $this->find_tbl($dt);

        $this->db->order_by('n_order', 'asc');
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('n_date', $dt);
        $this->db->where('article_type', 2);
        $this->db->where('n_id !=', $n_id);
        //$this->db->limit(4);
        $q = $this->db->get($tbl);
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    
    }

    function find_tbl($dt) {
        $this->db->select('table_name');
        $this->db->where('p_dt', $dt);
        $this->db->limit(1);
        $q = $this->db->get('wsxq_date_arc');
        $tbl = $q->row_array();
        $q->free_result();
        // print_r($tbl); exit;
        if(isset($tbl['table_name']) && $tbl['table_name']!= ''){
            return $tbl['table_name'];
        }
        else{
            $table_name='news';
            return $table_name;
        }
   
    }
}