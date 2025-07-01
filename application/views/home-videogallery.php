        <!-- Advertisement -->
        <section class="Advertisement">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="MiddleAdd">
                            <a href="#">
                                <img src="./assets/media/imgAll/Advertisement/Advertisement(970X90).png" alt="Middle Advertisement" title="Middle Advertisement" class="img-fluid img100"></a>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- ====VideoSection===== -->
        <section class="videoSec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="SecTitle2">
                            <a href="#">
                                <h2> ভিডিও <i class="fas fa-angle-double-right"></i></h2>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="DVideoList">
                    <div class="row">
                        
                        <?php
                            $i=1;
                            if($vid1 !=""){
                                
                            ?>
                        <div class="col-lg-6 col-sm-12 rowresize" style="flex: 0 0 55%;max-width:55%;">
                            <div class="DVideoTop">
                                <a href="./video/<?php echo $vid1[0]['v_id'];?>">
                                    <div class="DImgZoomBlock">
                                        <picture><img class="img-fluid" src="https://img.youtube.com/vi/<?php echo $vid1[0]['link'];?>/0.jpg" alt="<?php echo $vid1[0]['v_caption'];?>" title="<?php echo $vid1[0]['v_caption'];?>"></picture>
                                        <span class="videoIcon">
                                            <i class="fab fa-youtube"></i>
                                        </span>
                                    </div>
                                    <div class="Desc">
                                        <h3 class="Title"><?php echo $vid1[0]['v_caption'];?></h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                            
                            }
                        ?>
                        
                        
                        <div class="col-lg-6 col-sm-12 rowresize" style="flex: 0 0 45%;max-width:45%;">
                            <div class="DVideoList">
                                <div class="row">
                                    
                                     <?php
                                        $i=1;
                                        if($vid1 !=""){
                                            foreach($vid1 as $key=>$value){
                                                if($i>1){
                                        ?>
                                    <div class="col-lg-6 col-6">
                                        <div class="DVideoListItem align-self-stretch">
                                            <a href="./video/<?php echo $value['v_id'];?>">
                                                <div class="DImgZoomBlock">
                                                    <picture><img class="img-fluid" src="https://img.youtube.com/vi/<?php echo $value['link'];?>/0.jpg" alt="<?php echo $value['v_caption'];?>" title="<?php echo $value['v_caption'];?>"></picture>
                                                    <span class="videoIcon">
                                                        <i class="fab fa-youtube"></i>
                                                    </span>
                                                </div>
                                                <div class="Desc">
                                                    <h3 class="Title"><?php echo $value['v_caption'];?></h3>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                                }
                                                if($i==5) break;
                                    $i++;
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </section>