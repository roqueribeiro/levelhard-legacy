<?php

	require "../core.php";
	
	$veicData[1] 	= $_GET["codigo"];
	$veicData[2] 	= $_GET["cod_proprietario"];
	$veicData[3] 	= $_GET["marca"];
	$veicData[4] 	= $_GET["modelo"];
	$veicData[5] 	= $_GET["ano"];
	$veicData[6] 	= $_GET["placa"];
	
	$news = new Veiculo;
	$news->EditVeic($veicData);
	$news->ShowVeic($_SESSION["search_veic"],$_SESSION["search_prop2"]);
	
?>