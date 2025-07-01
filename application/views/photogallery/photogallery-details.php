<section class="bg-body section-space-less30">
	<div class="container">
		<div class="row">
			
			
			
			
			
			<div class="lead-area col-md-12">
            	<div class="row">
            		
            		<?php //$this->load->view('photogallery/photogallery-left');?>
                    <div class="col-md-2 left_container">
                    	<h1>ফটো গ্যালারি</h1>
                    	<ul>
                    		<li><a href=""><?php echo onlyDateconverterbangla($photogallery[0]['p_date']); ?></a></li>
                    		
                    	</ul>
                    </div>
            		
            	<?php
            		if ($photogallery != NULL) { 
            		    $ppdd = $photogallery[0]['p_date'];
            		    $ggdd = '';
            	?>
            		<div class="col-md-10">
            		    <div class="row">
            		        
                		<?php
                	    
            		    foreach($photogallery as $key=>$gall){ 
            		      //  if($key != 0)
            		        $ggdd = $gall['p_date'];
            		        
                		    if($ppdd != $ggdd){
                		        echo '</div>';
                		        echo '</div>';
                		        echo '<div class="col-md-2 left_container">';
                    	echo '<ul>';
                    		echo '<li><a href="">'. onlyDateconverterbangla($ggdd).'</a></li>';
                    		
                    	echo '</ul>';
                    echo '</div>';
                		        echo '<div class="col-md-10"><div class="row">';
                		        $ppdd = $photogallery[$key]['p_date'];
                		    }
            		    ?>
            		      <div class="row">
                		          <img src="./assets/images/photo_gallery/<?php echo $gall['p_location']; ?>" alt="imh" />
                		          <p><?php echo $gall['p_caption']; ?></p>
                		          
                		          		<div class="col-md-10 pl-0 mb-10">
                		          		    
                                  <!--<a href="https://www.facebook.com/dialog/feed?app_id=1076879972490095&redirect_uri=https://www.newsbangla24.com/photogallery/details/<?php echo $gall['p_date']; ?> &link=https://www.newsbangla24.com/photogallery/details/<?php echo $gall['p_date']; ?> &picture=https://www.newsbangla24.com/assets/images/photo_gallery/<?php echo $gall['p_location']; ?> &caption=<?php echo $gall['p_caption']; ?>&description=<?php echo $gall['p_caption']; ?>">Share on Facebook</a>-->

                    			            <!--<p>শেয়ার করুন</p>-->
                                			
                                				
                            			    <!-- ShareThis BEGIN -->
                            			    <div class="sharethis-inline-share-buttons"></div>
                            			    <!-- ShareThis END -->
                                		</div>
            		      </div>
            		    <?php 
            		    $ckey = $key +1;
            		    
            		    } 
            		    ?>
            		    </div>
        		    </div>
            		<?php    
            		}
            		?>
            
            		</div>
            	</div>
            </div>
            
            <?php //$this->load->view('category-right-more');?>








		</div>
	</div>
</section>