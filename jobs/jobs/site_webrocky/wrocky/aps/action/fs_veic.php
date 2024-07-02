<?php
	require "../core.php";
	$news = new Veiculo;
	
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
<script type="text/javascript">
function AjaxDelete()
{
	$(document).ready(function(){
		$('a#but_delete').click(function(){
			id = $(this).attr('class');
			if(window.confirm('Você deseja deletar este item?'))
			{
				$('#loading').fadeIn(200);
				$.get("action/fs_veic_del.php",{'idCod':id},function(data){
					$('#loading').fadeOut(200);
					$('#p_data').html(data);
					ActFancyBox();
					AjaxDelete();
				    AjaxToolTip();
				});			
			}
			else
			{
				return false;
			}
		});
	});
}
function AjaxToolTip()
{
	$('#p_cont a').tooltip({ 
		track	:true,
		delay	:0, 
		showURL	:false, 
		fade	:600 
	});
}
$(document).ready(function(){
	
	AjaxDelete();
	AjaxToolTip();
	
	$('form[name=veic_search]').ajaxForm({
		target: '#p_data', 
		beforeSubmit:  function() { 
			$('#loading').fadeIn(200);
		},
		success: function() {
			AjaxDelete();
			ActFancyBox();
			AjaxToolTip();
			$('#loading').fadeOut(200);
		} 
	});
		
});
</script>
<div id="p_cont">
	<div id="p_menu">
        <div id="p_act">
        <a id="fancy_ajax" class="fancy_button" href="action/fs_veic_form.php">Adicionar Veículo</a>
        <a id="fancy_frame" class="fancy_button" href="action/fs_veic_rel.php">Gerar Relatório</a>
        </div>
        <div id="p_search">
        <form name="veic_search" action="action/fs_veic_search.php" method="get">
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
        <li class="p_col0"></li>
        <li class="p_col0"></li>
        <li class="p_col2">Proprietário</li>
        <li class="p_col3">Marca</li>
        <li class="p_col1">Modelo</li>
        <li class="p_col4">Ano</li>
        <li class="p_col5">Placa</li>
    </ul>
    </div>
    <div id="p_data">
	<?php $news->ShowVeic($veicData); ?>
    </div>
</div>