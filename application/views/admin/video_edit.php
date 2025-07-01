<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Video Edit</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/video_gallery/video_edit/'.$video['v_id'], 'class="form-horizontal"'); ?>   

            <fieldset> 
                    <div class="control-group">
                        <label class="control-label" >Select Category </label>
                        <div class="controls">
                            <select id="v_category" data-rel="chosen" name="v_category">
                                <?php
                                foreach ($submenu as $key => $value) { ?>
                                   <option value="<?php echo $value['id']; ?>" <?php if($video['v_category'] == $value['id']){echo ' selected';} ?>><?php echo $value['cat_name']; ?></option>
                            <?php 
                                    
                                }
                                ?>
                            </select>
                            
                        </div>
                    </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">YouTube Embed Code</label>
                    <div class="controls">
                         <textarea name="link" rows="2" class="input-xlarge focused" id="focusedInput"><?php echo $video['link']; ?></textarea>
                    </div>
                </div>
                 <!-- Image -->
                <div class="control-group">
                    <label class="control-label" for="fileInput">Picture (optional)</label>
                    <div class="controls">
                        <input name="picture" type="file" class="input-file uniform_on">
                        <input type="hidden" name="old_img" value="<?php echo $video['v_location'];?>">
                    </div>
                    
                    
                

                   <?php
                    $src = 'https://img.youtube.com/vi/'.$video['link'].'/0.jpg';
                    if ($video['v_location']!='') {
                        $src = base_url().'assets/images/video_gallery/'.str_replace('-','/',$video['v_date']).'/'.$video['v_location'];
                    }
                    ?>
                   
                        <div class="accordion-heading">
                            <label class="control-label" for="fileInput"> </label>
                                        <div data-provides="fileupload" class="fileupload fileupload-new">
                                            <div class="fileupload-new thumbnail"><img width="238" height="125" style="height: 125px;" src="<?php echo $src; ?>"></div></div></div></div>
                                           
                    <!-- End image -->
                    
                    
 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Caption</label>
                    <div class="controls">
                        <textarea name="v_caption" rows="2" class="input-xlarge focused" id="focusedInput"><?php echo $video['v_caption']; ?></textarea>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Video Tag</label>
                    <div class="controls">
                        <input type="text" name="v_tag" value="<?php echo $video['v_tag']; ?>" class="iphone-toggle" />                       
                    </div>
                </div>
               
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Home Lead Video</label>
                    <div class="controls">
                        <input data-no-uniform="true" type="hidden" name="v_position" value="0" class="iphone-toggle" />
                        <input data-no-uniform="true" type="checkbox" name="v_position" value="1" class="iphone-toggle" <?php if ($video['v_position'] == "1") echo 'Checked'; ?> />                       
                    </div>
                </div> 
               
                <!--<div class="control-group">-->
                <!--    <label class="control-label" for="focusedInput">Lead Item</label>-->
                <!--    <div class="controls">-->
                <!--        <input data-no-uniform="true" type="hidden" name="v_lead" value="0" class="iphone-toggle" />-->
                <!--        <input data-no-uniform="true" type="checkbox" name="v_lead" value="1" class="iphone-toggle" <?php// if ($video['v_lead'] == "1") echo 'Checked'; ?> />                       -->
                <!--    </div>-->
                <!--</div> -->

                
                <div class="control-group">
                    <label for="start_date" style="display: block;" class="control-label">Start publishing:</label>
                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="<?php echo date("d M Y h:i:s", strtotime($video['start_date'])); ?>" readonly="readonly" class="span2" name="start_date" id="start_publishing">
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
           // echo form_hidden('link', $video['link']);
            echo form_hidden('v_id', $video['v_id']);
            //echo form_hidden('p_category', $photo['p_category']);
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->  
</div>