
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> User Module</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/users/edit', 'class="form-horizontal"'); ?>            
            <fieldset>                 
                <div class="control-group">
                    <label class="control-label" for="focusedInput"> Name</label>
                    <div class="controls">
                        <input name="u_name" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $user['u_name']; ?>" />
                    </div>
                </div>          
                <div class="control-group">
                    <label class="control-label" for="focusedInput"> Email</label>
                    <div class="controls">
                        <input name="email" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $user['email']; ?>" />
                    </div>
                </div>            
                <div class="control-group">
                    <label class="control-label" for="focusedInput"> Designation</label>
                    <div class="controls">
                        <input name="designation" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $user['designation']; ?>" autofocus />
                    </div>
                </div>  
                <div class="control-group">
                    <label class="control-label" for="selectError"> User Type</label>
                    <div class="controls">
                        <select name="tag" id="tag" data-rel="chosen">
                            <option value="user" <?php if ($user['tag'] == 'user') echo 'selected'; ?>>User/Contributor</option>
                            <option value="local_moderators" <?php if ($user['tag'] == 'local_moderators') echo 'selected'; ?>>Local Moderator</option>
                            <option value="regional_moderators" <?php if ($user['tag'] == 'regional_moderators') echo 'selected'; ?>>Regional Moderator</option>
                            <option value="admin" <?php if ($user['tag'] == 'admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Status</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="status" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="status" value="1" class="iphone-toggle" <?php if ($user['status'] == "1") echo 'checked'; ?> />                       
                    </div>
                </div>
                <div class="box-content">
                    <a href="admin/users_profile/password/<?php echo $user['id'] ?>">Change Password Here</a><br/>
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
</div>