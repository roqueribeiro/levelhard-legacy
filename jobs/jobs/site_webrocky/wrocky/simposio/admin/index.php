<?php

	//Conexão do Banco de Dados
	require "../config/connect_db.php";
	
	//Linguagem do Site
	header('Content-Type: text/html; charset=utf-8');
	require "../languages/language-ptbr.php";
	
	//Funções Globais
	require "../actions/function.php";
		
	if (!$_SERVER['PHP_AUTH_USER']) 
	{
		header('WWW-Authenticate: Basic realm="'.$site_nome_admin.'"');
		header('HTTP/1.0 401 Unauthorized');
		echo 'Atividade Cancelada';
		exit;
	} 
	else 
	{
		$QueryLogin = "SELECT codigo, login, senha, acesso FROM fs_usuario WHERE login = '".$_SERVER['PHP_AUTH_USER']."' ";
		$QueryLoginApply = mysql_query($QueryLogin);
		$QueryLoginResults = mysql_num_rows($QueryLoginApply); 
		if ($QueryLoginResults > 0)
		{
			while ($ResultLoginRow = mysql_fetch_array($QueryLoginApply)) 
			{
				$bd_result_login[1] = $ResultLoginRow["codigo"];
				$bd_result_login[2] = $ResultLoginRow["senha"];
				$bd_result_login[3] = $ResultLoginRow["acesso"];
			}
		}
		
		if($_SERVER['PHP_AUTH_PW'] == $bd_result_login[2])
		{
			session_start();
			$_SESSION['USR_COD'] = $bd_result_login[1];
			$_SESSION['USR_ACESSO'] = $bd_result_login[3];
		}
		else
		{
			header('WWW-Authenticate: Basic realm="'.$site_nome_r.'"');
			header('HTTP/1.0 401 Unauthorized');
			echo 'Acesso Negado!';
			exit;
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print $site_nome_admin ?></title>

<link rel="icon" href="../favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="menu.css" />
<script type="text/javascript" src="../scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#loading').fadeIn(600);
	$('#conteudo').hide();
	window.onload = function(){
		$('#conteudo').load('fs_principal.php',function(){
			$(this).fadeIn(600);
			$('#loading').fadeOut(200);
		});
	}
});
</script>
</head>

<body>
<div id="loading"><p>Carregando...</p><img src="../themes/default/loading.gif" /></div>

<div id="menu">
<ul id="nav">
    <li><a href="">Inicio</a></li>
    <li><a href="">Cursos</a>
    	<ul>
        	<li><a href="">Cadastrar</a></li>
            <li><a href="">Editar</a></li>
            <li><a href="">Editar</a></li>
            <li><a href="">Editar</a>
                <ul>
                    <li><a href="">Cadastrar</a></li>
                    <li><a href="">Editar</a></li>
                    <li><a href="">Editar</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="">Cursos</a>
    	<ul>
        	<li><a href="">Cadastrar</a></li>
            <li><a href="">Editar</a></li>
            <li><a href="">Editar</a></li>
            <li><a href="">Editar</a>
                <ul>
                    <li><a href="">Cadastrar</a></li>
                    <li><a href="">Editar</a></li>
                    <li><a href="">Editar</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="">Palestrantes</a></li>
    <li><a href="">Area</a></li>
    <li><a href="">Administração Geral</a></li>
    <li><a href="">Sair</a></li>
</ul>
</div>

<div id="conteudo"></div>

<div id="rodape"><?php print $language["desenvolvedor"] ?></div>

</body>

</html>