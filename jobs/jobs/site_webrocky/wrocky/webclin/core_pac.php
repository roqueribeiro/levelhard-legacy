<?php

	require "wclin_config/wclin_acs.php";
	require "wclin_config/wclin_lang_ptBR.php";
	require "wclin_config/wclin_db_conn.php";
	
	if(!@$_POST["wclin_act"])
		@$wclin_act = $_GET["wclin_act"];
	else
		@$wclin_act = $_POST["wclin_act"];
	
	if($wclin_acs_session[1] > 0 or $wclin_acs_cookie[1] > 0)
	{
		switch($wclin_act)
		{
			case "pac_add":
				print wclinPacAdd();
			break;
			case "pac_edit":
				print wclinPacEdit();
			break;
			case "pac_del_form":
				print wclinPacDelForm();
			break;
			case "pac_del":
				print wclinPacDel();
			break;
			default:
				print wclinPacForm();
			break;
		}
	}
	else
	{
		die($wclin_error_msg[0]); 
	}
	
function wclinPacForm()
{
	@$wclin_pac_edit = $_GET["pac_cod"];
	
	if(isset($wclin_pac_edit))
	{
		$Query 			= "SELECT * FROM TB_CLN_PAC WHERE CLN_PAC_COD = '".$wclin_pac_edit."';";
		$QueryApply 	= mysql_query($Query);
		$QueryResults 	= mysql_num_rows($QueryApply);
		if($QueryResults != 0)
		{
			while ($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result_edit[1] 	= $ResultRow["CLN_PAC_COD"];
				$bd_result_edit[2] 	= $ResultRow["CLN_PAC_DAT"];
				$bd_result_edit[3] 	= $ResultRow["CLN_PAC_CON"];
				$bd_result_edit[4] 	= wclin_format($ResultRow["CLN_PAC_NOM"]);
				$bd_result_edit[5] 	= wclin_format($ResultRow["CLN_PAC_SNO"]);
				$bd_result_edit[6] 	= $ResultRow["CLN_PAC_SEX"];
				$bd_result_edit[7] 	= $ResultRow["CLN_PAC_TEL"];
				$bd_result_edit[8] 	= $ResultRow["CLN_PAC_CEL"];
				$bd_result_edit[9] 	= $ResultRow["CLN_PAC_PRG"];
				$bd_result_edit[10] = $ResultRow["CLN_PAC_CPF"];
				$bd_result_edit[11] = $ResultRow["CLN_PAC_NAS"];
				$bd_result_edit[12] = $ResultRow["CLN_PAC_CEP"];
				$bd_result_edit[13] = wclin_format($ResultRow["CLN_PAC_RUA"]);
				$bd_result_edit[14] = $ResultRow["CLN_PAC_NUM"];
				$bd_result_edit[15] = wclin_format($ResultRow["CLN_PAC_BAI"]);
				$bd_result_edit[16] = wclin_format($ResultRow["CLN_PAC_CID"]);
				$bd_result_edit[17] = $ResultRow["CLN_PAC_EST"];
				$bd_result_edit[18] = $ResultRow["CLN_PAC_USR"];
			}
		}
		
		$pac_edit_act = "pac_edit";
		$pac_edit_cab = "Edição de Cadastro do Paciente";
		$pac_edit_but = "Salvar Alterações";
		@$selected[1][$bd_result_edit[3]] 	= 'selected="selected"'; 
		@$selected[2][$bd_result_edit[6]] 	= 'selected="selected"';
		@$selected[3][$bd_result_edit[17]] 	= 'selected="selected"';			
		
	}
	else
	{
		$pac_edit_act = "pac_add";
		$pac_edit_cab = "Cadastro de Paciente";
		$pac_edit_but = "Cadastrar Paciente";
		@$selected[3]["SP"] = 'selected="selected"';
	}
	
	$Query 			= "SELECT CLN_CON_COD, CLN_CON_NOM FROM TB_CLN_CON ORDER BY CLN_CON_NOM;";
    $QueryApply 	= mysql_query($Query);
    $QueryResults 	= mysql_num_rows($QueryApply);
    if ($QueryResults != 0)
    {	
        while ($ResultRow = mysql_fetch_array($QueryApply)) 
        {
			$bd_result[1] = $ResultRow["CLN_CON_COD"];
			$bd_result[2] = wclin_format($ResultRow["CLN_CON_NOM"]);
			
			@$wclin_pac_con_opt .= '<option value="'.$bd_result[1].'" '.@$selected[1][$bd_result[1]].'>'.$bd_result[2].'</option>';
        }
	}
	
	$jQuery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		$('#wclin_pac_form').keydown(function(e){
			if(e.which == 13) return false;
		});
		$('#wclin_auto_cep').click(function(){
			wclin_but = $(this);
			wclin_cep = $('input[name=wclin_pac_cep]').val();
			wclin_but.attr('disabled','disabled');
			if(wclin_cep)
			{
				wclin_but.val('Buscando...');
				$.post('core_cep.php',{'wclin_cep':wclin_cep},function(data){
					eval('var arr = '+data);
					if(arr.res == 2)
						wclin_float_msg('( Logadouro Único )',3000);
					if(arr.res == 3)
						wclin_float_msg('( CEP Não Encontrado )',3000);
					$('input[name=wclin_pac_rua]').attr('value',arr.tp_logradouro+' '+arr.logradouro);
					$('input[name=wclin_pac_bairro]').attr('value',arr.bairro);
					$('input[name=wclin_pac_cidade]').attr('value',arr.cidade);
					$('select[name=wclin_pac_uf] option').each(function() {
						if($(this).attr('value') == arr.uf)
							$(this).attr('selected','selected');
					});
					wclin_but.removeAttr('disabled');
					wclin_but.val('Completar');
				});
			}
			else
			{
				wclin_pac_valid('input[name=wclin_pac_cep]','rgba(255,240,230,1)',1);
				$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
					wclin_float_msg('( Digite o CEP )',3000);
					wclin_but.removeAttr('disabled');
				});
				return false;
			}
		});
		$('input[name=wclin_pac_tel]').mask('(99) 9999-9999');
		$('input[name=wclin_pac_cel]').mask('(99) 9999-9999');
		$('input[name=wclin_pac_rg]').mask('99.999.999-*');
		$('input[name=wclin_pac_cpf]').mask('999.999.999-99');
		$('input[name=wclin_pac_nas]').mask('99/99/9999');
		$('input[name=wclin_pac_cep]').mask('99999-999');
		$('form#wclin_pac_form').ajaxForm({
			beforeSubmit:function()
			{
				$('#wclin_pac_form input[type=submit]').attr('disabled','disabled');
				$('#wclin_loader').animate({'opacity':'1','top':'0px'},100);
				if(!$('input[name=wclin_pac_nome]').val())
				{
					wclin_pac_valid('input[name=wclin_pac_nome]','rgba(255,240,230,1)',3);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Digite o Nome )',3000);
						$('#wclin_pac_form input[type=submit]').removeAttr('disabled');
					});
					return false;
				}
				else if($('input[name=wclin_pac_nome]').val().length < 3)
				{
					wclin_pac_valid('input[name=wclin_pac_nome]','rgba(255,240,230,1)',3);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Mínimo de Três Caracteres )',3000);	
						$('#wclin_pac_form input[type=submit]').removeAttr('disabled');
					});
					return false;
				}
				if(!$('input[name=wclin_pac_snome]').val())
				{
					wclin_pac_valid('input[name=wclin_pac_snome]','rgba(255,240,230,1)',3);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Digite o Sobrenome )',3000);	
						$('#wclin_pac_form input[type=submit]').removeAttr('disabled');
					});
					return false;
				}
				else if($('input[name=wclin_pac_snome]').val().length < 3)
				{
					wclin_pac_valid('input[name=wclin_pac_snome]','rgba(255,240,230,1)',3);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Mínimo de Três Caracteres )',3000);
						$('#wclin_pac_form input[type=submit]').removeAttr('disabled');
					});
					return false;
				}
				if(!$('input[name=wclin_pac_cpf]').val())
				{
					wclin_pac_valid('input[name=wclin_pac_cpf]','rgba(255,240,230,1)',14);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Digite o CPF )',3000);
						$('#wclin_pac_form input[type=submit]').removeAttr('disabled');
					});
					return false;
				}
				if(!$('input[name=wclin_pac_nas]').val())
				{
					wclin_pac_valid('input[name=wclin_pac_nas]','rgba(255,240,230,1)',10);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Digite a Data de Nascimento )',3000);
						$('#wclin_pac_form input[type=submit]').removeAttr('disabled');
					});
					return false;
				}
			},
			success:function(data)
			{
				$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
					wclin_float_msg(data,3000);
					$.post('core_princ.php',{'wclin_act':'princ_list'},function(data){
						$('#wclin_princ_list_load').html(data).fadeIn(600);
						pac_cod = $('input[name=wclin_pac_cod]').val();
						if(!pac_cod)
						{
							$('#wclin_pac_form input[type=text]').attr('value','');
						}
						$('#wclin_pac_form input[type=submit]').removeAttr('disabled');
						wclinTooltip();
						wclinFancyBox();
					});	
				});
			} 
		});
	});
	</script>
	";
	$html 	= '
	<div id="wclin_pac_form">
		<div id="wclin_pac_form_pad">
		<form id="wclin_pac_form" action="core_pac.php" method="post">
			<input type="hidden" name="wclin_act" value="'.$pac_edit_act.'">
			<input type="hidden" name="wclin_pac_cod" value="'.$wclin_pac_edit.'">
			<ul>
				<li id="wclin_pac_form_cab">'.$pac_edit_cab.'</li>
			<ul>
			<ul>
				<li class="pac_col0">Convênio</li>
				<li class="pac_col1"><select name="wclin_pac_conv">
					'.$wclin_pac_con_opt.'
				</select></li>
			<ul>
			<ul>
				<li class="pac_col0">Nome*</li>
				<li class="pac_col1"><input type="text" name="wclin_pac_nome" value="'.@$bd_result_edit[4].'"></li>
			<ul>
			<ul>
				<li class="pac_col0">Sobrenome*</li>
				<li class="pac_col1"><input type="text" name="wclin_pac_snome" value="'.@$bd_result_edit[5].'"></li>
			<ul>
			<ul>
				<li class="pac_col0">Sexo*</li>
				<li class="pac_col1"><select name="wclin_pac_sexo">
					<option value="0" '.@$selected[2][0].'>Masculino</option>
					<option value="1" '.@$selected[2][1].'>Feminino</option>
				</select></li>
			<ul>
			<ul>
				<li class="pac_col0">Telefone</li>
				<li class="pac_col1"><input type="text" name="wclin_pac_tel" value="'.@$bd_result_edit[7].'"></li>
			<ul>
			<ul>
				<li class="pac_col0">Celular</li>
				<li class="pac_col1"><input type="text" name="wclin_pac_cel" value="'.@$bd_result_edit[8].'"></li>
			<ul>
			<ul>
				<li class="pac_col0">RG</li>
				<li class="pac_col1"><input type="text" name="wclin_pac_rg" value="'.@$bd_result_edit[9].'"></li>
			<ul>
			<ul>
				<li class="pac_col0">CPF*</li>
				<li class="pac_col1"><input type="text" name="wclin_pac_cpf" value="'.@$bd_result_edit[10].'"></li>
			<ul>
			<ul>
				<li class="pac_col0">D. Nascimento*</li>
				<li class="pac_col1"><input type="text" name="wclin_pac_nas" value="'.@$bd_result_edit[11].'"></li>
			<ul>
			<ul>
				<li class="pac_col0">CEP</li>
				<li class="pac_col1"><input type="text" name="wclin_pac_cep" value="'.@$bd_result_edit[12].'">
				<input type="button" id="wclin_auto_cep" style="margin-left:3px;" value="Completar"></li>
			<ul>
			<ul>
				<li class="pac_col0">Endereço</li>
				<li class="pac_col1"><input type="text" name="wclin_pac_rua" value="'.@$bd_result_edit[13].'">
				<input type="text" name="wclin_pac_num" value="'.@$bd_result_edit[14].'"></li>
			<ul>
			<ul>
				<li class="pac_col0">Bairro</li>
				<li class="pac_col1"><input type="text" name="wclin_pac_bairro" value="'.@$bd_result_edit[15].'"></li>
			<ul>
			<ul>
				<li class="pac_col0">Cidade</li>
				<li class="pac_col1"><input type="text" name="wclin_pac_cidade" value="'.@$bd_result_edit[16].'"></li>
			<ul>
			<ul>
				<li class="pac_col0">Estado</li>
				<li class="pac_col1"><select name="wclin_pac_uf">
					<option value="AC" '.@$selected[3]["AC"].'>AC</option> 
					<option value="AL" '.@$selected[3]["AL"].'>AL</option> 
					<option value="AM" '.@$selected[3]["AM"].'>AM</option> 
					<option value="AP" '.@$selected[3]["AP"].'>AP</option> 
					<option value="BA" '.@$selected[3]["BA"].'>BA</option> 
					<option value="CE" '.@$selected[3]["CE"].'>CE</option> 
					<option value="DF" '.@$selected[3]["DF"].'>DF</option> 
					<option value="ES" '.@$selected[3]["ES"].'>ES</option> 
					<option value="GO" '.@$selected[3]["GO"].'>GO</option> 
					<option value="MA" '.@$selected[3]["MA"].'>MA</option> 
					<option value="MG" '.@$selected[3]["MG"].'>MG</option> 
					<option value="MS" '.@$selected[3]["MS"].'>MS</option> 
					<option value="MT" '.@$selected[3]["MT"].'>MT</option> 
					<option value="PA" '.@$selected[3]["PA"].'>PA</option> 
					<option value="PB" '.@$selected[3]["PB"].'>PB</option> 
					<option value="PE" '.@$selected[3]["PE"].'>PE</option> 
					<option value="PI" '.@$selected[3]["PI"].'>PI</option> 
					<option value="PR" '.@$selected[3]["PR"].'>PR</option> 
					<option value="RJ" '.@$selected[3]["RJ"].'>RJ</option> 
					<option value="RN" '.@$selected[3]["RN"].'>RN</option> 
					<option value="RO" '.@$selected[3]["RO"].'>RO</option> 
					<option value="RR" '.@$selected[3]["RR"].'>RR</option> 
					<option value="RS" '.@$selected[3]["RS"].'>RS</option> 
					<option value="SC" '.@$selected[3]["SC"].'>SC</option> 
					<option value="SE" '.@$selected[3]["SE"].'>SE</option> 
					<option value="SP" '.@$selected[3]["SP"].'>SP</option> 
					<option value="TO" '.@$selected[3]["TO"].'>TO</option> 
				</select></li>
			<ul>
			<ul>
				<li id="wclin_pac_form_but"><input type="submit" value="'.$pac_edit_but.'"></li>
			<ul>
		</form>
		</div>
	</div>
	';
	
	return $jQuery.$html;
}

