<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noodp,noydir" /> 
<meta name="description" content="" />
<meta name="keywords" content="Padaria, Panificadora, Super Pão, Tatuí, Pão, São Paulo" />
<link rel="icon" href="image/favicon.png" type="image/x-icon">
<link rel="shortcut icon" href="image/favicon.png" type="image/x-icon">
<title>Meta</title>
<link rel="stylesheet" href="style/default-html.css" media="all">
<link rel="stylesheet" href="style/default-theme.css" media="all">
<link rel="stylesheet" href="style/supersized.core.css" media="all">
<link rel="stylesheet" href="script/nivo-slider/nivo-slider.css" media="all">
<link rel="stylesheet" href="script/nivo-slider/themes/levelhard/levelhard.css" media="all">
<link rel="stylesheet" href="script/fancybox/jquery.fancybox-1.3.4.css" media="all">
<script type="text/javascript" src="script/jquery-1.6.min.js"></script>
<script type="text/javascript" src="script/supersized.core.3.2.1.min.js"></script>
<script type="text/javascript" src="script/jquery-ui-1.8.12.custom.min.js"></script>
<script type="text/javascript" src="script/jquery.form.js"></script>
<script type="text/javascript" src="script/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="script/nivo-slider/jquery.nivo.slider.js"></script>
<script type="text/javascript">
function fancyActive()
{
	$('a[rel=group]').fancybox({
		'titlePosition'	: 'over',
		'padding'		: '0px',
		'margin'		: '50px',
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
	
	$.supersized({
		slides:[ { image : 'image/wall-test-wallpaper.jpg' } ]
	});
				
	if($.browser.msie && $.browser.version != '9.0') window.location = 'http://navsupport.webrocky.com.br/index.php?a[]=1&a[]=2&a[]=3&a[]=4&a[]=5';
	
	var vel = 100;
	
	$('#topo').disableSelection();
	$('#logo').css({'top':'-200px'});
	$('#menu').css({'left':'50px','opacity':'0'});
	$('#cent-braco, #centro, #rodape, #centro div').css({'opacity':'0'})
	
	$('#carregador').fadeIn(vel);
	window.onload = function(){
		
		$('#logo').animate({'top':'-35px'},800,'easeOutBack',function(){
			$('#menu').animate({'opacity':'1','left':'275px'},1000,'easeOutBounce',function(){
				$('#cent-braco, #centro').animate({'opacity':'1'},600,function(){
					$('#centro div').animate({'opacity':'1'},600,function(){
						$('#rodape').animate({'opacity':'1'},600,function(){
							$('#wrap').fadeOut(0,function(){
								$('#menu li').hover(function(){
									$('p',this).stop().animate({color:'#F00'});
								},function(){
									$('p',this).stop().animate({color:'#333'});
								});
							});		
						});
					});
				});
			})
		});
				
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
		
	}
	
});
</script>
</head>

<body>
	<div id="wrap"></div>
	<div id="carregador"><p>Carregando...</p><img src="image/ajax-loader.gif" alt=""></div>
	<div id="container">
    	<div id="topo">
        	<div id="topo_cont">
            	<div id="topo_menu">
                    <div id="logo">
                        <a href="javascript:void(0);" id="botao" class="principal"><img src="image/logo.png" alt=""></a>
                    </div>
                    <div id="menu">
                        <ul>
                            <li class="principal"><p>Home</p></li>
                            <li class="empresa"><p>Empresa</p></li>
                            <li class="testes"><p>Testes Especiais</p></li>
                            <li class="durabilidade"><p>Durabilidade</p></li>
                            <li class="clientes" style="display:none !important;"><p>Clientes</p></li>
                            <li class="contato"><p>Fale Conosco</p></li>
                        </ul>
                    </div>
                </div>
                <div id="cent-braco"></div>
                <div id="centro"><div><div id="espera">Carregando Conteúdo da Pagina...</div></div></div>
                <div id="rodape">
                    Desenvolvido por <a href="http://www.levelhard.com" target="_blank">LevelHard 2011</a>.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
