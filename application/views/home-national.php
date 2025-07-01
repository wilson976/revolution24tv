        <!-- =====Bangladesh section======= -->
        <section class="bangladeshSection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="SecTitle">
                            <a href="./online/national">
                                <span class="RIghtBar"></span>
                                <h2> জাতীয়</h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-12  order order-2">
                        
                    </div>
                    
                    
                    <div class="col-lg-6 col-12">
                        
                        <?php
                        if($national!=""){
                        ?>
                        <div class="DBdTop">
                            <a href="<?php echo findWorkbleMenu($national[0]['n_category']); ?>/<?php echo str_replace('-', '/', $national[0]['n_date']) ?>/<?php echo $national[0]['n_id']; ?>">
                                <div class="DImgZoomBlock">
                                    <picture>
                                        <img src="<?php echo './assets/news_images/'.str_replace('-','/',$national[0]['n_date']).'/' . $national[0]['main_image']; ?>" alt="<?php echo $national[0]['n_head'];?>" title="<?php echo $national[0]['n_head'];?>" class="img-fluid">
                                    </picture>
                                    <?php
                                            if($national[0]['n_video']=='yes'){
                                        ?>
                                        <i class="fa-solid fa-play vid-icon"></i>
                                        <?php
                                            }
                                        ?>
                                </div>
                                <div class="Desc">
                                    <h3 class="Title"><?php echo $national[0]['n_head'];?></h3>
                                    <div class="Brief">
                                        <p><?php echo splitText(strip_tags($national[0]['n_details']), 480); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <?php
                        }
                        ?>
                    </div>
                    
                    <div class="col-lg-3 col-12">
                        <div class="DrightNews">
                            <?php
                			$i=1;
                			if($national != NULL){
                				foreach ($national as $key => $value) {
                				    if($i>1){
                			?>
                            <div class="DrightNewsList">
                                <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                    <div class="row">
                                        <div class="col-lg-5 col-6">
                                            <div class="DImgZoomBlock">
                                                <picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$value['n_date']).'/mob/' . $value['main_image']; ?>" alt="<?php echo $value['n_head'];?>" title="<?php echo $value['n_head'];?>" class="img-fluid img100 ImgRatio"></picture>
                                            <?php
                                                    if($value['n_video']=='yes'){
                                                ?>
                                                <i class="fa-solid fa-play vid-icon"></i>
                                                <?php
                                                    }
                                                ?>
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
                         if($i==6) break;
                     
            				}
            				
            			}
                     ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        
        <!-- Advertisement -->
        <section class="Advertisement">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                         <div class="text-center overflow-hidden d-none d-sm-block mb-20">
                    <?php $this->load->view('Ads', ['position'=>'D-H-A-National']); ?>
                        </div>
                         <div class="text-center overflow-hidden d-sm-none d-xl-none mb-20">
                            <?php $this->load->view('Ads', ['position'=>'M-H-A-National']); ?>
                        </div>
                    </div>
                </div>
            </div>

        </section>