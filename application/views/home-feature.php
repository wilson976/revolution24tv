
    <div class="text-center overflow-hidden d-none d-sm-block">
        <?php $this->load->view('Ads', ['position'=>'D-H-T-Highlights']); ?>
    </div>
    
    
     <div class="text-center overflow-hidden d-sm-none d-xl-none">
        <?php $this->load->view('Ads', ['position'=>'M-H-T-Highlights']); ?>
    </div>

        <!-- =====Highlight===== -->
        <section class="highlightSection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="SecTitle">
                            <a href="./online/feature">
                                <span class="RIghtBar"></span>
                                <h2> ফিচার </h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-12 rowresize">
                        <div class="DTop2">
                            <div class="row">
                                
                                <?php
                                if($feature!=""){
                                    $i=1;
                                    foreach ($feature as $key=>$value){
                                ?>
                                <div class="col-lg-4 col-sm-4 col-6 d-flex">
                                    <div class="DTop6List align-self-stretch">
                                        <a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                            <picture>
                                                <img src="<?php echo './assets/news_images/'.str_replace('-','/',$value['n_date']).'/thumbnails/' . $value['main_image']; ?>" alt="<?php echo $value['n_head'];?>" title="<?php echo $value['n_head'];?>" class="img-fluid img100">
                                                <?php
                                                            if($value['n_video']=='yes'){
                                                        ?>
                                                        <i class="fa-solid fa-play vid-icon"></i>
                                                        <?php
                                                            }
                                                        ?>
                                                </picture>
                                            <div class="Desc">
                                                <h2 class="Title fw-bold"><?php if($value['live_news']=='yes') echo '<span class="ldot"><i class="fa fa-circle fa-fw"></i>Live</span> - '?><?php echo $value['n_head'];?></h2>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                $i++;
                                
                                if($i==4) break;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
