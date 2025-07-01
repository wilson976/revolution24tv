<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Online extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_pages');
        $this->load->library("pagination");
        $this->load->model('Model_print');
        $this->load->model('Model_common4all'); 
        $this->load->model('Model_home');
        $this->load->model('File_model');
    }
    
    public function __destruct() {
        $this->db->close();
    }

    

    // function type($m_name) {
    //     // echo $this->uri->segment(1);

    //     $data = array();
    //     $data['class'] = 'online';
    //     $data['getmenu'] = $this->Model_menu->getCategory($m_name);
    //     // print_r($data['getmenu']['m_type']);exit;
    //     $data['getsubmenu'] = $this->Model_menu->getSubCategory($data['getmenu']['m_id']);
    //     $data['menu_name'] = replace_underscore($m_name);

    //     $data['category_leadnews'] = $this->Model_pages->getCategoryLeadNews($data['getmenu']['m_id']);
    //     $cat_lead_id = $data['category_leadnews']['n_id'];

    //     if ($this->uri->segment(2) != NULL) {
    //         $data['category_leadnews'] = '';
    //     }

    //     if($this->uri->segment(2)== 'article'){
    //     $data['getchildmenu'] = $this->Model_menu->getChildCategory($data['getmenu']['m_id']);
    //     $data['menu_name'] = replace_underscore($m_name);
    //     $data['getmenu'] = $this->Model_menu->getCategory($m_name);
    //     $data['category_leadnews'] = $this->Model_pages->getCategoryLeadNewsArticle($data['getmenu']['m_id']);
    //     $cat_lead_id = $data['category_leadnews']['n_id'];
    //     $data['more_news'] = $this->Model_pages->ParentMorenewsbyID($data['getmenu']['m_id'], $data['category_leadnews']['n_id']);
    //     }

       
    //     $config['base_url'] = base_url() .''. $data['getmenu']['m_bangla'];
    //     $config['total_rows'] = $this->Model_pages->search_total($data['getmenu']['m_id'])-1;
    //     // print_r($config['total_rows'] );exit;
    //     $config['per_page'] = 12;
    //     $config['uri_segment'] = 2;        
        
    //     $config["full_tag_open"] = '<ul class="pagination">';
    //     $config["full_tag_close"] = '</ul>';    
    //     $config["first_link"] = "&laquo;";
    //     $config["first_tag_open"] = "<li>";
    //     $config["first_tag_close"] = "</li>";
    //     $config["last_link"] = "&raquo;";
    //     $config["last_tag_open"] = "<li>";
    //     $config["last_tag_close"] = "</li>";
    //     $config['next_link'] = '&gt;';
    //     $config['next_tag_open'] = '<li>';
    //     $config['next_tag_close'] = '<li>';
    //     $config['prev_link'] = '&lt;';
    //     $config['prev_tag_open'] = '<li>';
    //     $config['prev_tag_close'] = '<li>';
    //     $config['cur_tag_open'] = '<li class="active"><a href="#">';
    //     $config['cur_tag_close'] = '</a></li>';
    //     $config['num_tag_open'] = '<li>';
    //     $config['num_tag_close'] = '</li>';
        
    //     $this->pagination->initialize($config);
    //     $limit = $config['per_page'];

    //      if ($this->uri->segment(2) == NULL) {
    //         $data['more_news'] = $this->Model_pages->getMorenewsbyID($data['getmenu']['m_id'], $data['category_leadnews']['n_id'],$limit);
    //     } else {
    //         $data['more_news'] = $this->Model_pages->getMorenewsbyID($data['getmenu']['m_id'],$cat_lead_id,$limit);
    //     }
    //     $data['links'] = $this->pagination->create_links();
        
        
    //     $this->Model_common4all->common();

    //     $this->output->cache(5);
    //     $this->load->vars($data);
    //     $this->load->view('template', $data);
    // }
    
    
    
    function type($m_name) {
        // echo $this->uri->segment(1);

        $data = array();
        $data = $this->File_model->readCommon();
        $data['class'] = 'online';
        $data['getmenu'] = findMenuinfo($m_name);
        // // print_r($data['getmenu']['m_type']);exit;
        // $data['getsubmenu'] = $this->Model_menu->getSubCategory($data['getmenu']['m_id']);
        $data['menu_name'] = replace_underscore($m_name);
        $data['editorchoise'] = $this->Model_home->Editorschoise();
        
        // $data['category_leadnews'] = $this->Model_pages->getCategoryLeadNews($data['getmenu']['m_id']);
        // $cat_lead_id = $data['category_leadnews']['n_id'];
        $cat_news = $this->File_model->read_morenews($m_name);

        if (isset($cat_news[0])) {
            $category_leadnews = $cat_news[0];
            unset($cat_news[0]);
        }else{
            $category_leadnews=[];
        }
         $data['category_leadnews'] = $category_leadnews;

        $cat_lead_id = $data['category_leadnews']['n_id'];
        
        if ($this->uri->segment(3) != NULL) {
            $data['category_leadnews'] = '';
        }

        if (count($cat_news)>0) {
            $get_news_bycat = $cat_news;
        }else{
            $get_news_bycat = [];
        }



        

       
        $config['base_url'] = base_url() .'online/'. $data['getmenu']['m_bangla'];
        $config['total_rows'] = $this->Model_pages->search_total($data['getmenu']['m_id'])-1;
        // print_r($config['total_rows'] );exit;
        $config['per_page'] = 22;
        $config['uri_segment'] = 3;        
        
        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';    
        $config["first_link"] = "&laquo;";
        $config["first_tag_open"] = "<li>";
        $config["first_tag_close"] = "</li>";
        $config["last_link"] = "&raquo;";
        $config["last_tag_open"] = "<li>";
        $config["last_tag_close"] = "</li>";
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '<li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '<li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        $limit = $config['per_page'];

         if ($this->uri->segment(3) == NULL) {
            // $data['more_news'] = $this->Model_pages->getMorenewsbyID($data['getmenu']['m_id'], $data['category_leadnews']['n_id'],$limit);
            $data['more_news'] = $get_news_bycat;
        } else {
            $data['more_news'] = $this->Model_pages->getMorenewsbyID($data['getmenu']['m_id'],$cat_lead_id,$limit);
        }
        $data['links'] = $this->pagination->create_links();
        // $this->Model_common4all->common();

        $this->output->cache(5);
        $this->load->vars($data);
        $this->load->view('template', $data);
    }


    function pType($m_name) {
        // echo $this->uri->segment(1);
        $data = array();
        $data['class'] = 'online-Parent';
        $data['getmenu'] = $this->Model_menu->getCategory($m_name);
        // print_r($data['getmenu']['m_type']);exit;
        $data['getchildmenu'] = $this->Model_menu->getChildCategory($data['getmenu']['m_id']);
        $data['menu_name'] = replace_underscore($m_name);

        $data['category_leadnews'] = $this->Model_pages->getCategoryLeadNews($data['getmenu']['m_id']);
        $cat_lead_id = $data['category_leadnews']['n_id'];


        $data['more_news'] = $this->Model_pages->ParentMorenewsbyID($data['getmenu']['m_id'], $data['category_leadnews']['n_id']);
        
        
        
        $this->Model_common4all->common();

        $this->output->cache(2);
        $this->load->vars($data);
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
