<!DOCTYPE html>
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge, chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="description" content="Galeria de desenvolvimentos de Roque Ribeiro">
<meta name="author" content="Roque Ribeiro da Silva">
<title>LevelHard - Jobs</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="default.css">
<script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	function activeListFunctions()
	{
		$('#lista ul:nth-child(2n+2)').css('background','#EEE');
		
		$('#corpo #conteudo #lista ul').hover(function(){
			bgcolor = $(this).css('background-color');
			$(this).css({ backgroundColor: '#444', color: '#FFF' });
		},function(){
			$(this).css({ backgroundColor: bgcolor, color: '#444' });
		});
		
		$('#corpo #conteudo #lista ul').click(function(){
			window.open($(this).attr('class'));
		});
	}
	
	$.ajax({
		url: 'core.php',
		beforeSend:function(){
			$('#lista').html('<ul><li id="mensagem">Carregando</li></ul>');
		}
	}).done(function(data) {
		$('#lista').html(data);
		activeListFunctions();
	});	
	
	$('form[name=busca]').ajaxForm({
		beforeSubmit:function(){
			$('#lista').html('<ul><li id="mensagem">Carregando</li></ul>');
		},
		success:function(data){
			$('#lista').html(data);
			activeListFunctions();
		}
	});
		
});
</script>
</head>

<body>

<div id="gradient"></div>

<div id="corpo">

	<div id="logo"><img src="images/logo.png" alt="" height="100"></div>
    
    <div id="container">
        <div id="conteudo">
        <form name="busca" action="core.php" method="post">
            <div id="cabecalho">
                <img src="images/icon-folder-web.png" alt="">
                <p>Projetos e Desenvolvimentos</p>
                <input type="text" name="busca" value="" placeholder="Pesquisar">
            </div>
            <div id="lista"></div>
        </form>
        </div>
    </div>
	
</div>

</body>
</html>