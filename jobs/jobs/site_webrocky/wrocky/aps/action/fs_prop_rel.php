<?php

	require "../core.php";
	$news = new Proprietario;
	
	$_SESSION["search_prop"] 	= "";
	$_SESSION["search_prop2"] 	= "";
	$_SESSION["search_veic"] 	= "";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print $language['sitename']; ?></title>
<link rel="stylesheet" href="../css/style_all.css" />
<script type="text/javascript" src="../scripts/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="../scripts/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('form[name=prop_search]').ajaxForm({
		target: '#p_data', 
		beforeSubmit:  function() { 
			$('#loading').fadeIn(200);
		},
		success: function() {
			$('#loading').fadeOut(200);
		} 
	});
	$('#fancy_ajax').click(function(){
		html = '<p style="font-size:14px;text-align:center;padding:5px;"><b>Relatório de dados sobre proprietários cadastrados</b><p>';
		$('#p_menu').fadeOut(100,function(){
			$('#p_menu').html(html).fadeIn(100,function(){
				window.print();
			});
		});
	});
});

</script>
</head>

<div id="p_cont" style="background:#FFF; border:1px #CCC solid;">
	<div id="p_menu">
        <div id="p_act">
        <a id="fancy_ajax" class="fancy_button" href="javascript:void(0)">Imprimir</a>
        </div>
        <div id="p_search">
        <form name="prop_search" action="../action/fs_prop_search.php" method="get">
        	<input type="hidden" name="type" value="1">
            <input type="text" name="search">
            <input type="submit" value="Procurar">
        </form>
        </div>
    </div>
    <div id="p_header">
    <ul>
        <li class="p_col1">Nome</li>
        <li class="p_col2">Sobrenome</li>
        <li class="p_col3">Telefone</li>
        <li class="p_col4">Celular</li>
        <li class="p_col5">CPF</li>
    </ul>
    </div>
    <div id="p_data" style="height:500px; overflow-y:auto;">
	<?php
        $news->ShowProp($search_prop,1);
    ?>
    </div>
</div>