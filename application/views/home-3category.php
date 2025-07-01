        <!-- Advertisement -->
        <section class="Advertisement">
            <div class="container">
                <div class="row">
                    <div class="text-center overflow-hidden d-none d-sm-block mb-20">
                    <?php $this->load->view('Ads', ['position'=>'D-H-B-health']); ?>
                </div>
                 <div class="text-center overflow-hidden d-sm-none d-xl-none mb-20">
                    <?php $this->load->view('Ads', ['position'=>'M-H-B-health']); ?>
                </div>
                </div>
            </div>

        </section>
        
        <section class="eduReligionSection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="SecTitle">
                                    <a href="./online/tennis">
                                        <span class="RIghtBar"></span>
                                        <h2> টেনিস </h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        if($tennis!=""){
                        ?>
                        
                        <div class="DCommonCat1">
                            <div class="DCommonCat1TopNews">
                                <a href="<?php echo findWorkbleMenu($tennis[0]['n_category']); ?>/<?php echo str_replace('-', '/', $tennis[0]['n_date']) ?>/<?php echo $tennis[0]['n_id']; ?>">
                                    <div class="DImgZoomBlock">
                                        <picture>
                                            <img src="<?php echo './assets/news_images/'.str_replace('-','/',$tennis[0]['n_date']).'/thumbnails/' . $tennis[0]['main_image']; ?>" alt="<?php echo $tennis[0]['n_head'];?>" title="<?php echo $tennis[0]['n_head'];?>" class="">
                                        </picture>
                                         <?php
                                                if($tennis[0]['n_video']=='yes'){
                                            ?>
                                            <i class="fa-solid fa-play vid-icon"></i>
                                            <?php
                                                }
                                            ?>
                                    </div>
                                    <div class="Desc">
                                        <h3 class="Title"><?php echo $tennis[0]['n_head'];?></h3>
                                    </div>
                                </a>
                            </div>
                            <div class="DCommonCat1ListNews">
                                <ul>
                                   <?php
                        			$i=1;
                    				foreach ($tennis as $key => $value) {
                    				    if($i>1){
                        			?> 
                                    
                                    <li>
                                        <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                            <h3 class="Title"><?php echo $value['n_head'];?></h3>
                                        </a>
                                    </li>
                                    <?php
                        				}
                                    $i++;
                                    if($i==5) break;
                        				}
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="SecTitle">
                                    <a href="./online/hocky">
                                        <span class="RIghtBar"></span>
                                        <h2> হকি </h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        if($hocky!=""){
                        ?>
                        
                        <div class="DCommonCat1">
                            <div class="DCommonCat1TopNews">
                                <a href="<?php echo findWorkbleMenu($hocky[0]['n_category']); ?>/<?php echo str_replace('-', '/', $hocky[0]['n_date']) ?>/<?php echo $hocky[0]['n_id']; ?>">
                                    <div class="DImgZoomBlock">
                                        <picture>
                                            <img src="<?php echo './assets/news_images/'.str_replace('-','/',$hocky[0]['n_date']).'/thumbnails/' . $hocky[0]['main_image']; ?>" alt="<?php echo $hocky[0]['n_head'];?>" title="<?php echo $hocky[0]['n_head'];?>" class="">
                                        </picture>
                                        <?php
                                                if($hocky[0]['n_video']=='yes'){
                                            ?>
                                            <i class="fa-solid fa-play vid-icon"></i>
                                            <?php
                                                }
                                            ?>
                                    </div>
                                    <div class="Desc">
                                        <h3 class="Title"><?php echo $hocky[0]['n_head'];?></h3>
                                    </div>
                                </a>
                            </div>
                            <div class="DCommonCat1ListNews">
                                <ul>
                                   <?php
                        			$i=1;
                    				foreach ($hocky as $key => $value) {
                    				    if($i>1){
                        			?> 
                                    
                                    <li>
                                        <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                            <h3 class="Title"><?php echo $value['n_head'];?></h3>
                                        </a>
                                    </li>
                                    <?php
                        				}
                                    $i++;
                                    if($i==5) break;
                        				}
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="SecTitle">
                                    <a href="./online/golf">
                                        <span class="RIghtBar"></span>
                                        <h2> গলফ </h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        if($golf!=""){
                        ?>
                        
                        <div class="DCommonCat1">
                            <div class="DCommonCat1TopNews">
                                <a href="<?php echo findWorkbleMenu($golf[0]['n_category']); ?>/<?php echo str_replace('-', '/', $golf[0]['n_date']) ?>/<?php echo $golf[0]['n_id']; ?>">
                                    <div class="DImgZoomBlock">
                                        <picture>
                                            <img src="<?php echo './assets/news_images/'.str_replace('-','/',$golf[0]['n_date']).'/thumbnails/' . $golf[0]['main_image']; ?>" alt="<?php echo $golf[0]['n_head'];?>" title="<?php echo $golf[0]['n_head'];?>" class="">
                                        </picture>
                                         <?php
                                                if($golf[0]['n_video']=='yes'){
                                            ?>
                                            <i class="fa-solid fa-play vid-icon"></i>
                                            <?php
                                                }
                                            ?>
                                    </div>
                                    <div class="Desc">
                                        <h3 class="Title"><?php echo $golf[0]['n_head'];?></h3>
                                    </div>
                                </a>
                            </div>
                            <div class="DCommonCat1ListNews">
                                <ul>
                                   <?php
                        			$i=1;
                    				foreach ($golf as $key => $value) {
                    				    if($i>1){
                        			?> 
                                    
                                    <li>
                                        <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                            <h3 class="Title"><?php echo $value['n_head'];?></h3>
                                        </a>
                                    </li>
                                    <?php
                        				}
                                    $i++;
                                    if($i==5) break;
                        				}
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        
                    </div>
                   
                </div>
            </div>

        </section>