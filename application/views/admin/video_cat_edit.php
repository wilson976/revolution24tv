<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Video Category Edit</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open('admin/video_gallery/cat_edit', 'class="form-horizontal"'); ?>            
            <fieldset>                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Category</label>
                    <div class="controls">
                        <input name="cat_name" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $cat['cat_name']; ?>">
                    </div>                    
                </div>

                <div class="control-group">
                    <label class="control-label" for="selectError">Parent</label>
                    <div class="controls">
                        <select name="v_parent" id="v_parent" data-rel="chosen">
                            <option value="0">None</option>
                            <?php
                            if ($parent_cat_list != NULL) {
                                foreach ($parent_cat_list as $row):
                                    ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $cat['v_parent']) echo 'Selected'; ?>><?php echo $row['cat_name']; ?></option>
                                    <?php
                                endforeach;
                            }
                            ?>
                        </select>
                    </div>
                </div>   
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php
            echo form_hidden('id', $cat['id']);
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->

</div><!--/row-->