<?php

	require "wclin_config/wclin_acs.php";
	require "wclin_config/wclin_lang_ptBR.php";
	require "wclin_config/wclin_db_conn.php";

	@$wclin_act = $_POST["wclin_act"];
	
	switch($wclin_act)
	{
		case "login":
			print wclinLogin();
		break;
		case "login_access":
			print wclinLoginAccess();
		break;
		case "logout_close":
			print wclinLogoutClose();
		break;
		case "usr_edit":
			print wclinUsrEdit();
		break;
		default:
			print wclinLogout();
		break;
	}
	
function wclinLogin()
{
	$jQuery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		$('form#wclin_login_form').ajaxForm({
			beforeSubmit: function()
			{ 
				$('#wclin_loader').animate({'opacity':'1','top':'0px'},100);
				if(!$('input[name=wclin_login]').attr('value'))
				{
					$('#wclin_login_msg').fadeOut(300,function(){
						$(this).html('<p id=\"wclin_login_err\">Digite seu Login!</p>').fadeIn(600);
					})
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100);
					$('input[name=wclin_login]').focus();
					return false;
				}
				if(!$('input[name=wclin_senha]').attr('value'))
				{
					$('#wclin_login_msg').fadeOut(300,function(){
						$(this).html('<p id=\"wclin_login_err\">Digite sua Senha!</p>').fadeIn(600);
					})
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100);
					$('input[name=wclin_senha]').focus();
					return false;
				}
			},
			success: function(data)
			{
				$('#wclin_login_msg').fadeOut(300,function(){
					$(this).html('Aguarde, Verificando...').fadeIn(600,function(){
						eval('var arr = '+data);
						if(arr.cod == 2)
						{
							$('#wclin_loader').animate({'opacity':'1','top':'0px'},100,function(){
								$('#wclin_login_msg').fadeOut(300,function(){
									$(this).html(arr.msg).fadeIn(600,function(){
										$.post('core_princ.php',{'wclin_act':''},function(data){
											$('#wclin_content').fadeOut(300,function(){
												$(this).html(data).fadeIn(600);
												wclinFancyBox();
											});
										});
									});
								})
							});
						}
						else
						{
							$('#wclin_login_msg').fadeOut(300,function(){
								$(this).html(arr.msg).fadeIn(600);
							})
						}
						$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100);
					});
				})
			} 
		});
	});
	</script>
	";
	$html = '
	<div id="wclin_login">
		<form id="wclin_login_form" action="core_login.php" method="post">
		<input type="hidden" name="wclin_act" value="login_access">
		<div id="wclin_login_box">
			<ul>
				<li id="wclin_login_msg">Digite seu Login e Senha</li>
			</ul>
			<ul>
				<li id="wclin_login_col1">Login:</li>
				<li id="wclin_login_col2"><input type="text" name="wclin_login" value="root"></li>
			</ul>
			<ul>
				<li id="wclin_login_col1">Senha:</li>
				<li id="wclin_login_col2"><input type="password" name="wclin_senha" value="123456"></li>
			</ul>
			<ul>
				<li><input type="checkbox" name="wclin_cookie" value="1">Manter Conectado</li>
			</ul>
			<ul>
				<li><input type="submit" value="Entrar"></li>
			</ul>
		</div>
		</form>
	</div>	
	';
	
	return $jQuery.$html;
}

