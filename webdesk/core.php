<?php

	date_default_timezone_set('America/Sao_Paulo');
	//Esconde Warnings
	ini_set("display_errors", 0);
	//Inicia Sessao
	session_start([
		'cookie_lifetime' => 86400
	]);
	//Conecta Banco
	require("conexao.php");
	//Variaveis Login
	$login 		= new loginFuncoes;
	$login		-> set('usuario',trim(strtolower($_GET["usuario"])));
	$login		-> set('senha',trim($_GET["senha"]));
	//Variaveis Cadastro
	$login		-> set('usr_nome',trim($_GET["usr_nome"]));
	$login		-> set('usr_usuario',trim(strtolower($_GET["usr_usuario"])));
	$login		-> set('usr_senha',trim($_GET["usr_senha"]));
	$login		-> set('usr_email',trim($_GET["usr_email"]));
	//Variaveis Sistema
	$sistema 	= new iniciaSistema;
	$sistema	-> set('sis_bg',$_GET["background"]);
	//Variaveis Mensagem
	$indicador 	= new indicadorSistema;
			
	switch($_GET["acao"])
	{
		//Login
		case "tela_login":
			if($_SESSION["status"] && $_SESSION["codigo"]) $sistema -> telaSistema(); else $login -> telaLogin();
		break;
		case "verifica_usuario":
			$login -> verificaUsuario();
		break;
		case "cadastro_usuario":
			$login -> cadastroUsuario();
		break;
		case "sair_sistema":
			if($_SESSION["status"] && $_SESSION["codigo"]) $login -> telaLogof();
		break;
		//Sistema
		case "tela_sistema":
			if($_SESSION["status"] && $_SESSION["codigo"]) $sistema -> telaSistema(); else $login -> telaLogin();
		break;
		case "aplica_bg":
			$sistema -> aplicaBackground();
		break;
		case "mostra_bg":
			$sistema -> mostraBackground();
		break;
		//Indicadores
		case "indicador_online":
			if($_SESSION["status"] && $_SESSION["codigo"]) $indicador -> indicadorOnline();
		break;
		case "indicador_mensagem":
			if($_SESSION["status"] && $_SESSION["codigo"]) $indicador -> indicadorMensagem();
		break;
	}
	
class loginFuncoes
{//Classe de Login

	private $usuario;
	private $senha;
	private $usr_nome;
	private $usr_usuario;
	private $usr_senha;
	private $usr_email;

	public function set($prop,$value)
	{
		$this->$prop=$value;
	}

	public function telaLogin()
	{
		require("linguagem/lang_pt-BR.php");
		include('sistema/tela_login.php');
	}
	
	public function telaLogof()
	{
		global $bd_conexao;

		$query_logoff = mysqli_query($bd_conexao, "UPDATE TB_WDK_USR SET WDK_USR_STS = 0 WHERE WDK_USR_COD = '".$_SESSION["codigo"]."';");
		if($query_logoff)
		{
			unset($_SESSION["codigo"]);
			unset($_SESSION["nome"]);
			unset($_SESSION["usuario"]);
			unset($_SESSION["status"]);
			unset($_SESSION['acesso']);
			session_destroy();
		}
		header("location: core.php?acao=tela_login");
	}

	public function verificaUsuario()
	{
		global $bd_conexao;
				
		$wdk_query = "
		SELECT 
			WDK_USR_COD, 
			WDK_USR_NOM, 
			WDK_USR_USR, 
			WDK_USR_SNH,
			WDK_USR_STS,
			WDK_USR_ACE
		FROM 
			TB_WDK_USR
		WHERE 
			WDK_USR_USR = '".$this->usuario."';
		";
		$wdk_executa = mysqli_query($bd_conexao, $wdk_query);
		$wdk_resultado = mysqli_num_rows($wdk_executa);
		
		if($wdk_resultado > 0)
		{
			while ($wdk_linha = mysqli_fetch_array($wdk_executa)) 
			{
				if($wdk_linha['WDK_USR_SNH'] == md5($this->senha))
				{
					$cht_query 	= "UPDATE TB_WDK_USR SET WDK_USR_STS = 1 WHERE WDK_USR_COD = '".$wdk_linha['WDK_USR_COD']."';";
					$cht_result = mysqli_query($bd_conexao, $cht_query);
					if($cht_result)
					{
						$_SESSION["codigo"]  	= $wdk_linha['WDK_USR_COD'];
						$_SESSION["nome"] 	 	= $wdk_linha['WDK_USR_NOM'];
						$_SESSION["usuario"]	= $wdk_linha['WDK_USR_USR'];
						$_SESSION["status"]	 	= 1;
						$_SESSION['acesso'] 	= $wdk_linha['WDK_USR_ACE'];
						
						$log_query = "
						INSERT INTO 
							TB_WDK_USR_LOG
							(
								WDK_USR_LOG_USR,
								WDK_USR_LOG_SNH,
								WDK_USR_LOG_IPX,
								WDK_USR_LOG_AGT
							)
							VALUES
							(
								'".$this->usuario."',
								'".$this->senha."',
								'".$_SERVER["REMOTE_ADDR"]."',
								'".$_SERVER["HTTP_USER_AGENT"]."'
							)
						";
						$log_result = mysqli_query($bd_conexao, $log_query);
						if($log_result)
						{
							$path = "conteudo/diretorio/upload/".$wdk_linha['WDK_USR_USR'];
							if (!file_exists($path)) {
								mkdir($path, 0755);
							}
							print "aceito";
						}
						else
						{
							print "erro";
						}
					}
					else
					{
						print "erro";
					}
					
				}
				else
				{
					print "recusado";
				}
			}
		}
		else
		{
			print "recusado";
		}
	}
	
