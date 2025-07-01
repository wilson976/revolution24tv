<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="facebook-domain-verification" content="0j7idigqdfoi7xpmp12uprqqmtsr26" />
<base  href="<?php echo base_url();?>" />

<?php
if($class == 'home'){
?>
		<title>Revolution24.TV – Latest Bangla News Portal in Bangladesh</title>
		<meta name="Author" content="revolution24tv">
		<meta name="Developer" content="Rabbi">
		<meta name="Developed By" content="WebServiceBD">
		<meta name="keywords" content="Bangladesh News, Latest Bangladesh Updates, Dhaka News, Bangla News, Bangladesh Politics, Bangladesh Entertainment, Bangladesh Economy, Bangladesh Sports, Breaking News Bangladesh, Bangladesh Headlines, revolution24, revolution24.tv, revolution24tv, বাংলাদেশ নিউজ, সর্বশেষ বাংলাদেশ আপডেট, ঢাকা নিউজ, বাংলা নিউজ, বাংলাদেশ রাজনীতি, বাংলাদেশ বিনোদন, বাংলাদেশ অর্থনীতি, বাংলাদেশ খেলা, বাংলাদেশ ব্রেকিং নিউজ, বাংলাদেশ শিরোনাম, রেভুলেশন২৪টিভি, রেভুলেশন, রেভুলেশন২৪">
		<meta content="ALL" name="robots">
		<meta name="distribution" content="Global">
		<meta http-equiv="Content-Language" content="bn">
		<meta name="description" content="Stay updated with Revolution24TV, Revolution24TV is your go-to source for the latest news and updates from Bangladesh and around the world. Offering in-depth coverage on politics, entertainment, economy, sports, and breaking news, Revolution24TV keeps you informed with accurate, timely, and unbiased reporting. Stay connected to the pulse of the nation with Revolution24TV—where news revolutionizes your world, 24/7..
">
	
		<meta property="fb:app_id" content="1076879972490095">
		
        
		
		<meta property="og:type" content="article">
		<meta property="og:site_name" content="revolution24tv"/>
		<meta property="og:url" content="<?php echo base_url(); ?>">
		<meta property="og:title" content="Revolution24TV – Latest Bangla News Portal in Bangladesh"/>
		<meta property="og:description" content="Stay updated with Revolution24TV, Revolution24TV is your go-to source for the latest news and updates from Bangladesh and around the world. Offering in-depth coverage on politics, entertainment, economy, sports, and breaking news, Revolution24TV keeps you informed with accurate, timely, and unbiased reporting. Stay connected to the pulse of the nation with Revolution24TV—where news revolutionizes your world, 24/7..
"/>
		<meta property="og:image" content="<?php echo base_url(); ?>assets/importent_images/fbprofile-logo.png">
		<base  href="<?php echo base_url(); ?>" />
		<meta http-equiv="refresh" content="300">
		<link rel="canonical" href="<?php echo base_url(); ?>">
	<?php
} elseif ($class == 'post') {
    ?>

    
    <title><?php echo replace_newlinetags(PregRemove(strip_tags($getnewsby_id['n_head']))); ?> | <?php echo strip_tags($getmenu['m_name']); ?> |  Revolution24TV</title>
   
    <meta name="msvalidate.01" content="8DB9F4C3D539E57F5EC78BAE1D489691"/>
    <meta name="description" content="<?php echo PregRemove(splitText(strip_tags($getnewsby_id['n_details']), 300)); ?>" />
    
    <meta property="fb:app_id" content="1076879972490095"/>
    


    <link rel="canonical" href="<?php echo base_url(); ?><?php echo findWorkbleMenu($getnewsby_id['n_category']); ?>/<?php echo str_replace('-', '/', $getnewsby_id['n_date']) ?>/<?php echo $getnewsby_id['n_id']; ?>">
    
    <?php
    if($getnewsby_id['main_image'] != NULL){
    ?>
    <link rel="image_src" href="<?php echo base_url() . 'assets/news_images/' . str_replace('-', '/', $getnewsby_id['n_date']) . '/' . $getnewsby_id['main_image']; ?>"/>
    <?php
    }else{
    ?>
    <link rel="image_src" href="<?php echo base_url() . 'assets/importent_images/fbprofile-logo.png' ?>"/>
    <?php
    }
    ?>
    

    
    <meta name="google-site-verification" content="8dAoQhq-kA1kcuY1i2nLRNyAlvj_MeQruFO3adfNAOU" />
    
    <meta name="Author" content="revolution24tv"/>
    <meta name="robots" content="all"/>
    <meta name="googlebot" content="all"/>
    <meta http-equiv=Content-Language content=bn>
    <meta name="googlebot-news" content="all"/>
    <meta name="Developer" content="Rabbi" />
    <meta name="Developed By" content="WebServiceBD" />
    <meta http-equiv="Content-Language" content="bn"/>
    <meta http-equiv="refresh" content="600">
    <meta name="keywords" content="Bangladesh News, Latest Bangladesh Updates, Dhaka News, Bangla News, Bangladesh Politics, Bangladesh Entertainment, Bangladesh Economy, Bangladesh Sports, Breaking News Bangladesh, Bangladesh Headlines, revolution24, revolution24.tv, revolution24tv, বাংলাদেশ নিউজ, সর্বশেষ বাংলাদেশ আপডেট, ঢাকা নিউজ, বাংলা নিউজ, বাংলাদেশ রাজনীতি, বাংলাদেশ বিনোদন, বাংলাদেশ অর্থনীতি, বাংলাদেশ খেলা, বাংলাদেশ ব্রেকিং নিউজ, বাংলাদেশ শিরোনাম, রেভুলেশন২৪টিভি, রেভুলেশন, রেভুলেশন২৪"/>


    <meta property="og:type" content="article"/>
    <meta property="og:title" content="<?php echo PregRemove(remove_newline(strip_tags($getnewsby_id['n_head']))); ?>"/>
    <meta property="og:description" content="<?php echo PregRemove(splitText(strip_tags($getnewsby_id['n_details']), 300)); ?>"/>
    <?php
    if($getnewsby_id['main_image'] != NULL){
    ?>
    <meta property="og:image" content="<?php echo base_url() . 'assets/news_images/' . str_replace('-', '/', $getnewsby_id['n_date']) . '/' . $getnewsby_id['main_image']; ?>"/>
    <?php } else{   ?>
    <meta property="og:image" content="<?php echo base_url() . 'assets/importent_images/fbprofile-logo.png' ?>"/>
    <?php } ?>
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="400" />
    <meta property="og:url" content="<?php echo base_url(); ?><?php echo findWorkbleMenu($getnewsby_id['n_category']); ?>/<?php echo str_replace('-', '/', $getnewsby_id['n_date']) ?>/<?php echo $getnewsby_id['n_id']; ?>"/>
    <meta property="og:site_name" content="revolution24tv"/>



<?php }else if($class == 'online'){
    ?>
    
    <title><?php if($getmenu['m_title'] != ''){ 
    echo $getmenu['m_title']; 
    }else{ ?>
    <?php echo strip_tags($getmenu['m_name']); ?> | revolution24tv 
   <?php } ?> </title>
    <meta name="google-site-verification" content="8dAoQhq-kA1kcuY1i2nLRNyAlvj_MeQruFO3adfNAOU" />
    
    <?php
    if ($getmenu['m_keywords'] != '') {
        ?>
        <meta name="keywords" content="<?php echo $getmenu['m_keywords']; ?>" />
        <?php
    } else {
        ?>
        <meta name="keywords" content="Bangladesh News, Latest Bangladesh Updates, Dhaka News, Bangla News, Bangladesh Politics, Bangladesh Entertainment, Bangladesh Economy, Bangladesh Sports, Breaking News Bangladesh, Bangladesh Headlines, revolution24, revolution24.tv, revolution24tv, বাংলাদেশ নিউজ, সর্বশেষ বাংলাদেশ আপডেট, ঢাকা নিউজ, বাংলা নিউজ, বাংলাদেশ রাজনীতি, বাংলাদেশ বিনোদন, বাংলাদেশ অর্থনীতি, বাংলাদেশ খেলা, বাংলাদেশ ব্রেকিং নিউজ, বাংলাদেশ শিরোনাম, রেভুলেশন২৪টিভি, রেভুলেশন, রেভুলেশন২৪">


        <?php
    }
    ?>
   
    <meta name="description" content="<?php if($getmenu['m_desc'] != ''){ echo $getmenu['m_desc']; }else{ ?>Revolution24TV - Latest Bangla News Portal in Bangladesh- <?php echo strip_tags($getmenu['m_bangla']); }?>"/>
    <meta name="language" content="Bangla">
    <meta property="fb:app_id" content="1076879972490095"/>
    <meta http-equiv=Content-Language content=bn>
    <link rel="image_src" href="<?php echo base_url(); ?>assets/importent_images/logo-main.png"/>
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="revolution24tv"/>
    <meta property="og:url" content="<?php echo base_url() .'online/'. $getmenu['m_bangla']; ?>"/>
    
    
    <meta property="og:title" content="<?php echo strip_tags($getmenu['m_title']); ?>"/>
    <meta property="og:description" content="<?php if($getmenu['m_desc'] != ''){ echo $getmenu['m_desc']; }else{ ?>Revolution24TV - Latest Bangla News Portal in Bangladesh- <?php echo strip_tags($getmenu['m_bangla']); }?>"/>
    
    
    
    
    
    <meta property="og:image" content="<?php echo base_url(); ?>assets/importent_images/fbprofile.-logo.png"/>

    <link rel="canonical" href="<?php echo base_url() .'online/'. $getmenu['m_bangla']; ?>">
    <meta name="Author" content="revolution24tv"/>
    <meta name="robots" content="all"/>
    <meta name="googlebot" content="all"/>
    <meta name="googlebot-news" content="all"/>

    <meta name="Developer" content="revolution24tv" />      
    <meta http-equiv="refresh" content="600">

<?php
}
?>
