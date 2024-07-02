<?php

	$nav_ignore = $_GET["nav_ignore"];
	
	if(!$nav_ignore)
		$nav_not = "if($.browser.msie && $.browser.version != '9.0') window.location = 'http://navsupport.webrocky.com.br/?a[]=1&a[]=2&a[]=3&a[]=4&a[]=5&b=site.votofix.com';";

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>VotoFix - Soluções para Vereadores</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<meta name="robots" content="noodp,noydir" />
<meta name="description" content="Sistema de Gerenciamento para Vereadores e outras Soluções." /> 
<meta name="keywords" content="Vereador, Vereadores, Vereadora, Vereadoras, Sistema, Sistemas, Programa, Programas, Software, Projeto, Projetos, Carta, Cartas, Votofix, VotoFix, Membro, Membros, Site, Sites" />
<link rel="stylesheet" type="text/css" href="styles/template-default-all.css">
<link rel="stylesheet" type="text/css" href="styles/template-default.css">
<link rel="stylesheet" type="text/css" href="scripts/fancybox/jquery.fancybox-1.3.4.css">
<script type="text/javascript" src="scripts/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript" src="scripts/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="scripts/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript">
function formValid(input,color,len)
{
	$(input).css('background',color);
	$(input).focus();
	$(input).keyup(function(){
		length = $(this).val().length;
		if(length >= len) $(this).css('background','rgba(255,255,255,1)');
	});
}
$(document).ready(function(){
	
	<?php print $nav_not; ?>
		
	var easeVel 	= 500;
	var easeDefine 	= 'easeOutBack';
	
	window.onload = function(){
		
		$('#corpo #conteudo #loading').fadeOut(300,function(){
			$('#conteudo #coluna_1').css({
				'background':'url(images/img-index1.jpg)',
				'background-position':'center'
			}).delay(0).animate({'top':'0px','left':'0px','opacity':'1'},easeVel,easeDefine,function(){
				$(this).animate({'opacity':'0.7'});
			});
			$('#conteudo #coluna_2').css({
				'background':'url(images/img-index2.jpg)',
				'background-position':'center'
			}).delay(100).animate({'top':'0px','left':'320px','opacity':'1'},easeVel,easeDefine,function(){
				$(this).animate({'opacity':'0.7'});
			});
			$('#conteudo #coluna_3').css({
				'background':'url(images/img-index1.jpg)',
				'background-position':'center'
			}).delay(200).animate({'top':'0px','left':'640px','opacity':'1'},easeVel,easeDefine,function(){
				$(this).animate({'opacity':'0.7'});
			});
			$('#conteudo li').mouseenter(function(){
				$(this).animate({'opacity':'1','top':'-10px'},300);
			});
			$('#conteudo li').mouseleave(function(){
				$(this).animate({'opacity':'0.7','top':'0px'},300);
			});
		});
		
	}
	
	$('a.fancybutton').fancybox({
		'padding'			: '1',
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'overlayOpacity'	: '0.2',
		'overlayColor'		: '#FFF',
	});
	
	$('#nav li').click(function(){
		menu = $('ul',this);
		if(menu.css('display') == 'none')
		{
			$('#wrap').show();
			menu.slideDown(300,function(){
				$('#wrap').click(function(){
					$('#wrap').hide();
					menu.fadeOut(600);
				});
			});
		}
		else
		{
			$('#wrap').hide();
			menu.fadeOut(600);
		}
	})
	
});
</script>
</head>

<body>

<div id="wrap"></div>

<div id="corpo">
	<div id="cabecalho">
    	<div id="logo"></div>
        <div id="slogan">Você sempre perto de seus eleitores</div>
    </div>
    <div id="conteudo">
    <div id="loading"></div>
    <ul>
    	<a href="content/prod_vtx.php">
    	<li id="coluna_1">
        	<div id="desc">
            	<h1>VTX</h1>
                <p><i>Gerencie todo o seu gabinete</i></p><br />
                <p>Todas as suas ações prestadas aos eleitores cadastradas de forma organizada, sem deixar nenhuma pendência no esquecimento.</p>
            </div>
        </li>
        </a>
        <a href="content/prod_site.php">
    	<li id="coluna_2">
        	<div id="desc">
            	<h1>Sites</h1>
                <p><i>Divulgue o seu trabalho</i></p><br />
                <p>Seu site super atualizado, atrelado as principais redes sociais sem preocupações com criação, hospedagem e domínios.</p>
            </div>
        </li>
        </a>
        <a href="content/prod_membro.php">
    	<li id="coluna_3">
        	<div id="desc">
            	<h1>Membros</h1>
                <p><i>Uma área restrita aos associados</i></p><br />
                <p>Com arquivos para downloads, Projetos de Leis, modelos de ofícios, cartas, requerimentos e etc.</p>
            </div>
        </li>
        </a>
    </ul>
    </div>
    <div id="menu">
        <ul id="nav">
            <li>Produtos
                <ul>
                    <a href="content/prod_vtx.php"><li>VTX</li></a>
                    <a href="content/prod_site.php"><li>Sites</li></a>
                    <a href="http://membros.votofix.com.br"><li>Membros</li></a>
                </ul>
            </li>
            <!--<li><a class="fancybutton" href="content/core.php?action=cto_form">A Empresa</a></li>-->
            <li><a class="fancybutton" href="content/core.php?action=cto_form">Contato</a></li>
        </ul>
    </div>
    <div id="rodape">Desenvolvido por Roque Ribeiro. <a href="http://www.webrocky.com.br">WebRoCkY.com.br</a></div>
</div>

</body>
</html>
