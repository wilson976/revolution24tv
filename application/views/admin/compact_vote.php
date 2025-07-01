<script  src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Vote Result</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <?php echo form_open('admin/vote_module/compact_edit/', 'class="form-horizontal"'); ?>          
            <fieldset>

                <div class="control-group">
                    <label class="control-label" for="awamileague">Awami League</label>
                    <div class="controls">
                        <input type="text" name="awamileague" value="<?php echo $getvote['awami_league']; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="awamileague">BNP</label>
                    <div class="controls">
                        <input type="text" name="bnp" value="<?php echo $getvote['bnp']; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="awamileague">Jatio Party</label>
                    <div class="controls">
                        <input type="text" name="national_party"  value="<?php echo $getvote['national_party']; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sotontro">Sotontro</label>
                    <div class="controls">
                        <input type="text" name="sotontro"  value="<?php echo $getvote['sotontro']; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="awamileague">Other</label>
                    <div class="controls">
                        <input type="text" name="other"  value="<?php echo $getvote['other']; ?>">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save Result</button>
                    <button type="reset" class="btn">Clear</button>
                </div>

            </fieldset>
            </form>   

        </div>
    </div><!--/span-->
</div>

<script type="text/javascript">
    // CKEDITOR.replace('main_text');
    CKEDITOR.replace( 'main_text',
{
    filebrowserBrowseUrl : '<?php echo base_url();?>assets/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl : '<?php echo base_url();?>assets/ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl : '<?php echo base_url();?>assets/ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl : '<?php echo base_url();?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl : '<?php echo base_url();?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : '<?php echo base_url();?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});

</script>



