<script  src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Vote Result</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <?php echo form_open('admin/vote_module/save_vote/', 'class="form-horizontal"'); ?>          
            <fieldset>

                <div class="control-group">

                    <label class="control-label" for="District">District</label>
                    <div class="controls">
                        <select name="district">
                            <option value="">--Select--</option>
                            <option value="8682">পঞ্চগড়</option>
                            <option value="8684">ঠাকুরগাঁও</option>
                            <option value="8677">দিনাজপুর</option>
                            <option value="8681">নীলফামারী</option>
                            <option value="8680">লালমনিরহাট</option>
                            <option value="8689">রংপুর</option>
                            <option value="8679">কুড়িগ্রাম</option>
                            <option value="8678">গাইবান্ধা</option>
                            <option value="8670">জয়পুরহাট</option>
                            <option value="8671">নওগাঁ</option>
                            <option value="8673">চাঁপাইনবাবগঞ্জ</option>
                            <option value="8675">রাজশাহী</option>
                            <option value="8672">নাটোর</option>
                            <option value="8669">বগুড়া</option>
                            <option value="8676">সিরাজগঞ্জ</option>
                            <option value="8674">পাবনা</option>
                            <option value="8659">কুষ্টিয়া</option>
                            <option value="8662">মেহেরপুর</option>
                            <option value="8655">চুয়াডাঙ্গা</option>
                            <option value="8657">ঝিনাইদহ</option>
                            <option value="8651">রাজবাড়ী</option>
                            <option value="8660">মাগুরা</option>
                            <option value="8642">ফরিদপুর</option>
                            <option value="8656">যশোর</option>
                            <option value="8663">নড়াইল</option>
                            <option value="8644">গোপালগঞ্জ</option>
                            <option value="8646">মাদারীপুর</option>
                            <option value="8652">শরীয়তপুর</option>
                            <option value="8625">বরিশাল</option>
                            <option value="8629">পিরোজপুর</option>
                            <option value="8654">বাগেরহাট</option>
                            <option value="8627">ঝালকাঠি</option>
                            <option value="8628">পটুয়াখালী</option>
                            <option value="8624">বরগুনা</option>
                            <option value="8664">সাতক্ষীরা</option>
                            <option value="8658">খুলনা</option>
                            <option value="8668">শেরপুর</option>
                            <option value="8665">জামালপুর</option>
                            <option value="8666">ময়মনসিংহ</option>
                            <option value="8667">নেত্রকোনা</option>
                            <option value="8687">সুনামগঞ্জ</option>
                            <option value="8688">সিলেট</option>
                            <option value="8686">মৌলভীবাজার</option>
                            <option value="8685">হবিগঞ্জ</option>
                            <option value="8645">কিশোরগঞ্জ</option>
                            <option value="8643">গাজীপুর</option>
                            <option value="8653">টাঙ্গাইল</option>
                            <option value="8647">মানিকগঞ্জ</option>
                            <option value="8641">ঢাকা</option>
                            <option value="8650">নরসিংদী</option>
                            <option value="8649">নারায়ণগঞ্জ</option>
                            <option value="8631">ব্রাহ্মণবাড়িয়া</option>
                            <option value="8634">কুমিল্লা</option>
                            <option value="8648">মুন্সিগঞ্জ</option>
                            <option value="8632">চাঁদপুর</option>
                            <option value="8638">লক্ষ্মীপুর</option>
                            <option value="8636">ফেনী</option>
                            <option value="8639">নোয়াখালী</option>
                            <option value="8626">ভোলা</option>
                            <option value="8637">খাগড়াছড়ি</option>
                            <option value="8640">রাঙামাটি</option>
                            <option value="8633">চট্টগ্রাম</option>
                            <option value="8635">কক্সবাজার</option>
                            <option value="8630">বান্দরবান</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="seat">Seat</label>
                    <div class="controls">
                        <select name="seat">
                            <option value="">--Select--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="area">Area Name</label>
                    <div class="controls">
                        <input type="text" name="area" value="">
                    </div>
                </div>
                
                
                <!--<div class="control-group">-->
                <!--    <label class="control-label" for="awamileague">Party</label>-->
                <!--    <div class="controls">-->
                <!--        <select name="party">-->
                <!--            <option value="">--Select--</option>-->
                <!--            <option value="আওয়ামী লীগ">আওয়ামী লীগ</option>-->
                <!--            <option value="বিএনপি">বিএনপি</option>-->
                <!--            <option value="জাতীয় পাটি">জাতীয় পাটি</option>-->
                <!--            <option value="স্বতন্ত্র">স্বতন্ত্র</option>-->
                <!--            <option value="অন্যান্য">অন্যান্য</option>-->
                <!--        </select>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="control-group">
                    <label class="control-label" for="al">Awamilig</label>
                    <div class="controls">
                        <input type="text" name="al" value=""> **No of votes
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="bnp">BNP</label>
                    <div class="controls">
                        <input type="text" name="bnp" value="">**No of votes
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="jatiyo">Jatiyo</label>
                    <div class="controls">
                        <input type="text" name="jatiyo" value="">**No of votes
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sotontro">Sotontro</label>
                    <div class="controls">
                        <input type="text" name="sotontro" value="">**No of votes
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="others">Others</label>
                    <div class="controls">
                        <input type="text" name="others" value="">**No of votes
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Vote" >Description</label>
                    <div class="controls">
                        <textarea name="details" style="width:80%"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="area">Winner</label>
                    <div class="controls">
                        <input type="text" name="winner" value="">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save Result</button>
                    <button type="reset" class="btn">Clear</button>
                </div>

            </fieldset>
            </form>   

        </div>

    </div><!--/span-->
