<div class="row-fluid sortable">    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-plus"></i> <a href="./admin/sort_news">Sort News</a></h2>            
        </div>
    </div>
</div>
<div class="row-fluid sortable">    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-plus"></i> <a href="./admin/tags">News tag Entry</a></h2>            
        </div>
    </div>
</div>
<?php
$ac_data = $this->Access_control->ac($this->session->userdata['user_id']);


if ($this->session->userdata['type'] == 10 || $ac_data['ac_news_entry_module'] == 1) {
    // For Super Admin
    ?>
    <div class="row-fluid sortable">	
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-plus"></i> News Manager</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-down"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Tab</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>News Entry</th>
                            <th>News List</th>          
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        foreach ($menu as $row):
                            ?>
                            <tr>
                                <td><?php echo $row['m_tab']; ?></td>
                                <td class="center"><?php echo $row['m_bangla']; ?></td>
                                <td class="center"><?php echo $row['m_name']; ?></td>
                                <td class="center">
                                    <a href="admin/news/add/<?php echo $row['m_id']; ?>" target="">
                                        <span class="label label-important"><i class="icon-pencil"></i></span>                            
                                    </a>                                
                                </td>                                
                                <td class="center">
                                    <a href="admin/news/display/<?php echo $row['m_id']; ?>">
                                        <span class="label label-warning"><i class="icon-th-list"></i></span>                            
                                    </a>                                
                                </td>  
                            </tr>
                            <?php
                        endforeach;
                        ?>                                                    
                    </tbody>
                </table>              
            </div>
        </div><!--/span-->
    </div><!--/span-->


    <?php
}else {
    ?>
    <div class="row-fluid sortable">	
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-plus"></i> News Manager</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-down"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Tab</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>News Entry</th>
                            <th>News List</th>          
                        </tr>
                    </thead>   
                    <tbody>

                        <?php
                        $a = explode(',', $ac_data['ac_entrycontrol_module']);
                        if ($allmenu != NULL) {
                            foreach ($allmenu as $row):

                                foreach ($a as $key => $value) {
                                    if ($row['m_id'] == $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['m_tab']; ?></td>
                                            <td class="center"><?php echo $row['m_bangla']; ?></td>
                                            <td class="center"><?php echo $row['m_name']; ?></td>
                                            <td class="center">
                                                <a href="admin/news/add/<?php echo $row['m_id']; ?>">
                                                    <span class="label label-important"><i class="icon-pencil"></i>Add News</span>                            
                                                </a>                                
                                            </td>                                            
                                            <td class="center">
                                                <a href="admin/news/display/<?php echo $row['m_id']; ?>">
                                                    <span class="label label-warning"><i class="icon-th-list"></i>News List</span>                            
                                                </a>                                
                                            </td>  
                                        </tr>
                                        <?php
                                    }
                                }
                            endforeach;
                        }
                        ?>                                                    
                    </tbody>
                </table>              
            </div>
        </div><!--/span-->
    </div><!--/span--> 

<?php } ?>
