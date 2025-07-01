<?php if ($this->session->userdata('tag') != 'user') { ?>
<?php

//////// $c_type is used to seperate app comment and web comments and seperate button link////////////////

$c_type = 'app';
if($this->uri->segment(4)=='web'){
    $c_type = 'web';
}
?>
<a href="./admin/dashboard/approved_comments/<?php echo $c_type; ?>" class="btn btn-round btn-info">Approved Comments</a> &nbsp;
<a href="./admin/dashboard/rejected_comments/<?php echo $c_type; ?>" class="btn btn-round btn-info">Rejected Comments</a> </br></br>
    
    <!-- <table class="table table-striped table-bordered bootstrap-datatable datatable"> -->
    <table class="table table-striped table-bordered">
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
            if($comments!=''){ $si=1; foreach ($comments as $key => $value) { ?>
                
            <tr>
                <td><?php echo $si; ?></td>
                <td><span style="color:#207EB3;"><?php echo $value['n_head'].'</span></br></br>'.$value['comment_text']; ?></td>                            
                <td><?php if($value['status']==0){ echo 'Pending'; }elseif ($value['status']==1) {  echo 'Approved'; }elseif ($value['status']==2) { echo 'Rejected';  } ?></td>  
                <td><?php echo $value['created_at']; ?> </td>
                <td>
                    <?php if($value['status']==1){ echo '<a href="./admin/dashboard/comment_reject/'.$value['id'].'" class="btn btn-round btn-danger">Rejecte</a>'; }elseif($value['status']==0){  echo '<a href="./admin/dashboard/comment_approve/'.$value['id'].'" class="btn btn-round btn-success">Approve</a>'.' <a href="./admin/dashboard/comment_reject/'.$value['id'].'" class="btn btn-round btn-danger">Rejecte</a>'; }else{  echo '<a href="./admin/dashboard/comment_approve/'.$value['id'].'" class="btn btn-round btn-success">Approve</a>'; } ?>
                    
                    
                </td>     
            </tr>
            <?php $si++; } }?>
        </tbody>
    </table>  

<?php
echo $links;
} else {
    ?>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-info-sign"></i>Introduction</h2>
                <div class="box-icon">                
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
                </div>
            </div>

            <div class="box-content">
                <div class="box-content">
                    <h1> <small>Welcome to Admin Panel</br></small></h1>                    
                </div>
            </div>
        </div><!--/span-->

    </div><!--/row-->

    <?php
}
?>



<div id="tabcurrent_user" style=" left: 30%;position: absolute;top: 30%;background:#FFF;border:1px solid #000;padding:16px;display: none;z-index: 9999999;">
<a style="float: right;" id="current_user_close"><img src="./assets/importent_images/close_icon.png" ></a>

</div>
