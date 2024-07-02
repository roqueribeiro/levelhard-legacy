<?php

	session_start();

	require "../../conexao.php";
	require "conf.php";
	require "security.php";
	require "language.php";
		
	$painel 	= new ClassPainel;
	$usuario 	= new ClassUsuario;
				
	switch($SYS_ACTION)
	{
		//========= Classes do Painel =========//
		case "TelaPainel":
			if($sec_usr[3]>0) $painel->TelaPainel($sec_usr,$language_sec);
		break;
		//========= Classes de Usuario =========//
		case "TelaUsuario":
			if($sec_usr[3]>0) $usuario->TelaUsuario($sec_usr);
		break;
		case "ListaUsuario":
			if($sec_usr[3]>0) $usuario->ListaUsuario($SYS_SEARCH,$sec_usr,$language_sec);
		break;
		case "AprovarUsuario":
			if($sec_usr[3]>1) $usuario->AprovarUsuario($USR_COD,$USR_APV,$sec_usr);
		break;
		case "DerrubarUsuario":
			if($sec_usr[3]>1) $usuario->DerrubarUsuario($USR_COD,$USR_APV,$sec_usr);
		break;
		case "NovoUsuario":
			$usuario->NovoUsuario($USR_NAME,$USR_EMAL,$USR_USER,$USR_PASS,$USR_LEVEL,$USR_COMP);
		break;
		case "AlterarUsuario":
			if($sec_usr[3]>2) $usuario->AlterarUsuario($USR_COD,$USR_LEVEL,$USR_COMP);
		break;
		case "DeletarUsuario":
			if($sec_usr[3]>1) $usuario->DeletarUsuario($USR_COD,$sec_usr);
		break;
	}
	
class GeralFunc
{
	public $USR_COD;
	public $USR_ACE;
	public $USR_EMP;
		
	function ReturnAcs($USR_ACE,$sec_usr,$language_sec)
	{
		$select_opt[$USR_ACE] = 'selected="selected"';
				
		$return_opt  = '<option value="1" '.$select_opt[1].'>'.$language_sec[1].'</option>';
		$return_opt .= '<option value="2" '.$select_opt[2].'>'.$language_sec[2].'</option>';
		if($sec_usr[3] == 3) $return_opt .= '<option value="3" '.$select_opt[3].'>'.$language_sec[3].'</option>';
				
		return $return_opt;
	}
	
	function ReturnEmp($USR_EMP,$returnType=0)
	{
		global $bd_conexao;

		if(!$returnType)
		{
			$Query 			= "SELECT WDK_EMP_COD, WDK_EMP_NOM FROM TB_WDK_EMP ORDER BY WDK_EMP_NOM;";
			$QueryApply 	= mysqli_query($bd_conexao, $Query);
			$QueryResults 	= mysqli_num_rows($QueryApply); 
			if($QueryResults > 0)
			{
				while($ResultRow = mysqli_fetch_array($QueryApply)) 
				{
					$bd_result[1] = $ResultRow["WDK_EMP_COD"];
					$bd_result[2] = $ResultRow["WDK_EMP_NOM"];
					
					if($USR_EMP)
					{
						if($USR_EMP == $bd_result[1])
						{
							$select_opt = "selected";
						}
						else
						{
							$select_opt = "";
						}
					}
					
					$html .= '<option value="'.$bd_result[1].'" '.$select_opt.'>'.$bd_result[2].'</option>';
				}
			}
		}
		elseif($returnType==1)
		{
			$Query 			= "SELECT WDK_EMP_NOM FROM TB_WDK_EMP WHERE WDK_EMP_COD = ".$USR_EMP.";";
			$QueryApply 	= mysqli_query($bd_conexao, $Query);
			$QueryResults 	= mysqli_num_rows($QueryApply); 
			if($QueryResults > 0)
			{
				while($ResultRow = mysqli_fetch_array($QueryApply)) 
				{
					$html = $ResultRow["WDK_EMP_NOM"];
				}
			}
		}
		
		return $html;
	}
}

