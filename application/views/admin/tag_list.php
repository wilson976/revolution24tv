<div class="row-fluid sortable">  
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-folder-open"></i> Tag List</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Tag Topics Image</th>
                        <th>Tag Name</th> 
                        <th>Control</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($tags_info != NULL) {
                        $i = 1;
                        foreach ($tags_info as $row):
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="center"><img src="./assets/images/tag_image/thmubs/<?php echo $row['tag_image']; ?>" width="40" /></td>
                                <td class="center"><?php echo $row['tag_name']; ?></td>
                                <td class="center">
                                    <a href="admin/tag_topics/tag_edit_page/<?php echo $row['tag_id']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>             
                                    </a>       

                                    <a href="admin/tag_topics/tag_delete/<?php echo $row['tag_id']; ?>" onclick="return deletechecked();">
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