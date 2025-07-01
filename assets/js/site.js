$(document).ready(function(){
    refresh_files()
});
$(function() {
    $('#upload_file').submit(function(e) {
        e.preventDefault();
        $.ajaxFileUpload({
            url         :'./admin/upload/upload_file/',
            secureuri      :false,
            fileElementId  :'userfile',
            dataType    : 'json',
            data        : {
                'caption'           : $('#caption').val(),
                'c_id'                : $('#c_id').val()
            },
            success  : function (data, status)
            {
                if(data.status != 'error')
                {
                    $('#files').html('<p>Reloading files...</p>');
                    refresh_files();
                    $('#caption').val('');
                }
                alert(data.msg);
            }
        });
        return false;
    });
    $('.delete_file_link').live('click', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this file?'))
        {
            var link = $(this);
            $.ajax({
                url         : './admin/upload/delete_file/' + link.data('file_id'),
                dataType : 'json',
                success     : function (data)
                {
                    files = $(files);
                    if (data.status === "success")
                    {
                        link.parents('li').fadeOut('fast', function() {
                            $(this).remove();
                            if (files.find('li').length == 0)
                            {
                                files.html('<p>No Files Uploaded</p>');
                            }
                        });
                    }
                    else
                    {
                        alert(data.msg);
                    }
                }
            });
        }
    });    
});

function refresh_files()
{
    //var cat = $(this);
    $.get('./admin/upload/files/'+ $('#c_id').val())
    .success(function (data){
        $('#files').html(data);
    });
}
function selectText(containerid) {
    if (document.selection) {
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select();
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().addRange(range);
    }
}
function d_news()
{
   
    $.get('./admin/news/new_display/'+ $('#cat_id').val() + '/'+$('#nd').val())
    .success(function (data){
        $("#news").hide("slow");
        $('#news_list').html(data);
    });
}

function newschange_print()
{
   
    $.get('./print/news/new_display/'+ $('#cat_id').val() + '/'+$('#nd').val())
    .success(function (data){
        $("#news").hide("slow");
        $('#news_list').html(data);
    });
}
