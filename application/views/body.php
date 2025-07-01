<?php
if($class == 'home'){
	$this->load->view('home');
}else if($class == 'post'){
    	if($getnewsby_id['live_news']== 'yes'){
            $this->load->view('post-news-live');
        }else{
        	$this->load->view('post-details');
        }
}else if($class == 'photogallery-details'){

}else if($class == 'online'){
	$this->load->view('category');
}else if($class == 'keywordsearch'){
    $this->load->view('searchresult');
}else if($class == 'video-home'){
    $this->load->view('video-details');
}else if($class == 'home-allnews'){
    $this->load->view('archivenews');
}
?>

