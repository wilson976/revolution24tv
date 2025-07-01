<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Photo Entry</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/photo_gallery/photo_edit/', 'class="form-horizontal"'); ?>   

            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="selectError">Category</label>                    
                    <div class="controls">
                        <select name="p_category1" id="selectError" data-rel="chosen">
                            <?php
                            if ($photo_list != NULL) {
                                foreach ($photo_list as $row):
                                    ?>
                                    <option value="<?php echo $row['g_id']; ?>" <?php if ($photo['p_category'] == $row['g_id']) echo 'selected'; ?>><?php echo $row['g_cat']; ?></option>
                                    <?php
                                endforeach;
                            }
                            ?>
                        </select>
                    </div>
                </div>    
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Title</label>
                    <div class="controls">
                        <input name="p_title" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $photo['p_title']; ?>" />
                    </div>
                </div> 
                <div class="control-group">
                    <label for="start_date" style="display: block;" class="control-label">Start publishing:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="<?php echo date("d M Y h:i:s", strtotime($photo['start_date'])); ?>" readonly="readonly" class="span2" name="start_date" id="start_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>



                <div class="control-group">
                    <label class="control-label" for="focusedInput">Caption</label>
                    <div class="controls">
                        <textarea name="p_caption" rows="7" class="input-xlarge focused" id="focusedInput"><?php echo $photo['p_caption']; ?></textarea>
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Feature Item</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="p_feature" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="p_feature" value="1" class="iphone-toggle" <?php if ($photo['p_feature'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Meta Keyword</label>
                    <div class="controls">
                        <input name="meta_keyword" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $photo['meta_keyword']; ?>" />
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Meta Description</label>
                    <div class="controls">
                        <textarea name="meta_description" rows="7" class="input-xlarge focused" id="focusedInput"><?php echo $photo['meta_description']; ?></textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>

            </fieldset>
            <?php
            echo form_hidden('p_category', $photo['p_category']);
            echo form_hidden('p_id', $photo['p_id']);
            //echo form_hidden('p_category', $photo['p_category']);
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->  
</div>