<div class="row-fluid sortable">	
    <div class="box span12">
        <div class="box-header well" data-original-title>
    <?php 
        if($this->uri->segment(3) == 'rejected_comments') 
            $head_text= 'Rejected Comments'; 
        else
            $head_text= 'Approved Comments';
    ?>
            <h2><i class="icon-plus"></i> <?php echo $head_text; ?></h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>

        <div class="box-content">
            <form class="form-horizontal">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="date">Search Comments by date</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge datepicker" name="nd" id="nd" value="" onchange="d_comment()">
                        </div>

                    </div>
                </fieldset>
            </form> 
            <div id="news_list"></div>
            <div id="news">
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
                        if (count($comments) > 0) { $si=1;
                            foreach ($comments as $key => $value) { ?>
                
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><span style="color:#207EB3;"><?php echo $value['n_head'].'</span></br>'.$value['comment_text']; ?></td>                            
                                    <td><?php if($value['status']==0){ echo 'Pending'; }elseif ($value['status']==1) {  echo 'Approved'; }elseif ($value['status']==2) { echo 'Rejected';  } ?></td>  
                                    <td><?php echo $value['created_at']; ?> </td>
                                    <td>
                                        <?php if($value['status']==1){ echo '<a href="./admin/dashboard/comment_reject/'.$value['id'].'" class="btn btn-round btn-danger">Rejecte</a>'; }else{  echo '<a href="./admin/dashboard/comment_approve/'.$value['id'].'" class="btn btn-round btn-success">Approve</a>'; } ?>
                                        
                                        
                                    </td>     
                                </tr>
                                <?php  $si++; }
                        }
                        ?>
                    </tbody>
                </table>      
            </div>
        </div><!--/span-->	
    </div><!--/span-->
    <?php 
		$status = 0;
		echo $this->uri->segment(3);
        if($this->uri->segment(3) == 'rejected_comments') {
            $abc= 'rejected_comment'; 
			$status = 2;
        }else{
            $abc= 'approved_comment';
			$status = 1;
		}
    ?>
<script type="text/javascript">
function d_comment() {
    $.get('./admin/dashboard/ajax_comment_find/<?php echo $status ?>/'+$('#nd').val())
    .success(function (data){
        $("#news").hide("slow");
        $('#news_list').html(data);
    });
}
</script>