class ClassPainel
{
	function TelaPainel($sec_usr,$language_sec)
	{
		$jQuery = "
		$(document).ready(function(){
			$('#carregando-ajax').hide();
			$('#top #menu, #content-ajax #content-menu	ul').disableSelection();
			
			$('#wrap-ajax').fadeIn(0,function(){
				$('#carregando-ajax').fadeIn(300,function(){
					$.post('core.php',{'action':'TelaUsuario'},function(data){
						$('#carregando-ajax').fadeOut(300,function(){
							$('#content-ajax-load').html(data);
							$('#wrap-ajax').fadeOut();
						})
					});
				});
			});
						
			$('#top #menu li').click(function(){
				$('.open-box').fadeOut();
				url = $(this).attr('class');
				if(url == 'usuario')
				{
					$('#wrap-ajax').fadeIn(0,function(){
						$('#carregando-ajax').fadeIn(300,function(){
							$.post('core.php',{'action':'TelaUsuario'},function(data){
								$('#carregando-ajax').fadeOut(300,function(){
									$('#content-ajax-load').html(data);
									$('#wrap-ajax').fadeOut();
								})
							});
						});
					});
				}
			});
		});
		";
		
		$html = '
		<script type="text/javascript">'.$jQuery.'</script>
    	<div id="top">
			<div id="menu">
				<ul>
					<li class="usuario"><img src="images/icons/Users16.png" alt=""><p>Usuarios</p></li>
					<li class="disable"><img src="images/icons/Folder16.png" alt=""><p>Imagens</p></li>
					<li class="disable"><img src="images/icons/Billboard16.png" alt=""><p>Notícias</p></li>
					<li class="disable"><img src="images/icons/Percent16.png" alt=""><p>Estatísticas</p></li>
					<li class="disable"><img src="images/icons/Communicate16.png" alt=""><p>Newsletter</p></li>
				</ul>
			</div>
    	</div>
        <div id="middle">
			<div id="content-user">
			<ul>
				<li><img src="images/icons/User16.png" alt=""></li>
				<li>'.$sec_usr[1].'</li>
			</ul>
			<ul>
				<li><img src="images/icons/Info16.png" alt=""></li>
				<li>'.$sec_usr[5].'</li>
			</ul>
			<ul>
				<li><img src="images/icons/Info16.png" alt=""></li>
				<li>'.$language_sec[$sec_usr[3]].'</li>
			</ul>
			</div>
			<div id="content-ajax">
				<div id="carregando-ajax"><img src="images/loading-center.gif" alt=""></div>
				<div id="content-ajax-load"></div>
			</div>
        </div>
        <div id="bottom">Painel Administrativo 2012 rev.002</div>
		';
		
		print $html;
	}
}

