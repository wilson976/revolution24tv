<div class="col-12">
				<div class="readMore">
					<div class="row">
						<div class="col-12"><p class="readMoreTitle">আরও পড়ুন:</p></div>
						  
						  <?php
							$i=1;
							if($Cat_more_news !=""){
								foreach($Cat_more_news as $value){
							?>
						  
						  
						  <div class="col-lg-3 d-flex align-items-stretch">
							<div class="news">
								<a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
									<div class="row gx-3">
										<div class="col-lg-12 col-sm-4 col-5">
											<div class="DImgBlock">
												<div class="DImgZoomBlock">
													<picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$value['n_date']).'/thumbnails/' . $value['main_image']; ?>" alt="<?php echo $value['n_head']; ?>" title="<?php echo $value['n_head']; ?>" class="img-fluid"></picture>
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
												<h3 class="Title MDTitle"><?php echo $value['n_head']; ?></h3>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						
						<?php
						if($i==8)
                         break;
                         $i++;
							    }
							}
                        ?>
												
					</div>
				</div>
			</div>