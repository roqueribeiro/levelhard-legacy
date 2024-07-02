<?php
	//Linguagem do Site
	header('Content-Type: text/html; charset=utf-8');
	require "languages/language-ptbr.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print $site_nome ?></title>

<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="style-ie.css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="scripts/jquery-theme/tooltip/jquery-tooltip.css" />
<link rel="stylesheet" type="text/css" href="scripts/jquery-theme/fancybox/jquery.fancybox-1.3.1.css" media="screen" />
<script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
<!-- jQuery Templates -->
<script type="text/javascript" src="scripts/jquery-theme/tooltip/jquery-tooltip.js"></script>
<script type="text/javascript" src="scripts/jquery-theme/jquery-corner.js"></script>
<script type="text/javascript" src="scripts/jquery-theme/jquery-shadow.js"></script>
<script type="text/javascript" src="scripts/jquery-theme/fancybox/jquery.fancybox-1.3.1.js"></script>
<script type="text/javascript" src="scripts/jquery-theme/fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
<script type="text/javascript" src="scripts/jquery-theme/fancybox/jquery.easing-1.3.pack.js"></script>
<!-- jQuery Formularios -->
<script type="text/javascript" src="scripts/jquery-form/jquery-form.js"></script>
<script type="text/javascript" src="scripts/jquery-form/jquery-mask.min.js"></script>
<script type="text/javascript" src="scripts/jquery-form/jquery-validate.min.js"></script>
<script type="text/javascript" src="scripts/jquery-form/jquery-cpf.js"></script>
<!-- jQuery Funções -->
<script type="text/javascript">
$(document).ready(function(){
	//Loading
	$('#theme_loading').fadeIn(600);
	$('#theme_content_ajax').hide();
	window.onload = function(){
		$('#theme_content_ajax').load('fs_principal.php',function(){
			$(this).fadeIn(600);
			$('#theme_loading').fadeOut(200);
		});
	}
	$('#theme_container a').tooltip({ 
		track: true, 
		delay: 0, 
		showURL: false, 
		fade: 600 
	});
	//Over e Out do Menu
	$('#theme_menu a').mouseover(function(){
		$(this).css('color','#CCC');
	});
	$('#theme_menu a').mouseout(function(){
		$(this).css('color','#FFF');
	});
	$('a#fancy_but').fancybox({
		'width'			: 1025,
		'height'		: 700,
		'padding'		: 5,
		'titleShow'		: false,
		'transitionIn'	: 'fade',
		'transitionOut'	: 'fade',
		'speedIn'		: 600,
		'speedOut'		: 300,
		'overlayOpacity': '0.1',
		'overlayColor'	: '#333',
		'type'			: 'iframe'
	});
	//Verifica Navegador e aplica compatibilidade
	if(navigator.userAgent.search('MSIE') != -1)
	{
		$('#theme_loading').css('border','1px #CCC solid');
		$('#theme_container').css('border-left','1px #CCC solid');
		$('#theme_container').css('border-right','1px #CCC solid');
		$('#theme_container').css('border-bottom','1px #CCC solid');
		$('#tooltip').css('border','1px #CCC solid');
	}
	else
	{
		$('#theme_content_shadown').corner('bottom');
		$('#footer').corner('bottom');
		$('#theme_loading').corner();
		$('#tooltip').corner('5px');
	}
});
//Atualizar Pagina Inicial
function AjaxLoad($url)
{
	$(document).ready(function(){		
		checks = $('#theme_content_box_ajax input:checked').length;
		if(checks >= 1)
		{
			s = (checks > 1) ? 's' : '';
			if (window.confirm('Você selecionou '+checks+' curso'+s+', se você atualizar a pagina perderá o'+s+' curso'+s+' selecionado'+s+'. Deseja Continuar Mesmo Assim?'))
			{
				$('#theme_loading').fadeIn(300);
				$('#theme_content_ajax').hide();
				$('#theme_content_ajax').load($url,function(){
					$(this).fadeIn(600);
					$('#theme_loading').fadeOut(300);
				});
			}
			else
			{
				return false;
			}
		}
		else
		{
			$('#theme_loading').fadeIn(300);
			$('#theme_content_ajax').hide();
			$('#theme_content_ajax').load($url,function(){
				$(this).fadeIn(600);
				$('#theme_loading').fadeOut(300);
			});
		}
	});
}
</script>
</head>

<body>

<div id="theme_loading"><p>Carregando...</p><img src="themes/default/loading.gif" /></div>

<div id="theme_container">
    <div id='theme_nav'>
        <a id="fancy_but" href="http://www.google.com.br/chrome" title="<h3>Baixar Google Chrome</h3><p>Compatibilidade Máxima</p>">
        <img src="images/icones/co_ico_chr.png" />
        </a>
        <a id="fancy_but" href="http://www.apple.com/br/safari/download/" title="<h3>Baixar Safari</h3><p>Compatibilidade Máxima</p>">
        <img src="images/icones/co_ico_sfr.png" />
        </a>
        <a id="fancy_but" href="http://br.mozdev.org/download/" title="<h3>Baixar Mozilla Firefox</h3><p>Compatibilidade Média</p>">
        <img src="images/icones/co_ico_fox.png" />
        </a>
        <a id="fancy_but" href="http://www.opera.com/download/" title="<h3>Baixar Opera</h3><p>Compatibilidade Média</p>">
        <img src="images/icones/co_ico_opr.png" />
        </a>
        <a id="fancy_but" href="http://www.microsoft.com/brasil/windows/internet-explorer/" title="<h3>Baixar Internet Explorer</h3><p>Compatibilidade Mínima</p>">
        <img src="images/icones/co_ico_ie.png" />
        </a>
    </div>    
	<div id="theme_header">
    </div>
    <div id="theme_menu">
        <fieldset id="theme_menu_fieldset">
        	<label><a href="javascript:AjaxLoad('fs_principal.php')"><?php print $language["index_menu_button01"] ?></a></label>
            <label><a id="fancy_but" href="fs_desenv.php"><?php print $language["index_menu_button02"] ?></a></label>
            <label><a id="fancy_but" href="fs_desenv.php/"><?php print $language["index_menu_button03"] ?></a></label>
            <label><a id="fancy_but" href="fs_desenv.php/"><?php print $language["index_menu_button04"] ?></a></label>
        </fieldset>
    </div>
    <div id="theme_content_shadown">
        <div id="theme_content">
            <div id="theme_content_ajax">
            </div>
        </div>
        <div id="footer">
            <?php print $language["desenvolvedor"] ?>
        </div>
    </div>
</div>

</body>
</html>