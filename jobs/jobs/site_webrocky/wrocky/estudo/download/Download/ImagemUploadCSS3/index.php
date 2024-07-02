<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	function ReloadSizeUL()
	{
		img_count = $('#img_min img').length;
		var n_img	= 0;
		for(i=1;i<=img_count;i++)
		{
			var img_x 	= $('#img'+i).css('width');
			var img_x 	= img_x.substring(0,(img_x.length - 2));
			var img_x	= parseInt(img_x);
			var n_img	= n_img+img_x+(10+3);
		}		
		$('#img_min ul').css('width',n_img);
	}
	
	function ReloadMaxIMG()
	{
		TimeSpeed = 300;
		$('#img_min img').click(function(){
			img = $(this).attr('src');
			img_open = $('#img_max img').attr('src');
			if(img != img_open)
			{
				if(!img_open)
				{
					$('#img_max').slideUp(TimeSpeed,function(){
						$('#img_max img').attr('src',img).fadeIn(TimeSpeed);
						$('#img_max').slideDown(TimeSpeed);
					});
				}
				else
				{
					$('#img_max img').fadeOut(TimeSpeed,function(){
						$(this).attr('src',img);
						$(this).fadeIn(TimeSpeed);
					});
				}
			}
			else
			{
				$('#img_max').slideUp(TimeSpeed,function(){
					$('#img_max img').attr('src','');
				});
			}
		});
	}
	
	$.ajax({
		url:'upload.php',
		async: true, 
		success: function(data){
			$('#img_min').html(data);
			ReloadSizeUL();
			ReloadMaxIMG();
		}
	});
		
	$('#img_open').click(function(){
		form_dis = $('#img_form').css('display');
		if(form_dis == 'none')
		{
			$('#img_form').fadeIn(TimeSpeed);
			$('#img_open').attr('value','Fechar Janela');
			$('input[name="arquivo_nome"]').attr('value','');
			$('#img_sel').html('');
		}
		else
		{
			$('#img_form').fadeOut(TimeSpeed);
			$('#img_open').attr('value','Adicionar Imagem');
		}
	});
	
	$('input[name="arquivo[]"]').change(function(){		
		
		var input = document.querySelector('input[type="file"]');
		var val_n = '';
		
		for (i=0;i<input.files.length;i++) 
		{
			var val = '<li style="background:url(images/ico_img.png) left no-repeat;">'+input.files[i].name+'</li>';
						
			if(!val_n)
			{
				val_n = val;
				val_x = ' imagem selecionada';
			}
			else
			{
				val_n = val_n+val;
				val_x = ' imagens selecionadas';
			}
		}
		
		if(input.files.length == 0)
		{
			$('input[name="arquivo_nome"]').attr('value','');
			$('#img_sel').html('');
		}
		else
		{
			$('input[name="arquivo_nome"]').attr('value',input.files.length+val_x);
			$('#img_sel').html('<ul>'+val_n+'</ul>');
		}
		
	});
	
	$('form[name=img_upload]').ajaxForm({ 
		target: '#img_min',
		beforeSubmit: function(){
			$('#img_form img').show();
			if(!$('input[name=arquivo_nome]').attr('value'))
			{
				alert('Selecione uma imagem para enviar.');
				return false;
			}
		},	
		success: function(){
			ReloadSizeUL();
			ReloadMaxIMG();
			$('#img_form img').hide();
			$('#img_sel').html('<ul><li style="background:url(images/ico_ok.png) left no-repeat;">Enviado com sucesso!</li></ul>');
		}
	}); 
		
});
</script>
<style type="text/css">

body
{
	margin:50px 0 0 0;
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
	color:#333;
}

input[type=button], input[type=submit]
{
	width:auto;
	border:0px;
	padding:2px 10px 2px 10px;
	color:#333;
	font-weight:bold;
	text-shadow:1px 1px 1px #CCC;
	
	-webkit-border-radius:0px;
	-webkit-box-shadow:0 0 2px rgba(0,0,0,1);
	
	-moz-box-shadow:0 0 1px rgba(0,0,0,1);
	box-shadow:0 0 1px rgba(0,0,0,1);
}

#img_gallery
{
	margin:0 auto;
	width:590px;
	text-align:center;
	border:10px solid rgba(255,255,255,0.8);
	
	-webkit-border-radius:4px;
	-webkit-box-shadow:0 0 5px rgba(0,0,0,1);
	
	-moz-box-shadow:0 0 5px rgba(0,0,0,1);
	box-shadow:0 0 5px rgba(0,0,0,1);
}

