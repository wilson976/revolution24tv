
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Edit News Live</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            </div>
        </div>
        <div class="box-content">
            <?php echo form_open_multipart('admin/news/edit_live/' . $news_id.'/'.$live_id, 'class="form-horizontal"'); ?>          
            <fieldset>
                <legend><?php echo $edit_data['n_head']; ?></legend>  
                
                
                <div class="control-group">
                    <label class="control-label" for="n_details">Title </label>
                    <div class="controls">
                        <textarea name="n_head_live"><?php echo $live_data['new_head']; ?></textarea>
                    </div>
                </div>
                
                
                <div class="control-group">
                    <label class="control-label" for="n_details">Details </label>
                    <div class="controls">
                        <textarea name="n_details_live" id="maineditor" class="n_details"><?php echo $live_data['new_details']; ?></textarea>
                    </div>
                </div>
                
                <input type="hidden" name="ref_news" value="<?php echo $news_id; ?>" />


                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update News</button>
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
  
    filemanager_access_key: "<?php echo date('m').'67rtfvoaea47dd75a98304083ec2fcf624aa783'.date('y'); ?>" ,
   external_filemanager_path:"<?php echo base_url(); ?>filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
 });


</script>
