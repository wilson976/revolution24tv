<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Tags Form</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <?php echo form_open('admin/tags/edit_tag/', 'class="form-horizontal"'); ?>          
            <fieldset>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Category Tag</label>
                    <div class="controls">
                        <input class="input-large focused" id="focusedInput" type="text" name="tag" value="<?php echo $tag_data['tag'] ?>" >
                    </div>
                </div>
                <?php echo form_hidden('r_tag_id', $tag_data['r_tag_id']); ?>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Tag</button>
                    <button type="reset" class="btn">Clear</button>
                </div>

            </fieldset>
            </form>   

        </div>
    </div><!--/span-->
</div>