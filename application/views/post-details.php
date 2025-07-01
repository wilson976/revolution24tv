<main>
	<div class="container">
		<div class="row">
			
			<div class="col-lg-9">
				<div class="row">
					<div class="col-lg-12">
						<div class="newsCatInfo">
							<div><h4><a href="<?php echo base_url();?>">প্রচ্ছদ</a> <i class="fas fa-caret-right"></i></h4></div>
							<div><h4><a href="<?php echo base_url();?>online/<?php echo findWorkbleMenu($getnewsby_id['n_category']); ?>"><?php echo strip_tags($getmenu['m_name']); ?> </a> </h4></div>
						</div>
					</div>
					
					
					<div class="text-center overflow-hidden d-none d-sm-block mb-20">
                        <?php $this->load->view('Ads', ['position'=>'D-P-T-Before-Head']); ?> 
                    </div>
                    <div class="text-center overflow-hidden d-sm-none d-xl-none mb-20">
                        <?php $this->load->view('Ads', ['position'=>'M-P-T-Before-Head']); ?>
                        
                    </div>
                    

					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-12">
								<article>
									<h3></h3>
									<h1 class="DHeading"><?php echo $getnewsby_id['n_head'];?></h1>
								</article>
							</div>
							<div class="col-lg-12">

									<div class="row">
										<div class="col-lg-3 sticky2">
											<div class="sticky2">
												<div class="row">
													<div class="col-lg-12">
														<div class="newsRelatedinfo">
															<div class="dateWriter">
																<p class="writter"><span></span> 
																<?php
                                                                    if ($getnewsby_id['n_author'] != 'Not defined') {
                                                                    	
                                                                    		if ($getnewsby_id['n_author'] == 'Designation default')
                                                                    			echo 'নিজস্ব প্রতিবেদক';
                                                                    		elseif ($getnewsby_id['n_author'] == 'Online Desk')
                                                                    			echo 'অনলাইন ডেস্ক';
                                                                    		elseif ($getnewsby_id['n_author'] == 'Press release')
                                                                    			echo 'প্রেস বিজ্ঞপ্তি';
                                                                    		elseif ($getnewsby_id['n_author'] == 'Desk')
                                                                    			echo 'ডেস্ক';
                                                                    		elseif ($getnewsby_id['n_author'] == 'Staff reporter')
                                                                    			echo 'স্টাফ  রিপোর্টার';
                                                                    
                                                                    		elseif ($getnewsby_id['n_author'] == 'Other')
                                                                    			echo $getnewsby_id['n_author_other'];
                                                                    		elseif ($getnewsby_id['n_author'] == 'Author name')
                                                                    			echo '<a href="./author/profile/' . $getprofile['p_id'] . '">' . $getprofile['p_name'] . '</a><img alt="' . strip_tags($getprofile['p_name']) . '" src=./assets/images/profile_image/thmubs/' . $getprofile['p_pic'] . ' style="width:45px;">';
                                                                    }
                                                                    ?>
																</p>
																																
																<p class="date">প্রকাশিত: <?php echo en2bndateConverter($getnewsby_id['start_date']); ?></p>
																<?php
																if($getnewsby_id['edit_time']!=""){
																?>
																<p class="date">আপডেট:  <?php echo en2bndateConverter($getnewsby_id['edit_time']); ?></p>
																<?php
																}
																?>
															</div>
															
														</div>
													</div>
													<div class="col-lg-12 mt-3">
													    
													    
													<div class="text-center MobileMenuShow mb-2">
                                                    
                                                    <!-- AddToAny BEGIN -->
                                                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="<?php echo base_url(); ?><?php echo findWorkbleMenu($getnewsby_id['n_category']); ?>/<?php echo str_replace('-', '/', $getnewsby_id['n_date']) ?>/<?php echo $getnewsby_id['n_id']; ?>" data-a2a-title="<?php echo PregRemove(remove_newline(strip_tags($getnewsby_id['n_head']))); ?>" style="line-height: 30px;">
                                                            
                                                            <a class="a2a_button_facebook"></a>
                                                            <a class="a2a_button_facebook_messenger"></a>
                                                            <a class="a2a_button_twitter"></a>
                                                            <a class="a2a_button_linkedin"></a>
                                                            <a class="a2a_button_whatsapp"></a>
                                                            <a class="a2a_button_viber"></a>
                                                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                                        </div>
                                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                                    <!-- AddToAny END -->
                                                    
                                                    
                                                    
                                                    <!-- AddToAny END --> 
                                                </div>
													    
														
													<div class="socialShare MobileHide">
                                                    <p class="socialShareTxt">শেয়ার</p>
                                                    
                                                    <a target="_blank" href="./home/printnews/<?php echo $getnewsby_id['n_id']; ?>" title="Print this article"><i class="fa fa-print fa-lg" aria-hidden="true"></i></a>
                                                    <!-- AddToAny BEGIN -->
                                                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="<?php echo base_url(); ?><?php echo findWorkbleMenu($getnewsby_id['n_category']); ?>/<?php echo str_replace('-', '/', $getnewsby_id['n_date']) ?>/<?php echo $getnewsby_id['n_id']; ?>" data-a2a-title="<?php echo PregRemove(remove_newline(strip_tags($getnewsby_id['n_head']))); ?>" style="line-height: 30px;">
                                                            
                                                            <p><a class="a2a_button_facebook"></a></P>
                                                            <p><a class="a2a_button_facebook_messenger"></a></P>
                                                            <p><a class="a2a_button_twitter"></a></P>
                                                            <p><a class="a2a_button_linkedin"></a></P>
                                                            <p><a class="a2a_button_whatsapp"></a></P>
                                                            <p><a class="a2a_button_viber"></a></P>
                                                            <p><a class="a2a_dd" href="https://www.addtoany.com/share"></a></P>
                                                        </div>
                                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
                                                    
                                                    
                                                    
                                                    <!-- AddToAny END --> 
                                                </div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-9">
											<div class="detailsNewsColDiv">
												<article>
													<div class="mainImage" vtype="">
															<img src="<?php echo './assets/news_images/' . str_replace('-', '/', $getnewsby_id['n_date']) . '/' . $getnewsby_id['main_image']; ?>" alt="<?php echo $getnewsby_id['n_head'];?>" title="<?php echo $getnewsby_id['n_head'];?>" class="img-fluid img100">
															<div class="caption"><?php echo strip_tags($getnewsby_id['n_caption']); ?></div>
														</div>

													<div class="detailsContent" id="contentDetails">
													    <?php echo $getnewsby_id['n_details']; ?>
													    </div>
													<div class="initial"></div>
												</article>
											</div>
											<div id="fb-root"></div>
                                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v20.0&appId=362696474649529" nonce="7awAa5xP"></script>
                                        
                                        <div class="fb-comments" data-href="<?php echo base_url(); ?><?php echo findWorkbleMenu($getnewsby_id['n_category']); ?>/<?php echo str_replace('-', '/', $getnewsby_id['n_date']) ?>/<?php echo $getnewsby_id['n_id']; ?>" data-width="100%" data-numposts="5"></div>
										</div>
									</div>

							</div>
						</div>

					</div>
				</div>

			</div>
			<?php $this->load->view('post-right');?>
			<?php $this->load->view('post-bottom');?>
		</div>
	</div>
</main>

<style>
    .detailsContent img{
    max-width:100%;
    }
</style>