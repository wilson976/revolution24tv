/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    
    
    /* config.toolbar = 'ppm';

    config.toolbar_ppm = [
        {
            name: 'basicstyles', 
            items : [ 'Bold', 'Italic','Underline', 'Subscript', 'Superscript' ]
        },{
            name: 'paragraph', 
            items : ['JustifyLeft','JustifyCenter','JustifyRight' ]
        },{ name: 'styles', items : [ 'Styles','Format','Font','FontSize','TextColor' ] 
        },'/',{
            name: 'insert', 
            items : [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ]
        },{
            name: 'links', 
            items : [ 'Link','Unlink','Anchor','Iframe' ]
        },{
            name: 'document', 
            items : ['Source']
        }        
    ];
    */
       
  /*      
    config.toolbar = 'ppm';

    config.toolbar_ppm = [
    {
        name: 'basicstyles', 
        items : [ 'Bold', 'Italic','Underline', '-','RemoveFormat']
    },
{
        name: 'clipboard', 
        items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ]
    },
{
        name: 'paragraph', 
        items : [ 'NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight' ]
    },
    //{ name: 'styles', items : [ 'Styles','Format','Font','FontSize','TextColor' ] },
    '/',
    {
        name: 'insert', 
        items : [ 'Image','Flash','Link','Unlink','Anchor','-','Iframe' ]
    },
{
        name: 'links', 
        items : [ 'Link','Unlink','Anchor' ]
    },
{
        name: 'tools', 
        items : [ 'SpellChecker', 'Smiley' ]
    },
{
        name: 'document', 
        items : ['Source']
    }        
    ];*/
        
        
    config.filebrowserImageBrowseUrl = './assets/kcfinder/browse.php?type=images';
    config.filebrowserImageUploadUrl = './assets/kcfinder/upload.php?type=images';
	
};

