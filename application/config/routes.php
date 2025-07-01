<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  | example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  | http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  | $route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  | $route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */


require_once( BASEPATH . 'database/DB' . EXT );
$db = & DB();
$actual_link = explode("/", "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
$news_id = $actual_link[count($actual_link) - 1];




$route['default_controller'] = "home";
$route['404_override'] = 'my404';
$route['rpc.php'] = 'rpc';
$route['keywordsearch/(:any)/(:num)'] = "home/keywordsearch/$1/$2";
$route['searchresult'] = "home/keywordsearch";
//$route['home/poll_vote'] = "home/poll_vote";
//$route['home/poll'] = "home/poll";
//$route['home/poll/(:any)'] = "home/poll/$1";
$route['fb-instant.xml'] = 'home/rssFBinstantArticle';
$route['rss.xml'] = "home/rss";


$route['daily-sitemap/sections/sitemap.xml'] = "home/sitemapcreate/sections";
$route['daily-sitemap/(:any)/sitemap.xml'] = "home/sitemapcreate/$1";
$route['sitemap.xml'] = "home/allsitemap";
$route['sitemap-(:any).xml'] = "home/allsitemap/$1";
$route['(:any)/sitemap.xml'] = "home/allsitemap/$1";
$route['sitemap-news.xml'] = "home/AllsitemapGoogle";
$route['(:any)/sitemap-news.xml'] = "home/AllsitemapGoogle/$1";
$route['(:any)/news-sitemap.xml'] = "home/google_sitemap/$1";


$route['live'] = "home/live";
$route['hotpanel'] = "hotpanel";

$route['allnews'] = "home/allnews";

$route['allnews/(:any)'] = "home/allnews/$1";

$route['admin/(:any)'] = "admin/$1";

$route['home/click_counter/(:any)'] = "home/click_counter/$1";

$route['video/show/(:any)'] = "video/show/$1";
$route['video/(:any)'] = "home/video/$1";
$route['schedule'] = "home/schedule";
$route['terms'] = "home/terms";
$route['privacy'] = "home/privacy";
$route['photogallery/details/(:any)'] = "photogallery/details/$1";




$db->where('m_status', 'active');
$query = $db->get('menu');
$result = $query->result();
foreach ($result as $res) {
    // echo $res->m_bangla.'<br>';
   if ($res->m_type == 'online') {
        $route['online/'.$res->m_bangla] = 'online/type/' . $res->m_bangla;
        $route[$res->m_bangla.'/article'] = 'online/type/' . $res->m_bangla.'/article';
        $route['online/'.$res->m_bangla.'/(:num)'] = 'online/type/' . $res->m_bangla.'/$1';
        // $route['online/'.$res->m_bangla] = 'online/pType/' . $res->m_bangla;
    }else{
        $route['printversion/(:any)/(:any)/(:any)'] = "printversion/printHome/$1/$2/$3";
        $route['online/'.$res->m_bangla . '/(:any)/(:any)/(:any)'] = 'printversion/type/' . $res->m_bangla . '/$1/$2/$3';

    }
    $route[$res->m_bangla.'/(.+)'] = "post/details/".$res->m_bangla."/$1/$2/$3/$4";
    $route['amp/'.$res->m_bangla.'/(.+)'] = "amp/details/".$res->m_bangla."/$1/$2/$3/$4";
    
     $route['(:any)'] = "post/details1/$1";
   
 }







//$route['(:any)/(:num)'] = "post/details/$1/$2/$3/$4/$5";
//$route['online/(:any)'] = "online/type/$1";
//$route['home/archive/(:num)'] = "home/archive/$1/$2/$3";

//$route['admin/(:any)'] = "admin/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */