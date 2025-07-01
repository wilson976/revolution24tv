<?php
class file_model extends CI_Model
{
    
    function __construct()
    {
        # code...
    }
    /**
    * make folder
    */
    public function dir_location($date='')
    {
        $getdate = ($date)? str_replace('-','/',$date) : '';
        $dir = './assets/news_file/'.$getdate;
        return $dir;
    }
    /**
    * create news file
    */
    

    public function _txt($data,$nid,$date='')
    {
        // print_r($data); exit;
        if ($data!='' && $nid!='') {
            // make folder by date
            $dir = $this->dir_location($date);
            if(is_dir($dir)==false){
                $oldmask = umask(0);
                mkdir($dir, 0777, true);
                umask($oldmask);
            }
            // create .txt file
            $txt = serialize($data);
            $fopen = fopen($dir."/".$nid.".txt", "w") or die("Unable to create file!");
            fwrite($fopen, $txt);
            fclose($fopen);
        }
    }

     public function common4all() {
        $data['breakingnews'] = $this->Model_home->BreakingNews();
        $data['headlines'] = $this->Model_home->HeadlineNews();
        $data['latest_news'] = $this->Model_home->LatestNews();
        $data['most_read'] = $this->Model_home->most_read_count();
        $data['highlights'] = $this->Model_home->Highlights();
        $data['banner'] = $this->Model_home->banner();
       // $data['ticker'] = $this->Model_home->HomeTicker();
        $data['vidcat'] = $this->Model_home->VideoCategoryname();
        $data['online_menu'] = $this->Model_menu->create_Onlinemenu();
        //$data['online_menu_more'] = $this->Model_menu->create_Onlinemenu_more();
        $data['footermenu'] = $this->Model_menu->create_footermenu();
        $this->_txt($data, 'common4all'); 
    }

    public function home1()
    {
        
        $data['lead_news'] = $this->Model_home->LeadNews();
        if($data['lead_news'][0]['live_news']=='yes'){
            $data['live_news'] = $this->Model_home->livenewsmore($data['lead_news'][0]['n_id']);
        }
		$data['lead_news_more'] = $this->Model_home->LeadNews_more();  
        $data['cricket'] = $this->Model_home->HomenewsbyCat(3);
        $data['football'] = $this->Model_home->HomenewsbyCat(215);
        $data['cricketwomen'] = $this->Model_home->HomenewsbyCat(8);
        $data['footballwomen'] = $this->Model_home->HomenewsbyCat(11);
        $data['tennis'] = $this->Model_home->HomenewsbyCat(5);
        $data['hocky'] = $this->Model_home->HomenewsbyCat(216);
        $data['golf'] = $this->Model_home->HomenewsbyCat(6);
        $data['feature'] = $this->Model_home->HomenewsbyCat(4);
        
        $this->_txt($data, 'home1');
    }

    public function home2()
    {   
        
        $data['photogallery'] = $this->Model_home->PhotoGalleries();
        $data['vid1'] = $this->Model_home->VideoCategorybyID();
       
        //$data['editor_choice'] = $this->Model_home->Editorschoice();
        
        $this->_txt($data, 'home2');
        
    }

    public function readCommon()
    {
        $dir_location = $this->dir_location();
        $file = unserialize(file_get_contents($dir_location.'common4all.txt', true));
        return $file;
    }

    public function PrintHome()
    {
        $this->load->model('Model_print');
        $this->load->model('Model_mag');
        $data['pub_date'] = $this->Model_print->pubdate_list();
        $data['dt'] = $data['pub_date']['pdt'];
        $data['print_menu'] = $this->Model_print->getPrintMenu($data['pub_date']['pdt']);
        $data['lead_news'] = $this->Model_print->PrintLeadNews($data['pub_date']['pdt']);
        $data['firstpage_other'] = $this->Model_print->Print_1stPageNews($data['lead_news']['n_id'],$data['pub_date']['pdt']);
        $data['mag_screen'] = $this->Model_mag->get_Mag_screen($data['pub_date']['pdt']);
        $this->_txt($data, 'PrintHome');
    }

    public function read_file($filename)
    {
        $dir_location = $this->dir_location();
        $file = unserialize(file_get_contents($dir_location.$filename.'.txt', true));
        return $file;
    }

    public function related_txt($data,$nid,$date='')
    {
        // print_r($data); exit;
        if ($data!='' && $nid!='') {
            // make folder by date
            $dir = $this->dir_location($date);
            if(is_dir($dir)==false){
                $oldmask = umask(0);
                mkdir($dir, 0777, true);
                umask($oldmask);
            }
            // create .txt file
            $txt = serialize($data);
            $fopen = fopen($dir."/".$nid."_related.txt", "w") or die("Unable to create file!");
            fwrite($fopen, $txt);
            fclose($fopen);
        }
    }


    
    
