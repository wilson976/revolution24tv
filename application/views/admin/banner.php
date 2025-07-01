<div class="row-fluid sortable">        
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-th-list"></i> <a href="admin/ad_possition">Create New Position</a></h2>
        </div>        
    </div>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Banner Entry</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/banner/banner_entry', 'class="form-horizontal"'); ?>            
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Type</label>
                    <div class="controls">
                        <select name="b_type" id="b_type" data-rel="chosen">
                            <option value="image">Image</option>
                            <option value="flash">Flash</option>
                            <option value="code">Code</option>


                        </select>
                    </div>
                </div> 

                <div class="control-group ">
                    <label for="end" class="control-label">Banner</label>
                    <div class="controls">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a data-toggle="tab" href="#image_flash">Image or Flash</a></li>
                            <li><a data-toggle="tab" href="#custom_code">Custom code</a></li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div id="image_flash" class="tab-pane fade  in active ">
                                <input name="picture" type="file" class="input-file uniform_on">
                            </div>
                            <div id="custom_code" class="tab-pane fade ">
                                <textarea rows="5" class="span9" name="b_code" id="b_code"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

       
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Name</label>
                    <div class="controls">
                        <input name="b_name" type="text" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">URL or Link</label>
                    <div class="controls">
                        <input name="b_url" type="text" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Position</label>
                    <div class="controls">
                        <select name="b_position" id="b_position" data-rel="chosen">
                            <option value="None">None</option>
                            <?php foreach ($position as $key => $value) { ?>
                                    <option value="<?php echo $value['position_view']; ?>"><?php echo $value['position_name']; ?></option>
                            <?php  } ?>

                        </select>
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Order</label>
                    <div class="controls">
                        <input name="b_tab" type="text" class="input-xlarge focused" id="focusedInput" value="" />
                    </div>
                </div> 
                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Status</label>
                    <div class="controls">
                        <select name="b_status" id="b_status" data-rel="chosen">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>                            
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
                    <label for="end_date" style="display: block;" class="control-label">End publishing:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="" readonly="readonly" class="span2" name="end_date" id="end_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div> 
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save</button>
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
            <h2><i class="icon-folder-open"></i> Banner List</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Picture</th>
                        <th>Banner Name</th>                        
                        <th>Position</th> 
                        <th>Order</th>
                        
                        <th>Status</th>
                        <th class="center">Control</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($b_info != NULL) {
                        $i = 1;
                        foreach ($b_info as $row):
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="center">
                                    <?php if ($row['b_location'] != '') { ?>
                                        <img src="./assets/images/banner//thmubs/<?php echo $row['b_location']; ?>" />
                                        <?php
                                    } else {
                                        echo 'Code Included';
                                    }
                                    ?>
                                </td>
                                <?php $burl = base_url().'admin/banner/popup/'.$row['b_id']; ?>
                                <td class="center"><a href="#" onclick="window.open('<?php echo $burl;?>', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');"><?php echo $row['b_name']; ?> </a></td>                             
                                <td class="center">
                                    <?php echo $row['b_position']; ?>
                                </td>
                                <td class="center"><?php echo $row['b_tab']; ?></td>
                                
                                <td class="center">                                    
                                    <?php
                                    if ($row['b_status'] == 'Active') {
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
                                    <a href="admin/banner/banner_edit_page/<?php echo $row['b_id']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>             
                                    </a>       
                               
                                    <a href="admin/banner/banner_delete/<?php echo $row['b_id']; ?>" onclick="return deletechecked();">
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

