<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Create Menu</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <?php echo form_open_multipart('admin/menu/do_upload', 'class="form-horizontal"'); ?>            
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="fileInput">Banner Picture</label>
                    <div class="controls">
                        <input name="picture" type="file" class="input-file uniform_on">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Display Menu</label>                    
                    <div class="controls">
                        <input name="m_name" type="text" class="input-xlarge focused" id="m_name">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Workable Menu</label>                    
                    <div class="controls">
                        <input name="m_bangla" type="text" class="input-xlarge focused">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectError">Menu Type</label>
                    <div class="controls">
                        <select name="m_type" id="m_type" data-rel="chosen">                            
                            <option value="online">Online</option>                            
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>   
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Meta Title</label>                    
                    <div class="controls">
                        <input name="m_title" type="text" class="input-xlarge focused">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Meta Keyworks</label>                    
                    <div class="controls">
                        <textarea name="m_keywords" type="text" class="input-xlarge focused" id="focusedInput"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Meta Description</label>                    
                    <div class="controls">
                        <textarea name="m_desc" type="text" class="input-xlarge focused" id="focusedInput"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectError">Parent Menu</label>
                    <div class="controls">
                        <select name="m_parent" id="m_parent" data-rel="chosen">
                            <option value="0">Select</option>
                            <?php
                            foreach ($p_list as $key => $value) {
                                echo "<option value=" . $value['m_id'] . ">" . $value['m_name'] . '</option>' . "\n";
                            }
                            ?>
                        </select>
                    </div>
                </div>    
                <div class="control-group">
                    <label class="control-label" for="selectError">Menu Status</label>
                    <div class="controls">
                        <select name="m_status" id="m_status" data-rel="chosen">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>    
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Position</label>                    
                    <div class="controls">
                        <input name="m_tab" type="text" id="m_tab" size="3" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Menu Notes/URL</label>                    
                    <div class="controls">
                        <textarea name="m_notes" type="text" class="input-xlarge focused" id="focusedInput"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">visible MastHead</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="m_masthead" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="m_masthead" value="1" class="iphone-toggle" />                       
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Mark as Special</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="m_special" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="m_special" value="1" class="iphone-toggle" />                       
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
</div><!--/row-->