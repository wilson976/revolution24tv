
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Splite News Table</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/splite_db/create/', 'class="form-horizontal"'); ?>            
            <fieldset>                    
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Table Name</label>
                    <div class="controls">
                        <input name="t_name" type="text" class="input-xlarge focused" id="focusedInput" value="" autofocus />
                    </div>
                </div>          
                <div class="control-group">
                    <label class="control-label" for="focusedInput"> Start Date</label>
                    <div style="display: inherit;" data-date-format="yyyy-mm-dd" class="controls input-append date form_datetime">
                        <input type="text" value="" readonly="readonly" class="span2" name="s_date" id="start_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                    <!-- <div class="controls">
                        <input name="s_date" type="date" class="input-xlarge focused" id="focusedInput" value="" />
                    </div> -->
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput"> End Date</label>
                    <div style="display: inherit;" data-date-format="yyyy-mm-dd" class="controls input-append date form_datetime">
                        <input type="text" value="" readonly="readonly" class="span2" name="e_date" id="start_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                    <!-- <div class="controls">
                        <input name="e_date" type="date" class="input-xlarge focused" id="focusedInput" value="" />
                    </div> -->
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


<!--/row-->