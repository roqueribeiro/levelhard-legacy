<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="icon" href="favicon.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
<title>LevelHard - Painel Administrativo</title>
<link rel="stylesheet" href="styles/default-html.css" media="screen">
<link rel="stylesheet" href="styles/default-theme.css" media="screen">
<link rel="stylesheet" href="styles/default-tooltip.css" media="screen">
<script type="text/javascript" src="scripts/jquery-1.6.3.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript" src="scripts/jquery.tooltip.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#console').hide().draggable({cancel:'#console #result'});
	
	$('#carregando').show();
	$.post('core.php',{'action':'TelaPainel'},function(data){
		$('#carregando').hide();
		$('#conteudo').html(data);
		$('#conteudo #top').delay(150).fadeIn(300);
		$('#conteudo #middle').delay(300).fadeIn(300);
		$('#conteudo #bottom').delay(450).fadeIn(300,function(){
			$('#login input[name=usuario]').focus();	
		});
	});
	
});
</script>
</head>

<body>

	<div id="wrap"></div>
    <div id="wrap-ajax"></div>
	<div id="console"><div id="result"></div></div>
    <div id="carregando"><img src="images/loading.gif" alt=""></div>
    <div id="alerta">
        <div id="result">
        	<div id="titulo">
            <ul>
            	<li><img src="images/icons/Alert16.png" alt=""></li>
                <li><p></p></li>
            </ul>
            </div>
            <div id="ajax"><p></p></div>
            <div id="botao"><input type="button" value="Fechar"></div>
        </div>
    </div>
	<div id="conteudo"></div>

</body>
</html>