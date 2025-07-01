<!-- =======DTopSection======= -->
        <section class="DLeadNewsSection">
            <div class="container">
                
                <div class="text-center overflow-hidden d-none d-sm-block mb-20">
                    <?php $this->load->view('Ads', ['position'=>'D-H-B-Lead-news']); ?>
                </div>
                 <div class="text-center overflow-hidden d-sm-none d-xl-none mb-20">
                    <?php $this->load->view('Ads', ['position'=>'M-H-B-Lead-News']); ?>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        if($lead_news !=""){
                        ?>
                        
                        <div class="row">
                            <div class="col-lg-3 col-12 odr2">
                                <div class="DLeadNewsLeftTop">
                                    <a href="<?php echo findWorkbleMenu($lead_news[1]['n_category']); ?>/<?php echo str_replace('-', '/', $lead_news[1]['n_date']) ?>/<?php echo $lead_news[1]['n_id']; ?>">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="DImgZoomBlock">
                                                    <picture>
                                                        <img src="<?php echo './assets/news_images/'.str_replace('-','/',$lead_news[1]['n_date']).'/thumbnails/' . $lead_news[1]['main_image']; ?>" alt="<?php echo $lead_news[1]['n_head'];?>" title="<?php echo $lead_news[1]['n_head'];?>" class="img-fluid img100 ImgRatio">
                                                        </picture>
                                                        
                                                        <?php
                                                            if($lead_news[1]['n_video']=='yes'){
                                                        ?>
                                                        <i class="fa-solid fa-play vid-icon"></i>
                                                        <?php
                                                            }
                                                        ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="Desc">
                                                    <h2 class="Title"><?php if($lead_news[1]['live_news']=='yes') echo '<span class="ldot"><i class="fa fa-circle fa-fw"></i>Live</span> - '?><?php echo $lead_news[1]['n_head'];?></h2>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="DLeadNewsLeftTop">
                                    <a href="<?php echo findWorkbleMenu($lead_news[2]['n_category']); ?>/<?php echo str_replace('-', '/', $lead_news[2]['n_date']) ?>/<?php echo $lead_news[2]['n_id']; ?>">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="DImgZoomBlock">
                                                    <picture>
                                                        <img src="<?php echo './assets/news_images/'.str_replace('-','/',$lead_news[2]['n_date']).'/thumbnails/' . $lead_news[2]['main_image']; ?>" alt="<?php echo $lead_news[2]['n_head'];?>" title="<?php echo $lead_news[2]['n_head'];?>" class="img-fluid img100 ImgRatio">
                                                        </picture>
                                                        
                                                        <?php
                                                            if($lead_news[2]['n_video']=='yes'){
                                                        ?>
                                                        <i class="fa-solid fa-play vid-icon"></i>
                                                        <?php
                                                            }
                                                        ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="Desc">
                                                    <h2 class="Title"><?php if($lead_news[2]['live_news']=='yes') echo '<span class="ldot"><i class="fa fa-circle fa-fw"></i>Live</span> - '?><?php echo $lead_news[2]['n_head'];?></h2>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 odr1">
                                <div class="DLeadNews">
                                    <a href="<?php echo findWorkbleMenu($lead_news[0]['n_category']); ?>/<?php echo str_replace('-', '/', $lead_news[0]['n_date']) ?>/<?php echo $lead_news[0]['n_id']; ?>">
                                        <div class="DImgZoomBlock">
                                            <picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$lead_news[0]['n_date']).'/' . $lead_news[0]['main_image']; ?>" alt="<?php echo $lead_news[0]['n_head'];?>" title="<?php echo $lead_news[0]['n_head'];?>" class="img-fluid img100 ImgRatio"></picture>
                                            <?php
                                                            if($lead_news[0]['n_video']=='yes'){
                                                        ?>
                                                        <i class="fa-solid fa-play vid-icon"></i>
                                                        <?php
                                                            }
                                                        ?>
                                        </div>
                                        </a>
                                        <div class="Desc">
                                            <a href="<?php echo findWorkbleMenu($lead_news[0]['n_category']); ?>/<?php echo str_replace('-', '/', $lead_news[0]['n_date']) ?>/<?php echo $lead_news[0]['n_id']; ?>">
                                                <h1 class="Title"><?php if($lead_news[0]['live_news']=='yes') echo '<span class="ldot"><i class="fa fa-circle fa-fw"></i>Live</span> - '?><?php echo $lead_news[0]['n_head'];?></h1>
                                                </a>
                                           
                                           <?php
                                           if($lead_news[0]['live_news']=='yes'){
                                           ?>
                                           <ul class="ln-tn">
                                               <?php
                                               foreach($live_news as $val){
                                               ?>
                                                <li class="ln-tn__update">
                                                    <div class="ln-tn__bullet">
                                                       <svg class="icon icon--live-orange icon--primary icon--13 " viewBox="0 0 20 20" version="1.1" aria-hidden="true">
                                                           <title>live-orange</title>
                                                           <g>
                                                               <circle cx="10" cy="10" r="9" stroke="#fa9000" stroke-width="1.68" fill="#ffffff"></circle>
                                                               <circle cx="10" cy="10" r="5" fill="#fa9000"></circle>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="ln-tn__update-details">
                                                       
                                                        
                                                      
                                                       
                                                           <h4 class="ln-tn__update-content"><span class="ltime"><?php echo  timedifference($val['post_time']);?> আগে: </span><a href="<?php echo findWorkbleMenu($lead_news[0]['n_category']); ?>/<?php echo str_replace('-', '/', $lead_news[0]['n_date']) ?>/<?php echo $lead_news[0]['n_id']; ?>/<?php echo '#'.$val['l_id'];?>"><?php echo $val['new_head'];?></a></h4>
                                                        
                                                    </div>
                                                </li>
                                                
                                                <?php
                                               }
                                                ?>
                                                           
                                                           
                                                           
                                                        </ul>    
                                                       <?php
                                                       }else{
                                                       ?>
                                                       
                                                      
                                                       
                                                        <div class="Brief">
                                                            <p><?php //echo splitText(strip_tags($lead_news[0]['n_details']), 680); ?></p>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                        </div>
                                        
                                        <div class="Brief">
                                        <p><?php echo splitText(strip_tags($lead_news[0]['n_details']), 880); ?></p>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="col-lg-3 col-12 odr2">
                                <div class="DLeadNewsLeftTop">
                                    <a href="<?php echo findWorkbleMenu($lead_news[3]['n_category']); ?>/<?php echo str_replace('-', '/', $lead_news[3]['n_date']) ?>/<?php echo $lead_news[3]['n_id']; ?>">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="DImgZoomBlock">
                                                    <picture>
                                                        <img src="<?php echo './assets/news_images/'.str_replace('-','/',$lead_news[3]['n_date']).'/thumbnails/' . $lead_news[3]['main_image']; ?>" alt="<?php echo $lead_news[3]['n_head'];?>" title="<?php echo $lead_news[3]['n_head'];?>" class="img-fluid img100 ImgRatio">
                                                        </picture>
                                                        
                                                        <?php
                                                            if($lead_news[3]['n_video']=='yes'){
                                                        ?>
                                                        <i class="fa-solid fa-play vid-icon"></i>
                                                        <?php
                                                            }
                                                        ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="Desc">
                                                    <h2 class="Title"><?php if($lead_news[3]['live_news']=='yes') echo '<span class="ldot"><i class="fa fa-circle fa-fw"></i>Live</span> - '?><?php echo $lead_news[3]['n_head'];?></h2>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="DLeadNewsLeftTop">
                                    <a href="<?php echo findWorkbleMenu($lead_news[4]['n_category']); ?>/<?php echo str_replace('-', '/', $lead_news[4]['n_date']) ?>/<?php echo $lead_news[4]['n_id']; ?>">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="DImgZoomBlock">
                                                    <picture>
                                                        <img src="<?php echo './assets/news_images/'.str_replace('-','/',$lead_news[4]['n_date']).'/thumbnails/' . $lead_news[4]['main_image']; ?>" alt="<?php echo $lead_news[4]['n_head'];?>" title="<?php echo $lead_news[4]['n_head'];?>" class="img-fluid img100 ImgRatio">
                                                        </picture>
                                                        
                                                        <?php
                                                            if($lead_news[4]['n_video']=='yes'){
                                                        ?>
                                                        <i class="fa-solid fa-play vid-icon"></i>
                                                        <?php
                                                            }
                                                        ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="Desc">
                                                    <h2 class="Title"><?php if($lead_news[4]['live_news']=='yes') echo '<span class="ldot"><i class="fa fa-circle fa-fw"></i>Live</span> - '?><?php echo $lead_news[4]['n_head'];?></h2>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                
                                
                               
                               
                               
                                
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        
                    </div>
                   
                </div>
            </div>
        </section>
        
