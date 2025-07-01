<?php if ($this->session->userdata('tag') != 'user') { ?>

<script>
    function confirmButton()
    {
        var ans = confirm("Are you sure want to Published/Unpublished this news ?")
        if (ans) {
            document.messages.submit();
        }

        return false;
    }
</script>

    <?php if ($total_unpublished != NULL) { ?>
        <div class="sortable row-fluid ui-sortable">
            <a href="./admin/dashboard/unpublished" class="well span3 top-block" data-rel="tooltip" data-original-title="Total Unpublished <?php echo $total_unpublished; ?>">
                <span class="icon32 icon-red icon-info"></span>
                <div>Total Unpublished</div>
                <div><?php echo $total_unpublished; ?></div>
                <span class="notification red"><?php echo $total_unpublished; ?></span>
            </a>
        </div>
        <?php
    }
    ?>

    <div class="searchbox">
        <form action="./admin/dashboard/search" method="post">
                    <input type="hidden" name="token" value="1">
            <div class="row-fluid">
                <div class="span2">
                    <label for="start_publishing" class="control-label">Title: </label>
                    <input style="width:120px;" type="text" name="title" placeholder="News Head" id="title" />
                </div>
                <!-- Start Date: <input type="text" name="sdate" placeholder="dd/mm/yyyy" /> -->
                <div class="span2">
                    <label for="start_publishing" class="control-label">Start Date:</label>
                    <div data-date-format="yyyy-mm-dd hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="" readonly="readonly" class="span7" name="start_date" id="start_date">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>
                <div class="span2">
                    <label for="start_publishing" class="control-label">End Date:</label>
                    <div data-date-format="yyyy-mm-dd hh:ii:ss" class="controls input-append date form_datetime">
                        <input type="text" value="" readonly="readonly" class="span7" name="end_date" id="end_date">
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>
                <div class="span2 form-control">
                    <label for="start_publishing" class="control-label">Post By:</label>
                    <select  style="width: 120px; border-radius:3px;" name="user">
                      <option value="">Select One</option>

                      <?php 
                        foreach ($user as $value) {
                      ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['u_name']; ?></option>
                      <?php 
                        }
                      ?>
                    </select>
                </div>
                <div class="span2 form-control">
                    <label for="start_publishing" class="control-label">Status:</label>
                    <select  style="width: 120px; border-radius:3px;" name="status">
                      <option value="">Select One</option>
                      <option value="3">Published</option>
                      <option value="2">Draft</option>
                      <option value="1">Submit</option>
                    </select>
                </div>
                <div class="span2">
                    </br>
                    <input style="padding: 8px 20px;" class="btn btn-success" type="submit" value="Search" />
                </div>
            </div>

        </form>
    </div>

    <!-- <table class="table table-striped table-bordered bootstrap-datatable datatable"> -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Sl. No</th>
                <th>News Head</th>                            
                <th>Status</th> 
                <?php
               // if ($this->session->userdata['type'] == 10) {
                    // For Super Admin
                    ?>
                    <th>Hit</th>
                    <th>Post Time / Post By</th>
                    <th>Edit Time / Edit By</th>                    
                    <?php
                //}
                ?>
                <th>live</th>
                <th>Delete</th>     
            </tr>
        </thead>   
        <tbody>
            <?php
            $i = 1;
            if ($newslist != NULL) {
                foreach ($newslist as $value) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td class="right"><a href="admin/news/edit/<?php echo $value['n_id'] . '/' . $value['n_category']; ?>"><?php echo strip_tags($value['n_head']); ?></a></td>                                    
                        <td class="center">   
                            <?php
                            if ($value['n_status'] == 1) {
                                ?>
                                <a onclick="return confirmButton()" href="admin/dashboard/publishenews/<?php echo $value['n_id']; ?>"><span class="label">Unpublished</span></a>
                                <?php
                            } elseif ($value['n_status'] == 2) {
                                ?>
                                <a  onclick="return confirmButton()"  href="admin/dashboard/publishenews/<?php echo $value['n_id']; ?>"><span class="label">Unpublished</span></a>   
                                <?php
                            } elseif ($value['n_status'] == 3) {
                                ?>
                                <a onclick="return confirmButton()" href="admin/dashboard/unpublish/<?php echo $value['n_id']; ?>"><span class="label label-success">Published</span> </a>   
                                <?php
                            }
                            ?>
                        </td>

                        <?php
                        //if ($this->session->userdata['type'] == 10) {
                            // For Super Admin
                            ?>
                            <td class="center">
                                <?php echo $value['most_read']; ?>
                            </td>
                            <td class="center">
                                <?php
                                echo date("j F, Y h:i A", strtotime($value['post_time']));
                                echo '<br>';
                                echo 'By : ' . $value['u_name'];
                                ?>                                       
                            </td>
                            <td class="center">
                                <?php
                                if ($value['edit_time'] == NULL) {
                                    echo 'Never Edited';
                                } else {
                                    echo date("j F, Y h:i A", strtotime($value['edit_time']));
                                    echo '<br>';
                                    echo 'By : ';
                                    echo $this->M_admin_model->newsedited_by($value['n_edit_by']);
                                }
                                ?>     

                            </td>                            
                            <?php
                        //}
                        ?>
                         <td class="center">
                            <?php
                            if($value['live_news']=='yes'){
                            ?>
                            <a href="./admin/news/add_live/<?php echo $value['n_id']; ?>">Live News</a>
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
    <?php
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