function wclinPacAdd()
{
	global $wclin_usr_cod, $wclin_usr_cln;
	
	$wclin_pac_add[1] 	= $_POST["wclin_pac_conv"];
	$wclin_pac_add[2] 	= wclin_convert($_POST["wclin_pac_nome"],2);
	$wclin_pac_add[3] 	= wclin_convert($_POST["wclin_pac_snome"],2);
	$wclin_pac_add[4] 	= $_POST["wclin_pac_sexo"];
	$wclin_pac_add[5]	= $_POST["wclin_pac_tel"];
	$wclin_pac_add[6]	= $_POST["wclin_pac_cel"];
	$wclin_pac_add[7] 	= $_POST["wclin_pac_rg"];
	$wclin_pac_add[8] 	= $_POST["wclin_pac_cpf"];
	$wclin_pac_add[9] 	= wclin_date_format($_POST["wclin_pac_nas"]);
	$wclin_pac_add[10] 	= $_POST["wclin_pac_cep"];
	$wclin_pac_add[11] 	= wclin_convert($_POST["wclin_pac_rua"],2);
	$wclin_pac_add[12]	= wclin_convert($_POST["wclin_pac_num"],2);
	$wclin_pac_add[13] 	= wclin_convert($_POST["wclin_pac_bairro"],2);
	$wclin_pac_add[14] 	= wclin_convert($_POST["wclin_pac_cidade"],2);
	$wclin_pac_add[15]	= $_POST["wclin_pac_uf"];
	
	
	$Query = "
	INSERT INTO 
		TB_CLN_PAC 
		(
			CLN_PAC_COD, 
			CLN_PAC_DAT, 
			CLN_PAC_CON, 
			CLN_PAC_NOM, 
			CLN_PAC_SNO,
			CLN_PAC_SEX,
			CLN_PAC_TEL, 
			CLN_PAC_CEL, 
			CLN_PAC_PRG, 
			CLN_PAC_CPF,
			CLN_PAC_NAS,
			CLN_PAC_CEP,
			CLN_PAC_RUA, 
			CLN_PAC_NUM, 
			CLN_PAC_BAI, 
			CLN_PAC_CID, 
			CLN_PAC_EST, 
			CLN_PAC_USR,
			CLN_PAC_CLN
		) 
		VALUES 
		(
			NULL, 
			'".date("Y-m-d  H:i:s")."', 
			'".$wclin_pac_add[1]."', 
			'".$wclin_pac_add[2]."', 
			'".$wclin_pac_add[3]."', 
			'".$wclin_pac_add[4]."', 
			'".$wclin_pac_add[5]."', 
			'".$wclin_pac_add[6]."', 
			'".$wclin_pac_add[7]."', 
			'".$wclin_pac_add[8]."', 
			'".$wclin_pac_add[9]."', 
			'".$wclin_pac_add[10]."', 
			'".$wclin_pac_add[11]."', 
			'".$wclin_pac_add[12]."', 
			'".$wclin_pac_add[13]."', 
			'".$wclin_pac_add[14]."', 
			'".$wclin_pac_add[15]."',
			'".$wclin_usr_cod."',
			'".$wclin_usr_cln."'
		);	
	";
	
	$QueryApply = mysql_query($Query);
	
	if($QueryApply)
	{
		$html = "<p style=\"color:#0C0\">( Paciente Cadastrado! )</p>";
	}
	else
	{
		$html = "<p style=\"color:#F00\">( Erro ao Cadastrar Paciente! )</p>";
	}
	
	return $html;
}

