<main class="archivesPage">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- <div class="archivesTitle">
						<h1><i class="fas fa-box-archive"></i> আর্কাইভ</h1>
					</div> -->
					<div class="row">
						<div class="col-12">
							<div class="newsCatInfo">
								<div>
									<h4><a href="">প্রচ্ছদ</a> <i class="fas fa-caret-right"></i></h4>
								</div>
								<div>
									<h4><a href="./allnews">আর্কাইভ </a> </h4>
								</div>
							</div>
						</div>
					</div>
					
				
					<div class="archivesForm my-4">
						<form name="frmArchives" method="post" action="https://www.revolution24.tv/allnews/" class="form">
						    <input type="hidden" name="token" value="1">
							<div class="row">
							    	<div class="col-lg-2">
									<label class="form-label" for="formDate">হেডলাইন:</label>
								
									<input type="text" class="form-control" name="title" id="title" value="<?php echo $titlen?>">
								</div>
							    
							    <div class="col-lg-3">
							        
									<label class="form-label" for="formDate">বিভাগ:</label>
									<select name="catid" class="form-select" aria-label="Default select example">
										<option value="0">সব ক্যাটাগরি</option>
										<?php
										    foreach($online_menu as $key=>$value){
										?>
										<option value="<?php echo $value['m_id'];?>" <?php if ($value['m_id'] == $catid) echo ' selected'; ?>><?php echo $value['m_name'];?></option>
										<?php
										    }
										?>
										
									
										
									</select>
								</div>
								<div class="col-lg-3">
									<label class="form-label" for="formDate">থেকে:</label>
									<input type="date" class="form-control" id="datepicker" name="dtDate" value="<?php echo $sdate?>">
								</div>
								<div class="col-lg-3">
									<label class="form-label" for="formDate">পর্যন্ত:</label>
									<input type="date" class="form-control" id="datepickerto" name="dsDate" value="<?php echo $edate?>">
								</div>
								
								<div class="col-lg-1">
									<div class="submitBtnSec" id="btnDiv">
										<button type="submit" name="btnSubmit" class="btn btn-primary" fdprocessedid="jogyv">সাবমিট</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="archivesNewsListSec">
						<div class="row read-more-container">
						    
						    <?php
						    $i=1;
						    if($result !=""){
						        foreach($result as $key=>$value){    
						    
						    ?>
    							<div class="col-lg-4 countclass" data-content="<?php echo $i;?>">
                    				<div class="newsList newsFrame">
                    					<a href="<?php echo findWorkbleMenu($value['n_category']); ?>/<?php echo str_replace('-', '/', $value['n_date']) ?>/<?php echo $value['n_id']; ?>">
                    						<div class="row">
                    							<div class="col-4">
                    								<div class="DImgBlock">
                    									<div class="DImgZoomBlock">
                    									<picture><img src="<?php echo './assets/news_images/'.str_replace('-','/',$value['n_date']).'/thumbnails/' . $value['main_image']; ?>" alt="<?php echo $value['n_head'];?>" title="<?php echo $value['n_head'];?>" class=""></picture>
                    									</div>
                    								</div>
                    							</div>
                    							<div class="col-8">
                    								<div class="desc">
                    									<h3 class="Title"><?php echo $value['n_head'];?></h3>
                    									<p class="date"><?php echo en2bndateConverter($value['start_date']); ?></p>
                    								</div>
                    							</div>
                    						</div>
                    					</a>
                    				</div>
                    			</div>

							<?php
							$i++;
						        }
							}
							?>

                			</div>
						
					</div>
				</div>
				<div class="col-lg-12">
    						<div class="ts-pagination text-center mb-20">
                                 <ul class="pagination">
                                    <?php echo $links; ?>
                                 </ul>
                            </div>
						</div>
			</div>
		</div>
	</main>