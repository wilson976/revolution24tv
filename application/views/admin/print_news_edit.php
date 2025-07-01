<script  src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>News Form</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            </div>
        </div>
        <div class="box-content">
            <?php echo form_open_multipart('admin/print_news/edit/' . $edit_data['n_id'] . '/' . $category_id, 'class="form-horizontal"'); ?>          
            <fieldset>
                <legend><?php echo $cat_name; ?></legend>

                <legend><?php echo $edit_data['n_head']; ?></legend>


                    <!-- Display position -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a  data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                Display position
                            </a>
                        </div>
                            <div class="accordion-inner">
                                <div class="control-group ">
                                    <div class="controls">
                                        <?php
                                        $position = (explode(',', $edit_data['n_position']));
                                        ?>
                                        <label class="checkbox">
                                            <input type="checkbox" value="10" id="page_position" name="page_position[]" 
                                            <?php
                                            //$position = (explode(',', $edit_data['n_position']));
                                            foreach ($position as $pos) {
                                                if ($pos == 10) {
                                                    echo ' checked=""';
                                                }
                                            }
                                            ?>> Category lead item                                                                                                    
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" value="13" id="page_position" name="page_position[]" <?php
                                                   foreach ($position as $pos) {
                                                       if ($pos == 13) {
                                                           echo ' checked=""';
                                                       }
                                                   }
                                            ?>> Home lead                                                                                                    
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" value="14" id="page_position" name="page_position[]" <?php
                                                   foreach ($position as $pos) {
                                                       if ($pos == 14) {
                                                           echo ' checked=""';
                                                       }
                                                   }
                                            ?>> Top Selected 4                                                                                                   
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" value="15" id="page_position" name="page_position[]" <?php
                                                   foreach ($position as $pos) {
                                                       if ($pos == 15) {
                                                           echo ' checked=""';
                                                       }
                                                   }
                                            ?>> Top News                                                                                                  
                                        </label>
                                       
                                        <label class="checkbox">
                                            <input type="checkbox" value="16" id="page_position" name="page_position[]" <?php
                                                   foreach ($position as $pos) {
                                                       if ($pos == 16) {
                                                           echo ' checked=""';
                                                       }
                                                   }
                                            ?>> Headlines                                                                                                  
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" value="21" id="page_position" name="page_position[]" <?php
                                                   foreach ($position as $pos) {
                                                       if ($pos == 21) {
                                                           echo ' checked=""';
                                                       }
                                                   }
                                            ?>> Special News                                                                                                  
                                        </label>
										<label class="checkbox">
                                            <input type="checkbox" value="19" id="page_position" name="page_position[]" <?php
                                                   foreach ($position as $pos) {
                                                       if ($pos == 19) {
                                                           echo ' checked=""';
                                                       }
                                                   }
                                            ?>> Instant Article                                                                                                  
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" value="17" id="page_position" name="page_position[]" <?php
                                                   foreach ($position as $pos) {
                                                       if ($pos == 17) {
                                                           echo ' checked=""';
                                                       }
                                                   }
                                            ?>> Home News                                                                                                  
                                        </label>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- End Display position -->



                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update News</button>
                    <button type="reset" class="btn">Clear</button>
                </div>
            </fieldset>
            </form>   
        </div>
    </div><!--/span-->
</div>
<script type="text/javascript">    
    CKEDITOR.replace( 'n_details' );
</script>
