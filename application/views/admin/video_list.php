<div class="row-fluid sortable">    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-plus"></i> <a href="./admin/video_gallery/video_sort">Sorting Video</a></h2>            
        </div>
    </div>
</div>
<div class="row-fluid sortable">    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-plus"></i> <a href="./admin/video_gallery/video_category">Create Video Category</a></h2>            
        </div>
    </div>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Video Entry</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/video_gallery/video_entry', 'class="form-horizontal"'); ?>            
            <fieldset>
                <div class="control-group">
                    <label class="control-label" >Select Category </label>
                    <div class="controls">
                        <select id="v_category" data-rel="chosen" name="v_category">
                            <option>Select Category</option>
                            <?php
                            foreach ($submenu as $key => $value) {
                                echo '<option value="' . $value['id'] . '"';
                                echo '>' . $value['cat_name'] . '</option>' . "\n";
                            }
                            ?>
                        </select>

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">YouTube Embed Code/Link</label>
                    <div class="controls">
                     <textarea name="link" rows="2" class="input-xlarge focused" id="focusedInput"></textarea>
                    </div>
                </div> 
                
                

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Caption</label>
                    <div class="controls">
                        <textarea name="v_caption" rows="2" class="input-xlarge focused" id="focusedInput"></textarea>
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="fileInput">Picture (optional)</label>
                    <div class="controls">
                        <input name="picture" type="file" class="input-file uniform_on">
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Video Tag</label>
                    <div class="controls">
                        <input type="text" name="v_tag"  class="iphone-toggle" />                       
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Home Lead Video</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="v_position" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="v_position" value="1" class="iphone-toggle" />                       
                    </div>
                </div>
                <!--<div class="control-group">-->
                <!--    <label class="control-label" for="focusedInput">Lead Item</label>-->
                <!--    <div class="controls">-->
                <!--        <input data-no-uniform="true" type="hidden" name="v_lead" value="0" class="iphone-toggle" />-->
                <!--        <input data-no-uniform="true" type="checkbox" name="v_lead" value="1" class="iphone-toggle" />                       -->
                <!--    </div>-->
                <!--</div>-->

                <div class="control-group">
                    <label for="start_date" style="display: block;" class="control-label">Start publishing:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="" readonly="readonly" class="span2" name="start_date" id="start_publishing">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
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




<?php if ($this->session->userdata('tag') != 'user') { ?>


    <div class="row-fluid sortable">


        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-th-list"></i> Video List</h2>
                <div class="box-icon">                
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Video Category</th>   
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        if ($cat_list_browse != NULL) {
                        $i = 1;
                        foreach ($cat_list_browse as $key => $a):
                            foreach ($a as $key => $row):
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><a href="admin/video_gallery/video_editdeletelist/<?php echo $row['id']; ?>"><?php echo $row['cat_name']; ?></a></td>                                                
                                </tr>
                                <?php
                                $i++;
                            endforeach;
                        endforeach;
                    }
                        ?>                                                    
                    </tbody>
                </table>              
            </div>
        </div><!--/span-->
    </div><!--/row-->

    <?php
}
?>