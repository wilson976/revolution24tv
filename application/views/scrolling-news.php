<div class="scroller">
    <div class="container">
        <div class="row">
            <div class="news-scroll-area">
            	<div class="d-flex justify-content-between align-items-center <?php if($breakingnews !='') echo ' breaking-news'; else echo ' headlinews';?> ">
            	    
            	    
                	<div class="d-flex flex-row flex-grow-1 flex-fill justify-content-center py-1 text-white px-1 news">
                	    <?php
                	    if($breakingnews !=''){
                	        ?>
                	        <span class="d-flex align-items-center">ব্রেকিং</span>
                	        <?php
                	    }else{
                	    ?>
                		<span class="d-flex align-items-center colormain">সর্বশেষ</span>
                		<?php
                	    }
                		?>
                	</div>
                	
                	<?php
                	    if($breakingnews !=''){
                	        foreach($breakingnews as $key=>$value){
                	?>
                	    <marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                	        <a href=""><?php echo $value['s_head']?></a>
                	        </marquee>
                	<?php
                	        }
                	    }else{
                	?>
                	<marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                		<?php
                		if($headlines !=""){
                		    foreach($headlines as $key=>$value){
                		?>
                		<a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>"><?php echo $value['n_head']?></a>
                		
                		<?php
                		    }
                		}
                		
                	    }
                		?>
                		
                	</marquee>
            	</div>
            </div>
        </div>
    </div>
</div>
<style>

/* news-heading */
.scroller{margin-top:20px;}
.news{position:relative;padding:0 10px !important;}
.headlinews{

	display: block;
	-webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.1);
	-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.1);
	-ms-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.1);
	-o-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.1);
}
.breaking-news{background:#E52E2E;padding:3px 0;}
.breaking-news marquee a{color:#FFF;}
.bg-danger{background-color: #E52E2E !important;}
.news-scroll{margin-left:20px;font-size:0; border-left:1px solid #d5d2d2;}
.news-scroll a{text-decoration:none;font-size:16px;color:#fff;font-weight:700;}
.news-scroll a::before { display: inline-block; width: 5px; height: 5px; background-color: #fff; content: ''; margin: 0 10px; transform: translateY(-50%); border-radius: 50%; }
.dot{height:5px;width:5px;margin-left:8px;margin-right:8px;background-color:var(--white);display:inline-block;border-radius:50%;}
.news-scroll-area span{font-size:18px;font-weight:700;}

/* Change the color of ticker bacground to black */
.headlinews {
    background: #292c5c;
    padding: 3px 0;
}
</style>
