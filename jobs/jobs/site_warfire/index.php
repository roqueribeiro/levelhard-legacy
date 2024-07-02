<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noodp,noydir" /> 
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<title>Banda WarFire</title>
<link rel="stylesheet" href="style/default-html.css">
<link rel="stylesheet" href="style/default-theme.css">
<link rel="stylesheet" href="style/default-tootip.css">
<link rel="stylesheet" href="script/fancybox/jquery.fancybox-1.3.4.css">
<link rel="stylesheet" href="script/nivo-slider/nivo-slider.css" media="all">
<link rel="stylesheet" href="script/nivo-slider/themes/levelhard/levelhard.css" media="all">
<script type="text/javascript" src="script/jquery-1.6.min.js"></script>
<script type="text/javascript" src="script/jquery-tooltip.js"></script>
<script type="text/javascript" src="script/jquery-ui-1.8.12.custom.min.js"></script>
<script type="text/javascript" src="script/jquery.form.js"></script>
<script type="text/javascript" src="script/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="script/nivo-slider/jquery.nivo.slider.js"></script>
<script type="text/javascript">
function tooltipActive()
{
	$('body a').tooltip({ 
		track	: true, 
		delay	: 0, 
		showURL	: false, 
		fade	: 0
	});
}
function fancyActive()
{
	$('a[rel=group]').fancybox({
		'padding'		: '0px',
		'margin'		: '30px',
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic',
		'speedIn'		: 600, 
		'speedOut'		: 300,
		'overlayColor'	: '#000'
	});
}
function formValid(input,color,len)
{
	$(input).animate({backgroundColor:color},600);
	$(input).focus();
	$(input).keyup(function(){
		length = $(this).val().length;
		if(length >= len) $(this).animate({backgroundColor:'#FFF'},600);
	});
}
$(document).ready(function(){
				
	if($.browser.msie && $.browser.version != '9.0') window.location = 'http://navsupport.webrocky.com.br/index.php?a[]=1&a[]=2&a[]=3&a[]=4&a[]=5';
		
	$('#topo').disableSelection();
		
	$('#wrap, #carregador').show()
	$.post('core/core.php',{'tela':'principal'},function(data){
		$('#wrap, #carregador').hide();
		$('#centro div').html(data);
		fancyActive();
		$('#menu li, #botao').click(function(){
			var destino = $(this).attr('class');
			if(destino)
			{
				$('#wrap, #carregador').show()
				$.post('core/core.php',{'tela':destino},function(data){
					$('#wrap, #carregador').hide();
					$('#centro div').html(data);
					fancyActive();
				});
			}
		});
	});
});
</script>
</head>

<body>
	<div id="wrap"></div>
	<div id="carregador"><p>Carregando...</p><img src="image/ajax-loader.gif" alt=""></div>
	<div id="container">
    	<div id="topo">
        	<div id="topo_cont">
                <div id="logo">
                	<a href="javascript:void(0);" id="botao" class="principal"><img src="image/logo.png"></a>
                </div>
                <div id="menu">
                    <ul>
                        <li class="principal"><p>Home</p></li>
                        <li class="warfire"><p>Warfire</p></li>
                        <li class="integrantes"><p>Integrantes<p></li>
                        <li class="agenda"><p>Agenda</p></li>
                        <li class="contato"><p>Contato</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="centro"><div><div id="espera">Carregando Conteúdo da Pagina...</div></div></div>
        <div id="rodape">Desenvolvimento por <a href="http://www.levelhard.com" target="_blank">LevalHard 2011</a>.</div>
    </div>
</body>
</html>
