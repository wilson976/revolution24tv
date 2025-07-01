<div class="row-fluid sortable">    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-folder-open"></i> Browse Video By Category</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
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
                                <td class="center"><?php echo $row['v_caption']; ?></td>
                                <td class="center">
                                    <a href="admin/Video_gallery/video_edit_page/<?php echo $row['v_id']; ?>/<?php echo $row['v_category']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>             
                                    </a>       

                                    <a href="admin/Video_gallery/video_delete/<?php echo $row['v_id']; ?>/<?php echo $row['v_category']; ?>" onclick="return deletechecked();">
                                        <span class="label label-important"><i class="icon-trash icon-white"></i>Delete</span>                            
                                    </a> 
                                </td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                    }
                    ?>                                     
                    </tr>                                                                   
                </tbody>
            </table>              
        </div>
    </div><!--/span-->
</div><!--/row-->

