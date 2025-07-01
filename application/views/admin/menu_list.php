<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-th-list"></i> <a href="admin/menu/create_menu_page">Create New Menu</a></h2>
        </div>        
    </div>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-th-list"></i> Online Menu</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Display Menu</th>
                        <th>Workable Menu</th>
                        <th>Status</th>
                        <th>Action</th>                        
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($menu != NULL) {
                        foreach ($menu as $row):
                            ?>
                            <tr>
                                <td><?php echo $row['m_tab']; ?></td>
                                <td class="center"><?php echo $row['m_name']; ?></td>
                                <td class="center"><?php echo $row['m_bangla']; ?></td> 
                                <td class="center">
                                    <?php
                                    if ($row['m_status'] == 'active') {
                                        ?>
                                        <span class="label label-success">Active</span>
                                        <?php
                                    } elseif ($row['m_status'] == 'inactive') {
                                        ?>
                                        <span class="label">Inactive</span>   
                                        <?php
                                    } elseif ($row['m_status'] == 'main') {
                                        ?>
                                        <span class="label">Top Menu</span>   
                                        <?php
                                    } elseif ($row['m_status'] == 'tab') {
                                        ?>
                                        <span class="label">Tab Menu</span>   
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td class="center">
                                    <a href="admin/menu/menu_edit_page/<?php echo $row['m_id']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>                            
                                    </a>                                
                                </td>                                       
                            </tr>
                            <?php
                        endforeach;
                    }
                    ?>                                                    
                </tbody>
            </table>              
        </div>
    </div><!--/span-->
</div>



<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-th-list"></i> Sub Menus</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Menu Name</th>
                        <th>Main Menu</th>
                        <th>Status</th>
                        <th>Action</th>                        
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($sub_menu != NULL) {
                        foreach ($sub_menu as $row):
                            ?>
                            <tr>
                                <td><?php echo $row['m_tab']; ?></td>
                                <td class="center"><?php echo $row['m_name']; ?></td>
                                <td class="center"><?php echo $row['parent_menu']; ?></td> 
                                <td class="center">
                                    <?php
                                    if ($row['m_status'] == 'active') {
                                        ?>
                                        <span class="label label-success">Active</span>
                                        <?php
                                    } elseif ($row['m_status'] == 'inactive') {
                                        ?>
                                        <span class="label">Inactive</span>   
                                        <?php
                                    } elseif ($row['m_status'] == 'main') {
                                        ?>
                                        <span class="label">Top Menu</span>   
                                        <?php
                                    } elseif ($row['m_status'] == 'tab') {
                                        ?>
                                        <span class="label">Tab Menu</span>   
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td class="center">
                                    <a href="admin/menu/menu_edit_page/<?php echo $row['m_id']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>                            
                                    </a>                                
                                </td>                                       
                            </tr>
                            <?php
                        endforeach;
                    }
                    ?>                                                    
                </tbody>
            </table>              
        </div>
    </div><!--/span-->
</div>




<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-th-list"></i> Other Menu</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Menu English</th>
                        <th>Menu Bengali</th>
                        <th>Status</th>                        
                        <th>Action</th>                        
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($menu_other != NULL) {
                        foreach ($menu_other as $rowspecial):
                            ?>
                            <tr>
                                <td><?php echo $rowspecial['m_tab']; ?></td>
                                <td class="center"><?php echo $rowspecial['m_name']; ?></td>
                                <td class="center"><?php echo $rowspecial['m_bangla']; ?></td>
                                <td class="center">
                                    <?php
                                    if ($rowspecial['m_status'] == 'active') {
                                        ?>
                                        <span class="label label-success">Active</span>
                                        <?php
                                    } elseif ($rowspecial['m_status'] == 'inactive') {
                                        ?>
                                        <span class="label">Inactive</span>   
                                        <?php
                                    } elseif ($rowspecial['m_status'] == 'main') {
                                        ?>
                                        <span class="label">Top Menu</span>   
                                        <?php
                                    } elseif ($rowspecial['m_status'] == 'tab') {
                                        ?>
                                        <span class="label">Tab Menu</span>   
                                        <?php
                                    }
                                    ?>
                                </td>                            
                                <td class="center">
                                    <a href="admin/menu/menu_edit_page/<?php echo $rowspecial['m_id']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>                            
                                    </a>                                
                                </td>                                       
                            </tr>
                            <?php
                        endforeach;
                    }
                    ?>                                                    
                </tbody>
            </table>              
        </div>
    </div><!--/span-->
</div>

