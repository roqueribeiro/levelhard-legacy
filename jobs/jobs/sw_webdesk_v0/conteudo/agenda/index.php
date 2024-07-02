<?php

//Desenvolvido por Roque Ribeiro da Silva - 2010
//Atividades Complementares UNIP-Sorocaba

//Configurações do Sistema
require "config.php";

//Variaveis do Sistema
$VAR_PAG 		= $_GET["pag"];
$VAR_NOME 		= $_GET["nome"];
$VAR_SENHA 		= $_GET["senha"];
$VAR_PES 		= $_GET["pesquisa"];

$FORM_USRCOD	= $_GET["cod"];
$FORM_USRNOME	= $_GET["nome"];
$FORM_USRSNOME	= $_GET["snome"];
$FORM_CONCOD	= $_GET["concod"];
$FORM_CONNOME	= $_GET["connome"];
$FORM_CONSNOME	= $_GET["consnome"];

session_start();

	switch ($VAR_PAG) 
	{
	case "alert":
		print PagNotLogin($NotLogin="ALERT01");
		break;
	case "login":
		print PagLogin();
		break;
	case "logout":
	
		unset($_SESSION[USR_COD]);
		unset($_SESSION[USR_NOM]);
		unset($_SESSION[USR_SNO]);
		unset($_SESSION[USR_LOG]);
		unset($_SESSION[USR_ACE]);
		unset($_SESSION[USR_AUS]);
		
		header('Location: '.$PHP_SELF.'?pag=pag001');
		
		break;
	case "loginMenu":
		if($FORM_USRCOD==1)
		{
			print PagLoginMenu($NotLogin=1);
		}
		else
		{
			print PagLoginMenu();
		}
		break;
	case "pag000":
		print PagMenu();
		break;
	case "pag001":
	
		if($_SESSION['USR_COD'])
		{
			print PagLista();
		}
		else
		{
			print PagNotLogin($NotLogin);
		}		
		
		break;
	case "pag002":
	
		if($_SESSION['USR_COD'])
		{
			if($_SESSION['USR_ACE'] == "2")
			{
				print PagNovoUsuario();
			}
			else
			{
				print PagNotLogin($NotLogin=1);
			}			
		}
		else
		{
			print PagNotLogin($NotLogin=1);
		}
		
		break;
	case "pag003":
	
		if($_SESSION['USR_COD'])
		{
			print PagNovoGrupo();
		}
		else
		{
			print PagNotLogin($NotLogin=1);
		}
		
		break;
	case "pag004":
	
		if($_SESSION['USR_COD'])
		{
			print PagNovoContato();
		}
		else
		{
			print PagNotLogin($NotLogin=1);
		}
		
		break;
	case "act001":
	
		$BDINSERT[1] 	= $_GET["form_nome"];
		$BDINSERT[2] 	= $_GET["form_snome"];
		$BDINSERT[3] 	= $_GET["form_login"];
		$BDINSERT[4] 	= $_GET["form_senha"];
		$BDINSERT[5] 	= $_GET["form_mail"];
		$BDINSERT[6] 	= $_GET["form_acesso"];
		$BDINSERT[7] 	= $_GET["form_uscont"];
		$BDINSERT[8] 	= $_GET["form_usedit"];		
		$BDINSERT[9] 	= $_GET["form_uscod"];		
		
		if ($BDINSERT[7])
		{
			foreach ($BDINSERT[7] as $t)
			{ 
				if(!$USCONT)
				{
					$USCONT .= $t;
				}
				else
				{
					$USCONT .= ",".$t;
				}
			}
		}
		
		if($BDINSERT[9])
		{
			
			$Query = "
				UPDATE 
					`TB_GND_USR` 
				SET 
					`GND_USR_NOM` = '$BDINSERT[1]',
					`GND_USR_SNO` = '$BDINSERT[2]',
					`GND_USR_LOG` = '$BDINSERT[3]',
					`GND_USR_SEN` = '$BDINSERT[4]',
					`GND_USR_MAI` = '$BDINSERT[5]',
					`GND_USR_ACE` = '$BDINSERT[6]',
					`GND_USR_AUS` = '$USCONT'
				WHERE 
					`GND_USR_COD` = $BDINSERT[9];
			";
						
			$QueryApply = mysql_query($Query);
			
			header('Location: '.$PHP_SELF.'?pag=pag002&cod='.$BDINSERT[9]);
		}
		else
		{
			$Query = "
				INSERT INTO
					`TB_GND_USR` 
						(
							`GND_USR_COD` ,
							`GND_USR_NOM` ,
							`GND_USR_SNO` ,
							`GND_USR_LOG` ,
							`GND_USR_SEN` ,
							`GND_USR_MAI` ,
							`GND_USR_ACE` ,
							`GND_USR_AUS`
						)
					VALUES 
						(
							NULL, 
							'$BDINSERT[1]', 
							'$BDINSERT[2]', 
							'$BDINSERT[3]', 
							'$BDINSERT[4]', 
							'$BDINSERT[5]', 
							'$BDINSERT[6]', 
							'$USCONT'
						);
			";
			
			$QueryApply = mysql_query($Query);
			
			header('Location: '.$PHP_SELF.'?pag=pag002');
		}
				
		break;		
	case "act002":
	
		$BDINSERT[1] 	= $_GET["form_tit"];
		$BDINSERT[2] 	= $_GET["form_obs"];
		$BDINSERT[3] 	= $_GET["form_uscod"];
				
		$Query = "
			INSERT INTO 
				`TB_GND_GRU` 
					(
						`GND_GRU_COD` ,
						`GND_GRU_TIT` ,
						`GND_GRU_OBS` ,
						`GND_GRU_USC`
					)
				VALUES 
					(
						NULL, 
						'$BDINSERT[1]', 
						'$BDINSERT[2]', 
						'$BDINSERT[3]'
					);	
		";
		$QueryApply = mysql_query($Query);
		
		header('Location: '.$PHP_SELF.'?pag=pag003');
			
		break;		
	case "act003":
	
		$BDINSERT[1] 	= $_GET["form_nome"];
		$BDINSERT[2] 	= $_GET["form_snome"];
		$BDINSERT[3] 	= $_GET["form_tel"];
		$BDINSERT[4] 	= $_GET["form_cel"];
		$BDINSERT[5] 	= $_GET["form_mail"];
		$BDINSERT[6] 	= $_GET["form_end"];
		$BDINSERT[7] 	= $_GET["form_bairro"];
		$BDINSERT[8]	= $_GET["form_cep"];
		$BDINSERT[9]	= $_GET["form_cidade"];
		$BDINSERT[10] 	= $_GET["form_estado"];
		$BDINSERT[11] 	= $_GET["form_obs"];
		$BDINSERT[12] 	= $_GET["form_gru"];
		$BDINSERT[13] 	= $_GET["form_uscod"];
		
		if($FORM_CONCOD)
		{
			$Query = "
				UPDATE 
					`TB_GND_CTO` 
				SET 
					`GND_CTO_NOM` = '$BDINSERT[1]',
					`GND_CTO_SNO` = '$BDINSERT[2]',
					`GND_CTO_TEL` = '$BDINSERT[3]',
					`GND_CTO_CEL` = '$BDINSERT[4]',
					`GND_CTO_MAI` = '$BDINSERT[5]',
					`GND_CTO_END` = '$BDINSERT[6]',
					`GND_CTO_BAI` = '$BDINSERT[7]',
					`GND_CTO_CEP` = '$BDINSERT[8]',
					`GND_CTO_CID` = '$BDINSERT[9]',
					`GND_CTO_EST` = '$BDINSERT[10]',
					`GND_CTO_OBS` = '$BDINSERT[11]',
					`GND_CTO_GRU` = '$BDINSERT[12]'
				WHERE 
					`GND_CTO_COD` = ".$FORM_CONCOD.";
			";
			$QueryApply = mysql_query($Query);
			
			header('Location: '.$PHP_SELF.'?pag=pag004&concod='.$FORM_CONCOD);
		}
		else
		{
			$Query = "
				INSERT INTO 
					`TB_GND_CTO` 
					(
						`GND_CTO_COD` ,
						`GND_CTO_NOM` ,
						`GND_CTO_SNO` ,
						`GND_CTO_TEL` ,
						`GND_CTO_CEL` ,
						`GND_CTO_MAI` ,
						`GND_CTO_END` ,
						`GND_CTO_BAI` ,
						`GND_CTO_CEP` ,
						`GND_CTO_CID` ,
						`GND_CTO_EST` ,
						`GND_CTO_OBS` ,
						`GND_CTO_GRU` ,
						`GND_CTO_USC`
					)
					VALUES 
					(
						NULL, 
						'$BDINSERT[1]', 
						'$BDINSERT[2]', 
						'$BDINSERT[3]', 
						'$BDINSERT[4]', 
						'$BDINSERT[5]', 
						'$BDINSERT[6]', 
						'$BDINSERT[7]', 
						'$BDINSERT[8]', 
						'$BDINSERT[9]', 
						'$BDINSERT[10]', 
						'$BDINSERT[11]', 
						'$BDINSERT[12]', 
						'$BDINSERT[13]'
					);
			";
			$QueryApply = mysql_query($Query);
			header('Location: '.$PHP_SELF.'?pag=pag004');
		}
						
		break;
	case "act010":
	
		$Query = "DELETE FROM `TB_GND_CTO` WHERE `GND_CTO_COD` = ".$FORM_CONCOD."";
		$QueryApply = mysql_query($Query);
		
		header('Location: '.$PHP_SELF.'?pag=pag001');
		
		break;
	case "act020":
	
		$Query = "DELETE FROM `TB_GND_USR` WHERE `GND_USR_COD` = ".$FORM_USRCOD."";
		$QueryApply = mysql_query($Query);
		
		header('Location: '.$PHP_SELF.'?pag=pag002');
		
		break;		
	default:

		session_start();
		
		$html = "
		<script type=\"text/javascript\">
		$(document).ready(function(){
								   
			$('#logo').hide(); 					   
			$('#carregando').fadeIn('fast'); 
			$('#theme_conteudo_itens').css('display','none');
			
			$('#theme_conteudo_itens').load('".$PHP_SELF."?pag=pag001', function(){
				$('#carregando').fadeOut('fast'); 
				$('#logo').fadeIn(2000); 
				$('#theme_conteudo_itens').fadeIn(1000);
			});
					
		});
		</script>
		";
	
		print PagCab().$html.PagCon().PagRod();
		break;
	}
	
