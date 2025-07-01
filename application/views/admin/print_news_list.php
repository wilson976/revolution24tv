<div class="row-fluid sortable">    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-plus"></i> Todays Print News List</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>

        <div class="box-content">
            
            <div id="news_list"></div>
            <div id="news">
                <table class="table table-striped table-bordered bootstrap-datatable datatable" >
                    <thead>
                        <tr>
                            <th>Sl. No</th>
                            <th>News ID</th>
                            <th>News Head</th>  
                            <th>News Category</th>                          
                            <th>Change Position</th>      
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
            $i=1;
                        if (count($printNews) > 0) {
                            foreach ($printNews as $key => $value) {
                                ?>
                                <tr>
                                    <td class="right"><?php echo $i;?></td>
                                    <td class="right"><?php echo $value['n_id'];?></td>
                                    <td class="right"><?php echo strip_tags($value['n_head']); ?></td>
                                    <td class="right"><?php echo strip_tags($value['m_name']); ?></td>
                                    <td class="right"><a href="admin/print_news/edit/<?php echo $value['n_id'] . '/' . $value['n_category']; ?>">Edit</a></td>                                    
                                    
                                </tr>
                                <?php
                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>      
            </div>
        </div><!--/span-->  
    </div><!--/span-->
