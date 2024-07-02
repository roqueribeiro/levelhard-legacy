<?php

	require "../core.php";

	$cod_veic = $_GET['idCod'];
			
	if($cod_veic)
	{
		$Query = "SELECT * FROM veiculo WHERE codigo = ".$cod_veic.";";
		$QueryApply = mysql_query($Query);
		$QueryResults = mysql_num_rows($QueryApply); 
		if ($QueryResults > 0)
		{
			while ($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result[1] 	= $ResultRow["codigo"];
				$bd_result[2] 	= $ResultRow["cod_proprietario"];
				$bd_result[3] 	= $ResultRow["marca"];
				$bd_result[4] 	= $ResultRow["modelo"];
				$bd_result[5] 	= $ResultRow["ano"];
				$bd_result[6] 	= $ResultRow["placa"];
			}
		}
		
		$opt_prop_sel[$bd_result[2]]	= 'selected="selected"';
		$opt_veic_sel[$bd_result[3]] 	= 'selected="selected"';
		$opt_ano_sel[$bd_result[5]] 	= 'selected="selected"';
				
		$language["form_veic_tit"] = "Formulário de Edição de Veículos";
		$language["form_veic_url"] = "action/fs_veic_edit.php";
		
	}
	else
	{
		$language["form_veic_tit"] = "Formulário de Cadastro de Veículos";
		$language["form_veic_url"] = "action/fs_veic_add.php";
	}
	
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
$(document).ready(function(){
	$('form[name=veic_act]').ajaxForm({
		target: '#p_data',
		beforeSubmit: function()
		{
			$('#loading').fadeIn(200);
//			if(!$('input[name=nome]').attr('value'))
//			{
//				alert('Complete o campo nome');
//				$('input[name=nome]').focus();
//				$('#loading').hide();
//				return false;
//			}
//			if(!$('input[name=sobrenome]').attr('value'))
//			{
//				alert('Complete o campo Sobrenome');
//				$('input[name=sobrenome]').focus();
//				$('#loading').hide();
//				return false;
//			}
//			if(!$('input[name=num_rg]').attr('value'))
//			{
//				alert('Complete o campo RG');
//				$('input[name=num_rg]').focus();
//				$('#loading').hide();
//				return false;
//			}
//			if(!$('input[name=num_cpf]').attr('value'))
//			{
//				alert('Complete o campo CPF');
//				$('input[name=num_cpf]').focus();
//				$('#loading').hide();
//				return false;
//			}
//			if(!$('input[name=num_cnh]').attr('value'))
//			{
//				alert('Complete o campo CNH');
//				$('input[name=num_cnh]').focus();
//				$('#loading').hide();
//				return false;
//			}
//			if(!$('input[name=telefone]').attr('value'))
//			{
//				alert('Complete o campo Telefone');
//				$('input[name=telefone]').focus();
//				$('#loading').hide();
//				return false;
//			}
//			if(!$('input[name=end_cep]').attr('value'))
//			{
//				alert('Complete o campo CEP');
//				$('input[name=end_cep]').focus();
//				$('#loading').hide();
//				return false;
//			}
//			if(!$('input[name=end_rua]').attr('value'))
//			{
//				alert('Complete o campo Rua');
//				$('input[name=end_rua]').focus();
//				$('#loading').hide();
//				return false;
//			}
//			if(!$('input[name=end_numero]').attr('value'))
//			{
//				alert('Complete o campo Numero');
//				$('input[name=end_numero]').focus();
//				$('#loading').hide();
//				return false;
//			}
//			if(!$('input[name=end_bairro]').attr('value'))
//			{
//				alert('Complete o campo Bairro');
//				$('input[name=end_bairro]').focus();
//				$('#loading').hide();
//				return false;
//			}
//			if(!$('input[name=end_cidade]').attr('value'))
//			{
//				alert('Complete o campo Cidade');
//				$('input[name=end_cidade]').focus();
//				$('#loading').hide();
//				return false;
//			}
		},
		success:function()
		{
			AjaxDelete();
			ActFancyBox();
			AjaxToolTip();
			$('#loading').fadeOut(200);
			alert('Concluido!')
		} 
	});
});
</script>	

