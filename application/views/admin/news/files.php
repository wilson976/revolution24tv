<?php
if (isset($files) && count($files)) {
    ?>
    <ul>
        <?php
        foreach ($files as $file) {
            ?>
            <li>
                <img src="./assets/news_images/<?php echo str_replace('-','/',$file['n_date']).'/' .  mythumb($file->n_pic_name); ?>" width="40px"/><strong><?php echo $file->pic_caption ?></strong>
                <a href="admin/upload/delete_file/<?php echo $file->p_id ?>" class="delete_file_link" data-file_id="<?php echo $file->p_id ?>">Delete</a>
                <br/>
                <div id="selectable" onclick="selectText('selectable')"><?php echo $file->n_pic_name; ?></div>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
} else {
    ?>
    <p>No Files Uploaded</p>
    <?php
}
?>