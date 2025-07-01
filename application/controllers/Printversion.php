<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Printversion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_menu');
        $this->load->model('Model_print');
        $this->load->model('Model_home');
        $this->load->model('Model_pages');
        $this->load->model('Model_mag');
        $this->load->model('Model_print_archive');
        $this->load->model('ratings_model', 'ratings');
        $this->load->model('Model_common4all');
        $this->load->model('File_model');
    }
    
    public function __destruct() {
        $this->db->close();
    }

   
    
    // public function printHome($n_year, $n_month, $n_date){
    //     $dt = $n_year . '-' . $n_month . '-' . $n_date;
    //     $data = array();
    //     $data['dt'] = $dt;
    //     $data['class'] = 'home-print';
    //     $data['print_menu'] = $this->Model_print->getPrintMenu($dt);
    //     $data['lead_news'] = $this->Model_print->PrintLeadNews($dt);
    //     $data['firstpage_other'] = $this->Model_print->Print_1stPageNews($data['lead_news']['n_id'],$dt);
    //     $data['mag_screen'] = $this->Model_mag->get_Mag_screen($dt);
        
    //     $this->Model_common4all->common();
    //     $this->output->cache(5);
    //     $this->load->vars($data);
    //     $this->load->view('template');
    // }
    
    public function printHome($n_year, $n_month, $n_date){
        $dt = $n_year . '-' . $n_month . '-' . $n_date;  
        // $data = array(); 
        $data['dt'] = $dt;     
        $data['pub_date'] = $this->Model_print->pubdate_list();

        if($data['pub_date']['pdt'] == $dt){
        
        $data['dt'] = $dt; 
        $data = $this->File_model->readCommon();
        $data['class'] = 'home-print';
        $data = array_merge($data, $this->File_model->read_file('PrintHome'));

        }else{
        $data['class'] = 'home-print';
        $data['print_menu'] = $this->Model_print->getPrintMenu($dt);
        $data['lead_news'] = $this->Model_print->PrintLeadNews($dt);
        $data['firstpage_other'] = $this->Model_print->Print_1stPageNews($data['lead_news']['n_id'],$dt);
        $data['mag_screen'] = $this->Model_mag->get_Mag_screen($dt);
        $this->Model_common4all->common();
        }

        $this->output->cache(5);
        $this->load->vars($data);
        $this->load->view('template');
    }

     function search_date(){
            $data['class'] = 'search-date';
            $this->Model_common4all->common();
            $this->load->vars($data);
            $this->load->view('template', $data);
    }

     



    public function details($n_cat, $n_year, $n_month, $n_date, $n_id) {


//        $dt = $n_year.'-'.$n_month.'-'.$n_date;
//        $data['dt'] = $dt;
//        $date = $n_year.'/'.$n_month.'/'.$n_date;
//        $details = $this->file_model->readfile($n_id,$date);
//        if($details == NULL || $details['n_status']!='3'){
//            $cat = $this->Model_menu->getCategory($n_cat);
//            $details = $this->Model_print->getNewsbyID($cat['m_id'], $n_year, $n_month, $n_date, $n_id);
//            if($details == NULL || $details['n_status']!='3'){
//                redirect('/my404'); 
//            }
//        }
//        $data['getnewsby_id'] = $details;
        $dt = $n_year . '-' . $n_month . '-' . $n_date;
        $data['dt'] = $dt;
        $date = $n_year . '/' . $n_month . '/' . $n_date;
        $details = $this->Model_print->getNewsbyID($cat_id, $n_year, $n_month, $n_date, $n_id);
        if ($details == NULL || $details['n_status'] != '3') {

            $cat_id = $this->Model_menu->getMenuID(str_replace('_', '-', $n_cat));
            if ($cat_id == 0) {
                redirect('my404');
            }

            $data['dt'] = $dt;
            $data['getnewsby_id'] = $this->Model_print->getNewsbyID($cat_id, $n_year, $n_month, $n_date, $n_id);
            $data['getmenu'] = $this->Model_menu->getMenubyID($data['getnewsby_id']['n_category'], $dt);
            $data['more_news'] = $this->Model_pages->getMorenewsbyID($data['getnewsby_id']['n_category'], $n_id);
            $data['related'] = $this->Model_pages->related_news($n_id);
            $data['class'] = 'post';
            // $this->File_model->create_file($n_id, $cat_id);
            $this->Model_common4all->common();
        } else {
            // $data = $this->File_model->readfile($n_id, $date);
            
        }
        $this->output->cache(50);
        $this->load->view('template', $data);
    }

    // function type($m_name, $y, $m, $d) {
    //     $dt = $y . '-' . $m . '-' . $d;
    //     $data = array();
    //     $data['dt'] = $dt;
    //     $data['class'] = 'print-pagesnews';
    //     $data['getmenu'] = $this->Model_menu->getCategory($m_name);
    //     // print_r($data['getmenu']['m_type']);exit;
    //     $data['category_leadnews'] = $this->Model_print->getCategoryLeadNews($data['getmenu']['m_id'], $dt);
    //     $data['more_news'] = $this->Model_print->getCategoryNews($data['getmenu']['m_id'], $data['category_leadnews']['n_id'], $dt);

    //     $this->Model_common4all->common();
    //     $this->load->vars($data);
    //     $this->load->view('template', $data);
    // }



    function type($m_name, $y, $m, $d) {
        $dt = $y . '-' . $m . '-' . $d;
        $data = array();
        $data['dt'] = $dt;
        $data['getmenu'] = findMenuinfo($m_name);
        if($data['getmenu']['m_type'] != 'magazine'){
        $data['pub_date'] = $this->Model_print->pubdate_list();

        if($data['pub_date']['pdt'] == $dt){
            $data = $this->File_model->readCommon();
            $data['class'] = 'print-pagesnews';
            
            $data['getmenu'] = findMenuinfo($m_name);
            // print_r($data['getmenu']['m_type']);exit;
            $cat_array = $this->File_model->read_file('print_news_all');
            $cat_name = str_replace('_','-',$m_name);
            $cat_news = $cat_array[$cat_name];
            if (isset($cat_news[0])) {
            $category_leadnews = $cat_news[0];
            unset($cat_news[0]);
            }else{
                $category_leadnews=[];
            }


            if (count($cat_news)>0) {
                $more_news = $cat_news;
            }else{
                $more_news = [];
            }

            $data['category_leadnews'] = $category_leadnews;
             $data['more_news'] = $more_news;
                // $data['category_leadnews'] = $this->Model_print->getCategoryLeadNews($data['getmenu']['m_id'], $dt);
                // $data['more_news'] = $this->Model_print->getCategoryNews($data['getmenu']['m_id'], $data['category_leadnews']['n_id'], $dt);
            }
            else{
                $data['dt'] = $dt;
                $data['class'] = 'print-pagesnews';
                $data['getmenu'] = $this->Model_menu->getCategory($m_name);
                
                $data['category_leadnews'] = $this->Model_print->getCategoryLeadNews($data['getmenu']['m_id'], $dt);
                $data['more_news'] = $this->Model_print->getCategoryNews($data['getmenu']['m_id'], $data['category_leadnews']['n_id'], $dt);

                $this->Model_common4all->common();
            }
        }else{
                // $data['dt'] = $dt;
                // $data['class'] = 'print-pagesnews';
                // $data['getmenu'] = $this->Model_menu->getCategory($m_name);
                
                // $data['category_leadnews'] = $this->Model_print->getCategoryLeadNews($data['getmenu']['m_id'], $dt);
                // $data['more_news'] = $this->Model_print->getCategoryNews($data['getmenu']['m_id'], $data['category_leadnews']['n_id'], $dt);

                // $this->Model_common4all->common();
                
                $data = $this->File_model->readCommon();
                $data['class'] = 'print-pagesnews';
                
                $data['getmenu'] = findMenuinfo($m_name);
                $cat_array = $this->File_model->read_file('mag_cat_news');

                $cat_name = str_replace('_','-',$m_name);
                $cat_news = $cat_array[$cat_name];

               
                
                if (isset($cat_news[0])) {
                $category_leadnews = $cat_news[0];
                unset($cat_news[0]);
                }else{
                    $category_leadnews=[];
                }


                if (count($cat_news)>0) {
                    $more_news = $cat_news;
                }else{
                    $more_news = [];
                }

                $data['category_leadnews'] = $category_leadnews;
                $data['more_news'] = $more_news;
            }

            $this->load->vars($data);
            $this->output->cache(5);
            $this->load->view('template', $data);
    }
    
    
    function cat($m_name, $y = '', $m = '', $d = '', $id = '') {
        /*
         * if get id then go to details
         * if get year then go to archive category
         *  else go to printversion category
         */
        if (!empty($id)) {
//            echo "okk";exit();
            $this->details($m_name, $y, $m, $d, $id);
        } elseif (!empty($y)) {

            // $this->archive($y, $m, $d);
            $this->load->model('Model_print_archive');
            $dt = $y . '-' . $m . '-' . $d;
            $data = array();
            $data['dt'] = $dt;
            $data['class'] = 'print-pagesnews-arc';

            $data['getmenu'] = $this->Model_menu->getCategory($m_name);
            $data['category_leadnews'] = $this->Model_print_archive->getCategoryLeadNews($data['getmenu']['m_id'], $dt);
            $data['category_2ndlead'] = $this->Model_print_archive->getCategory2ndNews($data['getmenu']['m_id'], $data['category_leadnews']['n_id'], $dt);
            $data['get_news_bycat'] = $this->Model_print_archive->getCategoryNews($data['getmenu']['m_id'], $data['category_leadnews']['n_id'], $dt);
            $data['most_read'] = $this->Model_print_archive->most_read_count_print($dt);
            $this->Model_common4all->common();
            $this->load->vars($data);
            $this->load->view('template', $data);
        } else {
            $data = array();
            $data['class'] = 'print-pagesnews';
            $data['getmenu'] = $this->Model_menu->getCategory($m_name);
            $data['category_leadnews'] = $this->Model_print->getCategoryLeadNews($data['getmenu']['m_id']);
            $data['category_2ndlead'] = $this->Model_print->getCategory2ndNews($data['getmenu']['m_id'], $data['category_leadnews']['n_id']);
            $data['get_news_bycat'] = $this->Model_print->getCategoryNews($data['getmenu']['m_id'], $data['category_leadnews']['n_id']);

            $data['latest_news'] = $this->Model_home->LatestNews();
            $data['most_read'] = $this->Model_print->most_read_count_print();
            $this->Model_common4all->common();
            $this->output->cache(5);
            $this->load->vars($data);
            $this->load->view('template', $data);
        }
    }

   

    



    

    function keywordsearch() {
        $keyword = $this->input->post('search_box');
        $data['banner'] = $this->Model_print->banner();
        $data['class'] = 'keywordsearch';
        $this->Model_common4all->common();
        $config['base_url'] = base_url() . 'home/keywordsearch/' . $keyword;
        $config['total_rows'] = $this->Model_print->search_keyword_total($keyword);
        $config['per_page'] = 12;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);

        if ($this->uri->segment(4) == TRUE) {
            $from = $this->uri->segment(4);
        } else {
            $from = 0;
        }
        $limit = $from . ', ' . $config['per_page'];
        $data['links'] = $this->pagination->create_links();
        $data['result'] = $this->Model_print->search_keyword($keyword, $limit);
        $this->load->view('template', $data);
    }

    function rss() {
        $data['title'] = 'The Lead News RSS Page';
        //$data['body'] = 'search';
        $data['rss_data'] = $this->Model_print->rss();
        $this->load->view('rssfeed/rss', $data);
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
        $output = "<table border='0' cellspacing='0' cellpadding='0'><tr class = 'tit'><td><div'><select style='color:#666666; font-weight:bold; border:1px solid #666666;width:120px;' name='month' onChange='dateShowPrint()' id='month'>";
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
        $output.="</select></div></td></tr></table><table border='0'><tr><td id='dateShow1'>";


        $month = date("m");
        $year = date("Y");
        $day = date("d");

        $date = mktime(12, 0, 0, $month, 1, $year);
        $daysInMonth = date("t", $date);
        $offset = date("w", $date);
        $rows = 1;
        //$output.="<h1>" . date("F Y", $date) . "</h1>\n";
        $output.="<table border='0' class='table' cellspacing='2' cellpadding='2'>\n";
        $output.="\t<tr class= 'tit' style='color:#666666;'><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri
					</th><th>Sat</th></tr>";
        $output.="\n\t<tr bgcolor='#DCE7F0'>";
        for ($i = 1; $i <= $offset; $i++) {
            $output.="<td></td>";
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            if (($day + $offset - 1) % 7 == 0 && $day != 1) {
                $output.="</tr>\n\t<tr bgcolor='#DCE7F0'>";
                $rows++;
            }

            $day = str_pad($day, 2, '0', STR_PAD_LEFT);
            $new_date = $year . '-' . $month . '-' . $day;

            $linked_date = NULL;

            foreach ($check as $v) {
                if ($v['n_date'] == $new_date) {
                    $output.="<td bgcolor='#666666' style='text-align:center'><strong><a href='archive/$year/$month/$day' style='text-decoration:none; color:#FFFFFF;'>" . $day . "</a></strong></td>";
                    $linked_date = $new_date;
                }
            }
            if ($linked_date != $new_date) {
                $output.= "<td style='color:#FCFCFC'><strong>" . $day . "</strong></td>";
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
            $output.="<table border='0' class='table' cellspacing='2' cellpadding='2'>\n";
            $output.="\t<tr class = 'tit' style='color:#666666;' ><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";
            $output.="\n\t<tr bgcolor='#DCE7F0'>";
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
                    $output.="</tr>\n\t<tr bgcolor='#DCE7F0'>";
                    $rows++;
                }

                $day = str_pad($day, 2, '0', STR_PAD_LEFT);
                $month = str_pad($month, 2, '0', STR_PAD_LEFT);
                $new_date = $year . '-' . $month . '-' . $day;

                $linked_date = NULL;

                foreach ($check as $v) {
                    if ($v['n_date'] == $new_date) {
                        $output.="<td bgcolor='#666666' style='text-align:center'><strong><a href='archive/$year/$month/$day' style='text-decoration:none; color:#FFFFFF;'>" . $day . "</a></strong></td>";
                        $linked_date = $new_date;
                    }
                }
                if ($linked_date != $new_date) {
                    $output.= "<td style='color:#FCFCFC'><strong>" . $day . "</strong></td>";
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

}
