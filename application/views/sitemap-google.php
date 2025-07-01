<?php 

header("content-type: application/xml");

$xml = '<?xml version="1.0" encoding="UTF-8" ?>
     <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">';
      
    $xml .=  '<url>
        <loc>'.base_url().'</loc>
        <changefreq>hourly</changefreq>
        <priority>1.0000</priority>
    </url>';
    // foreach ($urlslist as $url) {
    //    $xml .=  '<url>
    //         <loc>'.base_url().$url['m_bangla'].'</loc>
    //         <changefreq>hourly</changefreq>
    //         <priority>0.6400</priority>
    //     </url>';
    // }
    
   
  
  
    foreach ($urldetails as $urld) {
        $xml .=  '<url>
            <loc>'.base_url() . $urld->m_bangla .'/'.str_replace('-', '/', $urld->n_date).'/'.$urld->n_id.'</loc>
           <news:news>
           <news:publication>
             <news:name>revolution24.tv</news:name>
             <news:language>bn</news:language>
           </news:publication>
           <news:publication_date>'.date('c', strtotime($urld->start_date)).'</news:publication_date>
             <news:title>'.$urld->n_head.'</news:title>
            </news:news>
        </url>';
   }
$xml .=  '</urlset>';                            

echo $xml;

// $file = fopen("sitemap.xml","w")or die("Unable to open file!");
// fwrite($file,$xml);
// fclose($file);

