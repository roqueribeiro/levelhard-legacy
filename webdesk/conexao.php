<?php

ini_set("display_errors", 0);

//Variaveis de Conexão com Banco de Dados
$bd_server      = "mysql.levelhard.com.br";
$bd_usuario     = "levelhard05";
$bd_senha       = "********";
$bd_name        = "levelhard05";
$bd_conexao     = mysqli_connect($bd_server, $bd_usuario, $bd_senha, $bd_name);
mysqli_set_charset($bd_conexao, "utf8");

?>