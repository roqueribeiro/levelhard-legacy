<?php

	require "../core.php";
	
	$cod_prop = $_GET['idCod'];
	
	$news = new Proprietario;
	$news->DelProp($cod_prop);
	$news->ShowProp($_SESSION["search_prop"]);
	
?>