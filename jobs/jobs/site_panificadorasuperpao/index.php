<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noodp,noydir" /> 
<meta name="description" content="" />
<meta name="keywords" content="Padaria, Panificadora, Super Pão, Tatuí, Pão, São Paulo" />
<link rel="icon" href="image/favicon.png" type="image/x-icon">
<link rel="shortcut icon" href="image/favicon.png" type="image/x-icon">
<title>Panificadora e Confeitaria Super Pão</title>
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
		'padding'		: '0px',
		'margin'		: '50px',
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic',
		'speedIn'		: 600, 
		'speedOut'		: 300,
		'overlayColor'	: '#000'
	});
}
function tooltipActive()
{
	$('a#tooltipAct').tooltip({ 
		track: true, 
		delay: 0, 
		showURL: false, 
		showBody: " - ", 
		fade: 250 
	});
}
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
				
	if($.browser.msie && $.browser.version != '9.0') window.location = 'http://navsupport.webrocky.com.br/index.php?a[]=1&a[]=2&a[]=3&a[]=4&a[]=5';
	
	var vel = 100;
	
	$('#topo').disableSelection();
	
	$('#carregador').fadeIn(vel);
	window.onload = function(){
	
		$('#topo').animate({'top':'0px'},600,'easeOutSine',function(){
			$('#menu').animate({'left':'0px','opacity':'1'},1000,'easeOutBack',function(){
				$('#logo').animate({'top':'0px'},1000,'easeOutBounce',function(){
					$('#centro, #rodape').fadeIn(600,function(){
						$('#wrap').fadeOut(600);	
					});
				});
			});
		});
		
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
            	<li><div id="telefone">Tel.: (15) 3205 1074</div></li>
                <li><img src="image/icones/social/twitter.png" alt=""></li>
                <li><img src="image/icones/social/facebook.png" alt=""></li>
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
                            <li class=""><p>Produtos</p>
                            <ul>
                                <li class="produtos_paes">Pães</li>
                                <li class="produtos_frios">Frios & Patês</li>
                                <li class="produtos_bolos">Bolos & Doces</li>
                                <li class="produtos_lanches">Lanches & Salgados</li>
                                <li class="produtos_encomendas">Delivery & Coffee Break</li>
                            </ul>
                            </li>
                            <li class="empresa"><p>Empresa</p></li>
                            <li class="novidade"><p>Novidades</p></li>
                            <li class="contato"><p>Fale Conosco</p></li>
                        </ul>
                    </div>
                </div>
                <div id="centro"><div><div id="espera">Carregando Conteúdo da Pagina...</div></div></div>
                <div id="rodape">
                    Desenvolvido por <a href="http://www.levelhard.com" target="_blank">LevelHard 2011</a>.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
