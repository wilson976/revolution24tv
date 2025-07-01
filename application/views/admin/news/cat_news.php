<div id="news" style="width:60%;">
    <table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Category Section</th>                            
        <th>Action</th>       
    </tr>
    </thead>   
    <tbody>
    <?php
     if ($allcat != NULL) {
                            foreach ($allcat as $row): ?>
           <tr>
                <td class="left"><?php echo $row['m_name']; ?></td>
                <td class="right" width="10%"><a href="admin/sort_news/arrangeCatNews/<?php echo $row['m_id']; ?>">Sort</a></td>
            </tr>
           <?php  endforeach;
                        } ?>
    </tbody>
    </table>      
</div>