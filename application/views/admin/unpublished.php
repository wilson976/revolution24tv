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
    <table class="table table-striped table-bordered bootstrap-datatable datatable">
        <thead>
            <tr>
                <th>Sl. No</th>
                <th>News Head</th>                            
                <th>Status</th> 
                <?php
                if ($this->session->userdata['type'] == 10) {
                    // For Super Admin
                    ?>
                    <th>Hit</th>
                    <th>Post Time / Post By</th>
                    <th>Edit Time / Edit By</th>                    
                    <?php
                }
                ?>
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
                        if ($this->session->userdata['type'] == 10) {
                            // For Super Admin
                            ?>
                            <td class="center">
                                <?php echo $value['most_read']; ?>
                            </td>
                            <td class="center">
                                <?php
                                echo date("j F, Y H:i", strtotime($value['post_time']));
                                echo '<br>';
                                echo 'By : ' . $value['u_name'];
                                ?>                                       
                            </td>
                            <td class="center">
                                <?php
                                if (strtotime($value['edit_time']) == 0) {
                                    echo 'Never Edited';
                                } else {
                                    echo date("j F, Y H:i A", strtotime($value['edit_time']));
                                    echo '<br>';
                                    echo 'By : ';
                                    echo $this->M_admin_model->newsedited_by($value['n_edit_by']);
                                }
                                ?>     

                            </td>                            
                            <?php
                        }
                        ?>

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

