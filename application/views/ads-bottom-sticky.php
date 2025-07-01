<div class="text-center body-ad-bottom">
<?php
if ($banner != NULL) {
    foreach ($banner as $key => $value) {
        if ($value['b_position'] == $position) {
            // array_push($_SESSION['add'], $value['b_id']);
            ?>
            <?php
            if ($value['b_type'] == 'image') {
                ?>
                    <a href="<?php
                if (filter_var($value['b_url'], FILTER_VALIDATE_URL))
                    echo $value['b_url'];
                else
                    echo './assets/images/banner/linked_file/' . $value['b_link_location']
                    ?>"  class="ad_cl" data-id="<?php echo $value['b_id'] ?>" target="_blank">
                           <?php echo '<img src="./assets/images/banner/' . $value['b_location'] . '"/>'; ?>
                    </a>
                <?php
            }else {
                echo '<span>';
                echo $value['b_code'];
                echo '</span>';
            }
            ?>
            <a href="#" title="" class="x-btn"><img src="./assets/site/images/close.gif" alt="banner close"></a>
            <?php
        }
    }
}
?>

</div>

<style>
    .body-ad-bottom {
            position: fixed;
            bottom: -15px;
            width: 100%;
            z-index: 100;
            text-align: center;
            background:rgba(0,0,0,.3);
        }
        
        .body-ad-bottom .x-btn {
            position: absolute
        }
        
        .body-ad-bottom .x-btn img {
            width: 18px
        }
        
        .body-ad-bottom .x-btn {
            right: 15px;
            top: -11px
        }
</style>