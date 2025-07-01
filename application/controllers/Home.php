<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_menu');
        $this->load->model('Model_print');
        $this->load->model('Model_pages');
        $this->load->model('Model_photogallery');
        $this->load->model('Model_common4all');   
        $this->load->model('File_model');       
    }
    
    public function __destruct() {
        $this->db->close();
    }
    
    // public function common4all() {
    //     require('Common4all.php');
    //     $common4all = new Common4all();
    //     $common4all->common();
    // }


    // public function index() {
    //     $data = array();
    //     $data['class'] = 'home';
    //     $this->Model_common4all->common();
    //     $data['dt'] = $this->Model_print->pubdate_list();

    //     $data['eventnews'] = $this->Model_home->Eventnews();
    //     $data['lead_news'] = $this->Model_home->LeadNews();
    //     // $data['lead_newsother'] = $this->Model_home->HomeLeadNewsOther($data['lead_news']['n_id']);
    //     $data['lead_video'] = $this->Model_home->HomeLeadVideo(); 
        
    //     $data['top_news'] = $this->Model_home->TopNews();

    //     $data['nationalnews'] = $this->Model_home->HomeNationalNews();

    //      $data['international'] = $this->Model_home->HomeInternational();

    //      //$data['desh'] = $this->Model_home->HomeDesh();

    //     $data['sports'] = $this->Model_home->HomeSportsNews();
        
    //     $data['business'] = $this->Model_home->HomeBusiness(9);
        
    //     $data['entertainment'] = $this->Model_home->HomeEntertainment();
        
    //     $data['technology'] = $this->Model_home->HomeTechnology();

    //     $data['specialnews'] = $this->Model_home->HomeSpecialNews();

    //     // $data['chittagong'] = $this->Model_home->HomeChittagong();

    //     // $data['channel_special'] = $this->Model_home->HomeChannelSpecial();

    //     $data['writter_news'] = $this->Model_home->HomeWritterNews();

    //     $data['photonews'] = $this->Model_home->HomePhotoGallery();

    //     $data['lifestyle'] = $this->Model_home->HomeLifestyle();

    //     //$data['column'] = $this->Model_home->HomeColumn();
    //     $data['cinta'] = $this->Model_home->HomeCinta();
        
    //     $data['print_cat'] = $this->Model_home->getPrintCat();		
		
    //     $data['feature_video'] = $this->Model_home->FeaturedVideo();
        

    //     $data['poll'] = $this->Model_home->poll();
    //     $data['calendar'] = $this->showCalender();
        
    //     $data['interview'] = $this->Model_home->InterView();
    //     $data['specialevent'] = $this->Model_home->SpecialEvent();
    //     $data['event_news'] = $this->Model_home->SpecialEventNews($data['specialevent']['event_category']);
        
    //     $data['photogallery'] = $this->Model_photogallery->PhotoGalleries(5);
        
    //     $data['getCompactVote'] = $this->Model_home->getCompactVote();
        
    //     $this->output->cache(5);
    //     $this->load->vars($data);
    //     $this->load->view('template');
    // }
    
     public function index() {
        $data = array();
        //$this->Model_common4all->common();

        $data = $this->File_model->readCommon();
        $data['class'] = 'home';
        $data = array_merge($data, $this->File_model->read_file('home1'));
        $data = array_merge($data, $this->File_model->read_file('home2'));
        // echo '<pre>';
        // print_r($data); exit;
        
        $data['calendar'] = $this->showCalender();
       
        
        $this->output->cache(5);
        $this->load->vars($data);
        $this->load->view('template');
    }
    
    
    function hitcount($n_id = '') {
        $this->Model_home->most_read($n_id);
    }

    public function printnews($n_id) {
        $data['class'] = 'print_news';
        $data['getnewsby_id'] = $this->Model_pages->getPrintbyID($n_id);
        $this->Model_common4all->common();
        $this->load->view('print_news', $data);
    }
    
    
    function poll_result() {
        $poll = $this->Model_home->poll();
        if ($poll['PoolTotal'] != 0) {
            $yes = ($poll['PoolYes'] / $poll['PoolTotal']) * 100;
            $no = ($poll['PoolNo'] / $poll['PoolTotal']) * 100;
            $noc = ($poll['PoolNoCom'] / $poll['PoolTotal']) * 100;
        echo'
            <div class="progress_area">

                <h5>হ্যাঁ '.en2bnNumber(number_format($yes, 1)).'%</h5>
                <div class="progress">
                    <div class="progress-bar" style="width:'.$yes.'%;">
                        <span class="sr-only"></span>
                    </div>
                </div>

                <h5>না '.en2bnNumber(number_format($no, 1)).'%</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-danger" style="width:'.$no.'%;">
                        <span class="sr-only"></span>
                    </div>
                </div>

                <h5>মতামত নেই '.en2bnNumber(number_format($noc, 1)) . '%</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" style="width:'.$noc.'%;">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>';
            }
    }

    function poll_vote() {
        $_SESSION['session_poll_date'] = date('Y-m-d',strtotime(date('Y-m-d') . "+1 days"));
        if ($this->input->post('pollAnswer')) {
            $ans = $this->input->post('pollAnswer');
            //$ptype = $this->input->post('PoolType');
            $this->Model_home->poll_vote($ans);
            // redirect();
            $poll = $this->Model_home->poll($ans);
            if ($poll['PoolTotal'] != 0) {
                $yes = ($poll['PoolYes'] / $poll['PoolTotal']) * 100;
                $no = ($poll['PoolNo'] / $poll['PoolTotal']) * 100;
                $noc = ($poll['PoolNoCom'] / $poll['PoolTotal']) * 100;
                echo'
            <h4 class="text-center" style="color: #EA0253;">আপনার মতামতের জন্য ধন্যবাদ</h4>
            <div class="progress_area" >

                <h5>হ্যাঁ ' . en2bnNumber(number_format($yes, 1)) . '%</h5>
                <div class="progress progress-striped">
                    <div class="progress-bar" style="width:' . $yes . '%;">
                        <span class="sr-only"></span>
                    </div>
                </div>

                <h5>না ' . en2bnNumber(number_format($no, 1)) . '%;</h5>
                <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-danger" style="width:' . $no . '%;">
                        <span class="sr-only"></span>
                    </div>
                </div>

                <h5>মতামত নেই ' . en2bnNumber(number_format($noc, 1)) . '%;</h5>
                <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-success" style="width:' . $noc . '%;">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>';
            }
        }
    }

    function poll() {
        $data['class'] = 'poll_result';
        $this->Model_common4all->common();
        $config['base_url'] = base_url() . 'home/poll';
        $config['total_rows'] = $this->Model_home->get_totalVote_result();
        $config['per_page'] = 12;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);

        if ($this->uri->segment(3) == TRUE) {
            $from = $this->uri->segment(3);
        } else {
            $from = 0;
        }
        $limit = 'LIMIT ' . $from . ', ' . $config['per_page'];
        $data['links'] = $this->pagination->create_links();
        $data['result'] = $this->Model_home->show_vote_perpage($limit);
        $this->load->view('template', $data);
    }
    
    

    function allnews() {
        // $titlen = '';
        // $catid = '';
        // $sdate= '';
        // $edate= '';
        
        if (isset($_POST['token']) == 1) {
            $_SESSION["POST"] = $_POST;
            
            
        }else{
            if($this->uri->segment(2)=='')
            unset ($_SESSION["POST"]);
        }
        
        $titlen = $_SESSION["POST"]['title'];
        $catid = $_SESSION["POST"]['catid'];
        $sdate= $_SESSION["POST"]['dtDate'];
        $edate= $_SESSION["POST"]['dsDate'];
        //exit;


        $data['class'] = 'home-allnews';
        $this->Model_common4all->common();
        $config['base_url'] = base_url() . 'allnews';
        $config['total_rows'] = $this->Model_home->HomeAllNews_countpost($titlen, $catid, $sdate, $edate);
        $config['per_page'] = 21;
        $config['uri_segment'] = 2;
        $this->pagination->initialize($config);

        if ($this->uri->segment(2) == TRUE) {
            $from = $this->uri->segment(2);
        } else {
            $from = 0;
        }
        $limit = $config['per_page'];
        $data['links'] = $this->pagination->create_links();
        
        $data['result'] = $this->Model_home->HomeAllNews_perpagepost($limit, $titlen, $catid, $sdate, $edate);
        $data['catid']=$catid;
        $data['sdate']=$sdate;
        $data['edate']=$edate;
        $data['titlen']=$titlen;
        $this->load->view('template', $data);
    }

    function rss() {
        $data['title'] = 'RSS Page';
        $data['rss_data'] = $this->Model_home->rss();
        $this->load->view('rssfeed/rss', $data);
    }

    function rssFBinstantArticle() {
        $data['title'] = 'RSS Page';
        $data['rss_data'] = $this->Model_home->rssfb();
        $this->load->view('rssfeed/rss_fb_instant_article', $data);
    }

    public function profile($id) { 
        $this->load->model('Model_mukto');   
        $this->Model_common4all->common();    
        $data['class'] = 'profile';
        $data['coldata'] = $this->Model_mukto->get_by($id);
        
        $config['base_url'] = base_url() .'home/profile/'.$id;
        $config['total_rows'] = $this->Model_mukto->all_mukto_news($id);
        $config['per_page'] = 2;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);

        if ($this->uri->segment(4) == TRUE) {
            $from = $this->uri->segment(4);
        } else {
            $from = 0;
        }
        $limit = 'LIMIT ' . $from . ', ' . $config['per_page'];
        $data['links'] = $this->pagination->create_links();
        $data['news'] = $this->Model_mukto->mukto_news($id, $limit);

        $this->load->view('template', $data);
    }

    

    function keywordsearch() {
        $data['class'] = 'keywordsearch';
        $this->Model_common4all->common();
        $this->load->view('template', $data);
    }

    

    function archive($year, $month, $date) {
        $date = $year . '-' . $month . '-' . $date;
        $data['arccat'] = $this->Model_print->getArchiveCat($date);
        $data['class'] = 'online-archive';
        $data['calendar'] = $this->showCalender();
        $this->Model_common4all->common();
        $this->load->view('template', $data);
    }

    function archive_calendar() {
        $data['calendar'] = $this->ChangeShow();
        $this->load->view('archive1', $data);
    }

    function showCalender() {
        $check = $this->Model_print->dynamic_calendar();
        //   print_r ($check['n_date']);
        $mon = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "Decmber");
        $output = "<table width='100%' border='0' cellspacing='5' cellpadding='5' style='margin-bottom: 10px;font-size:18px;margin-top:10px;'><tr class = 'tit'><td><div><select style='color:#666666; font-weight:bold; border:1px solid #666666;width:120px;' name='month' onChange='dateShowPrint()' id='month'>";
        for ($i = 1; $i <= 12; $i++) {
            if ($i == date('n')) {
                $output.='<option value ="' . $i . '"' . ' ' . 'selected="selected"' . '>' . $mon[$i - 1] . '</option>';
            } else {
                $output.='<option value ="' . $i . '"' . '>' . $mon[$i - 1] . '</option>';
            }
        }
        $output.="</select></div></td><td><div style='margin-left:20px;'><select style='color:#666666; font-weight:bold; border:1px solid #666666; width:98px;' name='year'  onChange='dateShowPrint()' id='year'>";
        $currentyear = date('Y');
        for ($j = 2011; $j <= $currentyear; $j++) {
            if ($j == $currentyear) {
                $output.="<option value='$j' selected='selected'>" . $j . "</option>";
            } else {
                $output.='<option value ="' . $j . '"' . '>' . $j . '</option>';
            }
        }
        $output.="</select></div></td></tr></table><table border='0'style='table-layout : fixed;font-size: 18px;'><tr><td id='dateShow1'>";


        $month = date("m");
        $year = date("Y");
        $day = date("d");

        $date = mktime(12, 0, 0, $month, 1, $year);
        $daysInMonth = date("t", $date);
        $offset = date("w", $date);
        $rows = 1;
        //$output.="<h1>" . date("F Y", $date) . "</h1>\n";
        $output.="<table class='table' border='0' cellspacing='5' cellpadding='5'>\n";
        $output.="\t<tr class= 'tit' style='color:#666666; background-color:#70717C; border:1px solid color #cccccc; color:#C7C7D1'><th style='border-right:1px solid #FFF'>Sun</th><th style='border-right:1px solid #FFF'>Mon</th><th style='border-right:1px solid #FFF'>Tue</th><th style='border-right:1px solid #FFF'>Wed</th><th style='border-right:1px solid #FFF'>Thu</th><th style='border-right:1px solid #FFF'>Fri
					</th><th style='border-right:1px solid #FFF'>Sat</th></tr>";
        $output.="\n\t<tr bgcolor='#2C2C34'>";
        for ($i = 1; $i <= $offset; $i++) {
            $output.="<td></td>";
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            if (($day + $offset - 1) % 7 == 0 && $day != 1) {
                $output.="</tr>\n\t<tr bgcolor='#2C2C34'>";
                $rows++;
            }

            $day = str_pad($day, 2, '0', STR_PAD_LEFT);
            $new_date = $year . '-' . $month . '-' . $day;

            $linked_date = NULL;

            foreach ($check as $v) {
                if ($v['p_dt'] == $new_date) {
                    $output.="<td bgcolor='#666666' style='text-align:center; '><strong><a href='printversion/$year/$month/$day' style='text-decoration:none'>" . $day . "</a></strong></td>";
                    $linked_date = $new_date;
                }
            }
            if ($linked_date != $new_date) {
                $output.= "<td style='color:#FCFCFC; padding:8px 17.5px'><strong>" . $day . "</strong></td>";
            }
        }
        while (($day + $offset) <= $rows * 7) {
            $output.="<td></td>";
            $day++;
        }
        $output.="</tr>\n</table>\n</td></tr></table>";

        return $output;
    }

    function ChangeShow() {
        $check = $this->Model_print->dynamic_calendar();
        if ($_GET['month'] <> "Month" and $_GET['year'] <> "Year") {
            $month = $_GET['month'];
            $year = $_GET['year'];

            $date = mktime(12, 0, 0, $month, 1, $year);
            $daysInMonth = date("t", $date);

            $offset = date("w", $date);
            $rows = 1;
            $output = "<h1 style='display:none'>" . date("F Y", $date) . "</h1>\n";
            $output.="<table border='0' class='table' cellspacing='5' cellpadding='5'>\n";
            $output.="\t<tr class = 'tit' style='color:#666666; background-color:#70717C; border:1px solid color #cccccc; color:#C7C7D1' ><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";
            $output.="\n\t<tr bgcolor='#2C2C34'>";
            for ($i = 1; $i <= $offset; $i++) {
                $output.="<td></td>";
            }


            for ($i = 0; $i <= $daysInMonth; $i++) {
                if (substr($temp[] = date("Y-m-d-D", mktime(0, 0, 0, $month, $i, $year)), -3) == "Sun") {
                    $sun[] = substr(date("Y-m-d-D", mktime(0, 0, 0, $month, $i, $year)), 8, -4);
                }
            }


            for ($day = 1; $day <= $daysInMonth; $day++) {
                if (($day + $offset - 1) % 7 == 0 && $day != 1) {
                    $output.="</tr>\n\t<tr bgcolor='#2C2C34'>";
                    $rows++;
                }

                $day = str_pad($day, 2, '0', STR_PAD_LEFT);
                $month = str_pad($month, 2, '0', STR_PAD_LEFT);
                $new_date = $year . '-' . $month . '-' . $day;

                $linked_date = NULL;

                foreach ($check as $v) {
                    if ($v['p_dt'] == $new_date) {
                        $output.="<td bgcolor='#666666' style='text-align:center; padding: 8px 18.5px'><strong><a href='printversion/$year/$month/$day' style='text-decoration:none; color: #FFFFFF;'>" . $day . "</a></strong></td>";
                        $linked_date = $new_date;
                    }
                }
                if ($linked_date != $new_date) {
                    $output.= "<td style='color:#FCFCFC; padding:8px 17.5px'><strong>" . $day . "</strong></td>";
                }
            }
            while (($day + $offset) <= $rows * 7) {
                $output.="<td></td>";
                $day++;
            }
            $output.="</tr>\n";
            $output.="</table>\n";
        } else {
            $output.= "Select Month or Year Option";
        }

        return $output;
    }

    function click_counter($b_id) {
        // echo $b_id;
        $sql = "UPDATE `banner` SET `click` = (click + 1) WHERE `b_id` = '" . $b_id . "'";
        $this->db->query($sql);
    }

    function live() {
        $data['class'] = 'live-tv';
        $this->Model_common4all->common();
        $this->load->view('template', $data);
    }
    
    
     function video($id) {
        $data['class'] = 'video-home';
        $this->Model_common4all->common();
        $data['vid'] = $this->Model_home->VideobyID($id);
        $data['allvideo'] = $this->Model_home->Allvideo($id);
        $this->load->view('template', $data);
    }

      function tag($tag) {
        $data['get_tag'] = $this->Model_home->getTag($tag);
        //print_r($data['get_tag']);
        $data['class'] = 'news-tag';
        $this->Model_common4all->common();
        $this->load->view('template', $data);
    }
	
	function privacy() {
        $data['class'] = 'privacy';
        $this->Model_common4all->common();
        $this->load->view('template', $data);
    }
	
	function terms() {
        $data['class'] = 'terms';
        $this->Model_common4all->common();
        $this->load->view('template', $data);
    }
    function map(){
        $data['class'] = 'vote';
        $data['getCompactVote'] = $this->Model_home->getCompactVote();
        $this->Model_common4all->common();
        $this->load->view('template', $data);
    }
    
    function elecetion_map($dist){
        $this->db->where('dist', $dist);
        $this->db->order_by('seat','ASC');
        $q = $this->db->get('election_result');
        // print $this->db->last_query();exit;
        
        if ($q->num_rows() > 0) {
            $i=1;
            foreach ($q->result_array() as $value) {
                echo '<div class="col-md-4 pieArea">
                <h2>আসন :'.en2bnNumber($value['seat']).' <br><small>('.$value['area'].')</small></h2>
                <ul data-pie-id="svg-'.$i.'" class="details">';
                echo '<li data-value="'.$value['al'].'"><span>আ লীগ('.en2bnNumber($value['al']).')</span></li>';
                echo '<li data-value="'.$value['bnp'].'"><span>বিএনপি('.en2bnNumber($value['bnp']).')</span></li>';
                echo '<li data-value="'.$value['jatiyo'].'"><span>জাপা ('.en2bnNumber($value['jatiyo']).')</span></li>';
                echo '<li data-value="'.$value['sotontro'].'"><span>স্বতন্ত্র ('.en2bnNumber($value['sotontro']).')</span></li>';
                echo '<li data-value="'.$value['others'].'"><span>অন্যান্য ('.en2bnNumber($value['others']).')</span></li>';
                echo '</ul>
                <div class="svg" id="svg-'.$i.'" style="width: 250px;"></div>
                    <table class="table table-bordered" style="width: 98%;">
                        <tr>';
                        if($value['winner'] != ""){
                echo '<td>বিজয়ী</td>
                      <td>'.$value['winner'].'</td>';
                        }
                echo '</tr>
                    </table>
                    <div style="padding:15px 5px;">'.$value['details'].'</div>
                </div>';
            $i++;
            }
        }

    }
    
    
    
    function sitemapcreate($dddd = '') {
        // echo $dddd; exit;
        $this->load->model('admin/url_model');   
        // print_r($dddd); exit;
        if($dddd == 'sections'){
            $data = array();
           // $data['tagList'] = $this->Model_home->allTagList();
            $data['urlslist'] = $this->url_model->getURLS();
            $this->load->view("sitemap-sections", $data);
            return 1;
        }


        if ($dddd != '') {
            if($dddd != ''){
                $s_date = $dddd;
                $e_date = $dddd;
            }else{
                $s_date = date('Y-m-d');
                $e_date = date('Y-m-d');
            }
            
            $data = array();
            //$data['pubdate'] = $this->url_model->pubdate_list();
            // $data['tagList'] = $this->Model_home->allTagList();
            $data['urlslist'] = $this->url_model->getURLS();
            $data['urldetails'] = $this->url_model->getURLdetails($s_date, $e_date);
            // print_r($data); exit;

            //header("Content-Type: text/xml;charset=iso-8859-1");
            $this->load->view("sitemap-daily", $data);
            // $this->session->set_flashdata('message', 'Sucessfully Create');
            // redirect('admin/sitemap', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Please Enter Start date or End Date');
            redirect('/my404', 'refresh');
        }
    }
    
    
    function Allsitemap($year = '') {
        $data['year'] = $year;
        $this->load->view("sitemap",$data);
    }
    
    
    function AllsitemapGoogle($year = '') {
        $data['year'] = $year;
        $this->load->view("sitemap-news",$data);
    }
    
    function google_sitemap($dddd = '') {
        $this->load->model('admin/url_model');
        
        if($dddd != ''){
            $s_date = $dddd;
            $e_date = $dddd;
        }else{
            $s_date = date('Y-m-d');
            $e_date = date('Y-m-d');

        }   
        $data['urldetails'] = $this->url_model->getURLdetails($s_date, $e_date);
        $this->load->view("sitemap-google", $data);
    }

}
?>
