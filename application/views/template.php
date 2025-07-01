<!doctype html>
<html lang="en">


<head>
    
    <?php $this->load->view('adsense');?>
    
	<?php $this->load->view('analyticstracking');?>
	    
		<?php $this->load->view('meta');?>
		
    	<link rel="image_src" href="<?php echo base_url(); ?>assets/images/fbprofile-logo.png">
        <link type="image/x-icon" rel="shortcut icon" href="<?php echo base_url(); ?>assets/importent_images/favicon-32x32.png">
        <link type="image/x-icon" rel="icon" href="<?php echo base_url(); ?>assets/importent_images/favicon-32x32.png">
    
		<?php $this->load->view('css');?>
		<?php $this->load->view('sharethis');?>
		<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js" crossorigin="anonymous"></script>
        <script>
          //window.googletag = window.googletag || {cmd: []};
          //googletag.cmd.push(function() {
            //googletag.defineSlot('/125835416/rupayan-bd-street', [[728, 90], [320, 60], [970, 90], [320, 50], [320, 100]], 'div-gpt-ad-1746529017978-0').addService(googletag.pubads());
            //googletag.pubads().enableSingleRequest();
            //googletag.pubads().collapseEmptyDivs();
            //googletag.enableServices();
          //});
        //</script>
		
	</head>
	<body onload="startTime()">
        <?php $this->load->view('header');?>
        
        
        <main>
            <?php $this->load->view('scrolling-news');?>
            <?php $this->load->view('body');?>
           
        </main>

        <?php $this->load->view('footer');?>
      
    	<?php $this->load->view('js');?>
    	
    	
    	<?php 
	   
	    if($class=='home'){
	        ?>
	       
            <div class="text-center overflow-hidden d-none d-sm-block mb-20">
                <?php $this->load->view('ads-bottom-sticky', ['position'=>'D-H-sticky']); ?>
            </div>
            <div class="text-center overflow-hidden d-sm-none d-xl-none mb-20">
                <?php $this->load->view('ads-bottom-sticky', ['position'=>'M-H-Sticky']); ?>
            </div>
	        
	        <?php
	    }
	    ?>
	    
	    	<?php 
	   
	    if($class=='post'){
	        ?>
	       
            <div class="text-center overflow-hidden d-none d-sm-block mb-20">
                <?php $this->load->view('ads-bottom-sticky', ['position'=>'D-D-sticky']); ?>
            </div>
            <div class="text-center overflow-hidden d-sm-none d-xl-none mb-20">
                <?php $this->load->view('ads-bottom-sticky', ['position'=>'M-D-sticky']); ?>
            </div>
	        
	        <?php
	    }
	    ?>
    	
    	<style>
    	
    .liveupdates{
        color: red;
        font-size:18px;
        font-weight:bold;
    }
    
    .ldot{
      /*font-weight: 300;*/
      /*font-size: 18px;*/
     
      transform: translate(-50%, -50%);
      color: red;
      i{
        -moz-animation-duration: 500ms;
        -moz-animation-name: blink;
        -moz-animation-iteration-count: infinite;
        -moz-animation-direction: alternate;
    
        -webkit-animation-duration: 500ms;
        -webkit-animation-name: blink;
        -webkit-animation-iteration-count:infinite;
        -webkit-animation-direction: alternate;
    
        animation-duration: 500ms;
        animation-name: blink;
        animation-iteration-count: infinite;
        animation-direction: alternate; 
        color: red;
      }
}

    @-moz-keyframes blink {
      from { opacity: 1;}
      to { opacity: 0;}
    }
    @-webkit-keyframes blink {
      from { opacity: 1;}
      to { opacity: 0;}
    }
    @keyframes blink {
      from { opacity: 1;}
      to { opacity: 0;}
    }
</style>
    	
	</body>
</html>