class ClassUsuario
{
	function TelaUsuario($sec_usr)
	{
		$geral = new GeralFunc;
		
		$jQuery = "
		function ListaUsuario(returnType,search)
		{
			if(!returnType)	$('#content-usuario-ajax').html('<ul><li><img src=images/loading-mini.gif alt=></li><li>Carregando...</li></ul>');
			$.post('core.php',{'action':'ListaUsuario','pesquisa':search},function(data){
				$('#content-usuario-ajax').html(data);
				$('#content-usuario-ajax img').click(function(){
					
					lin		= $(this);					
					id 		= lin.attr('id');
					url 	= lin.attr('class');
					alt 	= lin.attr('alt');
														
					if(url == 'aprovar')
					{
						lin.attr({'src':'images/loading-mini.gif'});
						$.post('core.php',{'action':'AprovarUsuario','cod':id,'apv':alt},function(data){
							
							eval('var arr = '+data);
							
							if(arr.cod == 0 || arr.cod == 3)
							{
								$('#wrap').fadeIn(300,function(){
									$('#alerta #titulo p').html('Erro!');
									$('#alerta #ajax p').html(arr.msg);
									$('#alerta').fadeIn(300,function(){
										$('#alerta input[type=button]').focus();
										$('#alerta input[type=button]').click(function(){
											$('#alerta').fadeOut(300,function(){
												$('#wrap').fadeOut(300);
												if(arr.cod == 3)
													lin.attr({'src':'images/icons/Unlock16.png'});
												else
													lin.attr({'src':'images/icons/Alert16.png'});
											});
										});
									});
								});
							}
							if(arr.cod == 1) lin.attr({'src':'images/icons/Lock16.png','alt':'0'});
							if(arr.cod == 2) lin.attr({'src':'images/icons/Unlock16.png','alt':'1'});
						})
					}
					if(url == 'logout')
					{
						lin.attr({'src':'images/loading-mini.gif'});
						$.post('core.php',{'action':'DerrubarUsuario','cod':id,'apv':alt},function(data){
							
							eval('var arr = '+data);
							if(arr.cod == 2 || arr.cod == 3)
							{
								$('#wrap').fadeIn(300,function(){
									$('#alerta #titulo p').html('Erro!');
									$('#alerta #ajax p').html(arr.msg);
									$('#alerta').fadeIn(300,function(){
										$('#alerta input[type=button]').focus();
										$('#alerta input[type=button]').click(function(){
											$('#alerta').fadeOut(300,function(){
												$('#wrap').fadeOut(300);
												lin.attr({'src':'images/icons/Login_out16.png','class':'logout'});
											});
										});
									});
								});
							}
							else
							{
								lin.attr({'src':'images/icons/Login_out16.png','class':'disable'});
							}
						})
					}
					if(url == 'editar')
					{
						alert('Funcionou');
					}
					if(url == 'deletar')
					{
						lin.attr({'src':'images/loading-mini.gif'});	
							
						$('#wrap').fadeIn(300,function(){
							$('#alerta #titulo p').html('Deletar Usuario');
							$('#alerta #ajax p').html('Você deseja realmente deletar este usuário?');
							$('#alerta #botao').html('<input type=button name=1 value=Sim><input type=button name=2 value=Nao>');
							$('#alerta').fadeIn(300,function(){
								$('#alerta input[name=2]').focus();
								$('#alerta input[name=1]').click(function(){
									$.post('core.php',{'action':'DeletarUsuario','cod':id,'apv':alt},function(data){
										eval('var arr = '+data);
										if(arr.cod == 1)
										{
											$('#alerta').fadeOut(300,function(){
												$('#wrap').fadeOut(300,function(){
													ListaUsuario();
													lin.attr({'src':'images/icones/Close16.gif'});
													$('#alerta #botao').html('<input type=button value=Fechar>');
												});
											});
										}
										if(arr.cod == 3)
										{
											$('#alerta #titulo p').html(arr.tit);
											$('#alerta #ajax p').html(arr.msg);
											$('#alerta #botao').html('<input type=button value=Fechar>');
											$('#alerta input').click(function(){
												$('#alerta').fadeOut(300,function(){
													$('#wrap').fadeOut(300,function(){
														lin.attr({'src':'images/icons/Close16.png'});
														$('#alerta #botao').html('<input type=button value=Fechar>');
													});
												});
											});
										}
									});
								});
								$('#alerta input[name=2]').click(function(){
									$('#alerta').fadeOut(300,function(){
										$('#wrap').fadeOut(300,function(){
											lin.attr({'src':'images/icons/Close16.png'});
											$('#alerta #botao').html('<input type=button value=Fechar>');
										});
									});
								});
							});
						});
					}
				});
			});
		}		
		
		$(document).ready(function(){
			
			ListaUsuario();
			
			$('#content-middle #cadastro, #content-middle #search-usuario').hide();
			$('#content-menu li').click(function(){
				
				$('#content-middle #cadastro, #content-middle #search-usuario').fadeOut(300);
				$('#content-menu li.add_user, #content-menu li.search_user').removeClass('active');
				
				if($(this).attr('class') == 'add_user')
				{
					if($('#content-middle #cadastro').css('display') == 'none')
					{
						menu_id = $(this);
						menu_id.addClass('active');
						$('#content-middle #cadastro').fadeIn(300);
					}
				}
				else if($(this).attr('class') == 'search_user')
				{
					if($('#content-middle #search-usuario').css('display') == 'none')
					{
						menu_id = $(this);
						menu_id.addClass('active');
						$('#content-middle #search-usuario').fadeIn(300);
					}
				}
								
			});
			
			$('img#tooltip-info').tooltip({ 
				track	: false, 
				delay	: 300, 
				showURL	: false, 
				fade	: 0
			});
			
			$('form[name=cadastro]').ajaxForm({
				beforeSubmit:function(){
					
					$('#carregando').show();
					
					$('#cadastro input[type=text], #cadastro input[type=password], select').animate({backgroundColor:'#FFF'},0);
					
					if(!$('#cadastro input[name=nome]').val())
					{
						$('#cadastro input[name=nome]').stop().animate({backgroundColor:'#FFDFDF'},300);
						$('#cadastro input[name=nome]').focus();
						$('#carregando').hide();
						return false;
					}			
					if(!$('#cadastro input[name=email]').val())
					{
						$('#cadastro input[name=email]').stop().animate({backgroundColor:'#FFDFDF'},300);
						$('#cadastro input[name=email]').focus();
						$('#carregando').hide();
						return false;
					}
					if(!$('#cadastro input[name=usuario]').val())
					{
						$('#cadastro input[name=usuario]').stop().animate({backgroundColor:'#FFDFDF'},300);
						$('#cadastro input[name=usuario]').focus();
						$('#carregando').hide();
						return false;
					}
					if(!$('#cadastro input[name=senha]').val())
					{
						$('#cadastro input[name=senha]').stop().animate({backgroundColor:'#FFDFDF'},300);
						$('#cadastro input[name=senha]').focus();
						$('#carregando').hide();
						return false;
					}
				},
				success:function(data){
					$('#carregando').hide();
					$('#console #result').html(data);
					eval('var arr = '+data);					
					$('#wrap').fadeIn(300,function(){
						$('#alerta #titulo p').html('Cadastro');
						$('#alerta #ajax p').html(arr.msg);
						$('#alerta').fadeIn(300,function(){
							$('#alerta input[type=button]').focus();
							$('#alerta input[type=button]').click(function(){
								$('#alerta').fadeOut(300,function(){
									$('#wrap').fadeOut(300,function(){
										if(arr.cod == 1)
										{
											ListaUsuario(1);
										}
										else if(arr.cod == 2)
										{
											$('#cadastro input[name=nome]').focus();
										}
										else if(arr.cod == 3)
										{
											$('#cadastro input[name=usuario]').focus();
										}
									});
								});
							});
						});
					});
				}
			});
			
			$('form[name=pesquisa]').submit(function(){
				ListaUsuario(0,$('#search-usuario input[type=text]').val());
				$('#search-usuario input[type=text]').val('');
			});
									
		});
		";
		
		if($sec_usr[3] < 3)
		{
			$cadastro_emp = $geral->ReturnEmp($sec_usr[4],1).'<input type="hidden" name="empresa" value="'.$sec_usr[4].'">';
		}
		else
		{
			$cadastro_emp = '
			<select name="empresa">
				'.$geral->ReturnEmp(0).'
			</select>
			';
		}
		
		$html = '
		<script type="text/javascript">'.$jQuery.'</script>
		<div id="content-top"><ul><li><img src="images/icons/Users16.png" alt=""></li><li>Configuração de Usuários</li></ul></div>
		<div id="content-menu">
		<ul>
			<li class="add_user"><img src="images/icons/Add_user16.png" alt=""><p>Novo Usuario<p></li>
			<li class="search_user"><img src="images/icons/Search16.png" alt=""><p>Pesquisar<p></li>
			<li class="disable"><img src="images/icons/Tools16.png" alt=""><p>Configurações<p></li>
		</ul>
		</div>
		<div id="content-middle">
		
        	<div id="cadastro" class="open-box">
            <form name="cadastro" action="core.php" method="post">
            	<input type="hidden" name="action" value="NovoUsuario">
                <ul>
                    <li>Nome Completo</li>
                    <li><input type="text" name="nome"></li>
                </ul>
                <ul>
                    <li>E-Mail</li>
                    <li><input type="text" name="email"></li>
                </ul>
                <ul>
                    <li>Usuario</li>
                    <li><input type="text" name="usuario"></li>
                </ul>
                <ul>
                    <li>Senha</li>
                    <li><input type="password" name="senha"></li>
                </ul>
                <ul>
                    <li>Empresa</li>
                    <li>'.$cadastro_emp.'</li>
                </ul>
                <ul>
                    <li><input type="submit" value="Cadastrar Usuario"></li>
                </ul>
            </form>
            </div>
			
			<div id="search-usuario" class="open-box">
			<form name="pesquisa" action="javascript:void(0)" method="post">
			<ul>
				<li><input type="text" name="pesquisa" placeholder="Digite sua Pesquisa"></li>
				<li><input type="submit" value="Buscar"></li>
			</ul>
			</form>
			</div>
			
			<div id="content-usuario">
			<ul>
				<li><img id="tooltip-info" src="images/icons/Unlock16.png" alt="" title="Ativar ou desativar um usuário."></li>
				<li><img id="tooltip-info" src="images/icons/Login_out16.png" alt="" title="Derrubar Usuario Online."></li>
				<li><img id="tooltip-info" src="images/icons/Edit16.png" alt="" title="Editar cadastro do usuario."></li>
				<li><img id="tooltip-info" src="images/icons/Close16.png" alt="" title="Excluir um usuario do sistema."></li>
				<li>Nome</li>
				<li>Login</li>
				<li>Acesso</li>
				<li>Empresa</li>
			</ul>
			<div id="content-usuario-ajax"></div>
			</div>
		</div>
		';
		
		print $html;
	}
	
