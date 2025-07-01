<section class="section-2 mt20">
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="SecTitle">
                    <a href="./online/special">
                        <h2> স্পেশাল <i class="fas fa-angle-double-right"></i></h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">


		<?php
			if($special != NULL){
			?>
    	        <div class="col-lg-5 col-12">
    		    	<div class="DBdTop">
                            <a href="<?php echo findWorkbleMenu($special[0]['n_category']); ?>/<?php echo str_replace('-', '/', $special[0]['n_date']) ?>/<?php echo $special[0]['n_id']; ?>">
                                <div class="DImgZoomBlock">
                                    <picture>
                                        <img src="<?php echo './assets/news_images/'.str_replace('-','/',$special[0]['n_date']).'/' . $special[0]['main_image']; ?>" alt="<?php echo $special[0]['n_head'];?>" title="<?php echo $special[0]['n_head'];?>" class="img-fluid">
                                    </picture>
                                </div>
                                <div class="Desc">
                                    <h3 class="Title"><?php echo $special[0]['n_head'];?></h3>
                                    <div class="Brief">
                                        <p><?php echo splitText(strip_tags($special[0]['n_details']), 480); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
			</div>
			
			<div class="col-lg-4 col-12">
			    <div class="row">
    			    <?php
            			$i=1;
            			if($special != NULL){
            				foreach ($special as $key => $value) {
            				    if($i>1){
            			?>
                             <div class="col-lg-6 col-6 d-flex">
                                <div class="DTop6List align-self-stretch">
                                    <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                        <picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$value['n_date']).'/thumbnails/' . $value['main_image']; ?>" alt="<?php echo $value['n_head'];?>" title="<?php echo $value['n_head'];?>" class="img-fluid img100 ImgRatio"></picture>
                                        <div class="Desc">
                                            <h3 class="Title"><?php echo $value['n_head'];?></h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                    <?php
            				    }
            				    $i++;
            				    if($i==6) break;
            				}
            			}
                    
                    ?>
                </div>
			</div>
			
			
			<div class="col-lg-3 col-12">
                        <div class="DrightNews">
                            <?php
                			$i=1;
                			if($special != NULL){
                				foreach ($special as $key => $value) {
                				    if($i>5){
                			?>
                            <div class="DrightNewsList">
                                <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                    <div class="row">
                                        <div class="col-lg-5 col-6">
                                            <div class="DImgZoomBlock">
                                                <picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$value['n_date']).'/mob/' . $value['main_image']; ?>" alt="<?php echo $value['n_head'];?>" title="<?php echo $value['n_head'];?>" class="img-fluid img100 ImgRatio"></picture>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-6">
                                            <div class="Desc">
                                                <h3 class="Title SMTitle"><?php echo $value['n_head'];?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                           <?php
                			}
                         $i++;
                         if($i==10) break;
                     
            				}
            				
            			}
                     ?>
                        </div>
                    </div>
			
		
    		<?php
                }
    		?>
    		
    
    </div>
</section>