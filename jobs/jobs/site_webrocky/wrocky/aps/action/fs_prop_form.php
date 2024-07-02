<?php

	require "../core.php";

	$cod_prop = $_GET['idCod'];
	
	if($cod_prop)
	{
		$Query = "SELECT * FROM proprietario WHERE codigo = ".$cod_prop.";";
		$QueryApply = mysql_query($Query);
		$QueryResults = mysql_num_rows($QueryApply); 
		if ($QueryResults > 0)
		{
			while ($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result[1] 	= $ResultRow["codigo"];
				$bd_result[2] 	= $ResultRow["nome"];
				$bd_result[3] 	= $ResultRow["sobrenome"];
				$bd_result[4] 	= $ResultRow["telefone"];
				$bd_result[5] 	= $ResultRow["celular"];
				$bd_result[6] 	= $ResultRow["end_rua"];
				$bd_result[7] 	= $ResultRow["end_numero"];
				$bd_result[8] 	= $ResultRow["end_bairro"];
				$bd_result[9] 	= $ResultRow["end_cep"];
				$bd_result[10] 	= $ResultRow["end_cidade"];
				$bd_result[11] 	= $ResultRow["end_estado"];
				$bd_result[12] 	= $ResultRow["num_rg"];
				$bd_result[13] 	= $ResultRow["num_cpf"];
				$bd_result[14] 	= $ResultRow["num_cnh"];
			}
		}
		
		$language["form_prop_tit"] = "Formulário de Edição de Proprietário";
		$language["form_prop_url"] = "action/fs_prop_edit.php";
		
	}
	else
	{
		$language["form_prop_tit"] = "Formulário de Cadastro de Proprietário";
		$language["form_prop_url"] = "action/fs_prop_add.php";
	}

?>

<script type="text/javascript">
$(document).ready(function(){
	
	$('input[name=num_rg]').mask('99.999.999-99');
	$('input[name=num_cpf]').mask('999.999.999-99');
	$('input[name=telefone]').mask('(99) 9999-9999');
	$('input[name=celular]').mask('(99) 9999-9999');
	$('input[name=end_cep]').mask('99999-999',{placeholder:''});
	
	$('input[name=end_cep]').keypress(function(){
		cep_num = $('input[name=end_cep]').attr('value');
		if(cep_num.length == 9)
		{
			$('input[name=end_rua]').attr('value','Carregando...');
			$('input[name=end_bairro]').attr('value','Carregando...');
			$('input[name=end_cidade]').attr('value','Carregando...');
			$.post('action/fs_ajax_cep.php', {busca_cep: cep_num}, function(resposta) {
				eval('var arr = '+resposta);
				$('input[name=end_rua]').attr('value',arr.rua);
				$('input[name=end_bairro]').attr('value',arr.bairro);
				$('input[name=end_cidade]').attr('value',arr.cidade);
				$('select[name=end_estado] option').each(function() {
					if($(this).attr('value') == arr.uf)
					{
						$(this).attr('selected','selected');
					}
				});
			});
		}
		else
		{
			$('input[name=end_rua]').attr('value','');
			$('input[name=end_bairro]').attr('value','');
			$('input[name=end_cidade]').attr('value','');
		}
	})

	$('form[name=prop_act]').ajaxForm({
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
	<form name="prop_act" action="<?php print $language["form_prop_url"] ?>" method="get">
	<fieldset>
		<legend><?php print $language["form_prop_tit"] ?></legend>
        <input type="hidden" name="codigo" value="<?php print $bd_result[1] ?>" />
        <ul>
        	<li class="form_col01">Nome *</li>
            <li class="form_col02">
            <input type="text" name="nome" value="<?php print $bd_result[2] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">Sobrenome *</li>
            <li class="form_col02">
            <input type="text" name="sobrenome" value="<?php print $bd_result[3] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">RG *</li>
            <li class="form_col02">
            <input type="text" name="num_rg" value="<?php print $bd_result[12] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">CPF *</li>
            <li class="form_col02">
            <input type="text" name="num_cpf" value="<?php print $bd_result[13] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">CNH *</li>
            <li class="form_col02">
            <input type="text" name="num_cnh" value="<?php print $bd_result[14] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">Telefone *</li>
            <li class="form_col02">
            <input type="text" name="telefone" value="<?php print $bd_result[4] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">Celular</li>
            <li class="form_col02">
            <input type="text" name="celular" value="<?php print $bd_result[5] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">CEP *</li>
            <li class="form_col02">
            <input type="text" name="end_cep" value="<?php print $bd_result[9] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">Rua *</li>
            <li class="form_col02">
            <input type="text" name="end_rua" value="<?php print $bd_result[6] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">Numero *</li>
            <li class="form_col02">
            <input type="text" name="end_numero" value="<?php print $bd_result[7] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">Bairro *</li>
            <li class="form_col02">
            <input type="text" name="end_bairro" value="<?php print $bd_result[8] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">Cidade *</li>
            <li class="form_col02">
            <input type="text" name="end_cidade" value="<?php print $bd_result[10] ?>" />
            </li>
        </ul>
        <ul>
        	<li class="form_col01">Estado *</li>
            <li class="form_col02">
            <select name="end_estado">
                <option value="AC">AC</option> 
                <option value="AL">AL</option> 
                <option value="AM">AM</option> 
                <option value="AP">AP</option> 
                <option value="BA">BA</option> 
                <option value="CE">CE</option> 
                <option value="DF">DF</option> 
                <option value="ES">ES</option> 
                <option value="GO">GO</option> 
                <option value="MA">MA</option> 
                <option value="MG">MG</option> 
                <option value="MS">MS</option> 
                <option value="MT">MT</option> 
                <option value="PA">PA</option> 
                <option value="PB">PB</option> 
                <option value="PE">PE</option> 
                <option value="PI">PI</option> 
                <option value="PR">PR</option> 
                <option value="RJ">RJ</option> 
                <option value="RN">RN</option> 
                <option value="RO">RO</option> 
                <option value="RR">RR</option> 
                <option value="RS">RS</option> 
                <option value="SC">SC</option> 
                <option value="SE">SE</option> 
                <option value="SP" selected="selected">SP</option> 
                <option value="TO">TO</option> 
            </select>
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