	function ListaUsuario($SYS_SEARCH,$sec_usr,$language_sec)
	{
		global $bd_conexao;

		$geral = new GeralFunc;
		
		if($sec_usr[3] < 3) 
			$QueryEmpresa = "WHERE TB_WDK_USR.WDK_USR_EMP = ".$sec_usr[4]."";
		else
			$QueryEmpresa = "WHERE 1";
		
		if($SYS_SEARCH) $QuerySearch = "AND TB_WDK_USR.WDK_USR_NOM LIKE '%".$SYS_SEARCH."%'";
				
		$Query = "
		SELECT
			TB_WDK_USR.WDK_USR_COD,
			TB_WDK_USR.WDK_USR_NOM,
			TB_WDK_USR.WDK_USR_USR,
			TB_WDK_USR.WDK_USR_SNH,
			TB_WDK_USR.WDK_USR_ACE,
			TB_WDK_USR.WDK_USR_APV,
			TB_WDK_USR.WDK_USR_STS,
			TB_WDK_USR.WDK_USR_EMP,
			TB_WDK_EMP.WDK_EMP_NOM
		FROM
			TB_WDK_USR
		INNER JOIN 
			TB_WDK_EMP 
		ON 
			TB_WDK_USR.WDK_USR_EMP = TB_WDK_EMP.WDK_EMP_COD
			".$QueryEmpresa."
			".$QuerySearch."
		ORDER BY
			TB_WDK_USR.WDK_USR_NOM
		";
		$QueryApply 	= mysqli_query($bd_conexao, $Query);
		$QueryResults 	= mysqli_num_rows($QueryApply); 
		if($QueryResults > 0)
		{
			$i = 0;
			while($ResultRow = mysqli_fetch_array($QueryApply)) 
			{
				$bd_result[1] = $ResultRow["WDK_USR_COD"];
				$bd_result[2] = $ResultRow["WDK_USR_NOM"];
				$bd_result[3] = $ResultRow["WDK_USR_USR"];
				$bd_result[4] = $ResultRow["WDK_USR_SNH"];
				$bd_result[5] = $ResultRow["WDK_USR_ACE"];
				$bd_result[6] = $ResultRow["WDK_USR_STS"];
				$bd_result[7] = $ResultRow["WDK_USR_APV"];
				$bd_result[8] = $ResultRow["WDK_USR_EMP"];
				$bd_result[9] = $ResultRow["WDK_EMP_NOM"];
								
				$jQuery = "
				$(document).ready(function(){
					$('form[name=change_ACE_".$i."]').ajaxForm({
						beforeSubmit:function(){
							$('select[name=acesso], select[name=empresa]').attr({'disabled':'disabled'});
						},
						success:function(data){
							eval('var arr = '+data);
							$('#wrap').fadeIn(300,function(){
								$('#alerta #titulo p').html(arr.tit);
								$('#alerta #ajax p').html(arr.msg);
								$('#alerta').fadeIn(300,function(){
									$('#alerta input[type=button]').focus();
									$('#alerta input[type=button]').click(function(){
										$('#alerta').fadeOut(300,function(){
											$('#wrap').fadeOut(300,function(){
												$('select[name=acesso], select[name=empresa]').removeAttr('disabled');	
											});
										});
									});
								});
							});
						}
					});
				});
				";
				
				if(!$bd_result[7]) $img_apv = "images/icons/Lock16.png"; else $img_apv = "images/icons/Unlock16.png";
				
				if($sec_usr[3] > 1)
				{
					if($bd_result[5] <= $sec_usr[3])
					{
						if($bd_result[6]>0)
							$edit_logout = "logout";
						else
							$edit_logout = "disable";
						
						$edit_delete 	= "deletar";
						$edit_aprovar 	= "aprovar";
						$edit_editar 	= "editar";
						$edit_acesso = '
						<select name="acesso" onchange="$(\'form[name=change_ACE_'.$i.']\').submit();">
							'.$geral->ReturnAcs($bd_result[5],$sec_usr,$language_sec).'
						</select>
						';
					}
					else
					{
						$edit_delete 	= "disable";
						$edit_logout 	= "disable";
						$edit_aprovar 	= "disable";
						$edit_editar 	= "disable";
						$edit_acesso 	= $geral->ReturnEmp($bd_result[8],1);
					}
						
					if($sec_usr[3] == 3)
					{
						$edit_empresa = '
						<select name="empresa" onchange="$(\'form[name=change_ACE_'.$i.']\').submit();">
							'.$geral->ReturnEmp($bd_result[8]).'
						</select>
						';
					}
					else
					{
						$edit_empresa = $geral->ReturnEmp($bd_result[8],1);
					}
				}
				else
				{
					if($bd_result[5] == $sec_usr[3])
						$edit_editar = "editar";
					else
						$edit_editar = "disable";
					
					$edit_aprovar 	= "disable";
					$edit_logout 	= "disable";
					$edit_delete 	= "disable";
					$edit_acesso 	= $language_sec[$bd_result[5]];
					$edit_empresa 	= $geral->ReturnEmp($bd_result[8],1);
				}
																								
				$html .= '
				<script type="text/javascript">'.$jQuery.'</script>
				<form name="change_ACE_'.$i.'" action="core.php" method="post">
				<input type="hidden" name="action" value="AlterarUsuario">
				<input type="hidden" name="cod" value="'.$bd_result[1].'">
				<ul>
					<li><img id="'.$bd_result[1].'" class="'.$edit_aprovar.'" src="'.$img_apv.'" alt="'.$bd_result[6].'"></li>
					<li><img id="'.$bd_result[1].'" class="'.$edit_logout.'" src="images/icons/Login_out16.png" alt=""></li>
					<li><img id="'.$bd_result[1].'" class="'.$edit_editar.'" src="images/icons/Edit16.png" alt=""></li>
					<li><img id="'.$bd_result[1].'" class="'.$edit_delete.'" src="images/icons/Close16.png" alt=""></li>
					<li>'.$bd_result[2].'</li>
					<li>'.$bd_result[3].'</li>
					<li>'.$edit_acesso.'</li>
					<li>'.$edit_empresa.'</li>
				</ul>
				</form>
				';
				
				$i++;
			}
		}
		else
		{
			$html = '<ul><li style="width:100% !important; text-align:center !important; padding:10px;">Nenhum usuario encontrado.</li></ul>';
		}
		
		print $html;	
	}	
	