    public function RoutMenu()
    {
        $this->db->where('m_status', 'active');
        $query = $this->db->get('menu');
        $result = $query->result();
        $query->free_result();
        $data['all_menu'] = $result;
        
        $this->_txt($data, 'RoutMenu');
    }

    public function readfile($id,$date)
    {
        $dir_location = $this->dir_location($date);
        $filename = $dir_location.'/'.$id.'.txt';

        if (!file_exists($filename)) {
            $this->create_news($id);
        }

        $category = $this->uri->segment(1);
        $this->check_morenews($category);

        $file = unserialize(file_get_contents($filename, true));
        return $file;
    }

    public function create_news($id='')
    {
        // echo $id; exit;
        
        $this->db->from('news');
        $this->db->where('n_id', $id);
        $query = $this->db->get();
        // print $this->db->last_query();exit;
        if ($query->num_rows() > 0) {

            $data = $query->row_array();
            $query->free_result();
            $data['next']=$this->next($id, $data['n_category']);
            $data['previous']=$this->previous($id, $data['n_category']);
            $this->_txt($data, $id, $data['n_date']);
        }else{

        return NULL;
        }
        
    }

    function create_file($nid,$category)
    {
        // start file system

        $this->create_news($nid);
        // find workable name by cat id
        $this->db->select('m_bangla, m_id');
        $this->db->from('menu');
        $this->db->where('m_id', $category);
        $menu_query = $this->db->get();
         // print $this->db->last_query();exit;
        $menu_row = $menu_query->row_array();
        $this->create_morenews($menu_row['m_id'],$menu_row['m_bangla']);
    }


    function previous($id, $n_category) {
        $this->db->select('n_id, n_head, n_category, n_date, main_image');
        $this->db->limit(1);
        $this->db->where('n_category', $n_category);
        $this->db->where('n_id >', $id);
        $q = $this->db->get('news');
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
        return NULL;
    }

