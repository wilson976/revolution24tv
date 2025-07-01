<?php 

header("content-type: application/xml");

$xml = '<?xml version="1.0" encoding="UTF-8" ?>
     <urlset
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
      
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
        // print_r($urld);
        //$urldArray = (array) $urld;
       
       
        $xml .=  '<url>
            <loc>'.base_url() . $urld->m_bangla .'/'.str_replace('-', '/', $urld->n_date).'/'.$urld->n_id.'</loc>
            <image:image>
					<image:loc>'. base_url() . 'assets/news_images/' . str_replace('-', '/', $urld->n_date) . '/' . $urld->main_image.'</image:loc>
				</image:image>
            <lastmod>'.date('c', strtotime($urld->start_date)).'</lastmod>
            <changefreq>hourly</changefreq>
            <priority>0.6400</priority>
        </url>';
   }
$xml .=  '</urlset>';                            

echo $xml;

// $file = fopen("sitemap.xml","w")or die("Unable to open file!");
// fwrite($file,$xml);
// fclose($file);

