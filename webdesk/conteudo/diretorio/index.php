<?php
	$usuario = $_GET["usuario"];
?>
<link rel="stylesheet" href="conteudo/diretorio/styles.css" />
<link rel="stylesheet" href="conteudo/diretorio/scripts/jquery.fancybox.css" />
<script type="text/javascript" src="conteudo/diretorio/scripts/jquery.fancybox.js"></script>
<script type="text/javascript">
$(document).ready(function () {

    setInterval(function () {

        $.ajax({
            url: 'conteudo/diretorio/upload.php',
            type: 'POST',
            dataType: 'json',
            data: { 'usuario': '<?php print $usuario ?>' },
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
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'id="fancybox"';
                                fileTypeClass = 'image_box';
                            }
							else if (fileReal[1] == 'png') {
                                fileImage = 'images/icons/png.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'id="fancybox"';
                                fileTypeClass = 'image_box';
                            }
							else if (fileReal[1] == 'gif') {
                                fileImage = 'images/icons/gif.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'id="fancybox"';
                                fileTypeClass = 'image_box';
                            }
							else if (fileReal[1] == 'bmp') {
                                fileImage = 'images/icons/bmp.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'id="fancybox"';
                                fileTypeClass = 'image_box';
                            }
                            else if (fileReal[1] == 'mp3') {
                                fileImage = 'images/icons/mp3.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'mp3') {
                                fileImage = 'images/icons/mp3.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'mp3') {
                                fileImage = 'images/icons/mp3.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'mp3') {
                                fileImage = 'images/icons/mp3.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'wav') {
                                fileImage = 'images/icons/wav.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'wma') {
                                fileImage = 'images/icons/wma.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'mpg' || fileReal[1] == 'mpeg') {
                                fileImage = 'images/icons/mpeg.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'wmv') {
                                fileImage = 'images/icons/wmv.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'rar') {
                                fileImage = 'images/icons/rar.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'zip') {
                                fileImage = 'images/icons/zip.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'doc' || fileReal[1] == 'docx') {
                                fileImage = 'images/icons/docx_win.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'xls' || fileReal[1] == 'xlsx') {
                                fileImage = 'images/icons/xlsx_win.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
							else if (fileReal[1] == 'ppt' || fileReal[1] == 'ppt_x') {
                                fileImage = 'images/icons/pptx_win.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'psd') {
                                fileImage = 'images/icons/psd.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'pdf') {
                                fileImage = 'images/icons/pdf.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'html') {
                                fileImage = 'images/icons/html.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'css') {
                                fileImage = 'images/icons/css.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }
                            else if (fileReal[1] == 'txt') {
                                fileImage = 'images/icons/text.png';
                                fileHref = 'javascript:void(0);';
                                fileExecute = 'onclick="windowOpen(1,\'action_6\',\'Editor de Texto\',\'conteudo/escritor/?usuario=<?php print $usuario; ?>&texto=../diretorio/' + fileReal[0] + '.' + fileReal[1] + '\',\'850px\',\'650px\',1,0);"';
                                fileTypeClass = 'file_box';
                            }
                            else {
                                fileImage = 'images/icons/file.png';
                                fileHref = 'conteudo/diretorio/' + fileReal[0] + '.' + fileReal[1] + '';
                                fileExecute = 'about="_blank"';
                                fileTypeClass = 'file_box';
                            }

                            if (!fileMin[1]) {
                                html = '<li id="' + key + '" class="' + fileTypeClass + '">';
                                html += '<img id="mini" src="conteudo/diretorio/' + fileImage + '">';
                                html += '<a href="' + fileHref + '" ' + fileExecute + ' title="' + fileName[2] + '">';
                                html += '<p>' + fileName[2] + '</p>';
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

    $.contextMenu({
        selector: '#arquivo li.image_box',
        callback: function (key, options) {
			switch(key)	{
				case "background":
					bg_img = $('a', this).attr('href');
					$.get('core.php', {
						'acao': 'aplica_bg',
						'background': bg_img
					}, function (data) {
						$('#preloader').show();
						$('#sistema_bg #sistema_bg_default').fadeOut(600);
						$('#sistema_bg #sistema_bg_new').hide().css({ 'background-image': 'url('+bg_img+')' }).fadeIn(600,function(){
							$('#sistema_bg #sistema_bg_default').css({ 'background-image': 'url('+bg_img+')' }).show();
							$('#preloader').fadeOut();
						});
					});
				break;
			}
        },
        items: {
            'background'	: { name: 'Usar Imagem', icon: 'edit' }
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
            //alert(xhr.responseText);
        }
    });

});
</script>

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
            <form name="upload_form" action="conteudo/diretorio/upload.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="enviar">
                <input type="hidden" name="usuario" value="<?php print $usuario ?>">
                <div id="form-false"><input type="file" name="arquivo[]" multiple="multiple"></div>
            </form>
        </div>
        
        <div id="arquivo">
            <form name="delete_form" action="conteudo/diretorio/upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="deletar">
            <input type="hidden" name="usuario" value="<?php print $usuario ?>">
            <div id="resultado"><ul></ul></div>
            </form>
        </div>
        
    </div>

</div>