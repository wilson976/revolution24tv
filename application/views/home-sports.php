        <!-- Advertisement -->
        <section class="Advertisement">
            <div class="container">
                <div class="row">
                    <div class="text-center overflow-hidden d-none d-sm-block mb-20">
                    <?php $this->load->view('Ads', ['position'=>'D-H-B-sports']); ?>
                </div>
                 <div class="text-center overflow-hidden d-sm-none d-xl-none mb-20">
                    <?php $this->load->view('Ads', ['position'=>'M-H-B-sports']); ?>
                </div>
                </div>
            </div>
        </section>
        
        
        

        <!-- =======Khela Section========= -->
        <section class="khelaSection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="SecTitle">
                            <a href="./online/sports">
                                <h2> খেলা <i class="fas fa-angle-double-right"></i></h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 order order-2">
                        <div class="DleftNews">
                            <?php
                			$i=1;
                			if($sports != NULL){
                				
                				foreach ($sports as $key => $value) {
                				    if($i>4){
                			?>
                            
                            <div class="DLeadNewsLeftTop ">
                                <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                    <div class="row ">
                                        <div class="col-lg-12 col-md-4 col-6 ">
                                            <div class="DImgZoomBlock">
                                                <picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$value['n_date']).'/thumbnails/' . $value['main_image']; ?>" alt="<?php echo $value['n_head'];?>" title="<?php echo $value['n_head'];?>" class="img-fluid img100 ImgRatio"></picture>
                                                <?php
                                                    if($value['n_video']=='yes'){
                                                ?>
                                                    <i class="fa-solid fa-play vid-icon"></i>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-8 col-6">
                                            <div class="Desc">
                                                <h2 class="Title"><?php echo $value['n_head'];?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                				}
                            
                            $i++;
                            if($i==7) break;
                				}
                			}
                            ?>
                            
                            
                        </div>
                    </div>
                    
                    <?php
                    if($sports!=""){
                    ?>
                    <div class="col-lg-6 order-md-1">
                        
                        
                        <div class="DHighLightTop">
                            <a href="<?php echo findWorkbleMenu($sports[0]['n_category']); ?>/<?php echo str_replace('-', '/', $sports[0]['n_date']) ?>/<?php echo $sports[0]['n_id']; ?>">
                                <div class="DImgZoomBlock">
                                    <picture>
                                        <img src="<?php echo './assets/news_images/'.str_replace('-','/',$sports[0]['n_date']).'/' . $sports[0]['main_image']; ?>" alt="<?php echo $sports[0]['n_head'];?>" title="<?php echo $sports[0]['n_head'];?>" class="">
                                    </picture>
                                    <?php
                                        if($sports[0]['n_video']=='yes'){
                                    ?>
                                        <i class="fa-solid fa-play vid-icon"></i>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="Desc">
                                    <h3 class="Title"><?php echo $sports[0]['n_head'];?></h3>
                                </div>
                            </a>
                        </div>
                        
                        
                        <div class="DTop2List">
                            <a href="<?php echo findWorkbleMenu($sports[1]['n_category']); ?>/<?php echo str_replace('-', '/', $sports[1]['n_date']) ?>/<?php echo $sports[1]['n_id']; ?>">
                                <div class="row">
                                    <div class="col-md-4 col-6">
                                        <picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$sports[1]['n_date']).'/mob/' . $sports[1]['main_image']; ?>" alt="<?php echo $sports[1]['n_head'];?>" title="<?php echo $sports[1]['n_head'];?>" class="img-fluid img100"></picture>
                                        <?php
                                        if($sports[1]['n_video']=='yes'){
                                    ?>
                                        <i class="fa-solid fa-play vid-icon"></i>
                                    <?php
                                        }
                                    ?>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <div class="Desc">
                                            <h3 class="Title"><?php echo $sports[1]['n_head'];?></h3>
                                            <div class="Brief">
                                                <p><?php echo splitText(strip_tags($sports[1]['n_details']), 348); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    
                    
                    
                    <div class="col-lg-3">
                        <div class="DleftNews">
                            
                            <?php
                			$i=1;
                			if($sports != NULL){
                				foreach ($sports as $key => $value) {
                				    if($i>2){
                			?>
                            <div class="DLeadNewsLeftTop ">
                                <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                    <div class="row ">
                                        <div class="col-lg-12 col-md-4 col-6 ">
                                            <div class="DImgZoomBlock ">
                                                <picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$value['n_date']).'/thumbnails/' . $value['main_image']; ?>" alt="<?php echo $value['n_head'];?>" title="<?php echo $value['n_head'];?>" class="img-fluid img100 ImgRatio"></picture>
                                            <?php
                                                if($value['n_video']=='yes'){
                                            ?>
                                                <i class="fa-solid fa-play vid-icon"></i>
                                            <?php
                                                }
                                            ?>
                                            
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-8 col-6">
                                            <div class="Desc">
                                                <h2 class="Title"><?php echo $value['n_head'];?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                           <?php
                				}
                            
                            $i++;
                            if($i==5) break;
                				}
                			}
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </section>