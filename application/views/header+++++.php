    	<!-- top-search-box -->
	<div id="searchcontainer" class="hidden">
		<div id="search" class="search_block">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<form id="cse-search-box" action="./searchresult" method="get">
							<div class="search_logo display-flex">
								<input type="hidden" value="0d1cfb4a6baa6317d" name="cx">
								<!--<input type="hidden" name="cof" value="FORID:10">-->
								<!--<input type="hidden" name="ie" value="UTF-8">-->
								<input name="search" class="search-bar" placeholder="এখানে খুঁজুন..." title="Search" type="search">
								<button onclick="performSearch()"><i id="searchButton" class="fa fa-search"></i></button>
								<a onclick="hideSearchBox()" class="close-search" id="closeButton"><i class="fa fa-times"></i></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<header class="news-header bgwhitetop">
		<!-- top-header -->
		<div class="container">
			<div class="row">
			    
			    
			    
				<div class="col-md-8 col-sm-12  ">
					<div class="topImg">
					<a class=" d-lg-flex d-none align-items-left" title="Revolution24.TV" href="">
						<img class="img-fluid" src="<?php echo base_url().'assets/importent_images/'?>logo-sports.png" title="Revolution24.TV" alt="Revolution24.TV">
					</a>
					</div>
				</div>
				<div class="col-md-4 m-auto pr0">
				    
				   
					<div class="d-lg-flex d-none justify-content-end social-media-icons">
					    <div class="followus">পরিবর্তনের অঙ্গীকারে       </div> 
						<a href="https://www.facebook.com/sports24bangladesh" aria-label="Facebook" target="_blank">
							<div class="social-icon facebook"><i class="fa-brands fa-facebook-f"></i></div>
						</a>
						<a href="https://youtube.com/@sports24bangladesh" aria-label="Youtube" target="_blank">
							<div class="social-icon youtube"><i class="fa-brands fa-youtube"></i></div>
						</a>
						<a href="#" aria-label="Twitter" target="_blank">
							<div class="social-icon twitter"><i class="fa-brands fa-twitter"></i></div>
						</a>
						
						
					<div class="social-icon socialicon-search mr0" onclick="showSearchBox()" ><i class="fas fa-search" style="cursor:pointer"></i></div>
						
					<!--</div>-->
				</div>
				
			</div>
			<hr class="hrclass">
		</div>
		<!-- main navbar -->
		<div class="DHeaderNav stickyNav " id="sticky-navbar">
			<div class="container">
				<div class="row ">
					<div class="col-md-12">
						<nav class="navbar navbar-default navbar-expand-lg navbar-inverse ">
							<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
								<ul class="nav navbar-nav">
									<li class="nav-item"><a class="menuImg d-lg-flex justify-content-center align-items-center" title="revolution24.tv" href="">
											<img class="img-fluid "  src="<?php echo base_url().'assets/importent_images/'?>menu-logon.png" title="revolution24.tv" alt="revolution24.tv">
										</a></li>
										
											<li class="nav-item offcanfordesktop">
                    					<nav class="navbar navbar-default navbar-expand-lg ">
                    						<div class="d-flex justify-content-between  navbar-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExampled" aria-controls="offcanvasExampled">
                    							<span class="navbar-icon"><i class="fas fa-bars"></i></span>
                    
                    						</div>
                    						
                    						
                    						<!-- offcanvas section for desktop -->
                    						
                    						<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExampled" aria-labelledby="offcanvasExampleLabel">
                    							<div class="offcanvas-header">
                    								<button type="button" class="btn-close justify-content-end " data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    							</div>
                    							
                    							<div class="pl-10 nheaderm">
                                                        <a title="revolution24.tv" href="">
                                                        	<img class="img-fluid" src="<?php echo base_url().'assets/importent_images/'?>logo-sports.png" title="revolution24.tv" alt="revolution24.tv">
                                                        </a>
                                                        
                                                        
                                                        <div class="DateTimeBn"><p class="pDate"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg>  
                                                        <?php echo onlyDatecbangla(date('j F Y')) ?> , <?php               
                                                        $this->load->view('ClassBanglaDate');
                                                        $bn = new BanglaDate(time());
                                                        $b_dat = $bn->get_date();
                                                        echo $b_dat[0].' '.$b_dat[1].', '.$b_dat[2] ;
                                                        
                                                        
                                                        ?>
                                                        </p>
                                                        </div>
                                                    </div>
                    							<div class="m-auto pt-10">
                    							
                    								<div class="d-flex justify-content-start m-auto pb-4 social-media-icons">
                    									<a href="https://www.facebook.com/profile.php?id=61573467501624" aria-label="Facebook" target="_blank">
                    										<div class="social-icon1 facebook"><i class="fa-brands fa-facebook-f"></i></div>
                    									</a>
                    									<a href="https://www.youtube.com/@Revolution24tv" aria-label="Youtube" target="_blank">
                    										<div class="social-icon1 youtube"><i class="fa-brands fa-youtube"></i></div>
                    									</a>
                    									<a href="https://x.com/revolution24tv" aria-label="Twitter" target="_blank">
                    										<div class="social-icon1 twitter"><i class="fa-brands fa-twitter"></i></div>
                    									</a>
                    									<a href="https://www.instagram.com/revolution24tv" aria-label="Instagram" target="_blank">
                    										<div class="social-icon1 instagram"><i class="fa-brands fa-instagram"></i></div>
                    									</a>
                    									<a href="https://www.linkedin.com/company/revolation24tv" aria-label="Linkedin" target="_blank">
                    										<div class="social-icon1 linkedin"><i class="fa-brands fa-linkedin-in"></i></div>
                    									</a>
                    								</div>
                    							</div>
                    							<div class="offcanvas-body">
                    								<div id="navbarTogglerDemo01">
                    									<div class="row">
                    										<div class="col-12">
                    											<ul class="nav navbar-nav">
                    											    
                    											    <?php
                                                					if($online_menu !=""){
                                                						foreach($online_menu as $value){
                                                					?>
                            									<li class="nav-item navtab"><a class="nav-link dversion" href="./online/<?php echo $value['m_bangla'];?>"><?php echo $value['m_name'];?></a></li>
                            									<?php
                                                						}
                                                					}
                            									?>
                            									
                            										<li class="nav-item navtab"><a class="nav-link" href="#">ভিডিও</a></li>
									                                <li class="nav-item navtab"><a class="nav-link" href="#">যোগাযোগ</a></li>
                    											   
                    										
                    											</ul>
                    										</div>
                    									</div>
                    
                    								</div>
                    							</div>
                    						</div>
                    						
                    						<!-- End offcanvas -->
                    						
                    						
                    					</nav>
                    				</li>
								
								    <?php
                    					if($online_menu !=""){
                    						foreach($online_menu as $key=>$value){
                    						    
                    						    if($value['m_id'] !=3 AND $value['m_id'] !=215){
                    					?>
									<li class="nav-item"><a class="nav-link" href="./online/<?php echo $value['m_bangla'];?>"><?php echo $value['m_name'];?></a></li>
								
								
								
									<?php
                    						}else{
                    						
									        ?>
									        
            								<li class="nav-item dropdown">
                                                    <a class="dropdown-toggle nav-link" href="./online/<?php echo $value['m_bangla'];?>" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $value['m_name'];?></a>
                                                    <ul class="dropdown-menu dmbg">
                                                        <?php
                                                        $submenu = $this->Model_menu->createsubmenu($value['m_id']);
                                                        foreach($submenu as $key=>$value){
                                                            ?>
                                                            <li><a href="./online/<?php echo $value['m_bangla'];?>"> <?php echo $value['m_name'];?> </a></li>
                                                        <?php
                                                            
                                                        }
                                                        ?>
                                                        
                                                        
                                                    </ul>
                                                </li>
									       
									        
									        <?php
									
                    						
                    					}
                    						}
                    					}
									?>
									
									
									
									
									
									<li class="nav-item"><a class="nav-link" href="#">ভিডিও</a></li>
									<li class="nav-item"><a class="nav-link" href="#">যোগাযোগ</a></li>
									
									
                    			
									
                                    
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	
	</header>
	<header class="news-header2 nheaderm">
		<div class="DHeaderNav stickyNav" id="sticky-navbar">
		    <div class="DateTime d-flex justify-content-center d-print-none pb-0">
		        <div class="DateTimeBn">
    		        <p class="pDate">
        		        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
        		        </svg>
        		        
        		       <?php echo onlyDatecbangla(date('j F Y')) ?> , <?php               
                
                $bn = new BanglaDate(time());
                $b_dat = $bn->get_date();
                echo $b_dat[0].' '.$b_dat[1].', '.$b_dat[2] ;
                
                    
                ?>
    		        </p>
		        </div>
		        </div>
			<div class="row">
				<div class="col-1">
					<nav class="navbar navbar-default navbar-expand-lg ">
						<div class="d-flex justify-content-between  navbar-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
							<span class="navbar-icon"><i class="fas fa-bars"></i></span>

						</div>
						
						<!--Offcanvas Mobile-->
						
						<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
							<div class="offcanvas-header">
								<button type="button" class="btn-close justify-content-end " data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							
                            <div class="pl-10 nheaderm">
                                <a title="revolution24.tv" href="">
                                	<img class="img-fluid" src="<?php echo base_url().'assets/importent_images/'?>logo-sports.png" title="revolution24.tv" alt="revolution24.tv">
                                </a>
                                
                                
                                <div class="DateTimeBn"><p class="pDate"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg>  
                                <?php echo onlyDatecbangla(date('j F Y')) ?> , <?php               
                                
                                $bn = new BanglaDate(time());
                                $b_dat = $bn->get_date();
                                echo $b_dat[0].' '.$b_dat[1].', '.$b_dat[2] ;
                                
                                
                                ?>
                                </p>
                                </div>
                            </div>
                            
                            
                            	
							
							
							<div class="m-auto1">
								
							
								
								
								<div class="d-flex justify-content-start m-auto pb-4 social-media-icons">
									<a href="https://www.facebook.com/sports24bangladesh" aria-label="Facebook" target="_blank">
										<div class="social-icon1 facebook"><i class="fa-brands fa-facebook-f"></i></div>
									</a>
									<a href="https://www.youtube.com/@sports24bangladesh" aria-label="Youtube" target="_blank">
										<div class="social-icon1 youtube"><i class="fa-brands fa-youtube"></i></div>
									</a>
									<a href="#" aria-label="Twitter" target="_blank">
										<div class="social-icon1 twitter"><i class="fa-brands fa-twitter"></i></div>
									</a>
									<a href="#" aria-label="Instagram" target="_blank">
										<div class="social-icon1 instagram"><i class="fa-brands fa-instagram"></i></div>
									</a>
									<a href="#" aria-label="Linkedin" target="_blank">
										<div class="social-icon1 linkedin"><i class="fa-brands fa-linkedin-in"></i></div>
									</a>
								</div>
							</div>
							
							
							
							
							<div class="offcanvas-body">
								<div id="navbarTogglerDemo01">
									<div class="row">
										<div class="col-12">
											<ul class="nav navbar-nav">
											    
											    <?php
                            					if($online_menu !=""){
                            						foreach($online_menu as $value){
                            					?>
        									<li class="nav-item"><a class="nav-link" href="./online/<?php echo $value['m_bangla'];?>"><?php echo $value['m_name'];?></a></li>
        									<?php
                            						}
                            					}
        									?>
        									
        									<li class="nav-item"><a class="nav-link" href="./online/<?php echo $value['m_bangla'];?>">ভিডিও</a></li>
    									    <li class="nav-item"><a class="nav-link" href="./online/<?php echo $value['m_bangla'];?>">যোগাযোগ</a></li>   
											   
											
											</ul>
										</div>
									</div>

								</div>
							</div>
						</div>
					</nav>
				</div>
				<div class="col-10">
					<div class="mobile-logo">
						<a href="" title="revolution24.tv">
							<img class="img-fluid" src="<?php echo base_url().'assets/importent_images/'?>logo-sports.png" alt="revolution24.tv">
						</a>
					</div>
				</div>
				<div class=" col-1">
					<a class="searchIcon ">
						<div onclick="showSearchBox()"><i href="#" class="fas fa-search"></i>
						</div>
					</a>
					
                    
				</div>
			</div>
		</div>
	</header>
    <!-- Back to top button -->
    <a id="button"><i class="fas fa-angle-double-up"></i></a>
    
    <style>
        .mr0{
            margin-right:0;
        }
        .pl0{
            padding-left:0;
        }
        .mts{
            margin-top:73px;
        }
        .mtm{
            margin-top:13px;
        }
        .pr0{
            padding-right:0;
        }
        .pl-10{
            padding-left:10px;
        }
        .pt-10{
            padding-top:1px;
        }
        .hrclass{
            border-bottom: 1px solid rgba(0,0,0,0.2);
            margin: 0 10px;
        }
        .bgwhitetop{
            background: white;
        }
        .followus{
            font-size: 15px;
            padding-right: 10px;
        }
        .m-auto1{
           
            border-bottom:1px dotted #ccc;
            padding-top: 5px;
        }
        .navtab{
            width:100%;
            border-bottom:1px dotted;
        }
        
        .nheaderm {
	-webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.1);
	-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.1);
	-ms-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.1);
	-o-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.1);
}
    </style>
