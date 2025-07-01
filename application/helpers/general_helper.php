<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function test_method($var = '') {
    return $var . 'tested';
}

function search($array, $key, $value) {
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value)
            $results[] = $array;

        foreach ($array as $subarray)
            $results = array_merge($results, search($subarray, $key, $value));
    }

    return $results;
}

function replace_coma($string) {
    $string = str_replace(",", " ", $string);
    $string = str_replace(".", " ", $string);
    $string = str_replace(";", " ", $string);
    return $string;
}

function replace_tags($string) {
    $string = str_replace("<p><img", "<img", $string);
    $string = str_replace("/></p>", "/>", $string);
    $string = str_replace("<p><iframe", "<iframe", $string);
    $string = str_replace("</iframe></p>", "</iframe>", $string);
    $string = str_replace("<br>", "", $string);
    $string = str_replace("<br />", "", $string);
    $string = str_replace("<br/>", "", $string);
    $string = str_replace("\\\"", "\"", $string);
    $string = str_replace("/assets", "http://www.revolution24.tv/assets", $string);
    return $string;
}


function replace_newlinetags($string) {
    $string = str_replace("\n", "", $string);
    return $string;
}

function date_difference($start, $end = "NOW") {
    $timeshift = false;
    $sdate = strtotime($start);
    $edate = strtotime($end);

    $time = $edate - $sdate;

    if ($time >= 0 && $time <= 59) {
        // Seconds
        if ($time == 1) {
            $s = 'second';
        } else {
            $s = 'seconds';
        }
        $timeshift = $time . " " . $s;
    } elseif ($time >= 60 && $time <= 3599) {
        // Minutes + Seconds
        $pmin = ($edate - $sdate) / 60;
        $premin = explode('.', $pmin);
        if ($premin[0] == 1) {
            $m = 'min';
        } else {
            $m = 'min';
        }

        //  $presec = $pmin-$premin[0];
        //$sec = $presec*60;

        $timeshift = $premin[0] . " " . $m; //.round($sec,0); // sec ';
    } elseif ($time >= 3600 && $time <= 86399) {
        // Hours + Minutes
        $phour = ($edate - $sdate) / 3600;
        $prehour = explode('.', $phour);

        $premin = $phour - $prehour[0];
        $min = explode('.', $premin * 60);
        if ($prehour[0] > 1) {
            $h = 'hours';
        } else {
            $h = 'hour';
        }
        if ($min[0] == 1) {
            $m = 'min';
        } else {
            $m = 'min';
        }

        //     $presec = '0.'.$min[1];
        //    $sec = $presec*60;

        $timeshift = $prehour[0] . " " . $h . " " . $min[0] . " " . $m; //.round($sec,0).' sec ';
    } elseif ($time >= 86400) {
        // Days + Hours + Minutes
        $pday = ($edate - $sdate) / 86400;
        $preday = explode('.', $pday);

        $phour = $pday - $preday[0];
        $prehour = explode('.', $phour * 24);

        $premin = ($phour * 24) - $prehour[0];
        $min = explode('.', $premin * 60);

        //     $presec = '0.'.$min[1];
        //    $sec = $presec*60;


        if ($preday[0] > 1) {
            $d = 'days';
        } else {
            $d = 'day';
        }
        if ($prehour[0] > 1) {
            $h = 'hours';
        } else {
            $h = 'hour';
        }
        if ($min[0] == 1) {
            $m = 'min';
        } else {
            $m = 'min';
        }

        $timeshift = $preday[0] . " " . $d . " " . $prehour[0] . " " . $h . " " . $min[0] . " " . $m;
    }
    return $timeshift . ' ago';
}

function datedifference($string) {
    $cur_date = date('Y-m-d H:i:s');
    $string = $string->diff($cur_date);
    return $string;
}

function DeleteCache($file){
    $dir= './application/cache/'.$file;
    //echo $dir; exit;
    //$dir2= '@ppMob!le/cache/'.$file;
    if(file_exists($dir)){
        @unlink($dir);
        //@unlink($dir2);
        return TRUE;
    }else{
        return FALSE;
    }
}

function en2hijrimonth($date) {
    if($date == 'Shaʿbān'){
        return 'শা’বান';
    }elseif($date == 'Ramaḍān'){
        return 'রমজান';
    }elseif($date == 'Shawwāl'){
        return 'শাওয়াল';
    }elseif($date == 'Dhū al-Qaʿdah'){
        return 'জিলক্বদ';
    }elseif($date == 'Dhū al-Ḥijjah"'){
        return 'জিলহজ্জ';
    }elseif($date == 'Muḥarram'){
        return 'মুহররম';
    }elseif($date == 'Ṣafar'){
        return 'সফর';
    }elseif($date == 'Rabīʿ al-awwal'){
        return 'রবিউল আউয়াল';
    }elseif($date == 'Rabīʿ al-thānī'){
        return 'রবিউছ ছানি';
    }elseif($date == 'Jumādá al-ūlá'){
        return 'জামাদিউল আউয়াল';
    }elseif($date == 'Jumādá al-ākhirah'){
        return 'জামাদিউছ ছানি';
    }elseif($date == 'Rajab'){
        return 'রজব';
    }
}

