<div class="row-fluid sortable">

    <div class="box span6">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Video Entry</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open('admin/photo_gallery/video_entry', 'class="form-horizontal"'); ?>            
            <fieldset>                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Video Source1</label>
                    <div class="controls">
                        <input name="vid_src" type="text" class="input-xlarge focused" id="focusedInput" value="">
                    </div>
                </div> 
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Caption</label>
                    <div class="controls">
                        <input name="vid_caption" type="text" class="input-xlarge focused" id="focusedInput" value="">
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

    <div class="box span6">
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
                        <th>Video</th>
                        <th>Caption</th>
                        <th>Control</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($video != NULL) {
                        $i = 1;
                        foreach ($video as $row):
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="center"><img src="http://img.youtube.com/vi/<?php echo $row['vid_src']; ?>/0.jpg"  alt="<?php echo $row['vid_src']; ?>" style="width: 100px; height: 100px;" /></td>
                                <td class="center"><?php echo $row['vid_caption']; ?></td>
                                <td class="center">
                                    <a href="admin/photo_gallery/vid_delete/<?php echo $row['vid_id']; ?>" onclick="return deletechecked();">
                                        <span class="label label-important"><i class="icon-trash icon-white"></i>Delete</span>                            
                                    </a> 
                                </td>                                       
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                    }
                    ?>                                                    
                </tbody>
            </table>              
        </div>
    </div><!--/span-->
</div><!--/row-->