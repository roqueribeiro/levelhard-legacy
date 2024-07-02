<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noodp,noydir" /> 
<meta name="description" content="Lenha Ecológica Martins, empresa familiar, que atua a cinco anos no mercado de energia renovável." />
<meta name="keywords" content="lenha ecológica, lenhas, ecologia, ecológico, energia renovável, martins" />
<link rel="icon" href="image/favicon.png" type="image/x-icon">
<link rel="shortcut icon" href="image/favicon.png" type="image/x-icon">
<title>Lenha Ecologica Martins</title>

<link rel="stylesheet" href="style/template1.css">

<!--<link rel="stylesheet" href="style/jquery-ui.min.css">
<link rel="stylesheet" href="style/jquery-ui.theme.min.css">
<link rel="stylesheet" href="style/jquery-ui.structure.min.css">-->

<link rel="stylesheet" href="script/fancybox/jquery.fancybox.css">

<script type="text/javascript" src="script/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="script/jquery-ui.min.js"></script>
<script type="text/javascript" src="script/jquery.form.min.js"></script>
<script type="text/javascript" src="script/jquery.maskedinput.min.js"></script>

<script type="text/javascript" src="script/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="script/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>

<script type="text/javascript">
function fancyActive()
{
	$('a[rel=group]').fancybox({
		padding		: '0px',
		openEffect	: 'elastic',
		closeEffect	: 'elastic',
		helpers : {
			overlay : {
				css : {
					background : 'rgba(0,0,0,0.8)'
				}
			}
		}
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
					
	var vel = 100;
	$('#topo').disableSelection();
	$('#carregador').fadeIn(vel);
	$.post('core/core.php', {
			tela: 'principal'
		}, function(data){
			$('#carregador').fadeOut(vel);
			$('#centro div').fadeOut(vel,function(){
				$(this).html(data).fadeIn((vel+300));
				fancyActive();
			});
			$('#menu li, #botao').click(function(){
				var destino = $(this).attr('class');
				$('#carregador').fadeIn(vel,function(){
					$.post('core/core.php',{'tela':destino},function(data){
						$('#carregador').fadeOut(vel);
						$('#centro div').fadeOut(vel,function(){
							$(this).html(data).fadeIn((vel+300));
							fancyActive();
						});
					});
				});
			});
		}
	);
});
</script>
</head>

<body>
	<div id="carregador"><p>Carregando...</p><img src="image/ajax-loader.gif" alt=""></div>
	<div id="container">
    	<div id="topo">
        	<div id="topo_cont">
                <div id="logo">
                	<a href="javascript:void(0);" id="botao" class="principal"><img src="image/logo-lenhaeco.png"></a>
                </div>
                <div id="menu">
                    <ul>
                        <li class="principal"><p>Home</p></li>
                        <li class="produtos"><p>Produtos</p></li>
                        <li class="quemsomos"><p>Quem Somos</p></li>
                        <li class="contato"><p>Contato</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="centro"><div><div id="espera">Carregando Conteúdo da Pagina...</div></div></div>
        <div id="rodape">Desenvolvido por Roque Ribeiro. <a href="http://www.levelhard.com.br" target="_blank">LevelHard</a></div>
    </div>
</body>
</html>
