<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Geratividade.com</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
<!-- All -->
<link rel="stylesheet" href="styles/style_all.css" type="text/css" charset="utf-8" />
<!-- IE Hack -->
<link rel="stylesheet" href="styles/style_ie.css" type="text/css" charset="utf-8" />
<link rel="stylesheet" href="scripts/fancybox/jquery.fancybox-1.3.1.css" type="text/css" charset="utf-8" />
<!-- jQuery -->
<script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#ajax').load('content/gerontologia.html');
	$('#container').hide();
	$('#loading').fadeIn(400);
	$('#loadingbg').css('opacity','0.5');
	$('#loadingbg').fadeIn(200);
	window.onload = function(){
		$('#loading').fadeOut(400);
		$('#loadingbg').fadeOut(600);
		$('#container').fadeIn(1000);
	}
});
function LinkLoad(url)
{
	$('#loading').show();
	$('#ajax').load(url,function(){
		$('#loading').hide();
	});
}
</script>
</head>

<body>
<div id="loading"><p>Carregando...</p><img src="images/loader.gif"></div>
<div id="loadingbg"></div>

<div id="container">
	<div id="header">
    	<div id="logo"><h1>Geratividade.com <b style="font-size:10px; font-family:Verdana, Geneva, sans-serif;">beta</b></h1></div>
        <div id="menu">
        	<!--
            <ul>
                <a href="javascript:LinkLoad('content/principal.html');"><li>Principal</li></a>
            </ul>
            -->
            <ul>
                <a href="javascript:LinkLoad('content/gerontologia.html');"><li>A Gerontologia</li></a>
            </ul>
            <ul>
                <a href="javascript:LinkLoad('content/profissional.html');"><li>O Profissional</li></a>
            </ul>
            <ul>
                <a href="javascript:LinkLoad('content/atividades.html');"><li>Atividades Oferecidas</li></a>
            </ul>
            <ul>
                <a href="javascript:LinkLoad('content/agenda.html');"><li>Agenda</li></a>
            </ul>
            <ul>
                <a href="javascript:LinkLoad('content/contato.html');"><li>Contato</li></a>
            </ul>
        </div>
    </div>
    <div id="content">
        <div id="ajax"></div>
        <div id="footer">Template desenvolvido por <a href="http://www.webrocky.com.br">WebRoCkY</a> e desenhado por <a href="http://www.tiwolf.com.br">TiWolf</a></div>
    </div>
</div>
<div id="clear"></div>
</body>
</html>
