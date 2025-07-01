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
                            <option value="aries">মেষ</option>
                            <option value="taurus">বৃষ</option>
                            <option value="gemini">মিথুন</option>
                            <option value="cancer">কর্কট</option>
                            <option value="leo">সিংহ</option>
                            <option value="virgo">কন্যা</option>
                            <option value="libra">তুলা</option>
                            <option value="scorpio">বৃশ্চিক</option>
                            <option value="sagittarius">ধনু</option>
                            <option value="capricorn">মকর</option>
                            <option value="aquarius">কুম্ভ</option>
                            <option value="pisces">মীন</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="selectError">Category</label>
                    <div class="controls">
                        <select name="h_category" id="h_category" data-rel="chosen">
                            <option value="daily">Daily Horoscope</option>                         
                        </select>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="focusedInput">Today's Description</label>
                    <div class="controls">                        
                        <textarea name="h_details" rows="7" class="input-xlarge focused" id="english"></textarea>
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

<div class="row-fluid sortable">    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-folder-open"></i> Today's Horoscope</h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Horoscope</th>                        
                        <th>Details</th>                        
                        <th>Date Range</th>
                        <th>Last Update</th>
                        <th>Control</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($list != NULL) {
                        $i = 1;
                        foreach ($list as $row):
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="center">
                                    <?php
                                    if ($row['h_type'] == "aries") {
                                        echo 'aries';
                                    } elseif ($row['h_type'] == "taurus") {
                                        echo 'taurus';
                                    } elseif ($row['h_type'] == "gemini") {
                                        echo 'gemini';
                                    } elseif ($row['h_type'] == "cancer") {
                                        echo 'cancer';
                                    } elseif ($row['h_type'] == "leo") {
                                        echo 'leo';
                                    } elseif ($row['h_type'] == "virgo") {
                                        echo 'virgo';
                                    } elseif ($row['h_type'] == "libra") {
                                        echo 'libra';
                                    } elseif ($row['h_type'] == "scorpio") {
                                        echo 'scorpio';
                                    } elseif ($row['h_type'] == "sagittarius") {
                                        echo 'sagittarius';
                                    } elseif ($row['h_type'] == "capricorn") {
                                        echo 'capricorn';
                                    } elseif ($row['h_type'] == "aquarius") {
                                        echo 'aquarius';
                                    } elseif ($row['h_type'] == "pisces") {
                                        echo 'pisces';
                                    }
                                    ?>
                                </td>

                                <td class="center"><?php echo $row['h_details']; ?></td>                             
                                <td class="center"><?php echo $row['h_date']; ?></td>   
                                <td class="center"><?php echo $row['last_update']; ?></td>  
                                <td class="center">
                                    <a href="admin/horoscope/edit/<?php echo $row['h_id']; ?>">
                                        <span class="label label-warning"><i class="icon-edit icon-white"></i>Edit</span>             
                                    </a>       

                                </td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                    }
                    ?>                                                    
                </tbody>
            </table>              
        </div>
    </div><!--/span-->
</div>