function wclinPacEdit()
{	
	$wclin_pac_add[0] 	= $_POST["wclin_pac_cod"];
	$wclin_pac_add[1] 	= $_POST["wclin_pac_conv"];
	$wclin_pac_add[2] 	= wclin_convert($_POST["wclin_pac_nome"],2);
	$wclin_pac_add[3] 	= wclin_convert($_POST["wclin_pac_snome"],2);
	$wclin_pac_add[4] 	= $_POST["wclin_pac_sexo"];
	$wclin_pac_add[5]	= $_POST["wclin_pac_tel"];
	$wclin_pac_add[6]	= $_POST["wclin_pac_cel"];
	$wclin_pac_add[7] 	= $_POST["wclin_pac_rg"];
	$wclin_pac_add[8] 	= $_POST["wclin_pac_cpf"];
	$wclin_pac_add[9] 	= wclin_date_format($_POST["wclin_pac_nas"]);
	$wclin_pac_add[10] 	= $_POST["wclin_pac_cep"];
	$wclin_pac_add[11] 	= wclin_convert($_POST["wclin_pac_rua"],2);
	$wclin_pac_add[12]	= wclin_convert($_POST["wclin_pac_num"],2);
	$wclin_pac_add[13] 	= wclin_convert($_POST["wclin_pac_bairro"],2);
	$wclin_pac_add[14] 	= wclin_convert($_POST["wclin_pac_cidade"],2);
	$wclin_pac_add[15]	= $_POST["wclin_pac_uf"];
	
	$Query = "
	UPDATE 
		TB_CLN_PAC
	SET 
		CLN_PAC_CON =  '".$wclin_pac_add[1]."',
		CLN_PAC_NOM =  '".$wclin_pac_add[2]."',
		CLN_PAC_SNO =  '".$wclin_pac_add[3]."',
		CLN_PAC_SEX =  '".$wclin_pac_add[4]."',
		CLN_PAC_TEL =  '".$wclin_pac_add[5]."',
		CLN_PAC_CEL =  '".$wclin_pac_add[6]."',
		CLN_PAC_PRG =  '".$wclin_pac_add[7]."',
		CLN_PAC_CPF =  '".$wclin_pac_add[8]."',
		CLN_PAC_NAS =  '".$wclin_pac_add[9]."',
		CLN_PAC_CEP =  '".$wclin_pac_add[10]."',
		CLN_PAC_RUA =  '".$wclin_pac_add[11]."',
		CLN_PAC_NUM =  '".$wclin_pac_add[12]."',
		CLN_PAC_BAI =  '".$wclin_pac_add[13]."',
		CLN_PAC_CID =  '".$wclin_pac_add[14]."',
		CLN_PAC_EST =  '".$wclin_pac_add[15]."' 
	WHERE  
		CLN_PAC_COD = '".$wclin_pac_add[0]."';	
	";
	
	$QueryApply = mysql_query($Query);
	
	if($QueryApply)
	{
		$html = "<p style=\"color:#0C0\">( Paciente Editado! )</p>";
	}
	else
	{
		$html = "<p style=\"color:#F00\">( Erro ao Editar Paciente! )</p>";
	}
	
	return $html;
}

