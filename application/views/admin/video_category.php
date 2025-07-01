
<div class="row-fluid sortable">
    <div class="box span12">
        
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Video Category Entry</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/video_gallery/video_category', 'class="form-horizontal"'); ?>            
            <fieldset>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Category Name</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="text" name="cat_name" value="" class="iphone-toggle" />
                    </div>
                </div> 
                
                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Status</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="status" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="status" value="1" class="iphone-toggle" />                       
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




<?php if ($this->session->userdata('tag') != 'user') { ?>


    <div class="row-fluid sortable">


        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-th-list"></i> Video Category</h2>
                <div class="box-icon">                
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Name</th>   
                            <th>Status</th>   
                            <th>Control</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        if ($parent_cat_list != NULL) {
                            $i = 1;
                            foreach ($parent_cat_list as $row):
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td class="center"><?php echo $row['cat_name']; ?></td>
                                    <td class="center"><?php if($row['status']== '1'){echo 'Active';}else{echo 'Inactive';} ?></td>
                                    <td class="center">
                                        <a href="admin/video_gallery/edit_v_category/<?php echo $row['id']; ?>">
                                            <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>                            
                                        </a>       
                                        <!--<a href="admin/video_gallery/video_delete/<?php echo $row['id']; ?>" onclick="return deletechecked();">-->
                                        <!--    <span class="label label-important"><i class="icon-trash icon-white"></i>Delete</span>                            -->
                                        <!--</a> -->
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

    <?php
}
?>



<?php if ($this->session->userdata('tag') != 'user') { ?>


    <div class="row-fluid sortable">

        <div class="box span6">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-edit"></i> Video Sub Category Entry</h2>
                <div class="box-icon">                
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
                </div>
            </div>

            <div class="box-content">
                <?php echo form_open('admin/video_gallery/video_SubCat_entry', 'class="form-horizontal"'); ?>            
                <fieldset>                
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Category</label>
                        <div class="controls">
                            <input name="cat_name" type="text" class="input-xlarge focused" id="focusedInput" value="">
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
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['cat_name']; ?></option>
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
                echo form_close();
                ?>              
            </div>
        </div><!--/span-->  

        <div class="box span6">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-th-list"></i> Video Sub Category List</h2>
                <div class="box-icon">                
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Category Name</th>   
                            <th>Control</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        if ($subcat_list != NULL) {
                            $i = 1;
                            foreach ($subcat_list as $row):
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td class="center"><?php echo $row['cat_name']; ?></td>
                                    <td class="center">
                                        <a href="admin/video_gallery/video_cat_edit/<?php echo $row['id']; ?>">
                                            <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>                            
                                        </a>       
                                        <a href="admin/video_gallery/video_cat_delete/<?php echo $row['id']; ?>" onclick="return deletechecked();">
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

    <?php
}
?>