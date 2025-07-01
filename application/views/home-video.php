        
<div class="row bg-part">
    <div class="bg-part1">
        <section>
            <div class="container">
                <div class="row featured_video ">

                <div class="row">
                        <div class="col-lg-12">
                            <div class="SecTitle2">
                                <a target="_blank" href="https://www.youtube.com/@Revolution24tv">
                                    <span class="RIghtBar"></span>
                                    <h2> ভিডিও </h2>
                                </a>
                            </div>
                        </div>
                    </div>
        
            
            <div class="col-lg-8 odr1">
                
               
                <iframe src="https://www.youtube.com/embed/<?php echo $vid1[0]['link'];?>" frameborder="0" allowfullscreen></iframe>
               
            </div>
            <div class="col-lg-4 odr2" id="style-4">
                
                
                
                
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active list" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                      <ul class="sidebar-scroll style-4 video-scroll">
                        <?php foreach ($vid1 as $key => $value) { 
                            if($value['v_location'] !=""){
                                $pic='./assets/images/video_gallery/'.str_replace('-', '/', $value['v_date']).'/'.$value['v_location'];
                            }else{
                                $pic='https://img.youtube.com/vi/'. $value['link'].'/0.jpg';
                            }
                        ?>
                        
                            <li>
                                
                                <a class="row clc" href="#" data-src="https://www.youtube.com/embed/<?php echo $value['link'];?>" title="">
                                    <div class="col-lg-4 col-sm-4 col-4 p_right"><img src="<?php echo $pic;?>"></div>
                                    <div class="col-lg-8 col-sm-8 col-8"><h5><?php echo $value['v_caption'];?></h5></div>
                                </a>
                               
                            </li> 
                        <?php } ?>              
                        </ul>
                  </div>
                  <!--<div class="tab-pane fade list" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                      <ul class="sidebar-scroll style-4 video-scroll">
                        <?php foreach ($programm_video as $key => $value) { 
                            if($value['v_location'] !=""){
                                $pic='./assets/images/video_gallery/'.str_replace('-', '/', $value['v_date']).'/'.imgExtChange($value['v_location']);
                            }else{
                                $pic='https://img.youtube.com/vi/'. $value['link'].'/0.jpg';
                            }
                        ?>
                        
                            <li>
                                <a class="row" href="#" data-src="https://www.youtube.com/embed/<?php echo $value['link'];?>" title="">
                                    <div class="col-lg-4 p_right"><img src="<?php echo $pic;?>"></div>
                                    <div class="col-lg-8"><h5><?php echo $value['v_caption'];?></h5></div>
                                </a>
                            </li> 
                        <?php } ?>              
                        </ul>
                  </div> -->
                </div>
                
<!--   <script>-->
<!--function myFunction() {-->
<!--  alert("I am an alert box!");-->
<!--  alert ('hello world');-->
<!--            var src = $(this).attr('data-src')+'?autoplay=1';-->
<!--            $('.featured_video iframe').attr('src', src);-->
<!--            return false;-->
<!--}-->
<!--</script> 

-->



            
  

                             
<style>



.featured_video iframe {
    width: 100%;
    height: 459px
}

.featured_video .list {
   
    padding-bottom: 15px;
    overflow: hidden;
    width: 100%
}

.featured_video .list h2 {
}

.featured_video .list h2 span {
    padding-left: 5px;
    padding-right: 5px;
    color: #fff
}

.featured_video .list ul {
    margin: 0;
    padding: 0;
    height: 440px!important
}

.featured_video .list ul li {
    list-style: none;
    margin-bottom: 10px;
    float: left;
    width: 100%
}

.featured_video .list ul li a {
    color: #fff
}

.featured_video .list ul li a h5 {
    color: #fff;
}



.featured_video .list ul li a img {
    width: 100%;
}

@media (max-width: 767px) {
     .featured_video iframe {
            width: 100%;
            height: 233px
             }
    }
         </style>       
                
                
                
                
        
            </div>
            <div class="clearfix"></div>
        </div> <!-- end home_box -->

    </div>
</section>
    </div>
</div>