<?php

class Model_pages extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getCategoryLeadNews($m_id) {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
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
    
    function livenewsmore($n_id){
        $this->db->order_by('l_id', 'DESC');
        $this->db->where('ref_news', $n_id);
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


    function getCategoryLeadNewsArticle($m_id) {
        $groupMenu[] = $m_id;
        $this->db->select('m_id');
        $this->db->order_by('m_tab', 'ASC');
        $this->db->where('m_status', 'active');
        //$this->db->where('m_id', $m_id);
        $this->db->where('m_parent', $m_id);
        $mq = $this->db->get('menu');

        if ($mq->num_rows() > 0) {
            $data = $mq->result_array();
            $groupMenu = array_column($data, 'm_id');
            // echo "<pre>";
            // print_r($groupMenu); exit;
            $mq->free_result();
        }

        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->where_in('n_category', $groupMenu);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(1);
        $q = $this->db->get('news');
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            $q->free_result();
            return NULL;
        }
    }
    
    

    function getCategory2ndNews($m_id, $n_id = NULL) {
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', '3');
        $this->db->where('n_id !=', $n_id);
        $this->db->where('article_type', 1);
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

    function getCategoryNews($m_id, $limit) {
        // $sql = 'SELECT * FROM (`news`) WHERE `n_category` = ' . $m_id . ' AND `n_status` = 3 AND `article_type` = 1 ORDER BY `start_date` DESC LIMIT ' . $limit;
        //echo $sql;
        // $q = $this->db->query($sql);
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', '3');
        $this->db->where('article_type', 1);
        // $this->db->limit($limit);
        $q = $this->db->get('news', $limit, $this->uri->segment(2));
        // print $this->db->last_query();
        if (isset($q)) {
            if ($q->num_rows() > 0) {
                $data = $q->result_array();
                $q->free_result();
                return $data;
            }
        } else
            return NULL;
    }

    /*
      $lim = explode(",", $limit);
      $this->db->order_by('start_date', 'DESC');
      $this->db->where('n_category', $m_id);
      $this->db->where('n_status', 3);
      $this->db->where('article_type', 1);
      $this->db->where('n_id !=', $n_id);
      $this->db->where('start_date <=', date('Y-m-d H:i:s'));
      $this->db->limit($lim[0],$lim[1]);
      $q = $this->db->get('news');
      // print $this->db->last_query();
      //exit();
      if ($q->num_rows() > 0) {
      $data = $q->result_array();
      return $data;
      } else {
      return NULL;
      }
      }
     */

    function search_total($m_id, $n_id = '', $n_id2 = '') {
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->where('n_id !=', $n_id);
        $this->db->where('n_id !=', $n_id2);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            $q->free_result();
            return $data;
        }
    }