<div id="prop_form">
	<form name="veic_act" action="<?php print $language["form_veic_url"] ?>" method="get">
    <input type="hidden" name="codigo" value="<?php print $bd_result[1] ?>" />
	<fieldset>
		<legend><?php print $language["form_veic_tit"] ?></legend>
        <ul>
        	<li class="form_col01">Proprietário *</li>
            <li class="form_col02">
                <select name="cod_proprietario">
                <option value=""></option>
                <?php print $opt_prop ?>
                </select>
            </li>
        </ul>
        <ul>
        	<li class="form_col01">Marca *</li>
            <li class="form_col02">
                <select name="marca">
                    <option value=""></option>
                    <option value="ASTON MARTIN" 	<?php print $opt_veic_sel["ASTON MARTIN"] ?>>ASTON MARTIN</option>
                    <option value="BUGATTI" 		<?php print $opt_veic_sel["BUGATTI"] ?>>BUGATTI</option>
                    <option value="CHEVROLET" 		<?php print $opt_veic_sel["CHEVROLET"] ?>>CHEVROLET</option>
                    <option value="FIAT" 			<?php print $opt_veic_sel["FIAT"] ?>>FIAT</option>
                    <option value="FORD" 			<?php print $opt_veic_sel["FORD"] ?>>FORD</option>
                    <option value="HONDA" 			<?php print $opt_veic_sel["HONDA"] ?>>HONDA</option>
                    <option value="PEGEOT" 			<?php print $opt_veic_sel["PEGEOT"] ?>>PEGEOT</option>
                    <option value="PORSCHE" 		<?php print $opt_veic_sel["PORSCHE"] ?>>PORSCHE</option>
                    <option value="RENAULT" 		<?php print $opt_veic_sel["RENAULT"] ?>>RENAULT</option>
                    <option value="FERRARI" 		<?php print $opt_veic_sel["FERRARI"] ?>>FERRARI</option>
                    <option value="SHELBY" 			<?php print $opt_veic_sel["SHELBY"] ?>>SHELBY</option>
                    <option value="SUZUKI" 			<?php print $opt_veic_sel["SUZUKI"] ?>>SUZUKI</option>
                    <option value="VOLKSWAGEN" 		<?php print $opt_veic_sel["VOLKSWAGEN"] ?>>VOLKSWAGEN</option>
                </select>
            </li>
        </ul>
        <ul>
        	<li class="form_col01">Modelo *</li>
            <li class="form_col02">
                <input type="text" name="modelo" value="<?php print $bd_result[4] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">Ano *</li>
            <li class="form_col02">
                <select name="ano">
                    <option value=""></option>
                    <option <?php print $opt_ano_sel["2000"] ?>>2000</option>
                    <option <?php print $opt_ano_sel["2001"] ?>>2001</option>
                    <option <?php print $opt_ano_sel["2002"] ?>>2002</option>
                    <option <?php print $opt_ano_sel["2003"] ?>>2003</option>
                    <option <?php print $opt_ano_sel["2004"] ?>>2004</option>
                    <option <?php print $opt_ano_sel["2005"] ?>>2005</option>
                    <option <?php print $opt_ano_sel["2006"] ?>>2006</option>
                    <option <?php print $opt_ano_sel["2007"] ?>>2007</option>
                    <option <?php print $opt_ano_sel["2008"] ?>>2008</option>
                    <option <?php print $opt_ano_sel["2009"] ?>>2009</option>
                    <option <?php print $opt_ano_sel["2010"] ?>>2010</option>
                    <option <?php print $opt_ano_sel["2011"] ?>>2011</option>
                </select>
            </li>
        </ul>
        <ul>
        	<li class="form_col01">Placa *</li>
            <li class="form_col02">
                <input type="text" name="placa" value="<?php print $bd_result[6] ?>" />
            </li>
        </ul>
        <ul>
            <li class="form_colspan">
            <input type="submit" value="Salvar">
            </li>
        </ul>
	</fieldset>
	</form>
</div>	
