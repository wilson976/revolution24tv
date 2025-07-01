<select name="city" id="city" data-rel="chosen"> 
    <option value="none">None</option>
    <?php
    foreach ($city as $key => $val) {
        echo "<option value=" . $val['place_id'] . ">" . $val['place_name'] . '</option>' . "\n";
    }
    ?>
</select>