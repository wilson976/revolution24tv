<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Magazine extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_menu');
        $this->load->model('Model_friday');
        $this->load->model('Model_home');
        $this->load->model('Model_pages');
        $this->load->model('ratings_model', 'ratings');
    }

    public function common4all() {
        $data['breakingnews'] = $this->Model_home->BreakingNews();
        $data['justnews'] = $this->Model_home->JustNews();
        $data['headllines'] = $this->Model_home->HeadlineNews();
        $data['friday_head'] = $this->Model_home->GetMagPubDate();
        $data['printmenu'] = $this->Model_menu->create_Printmenu();
        $data['banner'] = $this->Model_home->banner();
        $this->load->vars($data);
    }
    public function mag($y = '', $m = '', $d = '', $id = '')
    {
        if(!empty($id)){
            $this->details($id);
        }
        else{
            $this->type('friday');
        }
    }

    public function details($n_id) {
        $data['class'] = 'print-post';
        $data['getnewsby_id'] = $this->Model_friday->getNewsbyID($n_id);
        $data['getmenu'] = $this->Model_menu->getMenubyID($data['getnewsby_id']['n_category']);
        $data['more_news'] = $this->Model_friday->getMorenewsbyID($data['getnewsby_id']['n_category'], $n_id);
        $data['related'] = $this->Model_friday->related_news($n_id);
        $data['latest_news'] = $this->Model_home->LatestNews();
        $data['most_read'] = $this->Model_friday->most_read_count_print();

        $this->Model_pages->most_read($n_id);
        $this->common4all();
        $this->load->view('template', $data);
    }

    function type($m_name) {
        $data = array();
        $data['class'] = 'print-pagesnews';
        $data['getmenu'] = $this->Model_menu->getCategory($m_name);
        $data['category_leadnews'] = $this->Model_friday->getCategoryLeadNews($data['getmenu']['m_id']);
        $data['category_2ndlead'] = $this->Model_friday->getCategory2ndNews($data['getmenu']['m_id'], $data['category_leadnews']['n_id']);
        $data['get_news_bycat'] = $this->Model_friday->getCategoryNews($data['getmenu']['m_id'], $data['category_leadnews']['n_id']);

        $data['latest_news'] = $this->Model_home->LatestNews();
        $data['most_read'] = $this->Model_friday->most_read_count_print();
        $this->common4all();
        $this->load->vars($data);
        $this->load->view('template', $data);
    }

    function search_refreash($keyword) {
        if ($keyword != '') {
            $auto_result = $this->Model_friday->search_refreash($keyword);
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
        $data['banner'] = $this->Model_friday->banner();
        $data['class'] = 'keywordsearch';
        $this->common4all();
        $config['base_url'] = base_url() . 'home/keywordsearch/' . $keyword;
        $config['total_rows'] = $this->Model_friday->search_keyword_total($keyword);
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
        $data['result'] = $this->Model_friday->search_keyword($keyword, $limit);
        $this->load->view('template', $data);
    }

    function rss() {
        $data['title'] = 'The Lead News RSS Page';
        //$data['body'] = 'search';
        $data['rss_data'] = $this->Model_friday->rss();
        $this->load->view('rssfeed/rss', $data);
    }

    function archive($n_date) {
        $data['arccat'] = $this->Model_friday->getArchiveCat($n_date);
        $data['class'] = 'online-archive';
        $data['calendar'] = $this->showCalender();
        $this->common4all();
        $this->load->view('template', $data);
    }

    function archive_calendar() {
        $data['calendar'] = $this->ChangeShow();
        $this->load->view('archive1', $data);
    }

    function showCalender() {
        $check = $this->Model_friday->dynamic_calendar();
        //   print_r ($check['n_date']);
        $mon = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "Decmber");
        $output = "<table border='0' cellspacing='0' cellpadding='0'><tr class = 'tit'><td><div'><select style='color:#0061B6; font-weight:bold; border:1px solid #BCC5D3;width:120px;' name='month' onChange='dateShowPrint()' id='month'>";
        for ($i = 1; $i <= 12; $i++) {
            if ($i == date('n')) {
                $output.='<option value ="' . $i . '"' . ' ' . 'selected="selected"' . '>' . $mon[$i - 1] . '</option>';
            } else {
                $output.='<option value ="' . $i . '"' . '>' . $mon[$i - 1] . '</option>';
            }
        }
        $output.="</select></div></td><td><div style='margin-left:20px;'><select style='color:#0061B6; font-weight:bold; border:1px solid #BCC5D3; width:98px;' name='year'  onChange='dateShowPrint()' id='year'>";
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
        $output.="<table border='0' cellspacing='4' cellpadding='3'>\n";
        $output.="\t<tr class= 'tit' style='color:#0061B6;'><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri
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
                if ($v['p_dt'] == $new_date) {
                    $output.="<td bgcolor='#BCC5D3'><strong><a href='arcprint/home/$year-$month-$day' style='text-decoration:none'>" . $day . "</a></strong></td>";
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
        $check = $this->Model_friday->dynamic_calendar();
        if ($_GET['month'] <> "Month" and $_GET['year'] <> "Year") {
            $month = $_GET['month'];
            $year = $_GET['year'];

            $date = mktime(12, 0, 0, $month, 1, $year);
            $daysInMonth = date("t", $date);

            $offset = date("w", $date);
            $rows = 1;
            $output = "<h1 style='display:none'>" . date("F Y", $date) . "</h1>\n";
            $output.="<table border='0' cellspacing='4' cellpadding='3'>\n";
            $output.="\t<tr class = 'tit' style='color:#0061B6;' ><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";
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
                    if ($v['p_dt'] == $new_date) {
                        $output.="<td bgcolor='#BCC5D3'><strong><a href='./arcprint/home/$year-$month-$day' style='text-decoration:none'>" . $day . "</a></strong></td>";
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
