<div class="row-fluid sortable">

    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>New Pole Entry</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open('admin/dashboard/pool_entry', 'class="form-horizontal"'); ?>            
            <fieldset>                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Pole Entry</label>
                    <div class="controls">
                        <textarea name="PoolText" rows="7" class="input-xlarge focused" id="focusedInput"></textarea>
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
</div><!--/row-->
<!-- CK Editor -->
<script type="text/javascript" src="assets/ckeditor/ckeditor_basic.js"></script>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-folder-open"></i> Pole Archive</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No</th>
                        <th>Pole Details</th>   
                        <th>Control</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($pool != NULL) {
                        $i = 1;
                        foreach ($pool as $row):
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="center"><?php echo $row['PoolText']; ?></td>
                                <td class="center">
                                    <a href="admin/dashboard/pool_edit_page/<?php echo $row['PK_PoolID']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>                                    </a>       

                                    <a href="admin/dashboard/pool_delete/<?php echo $row['PK_PoolID']; ?>" onclick="return deletechecked();">
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


<script type="text/javascript">
    CKEDITOR.replace( 'PoolText' );
</script>




