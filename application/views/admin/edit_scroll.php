<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Breaking/Latest News Edit</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open('admin/dashboard/scroll_edit', 'class="form-horizontal"'); ?>            
            <fieldset>                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Title</label>
                    <div class="controls">
                        <textarea name="s_head" rows="7" class="input-xlarge focused" id="focusedInput"><?php echo $scroll['s_head']; ?></textarea>
                    </div>                    
                </div>
                <div class="control-group">
                    <label class="control-label" for="s_type">Type</label>
                    <div class="controls">
                        <select name="s_type" id="h_category" data-rel="chosen">
                            <option value="breaking" <?php if ($scroll['s_type'] == 'breaking') echo ' Selected'; ?>>Breaking News</option>                         
                            <option value="latest" <?php if ($scroll['s_type'] == 'latest') echo ' Selected'; ?>>Latest News</option>  
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php
            echo form_hidden('s_id', $scroll['s_id']);
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->
</div><!--/row-->
