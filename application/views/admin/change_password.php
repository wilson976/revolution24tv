<script src="<?php echo base_url(); ?>assets/custom_js/jquery-1.3.2.js" type="text/javascript"></script>

<script type="text/javascript">
    /* <![CDATA[ */
    jQuery(function(){
        jQuery("#new_pass").validate({
            expression: "if (VAL.length > 5 && VAL) return true; else return false;",
            message: "Password must contain atleast 6 Characters"
        });
        jQuery("#retype_pass").validate({
            expression: "if ((VAL == jQuery('#new_pass').val()) && VAL) return true; else return false;",
            message: "Retype password field doesn't match the password field"
        });
                
    });
    /* ]]> */
</script>


<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Profile Info</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open('admin/users_profile/update', 'class="form-horizontal"'); ?>            
            <fieldset>
                <legend>Change Password Here</legend>                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">New Password</label>
                    <div class="controls">
                        <input name="new_pass" type="password" class="input-xlarge focused" id="new_pass">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Retype Password</label>
                    <div class="controls">
                        <input name="retype_pass" type="password" class="input-xlarge focused" id="retype_pass">
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php
            echo form_hidden('id', $user['id']);
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->

</div><!--/row-->