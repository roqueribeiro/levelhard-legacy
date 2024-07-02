<?php include("config.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php print $titulo ?></title>
<link rel="stylesheet" type="text/css" href="corpo.css">
<link rel="stylesheet" type="text/css" href="scripts/fancybox/jquery.fancybox-1.3.4.css">
<script type="text/javascript" src="scripts/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	desc = $('#descricao');
	
	if(desc.attr('class') == 'close')
	{
		desc.css({'display':'none'}); 
		$('#cabecalho span').text('[+]');
	}
	else
	{
		desc.css({'display':'block'}); 
		$('#cabecalho span').text('[-]');
	}
		
	$('#cabecalho').click(function(){
		if(desc.attr('class') == 'close')
		{
			$('#descricao').slideDown(300,function(){ 
				$(this).attr('class','open'); 
				$('#cabecalho span').text('[-]'); 
			});
		}
		else
		{
			$('#descricao').slideUp(300,function(){ 
				$(this).attr('class','close'); 
				$('#cabecalho span').text('[+]'); 
			});
		}
	});
	
	$('input[type=button]').click(function(){
		window.location = '<?php print $site_link ?>';
	});
	
	$("a[rel=group]").fancybox({
		'padding'			: '0',
		'margin'			: '50',
		'titlePosition'		: 'over',
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'transitionIn'		: 'elastic',
		'transitionOut'		: 'elastic',
		'easingIn'      	: 'easeOutBack',
		'easingOut'     	: 'easeInBack'
	});
	
});
</script>
</head>

<body>
<div id="corpo">
<div id="logo"><h2><?php print $logo ?></h2><p><?php print $logo_sub ?></p></div>
    <div id="conteudo">
        <div id="texto">
        <ul>
        	<li id="cabecalho"><?php print $cabecalho ?> <span>[-]</span></li>
            <li id="descricao" class="<?php print $descricao_oc ?>"><?php print $descricao ?></li>
        </ul>
        </div>
        <div id="galeria">
            <ul id="imagens">
                <li><a rel="group" href="<?php print $imagem[1][0] ?>" title="<?php print $imagem[2][0] ?>"><img src="<?php print $imagem[0][0] ?>"></a></li>
                <li><a rel="group" href="<?php print $imagem[1][1] ?>" title="<?php print $imagem[2][1] ?>"><img src="<?php print $imagem[0][1] ?>"></a></li>
                <li><a rel="group" href="<?php print $imagem[1][2] ?>" title="<?php print $imagem[2][2] ?>"><img src="<?php print $imagem[0][2] ?>"></a></li>
            </ul>
        </div>
        <div id="rodape">
        	<input type="button" value="<?php print $botao ?>">
        </div>
    </div>
    <div id="limpo"></div>
</div>
    
</body>
</html>
