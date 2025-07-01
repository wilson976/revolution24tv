<table class="table table-striped table-bordered bootstrap-datatable datatable">
    <thead>
        <tr>
             <th>Sl no.</th>
            <th>News Head</th>                            
            <th>Status</th>                            
            <th>Delete</th>     
        </tr>
    </thead>   
    <tbody>
        <?php
        $i=1;
        if (count($news) > 0) {
            foreach ($news as $key => $value) {
                ?>
                <tr>
		    <td class="right"><?php echo $i;?></td>
                    <td class="right"><a href="admin/news/edit/<?php echo $value['n_id'] . '/' . $value['n_category']; ?>"><?php echo strip_tags($value['n_head']); ?></a></td>                                    
                    <td class="center">   
                        <?php
                        if ($value['n_status'] == 1) {
                            ?>
                            <span class="label">Saved as Draft</span>
                            <?php
                        } elseif ($value['n_status'] == 2) {
                            ?>
                            <span class="label">Submitted</span>   
                            <?php
                        } elseif ($value['n_status'] == 3) {
                            ?>
                            <span class="label label-success">Published</span>   
                            <?php
                        }
                        ?>
                    </td>

                    <td class="center"><a href="admin/news/delete/<?php echo $value['n_id']; ?>" onclick="return deletechecked();"><i class="icon-trash"></i></a></td>
                </tr>
            <?php
             $i++;
            }
        }
        ?>
    </tbody>
</table>   