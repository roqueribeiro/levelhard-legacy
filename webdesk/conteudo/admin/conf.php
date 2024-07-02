<?php

// ============= Variaveis de Conexão com o Banco ============= //

$BD_HOST 	= "localhost";
$BD_NAME 	= "bd_webdesk";
$BD_USER 	= "root";
$BD_PASS 	= "123456";

// ============= Variaveis de Sistema POST ============= //

$SYS_ACTION = $_POST["action"];
$SYS_SEARCH	= $_POST["pesquisa"];

$USR_COD 	= $_POST["cod"];
$USR_APV 	= $_POST["apv"];
$USR_NAME 	= $_POST["nome"];
$USR_EMAL 	= $_POST["email"];
$USR_USER 	= $_POST["usuario"];
$USR_PASS 	= $_POST["senha"];
$USR_LEVEL 	= $_POST["acesso"];
$USR_COMP 	= $_POST["empresa"];

?>