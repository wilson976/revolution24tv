
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Breaking News / Latest News Entry</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open('admin/dashboard/scroll_entry', 'class="form-horizontal"'); ?>            
            <fieldset>                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Title</label>
                    <div class="controls">
                        <textarea name="s_head" rows="7" class="input-xlarge focused" id="focusedInput"></textarea>
                    </div>
                </div>  
                <div class="control-group">
                    <label class="control-label" for="s_type">Type</label>
                    <div class="controls">
                        <select name="s_type" id="h_category" data-rel="chosen">
                            <option value="breaking">Breaking News</option>                         
                            <option value="latest">Latest News</option>  
                        </select>
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

<div class="row-fluid sortable">    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-folder-open"></i> News List</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No</th>
                        <th>Title</th>   
                        <th>Type</th>  
                        <th>Control</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($scroll != NULL) {
                        $i = 1;
                        foreach ($scroll as $row):
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="center"><?php echo $row['s_head']; ?></td>
                                <td class="center">
                                    <?php if ($row['s_type'] == 'breaking') echo 'Breaking News'; else echo 'Latest News'; ?>
                                </td>
                                <td class="center">
                                    <a href="admin/dashboard/scroll_edit_page/<?php echo $row['s_id']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>             </a>       

                                    <a href="admin/dashboard/scroll_delete/<?php echo $row['s_id']; ?>" onclick="return deletechecked();">
                                        <span class="label label-important"><i class="icon-trash icon-white"></i>Delete</span>                            
                                    </a> 
                                </td>                                       
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                    }
                    ?>                                                    
                </tbody>
            </table>              
        </div>
    </div><!--/span-->
</div><!--/row-->


