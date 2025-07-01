<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><a href="admin/photo_gallery/photo_editdeletelist/<?php echo $cat['g_id']; ?>"><i class="icon icon-color icon-compose"></i> Edit / <i class="icon icon-color icon-trash"></i>Delete</a></h2>
        </div>        
    </div>
</div>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-picture"></i> Photo Gallery</h2>
            <div class="box-icon">               
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">            
            <ul class="thumbnails gallery">
                <?php
                if ($photo != NULL) {
                    $i = 1;
                    foreach ($photo as $row):
                        ?>
                        <li id="image-<?php echo $i; ?>" class="thumbnail">
                            <a style="background:url(./assets/images/photo_gallery/thmubs/<?php echo $row['p_location']; ?>)" title="<?php echo $row['p_caption']; ?>" href="./assets/images/photo_gallery/<?php echo $row['p_location']; ?>"><img class="grayscale" src="./assets/images/photo_gallery/<?php echo $row['p_location']; ?>" alt="<?php echo $cat['g_cat']; ?>-<?php echo $i; ?>"></a>
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