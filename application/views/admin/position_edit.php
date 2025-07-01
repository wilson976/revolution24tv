<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Position Edit</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/ad_possition/positionedit/', 'class="form-horizontal"'); ?>            
            <fieldset>                 
                <div class="control-group">
                    <label class="control-label" for="focusedInput"> Position Name</label>
                    <div class="controls">
                        <input name="position_name" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $position['position_name']; ?>" />
                    </div>
                </div>          
                <div class="control-group">
                    <label class="control-label" for="focusedInput"> View Name (PHP File name)</label>
                    <div class="controls">
                        <input name="position_view" type="text" class="input-xlarge focused" id="focusedInput" value="<?php echo $position['position_view']; ?>" />
                    </div>
                </div>            
              
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php
            echo form_hidden('id', $position['id']);
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->  
</div>