function mythumb($name) {
    $ext = explode('.', $name);
    $data = $ext[0] . '_thumb.' . $ext[1];

    return $data;
}

function mymediam($name) {
    $ext = explode('.', $name);
    $data = $ext[0] . '_mediam.' . $ext[1];

    return $data;
}

function getMonthString($n) {
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);
    return date("M", $timestamp);
}

function replace_underscore($string) {
    $string = str_replace("_", "-", $string);
    return $string;
}

function replace_space($string) {
    $string = str_replace(" ", "-", $string);
    return $string;
}

function replace_dashes($string) {
    $string = str_replace("'", "", $string);
    $string = str_replace(";", "", $string);
    $string = str_replace(",", "", $string);
    $string = str_replace("(", "", $string);
    $string = str_replace(")", "", $string);
    $string = str_replace("!", "", $string);
    $string = str_replace(" ", "-", $string);
    return $string;
}

function remove_newline($string) {
    $string = str_replace("\n", "", $string);
    return $string;
}

function PregRemove($text){
    $text = preg_replace("/&#?[a-z0-9]+;/i","",$text);
    return $text;
  }

function array_sort($array, $on, $order = SORT_ASC) {
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

/* function splitText($text, $maxLength) {
  if (strlen($text) > $maxLength) {
  $text = substr($text, 0, $maxLength - 1);
  while (substr($text, -1) != ' ') {
  $text = substr($text, 0, -1);
  }
  $text = rtrim($text);
  }
  return $text;
  } */

function splitText($text, $maxLength) {
    if (strlen($text) > $maxLength) {
        $text1 = character_limiter($text, .4*$maxLength);
        $text = rtrim($text1);
    }
    return $text;
}

function convert_number($eng_number) {
    //convert the number to a string
    $str_eng_number = $eng_number . "";
    $output_str = "";
    for ($i = 0; $i < strlen($str_eng_number); $i++) {

        if (is_numeric(substr($str_eng_number, $i, 1))) {
            $output_str .=bangla_number_bit_html(substr($str_eng_number, $i, 1));
        } else {
            $output_str .=substr($str_eng_number, $i, 1);
        }
    }

    return $output_str;
}

function bangla_number_bit_html($eng_number_bit) {
    $zero_base = 34;
    settype($eng_number_bit, "integer");
    $mydigit = ($eng_number_bit - 0) + $zero_base;
    //echo "\n$eng_number_bit = $mydigit";
    return "&#25$mydigit;"; //so if 1 is passed it will look ile (1-0)+4 = 5
}



function en2bnNumber($number) {
    $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    $en_number = str_replace($search_array, $replace_array, $number);
    return $en_number;
}

function en2bndateConverter($date) {
    $pubdate = date("j F, Y H:i", strtotime($date));
    $engDATE = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
    $bangDATE = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', '
বুধবার', 'বৃহস্পতিবার', 'শুক্রবার'
    );
    $convertedDATE = str_replace($engDATE, $bangDATE, $pubdate) . '';
    return $convertedDATE;
}

function onlyDateconverterbangla($date) {
    $pubdate = date("l, j F, Y ", strtotime($date));
    $engDATE = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
    $bangDATE = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', '
বুধবার', 'বৃহস্পতিবার', 'শুক্রবার'
    );
    $convertedDATE = str_replace($engDATE, $bangDATE, $pubdate);
    return $convertedDATE;
}

function onlyDatecbangla($date) {
    $pubdate = date("j F, Y ", strtotime($date));
    $engDATE = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
    $bangDATE = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', '
বুধবার', 'বৃহস্পতিবার', 'শুক্রবার'
    );
    $convertedDATE = str_replace($engDATE, $bangDATE, $pubdate);
    return $convertedDATE;
}

function onlydatetodayBanla($date) {
    $pubdate = date("l", strtotime($date));
    $engDATE = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
    $bangDATE = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', '
বুধবার', 'বৃহস্পতিবার', 'শুক্রবার'
    );
    $convertedDATE = str_replace($engDATE, $bangDATE, $pubdate);
    return $convertedDATE;
}

function datetoYear($date) {
    $newsyear = date("Y", strtotime($date));
    return $newsyear;
}

function datetomonth($date) {
    $newsmonth = date("m", strtotime($date));
    return $newsmonth;
}

function datetodate($date) {
    $newsdate = date("d", strtotime($date));
    return $newsdate;
}

function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

function convertToMins($time, $format = '%02d') {
    if ($time < 1) {
        return;
    }
    $minutes = ($time % 60);
    return sprintf($format, $minutes);
}

