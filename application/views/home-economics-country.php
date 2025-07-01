        <!-- Advertisement -->
        <section class="Advertisement">
            <div class="container">
                <div class="row">
                    <div class="text-center overflow-hidden d-none d-sm-block mb-20">
                    <?php $this->load->view('Ads', ['position'=>'D-H-B-economics']); ?>
                </div>
                 <div class="text-center overflow-hidden d-sm-none d-xl-none mb-20">
                    <?php $this->load->view('Ads', ['position'=>'M-H-B-economics']); ?>
                </div>
                </div>
            </div>

        </section>
        
        
                <!--=====Rajniti+international section======  -->
        <section class="RajInterSection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="SecTitle">
                            <a href="./online/economics">
                                <h2> অর্থনীতি <i class="fas fa-angle-double-right"></i></h2>
                            </a>
                        </div>
                        <div class="DEditorial">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 odr2">
                                    <div class="DEditoriallist">
                                        <?php
                            			$i=1;
                            			if($business != NULL){
                            				foreach ($business as $key => $value) {
                            				    if($i>1){
                            			?>
                                        <div class="DrightNewsList">
                                            <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                                <div class="row">
                                                    <div class="col-lg-5 col-sm-5 col-5">
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
                                                    <div class="col-lg-7 col-sm-7 col-7">
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
                                <div class="col-lg-6 col-sm-12 d-flex odr1">
                                    <div class="DEditorialTop align-self-stretch">
                                         <?php
                                        if($business!=""){
                                        ?>
                                        
                                        <a href="<?php echo findWorkbleMenu($business[0]['n_category']); ?>/<?php echo str_replace('-', '/', $business[0]['n_date']) ?>/<?php echo $business[0]['n_id']; ?>">
                                            <picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$business[0]['n_date']).'/thumbnails/' . $business[0]['main_image']; ?>" alt="<?php echo $business[0]['n_head'];?>" title="<?php echo $business[0]['n_head'];?>" class="img-fluid img100">
                                            <?php
                                                                if($business[0]['n_video']=='yes'){
                                                            ?>
                                                            <i class="fa-solid fa-play vid-icon"></i>
                                                            <?php
                                                                }
                                                            ?>
                                            </picture>
                                            <div class="Desc">
                                                <h3 class="Title"><?php echo $business[0]['n_head'];?></h3>
                                                <div class="Brief">
                                                    <p><?php echo splitText(strip_tags($business[0]['n_details']), 348); ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="SecTitle">
                            <a href="./online/country">
                                <h2> সারাদেশ <i class="fas fa-angle-double-right"></i></h2>
                            </a>
                        </div>
                        <div class="DEditorial">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 odr2">
                                    <div class="DEditoriallist">
                                        <?php
                            			$i=1;
                            			if($country != NULL){
                            				foreach ($country as $key => $value) {
                            				    if($i>1){
                            			?>
                                        <div class="DrightNewsList">
                                            <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                                <div class="row">
                                                    <div class="col-lg-5 col-sm-5 col-5">
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
                                                    <div class="col-lg-7 col-sm-7 col-7">
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
                                <div class="col-lg-6 col-sm-12 d-flex odr1">
                                    <div class="DEditorialTop align-self-stretch">
                                        <?php
                                        if($country!=""){
                                        ?>
                                        
                                        <a href="<?php echo findWorkbleMenu($country[0]['n_category']); ?>/<?php echo str_replace('-', '/', $country[0]['n_date']) ?>/<?php echo $country[0]['n_id']; ?>">
                                            <picture>
                                                <img src="<?php echo './assets/news_images/'.str_replace('-','/',$country[0]['n_date']).'/thumbnails/' . $country[0]['main_image']; ?>" alt="<?php echo $country[0]['n_head'];?>" title="<?php echo $country[0]['n_head'];?>" class="img-fluid img100">
                                                <?php
                                                                if($country[0]['n_video']=='yes'){
                                                            ?>
                                                            <i class="fa-solid fa-play vid-icon"></i>
                                                            <?php
                                                                }
                                                            ?>
                                                </picture>
                                            <div class="Desc">
                                                <h3 class="Title"><?php echo $country[0]['n_head'];?></h3>
                                                <div class="Brief">
                                                    <p><?php echo splitText(strip_tags($country[0]['n_details']), 348); ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>