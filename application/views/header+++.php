    	<!-- top-search-box -->
	<div id="searchcontainer" class="hidden">
		<div id="search" class="search_block">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<form id="cse-search-box" action="./keywordsearch" method="get">
							<div class="search_logo display-flex">
								<input type="hidden" name="cx" value="ea09f3fc43677ad37">
								<input type="hidden" name="cof" value="FORID:10">
								<input type="hidden" name="ie" value="UTF-8">
								<input name="search" class="search-bar" placeholder="এখানে খুঁজুন..." title="Search" type="search">
								<button onclick="performSearch()"><i id="searchButton" class="fa fa-search"></i></button>
								<a onclick="hideSearchBox()" class="close-search" id="closeButton" href="#"><i class="fa fa-times"></i></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<header class="news-header">
		<!-- top-header -->
		<div class="container">
			<div class="row">
			    <div class="col-md-1 m-auto" style="font-size:16px">
			        <?php echo onlydatetodayBanla(date('l')) ?><br>
			        <div id="txt"></div>

                    
			    </div>
				<div class="col-md-3 m-auto">
					<p class="d-lg-flex ">
						<span>
							<?php echo onlyDatecbangla(date('j F Y')) ?> <?php               
                $this->load->view('ClassBanglaDate');
                $bn = new BanglaDate(time());
                $b_dat = $bn->get_date();
                echo '<br>'.$b_dat[0].' '.$b_dat[1].', '.$b_dat[2] .'<br>'
                
                    
                ?>
                
                <?php
                    
                    $dataa = "https://api.aladhan.com/v1/calendarByCity?city=dhaka&country=bangladesh&method=3&tune=6,1,2,2,2,4,4,2,0";
                    $timedata=file_get_contents($dataa);
                    
                    $timedata = json_decode($timedata);
                    
                    $day = date('d');
                    $time = $timedata->data[$day]->timings;
                    $ctime = date('H:i');
                    $iftarTime = str_replace('(+06)','',$time->Sunset);
                    if(strtotime($ctime) < strtotime($iftarTime)){
                        $hijri = $timedata->data[$day-1]->date->hijri;
                    }else{
                        $hijri = $timedata->data[$day]->date->hijri;
                    }
                ?>
                
                <?php echo en2bnNumber($hijri->day).' '.en2hijrimonth($hijri->month->en);   echo ', '.en2bnNumber($hijri->year);?>
						</span>
					</p>
				</div>
				<div class="col-md-4 col-sm-12  ">
					<div class="topImg">
					<a class=" d-lg-flex d-none  justify-content-center align-items-center" title="revolution24.tv" href="">
						<img class="img-fluid" src="<?php echo base_url().'assets/importent_images/'?>logo-revolution24.png" title="revolution24.tv" alt="revolution24.tv">
					</a>
					</div>
				</div>
				<div class="col-md-4 m-auto">
					<div class="d-lg-flex d-none justify-content-end social-media-icons">
						<a href="#" aria-label="Facebook" target="_blank">
							<div class="social-icon facebook"><i class="fa-brands fa-facebook-f"></i></div>
						</a>
						<a href="#" aria-label="Youtube" target="_blank">
							<div class="social-icon youtube"><i class="fa-brands fa-youtube"></i></div>
						</a>
						<a href="#" aria-label="Twitter" target="_blank">
							<div class="social-icon twitter"><i class="fa-brands fa-twitter"></i></div>
						</a>
						<a href="#" aria-label="Instagram" target="_blank">
							<div class="social-icon instagram"><i class="fa-brands fa-instagram"></i></div>
						</a>
						<a href="#" aria-label="Linkedin" target="_blank">
							<div class="social-icon linkedin"><i class="fa-brands fa-linkedin-in"></i></div>
						</a>
						<a href="#">
							<div class="social-icon" onclick="showSearchBox()" style="background: #F34A38"><i class="fas fa-search" style="cursor:pointer"></i>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<!-- main navbar -->
		<div class="DHeaderNav stickyNav " id="sticky-navbar">
			<div class="container">
				<div class="row ">
					<div class="col-md-12">
						<nav class="navbar navbar-default navbar-expand-lg navbar-inverse ">
							<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
								<ul class="nav navbar-nav">
									<li class="nav-item"><a class="menuImg d-lg-flex justify-content-center align-items-center" title="banglaedition.com" href="">
											<img class="img-fluid "  src="<?php echo base_url().'assets/importent_images/'?>menu-logo.png" title="banglaedition.com" alt="banglaedition.com">
										</a></li>
								
								    <?php
                    					if($online_menu !=""){
                    						foreach($online_menu as $key=>$value){
                    					?>
									<li class="nav-item"><a class="nav-link" href="./online/<?php echo $value['m_bangla'];?>"><?php echo $value['m_name'];?></a></li>
									<?php
									if($key==11) break;
                    						}
									        ?>
									        
            								<li class="nav-item dropdown">
                                                    <a class="dropdown-toggle nav-link" href="#" role="button" aria-haspopup="true" aria-expanded="false">আরো</a>
                                                    <ul class="dropdown-menu dmbg">
                                                        <?php
                                                        foreach($online_menu as $key=>$value){
                                                            if($key>11){
                                                            ?>
                                                        <li>
                                                            <a href="./online/<?php echo $value['m_bangla'];?>"> <?php echo $value['m_name'];?> </a>
                                                        </li>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        
                                                        
                                                    </ul>
                                                </li>
									       
									        
									        <?php
									
                    						
                    					}
									?>
									
									
                    				<li class="nav-item offcanfordesktop">
                    					<nav class="navbar navbar-default navbar-expand-lg ">
                    						<div class="d-flex justify-content-between  navbar-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExampled" aria-controls="offcanvasExampled">
                    							<span class="navbar-icon"><i class="fas fa-bars"></i></span>
                    
                    						</div>
                    						<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExampled" aria-labelledby="offcanvasExampleLabel">
                    							<div class="offcanvas-header">
                    								<button type="button" class="btn-close justify-content-end " data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    							</div>
                    							<div class="m-auto">
                    								<a class="d-flex justify-content-start m-auto pb-2" href="#"> <span class="d-flex align-items-center Dnews-date">
                    										<?php echo onlyDateconverterbangla(date('l j F Y')) ?>
                    									</span></a>
                    								<div class="d-flex justify-content-start m-auto pb-4 social-media-icons">
                    									<a href="#" aria-label="Facebook" target="_blank">
                    										<div class="social-icon facebook"><i class="fa-brands fa-facebook-f"></i></div>
                    									</a>
                    									<a href="#" aria-label="Youtube" target="_blank">
                    										<div class="social-icon youtube"><i class="fa-brands fa-youtube"></i></div>
                    									</a>
                    									<a href="#" aria-label="Twitter" target="_blank">
                    										<div class="social-icon twitter"><i class="fa-brands fa-twitter"></i></div>
                    									</a>
                    									<a href="#" aria-label="Instagram" target="_blank">
                    										<div class="social-icon instagram"><i class="fa-brands fa-instagram"></i></div>
                    									</a>
                    									<a href="#" aria-label="Linkedin" target="_blank">
                    										<div class="social-icon linkedin"><i class="fa-brands fa-linkedin-in"></i></div>
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
                    											   
                    											
                    											</ul>
                    										</div>
                    									</div>
                    
                    								</div>
                    							</div>
                    						</div>
                    					</nav>
                    				</li>
									
                                    
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	
	</header>
	<header class="news-header2 ">
		<div class="DHeaderNav  stickyNav" id="sticky-navbar">
			<div class="row">
				<div class="col-3">
					<nav class="navbar navbar-default navbar-expand-lg ">
						<div class="d-flex justify-content-between  navbar-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
							<span class="navbar-icon"><i class="fas fa-bars"></i></span>

						</div>
						<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
							<div class="offcanvas-header">
								<button type="button" class="btn-close justify-content-end " data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<div class="m-auto">
								<a class="d-flex justify-content-start m-auto pb-2" href="#"> <span class="d-flex align-items-center Dnews-date">
										<?php echo onlyDateconverterbangla(date('l j F Y')) ?>
									</span></a>
								<div class="d-flex justify-content-start m-auto pb-4 social-media-icons">
									<a href="#" aria-label="Facebook" target="_blank">
										<div class="social-icon facebook"><i class="fa-brands fa-facebook-f"></i></div>
									</a>
									<a href="#" aria-label="Youtube" target="_blank">
										<div class="social-icon youtube"><i class="fa-brands fa-youtube"></i></div>
									</a>
									<a href="#" aria-label="Twitter" target="_blank">
										<div class="social-icon twitter"><i class="fa-brands fa-twitter"></i></div>
									</a>
									<a href="#" aria-label="Instagram" target="_blank">
										<div class="social-icon instagram"><i class="fa-brands fa-instagram"></i></div>
									</a>
									<a href="#" aria-label="Linkedin" target="_blank">
										<div class="social-icon linkedin"><i class="fa-brands fa-linkedin-in"></i></div>
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
											   
											
											</ul>
										</div>
									</div>

								</div>
							</div>
						</div>
					</nav>
				</div>
				<div class="col-6">
					<div class="mobile-logo">
						<a href="" title="banglaedition.com">
							<img class="img-fluid" src="<?php echo base_url().'assets/importent_images/'?>/logo-main.png" alt="banglaedition.com">
						</a>
					</div>
				</div>
				<div class=" col-3">
					<a href="#" class="searchIcon ">
						<div onclick="showSearchBox()"><i href="#" class="fas fa-search"></i>
						</div>
					</a>
				</div>
			</div>
		</div>
	</header>
    <!-- Back to top button -->
    <a id="button"><i class="fas fa-angle-double-up"></i></a>