function timedifference($string) {
    $lasttime = strtotime($string);
        $now = strtotime(date('H:i:s'));
        $update_time = round(floor($now - $lasttime) / 60);
        if($update_time <= 59){
            $time = en2bnNumber(convertToMins($update_time, ' %02d মিনিট '));
    }   else{
            $time = en2bnNumber(convertToHoursMins($update_time, ' %02d ঘন্টা %02d মিনিট '));
    }
    return $time;
}



function custom_url(){
    return base_url();
}

function replace_quotation($string) {
    $string = str_replace('"', "", $string);
    $string = str_replace("'", "", $string);
    $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
    return $string;
}

function amplify($html) {
    # Replace img, audio, and video elements with amp custom elements
    $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
    $html = strip_tags($html, "<p><img><iframe>");
    $return = '';
    preg_match_all("/<iframe[^>]*src=[\"|']([^'\"]+)[\"|'][^>]*>/i", $html, $output );
    if( isset( $output[1][0] ) ) {
        
            $mystring = $output[1][0];
            $findme   = 'https://www.youtube.com/embed/';
            $pos = strpos($mystring, $findme);
            if ($pos === false) {
                $html = strip_tags($html, "<p><a><img>");
                $return = '';
            }else{
                $embed = str_replace("https://www.youtube.com/embed/",'',$output[1][0]);
                $get_embed = explode("?",$embed);
                $return = $get_embed[0];
            }
        
    }
    $html = preg_replace('/<iframe\s+.*?\.*?<\/iframe>/', '<iframe></iframe>', $html);

    $html = preg_replace('/\\<(.*?)(width="(.*?)")(.*?)(height="(.*?)")(.*?)\\>/i', '<$1$4$7>', $html);
    $html = preg_replace('/\\<(.*?)(height="(.*?)")(.*?)(width="(.*?)")(.*?)\\>/i', '<$1$4$7>', $html);
    $html = preg_replace('/(width|height)=["\']\d*["\']\s?/', "", $html);
    
    $html = str_ireplace(
        ['<img','<video','/video>','<audio','/audio>','<iframe','/iframe>'],
        ['<amp-img height="250" width="320" layout="responsive"','<amp-video','/amp-video>','<amp-audio','/amp-audio>','<amp-youtube data-videoid="'.$return.'" height="250" width="320" layout="responsive"','/amp-youtube>'],
        $html
    );
    # Add closing tags to amp-img custom element
    $html = preg_replace('/<amp-img(.*?)>/', '<amp-img$1></amp-img>',$html);
    // remove inline style
    $html = preg_replace('/ style[^>]*/', '', $html);
    // remove empty p tags
    $html = preg_replace("/<p[^>]*>[\s|&nbsp;]*<\/p>/", '', $html);
    $html = preg_replace("/&#?[a-z0-9]+;/i","",$html);
    return $html;
}

function findWorkbleMenu($m_id =''){
        $filename = './assets/news_file/RoutMenu.txt';
        $menu = unserialize(file_get_contents($filename, true));
        $mmmmenu = json_decode(json_encode($menu['all_menu']), True);
        $key = array_search($m_id, array_column($mmmmenu, 'm_id'));
        $menuuu = $mmmmenu[$key];
        return $menuuu['m_bangla'];
}

function findMenuName($m_id =''){
        $filename = './assets/news_file/RoutMenu.txt';
        $menu = unserialize(file_get_contents($filename, true));
        $mmmmenu = json_decode(json_encode($menu['all_menu']), True);
        $key = array_search($m_id, array_column($mmmmenu, 'm_id'));
        $menuuu = $mmmmenu[$key];
        return $menuuu['m_name'];
}

function findMenu($m_id =''){
        $filename = './assets/news_file/RoutMenu.txt';
        $menu = unserialize(file_get_contents($filename, true));
        $mmmmenu = json_decode(json_encode($menu['all_menu']), True);
        $key = array_search($m_id, array_column($mmmmenu, 'm_id'));
        $menuuu = $mmmmenu[$key];
        return $menuuu;
}

function findMenuinfo($m_bangla =''){
        $m_bangla = str_replace('_','-',$m_bangla);
        $filename = './assets/news_file/RoutMenu.txt';
        $menu = unserialize(file_get_contents($filename, true));
        //$key = array_search($m_bangla, array_column($menu['all_menu'], 'm_bangla'));
        $mmmmenu = json_decode(json_encode($menu['all_menu']), True);
        $key = array_search($m_bangla, array_column($mmmmenu, 'm_bangla'), true);
        $menuuu = $mmmmenu[$key];
        return $menuuu;
}

function findParentMenu($m_id =''){
        $filename = './assets/news_file/RoutMenu.txt';
        $menu = unserialize(file_get_contents($filename, true));
        $mmmmenu = json_decode(json_encode($menu['all_menu']), True);        
        if(array_search($m_id, array_column($mmmmenu, 'm_parent'))){
            echo "/article";
        }
}


