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
            <?php echo form_open_multipart('admin/tag_topics/tag_edit', 'class="form-horizontal"'); ?>            
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Tag Name</label>
                    <div class="controls">
                        <input name="tag_name" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $tag_info['tag_name']; ?>" />
                    </div>
                </div> 
                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Tag Details</label>
                    <div class="controls">
                        <textarea name="tag_details" rows="7" class="input-xlarge focused" id="focusedInput"><?php echo $tag_info['tag_details']; ?></textarea>
                    </div>
                </div> 

                <div class="control-group">
                    <label class="control-label" for="fileInput">Tag Topics Image</label>
                    <div class="controls">
                        <input name="tag_image" type="file" class="input-file uniform_on">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php
            echo form_hidden('tag_id', $tag_info['tag_id']);
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->  
</div>



<script type="text/javascript">
    CKEDITOR.replace( 'tag_details' );
</script>





