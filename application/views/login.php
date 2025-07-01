<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <base href="<?php echo base_url(); ?>" />
    <title>Login Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Login Panel">
    <meta name="author" content="">

    <!-- The styles -->
    <link id="bs-css" href="assets/css/bootstrap-cerulean.css" rel="stylesheet">
    <style type="text/css">
        body {
            background-color: #424242; /* Updated background color for the outer area */
            padding-bottom: 40px;
            margin: 0;
            height: 100%;
        }

        .login-header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .login-header h2 {
            color: white; /* White text for the header */
        }

        .login-box {
            background-color: white; /* White background for the login box */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 450px; /* Made the form box a bit wider */
            margin: 100px auto;
        }

        .login-box .alert-info {
            background-color: #28a745;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 16px;
            border-radius: 5px;
        }

        .input-prepend {
            margin-bottom: 20px;
        }

        .input-prepend .add-on {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .input-large {
            height: 40px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #007bff;
            padding: 10px;
        }

        .btn-primary {
            background-color: #28a745;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #218838;
        }

        .alert-error {
            background-color: #dc3545;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .alert-error .close {
            color: white;
        }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="assets/css/charisma-app.css" rel="stylesheet">

    <!-- The fav icon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
</head>

<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12 center login-header">
                <h2>Revolution24TV Login Panel</h2>
            </div><!--/span-->
        </div><!--/row-->

        <div class="row-fluid">
            <div class="well span5 center login-box">
                <div class="alert alert-info">
                    Login with your Email and Password.
                </div>

                <?php echo form_open('hotpanel', 'class="form-horizontal"'); ?>
                <fieldset>
                    <div class="input-prepend" title="Email" data-rel="tooltip">
                        <span class="add-on"><i class="icon-user"></i></span>
                        <?php
                        echo form_input('email', set_value('email'), 'class="input-large span10" autofocus');
                        ?>
                    </div>
                    <div class="clearfix"></div>

                    <div class="input-prepend" title="Password" data-rel="tooltip">
                        <span class="add-on"><i class="icon-lock"></i></span>
                        <?php
                        echo form_password('password', '', 'class="input-large span10"');
                        ?>
                    </div>
                    <div class="clearfix"></div>
                    <p class="center span5">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </p>
                </fieldset>
                <?php echo form_close(); ?>

                <?php echo validation_errors(); ?>   
                <?php if ($this->session->flashdata('error')): ?>                       
                    <div class="alert alert-error">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Sorry</strong> <?php echo $this->session->flashdata('error') ?>
                    </div>                       
                <?php endif ?>
            </div><!--/span-->
        </div><!--/row-->
    </div><!--/.fluid-container-->  

    <!-- external javascript -->
    <script src="assets/js/jquery-1.7.2.min.js"></script>
    <script src="assets/js/jquery-ui-1.8.21.custom.min.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
    <script src="assets/js/bootstrap-tour.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <script src="assets/js/fullcalendar.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/excanvas.js"></script>
    <script src="assets/js/jquery.flot.min.js"></script>
    <script src="assets/js/jquery.flot.pie.min.js"></script>
    <script src="assets/js/jquery.flot.stack.js"></script>
    <script src="assets/js/jquery.flot.resize.min.js"></script>
    <script src="assets/js/jquery.chosen.min.js"></script>
    <script src="assets/js/jquery.uniform.min.js"></script>
    <script src="assets/js/jquery.colorbox.min.js"></script>
    <script src="assets/js/jquery.cleditor.min.js"></script>
    <script src="assets/js/jquery.noty.js"></script>
    <script src="assets/js/jquery.elfinder.min.js"></script>
    <script src="assets/js/jquery.raty.min.js"></script>
    <script src="assets/js/jquery.iphone.toggle.js"></script>
    <script src="assets/js/jquery.autogrow-textarea.js"></script>
    <script src="assets/js/jquery.uploadify-3.1.min.js"></script>
    <script src="assets/js/jquery.history.js"></script>
    <script src="assets/js/charisma.js"></script>
</body>
</html>
