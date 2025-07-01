<!-- CK Editor -->
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Program Schedule Edit</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/program_schedule/p_update', 'class="form-horizontal"'); ?>            
            <fieldset>    
                <div class="control-group">
                    <label class="control-label" for="fileInput">Picture</label>
                    <div class="controls">
                        <input name="picture" type="file" class="input-file uniform_on">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Name</label>
                    <div class="controls">
                        <input name="name" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $p_info['pro_name']; ?>" />
                    </div>
                </div> 
               
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Description</label>
                    <div class="controls">
                        <textarea name="details" rows="7" class="input-xlarge focused" id="focusedInput"><?php echo $p_info['pro_details']; ?></textarea>
                    </div>
                </div> 

                <div class="control-group">
                    <label for="p_date" style="display: block;" class="control-label">Start publishing:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="<?php echo date("d M Y h:i:s", strtotime($p_info['pro_date'])); ?>" readonly="readonly" class="span2" name="p_date" id="start_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Show Home</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="home_status" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="home_status" value="1" class="iphone-toggle" <?php if ($p_info['home_status'] == "1") echo 'checked'; ?> />                       
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php
            echo form_hidden('p_id', $p_info['id']);
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->  
</div>






