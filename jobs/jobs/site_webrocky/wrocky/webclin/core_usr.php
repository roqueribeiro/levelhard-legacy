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
			case "usr_add":
				print wclinUsrAdd();
			break;
			case "usr_edit":
				print wclinUsrEdit();
			break;
			case "usr_del":
				print wclinUsrDel();
			break;
			case "usr_nome":
				print wclinUsrNome();
			break;
			default:
				print wclinUsrForm();
			break;
		}
	}
	else
	{
		die($wclin_error_msg[0]); 
	}
	
function wclinUsrForm()
{
	$jQuery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		
		$('#wclin_princ_info_list input[type=radio]').click(function(){
			wclin_alt_nome 	= $('input#wclin_alt_nome:checked').length;
			wclin_alt_senha = $('input#wclin_alt_senha:checked').length;
			if(wclin_alt_nome == 1)
			{
				$('input[name=wclin_usr_nome]').removeAttr('disabled');
				$('input[name=wclin_usr_snome]').removeAttr('disabled');
				$('input[name=wclin_usr_nsenha]').attr('disabled','disabled');
				$('input[name=wclin_usr_rsenha]').attr('disabled','disabled');
			}
			else if(wclin_alt_senha == 1)
			{
				$('input[name=wclin_usr_nome]').attr('disabled','disabled');
				$('input[name=wclin_usr_snome]').attr('disabled','disabled');
				$('input[name=wclin_usr_nsenha]').removeAttr('disabled');
				$('input[name=wclin_usr_rsenha]').removeAttr('disabled');
			}
		});
				
		$('form#wclin_form_usr_edit').ajaxForm({
			beforeSubmit:function()
			{
				$('#wclin_usr_form input[type=submit]').attr('disabled','disabled');
				
				if($('input[name=wclin_usr_nome]').attr('disabled') == '')
				{
					$('#wclin_loader').animate({'opacity':'1','top':'0px'},100);
					
					if(!$('input[name=wclin_usr_nome]').val())
					{
						wclin_pac_valid('input[name=wclin_usr_nome]','rgba(255,240,230,1)',3);
						$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
							wclin_float_msg('( Digite o Nome )',3000);
							$('#wclin_usr_form input[type=submit]').removeAttr('disabled');
						});
						return false;
					}
					else if($('input[name=wclin_usr_nome]').val().length < 3)
					{
						wclin_pac_valid('input[name=wclin_usr_nome]','rgba(255,240,230,1)',3);
						$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
							wclin_float_msg('( Mínimo de Três Caracteres )',3000);
							$('#wclin_usr_form input[type=submit]').removeAttr('disabled');
						});
						return false;
					}
					if(!$('input[name=wclin_usr_snome]').val())
					{
						wclin_pac_valid('input[name=wclin_usr_snome]','rgba(255,240,230,1)',3);
						$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
							wclin_float_msg('( Digite o Sobrenome )',3000);
							$('#wclin_usr_form input[type=submit]').removeAttr('disabled');
						});
						return false;
					}
					else if($('input[name=wclin_usr_snome]').val().length < 3)
					{
						wclin_pac_valid('input[name=wclin_usr_snome]','rgba(255,240,230,1)',3);
						$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
							wclin_float_msg('( Mínimo de Três Caracteres )',3000);
							$('#wclin_usr_form input[type=submit]').removeAttr('disabled');
						});
						return false;
					}
					if(!$('input[name=wclin_usr_senha]').val())
					{
						wclin_pac_valid('input[name=wclin_usr_senha]','rgba(255,240,230,1)',1);
						$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
							wclin_float_msg('( Digite sua Senha Atual )',3000);	
							$('#wclin_usr_form input[type=submit]').removeAttr('disabled');
						});
						return false;
					}
				}
				if($('input[name=wclin_usr_nsenha]').attr('disabled') == '')
				{					
					$('#wclin_loader').animate({'opacity':'1','top':'0px'},100);
					
					if(!$('input[name=wclin_usr_senha]').val())
					{
						wclin_pac_valid('input[name=wclin_usr_senha]','rgba(255,240,230,1)',1);
						$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
							wclin_float_msg('( Digite sua Senha Atual )',3000);
							$('#wclin_usr_form input[type=submit]').removeAttr('disabled');
						});
						return false;
					}
					if(!$('input[name=wclin_usr_nsenha]').val())
					{
						wclin_pac_valid('input[name=wclin_usr_nsenha]','rgba(255,240,230,1)',5);
						$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
							wclin_float_msg('( Digite sua Nova Senha )',3000);
							$('#wclin_usr_form input[type=submit]').removeAttr('disabled');
						});
						return false;
					}
					else if($('input[name=wclin_usr_nsenha]').val().length < 5)
					{
						wclin_pac_valid('input[name=wclin_usr_nsenha]','rgba(255,240,230,1)',5);
						$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
							wclin_float_msg('( Mínimo de Cinco Caracteres )',3000);	
							$('#wclin_usr_form input[type=submit]').removeAttr('disabled');
						});
						return false;
					}
					if(!$('input[name=wclin_usr_rsenha]').val())
					{
						wclin_pac_valid('input[name=wclin_usr_rsenha]','rgba(255,240,230,1)',5);
						$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
							wclin_float_msg('( Digite Novamente )',3000);
							$('#wclin_usr_form input[type=submit]').removeAttr('disabled');
						});
						return false;
					}
					else if($('input[name=wclin_usr_rsenha]').val().length < 5)
					{
						wclin_pac_valid('input[name=wclin_usr_rsenha]','rgba(255,240,230,1)',5);
						$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
							wclin_float_msg('( Mínimo de Cinco Caracteres )',3000);	
							$('#wclin_usr_form input[type=submit]').removeAttr('disabled');
						});
						return false;
					}
					if($('input[name=wclin_usr_nsenha]').val() != $('input[name=wclin_usr_rsenha]').val())
					{
						wclin_pac_valid('input[name=wclin_usr_nsenha]','rgba(255,240,230,1)',5);
						wclin_pac_valid('input[name=wclin_usr_rsenha]','rgba(255,240,230,1)',5);
						$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
							wclin_float_msg('( As Senhas Não Conferem )',3000);	
							$('#wclin_usr_form input[type=submit]').removeAttr('disabled');
						});
						return false;
					}
				}
			},
			success: function(data)
			{
				wclin_float_msg(data,3000);
				$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
					$.post('core_usr.php',{'wclin_act':'usr_nome'},function(data){
						$('#wclin_princ_info_nome').html(data);
						$('#wclin_usr_form input[type=password]').val('');
						$('#wclin_usr_form input[type=submit]').removeAttr('disabled');
					});
				});
			} 
		});
	});
	</script>
	";
	
	$html = '
	<div id="wclin_usr_form">
		<form id="wclin_form_usr_edit" action="core_usr.php" method="post">
		<input type="hidden" name="wclin_act" value="usr_edit">
			<ul>
				<li id="wclin_usr_form_cab">Dados do Usuário</li>
			</ul>
			<ul>
				<li class="col1">Alterar</li>
				<li>
					Nome  <input type="radio" id="wclin_alt_nome"  name="wclin_usr_radio" value="1"> 
					Senha <input type="radio" id="wclin_alt_senha" name="wclin_usr_radio" value="2" checked="checked">
				</li>
			</ul>
			<ul>
				<li class="col1">Nome*</li>
				<li><input type="text" name="wclin_usr_nome" value="'.wclinUsrNome(1).'" disabled="disabled"></li>
			</ul>
			<ul>
				<li class="col1">Sobrenome*</li>
				<li><input type="text" name="wclin_usr_snome" value="'.wclinUsrNome(2).'" disabled="disabled"></li>
			</ul>
			<ul>
				<li class="col1">Senha Atual*</li>
				<li><input type="password" name="wclin_usr_senha" maxlength="10"></li>
			</ul>
			<ul>
				<li class="col1">Nova Senha*</li>
				<li><input type="password" name="wclin_usr_nsenha" maxlength="10"></li>
			</ul>
			<ul>
				<li class="col1">Repita a Nova Senha*</li>
				<li><input type="password" name="wclin_usr_rsenha" maxlength="10"></li>
			</ul>
			<ul>
				<li class="col1">Nível de Acesso</li>
				<li>
				<select name="wclin_usr_access" disabled="disabled">
					<option value="1">Recepcionista</option>
					<option value="2">Médico</option>
					<option value="3">Administrador</option>
				</select>
				</li>
			</ul>
			<ul>
				<li>
				<input type="submit" value="Salvar Alterações">
				</li>
			</ul>
		</form>
	</div>
	';
	
	return $jQuery.$html;
}
	
