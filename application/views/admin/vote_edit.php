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
            <?php echo form_open('admin/vote_module/vote_edit/'.$getvote['id'], 'class="form-horizontal"'); ?>          
            <fieldset>

                <div class="control-group">

                    <label class="control-label" for="District">District</label>
                    <div class="controls">
                        <select name="district">
                            <option <?php if($getvote['dist'] == '8682'){ echo 'selected';} ?> value="8682">পঞ্চগড়</option>
                            <option <?php if($getvote['dist'] == '8684'){ echo 'selected';} ?> value="8684">ঠাকুরগাঁও</option>
                            <option <?php if($getvote['dist'] == '8677'){ echo 'selected';} ?> value="8677">দিনাজপুর</option>
                            <option <?php if($getvote['dist'] == '8681'){ echo 'selected';} ?> value="8681">নীলফামারী</option>
                            <option <?php if($getvote['dist'] == '8680'){ echo 'selected';} ?> value="8680">লালমনিরহাট</option>
                            <option <?php if($getvote['dist'] == '8689'){ echo 'selected';} ?> value="8689">রংপুর</option>
                            <option <?php if($getvote['dist'] == '8679'){ echo 'selected';} ?> value="8679">কুড়িগ্রাম</option>
                            <option <?php if($getvote['dist'] == '8678'){ echo 'selected';} ?> value="8678">গাইবান্ধা</option>
                            <option <?php if($getvote['dist'] == '8670'){ echo 'selected';} ?> value="8670">জয়পুরহাট</option>
                            <option <?php if($getvote['dist'] == '8671'){ echo 'selected';} ?> value="8671">নওগাঁ</option>
                            <option <?php if($getvote['dist'] == '8673'){ echo 'selected';} ?> value="8673">চাঁপাইনবাবগঞ্জ</option>
                            <option <?php if($getvote['dist'] == '8675'){ echo 'selected';} ?> value="8675">রাজশাহী</option>
                            <option <?php if($getvote['dist'] == '8672'){ echo 'selected';} ?> value="8672">নাটোর</option>
                            <option <?php if($getvote['dist'] == '8669'){ echo 'selected';} ?> value="8669">বগুড়া</option>
                            <option <?php if($getvote['dist'] == '8676'){ echo 'selected';} ?> value="8676">সিরাজগঞ্জ</option>
                            <option <?php if($getvote['dist'] == '8674'){ echo 'selected';} ?> value="8674">পাবনা</option>
                            <option <?php if($getvote['dist'] == '8659'){ echo 'selected';} ?> value="8659">কুষ্টিয়া</option>
                            <option <?php if($getvote['dist'] == '8662'){ echo 'selected';} ?> value="8662">মেহেরপুর</option>
                            <option <?php if($getvote['dist'] == '8655'){ echo 'selected';} ?> value="8655">চুয়াডাঙ্গা</option>
                            <option <?php if($getvote['dist'] == '8657'){ echo 'selected';} ?> value="8657">ঝিনাইদহ</option>
                            <option <?php if($getvote['dist'] == '8651'){ echo 'selected';} ?> value="8651">রাজবাড়ী</option>
                            <option <?php if($getvote['dist'] == '8660'){ echo 'selected';} ?> value="8660">মাগুরা</option>
                            <option <?php if($getvote['dist'] == '8642'){ echo 'selected';} ?> value="8642">ফরিদপুর</option>
                            <option <?php if($getvote['dist'] == '8656'){ echo 'selected';} ?> value="8656">যশোর</option>
                            <option <?php if($getvote['dist'] == '8663'){ echo 'selected';} ?> value="8663">নড়াইল</option>
                            <option <?php if($getvote['dist'] == '8644'){ echo 'selected';} ?> value="8644">গোপালগঞ্জ</option>
                            <option <?php if($getvote['dist'] == '8646'){ echo 'selected';} ?> value="8646">মাদারীপুর</option>
                            <option <?php if($getvote['dist'] == '8652'){ echo 'selected';} ?> value="8652">শরীয়তপুর</option>
                            <option <?php if($getvote['dist'] == '8625'){ echo 'selected';} ?> value="8625">বরিশাল</option>
                            <option <?php if($getvote['dist'] == '8629'){ echo 'selected';} ?> value="8629">পিরোজপুর</option>
                            <option <?php if($getvote['dist'] == '8654'){ echo 'selected';} ?> value="8654">বাগেরহাট</option>
                            <option <?php if($getvote['dist'] == '8627'){ echo 'selected';} ?> value="8627">ঝালকাঠি</option>
                            <option <?php if($getvote['dist'] == '8628'){ echo 'selected';} ?> value="8628">পটুয়াখালী</option>
                            <option <?php if($getvote['dist'] == '8624'){ echo 'selected';} ?> value="8624">বরগুনা</option>
                            <option <?php if($getvote['dist'] == '8664'){ echo 'selected';} ?> value="8664">সাতক্ষীরা</option>
                            <option <?php if($getvote['dist'] == '8658'){ echo 'selected';} ?> value="8658">খুলনা</option>
                            <option <?php if($getvote['dist'] == '8668'){ echo 'selected';} ?> value="8668">শেরপুর</option>
                            <option <?php if($getvote['dist'] == '8665'){ echo 'selected';} ?> value="8665">জামালপুর</option>
                            <option <?php if($getvote['dist'] == '8666'){ echo 'selected';} ?> value="8666">ময়মনসিংহ</option>
                            <option <?php if($getvote['dist'] == '8667'){ echo 'selected';} ?> value="8667">নেত্রকোনা</option>
                            <option <?php if($getvote['dist'] == '8687'){ echo 'selected';} ?> value="8687">সুনামগঞ্জ</option>
                            <option <?php if($getvote['dist'] == '8688'){ echo 'selected';} ?> value="8688">সিলেট</option>
                            <option <?php if($getvote['dist'] == '8686'){ echo 'selected';} ?> value="8686">মৌলভীবাজার</option>
                            <option <?php if($getvote['dist'] == '8685'){ echo 'selected';} ?> value="8685">হবিগঞ্জ</option>
                            <option <?php if($getvote['dist'] == '8645'){ echo 'selected';} ?> value="8645">কিশোরগঞ্জ</option>
                            <option <?php if($getvote['dist'] == '8643'){ echo 'selected';} ?> value="8643">গাজীপুর</option>
                            <option <?php if($getvote['dist'] == '8653'){ echo 'selected';} ?> value="8653">টাঙ্গাইল</option>
                            <option <?php if($getvote['dist'] == '8647'){ echo 'selected';} ?> value="8647">মানিকগঞ্জ</option>
                            <option <?php if($getvote['dist'] == '8641'){ echo 'selected';} ?> value="8641">ঢাকা</option>
                            <option <?php if($getvote['dist'] == '8650'){ echo 'selected';} ?> value="8650">নরসিংদী</option>
                            <option <?php if($getvote['dist'] == '8649'){ echo 'selected';} ?> value="8649">নারায়ণগঞ্জ</option>
                            <option <?php if($getvote['dist'] == '8631'){ echo 'selected';} ?> value="8631">ব্রাহ্মণবাড়িয়া</option>
                            <option <?php if($getvote['dist'] == '8634'){ echo 'selected';} ?> value="8634">কুমিল্লা</option>
                            <option <?php if($getvote['dist'] == '8648'){ echo 'selected';} ?> value="8648">মুন্সিগঞ্জ</option>
                            <option <?php if($getvote['dist'] == '8632'){ echo 'selected';} ?> value="8632">চাঁদপুর</option>
                            <option <?php if($getvote['dist'] == '8638'){ echo 'selected';} ?> value="8638">লক্ষ্মীপুর</option>
                            <option <?php if($getvote['dist'] == '8636'){ echo 'selected';} ?> value="8636">ফেনী</option>
                            <option <?php if($getvote['dist'] == '8639'){ echo 'selected';} ?> value="8639">নোয়াখালী</option>
                            <option <?php if($getvote['dist'] == '8626'){ echo 'selected';} ?> value="8626">ভোলা</option>
                            <option <?php if($getvote['dist'] == '8637'){ echo 'selected';} ?> value="8637">খাগড়াছড়ি</option>
                            <option <?php if($getvote['dist'] == '8640'){ echo 'selected';} ?> value="8640">রাঙামাটি</option>
                            <option <?php if($getvote['dist'] == '8633'){ echo 'selected';} ?> value="8633">চট্টগ্রাম</option>
                            <option <?php if($getvote['dist'] == '8635'){ echo 'selected';} ?> value="8635">কক্সবাজার</option>
                            <option <?php if($getvote['dist'] == '8630'){ echo 'selected';} ?> value="8630">বান্দরবান</option>

                        </select>
                    </div>
                </div>
                <div class="control-group">

                    <label class="control-label" for="seat">Seat</label>
                    <div class="controls">
                        <select name="seat">
                            <option value="">--Select--</option>
                            <option <?php if($getvote['seat'] == '1'){ echo 'selected';} ?> value="1">1</option>
                            <option <?php if($getvote['seat'] == '2'){ echo 'selected';} ?> value="2">2</option>
                            <option <?php if($getvote['seat'] == '3'){ echo 'selected';} ?> value="3">3</option>
                            <option <?php if($getvote['seat'] == '4'){ echo 'selected';} ?> value="4">4</option>
                            <option <?php if($getvote['seat'] == '5'){ echo 'selected';} ?> value="5">5</option>
                            <option <?php if($getvote['seat'] == '6'){ echo 'selected';} ?> value="6">6</option>
                            <option <?php if($getvote['seat'] == '7'){ echo 'selected';} ?> value="7">7</option>
                            <option <?php if($getvote['seat'] == '8'){ echo 'selected';} ?> value="8">8</option>
                            <option <?php if($getvote['seat'] == '9'){ echo 'selected';} ?> value="9">9</option>
                            <option <?php if($getvote['seat'] == '10'){ echo 'selected';} ?> value="10">10</option>
                            <option <?php if($getvote['seat'] == '11'){ echo 'selected';} ?> value="11">11</option>
                            <option <?php if($getvote['seat'] == '12'){ echo 'selected';} ?> value="12">12</option>
                            <option <?php if($getvote['seat'] == '13'){ echo 'selected';} ?> value="13">13</option>
                            <option <?php if($getvote['seat'] == '14'){ echo 'selected';} ?> value="14">14</option>
                            <option <?php if($getvote['seat'] == '15'){ echo 'selected';} ?> value="15">15</option>
                            <option <?php if($getvote['seat'] == '16'){ echo 'selected';} ?> value="16">16</option>
                            <option <?php if($getvote['seat'] == '17'){ echo 'selected';} ?> value="17">17</option>
                            <option <?php if($getvote['seat'] == '18'){ echo 'selected';} ?> value="18">18</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Vote">Area Name</label>
                    <div class="controls">
                        <input type="text" name="area" value="<?php echo $getvote['area']; ?>">
                    </div>
                </div>
               
                
                <!--<div class="control-group">-->

                <!--    <label class="control-label" for="awamileague">Party</label>-->
                <!--    <div class="controls">-->
                <!--        <select name="party">-->
                <!--            <option value="">--Select--</option>-->
                <!--            <option <?php //if($getvote['party'] == 'আওয়ামী লীগ'){ echo 'selected';} ?> value="আওয়ামী লীগ">আওয়ামী লীগ</option>-->
                <!--            <option <?php //if($getvote['party'] == 'বিএনপি'){ echo 'selected';} ?> value="বিএনপি">বিএনপি</option>-->
                <!--            <option <?php //if($getvote['party'] == 'জাতীয় পাট'){ echo 'selected';} ?> value="জাতীয় পাট">জাতীয় পাট</option>-->
                <!--            <option <?php //if($getvote['party'] == 'স্বতন্ত্র'){ echo 'selected';} ?> value="স্বতন্ত্র">স্বতন্ত্র</option>-->
                <!--            <option <?php //if($getvote['party'] == 'অন্যান্য'){ echo 'selected';} ?> value="অন্যান্য">অন্যান্য</option>-->
                <!--        </select>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="control-group">
                    <label class="control-label" for="Vote">Awamilig</label>
                    <div class="controls">
                        <input type="text" name="al" value="<?php echo $getvote['al']; ?>"> **No of votes
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="Vote">BNP</label>
                    <div class="controls">
                        <input type="text" name="bnp" value="<?php echo $getvote['bnp']; ?>"> **No of votes
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Vote">Jatiyo</label>
                    <div class="controls">
                        <input type="text" name="jatiyo" value="<?php echo $getvote['jatiyo']; ?>"> **No of votes
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Vote">Sotontro</label>
                    <div class="controls">
                        <input type="text" name="sotontro" value="<?php echo $getvote['sotontro']; ?>"> **No of votes
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Vote">Others</label>
                    <div class="controls">
                        <input type="text" name="others" value="<?php echo $getvote['others']; ?>"> **No of votes
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="Vote" >Description</label>
                    <div class="controls">
                        <textarea name="details" style="width:80%"><?php echo $getvote['details']; ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Vote">Winner</label>
                    <div class="controls">
                        <input type="text" name="winner" value="<?php echo $getvote['winner']; ?>">
                    </div>
                </div>

                <!--<div class="control-group">-->
                <!--    <label class="control-label" for="Vote">Vote</label>-->
                <!--    <div class="controls">-->
                <!--        <input type="text" name="vote" value="<?php echo $getvote['vote']; ?>">-->
                <!--    </div>-->
                <!--</div>-->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save Result</button>
                    <button type="reset" class="btn">Clear</button>
                </div>

            </fieldset>
            </form>   

        </div>

    </div><!--/span-->
</div>


<script type="text/javascript">
    CKEDITOR.replace('details');
</script>


