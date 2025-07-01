
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Possition Create</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/ad_possition/create/', 'class="form-horizontal"'); ?>            
            <fieldset>                    
                <div class="control-group">
                    <label class="control-label" for="focusedInput" required>Position Name</label>
                    <div class="controls">
                        <input name="position_name" type="text" class="input-xlarge focused" id="focusedInput" value="" autofocus />
                    </div>
                </div>          
                <div class="control-group">
                    <label class="control-label" for="focusedInput"> View Name (PHP File name) </label>
                    <div class="controls">
                        <input name="position_view" type="text" class="input-xlarge focused" id="focusedInput" value="" autofocus />
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
            <h2><i class="icon-user"></i>Position List</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-down"></i></a>                
            </div>
        </div>
        <div class="box-content" style="display: none;">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>                        
                        <th>Position Name</th> 
                        <th>File Name</th>
                        <th>Action</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($possition != NULL) {
                        $i = 1;
                        foreach ($possition as $row):
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>                                
                                <td class="center"><?php echo $row['position_name']; ?></td>
                                
                               <td class="center"><?php echo $row['position_view']; ?></td>
                                 <td class="center">
                                    <a href="admin/ad_possition/positionedit/<?php echo $row['id']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>             
                                    </a>       

                                    <a href="admin/ad_possition/positiondelete/<?php echo $row['id']; ?>" onclick="return deletechecked();">
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

    </div> <!--/span-->
</div><!--/row-->

