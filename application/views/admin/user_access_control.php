<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Access Control</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open('admin/users/add_permission/', 'class="form-horizontal"'); ?>            
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Menu Module</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="ac_menu_module" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="ac_menu_module" value="1" class="iphone-toggle" <?php if ($control_list['ac_menu_module'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div>
                
               
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Pole Module</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="ac_pole_module" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="ac_pole_module" value="1" class="iphone-toggle" <?php if ($control_list['ac_pole_module'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Scroll News Module</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="ac_scroll_module" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="ac_scroll_module" value="1" class="iphone-toggle" <?php if ($control_list['ac_scroll_module'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Banner Module</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="ac_banner_module" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="ac_banner_module" value="1" class="iphone-toggle" <?php if ($control_list['ac_banner_module'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Photo Gallery</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="ac_photo_module" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="ac_photo_module" value="1" class="iphone-toggle" <?php if ($control_list['ac_photo_module'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Horoscope</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="ac_horoscope" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="ac_horoscope" value="1" class="iphone-toggle" <?php if ($control_list['ac_horoscope'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Website Comments</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="ac_website_comment" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="ac_website_comment" value="1" class="iphone-toggle" <?php if ($control_list['ac_website_comment'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="focusedInput">Writers Profile</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="ac_writers_column" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="ac_writers_column" value="1" class="iphone-toggle" <?php if ($control_list['ac_writers_column'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label" for="focusedInput">Special Event</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="ac_special_event" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="ac_special_event" value="1" class="iphone-toggle" <?php if ($control_list['ac_special_event'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Today's NewsPaper </label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="ac_print_news" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="ac_print_news" value="1" class="iphone-toggle" <?php if ($control_list['ac_print_news'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div>
                      
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Access for All News Entry</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="ac_news_entry_module" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="ac_news_entry_module" value="1" class="iphone-toggle" <?php if ($control_list['ac_news_entry_module'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="selectError1">News Entry Control</label>
                    <div class="controls">
                        <select name="ac_entrycontrol_module[]" id="ac_entrycontrol_module" multiple data-rel="chosen">
                            <?php
                            $a = explode(',', $control_list['ac_entrycontrol_module']);
                            foreach ($menu as $row):
                                ?>
                                <option value="<?php echo $row['m_id']; ?>" 
                                <?php foreach ($a as $key => $value):
                                    if ($row['m_id'] == $value) {
                                        echo 'selected';
                                    }
                                endforeach;
                                ?>><?php echo $row['m_name']; ?></option> 
                                        <?php
                                    endforeach;
                                    ?>
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php
            echo form_hidden('id', $control_list['user_id']);
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->  
</div>