	function AprovarUsuario($USR_COD,$USR_APV,$sec_usr)
	{
		global $bd_conexao;

		if($USR_COD != $sec_usr[0])
		{
			$QueryChk 			= "SELECT WDK_USR_COD FROM TB_WDK_USR WHERE WDK_USR_APV = '1';";
			$QueryChkApply 		= mysqli_query($bd_conexao, $QueryChk);
			$QueryChkResults 	= mysqli_num_rows($QueryChkApply);
	
			$Query 				= "SELECT WDK_USR_APV FROM TB_WDK_USR WHERE WDK_USR_COD = '".$USR_COD."';";
			$QueryApply 		= mysqli_query($bd_conexao, $Query);
			$QueryResults 		= mysqli_num_rows($QueryApply); 
			if($QueryResults > 0)
			{
				while($ResultRow = mysqli_fetch_array($QueryApply)) 
				{
					$bd_result[1] = $ResultRow["WDK_USR_APV"];
					
					if($bd_result[1]==1 and $QueryChkResults > 1)
					{
						$QueryApv 	= "UPDATE TB_WDK_USR SET WDK_USR_APV = '0' WHERE WDK_USR_COD = '".$USR_COD."';";
						$return 	= "{'cod':'1'}";
					}
					else
					{
						$QueryApv 	= "UPDATE TB_WDK_USR SET WDK_USR_APV = '1' WHERE WDK_USR_COD = '".$USR_COD."';";
						$return 	= "{'cod':'3','msg':'<b>Não Permitido!</b><br /><br />Mínimo de 1 usuário ativo.'}";
					}
					
					if($bd_result[1]==0)
					{
						$QueryApv 	= "UPDATE TB_WDK_USR SET WDK_USR_APV = '1' WHERE WDK_USR_COD = '".$USR_COD."';";
						$return 	= "{'cod':'2'}";
					}
				}
				
				$QueryApvApply = mysqli_query($bd_conexao, $QueryApv);
			}
	
			if($QueryApvApply) print $return; else print "{'cod':'0','msg':'<b>Ocorreu um erro ao tentar gravar!</b><br /><br />Tente novamente mais tarde.'}";
		}
		else
		{
			print "{'cod':'3','msg':'<b>Não Permitido!</b><br /><br />Você não pode desativar você mesmo!'}";
		}
		
	}
	
