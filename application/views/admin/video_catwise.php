<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><a href="admin/video_gallery/video_editdeletelist/<?php echo $cat['id']; ?>"><i class="icon icon-color icon-compose"></i> Edit / <i class="icon icon-color icon-trash"></i>Delete</a></h2>
        </div>        
    </div>
</div>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-picture"></i> Video Gallery</h2>
            <div class="box-icon">               
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">            
            <ul class="thumbnails gallery">
                <?php
                if ($video != NULL) {
                    $i = 1;
                    foreach ($video as $row):
                        ?>
                        <li id="image-<?php echo $i; ?>" class="thumbnail">
                            <a style="background:url(./assets/images/video_gallery/thmubs/<?php echo $row['link']; ?>)" title="<?php echo $row['v_tag']; ?>" href="./assets/images/video_gallery/<?php echo $row['link']; ?>"><img class="grayscale" src="./assets/images/video_gallery/<?php echo $row['link']; ?>" alt="<?php echo $cat['cat_name']; ?>-<?php echo $i; ?>"></a>
                        </li>    
                        <?php
                        $i++;
                    endforeach;
                }
                ?>
            </ul>
        </div>
    </div><!--/span-->

</div><!--/row-->

<!-- content ends -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->