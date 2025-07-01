<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><a href="admin/photo_gallery/photo_editdeletelist/<?php echo $cat['g_id']; ?>"><i class="icon-edit"></i> Edit / <i class="icon-edit"></i>Delete</a></h2>
        </div>        
    </div>
</div>

<div class="row-fluid sortable">    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-folder-open"></i> Browse Photo By Category</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Picture</th>
                        <th>Caption</th>
                        <th>Control</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($photo != NULL) {
                        $i = 1;
                        foreach ($photo as $row):
                            ?>                                        
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="center"><img src="./assets/images/photo_gallery/thmubs/<?php echo $row['p_location']; ?>" /></td>
                                <td class="center"><?php echo $row['p_caption']; ?></td>
                                <td class="center">
                                    <a href="admin/photo_gallery/photo_edit_page/<?php echo $row['p_id']; ?>/<?php echo $row['p_category']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>             
                                    </a>       

                                    <a href="admin/photo_gallery/photo_delete/<?php echo $row['p_id']; ?>/<?php echo $row['p_category']; ?>" onclick="return deletechecked();">
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

