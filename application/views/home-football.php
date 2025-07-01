        <!-- =====Bangladesh section======= -->
        <section class="bangladeshSection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="SecTitle">
                            <a href="./online/football">
                                <span class="RIghtBar"></span>
                                <h2> ফুটবল </h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-12  order order-2">
                        <section class="DLPSTab2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tabs-2" role="tab" aria-selected="true">সর্বশেষ</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-1" role="tab" aria-selected="false" tabindex="-1">জনপ্রিয়</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="panel-body PanelHeight">
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="tabs-2" role="tabpanel">
                                            <div class="DLatestNews longEnough mCustomScrollbar" data-mcs-theme="dark">
                                              <?php
                                                $i=1;
                                                if($latest_news !=""){
                                                    foreach($latest_news as $key=>$value){  
                                                ?>
                                                <div class="DLatestNewsList">
                                                    <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                                        <div class="d-flex flex-row">
                                                            <div class="d-flex align-items-center"><span><?php echo en2bnNumber($i);?></span></div>
                                                            <p><?php echo $value['n_head'];?></p>
                                                        </div>
                                                    </a>
                                                </div>
                                                <?php
                                                $i++;
                                                    }
                                                }
                                                ?>
                                                
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabs-1" role="tabpanel">
                                            <div class="DLatestNews longEnough mCustomScrollbar" data-mcs-theme="dark">
                                                <?php
                                                $i=1;
                                                if($most_read !=""){
                                                    foreach($most_read as $key=>$value){    
                                                
                                                ?>
                                                <div class="DLatestNewsList">
                                                    <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                                        <div class="d-flex flex-row">
                                                            <div class="d-flex align-items-center"><span><?php echo en2bnNumber($i);?></span></div>
                                                            <p><?php echo $value['n_head'];?></p>
                                                        </div>
                                                    </a>
                                                </div>
                                                <?php
                                                $i++;
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="allnews">
                                <a href="./allnews"><i class="fa fa-angle-double-left"></i> সব খবর <i class="fa fa-angle-double-right"></i></a>
                                </div>
                        </section>
                    </div>
                    
                    
                    <div class="col-lg-6 col-12">
                        
                        <?php
                        if($football!=""){
                        ?>
                        <div class="DBdTop">
                            <a href="<?php echo findWorkbleMenu($football[0]['n_category']); ?>/<?php echo str_replace('-', '/', $football[0]['n_date']) ?>/<?php echo $football[0]['n_id']; ?>">
                                <div class="DImgZoomBlock">
                                    <picture>
                                        <img src="<?php echo './assets/news_images/'.str_replace('-','/',$football[0]['n_date']).'/' . $football[0]['main_image']; ?>" alt="<?php echo $football[0]['n_head'];?>" title="<?php echo $football[0]['n_head'];?>" class="img-fluid">
                                    </picture>
                                    <?php
                                            if($football[0]['n_video']=='yes'){
                                        ?>
                                        <i class="fa-solid fa-play vid-icon"></i>
                                        <?php
                                            }
                                        ?>
                                </div>
                                <div class="Desc">
                                    <h3 class="Title"><?php echo $football[0]['n_head'];?></h3>
                                    <div class="Brief">
                                        <p><?php echo splitText(strip_tags($football[0]['n_details']), 480); ?></p>
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
                			if($football != NULL){
                				foreach ($football as $key => $value) {
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