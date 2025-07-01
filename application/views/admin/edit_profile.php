<!-- CK Editor -->
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Columnist Profile Edit</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/profile/p_edit', 'class="form-horizontal"'); ?>            
            <fieldset>    
                <div class="control-group">
                    <label class="control-label" for="fileInput">Picture</label>
                    <div class="controls">
                        <input name="picture" type="file" class="input-file uniform_on">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Name (Bangla)</label>
                    <div class="controls">
                        <input name="name_bangla" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $p_info['p_name']; ?>" />
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Name (English)</label>
                    <div class="controls">
                        <input name="name_english" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $p_info['p_name_eng']; ?>" />
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Email</label>
                    <div class="controls">
                        <input name="email" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $p_info['p_email']; ?>" />
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Profession</label>
                    <div class="controls">
                        <input name="p_profession" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $p_info['p_profession']; ?>" />
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Order</label>
                    <div class="controls">
                        <input name="order" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $p_info['p_order']; ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectError"> Type</label>
                    <div class="controls">
                        <select name="p_cat_id" id="p_cat_id" data-rel="chosen">
                            <option value="33" <?php
            if ($p_info['p_cat_id'] == "33")
                echo 'selected';
            ?>>Writer</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Details</label>
                    <div class="controls">
                        <textarea name="details" rows="7" class="input-xlarge focused" id="focusedInput"><?php echo $p_info['p_details']; ?></textarea>
                    </div>
                </div> 
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php
            echo form_hidden('p_id', $p_info['p_id']);
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->  
</div>



<script type="text/javascript">
    CKEDITOR.replace( 'details' );
</script>





