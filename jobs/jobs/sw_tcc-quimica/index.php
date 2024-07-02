<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>WebTCC</title>
<link rel="stylesheet" type="text/css" href="css/default-html.css">
<link rel="stylesheet" type="text/css" href="css/default-theme.css">
<script type="text/javascript" src="js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(e){
		
	$('#reagente, #comofazerDiv, #resultadoDiv, #cancelar').hide();
	
	//Carrega Lista de Caracteristicas
	$('#caracteristica li:last-child').append('<img id="loader" src="img/loader.gif" alt="">');
	$('select[name=caracteristica]').attr('disabled','disabled');
	$.get('core.php',{'produto':'listar'},function(data){
		$('select[name=caracteristica]').html(data);
		$('select[name=caracteristica]').removeAttr('disabled');
		$('#caracteristica li:last-child #loader').remove();
	});	
	
	//Carrega Lista de Reagentes de Acordo com as Caracteristicas
	$('select[name=caracteristica]').change(function(){
		$(this).attr('disabled','disabled');
		$('#caracteristica li:last-child').append('<img id="loader" src="img/loader.gif" alt="">');
		$.get('core.php',{'caracteristica':$(this).val()},function(data){
			$('select[name=reagente]').html(data);
			$('#reagente').fadeIn();
			$('#cancelar').fadeIn();
			$('#caracteristica li:last-child #loader').remove();
		});
	});
	
	//Carrega Lista de ComoFazer de Acordo com os Reagentes	
	$('select[name=reagente]').change(function(){
		$('#reagente li:last-child').append('<img id="loader" src="img/loader.gif" alt="">');
		$(this).attr('disabled','disabled');
		$.get('core.php',{'reagente':$(this).val()},function(data){
			$('#comofazerDiv ul.form-elements').html(data);
			$('#comofazerDiv').fadeIn();
			$('#reagente li:last-child #loader').remove();
			//Carrega Lista de Resultados de Acordo com os ComoFazer 
			$('input[name=comofazer]').click(function(){
				$('#comofazerDiv ul li.cab').append('<img id="loader" src="img/loader.gif" alt="">');
				$('input[name=comofazer]').attr('disabled','disabled');
				$.get('core.php',{'comofazer':$(this).val()},function(data){
					$('#resultadoDiv ul.form-elements').html(data);
					$('#resultadoDiv').fadeIn();
					$('#comofazerDiv ul li.cab #loader').remove();
					//Carrega Produto de Acordo com os Resultados
					$('input[name=resultado]').click(function(){
						$('#resultadoDiv ul li.cab').append('<img id="loader" src="img/loader.gif" alt="">');
						$('input[name=resultado]').attr('disabled','disabled');
						$.get('core.php',{'resultado':$(this).val()},function(data){
							$('#produto .fim').html(data);
							$('#produto').fadeIn();
							$('#resultadoDiv ul li.cab #loader').remove();
						});
					});	
						
				});
			});
			
		});
	});
	
	//Reseta Navegação
	$('input[name=cancelar]').click(function(){
		$('#reagente, #comofazerDiv, #resultadoDiv, #produto, #cancelar').slideUp();
		$('select,input').removeAttr('disabled');
		$('select[name=caracteristica] option[value="0"]').attr('selected','selected');
	});
		
});
</script>
</head>

<body>

<div id="falseBody">
	<div id="titulo"><div>Trabalho de TCC</div></div>
    <div id="cancelar">
    <input type="button" name="cancelar" value="Voltar ao Início">
    </div>
    <div id="formulario">
    <form name="pesquisa" action="core.php" method="get">
        <ul id="caracteristica">
            <li>Característica da Solução</li>
            <li><select name="caracteristica"></select></li>
        </ul>
        <ul id="reagente">
            <li>Reagente</li>
            <li><select name="reagente"></select></li>
        </ul>
        <div id="comofazerDiv">
            <ul>
                <li class="cab">Como Fazer</li>
            </ul>	
            <ul class="form-elements"></ul>
        </div>
        <div id="resultadoDiv">
            <ul>
                <li class="cab">Resultado</li>
            </ul>	
            <ul class="form-elements"></ul>
        </div>
    </form>
    </div>
    <div id="produto">
    	<ul>
        	<li><img src="img/arrow_left.png" alt="">Produto à ser utilizado:<span class="fim">Potássio</span></li>
        </ul>
    </div>
</div>

<div id="copyright"><a href="http://www.levelhard.com.br" target="_blank"><b>LevelHard 2012</b></a> Basic Form</div>

</body>
</html>