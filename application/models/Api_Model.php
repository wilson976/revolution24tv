<?php
class Api_Model extends CI_Model {
    function __construct() {
        parent::__construct();
    }


    public function pubdate_list() {
        $data = $this->db->get('wsxq_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    public function findTable($n_date){
        $this->db->select('table_name');
        $this->db->where('p_dt', $n_date);
        $q = $this->db->get('wsxq_date_arc');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data['table_name'];
        } else {
            $q->free_result();
            return 'news';
        }
    }

    public function magPubdate() {
        $data = $this->db->get('wsxq_m_p_dt');
        if ($data->num_rows() > 0) {
            return $data->row_array();
        } else {
            $data = NULL;
        }
    }

    public function getMenu($cat_id) {
        // $this->db->select('m_type');
        $this->db->where('m_bangla',$cat_id);
        $this->db->limit(1);
        $q = $this->db->get('menu');
        // print $this->db->last_query();exit;
        return $q->row_array();
    }

    public function NewsCount($cat_id) {

        $this->db->select('n_id');
        $this->db->where('n_status', 3);
        $this->db->where('n_category', $cat_id);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $q = $this->db->get('news');
        return $q->num_rows();
    }

    function getNews($cat_id, $page='',$par_page) {

        $page = ($page=='')?1:$page;
        $start = ($page==1)?0:$page*$par_page;
        $end = $start+$par_page;

        $this->db->select('n_id, n_head,n_date,main_image,start_date,n_details,n_category');
        $this->db->order_by("start_date DESC");
        //$this->db->order_by("n_order ASC, start_date DESC");
        $this->db->where('n_status', 3);
        $this->db->where('n_category', $cat_id);
        // $this->db->where('n_order !=', 0);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit($par_page, $start);
        $q = $this->db->get('news');
        return $q->result();
    }

    function PrintCatNews($m_id,$type) {
        if($type=='feature'){
            $pdt = $this->magPubdate();
                $this->db->limit(20);
        }else{
            $pdt = $this->pubdate_list();
                $this->db->where('n_date', $pdt['pdt']);
        }
        $this->db->where('n_category', $m_id);
        $this->db->where('n_status', '3');
        $this->db->where('article_type', 2);
        $this->db->order_by('n_order', 'ASC');
        $q = $this->db->get('news');
        return $q->result();
    }

