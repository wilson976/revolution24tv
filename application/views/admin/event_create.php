<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Event Form</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <?php echo form_open('admin/special_event/create/', 'class="form-horizontal"'); ?>          
            <fieldset>
                <legend>Create a Event</legend>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Event Title</label>
                    <div class="controls">
                        <input class="input-large focused" id="focusedInput" type="text" name="event_name" >
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" >Select Category </label>
                    <div class="controls">
                        <select id="n_category" data-rel="chosen" name="event_category">
                            <option value="None">None</option>
                            <?php
                            foreach ($allmenu as $key => $val) {
                                echo '<option value="' . $val['m_id'] . '">';
                                echo $val['m_bangla'] . '</option>' . "\n";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectError">Status</label>
                    <div class="controls">
                        <select name="event_status" id="event_status" data-rel="chosen">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>          
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($getevent != NULL) {
                        foreach ($getevent as $key => $value) {
                            ?>
                            <tr>
                                <td><?php echo $value['event_name']; ?></td>
                                <td class="center"><?php echo $value['m_bangla']; ?></td>
                                <td class="center">
                                    <?php
                                    if ($value['event_status'] == '1') {
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
                                <td class="center"><a href="admin/special_event/edit/<?php echo $value['event_id']; ?>"><span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span></a></td>
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