#img_form
{
	display:none;
	position:absolute;
	width:588px;
	height:auto;
	margin-top:35px;
	border:1px solid rgba(255,255,255,0.9);
	background:rgba(255,255,255,0.8);
	text-align:left;
	z-index:10;
	
	-webkit-border-radius:4px;
	-webkit-box-shadow:0 0 5px rgba(0,0,0,1);
	
	-moz-box-shadow:0 0 5px rgba(0,0,0,1);
	box-shadow:0 0 5px rgba(0,0,0,1);
}

#img_form input[type=text]
{
	width:430px;
	border:0px;
	padding:2px 2px 2px 2px;
	background:url("images/botao-selecione.png") no-repeat 99% 51%;
	
	-webkit-border-radius:0px;
	-webkit-box-shadow:0 0 2px rgba(0,0,0,1);
	
	-moz-box-shadow:0 0 1px rgba(0,0,0,1);
	box-shadow:0 0 1px rgba(0,0,0,1);
}

#img_form input[type=file]
{
	position:relative;
	width:430px;
	float: left;
	top:-25px;
	margin-bottom:-25px;
	opacity:0;
	-moz-opacity:0;
	filter:alpha(opacity:0);
}

#img_form fieldset
{
	margin:10px;
	padding:10px;
	background:rgba(255,255,255,1);
}

#img_form fieldset legend
{
	font-weight:bold;
	text-shadow:1px 1px 1px #CCC;
}

#img_form img
{
	display:none;
	position:relative;
	top:3px;
	left:5px;
}

#img_sel ul
{
	margin:0px;
	padding:0px;
}

#img_sel li
{
	padding:0 0px 0 20px;
	margin:5px 0px 0px 0px;
	list-style:none;
}

#img_upload
{
	width:100%;
	text-align:center;
}

#img_min
{
	width:100%;
	height:130px;
	overflow-y:hidden;
	overflow-x:scroll;
	
	scrollbar-base-color:#FFF;
}

#img_min ul
{
	margin:0px;
	padding:0px;
}

#img_min ul li
{
	float:left;
	display:inline;
}

#img_min img
{
	min-width:100px;
	min-height:100px;
	height:100px;
	background:#F7F7F7;
	padding:1px;
	margin:5px 5px 5px 5px;
	
	-webkit-transition:500ms;
	-webkit-box-shadow:0 0 1px rgba(0,0,0,0.8);
	
	-moz-transition:500ms;
	-moz-box-shadow:0 0 1px rgba(0,0,0,0.8);
	
	-o-transition:500ms;
	box-shadow:0 0 1px rgba(0,0,0,0.8);
}

#img_min img:hover
{
	-webkit-box-shadow:0 0 10px rgba(0,0,0,0.5);
	-moz-box-shadow:0 0 10px rgba(0,0,0,0.5);
	box-shadow:0 0 10px rgba(0,0,0,0.5);
}

#img_max
{
	display:none;
	
	-webkit-box-shadow:inset 0 -50px 100px rgba(0,0,0,0.1);
	-moz-box-shadow:inset 0 -50px 100px rgba(0,0,0,0.1);
	box-shadow:inset 0 -50px 100px rgba(0,0,0,0.1);
}

#img_max img
{
	height:300px;
	background:#FFF;
	padding:1px;
	margin:10px;
	
	-webkit-transition:500ms;
	-webkit-box-shadow:0 0 5px rgba(0,0,0,0.8);
	
	-moz-transition:500ms;
	-moz-box-shadow:0 0 5px rgba(0,0,0,0.8);

	-o-transition:500ms;
	box-shadow:0 0 5px rgba(0,0,0,0.8);
}

#img_max img:hover
{	
	-webkit-transform:translate(0,-75px) scale(1.2);
	-webkit-box-shadow:0 0 10px rgba(0,0,0,0.9);
	
	-moz-transform:translate(0,-25px) scale(1.2);
	-moz-box-shadow:0 0 px rgba(0,0,0,0.9);
	
	-o-transform:translate(0,-75px) scale(1.2);
	box-shadow:0 0 10px rgba(0,0,0,0.9);
}
</style>
</head>

<body>

<div id="img_gallery">
	<div id="img_form">
    <form name="img_upload" action="upload.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Enviar Imagens</legend>
            <label>
                <input type="text" name="arquivo_nome" disabled="disabled" />
                <input type="file" name="arquivo[]" multiple="multiple" />
                <input type="submit" name="enviar" value="Enviar" />
                <img src="images/loading.gif" />
            </label>
            <label id="img_sel">
            </label>
        </fieldset>
    </form>
    </div>
	<div id="img_upload">
    <input type="button" id="img_open" value="Adicionar Imagem" />
    </div>
    <div id="img_min"></div>
    <div id="img_max"><img src="" /></div>
</div>

</body>
</html>
