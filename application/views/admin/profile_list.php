<!-- CK Editor -->
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Columnist / Writer Profile Entry</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/profile/p_entry', 'class="form-horizontal"'); ?>            
            <fieldset>    
                <div class="control-group">
                    <label class="control-label" for="fileInput">Picture</label>
                    <div class="controls">
                        <input name="picture" type="file" class="input-file uniform_on">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Name (Bangla)</label>
                    <div class="controls">
                        <input name="name_bangla" type="text" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Name (English)</label>
                    <div class="controls">
                        <input name="name_english" type="text" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div>  
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Email</label>
                    <div class="controls">
                        <input name="email" type="text" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Profession</label>
                    <div class="controls">
                        <input name="p_profession" type="text" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div> 

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Order</label>
                    <div class="controls">
                        <input name="order" type="text" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectError">Type</label>
                    <div class="controls">
                        <select name="p_cat_id" id="p_cat_id" data-rel="chosen">
                            <option value="33">Writer</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Details</label>
                    <div class="controls">
                        <textarea name="details" rows="7" class="input-xlarge focused" id="focusedInput"></textarea>
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
            <h2><i class="icon-folder-open"></i> Writer List</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Writer Picture</th>
                        <th>Name (Bangla)</th> 
                        <th>Name (English)</th> 
                        <th>Order</th>
                        <th>Control</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($writer_info != NULL) {
                        $i = 1;
                        foreach ($writer_info as $row):
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="center"><img src="./assets/images/profile_image/thmubs/<?php echo $row['p_pic']; ?>" width="40" /></td>
                                <td class="center"><?php echo $row['p_name']; ?></td>
                                <td class="center"><?php echo $row['p_name_eng']; ?></td>
                                <td class="center"><?php echo $row['p_order']; ?></td>
                                <td class="center">
                                    <a href="admin/profile/p_edit_page/<?php echo $row['p_id']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>             
                                    </a>       

                                    <a href="admin/profile/p_delete/<?php echo $row['p_id']; ?>" onclick="return deletechecked();">
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
    CKEDITOR.replace( 'details' );
</script>