function wclinLoginAccess()
{
	global $cookie_time;
	
	$wclin_login 	= $_POST["wclin_login"];
	$wclin_senha 	= $_POST["wclin_senha"];
	@$wclin_cookie 	= $_POST["wclin_cookie"];
	
	$Query 			= "SELECT CLN_USR_COD, CLN_USR_CLN, CLN_USR_SEN, CLN_USR_TYP, CLN_USR_ACS FROM TB_CLN_USR WHERE CLN_USR_LOG = '".$wclin_login."';";
    $QueryApply 	= mysql_query($Query);
    $QueryResults 	= mysql_num_rows($QueryApply);
    if ($QueryResults != 0)
    {
        while ($ResultRow = mysql_fetch_array($QueryApply)) 
        {
			$bd_result[1] = $ResultRow["CLN_USR_COD"];
			$bd_result[2] = $ResultRow["CLN_USR_CLN"];
			$bd_result[3] = $ResultRow["CLN_USR_SEN"];
			$bd_result[4] = $ResultRow["CLN_USR_TYP"];
			$bd_result[5] = $ResultRow["CLN_USR_ACS"];
        }
				
		if($bd_result[3] == $wclin_senha)
		{
			$_SESSION['CLN_USR_COD'] = $bd_result[1];
			$_SESSION['CLN_USR_CLN'] = $bd_result[2];
			$_SESSION['CLN_USR_TYP'] = $bd_result[4];
			$_SESSION['CLN_USR_ACS'] = $bd_result[5];
			
			if(isset($wclin_cookie))
			{
				setcookie("WCLINCOOKIE",($bd_result[1]*$cookie_time).",".($bd_result[4]*$cookie_time).",".($bd_result[5]*$cookie_time).",".$bd_result[2],time()+$cookie_time);
			}
						
			$QueryLog = "
			INSERT INTO 
				TB_CLN_USR_LOG 
				(
					USR_LOG_COD, 
					USR_LOG_USR, 
					USR_LOG_DAT, 
					USR_LOG_IDN, 
					USR_LOG_NAV
				) 
				VALUES 
				(
					NULL, 
					'".$bd_result[1]."', 
					'".date("Y-m-d  H:i:s")."', 
					'".$_SERVER['REMOTE_ADDR']."', 
					'".$_SERVER['HTTP_USER_AGENT']."'
				);
			";
			mysql_query($QueryLog);	
			
			return "{'cod':'2','msg':'Redirecionando...'}";
		}
		else
		{
			return "{'cod':'1','msg':'<p id=\"wclin_login_err\">Negado!</p>'}";
		}
    }
	else
	{
		return "{'cod':'1','msg':'<p id=\"wclin_login_err\">Negado!</p>'}";
	}
}

function wclinLogout()
{
	global $wclin_lang;
	
	$jQuery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		$('form#wclin_alert_form').ajaxForm({
			beforeSubmit: function()
			{
				$('#wclin_alert_msg').fadeOut(300,function(){
					$('#wclin_alert_msg').html('Fechando...').fadeIn(300);
				})
			},
			success: function()
			{
				$('#wclin_alert_msg').fadeOut(300,function(){
					$('#wclin_alert_msg').html('Concluído!').fadeIn(300,function(){
						$.post('core_login.php',{'wclin_act':'login'},function(data){
							$('#wclin_content').fadeOut(300,function(){
								$(this).html(data).fadeIn(300,function(){
									$.fancybox.close();
									$('input[name=wclin_login]').focus();
									$('title').text('".$wclin_lang["sitename"]."');
								});
							});
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
	<form id="wclin_alert_form" action="core_login.php" method="post">
		<input type="hidden" name="wclin_act" value="logout_close">
		<ul>
			<li id="wclin_alert_msg">Deseja Sair?</li>
		</ul>
		<ul>
			<li><input type="submit" id="wclin_alert_close" value="Sair"></li>
			<li><input type="button" id="wclin_alert_cancel" value="Cancelar"></li>
		</ul>	
	</form>
	</div>
	';
	
	return $jQuery.$html;
}

function wclinLogoutClose()
{
	global $wclin_usr_cod;
	
	//Chat Online
	$QuerySts		= "UPDATE TB_CHT_USR SET CHT_USR_STS = '0' WHERE CHT_USR_USR = '".$wclin_usr_cod."';";
	$QueryStsApply 	= mysql_query($QuerySts);
	
	if($QueryStsApply)
	{
		session_destroy();	
		if(isset($_COOKIE['WCLINCOOKIE']))
		{
			setcookie("WCLINCOOKIE","",time()-$cookie_time);
		}
		if(isset($_COOKIE['WCLINSEARCH']))
		{
			setcookie("WCLINSEARCH","",time()-$cookie_time);
		}
	}
}

?>