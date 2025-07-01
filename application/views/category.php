<main class="categoryPage">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="newsCatInfo">
					<div>
						<h3><a href="">প্রচ্ছদ</a> <i class="fas fa-caret-right"></i></h3>
					</div>
					<div>
						<h3><a href="./online/<?php echo $getmenu['m_bangla']; ?>"><?php echo strip_tags($getmenu['m_name']); ?> </a> </h3>
					</div>
					
				</div>
			</div>
			<!-- <div class="col-lg-12"> -->
								<!-- </div> -->
			<div class="col-12">
				<div class="categoryLeadSec">
					<div class="row">
						<div class="col-lg-9">
							<?php
                      if($category_leadnews !=""){
                      ?>
							<div class="categoryTopLeadNews newsFrame">
								<a href="<?php echo findWorkbleMenu($category_leadnews['n_category']); ?>/<?php echo str_replace('-', '/', $category_leadnews['n_date']) ?>/<?php echo $category_leadnews['n_id']; ?>">
									<div class="row">
										<div class="col-lg-7">
											<div class="DImgBlock">
												<div class="DImgZoomBlock">
													<picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$category_leadnews['n_date']).'/' . $category_leadnews['main_image']; ?>" alt="<?php echo $category_leadnews['n_head'];?>" title="<?php echo $category_leadnews['n_head'];?>" class=""></picture>
    												<?php
                                                    if($category_leadnews['n_video']=='yes'){
                                                    ?>
                                                    <i class="fa-solid fa-play vid-icon"></i>
                                                    <?php
                                                        }
                                                    ?>
												
												</div>
												
											</div>
										</div>
										<div class="col-lg-5">
											<div class="desc">
												<h1 class="Title"><?php echo $category_leadnews['n_head'];?></h1>
												<p class="Brief"><?php echo splitText(strip_tags($category_leadnews['n_details']), 800);?></p>
											</div>
										</div>
									</div>
								</a>
							</div>
							
							<?php
                      }
							?>
							
							<div class="categoryTopNewList">
								<div class="row">
								     <?php
                            		    $i=1;
                            			if($more_news != NULL){
                        				foreach ($more_news as $key => $value) {
                        				    
                        			?>
								    
                                    <div class="col-lg-4 d-flex align-items-stretch">
                                        <div class="newsSM newsFrame">
                                        	<a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                                        		<div class="row gx-3">
                                        			<div class="col-lg-12 col-sm-4 col-5">
                                        				<div class="DImgBlock">
                                        					<div class="DImgZoomBlock">
                                        						<picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$value['n_date']).'/thumbnails/' . $value['main_image']; ?>" alt="<?php echo $value['n_head'];?>" title="<?php echo $value['n_head'];?>" class=""></picture>
                                        					    <?php
                                                                if($value['n_video']=='yes'){
                                                                ?>
                                                                <i class="fa-solid fa-play vid-icon"></i>
                                                                <?php
                                                                    }
                                                                ?>
                                        					
                                        					</div>
                                        				</div>
                                        			</div>
                                        			<div class="col-lg-12 col-sm-8 col-7">
                                        				<div class="desc">
                                        					<h3 class="Title MDTitle"><?php echo $value['n_head'];?></h3>
                                        				</div>
                                        			</div>
                                        		</div>
                                        	</a>
                                        </div>
                                    </div>
                                    <?php
                                      if($i==6)break;
                				    
                				   
                				    $i++;
                				    }
                				}
                                ?>
                                    
								</div>
							</div>
						</div>
						<?php $this->load->view('category-right');?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="categoryMoreNewsListSec">
		<div class="container">
			<div class="row">
			
				<div class="row read-more-container" id="contentAppend">
				    <?php
            		    $i=1;
            			if($more_news != NULL){
        				foreach ($more_news as $key => $value) {
        				if($i>6){
        			?>
					<div class="col-lg-3 countclass" data-content="<?php echo $i;?>">
						<div class="newsList newsFrame">
							<a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
								<div class="row gx-3">
									<div class="col-lg-12 col-sm-4 col-5">
										<div class="DImgBlock">
											<div class="DImgZoomBlock">
												<picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$value['n_date']).'/thumbnails/' . $value['main_image']; ?>" alt="<?php echo $value['n_head'];?>" title="<?php echo $value['n_head'];?>" class="img-fluid img100 ImgRatio"></picture>
											<?php
                                                if($value['n_video']=='yes'){
                                                ?>
                                                <i class="fa-solid fa-play vid-icon"></i>
                                                <?php
                                                    }
                                                ?>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-sm-8 col-7">
										<div class="desc">
											<h3 class="Title MDTitle"><?php echo $value['n_head'];?></h3>
										</div>
									</div>
								</div>
								
							</a>
						</div>
					</div>
					
					 <?php
        				    }
        				    $i++;
        				    }
        				}
                      ?> 
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12">
    			<div class="ts-pagination text-center mb-20">
                     <ul class="pagination">
                        <?php echo $links; ?>
                     </ul>
                </div>
			</div>
		</div>
	</div>
</main>