<!-- CK Editor -->
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Program Schedule Entry</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/program_schedule/p_entry', 'class="form-horizontal"'); ?>            
            <fieldset>    
                <div class="control-group">
                    <label class="control-label" for="fileInput">Picture</label>
                    <div class="controls">
                        <input name="picture" type="file" class="input-file uniform_on">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Program Name</label>
                    <div class="controls">
                        <input name="name" type="text" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div>

                 
                

                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Description</label>
                    <div class="controls">
                        <textarea name="details" rows="7" class="input-xlarge focused" id="focusedInput"></textarea>
                    </div>
                </div> 

                <div class="control-group">
                    <label for="p_date" style="display: block;" class="control-label">Date:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="" readonly="readonly" class="span2" name="p_date" id="start_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Show Home</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="home_status" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="home_status" value="1" class="iphone-toggle" />                       
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
            <h2><i class="icon-folder-open"></i>Program Schedule List</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Program Picture</th>
                        <th>Program Name</th>  
                        <th>Date</th>
                        <th>Control</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($program_info != NULL) {
                        $i = 1;
                        foreach ($program_info as $row):
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="center"><img src="<?php echo './assets/images/program_image/'.str_replace('-','/',$row['pro_date']).'/mob/' . $row['pro_pic']; ?>" width="40" /></td>
                                <td class="center"><?php echo $row['pro_name']; ?></td>
                                <td class="center"><?php echo $row['pro_date']; ?></td>
                                <td class="center">
                                    <a href="admin/program_schedule/p_edit_page/<?php echo $row['id']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>             
                                    </a>       

                                    <a href="admin/program_schedule/p_delete/<?php echo $row['id']; ?>" onclick="return deletechecked();">
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