	function DerrubarUsuario($USR_COD,$USR_APV,$sec_usr)
	{
		global $bd_conexao;

		if($USR_COD != $sec_usr[0])
		{
			$QueryApv 		= "UPDATE TB_WDK_USR SET WDK_USR_STS = '0' WHERE WDK_USR_COD = '".$USR_COD."';";
			$QueryApvApply	= mysqli_query($bd_conexao, $QueryApv);
	
			if($QueryApvApply) 
				print "{'cod':'1'}";
			else 
				print "{'cod':'2','msg':'<b>Ocorreu um erro ao tentar gravar!</b><br /><br />Tente novamente mais tarde.'}";
		}
		else
		{
			print "{'cod':'3','msg':'<b>Não Permitido!</b><br /><br />Você não pode derrubar você mesmo!'}";
		}
		
	}
	
	function NovoUsuario($USR_NAME,$USR_EMAL,$USR_USER,$USR_PASS,$USR_LEVEL,$USR_COMP)
	{
		global $bd_conexao;

		$Query 			= "SELECT * FROM TB_WDK_USR WHERE WDK_USR_USR = '".$USR_USER."';";
		$QueryApply 	= mysqli_query($bd_conexao, $Query);
		$QueryResults 	= mysqli_num_rows($QueryApply); 
		if($QueryResults == 0)
		{
			$Query = "
			INSERT INTO 
			TB_WDK_USR
			(
				WDK_USR_NOM,
				WDK_USR_USR,
				WDK_USR_SNH,
				WDK_USR_EMA,
				WDK_USR_EMP
			)
			VALUES 
			(
				'".$USR_NAME."',
				'".$USR_USER."',
				'".$USR_PASS."',
				'".$USR_EMAL."',
				'".$USR_COMP."'
			);
			";	
			$QueryApply = mysqli_query($bd_conexao, $Query);
					
			if($QueryApply)
			{
				print "{'cod':'1','msg':'Novo Usuario Adicionado!<br /><br /> Aguarde ou entre em contato para à aprovação do seu cadastro.'}";
			}
			else
			{
				print "{'cod':'2','msg':'Erro ao adicionar! Tente novamente mais tarde.'}";
			}
		}
		else
		{
			print "{'cod':'3','msg':'Usuario digitado já existe!'}";
		}
	}