//---------------------------------------------------------Corta Frases
Function CortaText($txt,$nnr = 50,$pnto = null,$tds = null)
{
	$i = 0;
	$c = 0;
	
	if($pnto) 
	{
		$pnto = "...";
	}
	$total = strlen($txt);
	if(strlen($txt) <= $nnr)
	{
		return $txt;
	}
	else
	{
		$txt20 = substr($txt, 0, $nnr);
		$i=0;
		while($i <= 1)
		{
			$x = $txt{$nnr+$c};
			if($x == " ")
			{
				$i = 1;
				return substr($txt, 0, $nnr+$c).$pnto;
			}
			else
			{
				$i = 0;
				if($nnr+$c >= $total)
				{
					$i = 1;
					return $txt;
				}
				$c = ($tds == null) ? $c = $c+1 : $c = $c-1;
			}
		}
	}
}
function format($str)
{ 
	$str = strtolower($str);	
	return (ucwords($str));
}
//---------------------------------------------------------Mensagens
function PagNotLogin($NotLogin)
{
	
	global $SITE_NOME, $FORM_CONCOD, $FORM_CONNOME, $FORM_CONSNOME;
	
	$MenuLogin = "<script>$('#theme_bar_login').load('".$PHP_SELF."?pag=loginMenu&cod=0');</script>";
	
	$jquery = "
	<script type=\"text/javascript\">
	$(document).ready(function() {
		$(this).oneTime(2000, function() {				   
			AjaxLoad('theme_conteudo_itens','$PHP_SELF?pag=pag001');
		});
	});
	</script>							
	";
	
	switch ($NotLogin) 
	{
		case 1:
			$html = 'Você não tem permissão para visualizar este conteúdo!';
			break;
		case "LE01":
			$html = '<div id="NotLogin">Nome de Usuario Incorreto!</div>';
			break;
		case "LE02":
			$html = '<div id="NotLogin">Senha Incorreta!</div>';
			break;
		case "LE03":
			$html = $jquery.'<div id="NotLogin">Você já está logado como '.$_SESSION['USR_LOG'].'!</div>';
			break;
		case "ALERT01":
			$html = "
			<div id=\"alertas\">
			Você tem certeza que deseja excluir o contato ".$FORM_CONNOME."&nbsp;".$FORM_CONSNOME."?
			<br /><br />
			<input type=\"button\" value=\"Sim\" 
			onclick=\"AjaxLoad('theme_conteudo_itens','".$PHP_SELF."?pag=act010&concod=".$FORM_CONCOD."');$.fancybox.close();\">
			<input type=\"button\" value=\"Não\" onclick=\"$.fancybox.close();\">
			</div>
			";
			break;
		default:
			$html = '<div id="NotLogin">Bem-Vindo(a) ao '.$SITE_NOME.'</div>';
			break;
	}
	
	return $MenuLogin.$html;
		
}
//---------------------------------------------------------Login
function PagLogin()
{

	global $VAR_NOME, $VAR_SENHA;
	
	$Query = "
		SELECT 
			GND_USR_COD, GND_USR_NOM, GND_USR_SNO, GND_USR_LOG, GND_USR_SEN, GND_USR_ACE, GND_USR_AUS
		FROM 
			TB_GND_USR
		WHERE
			GND_USR_LOG = '$VAR_NOME'
	";
	
	$QueryApply = mysql_query($Query);
	$QueryResults = mysql_num_rows($QueryApply); 
	
	if ($QueryResults > 0)
	{
		
		while ($ResultRow = mysql_fetch_array($QueryApply)) 
		{
			$BDSHOW[1]	= $ResultRow["GND_USR_COD"];
			$BDSHOW[2] 	= $ResultRow["GND_USR_NOM"];
			$BDSHOW[3] 	= $ResultRow["GND_USR_SNO"];
			$BDSHOW[4] 	= $ResultRow["GND_USR_LOG"];
			$BDSHOW[5] 	= $ResultRow["GND_USR_SEN"];
			$BDSHOW[6] 	= $ResultRow["GND_USR_ACE"];
			$BDSHOW[7] 	= $ResultRow["GND_USR_AUS"];
		}
		
		if(!$_SESSION['USR_COD'])
		{
			if($BDSHOW[5] == $VAR_SENHA)
			{
				if($BDSHOW[7])
				{
					$USR_AUS = $BDSHOW[1].",".$BDSHOW[7];
				}
				else
				{
					$USR_AUS = $BDSHOW[1];
				}
				
				$_SESSION['USR_COD'] = $BDSHOW[1];
				$_SESSION['USR_NOM'] = $BDSHOW[2];
				$_SESSION['USR_SNO'] = $BDSHOW[3];
				$_SESSION['USR_LOG'] = $BDSHOW[4];
				$_SESSION['USR_ACE'] = $BDSHOW[6];
				$_SESSION['USR_AUS'] = $USR_AUS;
				
				header('Location: '.$PHP_SELF.'?pag=pag001');
				
			}
			else
			{
				print PagNotLogin($NotLogin="LE02");
			}
		}
		else
		{
			print PagNotLogin($NotLogin="LE03");
		}
	}
	else
	{
		print PagNotLogin($NotLogin="LE01");
	}
		
	return $html;
	
}	
//---------------------------------------------------------Cabeçalho
function PagCab()
{

	global $SITE_NOME;

	$html = "
	<!DOCTYPE HTML>
	<html>
	<head>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
	<title>".$SITE_NOME."</title>
	<link rel=\"icon\" href=\"agenda.ico\" type=\"image/x-icon\"> 
	<link rel=\"shortcut icon\" href=\"agenda.ico\" type=\"image/x-icon\"> 
	<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/theme_style.css\"/>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/menu_style.css\" media=\"screen\">
	<link rel=\"stylesheet\" type=\"text/css\" href=\"scripts/fancybox/jquery.fancybox-1.3.4.css\" media=\"screen\" />
	
	<style type=\"text/css\">
	#loading 
	{ 
		position:absolute;
		width:120px; 
		height:80px; 
		top:50%; 
		left:50%; 
		margin:-50px 0 0 -60px; 
		z-index:9999;
		
		background: -webkit-linear-gradient(rgba(255,255,255,1) 0%, rgba(230,230,230,1) 100%);
		background: -moz-linear-gradient(rgba(255,255,255,1) 0%, rgba(230,230,230,1) 100%);
		background: -o-linear-gradient(rgba(255,255,255,1) 0%, rgba(230,230,230,1) 100%);
		
		border-radius:5px;
		
		text-align:center;
		font-size:11px;
		
		-webkit-box-shadow:2px 2px 6px rgba(0,0,0,0.2);
		-moz-box-shadow:2px 2px 6px rgba(0,0,0,0.2);
		box-shadow:2px 2px 6px rgba(0,0,0,0.2);
	}
	#loading p
	{
		padding:3px 0 3px 0;
	}
	#loadingbg 
	{ 
		position:absolute; 
		background: url(images/stripebg.png) #FFF; 
		width:100%; 
		height:100%; 
		top:0px; 
		z-index:9998; 
	}
	</style>
		
	<script type=\"text/javascript\" src=\"scripts/jquery-1.6.3.min.js\"></script>
	<script type=\"text/javascript\" src=\"scripts/jquery-form.js\"></script>
	<script type=\"text/javascript\" src=\"scripts/jquery-formFocus.js\"></script>
	<script type=\"text/javascript\" src=\"scripts/jquery-superfish.js\"></script>
	<script type=\"text/javascript\" src=\"scripts/jquery-hoverIntent.js\"></script>
	<script type=\"text/javascript\" src=\"scripts/jquery-tooltip.js\"></script>
	<script type=\"text/javascript\" src=\"scripts/jquery-maskedinput-1.2.2.js\"></script>
	<script type=\"text/javascript\" src=\"scripts/jquery-timers-1.2.js\"></script>
	<script type=\"text/javascript\" src=\"scripts/jquery-ui-1.8.16.custom.min.js\"></script>
			
	<script type=\"text/javascript\" src=\"scripts/fancybox/jquery.fancybox-1.3.4.js\"></script>
	<script type=\"text/javascript\" src=\"scripts/fancybox/jquery.mousewheel-3.0.4.pack.js\"></script>
	<script type=\"text/javascript\" src=\"scripts/fancybox/jquery.easing-1.3.pack.js\"></script>
	
	<script type=\"text/javascript\">
	$(document).ready(function(){
		$('#loading').fadeIn(200);
		$('#loadingbg').css('opacity','0.8');
		$('#loadingbg').fadeIn(200);
		window.onload = function(){
			$('#loading').fadeOut(200);
			$('#loadingbg').fadeOut(1000);
			}	
	});	
	function AjaxLoad(div,url)
	{		
		$(document).ready(function(){
			$('#logo').hide(); 
			$('#carregando').fadeIn('fast');
			$('#'+div).css('display','none');
			$('#'+div).load(url, function(){
				$('#carregando').fadeOut('fast'); 
				$('#logo').fadeIn(2000); 
				$('#'+div).fadeIn('fast');
				
			});
		});
	}
	$(document).ready(function(){
				
		$('#noselect').css('MozUserSelect','none');
							   
		$('#PesqForm').ajaxForm({ 
			target: '#theme_conteudo_itens',
			beforeSubmit: function(){ 
				$('#logo').hide(); 
				$('#carregando').fadeIn('fast'); 
				$('#theme_conteudo_itens').css('display','none'); 
			},
			success: function() { 
				$('#carregando').fadeOut('fast');
				$('#logo').fadeIn(2000);
				$('#theme_conteudo_itens').fadeIn('slow'); 
			} 
		});
				
	});
		
	</script>
	
	</head>
	";
	
	return $html;
	
}
//---------------------------------------------------------Conteudo
function PagCon()
{

	global $SITE_NOME, $WALLPAPER;
		
	$html = '
	<body>
		
	<div id="noselect">
		
	<div id="loading">
	<p>Carregando...</p>
	<img src="images/loading_all.gif">
	</div>
	
	<div id="loadingbg"></div>
		
	<div id="navegadores">
		Seu Navegador Não tem suporte a todo conteúdo!<br />
		<b>Compatibilidade com: Chrome, Firefox, Opera e Safari.</b>
	</div>	
	
	<div id="theme_con" class="center">
		<div id="theme_con1">
		
			<div id="theme_bar_logo">
				<div id="carregando">
					<img src="images/loading.gif">
				</div>
				<div id="logo">
					<img src="images/icons/10515_32x32.png">
				</div>
				'.$SITE_NOME.'
			</div>
			
			<div id="theme_bar_sup">
				<div id="theme_bar_login">
				'.PagLoginMenu().'
				</div>
			</div>
			<div id="theme_menu">
				'.PagMenu().'
			</div>
			<div id="theme_conteudo">
				<div id="theme_conteudo_scroll">
					<div id="theme_conteudo_itens">
					</div>
				</div>
			</div>
			
			<div id="theme_rodape">
			
				<div id="theme_rodape_pesquisa">
				<form id="PesqForm" action="'.$PHP_SELF.'" method="GET">
					<input type="hidden" name="pag" value="pag001">
					<input type="text" name="pesquisa" id="pesquisa">
					<input type="submit" value="Buscar">
				</form>
				</div>
				
				</div>
			</div>
		</div>
	</div>
	
	</div>
	
	</body>
	';
	
	return $html;
	
}
//---------------------------------------------------------Rodapé
function PagRod()
{

	$html = '
	</html>
	';
	
	return $html;
	
}
//---------------------------------------------------------Login Menu
function PagLoginMenu($NotLogin=0)
{
	
	$jquery = "
		<script type=\"text/javascript\">
		$(document).ready(function(){
			$('#LoginForm').ajaxForm({ 
				target: '#theme_conteudo_itens',
				beforeSubmit: function(){ 
					$('#logo').hide(); 
					$('#carregando').fadeIn('fast'); 
					$('#theme_conteudo_itens').css('display','none'); 
				},
				success: function() { 
					$('#carregando').fadeOut('fast'); 
					$('#logo').fadeIn(2000);
					$('#theme_conteudo_itens').fadeIn('slow');
					$('#theme_menu').load('".$PHP_SELF."?pag=pag000');
				} 
			}); 
			$('#nome').formFocus('Nome');
			$('#senha').formFocus('Senha');
			$('#pesquisa').formFocus('Pesquisar');
		});
		</script>
	";
	
	switch($NotLogin)
	{
		case 0:
			$html = '
				<form id="LoginForm" action="'.$PHP_SELF.'" method="GET">
				<input type="hidden" name="pag" value="login">
				<input type="text" id="nome" name="nome">
				<input type="password" id="senha" name="senha">
				<input type="submit" value="Entrar">
				</form>
			';
		break;
		case 1:
			$html = '
				<form id="LoginForm" action="'.$PHP_SELF.'" method="GET">
				<input type="hidden" name="pag" value="login">
				<spam id="theme_bar_text">
				Bem-Vindo(a): '.$_SESSION['USR_NOM'].'&nbsp;'.$_SESSION['USR_SNO'].'
				</spam>
				<input type="button" value="Logout" 
				onclick="AjaxLoad(\'theme_conteudo_itens\',\''.$PHP_SELF.'?pag=logout\');$(\'#theme_menu\').load(\''.$PHP_SELF.'?pag=pag000\');">
				</form>
			';
		break;
	}	
	
	return $jquery.$html;
	
}
//---------------------------------------------------------Menu
function PagMenu()
{
	$jquery = "
		<script type=\"text/javascript\">
			jQuery(function(){
				jQuery('ul.sf-menu').superfish();
			});
			$(document).ready(function(){
				$('#novo_usuario, #novo_grupo, #novo_contato').fancybox({
					'padding'		: 1,
					'titleShow'		: false,
					'transitionIn'	: 'fade',
					'transitionOut'	: 'fade',
					'overlayColor'	: '#000',
					'overlayOpacity': '0.3',
					'scrolling'		: 'no'
				});
			});
		</script>
	";
	
	if($_SESSION['USR_ACE'] == 2)
	{
		$html_usr .='<li><a id="novo_usuario" href="'.$PHP_SELF.'?pag=pag002" title="Novo Usuario">Usuarios</a></li>';
	}
	
	if($_SESSION['USR_COD'])
	{
		$html .='
			<li><a href="javascript:AjaxLoad(\'theme_conteudo_itens\',\''.$PHP_SELF.'?pag=pag001\');" id="but_0000">Principal</a></li>	
			<li><a href="javascript:void(0);" id="but_0100">Cadastro</a>
				<ul>
					'.$html_usr.'
					<li><a id="novo_grupo" href="'.$PHP_SELF.'?pag=pag003" title="Novo Grupo">Grupos</a></li>
					<li><a id="novo_contato" href="'.$PHP_SELF.'?pag=pag004" title="Novo Contato">Contatos</a></li>
				</ul>
			</li>
		';
	}
	else
	{
		$html .='<li><a href="javascript:void(0);" id="but_0000">Principal</a></li>';
	}
	
	return $jquery.'<ul id="theme_menu_itens" class="sf-menu">'.$html.'</ul>';
	
}
//---------------------------------------------------------Listar Contatos
function PagLista()
{
	
	global $VAR_PES;
	
	print "<script>$('#theme_bar_login').load('".$PHP_SELF."?pag=loginMenu&cod=1');</script>";
	
	$Query = "
		SELECT 
			* 
		FROM 
			TB_GND_CTO 
		INNER JOIN 
			TB_GND_GRU 
		ON 
			TB_GND_CTO.GND_CTO_GRU = TB_GND_GRU.GND_GRU_COD
		WHERE
			GND_CTO_USC IN (".$_SESSION['USR_AUS'].")
		AND
			(
				 GND_CTO_NOM LIKE '%".$VAR_PES."%' 
			 OR 
				 GND_CTO_SNO LIKE '%".$VAR_PES."%' 
			 OR 
				 GND_CTO_MAI LIKE '%".$VAR_PES."%' 
			 OR 
				 GND_CTO_END LIKE '%".$VAR_PES."%' 
			 OR 
				 GND_CTO_BAI LIKE '%".$VAR_PES."%'
			 OR 
				 GND_CTO_CID LIKE '%".$VAR_PES."%'
			 OR 
				 GND_CTO_EST LIKE '%".$VAR_PES."%'
			 OR 
				 GND_CTO_OBS LIKE '%".$VAR_PES."%'
			 OR 
				 GND_GRU_OBS LIKE '%".$VAR_PES."%'
			 )
		ORDER BY
			TB_GND_CTO.GND_CTO_NOM
	";
	$QueryApply = mysql_query($Query);
	$QueryResults = mysql_num_rows($QueryApply); 
			
	if ($QueryResults > 0)
	{
		
		$i_row = 0;
		
		while ($ResultRow = mysql_fetch_array($QueryApply)) 
		{
			
			$BDSHOW[1]	= $ResultRow["GND_CTO_COD"];
			$BDSHOW[2] 	= $ResultRow["GND_CTO_NOM"];
			$BDSHOW[3] 	= $ResultRow["GND_CTO_SNO"];
			$BDSHOW[4] 	= $ResultRow["GND_CTO_TEL"];
			$BDSHOW[5] 	= $ResultRow["GND_CTO_CEL"];
			$BDSHOW[6] 	= $ResultRow["GND_CTO_MAI"];
			$BDSHOW[7] 	= $ResultRow["GND_CTO_END"];
			$BDSHOW[8] 	= $ResultRow["GND_CTO_BAI"];
			$BDSHOW[9] 	= $ResultRow["GND_CTO_CEP"];
			$BDSHOW[10] = $ResultRow["GND_CTO_CID"];
			$BDSHOW[11] = $ResultRow["GND_CTO_EST"];
			$BDSHOW[12] = $ResultRow["GND_CTO_OBS"];
			$BDSHOW[13] = $ResultRow["GND_GRU_TIT"];
			$BDSHOW[14] = $ResultRow["GND_GRU_OBS"];
							
			if($i_row % 2 ==0)
			{
				$bgcolor='#FCFCFC';
			}
			else
			{
				$bgcolor='#EBEBEB';
			}
			
			$BDSHOW_NOME = $BDSHOW[2]." ".$BDSHOW[3];
			$NBDSHOW_NOME = CortaText($BDSHOW_NOME,25,$pnto=1);
			
			if($BDSHOW[14])
			{
				$BDSHOW_GRU_OBS = "
				<a href=\"javascript:void(0);\" 
				title=\"
				<div id='info_title'>
				<table cellpadding='5px' cellspacing='0px' width='180px'>
					<tr>
						<td>
						".CortaText($BDSHOW[14],200,$pnto=1)."
						</td>
					</tr>
				</table>
				</div>
				\">
				".CortaText($BDSHOW[13],10,$pnto=1)."
				</a>			
				";
			}
			else
			{
				$BDSHOW_GRU_OBS = CortaText($BDSHOW[13],10,$pnto=1);
			}
			
			$contatos .= "
			<script>
			$(document).ready(function(){
				$('#Cont_Del$BDSHOW[1]').fancybox({
					'padding'			: 1,
					'showCloseButton'	: false,
					'overlayColor'		: '#000',
					'overlayOpacity'	: '0.3',
				});
				$('#Cont_Edit$BDSHOW[1]').fancybox({
					'padding'			: 1,
					'overlayColor'		: '#000',
					'overlayOpacity'	: '0.3',
				});
			});	
			</script>
			<tr id=\"lista_item$BDSHOW[1]\" style=\"background:$bgcolor\" class=\"lista_item\">
				<td>
				<a href=\"".$PHP_SELF."?pag=pag004&concod=$BDSHOW[1]&connome=$BDSHOW[2]&consnome=$BDSHOW[3]\" 
				id=\"Cont_Edit$BDSHOW[1]\" title=\"<div id='info_all'>Editar Contato</div>\"><img src=\"images/icons/6059_16x16.png\"></a>
				</td>
				</td>
				<td>
				<a href=\"".$PHP_SELF."?pag=alert&concod=$BDSHOW[1]&connome=$BDSHOW[2]&consnome=$BDSHOW[3]\" 
				id=\"Cont_Del$BDSHOW[1]\" title=\"<div id='info_all'>Excluir Contato</div>\"><img src=\"images/icons/6067_16x16.png\"></a>
				</td>
				<td width=\"250px\">
				<a href=\"javascript:void(0);\" 
				title=\"
				<div id='info_title'>
				<table cellpadding='3px' cellspacing='0px'>
					<tr>
						<td>Nome:</td>
						<td>".$BDSHOW[2]."</td>
					</tr>
					<tr>
						<td>Sobrenome:</td>
						<td>".$BDSHOW[3]."</td>
					</tr>
					<tr>
						<td>Telefone:</td>
						<td>".$BDSHOW[4]."</td>
					</tr>
					<tr>
						<td>Celular:</td>
						<td>".$BDSHOW[5]."</td>
					</tr>
					<tr>
						<td>E-Mail:</td>
						<td>".$BDSHOW[6]."</td>
					</tr>
					<tr>
						<td>Endereço:</td>
						<td>".$BDSHOW[7]."</td>
					</tr>
					<tr>
						<td>Bairro:</td>
						<td>".$BDSHOW[8]."</td>
					</tr>
					<tr>
						<td>Cep:</td>
						<td>".$BDSHOW[9]."</td>
					</tr>
					<tr>
						<td>Cidade:</td>
						<td>".$BDSHOW[10]."</td>
					</tr>
					<tr>
						<td>Estado:</td>
						<td>".$BDSHOW[11]."</td>
					</tr>
					<tr>
						<td>Observações:</td>
						<td>".CortaText($BDSHOW[12],25,$pnto=1)."</td>
					</tr>
					<tr>
						<td>Grupo:</td>
						<td>".$BDSHOW[13]."</td>
					</tr>
				</table>
				</div>
				\">
				".format($NBDSHOW_NOME)."
				</a>
				</td>
				<td width=\"105px\">
				".$BDSHOW[4]."
				</td>
				<td width=\"105px\">
				".$BDSHOW[5]."
				</td>
				<td width=\"180px\">
				".CortaText(strtolower($BDSHOW[6]),10,$pnto=1)."
				</td>
			</tr>
			";
			
			$i_row++;
			
		}
	}
	else
	{
		$contatos = '<tr><td colspan="10" align="center" bgcolor="#FFFFFF" style="padding:6px;">Nenhum Contato Encontrado!</td></tr>';
	}
	
	$jquery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		$('#theme_conteudo_itens a').tooltip({ 
			track: true, 
			delay: 600, 
			showURL: false, 
			showBody: ' - ', 
			fade: 300 
		});
	});	
	</script>
	";
	
	$html = '
	<table border="0px" width="100%" cellpadding="3px" cellspacing="0px">
		<tr id="lista_cab">
			<td width="16px">
			</td>
			<td width="16px">
			</td>
			<td>
			Nome
			</td>
			<td>
			Telefone
			</td>
			<td>
			Celular
			</td>
			<td>
			E-Mail
			</td>
		</tr>
		'.$contatos.'
	</table>
	';
		
	return $jquery.$html;
	
}
//---------------------------------------------------------Formulário de Usuarios
function PagNovoUsuario()
{

	global $FORM_USRCOD;
	
	if($FORM_USRCOD)
	{
		$QueryEdit = "
			SELECT 
				*
			FROM 
				TB_GND_USR
			WHERE
				GND_USR_COD = ".$FORM_USRCOD."
			ORDER BY
				GND_USR_NOM
		";
		
		$QueryEditApply = mysql_query($QueryEdit);
		$QueryEditResults = mysql_num_rows($QueryEditApply); 
		
		if ($QueryEditResults > 0)
		{
			while ($ResultRow = mysql_fetch_array($QueryEditApply)) 
			{
				$BDEDIT[1]	= $ResultRow["GND_USR_COD"];
				$BDEDIT[2] 	= $ResultRow["GND_USR_NOM"];
				$BDEDIT[3] 	= $ResultRow["GND_USR_SNO"];
				$BDEDIT[4] 	= $ResultRow["GND_USR_LOG"];
				$BDEDIT[5] 	= $ResultRow["GND_USR_SEN"];
				$BDEDIT[6] 	= $ResultRow["GND_USR_MAI"];
				$BDEDIT[7] 	= $ResultRow["GND_USR_ACE"];
				$BDEDIT[8] 	= $ResultRow["GND_USR_AUS"];
				
				if($BDEDIT[7] == 1)
				{
					$permissao .= "
						<option value=\"1\" selected=\"selected\">Visualizador</option>
						<option value=\"2\">Administrador</option>
					";
				}
				else
				{
					$permissao .= "
						<option value=\"1\">Visualizador</option>
						<option value=\"2\" selected=\"selected\">Administrador</option>
					";
				}
			}
		}
	}
	else
	{
		$permissao .= "
			<option value=\"1\">Visualizador</option>
			<option value=\"2\">Administrador</option>
		";
	}
	
	//Combo de edição de usuarios
	$QueryEdit = "
		SELECT 
			GND_USR_COD, GND_USR_NOM, GND_USR_SNO
		FROM 
			TB_GND_USR
		ORDER BY
			GND_USR_NOM
	";
	
	$QueryEditApply = mysql_query($QueryEdit);
	$QueryEditResults = mysql_num_rows($QueryEditApply); 
	
	if ($QueryEditResults > 0)
	{
		while ($ResultRow = mysql_fetch_array($QueryEditApply)) 
		{
			
			$BDSHOW[1]	= $ResultRow["GND_USR_COD"];
			$BDSHOW[2] 	= $ResultRow["GND_USR_NOM"];
			$BDSHOW[3] 	= $ResultRow["GND_USR_SNO"];
			
			$usr_edit .= "<option value=".$BDSHOW[1].">".$BDSHOW[2]."&nbsp;".$BDSHOW[3]."</option>";
			
		}
	}
	
	if($FORM_USRCOD)
	{
		$QUSR_COD 	= $FORM_USRCOD;
		
		$QUERY_EWHE = "WHERE GND_USR_COD <> ".$QUSR_COD;
		
		$BUTSAVE 	= "<input type=\"submit\" value=\"Salvar\">";
		$BUTDEL 	= "<input type=\"button\" id=\"form_excluir\" value=\"Excluir\" onclick=\"$('#form_exdiv').fadeIn(300);\">";
		$BUTCANCEL 	= "<input type=\"button\" value=\"Cancelar Edição\" onclick=\"AjaxLoad('fancybox-content','".$PHP_SELF."?pag=pag002');\">";
	}
	else
	{
		$QUSR_COD 	= $_SESSION[USR_COD];
		
		$BUTSAVE 	= "<input type=\"submit\" value=\"Cadastrar\">";
	}
	
	$Query = "
		SELECT 
			GND_USR_COD, GND_USR_NOM, GND_USR_SNO
		FROM 
			TB_GND_USR
			".$QUERY_EWHE."
		ORDER BY
			GND_USR_NOM
	";
	
	$QueryApply = mysql_query($Query);
	$QueryResults = mysql_num_rows($QueryApply); 
		
	if ($QueryResults > 0)
	{
		$BDEDITARR = explode(",", $BDEDIT[8]);
		$COUNTARR = count($BDEDITARR);
		for ($i=0;$i<$COUNTARR;$i++) 
		{
			$SelGRU[$BDEDITARR[$i]] = 'selected="selected"';
		}	
		while ($ResultRow = mysql_fetch_array($QueryApply)) 
		{
			$BDSHOW[1]	= $ResultRow["GND_USR_COD"];
			$BDSHOW[2] 	= $ResultRow["GND_USR_NOM"];
			$BDSHOW[3] 	= $ResultRow["GND_USR_SNO"];
			
			$usuarios .= "<option value=".$BDSHOW[1]." ".$SelGRU[$BDSHOW[1]].">".$BDSHOW[2]."&nbsp;".$BDSHOW[3]."</option>";
			
		}
	}
	else
	{
		$usuarios = "<option value='' disabled='disabled'>Nenhum Usuario</option>";
	}
	
	$html = '
	<script type="text/javascript">
		$(document).ready(function() { 
			$("#form_usuarios").ajaxForm({ 
				target: "#fancybox-content",
				beforeSubmit: function(){ 
					$("#logo").fadeOut("fast"); 
					$("#loading").fadeIn("fast"); 
					$("#fancybox-content").css("display","none"); 
				},
				success: function() { 
					$("#loading").fadeOut("fast");
					$("#logo").fadeIn(1000); 
					$("#fancybox-content").fadeIn("slow");
				} 
			});
			$("#form_editar").click(function(){
				$("#form_useddiv").show(300);
			});
		});
		function EditForm(varNome)
		{
			AjaxLoad("fancybox-content","'.$PHP_SELF.'?pag=pag002&cod="+varNome);
		}
	</script>		
	<div id="form_cadastros">
	
	<div id="form_exdiv">
		Você tem certeza que deseja excluir o usuario '.$BDEDIT[2].'&nbsp;'.$BDEDIT[3].'?
		<br /><br />
		<input type="button" value="Sim" onclick="AjaxLoad(\'fancybox-content\',\''.$PHP_SELF.'?pag=act020&cod='.$FORM_USRCOD.'\');">
		<input type="button" value="Não" onclick="$(\'#form_exdiv\').fadeOut(300);">
	</div>
		
	<form id="form_usuarios" action="'.$PHP_SELF.'" method="GET">
	<input type="hidden" name="pag" value="act001">
	<input type="hidden" name="form_uscod" value="'.$FORM_USRCOD.'">
	<div id="form_useddiv">
		<select name="form_usedit" id="form_usedit" onchange="EditForm(this.value);">
		<option value="">Selecione um usuario</option>
		'.$usr_edit.'
		</select>
	</div>
	<table>
		<tr>
			<td>Editar Usuario</td>
			<td>
			<input type="button" id="form_editar" value="Editar um usuario">
			</td>
		</tr>
		<tr>
			<td>Nome:</td>
			<td><input type="text" name="form_nome" id="form_nome" value="'.$BDEDIT[2].'"></td>
		</tr>
		<tr>
			<td>Sobrenome:</td>
			<td><input type="text" name="form_snome" id="form_snome" value="'.$BDEDIT[3].'"></td>
		</tr>
		<tr>
			<td>Login:</td>
			<td><input type="text" name="form_login" id="form_login" value="'.$BDEDIT[4].'"></td>
		</tr>
		<tr>
			<td>Senha:</td>
			<td><input type="password" name="form_senha" id="form_senha" value="'.$BDEDIT[5].'"></td>
		</tr>
		<tr>
			<td>E-Mail:</td>
			<td><input type="text" name="form_mail" id="form_mail" value="'.$BDEDIT[6].'"></td>
		</tr>
		<tr>
			<td>Nivel de Acesso:</td>
			<td>
			<select name="form_acesso">
			'.$permissao.'
			</select>			
			</td>
		</tr>
		<tr>
			<td>Acesso aos Contatos de:</td>
			<td>
			<select multiple="multiple" name="form_uscont[]" size="5">
			'.$usuarios.'
			</select>			
			</td>
		</tr>
		<tr>
			<td colspan="2" id="form_submit">'.$BUTSAVE.'&nbsp;'.$BUTDEL.'&nbsp;'.$BUTCANCEL.'</td>
		</tr>
	</table>
	</form>
	</div>
	';
	
	return $html;
}
//---------------------------------------------------------Formulário de Grupos
function PagNovoGrupo()
{

	$html = '
	<script type="text/javascript">
		$(document).ready(function() { 
			$("#form_grupos").ajaxForm({ 
				target: "#fancybox-content",
				beforeSubmit: function(){ 
					$("#logo").fadeOut("fast");
					$("#loading").fadeIn("fast"); 
					$("#fancybox-content").css("display","none"); 
				},
				success: function() { 
					$("#loading").fadeOut("fast"); 
					$("#logo").fadeIn(1000);
					$("#fancybox-content").fadeIn("slow");
				} 
			}); 
		});
	</script>	
	<div id="form_cadastros">
	<form id="form_grupos" action="'.$PHP_SELF.'" method="GET">
	<input type="hidden" name="pag" value="act002">
	<table>
		<tr>
			<td>Titulo:</td>
			<td><input type="text" name="form_tit" id="form_tit"></td>
		</tr>
		<tr>
			<td>Observações:</td>
			<td><textarea name="form_obs" id="form_obs"></textarea></td>
		</tr>
		<tr>
			<input type="hidden" name="form_uscod" value="'.$_SESSION['USR_COD'].'">
			<td colspan="2" id="form_submit"><input type="submit" value="Cadastrar"></td>
		</tr>
	</table>
	</form>
	</div>
	';
	
	return $html;
	
}
//---------------------------------------------------------Formulário de Contatos
function PagNovoContato()
{
	
	global $FORM_CONCOD;
	
	if($FORM_CONCOD)
	{
		$QueryEdit = "
			SELECT 
				*
			FROM 
				TB_GND_CTO
			WHERE
				GND_CTO_COD = '".$FORM_CONCOD."';
		";
		
		$QueryEditApply = mysql_query($QueryEdit);
		$QueryEditResults = mysql_num_rows($QueryEditApply); 
		
		if ($QueryEditResults > 0)
		{
			while ($ResultEditRow = mysql_fetch_array($QueryEditApply)) 
			{
				$BDEDIT[1]	= $ResultEditRow["GND_CTO_COD"];
				$BDEDIT[2] 	= $ResultEditRow["GND_CTO_NOM"];
				$BDEDIT[3] 	= $ResultEditRow["GND_CTO_SNO"];
				$BDEDIT[4] 	= $ResultEditRow["GND_CTO_TEL"];
				$BDEDIT[5] 	= $ResultEditRow["GND_CTO_CEL"];
				$BDEDIT[6] 	= $ResultEditRow["GND_CTO_MAI"];
				$BDEDIT[7] 	= $ResultEditRow["GND_CTO_END"];
				$BDEDIT[8] 	= $ResultEditRow["GND_CTO_BAI"];
				$BDEDIT[9] 	= $ResultEditRow["GND_CTO_CEP"];
				$BDEDIT[10]	= $ResultEditRow["GND_CTO_CID"];
				$BDEDIT[11]	= $ResultEditRow["GND_CTO_EST"];
				$BDEDIT[12]	= $ResultEditRow["GND_CTO_OBS"];
				$BDEDIT[13]	= $ResultEditRow["GND_CTO_GRU"];
				$BDEDIT[14]	= $ResultEditRow["GND_CTO_USC"];				
			}
		}
		$FORMEDIT = '
			<input type="hidden" name="concod" value="'.$FORM_CONCOD.'">
			<input type="hidden" name="form_uscod" value="'.$_SESSION['USR_COD'].'">
		';
	}
	else
	{
		$FORMEDIT = '
			<input type="hidden" name="form_uscod" value="'.$_SESSION['USR_COD'].'">	
		';
	}
	
	$Query = "
		SELECT 
			GND_GRU_COD, GND_GRU_TIT
		FROM 
			TB_GND_GRU
		WHERE
			GND_GRU_USC IN (".$_SESSION['USR_AUS'].")
		ORDER BY
			GND_GRU_TIT
	";
	
	$QueryApply = mysql_query($Query);
	$QueryResults = mysql_num_rows($QueryApply); 
	
	if ($QueryResults > 0)
	{
		while ($ResultRow = mysql_fetch_array($QueryApply)) 
		{
			$BDSHOW[1]	= $ResultRow["GND_GRU_COD"];
			$BDSHOW[2] 	= $ResultRow["GND_GRU_TIT"];
			
			if($BDSHOW[1] == $BDEDIT[13])
			{
				$grupos .= "<option value=".$BDSHOW[1]." selected=\"selected\">".$BDSHOW[2]."</option>";
			}
			else
			{
				$grupos .= "<option value=".$BDSHOW[1].">".$BDSHOW[2]."</option>";
			}
		}
	}
	else
	{
		$grupos = "<option value='1'>Sem Grupo</option>";
	}
		
	$QueryUF = "
		SELECT 
			*
		FROM 
			TB_GND_UF
		ORDER BY
			GND_UF_SIG
	";
	
	$QueryUFApply = mysql_query($QueryUF);
	$QueryUFResults = mysql_num_rows($QueryUFApply); 
	
	if ($QueryUFResults > 0)
	{
		while ($ResultRow = mysql_fetch_array($QueryUFApply)) 
		{
			$BDUF[1]	= $ResultRow["GND_UF_COD"];
			$BDUF[2]	= $ResultRow["GND_UF_SIG"];
			$BDUF[3] 	= $ResultRow["GND_UF_NOM"];
			
			if($BDUF[2] == $BDEDIT[11])
			{
				$estados .= "<option value=".$BDUF[2]." selected=\"selected\">".$BDUF[3]."</option>";
			}
			else
			{
				$estados .= "<option value=".$BDUF[2].">".$BDUF[3]."</option>";
			}
		}
	}
		
	$html = '
	<script type="text/javascript">
		jQuery(function($){ 
			$("#form_tel").mask("(99) 9999-9999");
			$("#form_cel").mask("(99) 9999-9999");
			$("#form_cep").mask("99999-999");
		});
		$(document).ready(function() { 
			$("#form_contatos").ajaxForm({ 
				target: "#fancybox-content",
				beforeSubmit: function(){ 
					$("#logo").fadeOut("fast"); 
					$("#loading").fadeIn("fast"); 
					$("#fancybox-content").css("display","none"); 
				},
				success: function() { 
					$("#loading").fadeOut("fast"); 
					$("#logo").fadeIn(1000); 
					$("#fancybox-content").fadeIn("slow");
					AjaxLoad("theme_conteudo_itens","'.$PHP_SELF.'?pag=pag001");
				} 
			}); 
		});
	</script>
	<div id="form_cadastros">
	<form id="form_contatos" action="'.$PHP_SELF.'" method="GET">
	<input type="hidden" name="pag" value="act003">
	'.$FORMEDIT.'
	<table>
		<tr>
			<td>Nome:</td>
			<td><input type="text" name="form_nome" id="form_nome"value="'.$BDEDIT[2].'"></td>
		</tr>
		<tr>
			<td>Sobrenome:</td>
			<td><input type="text" name="form_snome" id="form_snome" value="'.$BDEDIT[3].'"></td>
		</tr>
		<tr>
			<td>Telefone:</td>
			<td><input type="text" name="form_tel" id="form_tel" value="'.$BDEDIT[4].'"></td>
		</tr>
		<tr>
			<td>Celular:</td>
			<td><input type="text" name="form_cel" id="form_cel" value="'.$BDEDIT[5].'"></td>
		</tr>
		<tr>
			<td>E-Mail:</td>
			<td><input type="text" name="form_mail" id="form_mail" value="'.$BDEDIT[6].'"></td>
		</tr>
		<tr>
			<td>Endereço:</td>
			<td><input type="text" name="form_end" id="form_end" value="'.$BDEDIT[7].'"></td>
		</tr>
		<tr>
			<td>Bairro:</td>
			<td><input type="text" name="form_bairro" id="form_bairro" value="'.$BDEDIT[8].'"></td>
		</tr>
		<tr>
			<td>CEP:</td>
			<td><input type="text" name="form_cep" id="form_cep" value="'.$BDEDIT[9].'"></td>
		</tr>
		<tr>
			<td>Cidade:</td>
			<td><input type="text" name="form_cidade" id="form_cidade" value="'.$BDEDIT[10].'"></td>
		</tr>
		<tr>
			<td>Estado:</td>
			<td>
			<select name="form_estado" id="form_estado">
			'.$estados.'
			</select>			
			</td>
		</tr>
		<tr>
			<td>Observações:</td>
			<td><textarea name="form_obs" id="form_obs">'.$BDEDIT[12].'</textarea></td>
		</tr>
		<tr>
			<td>Grupo:</td>
			<td>
			<select name="form_gru" id="form_gru">
			'.$grupos.'
			</select>			
			</td>
		</tr>
		<tr>
			<td colspan="2" id="form_submit"><input type="submit" value="Cadastrar"></td>
		</tr>
	</table>
	</form>
	</div>
	';
	
	return $html;
}
?>