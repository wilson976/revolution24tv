<?php
// echo $position;
if ($banner != NULL) {
    $bbbbb = array_keys(array_column($banner, 'b_position'), $position);
    $ad = [];
    foreach ($bbbbb as $key => $value) {
        $ad[] = $banner[$value];
    }
// print_r($ad);
////// slide ad start /////////////
    $slidead = array_keys(array_column($ad, 'b_type'), 'slide');


    if (!empty($slidead)) {
        $sad = [];
        foreach ($slidead as $key => $val) {
            $sad[] = $ad[$val];
        } ?>
        <style type="text/css">
            .slide-item{
                height: auto !important;
            }
            /*.carousel-inner .carousel-item {
              transition: -webkit-transform 6s ease;
              transition: transform 6s ease;
              transition: transform 6s ease, -webkit-transform 6s ease;
            }*/
            .slide-item img{
                width: auto !important;
            }
        </style>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"  data-interval="10000">
            <div class="carousel-inner" role="listbox">
        <?php foreach ($sad as $key => $vvv) { 
            if($vvv['b_repeat'] == NULL || $vvv['b_repeat'] == ''){

                if ($vvv['b_code'] == NULL || $vvv['b_code'] == '') {
                    if (filter_var($vvv['b_url'], FILTER_VALIDATE_URL))
                        $href = $vvv['b_url'];
                    else
                        $href = './assets/images/banner/linked-file/' . $vvv['b_link_location']
                    ?>
                    <div class="carousel-item slide-item <?php if($key == 0){echo 'active';} ?>">
                        <a href="<?php echo $href;?>" class="ad_cl" data-id="<?php echo $vvv['b_id'] ?>"  target="_blank">
                        <?php echo '<img class="nosharethis lazyload" src="./assets/importent_images/ad-loader.png?v=1.1" data-src="./assets/images/banner/' . $vvv['b_location'] . '" alt="' . $vvv['b_location'] . '"/>'; ?>
                        </a>
                    </div>

                <?php }else { ?>
                    <div class="carousel-item slide-item <?php if($key == 0){echo 'active';} ?>">
                    <?php echo '<div  class="ad_cl" data-id="'.$vvv['b_id'].'">';
                    echo $vvv['b_code'];
                    echo '</div>'; 
                    echo '</div>';
                }
            }else{
                $rep = explode('nd', $vvv['b_repeat']);
                if(in_array(date('Y-m-d'), $rep) || $vvv['b_repeat'] == 0){
                    if($vvv['start_time'] < date('H:i:s') and $vvv['end_time'] > date('H:i:s')){

                        if ($vvv['b_code'] == NULL || $vvv['b_code'] == '') {
                            if (filter_var($vvv['b_url'], FILTER_VALIDATE_URL))
                                $href = $vvv['b_url'];
                            else
                                $href = './assets/images/banner/linked-file/' . $vvv['b_link_location']
                            ?>
                            <div class="carousel-item slide-item <?php if($key == 0){echo 'active';} ?>">
                                <a href="<?php echo $href;?>" class="ad_cl" data-id="<?php echo $vvv['b_id'] ?>"  target="_blank">
                                <?php echo '<img class="nosharethis lazyload" src="./assets/importent_images/ad-loader.png?v=1.1" data-src="./assets/images/banner/' . $vvv['b_location'] . '" alt="' . $vvv['b_location'] . '"/>'; ?>
                                </a>
                            </div>

                        <?php }else { ?>
                            <div class="carousel-item slide-item <?php if($key == 0){echo 'active';} ?>">
                            <?php echo '<div  class="ad_cl" data-id="'.$vvv['b_id'].'">';
                            echo $vvv['b_code'];
                            echo '</div>';
                            echo '</div>';
                        }

                    }
                }
            }
        } ?>

            </div>
        </div>

    <?php }
 
////// slide ad end /////////////


///// other ad start ///////////////
    foreach ($ad as $key => $value) {
        if ($value['b_type'] != 'slide') {
            if($value['b_repeat'] == NULL || $value['b_repeat'] == ''){

                if ($value['b_type'] == 'image') {
                    if (filter_var($value['b_url'], FILTER_VALIDATE_URL))
                        $href = $value['b_url'];
                    else
                        $href = './assets/images/banner/linked-file/' . $value['b_link_location']
                    ?>
                    <div class="<?php if($value['b_position']=='desktop-details-mid-2'){ echo 'col-md-6 ';}elseif($value['b_column']==''){echo 'text-center';}elseif($value['b_column']=='2'){echo 'col-6 text-center ';} elseif($value['b_column']=='3'){echo 'col-4 text-center ';}else{echo 'col-12 text-center ';}?>ad_cl" data-id="<?php echo $value['b_id'] ?>">
                    <a href="<?php echo $href;?>"   target="_blank">
                    <?php echo '<img class="nosharethis lazyload" data-sssrc="./assets/importent_images/ad-loader.png?v=1.1" src="./assets/images/banner/' . $value['b_location'] . '" alt="' . $value['b_location'] . '"/>'; ?>
                    </a>
                    </div>

                <?php }elseif ($value['b_type'] == 'slider') { ?>







                <?php }else {
                    echo '<div  class="ad_cl" data-id="'.$value['b_id'].'">';
                    echo $value['b_code'];
                    echo '</div>';
                }
            }else{
                $rep = explode('nd', $value['b_repeat']);
                if(in_array(date('Y-m-d'), $rep) || $value['b_repeat'] == 0){
                    if($value['start_time'] < date('H:i:s') and $value['end_time'] > date('H:i:s')){

                        if ($value['b_type'] == 'image') {
                            if (filter_var($value['b_url'], FILTER_VALIDATE_URL))
                                $href = $value['b_url'];
                            else
                                $href = './assets/images/banner/linked-file/' . $value['b_link_location']
                            ?>
                            <a href="<?php echo $href;?>" class="<?php if($value['b_position']=='desktop-details-mid-2'){ echo 'col-md-6 ';}elseif($value['b_column']==''){echo 'text-center';}elseif($value['b_column']=='2'){echo 'col-6 text-center ';} else{echo 'col-12 text-center ';}?>ad_cl" data-id="<?php echo $value['b_id'] ?>"  target="_blank">
                            <?php echo '<img class="nosharethis lazyload" src="./assets/importent_images/ad-loader.png?v=1.1" data-src="./assets/images/banner/' . $value['b_location'] . '" alt="' . $value['b_location'] . '"/>'; ?>
                            </a>

                        <?php }else {
                            echo '<div  class="ad_cl" data-id="'.$value['b_id'].'">';
                            echo $value['b_code'];
                            echo '</div>';
                        }

                    }
                }
            }
        }else{




        }
    }
}
?>
<style>
    .ad_cl img{
        margin-bottom:15px;
    }
    .ad_cl{
        text-align:center;
    }
</style>