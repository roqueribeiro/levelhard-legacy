<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noodp,noydir" /> 
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<title>Espaco Lar</title>
<link rel="stylesheet" href="style/template.css">
<link rel="stylesheet" href="style/jquery-tooltip.css">
<link rel="stylesheet" href="script/fancybox/jquery.fancybox-1.3.4.css">
<script type="text/javascript" src="script/jquery-1.6.min.js"></script>
<script type="text/javascript" src="script/jquery-tooltip.js"></script>
<script type="text/javascript" src="script/jquery.transform-0.9.3.min.js"></script>
<script type="text/javascript" src="script/jquery-ui-1.8.12.custom.min.js"></script>
<script type="text/javascript" src="script/jquery.form.js"></script>
<script type="text/javascript" src="script/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
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
function fancyListActive()
{
	$('a#fancylist').fancybox({
		'padding'		: '0px',
		'margin'		: '30px',
		'transitionIn'	: 'fade',
		'transitionOut'	: 'fade',
		'speedIn'		: 300, 
		'speedOut'		: 300,
		'overlayColor'	: '#000'
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
	
	$('#menu li').hover(function(){
		$('ul',this).stop().show().animate({'margin-left':'-16px','opacity':'1'},600);
	},function(){
		$('ul',this).stop().animate({'opacity':'0'},function(){
			$(this).hide().animate({'margin-left':'-100px'},600);	
		});
	});
	
	$('#carregador').fadeIn(vel);
	$.post('core/core.php',{'tela':'principal'},function(data){
		$('#carregador').fadeOut(vel);
		$('#centro div').fadeOut(vel,function(){
			$(this).html(data).fadeIn((vel+300));
			fancyListActive();
			fancyActive();
			tooltipActive();
			$('#wrap').fadeOut(300);
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
								fancyListActive();
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
});
</script>
</head>

<body>
	<div id="wrap"></div>
	<div id="carregador"><p>Carregando...</p><img src="image/ajax-loader.gif" alt=""></div>
	<div id="container">
    	<div id="topo">
        	<div id="topo_cont">
                <div id="social">
                <ul>
                    <li><a href="http://www.facebook.com/profile.php?id=100002341180186" target="_blank"><img src="image/icones/social/FaceBook_48x48.png"></a></li>
                    <li><a href="javascript:void(0);"><img src="image/icones/social/Twitter_48x48.png" style="opacity:0.3"></a></li>
                    <li><a href="javascript:void(0);"><img src="image/icones/social/Youtube_48x48.png" style="opacity:0.3"></a></li>
                </ul>
                </div>
                <div id="logo">
                	<a href="javascript:void(0);" id="botao" class="principal"><img src="image/logo.png"></a>
                </div>
                <div id="menu">
                    <ul>
                        <li class=""><p>Decoração</p>
                        <ul>
                            <li class="decoracao_vaso">Vaso</li>
                            <li class="decoracao_abajur">Abajur</li>
                            <li class="decoracao_almofada">Almofadas</li>
                            <li class="decoracao_retrato">Porta Retrato</li>
                            <li class="decoracao_outros">Outros</li>
                        </ul>
                        </li>
                        <li class=""><p>Presentes</p>
                        <ul>
                            <li class="presentes_acessorios">Bar Acessórios</li>
                            <li class="presentes_bebida">Bar Bebidas</li>
                            <li class="presentes_utilidade">Utilidades</li>
                        </ul>
                        </li>
                        <li class="casamento_1"><p>Lista de Casamento<p></li>
                        <li class="parceiros"><p>Parceiros</p></li>
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