    public function model_nav_online(){
        //$this->db->where('m_parent', 0);
        $this->db->where('m_status', 'active');
        $this->db->where('m_type', 'online');
        $this->db->order_by('m_tab', 'asc');
        //$this->db->limit(29);
        $q = $this->db->get('menu');
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $parent_row = [];
            foreach ($q->result_array() as $value) {
                $this->db->where('m_status', 'active');
                $this->db->where('m_parent', $value['m_id']);
                $this->db->where('m_type', 'online');
                $n = $this->db->get('menu');
                if ($n->num_rows() > 0) {
                    $value['submenu'] = 'yes';
                    $value['submenus'] = $n->result_array();
                }else{
                    $value['submenu'] = 'no';
                }
                $parent_row[] = $value;
            }
            return $parent_row;
        }
    }


    public function model_nav_print() {
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
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        }
        return [];
    }

    public function lead_news(){
    	$this->db->select('menu.m_id, menu.m_name, menu.m_bangla,n_id, n_head,main_image,start_date,n_date,n_category,article_type');
        $this->db->order_by("home_lead_hr DESC, start_date DESC");
        $this->db->like('n_position', 13);
        $this->db->where('n_status', 3);
        $this->db->join('menu', 'menu.m_id = news.n_category');
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(4);
        $q = $this->db->get('news');
        return $q->result();
    }

    public function get_online_cat_news($cat_id=''){
    	if ($cat_id=='') {
    	   // '1','7','37','48','18','4','3','11','91'
    		$cat_id = array('37','1','7','48','18','4','3','58','91');
    	}
        $cat_news = array();
        foreach($cat_id as $n_id){
            $news_arr = array();
            
            if($n_id == '58'){
                $dt = $this->pubdate_list();
                $pubdate = $dt['pdt'];
                $sql = $this->db->query("SELECT `n_id`,`n_head`,`main_image`,`n_details`,`n_date`,`start_date` FROM `news` where `n_date`='".$pubdate."' AND  `n_category`='".$n_id."' order by `start_date` desc limit 5");
            }else{
            
            $sql = $this->db->query("SELECT `n_id`,`n_head`,`main_image`,`n_details`,`n_date`,`start_date` FROM `news` where  `n_category`='".$n_id."' order by `start_date` desc limit 5");
            }
            if ($sql->num_rows() > 0) {
            // get menu name
            $menu_sql = $this->db->query("SELECT `m_name`,`m_bangla` FROM `menu` where `m_id`='".$n_id."'");
            $menu_row = $menu_sql->row_array();
            $news_arr['cat_id'] = $n_id;
            $news_arr['m_name'] = $menu_row['m_name'];
            $news_arr['m_bangla'] = $menu_row['m_bangla'];
            $news_list=array();
            $news_arr['news']=$sql->result();
            $cat_news[]=$news_arr;
            }
        }
        return $cat_news;
    }

    public function print_cat_news() {
        $dt = $this->pubdate_list();
        $parent = [];
        $get_nav = $this->db->query("SELECT `i`.`n_id`, `i`.`n_date`, `i`.`article_type`, `i`.`n_category`, `m`.`m_status`, `m`.`m_id`, `m`.`m_tab`, `m`.`m_name`, `m`.`m_bangla` FROM (`news` as i) LEFT JOIN `menu` as m ON `i`.`n_category` = `m`.`m_id` WHERE `i`.`n_date` = '".$dt['pdt']."' AND `m`.`m_status` = 'active' AND `article_type` = 2 GROUP BY `i`.`n_category` ORDER BY `m`.`m_tab` asc ");
        foreach ($get_nav->result() as $prow){
            $get_parent = [];
            $sql = $this->db->query("SELECT n_id, n_date, n_head,  main_image, article_type, n_category, start_date FROM (`news`) WHERE `n_category` = '".$prow->m_id."' AND `n_status` = '3' AND `n_date` = '".$dt['pdt']."' AND `article_type` = 2 ORDER BY `n_order` ASC, `start_date` DESC LIMIT 5");
            $get_parent['m_id'] = $prow->m_id;
            $get_parent['m_name'] = $prow->m_name;
            $get_parent['m_bangla'] = $prow->m_bangla;
            $get_parent['news'] = $sql->result();
            $parent[] = $get_parent;
        }
        return $parent;
    }

    public function getNewsbyID($n_id) {
        $this->db->where('n_id', $n_id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $q->free_result();
            return $data;
        }
        return NULL;
    }
    
    public function getWriter($n_writer) {
        if($n_writer!=0){
    	    $this->db->select('p_name');
            $this->db->where('p_id', $n_writer);
            $q = $this->db->get('profiles');
            if ($q->num_rows() > 0) {
                $data = $q->row_array();
                $q->free_result();
                return $data['p_name'];
            }
        }
        return NULL;
    }
    
    function TopNews() {
        //$this->db->order_by('start_date', 'DESC');
        $this->db->order_by('top_hr', 'DESC');
        $this->db->like('n_position', 15);
        $this->db->where('n_status', 3);
        $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->limit(12);
        $this->db->from('news');
        $this->db->join('menu', 'menu.m_id = news.n_category');
        $q = $this->db->get();
        // print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            return $data;
        } else {
            return NULL;
        }
    }

    public function mostRead() {
        $query = "select * from (SELECT `n_id`, `n_date`, `n_head`, `n_category`, `main_image`, `article_type`, `start_date` FROM (`news`)  WHERE `n_date` = '".date('Y-m-d')."' ORDER BY `most_read` desc, `n_id` desc LIMIT 10) x join (select m_id, menu.m_bangla, menu.m_name from menu) y on x.n_category = y.m_id;";
        $q = $this->db->query($query);
        if ($q->num_rows() > 0) {
            $return = $q->result_array();
            $q->free_result();
            return $return;
        }
        return [];
    }

    public function latestNews() {
        $this->db->select('menu.m_id, menu.m_name, menu.m_bangla, n_id, n_head,main_image,start_date,n_details,n_date,n_category,article_type');
        $this->db->order_by("start_date DESC");
        $this->db->where('article_type', 1);
        $this->db->where('n_status', 3);
        // $this->db->where('start_date <=', date('Y-m-d H:i:s'));
        $this->db->join('menu', 'menu.m_id = news.n_category');
        $this->db->limit(15);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $return = $q->result_array();
            $q->free_result();
            return $return;
        }
        return [];
    }

    public function PhotoGalleryHome($limit=10) {
        $sql = 'SELECT *, MAX(`p_id`) AS max_pid FROM (`photo_gallery`) JOIN `gallery_cat` ON `gallery_cat`.`g_id` = `photo_gallery`.`p_category` GROUP BY `p_category` ORDER BY `p_id` desc LIMIT '.$limit;
        $q = $this->db->query($sql);
        //print $this->db->last_query();
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
        return [];
    }

    public function VideoGallery($limit=10) {
        $this->db->order_by('v_id','DESC');
        $this->db->where('v_lead', 1 );
        $this->db->limit($limit);
        //print $this->db->last_query();
        $q = $this->db->get('video_gallery');
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
        return [];
    }

    public function getvideo($vid) {
        $this->db->where('v_id', $vid);
        $this->db->join('video_gallery_cat','video_gallery_cat.id=video_gallery.v_category');
        $this->db->limit(1);
        $q = $this->db->get('video_gallery');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            return $q->row_array();
        }
        return [];
    }
    public function more_video($vid) {
        $this->db->select('v_category');
        $this->db->where('v_id',$vid);
        $cat_sql = $this->db->get('video_gallery');
        $cat = $cat_sql->row_array();

        $this->db->where('v_id !=', $vid);
        $this->db->order_by('v_id','DESC');
        $this->db->where('v_category', $cat['v_category'] );
        $this->db->limit(10);
        //print $this->db->last_query();
        $q = $this->db->get('video_gallery');
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
        return[];
    }

    public function comments($n_id = 0){
        $this->db->select('user.id, user.full_name, user.email, user.device_type,  user.registrationtype, commennt.id as c_id, commennt.news_id, commennt.comment_text, commennt.created_at, commennt.type, commennt.parent');
        $this->db->where('news_id', $n_id);
        $this->db->where('parent', NULL);
        $this->db->where('status', '1');
        $this->db->join('user', 'commennt.user_id = user.id');
        $q = $this->db->get('commennt');
        // print $this->db->last_query();exit;
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        } else {
            return NULL;
        }
    }
    
    function hit_count($n_id) {
        $this->db->limit(1);
        $this->db->where('n_id', $n_id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $total_hit = $data['most_read'] + 1;
            //echo $total_hit;
            $data1 = array(
                'most_read' => $total_hit
            );
            $this->db->where('n_id', $n_id);
            $this->db->update('news', $data1);
            //print $this->db->last_query();
        }
    }
    
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
                $this->db->select('menu.m_id, menu.m_name, menu.m_bangla, n_id, n_head,main_image,start_date,n_details,n_date,n_category,article_type,n_status');
                $this->db->where('n_id !=', $n_id);
                $this->db->where('start_date <=', date('Y-m-d H:i:s'));
                $this->db->where('n_status', 3);
                $this->db->order_by('n_id', 'DESC');
                $this->db->join('menu', 'menu.m_id = news.n_category');
                $this->db->limit(5);
                $query = $this->db->get('news');
                //print $this->db->last_query();
               

                if ($query->num_rows() > 0) {
                    $related_news = $query->result_array();
                    $query->free_result();
                    return $related_news;
                }
                return [];
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
        $this->db->limit(5);
        $q = $this->db->get('news');
// print $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
            $q->free_result();
            return $data;
        }
        return [];
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
        return [];
    }

}