function wclinPacDelForm()
{
	$jQuery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		$('form#wclin_alert_form').ajaxForm({
			beforeSubmit: function()
			{
				$('#wclin_alert_msg').fadeOut(300,function(){
					$('#wclin_alert_msg').html('Deletando...').fadeIn(300);
				})
			},
			success: function()
			{
				$('#wclin_alert_msg').fadeOut(300,function(){
					$('#wclin_alert_msg').html('Concluído!').fadeIn(300,function(){
						$.post('core_princ.php',{'wclin_act':'princ_list'},function(data){
							$('#wclin_princ_list_load').html(data)
							wclinTooltip();
							wclinFancyBox();
							$.fancybox.close();
						});	
					});
				})
			} 
		});
		$('#wclin_alert_cancel').click(function(){
			$.fancybox.close();
		});
	});
	</script>
	";
	$html = '
	<div id="wclin_alert">
	<form id="wclin_alert_form" action="core_pac.php" method="post">
		<input type="hidden" name="wclin_act" value="pac_del">
		<input type="hidden" name="pac_cod" value="'.$_GET["pac_cod"].'">
		<ul>
			<li id="wclin_alert_msg">Deseja Exluir?</li>
		</ul>
		<ul>
			<li><input type="submit" id="wclin_alert_close" value="Sim"></li>
			<li><input type="button" id="wclin_alert_cancel" value="Cancelar"></li>
		</ul>	
	</form>
	</div>
	';
	
	return $jQuery.$html;
}

function wclinPacDel()
{
	@$wclin_pac_edit = $_POST["pac_cod"];
	
	if(isset($wclin_pac_edit))
	{
		$Query 	= "DELETE FROM TB_CLN_PAC WHERE CLN_PAC_COD = ".$wclin_pac_edit.";";
		$QueryApply = mysql_query($Query);
		if($QueryApply)
		{
			$Query2 = "DELETE FROM TB_CLN_ATN WHERE CLN_ATN_PAC = ".$wclin_pac_edit.";";
			$Query2Apply = mysql_query($Query2);
		}
	}
}

?>