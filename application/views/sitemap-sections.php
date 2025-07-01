<?php

// It's assumed that you have already loaded your data from the database
// into these variables before this script runs:
// $urlslist   - Array of main categories/sections
// $tagList    - Array of tags used on your site
// $distlist   - Array of district pages
// $urldetails - Array of all your news articles (as objects or arrays)
//
// Also, ensure your base_url() and headtoslugReturn() functions are available.


// 1. SETUP THE XML DOCUMENT
// =============================
// Use PHP's DOMDocument to build a valid XML file safely.
// This prevents errors from special characters in URLs or data.

$dom = new DOMDocument('1.0', 'UTF-8');
$dom->formatOutput = true; // Makes the output readable

// Create the root <urlset> element
$urlset = $dom->createElement('urlset');
$urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
$urlset->setAttribute('xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');
$urlset->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
$urlset->setAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');
$dom->appendChild($urlset);


// 2. HELPER FUNCTION TO ADD URLS
// ================================
// This function simplifies adding new <url> nodes to the sitemap.

function add_url($dom, $parent, $loc, $lastmod = null, $changefreq = 'daily', $priority = '0.8', $image_loc = null) {
    $url = $dom->createElement('url');

    // <loc> is the only required tag
    $url->appendChild($dom->createElement('loc', $loc));

    // <lastmod> is the most important tag for search engines after <loc>
    if ($lastmod) {
        $url->appendChild($dom->createElement('lastmod', date('c', strtotime($lastmod))));
    }

    $url->appendChild($dom->createElement('changefreq', $changefreq));
    $url->appendChild($dom->createElement('priority', $priority));

    // Add image data if provided
    if ($image_loc) {
        $image_image = $dom->createElement('image:image');
        $image_image->appendChild($dom->createElement('image:loc', $image_loc));
        $url->appendChild($image_image);
    }

    $parent->appendChild($url);
}


// 3. POPULATE THE SITEMAP
// =========================

// Add the Homepage (Highest Priority)
add_url($dom, $urlset, base_url(), date('c'), 'daily', '1.0');

// Add Main Category URLs
foreach ($urlslist as $cat_url) {
    $location = base_url() . 'online/' . $cat_url['m_bangla'];
    add_url($dom, $urlset, $location, null, 'hourly', '0.9');
}

// Add Tag Page URLs
foreach ($tagList as $tag_url) {
    $location = base_url() . 'searchbytag/' . str_replace(' ', '-', $tag_url['tag']);
    add_url($dom, $urlset, $location, null, 'daily', '0.7');
}

// Add District Page URLs
foreach ($distlist as $dist_url) {
    $location = base_url() . 'bangladesh/' . $dist_url['division'] . '/' . $dist_url['name_eng'];
    add_url($dom, $urlset, $location, null, 'monthly', '0.6');
}

// Add Static High-Priority Pages
add_url($dom, $urlset, 'https://www.revolution24.tv/video/cat/programm', date('c'), 'daily', '1.0');
add_url($dom, $urlset, 'https://www.revolution24.tv/photogallery', date('c'), 'daily', '1.0');
add_url($dom, $urlset, 'https://www.revolution24.tv/home/allnews', date('c'), 'hourly', '1.0');


// Add Individual Article URLs (Most Important for News Sites)
foreach ($urldetails as $urld) {
    $location = base_url() . $urld->m_bangla . '/' . $urld->n_id . '/' . headtoslugReturn($urld->n_head);
    $image_location = 'https://www.revolution24.tv/assets/news_images/' . str_replace('-', '/', $urld->n_date) . '/' . $urld->main_image;
    
    // For articles, lastmod is critical. Priority should be high.
    add_url($dom, $urlset, $location, $urld->n_date, 'daily', '0.9', $image_location);
}


// 4. OUTPUT THE SITEMAP
// =======================

// Set the correct header to tell browsers this is an XML file
header("Content-Type: application/xml");

// Echo the generated XML
echo $dom->saveXML();

/*
// OPTIONAL: Save to a file
// ------------------------
// For very large sites, it's better to generate this as a cron job
// and save it as a static file (e.g., sitemap.xml)
// This is faster for search engine crawlers.

// $file_path = $_SERVER['DOCUMENT_ROOT'] . '/sitemap.xml';
// $dom->save($file_path);
*/

?>