function wclinUsrAdd()
{
}

function wclinUsrEdit()
{
	global $wclin_usr_cod;
	
	$wclin_usr_arr[0]	= @$_POST["wclin_usr_radio"];
	$wclin_usr_arr[1] 	= @$_POST["wclin_usr_nome"];
	$wclin_usr_arr[2] 	= @$_POST["wclin_usr_snome"];
	$wclin_usr_arr[3] 	= @$_POST["wclin_usr_senha"];
	$wclin_usr_arr[4] 	= @$_POST["wclin_usr_nsenha"];
	$wclin_usr_arr[5] 	= @$_POST["wclin_usr_rsenha"];
	$wclin_usr_arr[6] 	= @$_POST["wclin_usr_access"];
	
	if(isset($wclin_usr_arr[3]))
	{
		$Query 			= "SELECT CLN_USR_SEN FROM TB_CLN_USR WHERE CLN_USR_COD = ".$wclin_usr_cod." AND CLN_USR_SEN = '".$wclin_usr_arr[3]."';";
		$QueryApply 	= mysql_query($Query);
		$QueryResults 	= mysql_num_rows($QueryApply);
				
		if ($QueryResults > 0)
		{
			if($wclin_usr_arr[0] == 1)
			{
				$Query = "
				UPDATE 
					TB_CLN_USR 
				SET 
					CLN_USR_NOM = '".$wclin_usr_arr[1]."', 
					CLN_USR_SNO = '".$wclin_usr_arr[2]."' 
				WHERE 
					CLN_USR_COD = ".$wclin_usr_cod.";
				";
				$QueryApply = mysql_query($Query);
				if($QueryApply)
					$html = "<p style=\"color:#0C0\">( Nome Alterado. )</p>";
				else
					$html = "<p style=\"color:#F00\">( Erro! Tente Novamente. )</p>";
			}
			if($wclin_usr_arr[0] == 2)
			{
				if($wclin_usr_arr[4] == $wclin_usr_arr[5])
				{
					$Query = "
					UPDATE 
						TB_CLN_USR 
					SET 
						CLN_USR_SEN = '".$wclin_usr_arr[4]."' 
					WHERE 
						CLN_USR_COD = ".$wclin_usr_cod.";
					";
					$QueryApply = mysql_query($Query);
					if($QueryApply)
						$html = "<p style=\"color:#0C0\">( Senha Alterada. )</p>";
					else
						$html = "<p style=\"color:#F00\">( Erro! Tente Novamente. )</p>";
				}
				else
				{
					$html = "<p style=\"color:#F00\">( Senhas Não Conferem. )</p>";
				}
			}
		}
		else
		{
			$html = "<p style=\"color:#F00\">( Senha Atual Incorreta. )</p>";
		}
	}
	else
	{
		$html = "<p style=\"color:#F00\">( Digite a Senha Atual. )</p>";
	}
	
	return @$html;
	
}

function wclinUsrDel()
{
}

function wclinUsrNome($wclin_return=0)
{
	global $wclin_usr_cod, $wclin_acs_session, $wclin_acs_cookie;
	
	if($wclin_acs_session[1] > 0 or $wclin_acs_cookie[1] > 0)
	{		
		$Query = "
		SELECT
			CLN_USR_COD, 
			CLN_USR_NOM, 
			CLN_USR_SNO
		FROM 
			TB_CLN_USR
		WHERE
			CLN_USR_COD = ".$wclin_usr_cod."
		LIMIT
			0,1
		";
			
		$QueryApply = mysql_query($Query);
		$QueryResults = mysql_num_rows($QueryApply);
		if ($QueryResults > 0)
		{
			while($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$wclin_usr_data[1] = $ResultRow["CLN_USR_NOM"];
				$wclin_usr_data[2] = $ResultRow["CLN_USR_SNO"];
			}				
		}
	}
	
	if(!$wclin_return)
	{
		return $wclin_usr_data[1]." ".$wclin_usr_data[2];
	}
	if($wclin_return == 1)
	{
		return $wclin_usr_data[1];
	}
	if($wclin_return == 2)
	{
		return $wclin_usr_data[2];
	}
	
}
	
?>