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
            <?php echo form_open('admin/text_module/create/', 'class="form-horizontal"'); ?>          
            <fieldset>
                <legend>Insert Text</legend>
                <div class="control-group">
                    <label class="control-label" >Select Type </label>
                    <div class="controls">
                        <select id="n_category" data-rel="chosen" name="text_type">
                            <option value="cityelection-north">City Election North</option>
							<option value="cityelection-south">City Election South</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Text</label>
                    <div class="controls">
                        <textarea name="main_text" id="main_text" ></textarea>
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
                    <button type="submit" class="btn btn-primary">Add Event</button>
                    <button type="reset" class="btn">Clear</button>
                </div>

            </fieldset>
            </form>   

        </div>
    </div><!--/span-->
</div>
<div class="row-fluid sortable">	
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-plus"></i> Event List</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Text</th>
                        <th>Start Date</th>
                        <th>Actions</th>          
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($gettext != NULL) {
                        foreach ($gettext as $key => $value) {
                            ?>
                            <tr>
                                <?php
                                if($value['type']=='cityelection-north' OR $value['type']=='cityelection-south'){
                                    ?>
                                <td><?php
                                if($value['type']=='cityelection-north'){
                                	 echo 'Dhaka North';
                                	}elseif ($value['type']=='cityelection-south') {
                                	 echo 'Dhaka South';
                                	 } ?></td>
                                <td class="center"><?php echo $value['text']; ?></td>
                                <td class="center"><?php echo $value['start_date']; ?></td>
                                <td class="center"><a href="admin/text_module/edit/<?php echo $value['id']; ?>"><span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span></a></td>
                                <?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>              
        </div>
    </div><!--/span-->	
</div><!--/span-->

<script type="text/javascript">    
    CKEDITOR.replace('main_text');
</script>