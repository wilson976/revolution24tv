<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Profile Info</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open('admin/users_profile/edit', 'class="form-horizontal"'); ?>            
            <fieldset>
                <legend>Edit Your Personal Info Here</legend>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Name</label>
                    <div class="controls">
                        <input name="u_name" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $user['u_name']; ?>">
                    </div>
                </div>
                <div class="box-content">
                    <a href="admin/users_profile/password/<?php print $this->session->userdata('user_id'); ?>">Change Password Here</a><br/>
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