
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>News Form</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            </div>
        </div>
        <div class="box-content">
            <?php echo form_open_multipart('admin/news/add/' . $category_id, 'class="form-horizontal"'); ?>          
            <fieldset>
                <legend><?php echo $cat_name; ?></legend>                
               <div id="accordion2" class="accordion">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#headlines" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                Head Lines
                            </a>
                        </div>
                        <div class="accordion-body in collapse" id="headlines">
                            <div class="accordion-inner">
                                <div class="control-group">
                                    <label class="control-label" >News Solder</label>
                                    <div class="controls">                        
                                        <textarea name="n_solder" id="n_solder"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" >News Head</label>
                                    <div class="controls">
                                        <textarea name="n_head" id="n_head"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" >News Sub Head</label>
                                    <div class="controls">                        
                                        <textarea name="n_subhead" id="n_subhead"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="n_details">News Details </label>
                    <div class="controls">
                        <textarea name="n_details"  id="maineditor" class="n_details"></textarea>
                    </div>
                </div>

               <div class="control-group">
                    <label class="control-label" >Select Related  Tags</label>
                    <div class="controls">
                        <input name="n_related" type="text" class="input-xlarge focused" id="n_related">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" >Author List</label>
                    <div class="controls">
                        <select id="n_writer" data-rel="chosen" name="n_writer">
                            <option value="0">None</option>
                            
                        </select>
                    </div>
                </div>

                <?php
                if ($subcategory != NULL) {
                    ?>
                    <div class="control-group">
                        <label class="control-label" >Sub Category</label>
                        <div class="controls">
                            <select id="n_sub_category" data-rel="chosen" name="n_sub_category">
                                <option value="0">None</option>
                                <?php
                                foreach ($subcategory as $key => $subcat) {
                                    echo '<option value="' . $subcat['m_id'] . '">' . $subcat['m_bangla'] . '</option>' . "\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                }
                ?>


                <div id="accordion2" class="accordion">
                    <!-- Source line -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#collapseTwo" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                Source line
                            </a>
                        </div>
                        <div class="accordion-body in collapse" id="collapseTwo" style="height: auto;">
                            <div class="accordion-inner">
                                <div class="control-group ">
                                    <div class="controls">                                        
                                        <label class="radio">
                                            <input type="radio" checked="" value="Designation default" id="source_line" name="source_line">
                                            <span data-original-title="Ex: নিজস্ব প্রতিবেদক" data-placement="bottom" rel="tooltip" class="cms-tooltip">নিজস্ব প্রতিবেদক</span>
                                        </label> 
                                        <label class="radio">
                                            <input type="radio" value="Online Desk" id="source_line" name="source_line">
                                            <span data-original-title="Ex: অনলাইন ডেস্ক" data-placement="bottom" rel="tooltip" class="cms-tooltip">অনলাইন ডেস্ক</span>
                                        </label>

                                        <label class="radio">
                                            <input type="radio" value="Press release" id="source_line" name="source_line">
                                            <span data-original-title="Ex: প্রেস বিজ্ঞপ্তি" data-placement="bottom" rel="tooltip" class="cms-tooltip">প্রেস বিজ্ঞপ্তি</span>
                                        </label>
                                        
                                        <label class="radio">
                                            <input type="radio" value="Staff reporter" id="source_line" name="source_line">
                                            <span data-original-title="Ex: স্টাফ  রিপোর্টার" data-placement="bottom" rel="tooltip" class="cms-tooltip">স্টাফ  রিপোর্টার</span>
                                        </label>
                                        <label class="radio">
                                            <input type="radio" value="Not defined" id="source_line" name="source_line">
                                            <span data-original-title="Ex: Not Defined" data-placement="bottom" rel="tooltip" class="cms-tooltip">None</span>
                                        </label>
                                        <label class="radio">
                                            <input type="radio" value="Other" id="source_line" name="source_line">
                                            <span data-original-title="Ex: অন্যান্য" data-placement="bottom" rel="tooltip" class="cms-tooltip">অন্যান্য</span>
                                            <input type="text" placeholder="" value="" name="source_line_more" id="source_line_more">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Source line -->



                    <!-- Publishing date -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#publishing_date" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                Publishing date
                            </a>
                        </div>
                        <div class="accordion-body collapse" id="publishing_date">
                            <div class="accordion-inner">
                                <div class="control-group">
                                    <label for="start_publishing" class="control-label">Start publishing:</label>
                                    <div style="display: inherit;" data-date-format="dd M yyyy hh:ii:ss" class="controls input-append date form_datetime">
                                        <input type="text" value="" readonly="readonly" class="span2" name="start_publishing" id="start_publishing">
                                        <span class="add-on"><i class="icon-remove"></i></span>
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <!-- End publishing date -->

                    <!-- Image -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#article_image" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                Picture
                            </a>
                        </div>
                        <div class="accordion-body collapse" id="article_image" style="height: 0px;">
                            <div class="accordion-inner">
                                <div class="control-group ">
                                    <div class="controls">
                                        <div data-provides="fileupload" class="fileupload fileupload-new">
                                            <div class="fileupload-new thumbnail"><img width="238" height="125" style="height: 125px;" src="./assets/importent_images/no-image.gif"></div>
                                            <div style="width: 238px; height: 195px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                            <div>
                                                <span class="btn btn-file">
                                                    <span class="fileupload-new">Select an image</span>
                                                    <span class="fileupload-exists">Change</span>
                                                    <input type="file" name="picture">
                                                </span>
                                                <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Caption</label>
                                    <div class="controls">
                                        <textarea name="n_caption" id="n_caption" ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <!-- End image -->

                    <!-- Others options -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#others_options" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                Others options
                            </a>
                        </div>
                        <div class="accordion-body collapse" id="others_options">
                            <div class="accordion-inner">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio inline"> Live News: </label>
                                        <label class="radio inline">
                                            <input type="radio" value="yes" id="live_news" name="live_news"> Yes
                                        </label>
                                        <label class="radio inline">
                                            <input type="radio" checked="" value="no" id="live_news" name="live_news"> No
                                        </label>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio inline"> Latest news: </label>
                                        <label class="radio inline">
                                            <input type="radio" checked="" value="yes" id="latest_news" name="latest_news"> Yes
                                        </label> 
                                        <label class="radio inline">
                                            <input type="radio" value="no" id="latest_news" name="latest_news"> No
                                        </label>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio inline"> Video Contains: </label>
                                        <label class="radio inline">
                                            <input type="radio" value="yes" id="n_video" name="n_video"> Yes
                                        </label>
                                        <label class="radio inline">
                                            <input type="radio" checked="" value="no" id="n_video" name="n_video"> No
                                        </label>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- End Others options -->

                    <!-- Display position -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#display_position" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                Display position
                            </a>
                        </div>
                        <div class="accordion-body collapse" id="display_position">
                            <div class="accordion-inner">
                                <div class="control-group ">
                                    <div class="controls">
                                        <label class="checkbox">
                                            <input type="checkbox" value="10" id="page_position" name="page_position[]" checked=""> Category lead item                                                                                                    
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" value="13" id="page_position" name="page_position[]"> Home lead                                                                                                    
                                        </label>
                                        
                                        <!--<label class="checkbox">-->
                                        <!--    <input type="checkbox" value="14" id="page_position" name="page_position[]"> Top 4 News                                                                                                   -->
                                        <!--</label>-->
                                        
                                        <label class="checkbox">
                                            <input type="checkbox" value="16" id="page_position" name="page_position[]"> Headlines                                                                                                    
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" value="21" id="page_position" name="page_position[]"> Highlights                                                                                                    
                                        </label>
										 
                                        <label class="checkbox">
                                        <input type="checkbox" value="17" id="page_position" name="page_position[]" checked=""> Home News
                                        </label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Display position -->


                    <!-- Meta keywords -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#metaTags" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                Meta keywords
                            </a>
                        </div>
                        <div class="accordion-body collapse" id="metaTags">
                            <div class="accordion-inner">
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="text" placeholder="Add tags" data-role="tagsinput" value="" id="meta_keywords" name="meta_keywords">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end meta tags -->

                    <!--  Meta description -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#metaDescription" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                Meta description
                            </a>
                        </div>
                        <div class="accordion-body collapse" id="metaDescription">
                            <div class="accordion-inner">
                                <div class="control-group ">
                                    <div class="controls">
                                        <textarea rows="6" id="meta_description" name="meta_description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end  Meta description -->


                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#collapseStatus" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                Article Status
                            </a>
                        </div>
                        <div class="accordion-body collapse" id="collapseStatus">
                            <div class="accordion-inner">
                                <div class="control-group">
                                    <div class="controls">   
                                        <?php if ($this->session->userdata('tag') != 'user') { ?>
                                            <label class="radio">
                                                <input type="radio" value="1" id="n_status" name="n_status">  Save as Draft</label>
                                            <label class="radio">
                                                <input type="radio" value="2" id="n_status" name="n_status">  Submit</label>
                                            <label class="radio">
                                                <input type="radio" checked="" value="3" id="n_status" name="n_status">  Publish</label>
                                            <?php
                                        } else {
                                            ?>
                                            <label class="radio">
                                                <input type="radio" checked="" value="1" id="n_status" name="n_status">  Save as Draft</label>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                 <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#embedded_code" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                Embed Code
                            </a>
                        </div>
                        <div class="control-group">
                            <div class="accordion-body collapse" id="embedded_code">
                                <div class="accordion-inner">
                                    <div class="control-group">
                                        <label class="control-label" >Embed Code</label>
                                            <div class="controls">
                                                <textarea rows="3" name="embed" type="text" class="input-xlarge focused" id="embed"></textarea> 
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>






                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add News</button>
                    <button type="reset" class="btn">Clear</button>
                </div>
            </fieldset>
            <?php echo '</form>'; ?>   

        </div>
    </div><!--/span-->
</div>

<script src="<?= base_url("assets/tinymce/js/tinymce/tinymce.min.js"); ?>"></script>
<script>

var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

tinymce.init({
  selector: 'textarea#maineditor',
  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons responsivefilemanager',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | responsivefilemanager insertfile image media template link anchor codesample | ltr rtl',
  toolbar_sticky: true,
  autosave_ask_before_unload: true,
  autosave_interval: '30s',
  autosave_prefix: '{path}{query}-{id}-',
  autosave_restore_when_empty: false,
  autosave_retention: '2m',
  image_advtab: true,
  link_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_class_list: [
    { title: 'None', value: '' },
    { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
//   file_picker_callback: function (callback, value, meta) {
//     /* Provide file and text for the link dialog */
//     if (meta.filetype === 'file') {
//       callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
//     }

//     /* Provide image and alt text for the image dialog */
//     if (meta.filetype === 'image') {
//       callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
//     }

//     /* Provide alternative source and posted for the media dialog */
//     if (meta.filetype === 'media') {
//       callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
//     }
//   },
  templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 400,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: 'mceNonEditable',
  toolbar_mode: 'sliding',
  contextmenu: 'link image imagetools table',
  skin: useDarkMode ? 'oxide-dark' : 'oxide',
  content_css: useDarkMode ? 'dark' : 'default',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
  
    filemanager_access_key: "<?php echo '67rtfvoaea47dd75a98304083ec2fcf624aa783'.date('y'); ?>" ,
   external_filemanager_path:"<?php echo base_url(); ?>assets/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" : "/assets/filemanager/plugin.min.js"}
 });


</script>
<script type="text/javascript">
    // CKEDITOR.replace('n_details');
</script>
