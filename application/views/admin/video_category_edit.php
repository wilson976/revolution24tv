
<div class="row-fluid sortable">
    <div class="box span12">
        
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Edit Video Category</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/video_gallery/edit_v_category', 'class="form-horizontal"'); ?>            
            <fieldset>

                <div class="control-group">
                    <input data-no-uniform="true" type="hidden" name="id" value="<?php echo $cat['id']; ?>" class="iphone-toggle" />
                    <label class="control-label" for="focusedInput">Category Name</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="text" name="cat_name" value="<?php echo $cat['cat_name']; ?>" class="iphone-toggle" />
                    </div>
                </div> 
                
                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Status</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="status" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="status" value="1" <?php if($cat['status']=='1'){ echo 'checked';} ?> class="iphone-toggle" />                       
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>

            </fieldset>
            <?php
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->  
</div>

