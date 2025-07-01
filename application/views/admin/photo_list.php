<div class="row-fluid sortable">	
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-plus"></i> <a href="./admin/photo_gallery/video_list">Add Video</a></h2>            
        </div>
    </div>
</div>



<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Photo Entry</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/photo_gallery/photo_entry', 'class="form-horizontal"'); ?>            
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Title</label>
                    <div class="controls">
                        <input name="p_title" type="text" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="fileInput">Picture</label>
                    <div class="controls">
                        <input name="picture" type="file" class="input-file uniform_on">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectError">Category</label>
                    <div class="controls">
                        <select name="p_category" id="selectError" data-rel="chosen">
                            <?php
                            if ($cat_list != NULL) {
                                foreach ($cat_list as $row):
                                    ?>
                                    <option value="<?php echo $row['g_id']; ?>"><?php echo $row['g_cat']; ?></option>
                                    <?php
                                endforeach;
                            }
                            ?>
                        </select>
                    </div>
                </div>                    
                <div class="control-group">
                    <label for="start_date" style="display: block;" class="control-label">Start publishing:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="" readonly="readonly" class="span2" name="start_date" id="start_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Caption</label>
                    <div class="controls">
                        <textarea name="p_caption" rows="7" class="input-xlarge focused" id="focusedInput"></textarea>
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Feature Item</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="p_feature" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="p_feature" value="1" class="iphone-toggle" />                       
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Meta Keyword</label>
                    <div class="controls">
                        <input name="meta_keyword" type="text" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Meta Description</label>
                    <div class="controls">
                        <textarea name="meta_description" rows="7" class="input-xlarge focused" id="focusedInput"></textarea>
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
            <h2><i class="icon-folder-open"></i> Browse Photo By Category</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Category Name</th>                        
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($cat_list_browse != NULL) {
                        $i = 1;
                        foreach ($cat_list_browse as $key => $a):
                            foreach ($a as $key => $row):
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><a href="admin/photo_gallery/photo_catwise/<?php echo $row['g_id']; ?>"><?php echo $row['g_cat']; ?></a></td>                                                
                                </tr>
                                <?php
                                $i++;
                            endforeach;
                        endforeach;
                    }
                    ?>                                     
                    </tr>                                                                   
                </tbody>
            </table>              
        </div>
    </div><!--/span-->
</div><!--/row-->


<?php if ($this->session->userdata('tag') != 'user') { ?>


    <div class="row-fluid sortable">

        <div class="box span6">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-edit"></i> Photo Category Entry</h2>
                <div class="box-icon">                
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
                </div>
            </div>

            <div class="box-content">
                <?php echo form_open('admin/photo_gallery/photo_cat_entry', 'class="form-horizontal"'); ?>            
                <fieldset>                
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Category</label>
                        <div class="controls">
                            <input name="g_cat" type="text" class="input-xlarge focused" id="focusedInput" value="">
                        </div>
                    </div> 

                    <div class="control-group">
                        <label class="control-label" for="selectError">Parent</label>
                        <div class="controls">
                            <select name="g_parent" id="g_parent" data-rel="chosen">
                                <option value="0">None</option>
                                <?php
                                if ($cat_list != NULL) {
                                    foreach ($cat_list as $row):
                                        ?>
                                        <option value="<?php echo $row['g_id']; ?>"><?php echo $row['g_cat']; ?></option>
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
                <h2><i class="icon-th-list"></i> Photo Category List</h2>
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
                        if ($cat_list != NULL) {
                            $i = 1;
                            foreach ($cat_list as $row):
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td class="center"><?php echo $row['g_cat']; ?></td>
                                    <td class="center">
                                        <a href="admin/photo_gallery/cat_edit_page/<?php echo $row['g_id']; ?>">
                                            <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>                            
                                        </a>       
                                        <a href="admin/photo_gallery/photo_cat_delete/<?php echo $row['g_id']; ?>" onclick="return deletechecked();">
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