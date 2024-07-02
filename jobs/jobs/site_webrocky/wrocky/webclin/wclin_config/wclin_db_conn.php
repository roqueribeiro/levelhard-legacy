<?php

	$bd_server 		= "mysql.webrocky.com.br";
	$bd_usuario 	= "webrocky04";
	$bd_senha 		= "m1c2r3t4";
	$bd_name		= "webrocky04";
		
	$bd_connect = @mysql_connect($bd_server,$bd_usuario,$bd_senha);
	$bd_select	= @mysql_select_db($bd_name);
	$bd_charset	= @mysql_set_charset('utf8',$bd_connect);
	
	if(!$bd_connect)
	{
		die($wclin_error_msg[1]); 
	}
	if(!$bd_select)
	{
		die($wclin_error_msg[1]); 
	}
				
?>