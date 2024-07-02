<html>
<head>
<link rel="stylesheet" href="default-html.css" />
<link rel="stylesheet" href="default-theme.css" />
<link rel="stylesheet" href="styles.css" />
<link rel="stylesheet" href="scripts/jquery.fancybox.css" />
<link rel="stylesheet" href="smoothness/jquery-ui-1.9.2.custom.min.css" />
<script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="scripts/jquery.fancybox.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="scripts/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function () {

    setInterval(function () {

        $.ajax({
            url: 'upload.php',
            type: 'POST',
            dataType: 'json',
            success: function (data) {

                var items = [];
                var html = '';

                $.each(data, function (key, val) {
                    $.each(val, function (key, val) {
					
                        if (val != 'vazio') {
                            fileReal = val.split('.');
                            fileMin = fileReal[1].split('_');
                            fileName = fileReal[0].split('/');
							
                            if (fileReal[1] == 'jpg') {
                                fileImage = val + '_min';
                                fileHref = fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'id="fancybox"';
                                fileTypeClass = 'image_box';
                            }
							else if (fileReal[1] == 'png') {
                                fileImage = 'images/icons/png.png';
                                fileHref = fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'id="fancybox"';
                                fileTypeClass = 'image_box';
                            }
							else if (fileReal[1] == 'gif') {
                                fileImage = 'images/icons/gif.png';
                                fileHref = fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'id="fancybox"';
                                fileTypeClass = 'image_box';
                            }
							else if (fileReal[1] == 'bmp') {
                                fileImage = 'images/icons/bmp.png';
                                fileHref = fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'id="fancybox"';
                                fileTypeClass = 'image_box';
                            }
                            else {
                                fileImage = 'images/icons/file.png';
                                fileHref = fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }

                            if (!fileMin[1]) {
                                html = '<li id="' + key + '" class="' + fileTypeClass + '">';
                                html += '<img id="mini" src="' + fileImage + '">';
                                html += '<a href="' + fileHref + '" ' + fileExecute + ' title="' + fileName[1] + '">';
                                html += '<p>' + fileName[1] + '</p>';
                                html += '</a><input type="checkbox" name="delete_select[]" value="' + fileReal[0] + '.' + fileReal[1] + '"></li>';

                                items.push(html);
                            }
                        }
                        else {
                            items.push(val);
                        }

                    });
                });

                if (items == 'vazio') {
                    $('#resultado ul').html('');
                }
                else if (items.length != $('#resultado ul li').length) {
                    $('#resultado ul').html(items.join(''));
                }

            }
        });

    }, 1000);

	$('body').disableSelection();
	
    $('a#fancybox').fancybox({ padding: 0, margin: 30 });

    $('#arquivo ul').selectable({
        cancel: 'a',
        filter: 'li',
        selected: function () {
            $('li.ui-selected', this).find('input[type=checkbox]').attr('checked', 'checked');
        },
        unselected: function () {
            $('li:not(.ui-selected)', this).find('input[type=checkbox]').removeAttr('checked');
        }
    });

    $('form[name=upload_form]').ajaxForm({
        beforeSubmit: function () {
            $('#loading, #wrap').show();
        },
        beforeSend: function () {
            var percentVal = '0%';
            $('.bar').width(percentVal)
            $('.percent').html(percentVal);
        },
        uploadProgress: function (event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            $('.bar').width(percentVal)
            $('.percent').html(percentVal);
        },
        complete: function () {
            $('#loading, #wrap').hide();
        }
    });

    $('form[name=upload_form] input[type=file]').change(function () {
        $('form[name=upload_form]').submit();
    });

    $('form[name=delete_form]').ajaxForm({
        beforeSubmit: function () {
            $('#loading, #wrap').show();
        },
        complete: function (xhr) {
            $('#loading, #wrap').hide();
        }
    });

});
</script>
</head>
<body>
<div id="diretorio">

    <div id="loading">
        <div class="progress">
            <div class="bar"></div >
            <div class="percent">0%</div >
        </div>
    </div>
    
    <div id="wrap"></div>
    <div id="corpo">
        
        <div id="formulario">
            <input type="submit" value="Excluir" onclick="$('form[name=delete_form]').submit();" />
            <form name="upload_form" action="upload.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="enviar">
                <div id="form-false"><input type="file" name="arquivo[]" multiple="multiple"></div>
            </form>
        </div>
        
        <div id="arquivo">
            <form name="delete_form" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="deletar">
            <div id="resultado"><ul></ul></div>
            </form>
        </div>
        
    </div>

</div>
</body>