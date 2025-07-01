
<div class="row-fluid sortable">	
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-plus"></i> <?php echo $cat_name; ?> News List</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>

        <div class="box-content">
            <form class="form-horizontal">
                <fieldset>
                    <input class="hidden" type="text" name="cat_id" id="cat_id" value="<?php echo $cat_id; ?>">
                    <div class="control-group">
                        <label class="control-label" for="date">Search News by date</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge datepicker" name="nd" id="nd" value="" onchange="d_news()">
                        </div>

                    </div>
                </fieldset>
            </form> 
            <div id="news_list"></div>
            <div id="news">
                <table class="table table-striped table-bordered bootstrap-datatable datatable" >
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
            </div>
        </div><!--/span-->	
    </div><!--/span-->