    function CategoryNewsdiff($ids) {
        $this->db->order_by('start_date', 'desc');
        $this->db->limit('6');
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->where_in('n_category', $ids);
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

    function most_read_category($m_id) {
        $this->db->where('n_category', $m_id);
        $this->db->order_by("most_read desc, start_date desc");
        $this->db->limit(8);
        $q = $this->db->get('news');
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function most_read_categoryartCulture($m_id) {
        $this->db->where('n_category', $m_id);
        $this->db->order_by("most_read desc, n_id desc");
        $this->db->limit(8);
        $this->db->from('news');
        $this->db->join('profiles', 'profiles.p_id = news.n_writer');
        $q = $this->db->get();
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function countRowbyCat($m_id) {
        $this->db->where('n_category', $m_id);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->order_by('start_date', 'DESC');
        $q = $this->db->get('news');
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            $q->free_result();
            return $data;
        }
    }

    function getAllNewsbyCat($m_id, $limit) {

        $sql = 'SELECT * FROM news WHERE n_category ="' . $m_id . '" AND start_date <="' . date('Y-m-d H:i:s') . '" ORDER BY start_date desc ' . $limit;
        $q = $this->db->query($sql);
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
    }

    function countRowbyProfile($p_id) {
        $this->db->where('n_writer', $p_id);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->order_by('start_date', 'DESC');
        $q = $this->db->get('news');
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->num_rows();
            $q->free_result();
            return $data;
        }
    }

    function getAllNewsbyProfile($p_id, $limit) {
        $sql = 'SELECT * FROM news WHERE n_writer ="' . $p_id . '" AND start_date <="' . date('Y-m-d H:i:s') . '" ORDER BY start_date desc ' . $limit;
        $q = $this->db->query($sql);
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
    }

    function find_tbl($dt) {
        $this->db->select('table_name');
        $this->db->where('p_dt', $dt);
        $this->db->limit(1);
        $q = $this->db->get('wsxq_date_arc');
        $tbl = $q->row_array();
        $q->free_result();
        return $tbl['table_name'];
    }

    function getNewsbyID($cat_id, $n_id, $dt="1970/01/01") {
        $this->db->where('n_date', $dt);
        $this->db->where('n_status', 3);
        $this->db->where('n_id', $n_id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        }
//echo "page not found";        
        redirect('my404');
        return NULL;
    }
    
    function getNewsbyID1($slug) {
        $this->db->where('n_slug', $slug);
        $this->db->where('n_status', 3);
        //$this->db->where('n_id', $n_id);
        $q = $this->db->get('news');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        }
//echo "page not found";        
        redirect('my404');
        return NULL;
    }

