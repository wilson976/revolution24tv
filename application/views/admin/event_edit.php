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
            <?php echo form_open('admin/special_event/edit/', 'class="form-horizontal"'); ?>          
            <fieldset>
                <legend>Create a Event</legend>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Event Title</label>
                    <div class="controls">
                        <input class="input-large focused" id="focusedInput" type="text" name="event_name" value="<?php echo $getevent['event_name']; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" >Select Category </label>
                    <div class="controls">
                        <select id="n_category" data-rel="chosen" name="event_category">
                            <option value="None">None</option>
                            <?php
                            foreach ($allmenu as $key => $value) {
                                echo '<option value="' . $value['m_id'] . '"';
                                if ($value['m_id'] == $getevent['event_category']) {
                                    echo ' Selected';
                                }
                                echo '>' . $value['m_bangla'] . '</option>' . "\n";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectError">Status</label>
                    <div class="controls">
                        <select name="event_status" id="event_status" data-rel="chosen">
                            <option value="1" <?php if ($getevent['event_status'] == 1) echo ' selected'; ?>>Active</option>
                            <option value="0" <?php if ($getevent['event_status'] == 0) echo ' selected'; ?>>Inactive</option>
                        </select>
                    </div>
                </div> 
                <div class="control-group">
                    <label for="start_date" style="display: block;" class="control-label">Start publishing:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="<?php echo date("d M Y h:i:s", strtotime($getevent['start_date'])); ?>" readonly="readonly" class="span2" name="start_date" id="start_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>
                <div class="control-group">
                    <label for="end_date" style="display: block;" class="control-label">End publishing:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="<?php
                            if ($getevent['end_date'] != '1970-01-01 06:00:00') {
                                echo date("d M Y h:i:s", strtotime($getevent['end_date']));
                            }
                            ?>" readonly="readonly" class="span2" name="end_date" id="end_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>   
                <?php echo form_hidden('event_id', $getevent['event_id']); ?>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Event</button>
                    <button type="reset" class="btn">Clear</button>
                </div>

            </fieldset>
            </form>   

        </div>
    </div><!--/span-->
</div>
