<?php

	require "../core.php";
	$news = new Veiculo;
	
	$_SESSION["search_prop"] 	= "";
	$_SESSION["search_prop2"] 	= "";
	$_SESSION["search_veic"] 	= "";
	
	$QueryProp = "SELECT codigo, nome, sobrenome FROM proprietario ORDER BY nome";
	$QueryPropApply = mysql_query($QueryProp);
	$QueryPropResults = mysql_num_rows($QueryPropApply); 
	if ($QueryPropResults > 0)
	{
		while ($ResultRowProp = mysql_fetch_array($QueryPropApply)) 
		{
			$bd_result_p[1]	= $ResultRowProp["codigo"];
			$bd_result_p[2]	= $ResultRowProp["nome"];
			$bd_result_p[3]	= $ResultRowProp["sobrenome"];
			
			$opt_name = $bd_result_p[2].' '.$bd_result_p[3];
			
			$opt_prop .= '<option value="'.$bd_result_p[1].'" '.$opt_prop_sel[$bd_result_p[1]].'>'.Truncate($opt_name,40).'</option>';
		}
	}
	
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
	$('form[name=veic_search]').ajaxForm({
		target: '#p_data', 
		beforeSubmit:  function() { 
			$('#loading').fadeIn(200);
		},
		success: function() {
			$('#loading').fadeOut(200);
		} 
	});
	$('#fancy_ajax').click(function(){
		html = '<p style="font-size:14px;text-align:center;padding:5px;"><b>Relatório de dados sobre veículos cadastrados</b><p>';
		$('#p_menu').fadeOut(100,function(){
			$('#p_menu').html(html).fadeIn(100,function(){
				window.print();
			});
		});
	});
});

</script>
</head>

<body style="background:#FFF; border:1px #CCC solid;">
    <div id="p_cont">
        <div id="p_menu">
            <div id="p_act">
            <a id="fancy_ajax" class="fancy_button" href="javascript:void(0)">Imprimir</a>
            </div>
            <div id="p_search">
            <form name="veic_search" action="../action/fs_veic_search.php" method="get">
            	<input type="hidden" name="type" value="1" />
                <select name="cod_prop">
                <option value="" style="color:#666; background:#F5F5F5;">Selecione o Proprietário</option>
                <?php print $opt_prop ?>
                </select>
                <input type="text" name="search">
                <input type="submit" value="Procurar">
            </form>
            </div>
        </div>
        <div id="p_header">
        <ul>
            <li class="p_col2">Proprietário</li>
            <li class="p_col3">Marca</li>
            <li class="p_col1">Modelo</li>
            <li class="p_col4">Ano</li>
            <li class="p_col5">Placa</li>
        </ul>
        </div>
        <div id="p_data" style="height:500px; overflow-y:auto;">
        <?php $news->ShowVeic($veicData,'',1); ?>
        </div>
    </div>
</body>
</html>