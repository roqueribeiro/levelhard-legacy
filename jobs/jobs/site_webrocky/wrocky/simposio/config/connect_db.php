<?php

$bd_server 		= "localhost";
$bd_usuario 	= "root";
$bd_senha 		= "";
$bd_name		= "bd_simposio";

$bd_connect = @mysql_connect($bd_server,$bd_usuario,$bd_senha);
$bd_select	= @mysql_select_db($bd_name);
$bd_charset	= @mysql_set_charset('utf8',$bd_connect);

if(!$bd_connect){ die('Erro! Acesso Negado ao Banco de Dados.'); }
if(!$bd_select){ die('Erro! Banco de Dados Selecionado Não Existe.'); }

//Metodo de definição dos caracteres
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

?>
