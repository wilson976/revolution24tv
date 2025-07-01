<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Slider News List</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open('admin/news/orderupdate_slider', 'class="form-horizontal"'); ?>            
            <fieldset> 

                <?php
                $i = 1;
                $row_count = count($slidernews);
                // echo $row;
                if ($slidernews != NULL) {
                    ?>
                    <table class="control-group">
                    <?php
                    foreach ($slidernews as $newsslider) {
                        ?><tr>
        
                        <td>
                            <label class="control-label" for="focusedInput" style="width: 400px; text-align: left;">
                            <?php
                            if($newsslider['article_type'] == 1){ 
                            ?>
                            <a href="admin/news/edit/<?php echo $newsslider['n_id']; ?>/<?php echo $newsslider['n_category']; ?>"><?php echo $i . '.   ' . strip_tags($newsslider['n_head']); ?></a>

                <?php
                }elseif($newsslider['article_type'] == 2){              
                echo $i . '.   ' . strip_tags($newsslider['n_head']);               
                }
                ?>
                            </label></td><td>
                            <div class="controls" style="margin-left:0px;">

                            <?php  if($i!=1){ ?>

                                <a href="#" class="up"><img src="./assets/importent_images/uparrow.png" /></a>

                                <?php } ?>
                                
                            <?php  if($i!=$row_count){ ?>

                                <a href="#" class="down"><img src="./assets/importent_images/downarrow.png" /></a>

                                <?php } ?>
                                </td>
                                <td>

                                <input name="news_id[]" type="hidden" value="<?php echo $newsslider['n_id']; ?>">

                                <input name="n_order[]" type="text" style="width: 20px;" class="input-xlarge focused sort" id="<?php echo 'n_order' . $i ?>" value="<?php echo $newsslider['n_order']; ?>">
                            </div>                            
                            <?php
                            echo form_hidden('n_id' . $i, $newsslider['n_id']);
                            ?></td>
                         
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    </table>
                    <?php
                }
                ?>


                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->  
</div><!--/row-->

<script>
    $(document).ready(function(){

        $("body").on('click','.up,.down',function(){
            // $('table tr').find('.up').show();

            var row = $(this).parents("tr:first"),
                top_id = '',
                bottom_id = '';

            if ($(this).is(".up")) {
                row.insertBefore(row.prev());
                top_id = row.find('.sort').val();
                bottom_id = row.next().find('.sort').val();
                row.find('.sort').val(bottom_id);
                row.next().find('.sort').val(top_id);

                $('table tr:last').find('.down').remove();
                $('table tr:eq(<?php echo $row_count-2; ?>) td:eq(1)').html('<a href="#" class="up"><img src="./assets/importent_images/uparrow.png" /></a> <a href="#" class="down"><img src="./assets/importent_images/downarrow.png" /></a>');
                $('table tr:first').find('.up').remove();
                $('table tr:eq(1) td:eq(1)').html('<a href="#" class="up"><img src="./assets/importent_images/uparrow.png" /></a> <a href="#" class="down"><img src="./assets/importent_images/downarrow.png" /></a>');

            } else {
                row.insertAfter(row.next());
                top_id = row.prev().find('.sort').val();
                bottom_id = row.find('.sort').val();
                row.prev().find('.sort').val(bottom_id);
                row.find('.sort').val(top_id);
                
                $('table tr:first').find('.up').remove();
                $('table tr:eq(1) td:eq(1)').html('<a href="#" class="up"><img src="./assets/importent_images/uparrow.png" /></a> <a href="#" class="down"><img src="./assets/importent_images/downarrow.png" /></a>');
                $('table tr:last').find('.down').remove();
                $('table tr:eq(<?php echo $row_count-2; ?>) td:eq(1)').html('<a href="#" class="up"><img src="./assets/importent_images/uparrow.png" /></a> <a href="#" class="down"><img src="./assets/importent_images/downarrow.png" /></a>');
            }
            // alert('top_id:'+top_id+' bottom_id:'+bottom_id);

            return false;
        });
    });
</script>