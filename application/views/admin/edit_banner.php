<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Banner Edit</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/banner/banner_edit', 'class="form-horizontal"'); ?>            
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Type</label>
                    <div class="controls">
                        <select name="b_type" id="b_type" data-rel="chosen">
                            <option value="None">None</option>
                            <option value="image" <?php
            if ($b_info['b_type'] == "image")
                echo 'selected';
            ?>>Image</option>
                            
                            <option value="code" <?php
                                    if ($b_info['b_type'] == "code")
                                        echo 'selected';
            ?>>Code</option>
                        </select>
                    </div>
                </div> 
                <div class="control-group ">
                    <label for="end" class="control-label">Banner</label>
                    <div class="controls">
                        <ul class="nav nav-tabs" id="myTab">
                            <li <?php if ($b_info['b_code'] == '') echo ' class="active"'; ?>><a data-toggle="tab" href="#image_flash">Image or Flash</a></li>
                            <li <?php if ($b_info['b_code'] != '') echo ' class="active"'; ?>><a data-toggle="tab" href="#custom_code">Custom code</a></li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div id="image_flash" class="tab-pane fade  in active ">
                                <input name="picture" type="file" class="input-file uniform_on">
                            </div>
                            <div id="custom_code" class="tab-pane fade ">
                                <textarea rows="5" class="span9" name="b_code" id="b_code"><?php echo $b_info['b_code']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Name</label>
                    <div class="controls">
                        <input name="b_name" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $b_info['b_name']; ?>" />
                    </div>
                </div>       
                <div class="control-group">
                    <label class="control-label" for="focusedInput">URL or Link</label>
                    <div class="controls">
                        <input name="b_url" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $b_info['b_url']; ?>" />
                    </div>
                </div>    
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Position</label>
                    <div class="controls">
                        <select name="b_position" id="b_position" data-rel="chosen">
                            <option value="None">None</option>
                            <?php foreach ($position as $key => $value) { ?>
                                   <option value="<?php echo $value['position_view']; ?>" <?php if($b_info['b_position'] == $value['position_view']){echo ' selected';} ?>><?php echo $value['position_name']; ?></option>
                            <?php  } ?>
                            
                            
                        </select>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="focusedInput">Order</label>
                    <div class="controls">
                        <input name="b_tab" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $b_info['b_tab']; ?>" />
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="b_agency">Agency </label>
                    <div class="controls">
                        <select name="b_agency" id="b_agency" data-rel="chosen">
                            <option value="0">None</option>
                        <?php  foreach ($a_name as $key => $value) { ?>
                            <option value="<?php echo $value['id']; ?>" <?php
                                    if ($b_info['b_agency'] == $value['id'])
                                        echo 'selected';
                            ?>><?php echo $value['agency_name']; ?></option> 
                        <?php } ?>                           
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Status</label>
                    <div class="controls">
                        <select name="b_status" id="b_status" data-rel="chosen">
                            <option value="Active" <?php
                                    if ($b_info['b_status'] == "Active")
                                        echo 'selected';
            ?>>Active</option>
                            <option value="Inactive" <?php
                                    if ($b_info['b_status'] == "Inactive")
                                        echo 'selected';
            ?>>Inactive</option>                            
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="start_date" style="display: block;" class="control-label">Start publishing:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="<?php echo date("d M Y h:i:s", strtotime($b_info['start_date'])); ?>" readonly="readonly" class="span2" name="start_date" id="start_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="end_date" style="display: block;" class="control-label">End publishing:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="<?php
                                    if ($b_info['end_date'] != '1970-01-01 06:00:00') {
                                        echo date("d M Y h:i:s", strtotime($b_info['end_date']));
                                    }
            ?>" readonly="readonly" class="span2" name="end_date" id="end_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>  
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php
            echo form_hidden('b_id', $b_info['b_id']);
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->  
</div>


