<table class="table table-striped table-bordered bootstrap-datatable datatable" >
    <thead>
        <tr>
            <th>ID</th>
            <th>News Head/ Comment</th>                            
            <th>Status</th>  
            <th>Post Time </th>
            <th>Action</th>     
        </tr>
    </thead>   
    <tbody>
        <?php
        if (count($comments) > 0) {  $si=1;
            foreach  ($comments as $key => $value) { ?>

                <tr>
                    <td><?php echo $si; ?></td>
                    <td><span style="color:#207EB3;"><?php echo $value['n_head'].'</span></br>'.$value['comment_text']; ?></td>                            
                    <td><?php if($value['status']==0){ echo 'Pending'; }elseif ($value['status']==1) {  echo 'Approved'; }elseif ($value['status']==2) { echo 'Rejected';  } ?></td>  
                    <td><?php echo $value['created_at']; ?> </td>
                    <td>
                        <?php if($value['status']==1){ echo '<a href="./admin/dashboard/comment_reject/'.$value['id'].'" class="btn btn-round btn-danger">Rejecte</a>'; }else{  echo '<a href="./admin/dashboard/comment_approve/'.$value['id'].'" class="btn btn-round btn-success">Approve</a>'; } ?>
                        
                        
                    </td>     
                </tr>
                <?php $si++; }
        }
        ?>
    </tbody>
</table>      