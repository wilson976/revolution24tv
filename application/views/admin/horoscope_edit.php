<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Horoscope</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>

        <div class="box-content">
            <?php echo form_open_multipart('admin/horoscope/update', 'class="form-horizontal"'); ?>            
            <fieldset>             
                <div class="control-group">
                    <label class="control-label" for="selectError">Select Horoscope</label>
                    <div class="controls">
                        <select name="h_type" id="h_type" data-rel="chosen">

                            <option value="aries" <?php if ($val['h_type'] == "aries") echo 'selected'; ?>>Aries</option>
                            <option value="taurus" <?php if ($val['h_type'] == "taurus") echo 'selected'; ?>>Taurus</option>
                            <option value="gemini" <?php if ($val['h_type'] == "gemini") echo 'selected'; ?>>Gemini</option>
                            <option value="cancer" <?php if ($val['h_type'] == "cancer") echo 'selected'; ?>>Cancer</option>
                            <option value="leo" <?php if ($val['h_type'] == "leo") echo 'selected'; ?>>Leo</option>
                            <option value="virgo" <?php if ($val['h_type'] == "virgo") echo 'selected'; ?>>Virgo</option>
                            <option value="libra" <?php if ($val['h_type'] == "libra") echo 'selected'; ?>>Libra</option>
                            <option value="scorpio" <?php if ($val['h_type'] == "scorpio") echo 'selected'; ?>>Scorpio</option>
                            <option value="sagittarius" <?php if ($val['h_type'] == "sagittarius") echo 'selected'; ?>>Sagittarius</option>
                            <option value="capricorn" <?php if ($val['h_type'] == "capricorn") echo 'selected'; ?>>Capricorn</option>
                            <option value="aquarius" <?php if ($val['h_type'] == "aquarius") echo 'selected'; ?>>Aquarius</option>
                            <option value="pisces" <?php if ($val['h_type'] == "pisces") echo 'selected'; ?>>Pisces</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="selectError">Category</label>
                    <div class="controls">
                        <select name="h_category" id="h_category" data-rel="chosen">
                            <option value="daily" <?php if ($val['h_category'] == "daily") echo 'selected'; ?>>Daily Horoscope</option>     
                            
                        </select>
                    </div>
                </div>


                
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Today's Description</label>
                    <div class="controls">                        
                        <textarea name="h_details" rows="7" class="input-xlarge focused" id="english"><?php echo $val['h_details']; ?></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            <?php
            echo form_close();
            ?>              
        </div>
    </div><!--/span-->  
</div>
