        <!-- Advertisement -->
        <section class="Advertisement">
            <div class="container">
                <div class="row">
                    <div class="row">
                    <div class="text-center overflow-hidden d-none d-sm-block mb-20">
                    <?php $this->load->view('Ads', ['position'=>'D-H-B-entertainment']); ?>
                </div>
                 <div class="text-center overflow-hidden d-sm-none d-xl-none mb-20">
                    <?php $this->load->view('Ads', ['position'=>'M-H-B-entertainment']); ?>
                </div>
                </div>
            </div>

        </section>
        <!-- =========Entertainment Section======== -->
        <section class="EntertainmentSection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="SecTitle">
                            <a href="./online/entertainment">
                                <h2> বিনোদন <i class="fas fa-angle-double-right"></i></h2>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                    if($entertainment!=""){
                    ?>
                <div class="DEnterTopSection">
                    <div class="row">
                        
                        
                        <div class="col-lg-6 col-12">
                            <div class="DEnterTopNews">
                                <a href="<?php echo findWorkbleMenu($entertainment[0]['n_category']); ?>/<?php echo str_replace('-', '/', $entertainment[0]['n_date']) ?>/<?php echo $entertainment[0]['n_id']; ?>">
                                    <picture>
                                        <img src="<?php echo './assets/news_images/'.str_replace('-','/',$entertainment[0]['n_date']).'/' . $entertainment[0]['main_image']; ?>" alt="<?php echo $entertainment[0]['n_head'];?>" title="<?php echo $entertainment[0]['n_head'];?>" class="img-fluid img100">
                                        <?php
                                                if($entertainment[0]['n_video']=='yes'){
                                            ?>
                                                <i class="fa-solid fa-play vid-icon"></i>
                                            <?php
                                                }
                                            ?>
                                        </picture>
                                    <div class="Desc">
                                        <h3 class="Title"><?php echo $entertainment[0]['n_head'];?></h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 order-lg-first d-flex">
                            <div class="DEnterListHorizental align-self-stretch">
                                <a href="<?php echo findWorkbleMenu($entertainment[1]['n_category']); ?>/<?php echo str_replace('-', '/', $entertainment[1]['n_date']) ?>/<?php echo $entertainment[1]['n_id']; ?>">
                                    <picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$entertainment[1]['n_date']).'/thumbnails/' . $entertainment[1]['main_image']; ?>" alt="<?php echo $entertainment[1]['n_head'];?>" title="<?php echo $entertainment[1]['n_head'];?>" class="img-fluid img100"></picture>
                                    <?php
                                        if($entertainment[1]['n_video']=='yes'){
                                    ?>
                                        <i class="fa-solid fa-play vid-icon"></i>
                                    <?php
                                        }
                                    ?>
                                    <div class="Desc">
                                        <h4 class="Title"><?php echo $entertainment[1]['n_head'];?></h4>
                                        <div class="Brief">
                                            <p><?php echo splitText(strip_tags($entertainment[1]['n_details']), 348); ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 d-flex">
                            <div class="DEnterListHorizental align-self-stretch">
                                <a href="<?php echo findWorkbleMenu($entertainment[2]['n_category']); ?>/<?php echo str_replace('-', '/', $entertainment[2]['n_date']) ?>/<?php echo $entertainment[2]['n_id']; ?>">
                                    <picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$entertainment[2]['n_date']).'/thumbnails/' . $entertainment[2]['main_image']; ?>" alt="<?php echo $entertainment[2]['n_head'];?>" title="<?php echo $entertainment[2]['n_head'];?>" class="img-fluid img100"></picture>
                                    <?php
                                                if($entertainment[2]['n_video']=='yes'){
                                            ?>
                                                <i class="fa-solid fa-play vid-icon"></i>
                                            <?php
                                                }
                                            ?>
                                    <div class="Desc">
                                        <h4 class="Title"><?php echo $entertainment[2]['n_head'];?></h4>
                                        <div class="Brief">
                                            <p><?php echo splitText(strip_tags($entertainment[2]['n_details']), 348); ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="DEnterTop2">
                        <div class="row">
                            <?php
                			$i=1;
            				foreach ($entertainment as $key => $value) {
            				    if($i>3){
                			?>
                            
                            <div class="col-lg-3 col-6 d-flex">
                                <div class="DEnterTop2List align-self-stretch">
                                    <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                        <picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$value['n_date']).'/thumbnails/' . $value['main_image']; ?>" alt="<?php echo $value['n_head'];?>" title="<?php echo $value['n_head'];?>" class="img-fluid img100"></picture>
                                        <?php
                                                if($value['n_video']=='yes'){
                                            ?>
                                                <i class="fa-solid fa-play vid-icon"></i>
                                            <?php
                                                }
                                            ?>
                                        <div class="Desc">
                                            <h3 class="Title"><?php echo $value['n_head'];?></h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                				}
                            
                            $i++;
                            if($i==8) break;
                				}
                			
                            ?>
                            
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </section>