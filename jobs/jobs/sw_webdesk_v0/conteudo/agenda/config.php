<?php

//Conexão com o banco de dados
$bd_server 		= "mysql.levelhard.com.br";
$bd_usuario 	= "levelhard04";
$bd_senha 		= "m1c2r3t4";
$bd_name		= "levelhard04";

$bd_connect = @mysql_connect($bd_server,$bd_usuario,$bd_senha);
$bd_select	= @mysql_select_db($bd_name);
$bd_charset	= @mysql_set_charset('utf8',$bd_connect);

if(!$bd_connect)
{ 
	die(error($error=1));
}
if(!$bd_select)
{
	die(error($error=0));
}
	
//Nome da Agenda
$SITE_NOME 		= "WebAgenda 1.7 Stable";

//WallPaper da Agenda
$WALLPAPER		= "A02.jpg"; //A01.jpg, A02.jpg, A03.jpg, A04.jpg, A05.jpg, A06.jpg, A07.jpg e A08.jpg. 

//---------------------------------------------------------Erros
function error($error)
{
	switch($error)
	{
		case 0:		
			$html = "<center><b>Ocorreu um erro!</b><br />Banco de Dados Nao Encontrado.</center>";
		break;
		case 1:
			$html = "<center><b>Ocorreu um erro!</b><br />Servidor, Usuario ou Senha Incorreto(s).</center>";
		break;
	}
	return $html;
}
?>