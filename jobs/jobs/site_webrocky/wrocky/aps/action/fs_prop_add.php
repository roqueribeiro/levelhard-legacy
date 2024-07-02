<?php

	require "../core.php";
	
	$propData[1] 	= $_GET["codigo"];
	$propData[2] 	= $_GET["nome"];
	$propData[3] 	= $_GET["sobrenome"];
	$propData[4] 	= $_GET["telefone"];
	$propData[5] 	= $_GET["celular"];
	$propData[6] 	= $_GET["end_rua"];
	$propData[7] 	= $_GET["end_numero"];
	$propData[8] 	= $_GET["end_bairro"];
	$propData[9] 	= $_GET["end_cep"];
	$propData[10] 	= $_GET["end_cidade"];
	$propData[11] 	= $_GET["end_estado"];
	$propData[12] 	= $_GET["num_rg"];
	$propData[13] 	= $_GET["num_cpf"];
	$propData[14] 	= $_GET["num_cnh"];
	
	$news = new Proprietario;
	$news->AddProp($propData);
	$news->ShowProp($_SESSION["search_prop"]);
	
?>