<?php

if (!isset($_SESSION)){
    session_start();
}

date_default_timezone_set('America/Sao_Paulo');

$msUser					= "levelhard06";
$msPass					= "********";
$msServer				= "mysql.levelhard.com.br";
$msDatabase				= "levelhard06";
$msConn 				= mysqli_connect($msServer, $msUser, $msPass, $msDatabase);
// mysqli_set_charset($msConn, "utf8");

?>
