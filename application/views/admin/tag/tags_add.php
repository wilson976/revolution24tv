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
            <?php echo form_open('admin/tags/add_tag/', 'class="form-horizontal"'); ?>          
            <fieldset>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Footer Tag</label>
                    <div class="controls">
                        <textarea name="tag" rows="2" class="input-xlarge focused" id="focusedInput"></textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Tag</button>
                    <button type="reset" class="btn">Clear</button>
                </div>

            </fieldset>
            </form>   

        </div>
    </div><!--/span-->
</div>
<div class="row-fluid sortable">	
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-plus"></i>Tags List</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Tags</th>
                        <th>Actions</th>          
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($tags != '') {
                        foreach ($tags as $key => $value) {
                            ?>
                            <tr>
                                <td class="center"><?php echo $value['tag']; ?></td>
                                <td class="center">
					<a href="admin/tags/edit_tag/<?php echo $value['r_tag_id']; ?>">Edit</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp      
					<a href="admin/tags/delete_tag/<?php echo $value['r_tag_id']; ?>" onclick="return deletechecked();">Delete</a>
				</td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>              
        </div>
    </div><!--/span-->	
</div><!--/span-->




