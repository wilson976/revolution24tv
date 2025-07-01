<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Admin Login Panel">
        <meta name="author" content="">
        <base href="<?php echo base_url(); ?>"/>
        <!-- The styles -->
        <link id="bs-css" href="<?php echo base_url(); ?>assets/css/bootstrap-cerulean.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/charisma-app.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
        <link href='<?php echo base_url(); ?>assets/css/fullcalendar.css' rel='stylesheet'>
        <link href='<?php echo base_url(); ?>assets/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
        <link href='<?php echo base_url(); ?>assets/css/chosen.css' rel='stylesheet'>
        <link href='<?php echo base_url(); ?>assets/css/uniform.default.css' rel='stylesheet'>
        <link href='<?php echo base_url(); ?>assets/css/colorbox.css' rel='stylesheet'>
        <link href='<?php echo base_url(); ?>assets/css/jquery.cleditor.css' rel='stylesheet'>
        <link href='<?php echo base_url(); ?>assets/css/jquery.noty.css' rel='stylesheet'>
        <link href='<?php echo base_url(); ?>assets/css/noty_theme_default.css' rel='stylesheet'>
        <link href='<?php echo base_url(); ?>assets/css/elfinder.min.css' rel='stylesheet'>
        <link href='<?php echo base_url(); ?>assets/css/elfinder.theme.css' rel='stylesheet'>
        <link href='<?php echo base_url(); ?>assets/css/jquery.iphone.toggle.css' rel='stylesheet'>
        <link href='<?php echo base_url(); ?>assets/css/opa-icons.css' rel='stylesheet'>
        <link href='<?php echo base_url(); ?>assets/css/uploadify.css' rel='stylesheet'>

        <link href='<?php echo base_url(); ?>assets/css/datetimepicker.css' rel='stylesheet'>
        <link href='<?php echo base_url(); ?>assets/css/bootstrap-fileupload.min.css' rel='stylesheet'>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/custom_css/jquery.validate.css" />

        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.2.min.js"></script>

        <script> 
            function deletechecked()
            {
                var answer = confirm("Are you sure want to delete this record ?")
                if (answer){
                    document.messages.submit();
                }
    
                return false;  
            }  
        </script>

        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="<?php echo base_url(); ?>assets/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- The fav icon -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/importent_images/menu-logon.png">

    </head>

    <body>
       	<div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="admin"></a>

                    <!-- theme selector starts -->
                    <div class="btn-group pull-right theme-container" style="display: none;">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-tint"></i><span class="hidden-phone"> Change Theme / Skin</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" id="themes">
                            <li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
                            <li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
                            <li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
                            <li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
                            <li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
                            <li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
                            <li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
                            <li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
                            <li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
                        </ul>
                    </div>
                    <!-- theme selector ends -->

                    <!-- user dropdown starts -->
                    <div class="btn-group pull-right" >
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user"></i><span class="hidden-phone"> <?php print $this->session->userdata('name'); ?></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="admin/users_profile/profile/<?php print $this->session->userdata('user_id'); ?>">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="kitkat/logout">Logout</a></li>
                        </ul>
                    </div>
                    <!-- user dropdown ends -->
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row-fluid">
                <!-- left menu starts -->
                <div class="span2 main-menu-span">
                    <div class="well nav-collapse sidebar-nav">
                        <ul class="nav nav-tabs nav-stacked main-menu">
                            <li class="nav-header hidden-tablet">Main</li>
                            <?php $this->load->view('admin/dynamic_menu_left_panel'); ?>                             
                        </ul>                        
                    </div><!--/.well -->
                </div><!--/span-->
                <!-- left menu ends -->     

                <div id="content" class="span10">
                    <!-- content starts -->
                    <div>
                        <ul class="breadcrumb">
                            <li>
                                <a href="admin/dashboard/">Home </a> <?php echo '-> ' . set_breadcrumb(); ?>
                            </li>
                            
                        </ul>
                    </div>
                    <!--/row-->

                    <!-- content ends -->
                <?php if ($this->session->flashdata('message')) { ?>                       
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> <?php echo $this->session->flashdata('message') ?></strong>
                        </div>
                        <?php
                    } else if ($this->session->flashdata('error')) {
                        ?>
                        <!--<div class="alert alert-error">-->
                        <!--    <button type="button" class="close" data-dismiss="alert">×</button>-->
                            <strong><?php //echo $this->session->flashdata('error') ?></strong>
                        <!--</div>-->
                        <?php
                    }
                    ?>
                    <!--/Starting Main Body Content -->
                    <div>                        
                        <?php
                        if (isset($body)) {
                            $this->load->view('admin/' . $body);
                        }
                        ?>
                    </div>
                </div><!--/#content.span10-->
            </div><!--/fluid-row-->

            <hr>
            <footer>
                          
            </footer>
        </div><!--/.fluid-container-->



        <!-- external javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        
        <!-- jQuery UI -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.8.21.custom.min.js"></script>
        <!-- transition / effect library -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-transition.js"></script>
        <!-- alert enhancer library -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-alert.js"></script>
        <!-- modal / dialog library -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-modal.js"></script>
        <!-- custom dropdown library -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-dropdown.js"></script>
        <!-- scrolspy library -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-scrollspy.js"></script>
        <!-- library for creating tabs -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-tab.js"></script>
        <!-- library for advanced tooltip -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-tooltip.js"></script>
        <!-- popover effect library -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-popover.js"></script>
        <!-- button enhancer library -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-button.js"></script>
        <!-- accordion library (optional, not used in demo) -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-collapse.js"></script>
        <!-- carousel slideshow library (optional, not used in demo) -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-carousel.js"></script>
        <!-- autocomplete library -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-typeahead.js"></script>
        <!-- tour library -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-tour.js"></script>
        <!-- library for cookie management -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>
        <!-- calander plugin -->
        <script src='<?php echo base_url(); ?>assets/js/fullcalendar.min.js'></script>
        <!-- data table plugin -->
        <script src='<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js'></script>

        <!-- chart libraries start -->
        <script src="<?php echo base_url(); ?>assets/js/excanvas.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.flot.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.flot.pie.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.flot.stack.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.flot.resize.min.js"></script>
        <!-- chart libraries end -->

        <!-- select or dropdown enhancer -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.chosen.min.js"></script>
        <!-- checkbox, radio, and file input styler -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.uniform.min.js"></script>
        <!-- plugin for gallery image view -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.colorbox.min.js"></script>
        <!-- rich text editor library -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.cleditor.min.js"></script>
        <!-- notification plugin -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.noty.js"></script>
        <!-- file manager library -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.elfinder.min.js"></script>
        <!-- star rating plugin -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.raty.min.js"></script>
        <!-- for iOS style toggle switch -->        
        <script src="<?php echo base_url(); ?>assets/js/jquery.iphone.toggle.js"></script>

        <!-- autogrowing textarea plugin -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.autogrow-textarea.js"></script>
        <!-- multiple file upload plugin -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.uploadify-3.1.min.js"></script>
        <!-- history.js for cross-browser state change on ajax -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.history.js"></script>   

        <!--Date Time Picker --> 
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js" type="text/javascript"></script>

        <!--File Upload --> 
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-fileupload.min.js" type="text/javascript"></script>

        <!--Field Validation -->        
        <script src="<?php echo base_url(); ?>assets/custom_js/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/custom_js/jquery.validation.functions.js" type="text/javascript"></script>       

        <!-- application script for Charisma demo -->
        <script src="<?php echo base_url(); ?>assets/js/charisma.js"></script>       
        <script  src="<?php echo base_url(); ?>assets/js/ajaxfileupload.js" type="text/javascript"></script>
        <script  src="<?php echo base_url(); ?>assets/js/site.js" type="text/javascript"></script>

       


        <!-- datetime picker configuration -->
        <script type="text/javascript">
            $('.form_datetime').datetimepicker({
                //language:  'fr',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0
            });
        </script>
    </body> 
</html>