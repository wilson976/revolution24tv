<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arcprint extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_menu');
        $this->load->model('Model_print_archive');
        $this->load->model('Model_print');
        $this->load->model('Model_pages');
    }

    public function common4all() {
        $data['breakingnews'] = $this->Model_home->BreakingNews();
        $data['headllines'] = $this->Model_home->HeadlineNews();
        $data['latest_news'] = $this->Model_home->LatestNews();
        $data['most_read'] = $this->Model_home->most_read_count();
        $data['banner'] = $this->Model_home->banner();
        $data['horoscope'] = $this->Model_home->HoroscopeDaily();
        $data['ticker'] = $this->Model_home->HomeTicker();
        $data['online_menu'] = $this->Model_menu->create_Onlinemenu();
        $data['footernews'] = $this->Model_home->FooterNews();
        $data['featurevid'] = $this->Model_home->FooterVideo();
        $data['lastNewsTime'] = $this->Model_home->TimeofLastNews(); 
	   $data['footer_tag'] = $this->Model_home->FooterTag();
        $data['printmenu'] = $this->Model_menu->create_Printmenu();
        $this->load->vars($data);
    }

    public function home($year,$month,$date) {
        $dt = $year.'-'.$month.'-'.$date;
//        $dt = str_replace('_','-',$dt);
        //echo $dt;
        
        $data = array();
        $data['class'] = 'home-print-arc';
        $data['arcnews'] = $this->Model_print_archive->ArchiveNewsAll($dt);
        $data['dt'] = $dt;
        $this->common4all();
        $data['calendar'] = $this->showCalender();
        $this->load->vars($data);
        $this->load->view('template');
        // $this->load->view('welcome_message');
    }

    public function details($n_cat, $n_year, $n_month, $n_date,$n_id, $n_head, $dt) {
        $dt = $n_year.'-'.$n_month.'-'.$n_date;
        
         $db = & DB();
        $db->select('m_id');
        $db->from('menu');
        $db->where('m_bangla', str_replace('_', '-', $n_cat));
        $query = $db->get();
        $q = $query->row();
        $cat_id = '';
        if ($query->num_rows() == 0) {
            redirect('my404');
        } else {
            $cat_id = $q->m_id;
        }
        $data['class'] = 'print-post-arc';
        $data['dt'] = $dt;
        $data['getnewsby_id'] = $this->Model_print_archive->getNewsbyID($n_id, $dt);
        $data['getmenu'] = $this->Model_menu->getMenubyID($data['getnewsby_id']['n_category'], $dt);
        $data['more_news'] = $this->Model_print_archive->getMorenewsbyID($data['getnewsby_id']['n_category'], $n_id, $dt);
        $data['related'] = $this->Model_print_archive->related_news($n_id, $dt);
        $data['most_read'] = $this->Model_print_archive->most_read_count_print($dt);

        $this->Model_pages->most_read($n_id);
        $this->common4all();
        $this->load->view('template', $data);
    }

    function type($m_name, $y,$m,$dt) {
        $dt = $y.'-'.$m.'-'.$d;
        $data = array();
        $data['dt'] = $dt;
        $data['class'] = 'print-pagesnews-arc';
        $data['getmenu'] = $this->Model_menu->getCategory($m_name);
        $data['category_leadnews'] = $this->Model_print_archive->getCategoryLeadNews($data['getmenu']['m_id'], $dt);
        $data['category_2ndlead'] = $this->Model_print_archive->getCategory2ndNews($data['getmenu']['m_id'], $data['category_leadnews']['n_id'], $dt);
        $data['get_news_bycat'] = $this->Model_print_archive->getCategoryNews($data['getmenu']['m_id'], $data['category_leadnews']['n_id'], $dt);
        $data['most_read'] = $this->Model_print_archive->most_read_count_print($dt);
        $this->common4all();
        $this->load->vars($data);
        $this->load->view('template', $data);
    }
    
    function search_refreash($keyword) {
        if ($keyword != '') {
            $auto_result = $this->Model_print->search_refreash($keyword);
        }
        if ($auto_result != NULL) {
            foreach ($auto_result as $rs) {
                // put in bold the written text
                //$tag = str_replace($keyword, '<b>' . $keyword . '</b>', $rs['tag']);
                // add new option
                echo '<li>' . '<i class="icon-picture" style="margin-right: 5px;"></i> <a href="' . $rs['n_id'] . '/' . replace_dashes($rs['n_head']) . '">' . strip_tags($rs['n_head']) . '</a>' . '</li>';
            }
        }
        //return $output;
    }

    function keywordsearch() {
        $keyword = $this->input->post('search_box');
        $data['banner'] = $this->Model_print->banner();
        $data['class'] = 'keywordsearch';
        $this->common4all();
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

    function showCalender() {
        $check = $this->Model_print->dynamic_calendar();
        //print_r ($check);
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
                if ($v['n_date'] == $new_date) {
                    $output.="<td bgcolor='#666666' style='text-align:center; '><strong><a href='archive/$year/$month/$day' style='text-decoration:none; color:#FFFFFF;'>" . $day . "</a></strong></td>";
                    $linked_date = $new_date;
                }
            }
            if ($linked_date != $new_date) {
                $output.= "<td style='color:#FCFCFC; padding:8px 18.5px'><strong>" . $day . "</strong></td>";
            }
        }
        while (($day + $offset) <= $rows * 7) {
            $output.="<td></td>";
            $day++;
        }
        $output.="</tr>\n</table>\n</td></tr></table>";

        return $output;
    }

    
    

}
