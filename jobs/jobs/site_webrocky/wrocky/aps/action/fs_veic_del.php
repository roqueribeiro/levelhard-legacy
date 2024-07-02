<?php

	require "../core.php";
	
	$cod_prop = $_GET['idCod'];
	
	$news = new Veiculo;
	$news->DelVeic($cod_prop);
	$news->ShowVeic($_SESSION["search_veic"],$_SESSION["search_prop2"]);
	
?>