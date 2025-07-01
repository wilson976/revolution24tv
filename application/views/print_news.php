<html xmlns="http://www.w3.org/1999/xhtml"><head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
            <title><?php echo strip_tags($getnewsby_id['n_head']); ?>  | Revolution24TV</title>
            <base  href="<?php echo base_url(); ?>" />
            
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
             <script src="http://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
                <script>
                                                        $(document).ready(function () {
//                                                            alert('ok');
                                                            var doc = new jsPDF();
                                                            var specialElementHandlers = {
                                                                '#editor': function (element, renderer) {
                                                                    return true;
                                                                }
                                                            };
                                                            $('#cmd').click(function () {
                                                                doc.fromHTML($('#content').html(), 15, 15, {
                                                                    'width': 170,
                                                                    'elementHandlers': specialElementHandlers
                                                                });
                                                                doc.save('sample-file.pdf');
                                                            });
                                                        });
                </script>
            <script src="<?php echo base_url(); ?>assets/site/js/jquery-1.8.2.min.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("#print_button").click(function () {
                        $(this).hide();
                    });
                });
            </script>
            <link media="all" type="text/css" href="<?php echo base_url(); ?>assets/site/css/dtl_page_content.css" rel="stylesheet">
                <style type="text/css">
                    div#dtl_page_content div#blockquote_news{	
                        background:#eee url(<?php echo base_url(); ?>assets/importent_images/noise_f6.png) repeat;
                    }

                    a{
                        text-decoration:none
                    }
                    .single_news div#hl2{font-size:30px; color:#16387C}
                    .single_news div#newsDtl{font-size:18px; text-align:justify; color:#000; padding-top:10px}
                    .single_news div#img{float:right; margin:5px 0px 5px 15px;}
                    .clr{clear:both; font-size:1px; height:1px}
                    .d-text img {max-width:100% !important; height:auto !important; }
                     #rpt a{
                         font-size:18px;
                     }
                    #rpt a img{
                        width: 45px;
                        border-radius: 50%;
                        margin-right: 10px;
                    }
                </style>
                <?php  //$this->load->view('analyticstracking'); ?>
                </head>
                <body style="margin:0 auto">
                    <div align="center">
                        <div style="width:700px; margin-top:10px; border:1px solid #ccc; padding:10px 15px 10px 15px; font-family:SolaimanLipi; -moz-box-shadow:0 0 25px #ccc " id="content">
                            <div align="left" style="background:black; padding:10px">
                                <img class="img-fluid" src="<?php echo base_url().'assets/importent_images/'?>logo-footer.png" title="revolution24.tv" alt="revolution24.tv">
                            </div>
                            <div align="left" style="margin:5px 0 5px 0; text-align:justify; border-top:1px solid #ccc; margin-top:10px; padding-top:10px">
                                <div style="overflow:hidden; margin:0px 15px 0px 0px; padding-bottom:10px; border-bottom:1px solid #ccc" id="dtl_page_content" class="single_news"> 
                                    <div id="dtl_page_content">
                                        <div id="news_date_time">
                                            <span id="news_publish_time">আপডেট : <?php echo en2bndateConverter($getnewsby_id['start_date']); ?></span>
                                        </div>
                                        <div id="hl2">
                                            <font style="color:#000000"><?php echo $getnewsby_id['n_head']; ?></font>
                                        </div>
                                        <?php
                                        if ($getnewsby_id['n_subhead'] != '') {
                                            ?>
                                            <div id="hl3"><?php echo $getnewsby_id['n_subhead']; ?></div>
                                            <?php
                                        }
                                        ?>
                                        <div id="rpt">
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
                                            
                                            
                                            
                                            
                                        </div>
                                        <div class="dtlImgGallery" id="newsDtl">
                                            <p>
                                                <img border="0" width="100%" alt="<?php echo strip_tags($getnewsby_id['n_head']); ?>" title="" src="<?php echo './assets/news_images/' . str_replace('-', '/', $getnewsby_id['n_date']) . '/' . $getnewsby_id['main_image']; ?>">
                                                    <?php
                                                    if ($getnewsby_id['n_caption'] != '') {
                                                        ?>
                                                        <div style="font-style: italic; margin-bottom:30px;" class="text-center">
                                                            <?php echo $getnewsby_id['n_caption']; ?>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                            </p>
                                        <?php
                                        if ($getnewsby_id['n_solder'] != '') {
                                            ?>
                                            <!--<div id="hl1">     -->
                                            <!--    <font style="color:#000000; font-weight:bold;"><?php echo $getnewsby_id['n_solder']; ?></font>-->
                                            <!--</div>-->
                                            <?php
                                        }
                                        ?>
                                            <div class="d-text"><?php echo str_replace("\\", '', $getnewsby_id['n_details']); ?></div>
                                        </div>
                                        <div class="clr"></div>

                                    </div>        
                                </div>
                            </div>
                            <div style="float:left; padding:0 0 5px 10px">
                                <form action="#">
                                    <input type="button" value="Print" onclick="javascript:window.print()" id="print_button">
<!--                                        <div id="printer_btn" style="margin-top: 10px;">
                                            <div id="editor"></div>
                                            <button id="cmd">generate PDF</button>    
                                        </div>-->
                                </form>
                            </div>
                            <div style="clear:both"></div>
                            <div>    	<!--print footer start-->        
                                <!--end-->
                                

                                <div class="col-12 footer-area-top">
                                    <div class="row">
                                        
                                        <div class="col-12 mb-20 sompadok-mondoli"><b></div>
                                        <div class="col-3"></div>
                                        
                                    </div>
                                </div>

                                <div class="container footer-area-bottom">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            
                                           
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </body>
                      
                </html>