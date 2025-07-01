<script  src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Text Form</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <?php echo form_open('admin/text_module/edit/', 'class="form-horizontal"'); ?>          
            <fieldset>
                <legend>Create a Event</legend>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Text</label>
                    <div class="controls">
                        <textarea name="text" id="main_text"><?php echo $gettext['text']; ?></textarea>
                        
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" >Text Type </label>
                    <div class="controls">
                        <select id="n_category" data-rel="chosen" name="text_type">
                            <option value="cityelection-north" <?php if($gettext['type']=='cityelection-north'){ echo 'selected';} ?>>City Election North</option>							
							<option value="cityelection-south" <?php if($gettext['type']=='cityelection-south'){ echo 'selected';} ?>>City Election South</option>
                        </select>
                    </div>
                </div> 
                
               
                
                <div class="control-group">
                    <label for="start_date" style="display: block;" class="control-label">Start publishing:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="<?php echo date("d M Y h:i:s", strtotime($gettext['start_date'])); ?>" readonly="readonly" class="span2" name="start_date" id="start_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="end_date" style="display: block;" class="control-label">End publishing:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="<?php
                            if ($gettext['end_date'] != '1970-01-01 06:00:00') {
                                echo date("d M Y h:i:s", strtotime($gettext['end_date']));
                            }
                            ?>" readonly="readonly" class="span2" name="end_date" id="end_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>   
                <input type="hidden" name="id" value="<?php echo  $gettext['id']; ?>">
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Event</button>
                    <button type="reset" class="btn">Clear</button>
                </div>

            </fieldset>
            </form>   

        </div>
    </div><!--/span-->
</div>

<script type="text/javascript">    
    CKEDITOR.replace('main_text');
</script>