	function AlterarUsuario($USR_COD,$USR_LEVEL,$USR_COMP)
	{
		global $bd_conexao;

		$QueryAlt = "UPDATE TB_WDK_USR SET WDK_USR_ACE = '".$USR_LEVEL."', WDK_USR_EMP = '".$USR_COMP."' WHERE WDK_USR_COD = '".$USR_COD."';";
		$QueryAltApply = mysqli_query($bd_conexao, $QueryAlt);
		
		if($QueryAltApply)
			print "{'cod':'1','tit':'Concluído!','msg':'Alteração concluída!'}"; 
		else 
			print "{'cod':'0','tit':'Erro!','msg':'<b>Ocorreu um erro ao tentar alterar!</b><br /><br />Tente novamente mais tarde.'}";
	}
	
	function DeletarUsuario($USR_COD,$sec_usr)
	{
		global $bd_conexao;

		if($USR_COD != $sec_usr[0])
		{
			$QueryAlt = "DELETE FROM TB_WDK_USR WHERE WDK_USR_COD = '".$USR_COD."';";
			$QueryAltApply = mysqli_query($bd_conexao, $QueryAlt);
			
			if($QueryAltApply)
				print "{'cod':'1','tit':'Concluído!','msg':'Usuario Deletado!'}"; 
			else 
				print "{'cod':'0','tit':'Erro!','msg':'<b>Ocorreu um erro ao tentar excluir!</b><br /><br />Tente novamente mais tarde.'}";	
		}
		else
		{
			print "{'cod':'3','tit':'Erro!','msg':'Você não pode deletar você mesmo!'}"; 
		}
	}
}

?>