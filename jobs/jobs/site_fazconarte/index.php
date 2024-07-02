<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noodp,noydir" /> 
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="icon" href="image/favicon.png" type="image/x-icon">
<link rel="shortcut icon" href="image/favicon.png" type="image/x-icon">
<title>Fazendo e Conhecendo Arte</title>
<link rel="stylesheet" href="style/default-html.css" media="all">
<link rel="stylesheet" href="style/default-theme.css" media="all">
<link rel="stylesheet" href="script/nivo-slider/nivo-slider.css" media="all">
<link rel="stylesheet" href="script/nivo-slider/themes/levelhard/levelhard.css" media="all">
<link rel="stylesheet" href="script/fancybox/jquery.fancybox-1.3.4.css" media="all">
<link rel="stylesheet" href="script/jquery.tooltip.css" media="all">
<script type="text/javascript" src="script/jquery-1.6.min.js"></script>
<script type="text/javascript" src="script/jquery-ui-1.8.12.custom.min.js"></script>
<script type="text/javascript" src="script/jquery.form.js"></script>
<script type="text/javascript" src="script/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="script/nivo-slider/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="script/jquery.tooltip.js"></script>
<script type="text/javascript">
function fancyActive()
{
	$('a[rel=group]').fancybox({
		'padding'		: '5px',
		'margin'		: '50px',
		'transitionIn'	: 'fade',
		'transitionOut'	: 'fade',
		'speedIn'		: 600, 
		'speedOut'		: 300,
		'overlayColor'	: '#000',
		'titlePosition'	: 'over',
		'overlayColor'	: '#000',
		'overlayOpacity': '0.2'
	});
}
function tooltipActive()
{
	$('a#tooltipAct').tooltip({ 
		track: false, 
		delay: 1000, 
		showURL: false, 
		showBody: " - ", 
		fade: 0 
	});
}
function formValid(input,color,len)
{
	$(input).css('background',color);
	$(input).focus();
	$(input).keyup(function(){
		length = $(this).val().length;
		if(length >= len) $(this).css('background','#FFF');
	});
}
$(document).ready(function(){
				
	if($.browser.msie && $.browser.version != '9.0') window.location = 'http://browser.levelhard.com/?a[]=1&a[]=2&a[]=3&a[]=4&a[]=5';
	
	var vel = 100;
	
	$('#topo').disableSelection();
	
	$('#carregador').fadeIn(vel);
	window.onload = function(){
		
		tooltipActive();
	
		$('#wrap').fadeOut(600);	
	
		$('#menu li').hover(function(){
			$('ul',this).stop().show().animate({'margin-left':'-20px','opacity':'1'},600);
		},function(){
			$('ul',this).stop().animate({'opacity':'0'},function(){
				$(this).hide().animate({'margin-left':'-200px'},600);	
			});
		});
		
		$.post('core/core.php',{'tela':'principal'},function(data){
			$('#carregador').fadeOut(vel);
			$('#centro div').fadeOut(vel,function(){
				$(this).html(data).fadeIn((vel+300));
				fancyActive();
				tooltipActive();
			});		
			$('#menu li, #botao').click(function(){
				var destino = $(this).attr('class');
				if(destino)
				{
					$('#wrap').fadeIn(300,function(){
						$('#carregador').fadeIn(vel,function(){
							$.post('core/core.php',{'tela':destino},function(data){
								$('#carregador').fadeOut(vel);
								$('#centro div').fadeOut(vel,function(){
									$(this).html(data).fadeIn((vel+300));
									fancyActive();
									tooltipActive();
									$('#wrap').fadeOut(300);
								});
							});
						});
					});
				}
			});
		});

	}
		
});
</script>
</head>

<body>
	<div id="wrap"></div>
	<div id="carregador"><p>Carregando...</p><img src="image/ajax-loader.gif" alt=""></div>
	<div id="container">
    	<div id="topo">
        	<div id="social">
            <ul>
                <li><img src="image/icones/social-fca/blueprint-social-01.png" alt=""></li>
                <li>
                <a href="https://www.facebook.com/pages/FCA-Arquitetura-e-Engenharia/131905043610473" target="_blank">
                	<img src="image/icones/social-fca/blueprint-social-03.png" alt="">
                </a>
                </li>
            </ul>
            </div>
        	<div id="topo_cont">
            	<div id="topo_menu">
                    <div id="logo">
                        <a href="javascript:void(0);" id="botao" class="principal"><img src="image/logo.png" alt=""></a>
                    </div>
                    <div id="menu">
                        <ul>
                            <li class="principal"><p>Home</p></li>
                            <li class="projetos"><p>Projetos</p></li>
                            <li class="servicos"><p>Serviços</p></li>
                            <li class="parceiros"><p>Parceiros</p></li>
                            <li class="contato"><p>Contato</p></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="centro"><div><div id="espera">Carregando Conteúdo da Pagina...</div></div></div>
            <div id="rodape">
                Desenvolvido por <a href="http://www.levelhard.com" target="_blank">LevelHard 2012</a>.
            </div>
        </div>
    </div>
</body>
</html>