</div>

<div class="row-fluid sortable">    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-folder-open"></i> Vote </h2>
            <div class="box-icon">                
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>                
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>District</th>
                        <th>Seat</th>
                        <th>Area</th>                        
                        <th>Awamilig</th> 
                        <th>BNP</th> 
                        <th>Jatiyo</th> 
                        <th>sotontro</th> 
                        <th>others</th>
                        <th>Action</th>
                    </tr>
                </thead>   
                <tbody>
                    <?php
                    if ($gettext != NULL) {
                        $i = 1;
                        $dist = [8682=>'পঞ্চগড়',8684=>'ঠাকুরগাঁও',8677=>'দিনাজপুর',8681=>'নীলফামারী',8680=>'লালমনিরহাট',8689=>'রংপুর',8679=>'কুড়িগ্রাম',8678=>'গাইবান্ধা',8670=>'জয়পুরহাট',8671=>'নওগাঁ',8673=>'চাঁপাইনবাবগঞ্জ',8675=>'রাজশাহী',8672=>'নাটোর',8669=>'বগুড়া',8676=>'সিরাজগঞ্জ',8674=>'পাবনা',8659=>'কুষ্টিয়া',8662=>'মেহেরপুর',8655=>'চুয়াডাঙ্গা',8657=>'ঝিনাইদহ',8651=>'রাজবাড়ী',8660=>'মাগুরা',8642=>'ফরিদপুর',8656=>'যশোর',8663=>'নড়াইল',8644=>'গোপালগঞ্জ',8646=>'মাদারীপুর',8652=>'শরীয়তপুর',8625=>'বরিশাল',8629=>'পিরোজপুর',8654=>'বাগেরহাট',8627=>'ঝালকাঠি',8628=>'পটুয়াখালী',8624=>'বরগুনা',8664=>'সাতক্ষীরা',8658=>'খুলনা',8668=>'শেরপুর',8665=>'জামালপুর',8666=>'ময়মনসিংহ',8667=>'নেত্রকোনা',8687=>'সুনামগঞ্জ',8688=>'সিলেট',8686=>'মৌলভীবাজার',8685=>'হবিগঞ্জ',8645=>'কিশোরগঞ্জ',8643=>'গাজীপুর',8653=>'টাঙ্গাইল',8647=>'মানিকগঞ্জ',8641=>'ঢাকা',8650=>'নরসিংদী',8649=>'নারায়ণগঞ্জ',8631=>'ব্রাহ্মণবাড়িয়া',8634=>'কুমিল্লা',8648=>'মুন্সিগঞ্জ',8632=>'চাঁদপুর',8638=>'লক্ষ্মীপুর',8636=>'ফেনী',8639=>'নোয়াখালী',8626=>'ভোলা',8637=>'খাগড়াছড়ি',8640=>'রাঙামাটি',8633=>'চট্টগ্রাম',8635=>'কক্সবাজার',8630=>'বান্দরবান'];
                        foreach ($gettext as $row):
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="center"><?php echo $dist[$row['dist']];?></td>
                                <td class="center"><?php echo $row['seat']; ?></td>
                                <td class="center"><?php echo $row['area']; ?></td>
                                <td class="center"><?php echo $row['al']; ?></td>
                                <td class="center"><?php echo $row['bnp']; ?></td>
                                <td class="center"><?php echo $row['jatiyo']; ?></td>
                                <td class="center"><?php echo $row['sotontro']; ?></td>
                                <td class="center"><?php echo $row['others']; ?></td>
                                <td class="center">
                                    <a class="btn btn-primary" href="admin/vote_module/vote_edit/<?php echo $row['id']; ?>">Edit</a>
                                    <a class="btn btn-primary" href="admin/vote_module/vote_delete/<?php echo $row['id']; ?>">Delete</a>
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
<script type="text/javascript">
    CKEDITOR.replace('details');
</script>