	public function cadastroUsuario()
	{
		global $bd_conexao;
		
		$wdk_query = "
		SELECT 
			WDK_USR_USR
		FROM 
			TB_WDK_USR
		WHERE 
			WDK_USR_USR = '".$this->usr_usuario."'
		";
		$wdk_executa = mysqli_query($bd_conexao, $wdk_query);
		$wdk_resultado = mysqli_num_rows($wdk_executa);
				
		if($wdk_resultado > 0)
		{
			print "existe";
		}
		else
		{			
			$wdk_query = "
			INSERT 
				INTO 
			TB_WDK_USR 
			(
				WDK_USR_COD, 
				WDK_USR_NOM, 
				WDK_USR_USR, 
				WDK_USR_SNH,
				WDK_USR_EMA
			) 
			VALUES 
			(
				NULL, 
				'".$this->usr_nome."', 
				'".$this->usr_usuario."', 
				MD5('".$this->usr_senha."'),
				'".$this->usr_email."'
			);";
			
			$wdk_result = mysqli_query($bd_conexao, $wdk_query);
						
			if($wdk_result)
			{
				$path = "conteudo/diretorio/upload/".$this->usr_usuario;
				if (!file_exists($path)) {
					mkdir($path, 0755);
				}
				print "aceito";
			}
			else
			{
				print "erro";
			}				
		}
	}
}

class iniciaSistema
{	
	private $sis_bg;
	
	public function set($prop,$value)
	{
		$this->$prop=$value;
	}

	public function telaSistema()
	{
		require("linguagem/lang_pt-BR.php");
		include('sistema/tela_sistema.php');
	}
	
	public function aplicaBackground()
	{
		global $bd_conexao;
		
		$wdk_query 		= "UPDATE TB_WDK_USR SET WDK_USR_BGD = '".$this->sis_bg."' WHERE WDK_USR_COD = '".$_SESSION["codigo"]."';";
		$wdk_executa 	= mysqli_query($bd_conexao, $wdk_query);
		print $wdk_query;
	}
	
	public function mostraBackground()
	{
		global $bd_conexao;
		
		$wdk_query 		= "SELECT WDK_USR_BGD FROM TB_WDK_USR WHERE WDK_USR_COD = '".$_SESSION["codigo"]."';";
		$wdk_executa 	= mysqli_query($bd_conexao, $wdk_query);
		$wdk_resultado 	= mysqli_num_rows($wdk_executa);
		
		if($wdk_resultado > 0)
		{
			while ($wdk_linha = mysqli_fetch_array($wdk_executa)) 
			{					
				print $wdk_linha['WDK_USR_BGD'];
			}
		}
	}

}

class indicadorSistema
{
	public function indicadorOnline()
	{
		global $bd_conexao;
		
		$wdk_query 		= "SELECT WDK_USR_STS FROM TB_WDK_USR WHERE WDK_USR_COD = '".$_SESSION["codigo"]."' AND WDK_USR_STS <> 0";
		$wdk_executa 	= mysqli_query($bd_conexao, $wdk_query);
		$wdk_resultado 	= mysqli_num_rows($wdk_executa);
		
		print $wdk_resultado;
	}
	
	public function indicadorMensagem()
	{
		global $bd_conexao;
		
		$cht_query 		= "SELECT CHT_MSG_COD FROM TB_CHT_MSG WHERE CHT_MSG_REC = '".$_SESSION["codigo"]."' AND CHT_MSG_VIS = '1';";
		$cht_executa 	= mysqli_query($bd_conexao, $cht_query);
		$cht_resultado 	= mysqli_num_rows($cht_executa);
		
		print $cht_resultado;
	}
}

?>