    function getProfilebyID($p_id) {
        $this->db->where('p_id', $p_id);
        $q = $this->db->get('profiles');
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

///Related News

    function related_news($n_id) {
        $this->db->limit(1);
        $this->db->where('n_id', $n_id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            if ($data['related_tag_id'] != "") {
                $rel = explode(',', $data['related_tag_id']);
                $like_statements = array();
                foreach($rel as $v) {
                    $like_statements[] = "related_tag_id LIKE '%" . $v . "%'";
                }
                $like_string = "(" . implode(' OR ', $like_statements) . ")";
                
                $this->db->where($like_string);
                $this->db->where('n_category', $data['n_category']);
                $this->db->where('n_id !=', $n_id);
                $this->db->where('start_date <=', date('Y-m-d H:i:s'));
                $this->db->where('n_status', 3);
                $this->db->order_by('n_id', 'DESC');
                $this->db->limit(5);
                $query = $this->db->get('news');
                //print $this->db->last_query();
               

                if ($query->num_rows() > 0) {
                    $related_news = $query->result_array();
                    $query->free_result();
                    return $related_news;
                }
                return NULL;
            }
        }
    }

    function getMorenewsbyCat($n_category, $n_id, $dt) {
        //$dt = $this->pubdate_list();
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->where('n_category', $n_category);
        $this->db->where('n_id !=', $n_id);
        $this->db->where('n_date', $dt);
        $this->db->limit(6);
        $q = $this->db->get('news');
// print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function getMorenewsbyCat_online($n_category, $n_id) {
        //$dt = $this->pubdate_list();
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->where('n_category', $n_category);
        $this->db->where('n_status', 3);
        $this->db->where('n_id !=', $n_id);
        $this->db->limit(5);
        $q = $this->db->get('news');
// print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }
    
    
    function menutype($n_category) {
        $this->db->where('m_id', $n_category);
        $q = $this->db->get('menu');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        } else {
            return NULL;
        }
    }

    function getMorenewsbyID($n_category, $n_id = '',$limit=22,$child = NULL) {
        
       $menutype = $this->menutype($n_category);
        
        $cat_ids = [];
        
        if($menutype['m_parent']==0){
            $cat_ids = $child;
            $cat_ids[] = $n_category;
        }else{
            // $cat_ids = $child;
            // $cat_ids[] = $menutype['m_parent'];
            $cat_ids[] = $n_category;
        }
        
        $this->db->select('n_id, n_head, n_date, n_category, main_image,start_date,n_details,n_author,n_author_other,n_video,update_time');
        $condition ="(`n_category` IN('".implode("','",$cat_ids)."'))";
        $this->db->where($condition);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->where('n_id !=', $n_id);
        $this->db->where('article_type', 1);
        $this->db->where('n_status', 3);
        $this->db->order_by('start_date', 'DESC');
        $this->db->limit($limit, $this->uri->segment(3));
        $q = $this->db->get('news');
        //print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function ParentMorenewsbyID($n_category, $n_id = '') {
        $this->db->select('n_id, n_head, n_date, n_category, main_image,,start_date,n_details,n_author,n_author_other,n_video');
        $this->db->where('n_category', $n_category);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->where('n_id !=', $n_id);
        $this->db->limit(4);
        $this->db->where('article_type', 1);
        $this->db->order_by('start_date', 'DESC');
        $q = $this->db->get('news');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function getMorenewsCulturebyID($n_category, $n_id) {
        $this->db->where('n_sub_category', $n_category);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->where('n_id !=', $n_id);
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

    function most_read($n_id) {
        $this->db->query('UPDATE news SET most_read = (most_read+1) WHERE n_id = '. $n_id);
        
    }

    function CreateSubCAT($m_id) {
        $this->db->where('m_parent', $m_id);
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'online');
        $this->db->order_by('m_tab', 'asc');
        $q = $this->db->get('menu');
//print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }

    function getSubCATNews($m_id) {
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', '3');
        $this->db->where('article_type', 1);
        $this->db->like('n_position', 10);
        $this->db->order_by('start_date', 'desc');
        $this->db->limit(1);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
//print $this->db->last_query();
            $row1 = $q->row_array();
            echo '<div>';
            echo '<div id="newsHl2">';
            echo '<a href="' . $row1['n_id'] . '/' . replace_dashes($row1['n_head']) . '">' . $row1['n_head'] . '</a>';
            echo '</div>';
            echo '<div>';
            echo '<img alt="' . $row1['n_head'] . '" src="./assets/news_images/' . str_replace('-', '/', $row1['n_date']) . '/mob/' . $row1['main_image'] . '" id="img">';
            echo '<p>' . splitText(strip_tags($row1['n_details']), 100) . '</p>';
            echo '</div><div class = "clearfix"></div></div>';

            echo '<div><ul class="menunews_bot">';
            $this->db->where('n_category', $m_id);
            $this->db->where('n_status', '3');
            $this->db->where('n_id !=', $row1['n_id']);
            $this->db->where('article_type', 1);
            $this->db->order_by('start_date', 'desc');
            $this->db->limit(5);
            $q2 = $this->db->get('news');
//print $this->db->last_query();
            foreach ($q2->result_array() as $row2) {
                echo '<li><a rel="tab" href="' . $row2['n_id'] . '/' . replace_dashes($row2['n_head']) . '"><font style="color:#000000">' . $row2['n_head'] . '</font></a></li>';
            }
            echo '</ul></div>';
        }
    }

    function getPrintbyID($n_id) {
        $this->db->select('n_id, n_subhead, n_solder, n_author, n_author_other, n_caption, n_date, n_category, n_head, n_details, main_image, article_type, start_date, menu.m_bangla,menu.m_type');
        $this->db->where('n_id', $n_id);
        $this->db->join('menu','news.n_category=menu.m_id');
        $q = $this->db->get('news');
//        print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }
    
    public function comments($n_id = 0){

        $this->db->select('user.id as uid, user.full_name, user.email, user.device_type,  user.registrationtype, commennt.id as c_id, commennt.news_id, commennt.comment_text, commennt.created_at, commennt.type, commennt.parent');
        $this->db->where('news_id', $n_id);
        $this->db->where('parent', NULL);
        $this->db->where('status', '1');
        $this->db->where('type', 'web');
        $this->db->join('user', 'commennt.user_id = user.id');
        $q = $this->db->get('commennt');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            // print_r($this->db->last_query());
            // echo "<pre>";
            // print_r($data); exit;
            return $data;
        } else {
            $q->free_result();
            return NULL;
        }
    }

    public function c_replay($c_id){
        $this->db->where('parent', $c_id);
        $this->db->where('status', '1');
        $this->db->where('type', 'web');
        $this->db->order_by('commennt.id', 'desc');
        $this->db->join('user', 'commennt.user_id = user.id');
        $q = $this->db->get('commennt');
         // print_r($this->db->last_query()); exit;
        if ($q !== FALSE)
        {
            // Run your code
            if ($q->num_rows() === 1)
            {
                return $q->row();
            }
        }
        // if ($q->num_rows() > 0) {
        //     $data = $q->result_array();
        //     $q->free_result();
        //     return $data;
        // } else {
        //     $q->free_result();
        //     return NULL;
        // }
    }

     public function most_comment($n_id){

        $sql = "SELECT `news`.*, `menu`.`m_bangla`,count(`commennt`.`news_id`) as t_com FROM `commennt` left join `news` on `commennt`.`news_id` = `news`.`n_id` left join `menu` on `news`.`n_category`= `menu`.`m_id` WHERE `commennt`.`news_id` !='".$n_id."' AND `commennt`.`status` = '1' AND `commennt`.`type` = 'web' group by `commennt`.`news_id` order by t_com desc limit 6";

        $q = $this->db->query($sql);

        // $q = $this->db->get('news');
        // print $this->db->last_query(); exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            $q->free_result();
            return NULL;
        }
    }
    
     function SpecialCategory($m_id){
        $this->db->where('m_parent', 0);
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'online');
        $this->db->where_in('m_id', array('2','4','3', '18','1','7'));
        $this->db->where('m_id !=', $m_id);
        $this->db->order_by('m_tab', 'asc');
        $this->db->limit(5);
        $q = $this->db->get('menu');
        // print $this->db->last_query();
        $data = $q->result_array();
        if ($q->num_rows() > 0) {
            $q->free_result();
            return $data;
        } else {
            $q->free_result();
            return NULL;
        }
    }

