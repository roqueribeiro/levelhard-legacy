<?php

	session_start();
	
	$sw_action = $_POST["sw_action"];
	
	if($_SESSION['IMP_USR_GRP'] and $sw_action != 'sw_logout') 
	{
		header('location: sw_content.php?sw_action=sw_panel');
	}
	else
	{
		require "db_connect.php";
		
		$sw_login 	= new sw_login;
		$sw_login	->sw_set('sw_user',$_POST["username"]);
		$sw_login	->sw_set('sw_pass',$_POST["password"]);
		$sw_login	->sw_set('sw_type',$_POST["session"]);
		
		switch($sw_action)
		{
			case "sw_window":
				print $sw_login->sw_window();
			break;
			case "sw_verify":
				print $sw_login->sw_verify();
			break;
			case "sw_logout":
				print $sw_login->sw_logout();
			break;
		}
	}

class sw_login
{//Classe de Login no Sistema
 //Roque Ribeiro
 //29-05-2012
 
 	private $sw_user;
	private $sw_pass;
	private $sw_type;
	
	function sw_set($prop,$value)
	{//Metodo Seta Variavel da Classe
	 //Roque Ribeiro
	 //29-05-2012
	 
		$this->$prop=$value;
	}
  
 	function sw_window()
	{//Metodo Gera Tela de Login
	 //Roque Ribeiro
	 //29-05-2012
	 
		$jquery = "
		$(document).ready(function(){
			
			$('#login-box').hide();
			$('#loader').animate({scale:[0],opacity:'0'},300,function(){
				$('#login-box').fadeIn(600,function(){
					$('input[type=text]',this).focus();
				});
				$(this).hide();	
			});
			
			$('#login-form form').ajaxForm({
				beforeSubmit: function(){
					
					$('#login-form #form-loader').show();
					$('#login-form input').attr('disabled','disabled');
					$('#login-form li img').stop().animate({'opacity':'0.3'},600);
										
					if(!$('#login-form input[type=text]').val())
					{
						$('#login-form #form-loader').hide();
						$('#login-form input').removeAttr('disabled');
						$('#login-form input[type=text]').focus();
						$('#login-form li img').stop().animate({'opacity':'1'},600);
						return false;
					}
					if(!$('#login-form input[type=password]').val())
					{
						$('#login-form #form-loader').hide();
						$('#login-form input').removeAttr('disabled');
						$('#login-form input[type=password]').focus();
						$('#login-form li img').stop().animate({'opacity':'1'},600);
						return false;
					}
					
				},
				success: function(data){
															
					if(data=='denied')
					{
						$('#login-form #form-loader').hide();
						$('#login-box').animate({scale:[0.9]},200,function(){
							$(this).animate({scale:[1]},600,'easeOutBounce',function(){
								$('#login-form input').removeAttr('disabled');
								$('#login-form li img').animate({'opacity':'1'},600);
								return false;
							});
						});
					}
					if(data=='accept')
					{
						$('#login-form #form-loader').hide();
						$('#login-box').animate({'opacity':'0'},0);
						
						$.ajax({
							type		: 'GET',
							url			: 'system/sw_content.php',
							data		: { 'sw_action':'sw_panel' },
							error		: function(){ preWindow('icon-alert',1); },
							beforeSend	: function(){ $('#loader').show().animate({scale:[1],opacity:'1'},0); },
							success		: function(data){ if(!data) preWindow('icon-alert',1); else $('#false-body').html(data); }
						});
					}
					
				}
			})
		});
		";
		$html = '
		<script type="text/javascript">'.$jquery.'</script>
		<div id="login-box" class="box">
        	<div id="login-form">
			<img id="form-loader" src="themes/default/images/form-loader.gif" alt="">
            <form action="system/sw_login.php" method="post">
			<input type="hidden" name="sw_action" value="sw_verify">
            <ul>
            	<li><a href="http://site.imprimil.com" alt=""><img src="themes/default/images/login-logo.png" alt="" width="172" height="158"></a></li>
            	<li><input type="text" name="username" placeholder="Login"></li>
                <li><input type="password" name="password" placeholder="Senha"></li>
                <li><input type="submit" value="Entrar">
				<div id="login-check">
					<ul class="form-elements">
						<li><label><input type="checkbox" name="session"><span>Mantenha-me Conectado</span></label></li>
					</ul>
				</div>
				</li>
            </ul>
            </form>
            </div>
        </div>
		';
		
		return $html;
	}
	
	function sw_verify()
	{//Metodo Verifica Login
	 //Roque Ribeiro
	 //29-05-2012
	 		
		$Query = "
		SELECT 
			IMP_USR_COD, 
			IMP_USR_LGN, 
			IMP_USR_SNH,
			IMP_USR_GRP
		FROM
			TB_IMP_USR
		WHERE
			IMP_USR_LGN = '".$this->sw_user."';
		";
		$QueryApply = mysql_query($Query);
		$QueryResults = mysql_num_rows($QueryApply);
		
		if($QueryResults > 0)
		{
			while($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result[1] = $ResultRow["IMP_USR_COD"];
				$bd_result[2] = $ResultRow["IMP_USR_LGN"];
				$bd_result[3] = $ResultRow["IMP_USR_SNH"];
				$bd_result[4] = $ResultRow["IMP_USR_GRP"];
				
				if($bd_result[3] == $this->sw_pass)
				{
					if($bd_result[4]>0)
					{
						$_SESSION['IMP_USR_COD'] = $bd_result[1];
						$_SESSION['IMP_USR_LGN'] = $bd_result[2];
						$_SESSION['IMP_USR_GRP'] = $bd_result[4];
						
						$QueryLog = "
						INSERT INTO  
						TB_IMP_USR_LOG
						(
							USR_LOG_COD,
							USR_LOG_USR,
							USR_LOG_TYP,
							USR_LOG_IPX,
							USR_LOG_DTM,
							USR_LOG_NAV
						)
						VALUES 
						(
							NULL,
							'".$bd_result[1]."',
							'0',
							'".$_SERVER['REMOTE_ADDR']."',
							'".date("Y-m-d  H:i:s")."',
							'".$_SERVER['HTTP_USER_AGENT']."'
						);
						";
						mysql_query($QueryLog);
						
						return "accept";
					}
					else
					{
						return "denied";
					}
				}
				else
				{
					return "denied";
				}
			}
		}
		else
		{
			return "denied";
		}
		
		return $Query;
		
	}
	
	function sw_logout()
	{
		@session_destroy();		
		print $this->sw_window();
	}
	
}

?>