<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="robots" content="noodp,noydir" /> 
<meta name="description" content="A Beleza de seus Produtos com Embalagens de Alta Qualidade!" />
<meta name="keywords" content="embalagens, tatuí, sacos, descartaveis" />
<title>Embalagens Tatuí</title>
<link rel="stylesheet" href="scripts/fancybox/jquery.fancybox-1.3.4.css" media="all">
<link rel="stylesheet" href="style/menu.css" type="text/css">
<link rel="stylesheet" href="style/default-theme.css" type="text/css">
<link rel="stylesheet" href="style/default-html.css" type="text/css">
<link rel="stylesheet" href="scripts/nivo-slider/nivo-slider.css" type="text/css">
<link rel="stylesheet" href="scripts/nivo-slider/themes/default/default.css" media="all">
<script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.8.12.custom.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript" src="scripts/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="scripts/nivo-slider/jquery.nivo.slider.js"></script>
<!--[if lte IE 7]>
<script type="text/javascript">
    window.location = 'http://browser.levelhard.com/?a[]=1&a[]=2&a[]=3&a[]=4&a[]=5';
</script>
<![endif]-->
<script type="text/javascript">
function ajaxContextLoad(url)
{
	if(url)
	{
		$('#carregador,#wrap').show();
		$.post('core/core.php',{'tela':url},function(data){
			$('#conteudo').html(data);
			$('a[rel=group]').fancybox({
				'titlePosition'	: 'over',
				'overlayColor'	: '#000',
				'overlayOpacity': '0.4'
			});
			$('#slider').nivoSlider({
				effect				: 'fold',
				animSpeed			: 600,
				pauseTime			: 9000,
				captionOpacity		: '1',
				directionNav		: false,
			});
			$('#carregador,#wrap').fadeOut(300);
		});
	}	
}
$(document).ready(function(){	
	$('#menu li').click(function(){
		if($(this).next('ul').css('display')=='block')
		{
			$(this).next('ul').slideUp();
		}
		else
		{
			$('#menu ul ul:visible').slideUp();
			$(this).next('ul').slideDown();
		}
	});
	$('#carregador,#wrap').show();
	window.onload = function(){
		ajaxContextLoad('principal');
		$('#menu li').click(function(){ ajaxContextLoad($(this).attr('class')); });
	}
});

</script>

</head>
<body>

<div id="carregador"><p>Carregando...</p><img src="image/ajax-loader.gif" alt=""></div>

<div id="wrap"></div>

<div id="topo">
	<div id="topo_img"></div>
	<div id="topo_texto">
		<p><b>A BELEZA DE SEUS PRODUTOS COM</b></p>
		<p>EMBALAGENS DE ALTA QUALIDADE</p>
	</div>
</div>

<div id="logo"></div>

<div id="centro" >
	<div id="lateral">
    
    	<div id="menu">
        <ul>
            <li class="principal">Home</li>
            <li class="">Empresa</li>
            <ul>
                <li class="loja1">Loja 1</li>
                <li class="loja2">Loja 2</li>
                <li class="industria">Indústria</li>
            </ul>
            <li class="">Produtos</li>
            <ul>
                <li class="sacos">Sacos</li>
                <li class="acessorios">Acessórios</li>
                <li class="embalagens">Embalagens</li>
                <li class="limpeza">Limpeza</li>
            </ul>
            <li class="parceiros">Parceiros</li>
            <li class="imprensa">Imprensa</li>
            <li class="contato">Contato</li>
        </ul>
        </div>
    
	</div>
	
	<div id="conteudo"></div>
</div>

<div id="rodape">
	<div id="creditos">
		<p><b>Copyright © 2012</b></p>
		<p>Todos os direitos reservados</p>
        <p><a href="http://www.resulty.com.br">Agência Resulty</a> & <a href="http://www.levelhard.com.br">LevelHard</a></p>
	</div>
	<div id="contato">
		<p><b>Contato</b></p>
		<p><img src="image/phone.png"><b>15. </b>3305-6171</p>
		<p><img src="image/mail-icon.png"><a href="mailto:embalagenstatui@uol.com.br">embalagenstatui@uol.com.br</a></p>
	</div>
	<div id="social">
		<p><b>Social</b></p>
		<p><img src="image/social-facebook.png"> <img src="image/Flickr-icon.png"> <img src="image/social-twitter.png"> <img src="image/YouTube-icon.png"></p>
		<p>Partilcipe das nossas redes sociais.</p>
	</div>
</div>

</body>
</html>
