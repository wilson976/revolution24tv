<?php $xml = '<?xml version="1.0" encoding="UTF-8" ?>
     <urlset
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
      
    <url>
        <loc>'.base_url().'</loc>
        <changefreq>monthly</changefreq>
        <priority>1.0000</priority>
    </url>';
    foreach ($urlslist as $url) {
       $xml .=  '<url>
            <loc>'.base_url().$url['m_bangla'].'</loc>
            <changefreq>monthly</changefreq>
            <priority>0.6400</priority>
        </url>';
    }
    foreach ($urldetails as $urld) {
        $xml .=  '<url>
            <loc>'.base_url() . $urld->m_bangla .'/'.str_replace('-','/',$urld->n_date).'/'.$urld->n_id.'</loc>
            <lastmod>'.date('c', strtotime($urld->n_date)).'</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6400</priority>
        </url>';
   }
$xml .=  '</urlset>';                            

//echo $xml;

$file = fopen("sitemap.xml","w")or die("Unable to open file!");
fwrite($file,$xml);
fclose($file);

