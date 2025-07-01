<div class="col-lg-3 margin-top">
	<section class="DLPSTab2 ">
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
        <div class="allnews"><a href="./allnews">সব খবর <i class="fa fa-angle-double-right"></i></a></div>
    </section>
</div>