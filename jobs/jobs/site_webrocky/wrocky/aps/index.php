<?php

	//Chamada da lingagem
	require "config/language_ptBR.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print $language['sitename']; ?></title>

<!-- CSS Scripts -->
<link rel="stylesheet" href="css/style_all.css" />
<link rel="stylesheet" href="css/menu.css" />
<link rel="stylesheet" href="css/jquery.tooltip.css" />
<link rel="stylesheet" href="scripts/fancybox/jquery.fancybox-1.3.3.css" />
<!-- jQuery Scripts -->
<script type="text/javascript" src="scripts/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="scripts/jquery.tooltip.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript" src="scripts/jquery.maskedinput-1.2.2.min.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.3.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#loading').fadeIn(200);

	//Direitos Autorais
	$('#content_footer').html('<p style="padding:10px; font-size:10px; text-align:center; display:none;"><a id="fancy_frame" href="http://www.webrocky.com.br">WebRoCKY.com.br</a> 11/2010 UNIP Sorocaba.</p>');
	$('#content_footer p').fadeIn(600);

	//Pagina Inicial
	$('#content_ajax').load('action/fs_home.php',function(){
		$('#content_ajax').fadeIn(300,function(){
			$('#loading').fadeOut(200);
		});
	});
	
});

function ActFancyBox()
{
	$('a#fancy_frame').fancybox({
		'padding'     	: 2,
		'width'			: 850,
		'height'		: 560,
		'titleShow'     : false,
		'transitionIn'	: 'fade',
		'transitionOut'	: 'fade',
		'type'			: 'iframe'
	});
	
	$('a#fancy_ajax').fancybox({
		'padding'     	: 2,
		'width'			: '90%',
		'height'		: '90%',
		'titleShow'     : false,
		'transitionIn'	: 'fade',
		'transitionOut'	: 'fade',
	});
}

function AjaxLoading(url)
{
	$('#loading').fadeIn(200);
	$('#content_ajax').fadeOut(300,function(){
		$('#content_ajax').load(url,function(){
			$('#content_ajax').fadeIn(300,function(){
				$('#loading').fadeOut(200);
				ActFancyBox();
			});
		});
	});
}

</script>

</head>

<body>

<div id="content">
	<div id="content_header">
    <a href="javascript:void(0);" onclick="AjaxLoading('action/fs_home.php');">
    <h1>APS2010</h1>
    <h2>UNIP Universidade Paulista</h2>
    </a>
    <div id="loading"><img src="images/loading.gif" alt="Carregando..." /></div>
    </div>
    <div id="content_menu">
    <ul id="nav">
    	<a href="javascript:void(0);" onclick="AjaxLoading('action/fs_home.php');"><li>Inicio</li></a>
        <a href="javascript:void(0);" onclick="AjaxLoading('action/fs_prop.php');"><li>Proprietarios</li></a>
        <a href="javascript:void(0);" onclick="AjaxLoading('action/fs_veic.php');"><li>Veiculos</li></a>
        <a href="javascript:void(0);" onclick="AjaxLoading('action/fs_mult.php');"><li>Multas</li></a>
    </ul>
    </div>
    <div id="content_box">
        <div id="content_ajax" style="display:none;"></div>
    </div>
    <div id="content_footer"></div>
</div>

</body>
</html>