    function OnlineCatNews($cat_name) {
        $this->db->select("n_id, n_date, n_category, n_head, n_details, main_image, n_video, article_type, start_date");
        $this->db->order_by('start_date', 'DESC');
        $this->db->where('n_status', 3);
        $this->db->where('article_type', 1);
        $this->db->where('n_category', $cat_name);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(5);
        $q = $this->db->get('news');
         // print $this->db->last_query();
        // exit();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
                $q->free_result();
            return $data;
        } else {
            $q->free_result();
            return NULL;
        }
    }

    function GetSubCategorybyID($id) {
        $this->db->order_by('id','DESC');
        $this->db->where('v_parent',$id);
        $q = $this->db->get('video_gallery_cat');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            // print $this->db->last_query();
            return $data;
        }
    }
    function CatdVideoMain($v_id) {
        $this->db->order_by('v_id', 'DESC');
        $this->db->where_in('v_category', $v_id);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(1);
        $q = $this->db->get('video_gallery');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function CatdVideo($v_id) {
        $this->db->order_by('v_id', 'DESC');
        $this->db->where_in('v_category', $v_id);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(10);
        $q = $this->db->get('video_gallery');
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }

    function catChildLeadNews($mid) {
        $this->db->order_by('start_date', 'DESC');
        $this->db->like('n_position', 10);
        $this->db->where('n_category', $mid);
        $this->db->where('n_status', 3);
        $this->db->limit(1);
        $q = $this->db->get('news');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        } else {
            // redirect();
            return NULL;
        }
    }

    function ChildOtherNews($mid,$n_id) {
        $where = "(n_position IS NULL OR n_position not like 10)";
        $this->db->where($where);
        $this->db->order_by('n_order', 'ASC'); 
        $this->db->where('n_category', $mid);
        $this->db->where('n_id !=', $n_id);
        $this->db->where('n_status', 3);
        $this->db->order_by('start_date', 'DESC');
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

}
