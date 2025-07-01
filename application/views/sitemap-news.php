<?php 

header("content-type: application/xml");

$xml = '<?xml version="1.0" encoding="UTF-8" ?>
     <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">';

if($year != NULL){
    if($year == '2020'){
       $period = new DatePeriod(
             new DateTime($year.'-10-01'),
             new DateInterval('P1D'),
             new DateTime('2021-01-01')
        ); 
    }elseif($year == date('Y')){
        $period = new DatePeriod(
             new DateTime($year.'-01-01'),
             new DateInterval('P1D'),
             new DateTime(date('Y-m-d'))
        );
        
    }else{
        $period = new DatePeriod(
             new DateTime($year.'-01-01'),
             new DateInterval('P1D'),
             new DateTime($year.'-12-31 +1 days')
        );
    }
    
    foreach($period as $key=> $value){ 
  $xml .= '<sitemap>
        <loc>'.base_url().$value->format('Y-m-d').'/news-sitemap.xml</loc><lastmod>'.date('c', strtotime($value->format('Y-m-d'))).'</lastmod>
      </sitemap>';
    }
}else{
   
    for($i= 0;$i < 28; $i++){
      $da = 'today - '.$i.' days';
  $xml .= '<sitemap>
        <loc>'.base_url().date('Y-m-d', strtotime($da)).'/news-sitemap.xml</loc><lastmod>'.date('c', strtotime($da)).'</lastmod>
      </sitemap>';
    }
}
   
$xml .=  '</sitemapindex>';  
     
echo $xml;
