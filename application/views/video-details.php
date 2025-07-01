<div class="container">
	<div class="single-cat-info">
		<div class="single-cat-home">
			<div class=""><a href="./video/"><i class="fa fa-home" aria-hidden="true"></i> ভিডিও গ্যালারি </a></div>
		</div>
	</div>
	<div class="DVideoGallery">
	    <?php
	    if($vid !=""){
	    ?>
	    
		<div class="DVideoList">
			<div class="row">
				<div class="col-lg-12 text-center">
                    <div class="frame">
                        <iframe width="850" height="500" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $vid['link'];?>" frameborder="0"></iframe>
                        <h1 class="text-center"><?php echo $vid['v_caption'];?></h1>
                    </div>
                </div>
			</div>
		</div>
		<?php
	    }
		?>
		
		<p class="newsCatInfo mt-5"><i class="fa fa-bars" aria-hidden="true"></i> আরও ভিডিও </p>
		<div class="row">
		    
		    <?php
		    if($allvideo !=""){
		        foreach($allvideo as $key=>$value){
		    ?>
			
				<div class="col-md-3 d-flex">
						<div class="DVideoList align-self-stretch w-100">
							<a href="./video/<?php echo $value['v_id'];?>">
								<div class="DImgBlock">
									<div class="DImgZoomBlock">
										<picture>
											<img src="https://img.youtube.com/vi/<?php echo $value['link'];?>/0.jpg" alt="<?php echo $value['v_caption'];?>" title="<?php echo $value['v_caption'];?>" class="">
										</picture>
									</div>
								</div>
								<h3 class="caption"><?php echo $value['v_caption'];?></h3>
							</a>
						</div>
					</div>
			<?php
		        }
		    }
			?>

					</div>
		
	</div>
</div>