    function next($id, $n_category) {
        $this->db->limit(1);
        $this->db->select('n_id, n_head, n_category, n_date, main_image');
        $this->db->order_by('n_id', 'desc');
        $this->db->where('n_category', $n_category);
        $this->db->where('n_id <', $id);
        $q = $this->db->get('news');
 //echo $this->db->last_query();
        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            return $data;
        }
        return NULL;
    }

    public function check_morenews($category)
    {
            
        $dir_location = $this->dir_location();
        $filename = $dir_location.$category.'_morenews.txt';
        // find workable name by cat id
        if (!file_exists($filename)) {
            $this->db->select('m_id, m_bangla, m_type');
            $this->db->from('menu');
            $this->db->where('m_bangla', $category);
            $menu_query = $this->db->get();
            $menu_row = $menu_query->row_array();
            $menu_query->free_result();
            $id='';
            $category=$menu_row['m_id'];
            $name=$menu_row['m_bangla'];
            $m_type = $menu_row['m_type'];
            $this->create_morenews($category,$name,$m_type);
        }
    }

    public function create_morenews($category,$name,$m_type='')
    {
            $this->load->model('Model_pages');
            $m_id=$category;
            $name=$name;
            $limit = 22;
            $data['getmenu'] = findMenuinfo($name);
            
            if($data['getmenu']['m_parent'] == 0){
                $sub_cat = $this->Model_menu->getChildCategory($data['getmenu']['m_id']);
                if($sub_cat == ''){
                    $sub_cat = NULL;
                }else{
                $sub_cat = array_column($sub_cat, 'm_id');
                }
            }else{
                // $sub_cat = $this->Model_menu->getChildCategory($data['getmenu']['m_parent']);
                // $sub_cat = array_column($sub_cat, 'm_id');
                $sub_cat = NULL;
            }
             if($data['getmenu']['m_parent']== 3 || $data['getmenu']['m_parent'] == 215){
                $this->create_maincatalso($data['getmenu']['m_parent']);
            }

            $data['category_leadnews'] = $this->Model_pages->getCategoryLeadNews($m_id);

            $data['more_news'] = $this->Model_pages->getMorenewsbyID($m_id, $data['category_leadnews']['n_id'],$limit,$sub_cat);

            $array[0] = $data['category_leadnews'];
            $i=1;
            if (!empty($data['more_news'])) {
                foreach ($data['more_news'] as $value) {
                    $array[$i] = $value;
                    $i++;
                }
            }
            $this->_txt($array, $name.'_morenews');
            
           
    }
    
    
     public function create_maincatalso($category)
        {
           
            $m_id=$category;
            if($category==3)$name='cricket'; else $name = 'football';
            $limit = 22;
            $data['getmenu'] = findMenuinfo($name);
            
            if($data['getmenu']['m_parent'] == 0){
                $sub_cat = $this->Model_menu->getChildCategory($data['getmenu']['m_id']);
                $sub_cat = array_column($sub_cat, 'm_id');
            }else{
                // $sub_cat = $this->Model_menu->getChildCategory($data['getmenu']['m_parent']);
                // $sub_cat = array_column($sub_cat, 'm_id');
                $sub_cat = NULL;
            }

            $data['category_leadnews'] = $this->Model_pages->getCategoryLeadNews($m_id);

            $data['more_news'] = $this->Model_pages->getMorenewsbyID($m_id, $data['category_leadnews']['n_id'],$limit,$sub_cat);

            $array[0] = $data['category_leadnews'];
            $i=1;
            if (!empty($data['more_news'])) {
                foreach ($data['more_news'] as $value) {
                    $array[$i] = $value;
                    $i++;
                }
            }
            $this->_txt($array, $name.'_morenews');
    } 

    

    public function read_morenews($category)
    {
        $category = str_replace('_','-',$category);
        $this->check_morenews($category);
        $dir_location = $this->dir_location();
        $file = unserialize(file_get_contents($dir_location.$category.'_morenews.txt', true));
        return $file;
    }

    public function print_cat_news()
    {
        $this->load->model('Model_menu');
        $this->load->model('Model_print');
        $data['pub_date'] = $this->Model_print->pubdate_list();
        $print_menu = $this->Model_menu->create_Printmenu();
        $date = $data['pub_date']['pdt']; 
        $dt = str_replace('-','/',$date);
        // echo $dt; exit;
        $cat = [];
        foreach ($print_menu as $value) {
            $cat_id = $value['m_id'];
            $cat_name = $value['m_bangla'];
            $array = [];
            $data['category_leadnews'] = $this->Model_print->getCategoryLeadNews($cat_id, $dt);
            $data['more_news'] = $this->Model_print->getCategoryNews($cat_id, $data['category_leadnews']['n_id'], $dt);
            $array[0] = $data['category_leadnews'];

            $i=1;
            if (!empty($data['more_news'])) {
                foreach ($data['more_news'] as $value) {
                    $array[$i] = $value;
                    $i++;
                }
            }
            $cat[$cat_name] = $array;
        }
        $this->_txt($cat, 'print_news_all');
    }
    
     public function magazine_home()
    {
        $this->load->model('Model_mag');
        // $dt = $this->Model_mag->mag_pubdate_list();
        $mag = ['108', '117'];
        foreach($mag as  $value) {
            $n_category = $value;
            $data['category_leadnews'] = $this->Model_mag->getCategoryLeadNews($n_category);
            $data['catinfo'] = $this->Model_mag->getMenu($n_category);
            $data['get_news_bycat'] = $this->Model_mag->getCategoryNews($n_category, $data['category_leadnews']['n_id']);

            $news[] = $data;
        }
        $this->_txt($news, 'Mag_Home');
    }
    
    public function mag_cat_news()
    {
        $this->load->model('Model_menu');
        $this->load->model('Model_print');
        $this->load->model('Model_mag');
        $data['pub_date'] = $this->Model_print->pubdate_list_mag();
        $mag_menu = $this->Model_menu->create_Magazinemenu();
        $date = $data['pub_date']['pdt']; 
        $dt = str_replace('-','/',$date);
        // echo $date; exit;
        $cat = [];
        // print_r($mag_menu); exit;

        foreach ($mag_menu as $value) {
            $cat_id = $value['m_id'];
            $cat_name = $value['m_bangla'];
            $array = [];
            $data['category_leadnews'] = $this->Model_mag->MagCatLeadNews($cat_id, $date);
            $data['more_news'] = $this->Model_mag->MagCateMoreNews($cat_id, $data['category_leadnews']['n_id'], $date);
            $array[0] = $data['category_leadnews'];

            $i=1;
            if (!empty($data['more_news'])) {
                foreach ($data['more_news'] as $value) {
                    $array[$i] = $value;
                    $i++;
                }
            }
            $cat[$cat_name] = $array;
        }
        $this->_txt($cat, 'mag_cat_news');
    }

    public function del($nid, $data)
    {
        $filename = $this->dir_location($data).'/'.$nid.'.txt';
        @unlink($filename);
    }
    
   
   
    
}