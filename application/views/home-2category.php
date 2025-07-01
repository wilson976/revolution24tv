        <!-- Advertisement -->
        <section class="Advertisement">
            <div class="container">
                <div class="row">
                    <div class="text-center overflow-hidden d-none d-sm-block mb-20">
                    <?php $this->load->view('Ads', ['position'=>'D-H-B-education']); ?>
                </div>
                 <div class="text-center overflow-hidden d-sm-none d-xl-none mb-20">
                    <?php $this->load->view('Ads', ['position'=>'M-H-B-education']); ?>
                </div>
                </div>
            </div>

        </section>
        <!-- ======শিক্ষা====== -->
        <section class="eduReligionSection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="SecTitle">
                                    <a href="./online/cricket-women">
                                        <span class="RIghtBar"></span>
                                        <h2> নারী ক্রিকেট</h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        if($cricketwomen!=""){
                        ?>
                        
                        <div class="DCommonCat1">
                            <div class="DCommonCat1TopNews">
                                <a href="<?php echo findWorkbleMenu($cricketwomen[0]['n_category']); ?>/<?php echo str_replace('-', '/', $cricketwomen[0]['n_date']) ?>/<?php echo $cricketwomen[0]['n_id']; ?>">
                                    <div class="DImgZoomBlock">
                                        <picture>
                                            <img src="<?php echo './assets/news_images/'.str_replace('-','/',$cricketwomen[0]['n_date']).'/thumbnails/' . $cricketwomen[0]['main_image']; ?>" alt="<?php echo $cricketwomen[0]['n_head'];?>" title="<?php echo $cricketwomen[0]['n_head'];?>" class="">
                                        </picture>
                                        <?php
                                                if($cricketwomen[0]['n_video']=='yes'){
                                            ?>
                                            <i class="fa-solid fa-play vid-icon"></i>
                                            <?php
                                                }
                                            ?>
                                    </div>
                                    <div class="Desc">
                                        <h3 class="Title"><?php echo $cricketwomen[0]['n_head'];?></h3>
                                    </div>
                                </a>
                            </div>
                            <div class="DCommonCat1ListNews">
                                <ul>
                                   <?php
                        			$i=1;
                    				foreach ($cricketwomen as $key => $value) {
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
                                    <a href="./online/football-women">
                                        <span class="RIghtBar"></span>
                                        <h2> নারী ফুটবল</i></h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        if($footballwomen!=""){
                        ?>
                        
                        <div class="DCommonCat1">
                            <div class="DCommonCat1TopNews">
                                <a href="<?php echo findWorkbleMenu($footballwomen[0]['n_category']); ?>/<?php echo str_replace('-', '/', $footballwomen[0]['n_date']) ?>/<?php echo $footballwomen[0]['n_id']; ?>">
                                    <div class="DImgZoomBlock">
                                        <picture>
                                            <img src="<?php echo './assets/news_images/'.str_replace('-','/',$footballwomen[0]['n_date']).'/thumbnails/' . $footballwomen[0]['main_image']; ?>" alt="<?php echo $footballwomen[0]['n_head'];?>" title="<?php echo $footballwomen[0]['n_head'];?>" class="">
                                        </picture>
                                        <?php
                                                if($footballwomen[0]['n_video']=='yes'){
                                            ?>
                                            <i class="fa-solid fa-play vid-icon"></i>
                                            <?php
                                                }
                                            ?>
                                    </div>
                                    <div class="Desc">
                                        <h3 class="Title"><?php echo $footballwomen[0]['n_head'];?></h3>
                                    </div>
                                </a>
                            </div>
                            <div class="DCommonCat1ListNews">
                                <ul>
                                   <?php
                        			$i=1;
                    				foreach ($footballwomen as $key => $value) {
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
                       
                        
                    </div>
                </div>
            </div>

        </section>