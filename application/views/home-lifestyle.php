        <!-- ===lIFEsTYLE -->
        <section class="lifestyleSection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="SecTitle">
                            <a href="./online/lifestyle">
                                <h2> লাইফস্টাইল <i class="fas fa-angle-double-right"></i></h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="DLifestyle">
                    <div class="row">
                        
                        <?php
                            if($lifestyle!=""){
                			$i=1;
            				foreach ($lifestyle as $key => $value) {
                			?>
                        <div class="col-lg-3 col-md-6 col-sm-12 d-flex border-right-inner1">
                            <div class="DLifestyleList align-self-stretch">
                                <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                    <div class="DImgZoomBlock">
                                        <picture>
                                            <img src="<?php echo './assets/news_images/'.str_replace('-','/',$value['n_date']).'/thumbnails/' . $value['main_image']; ?>" alt="<?php echo $value['n_head'];?>" title="<?php echo $value['n_head'];?>" class="">
                                        </picture>
                                        <?php
                                                if($value['n_video']=='yes'){
                                            ?>
                                            <i class="fa-solid fa-play vid-icon"></i>
                                            <?php
                                                }
                                            ?>
                                    </div>
                                    <div class="Desc">
                                        <h3 class="Title"><?php echo $value['n_head'];?></h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <?php
                            $i++;
                            if($i==5) break;
                				}
                            }
                			
                            ?>
                        
                    </div>
                </div>
            </div>

        </section>