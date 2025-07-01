<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Pool Edit</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open('admin/dashboard/pool_edit', 'class="form-horizontal"'); ?>            
            <fieldset>                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Pool</label>
                    <div class="controls">
                        <textarea name="PoolText" rows="7" class="input-xlarge focused" id="focusedInput"><?php echo $pool['PoolText']; ?></textarea>
                    </div>                    
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php           
            echo form_hidden('PK_PoolID', $pool['PK_PoolID']);
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->

</div><!--/row-->