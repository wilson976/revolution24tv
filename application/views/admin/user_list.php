
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> User Module</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/users/create/', 'class="form-horizontal"'); ?>            
            <fieldset>                    
                <div class="control-group">
                    <label class="control-label" for="focusedInput"> Name</label>
                    <div class="controls">
                        <input name="u_name" type="text" class="input-xlarge focused" id="focusedInput" value="" autofocus />
                    </div>
                </div>          
                <div class="control-group">
                    <label class="control-label" for="focusedInput"> Email</label>
                    <div class="controls">
                        <input name="email" type="text" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput"> Password</label>
                    <div class="controls">
                        <input name="password" type="password" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput"> Designation</label>
                    <div class="controls">
                        <input name="designation" type="text" class="input-xlarge focused" id="focusedInput" value="" autofocus />
                    </div>
                </div>  
                <div class="control-group">
                    <label class="control-label" for="selectError"> User Type</label>
                    <div class="controls">
                        <select name="tag" id="tag" data-rel="chosen">
							<option value="admin">Admin</option>
                        </select>
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


<div class="row-fluid sortable">       
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Admin</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-down"></i></a>                
            </div>
        </div>
        <div class="box-content" style="display: none;">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>                        
                        <th>Name</th> 
                        
                        <th>Status</th>
                        <th>Control</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($reg_mod != NULL) {
                        $i = 1;
                        foreach ($reg_mod as $row):
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>                                
                                <td class="center"><?php echo $row['u_name']; ?></td>
                                
                                <td>
                                    <?php
                                    if ($row['status'] == 1) {
                                        ?>
                                        <span class="label label-success">Active</span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="label">Inactive</span>   
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td class="center">
                                    <a href="admin/users/edit/<?php echo $row['id']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>             
                                    </a>       

                                    <a href="admin/users/delete/<?php echo $row['id']; ?>" onclick="return deletechecked();">
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

