<?php

//Conexão com Banco de Dados
$bd_server 		= "mysql.levelhard.com.br";
$bd_usuario 	= "levelhard05";
$bd_senha 		= "********";
$bd_name		= "levelhard05";
$bd_connect 	= mysqli_connect($bd_server, $bd_usuario, $bd_senha, $bd_name);
mysqli_set_charset($bd_connect, "utf8");

//Variaveis do Sistema de Filtro
$produto 		= $_GET["produto"];
$caracteristica = $_GET["caracteristica"];
$reagente 		= $_GET["reagente"];
$resultado 		= $_GET["resultado"];
$comofazer 		= $_GET["comofazer"];
$optionPadrao	= '<option value="0">Selecione</option>';

if ($produto) {
	$Query = "SELECT * FROM caracteristica";
	$QueryApply = mysqli_query($bd_connect, $Query);
	$QueryResults = mysqli_num_rows($QueryApply);
	if ($QueryResults > 0) {
		while ($ResultRow = mysqli_fetch_array($QueryApply)) {
			$prod["codigo"] = $ResultRow["codigo"];
			$prod["nome"] 	= $ResultRow["nome"];

			$optionGen .= '<option value="' . $prod["codigo"] . '">' . $prod["nome"] . '</option>';
		}
	}
	print $optionPadrao . $optionGen;
}

if ($caracteristica) {
	$Query = "SELECT * FROM reagente WHERE caracteristica_cod = " . $caracteristica . "";
	$QueryApply = mysqli_query($bd_connect, $Query);
	$QueryResults = mysqli_num_rows($QueryApply);
	if ($QueryResults > 0) {
		while ($ResultRow = mysqli_fetch_array($QueryApply)) {
			$prod["codigo"] = $ResultRow["codigo"];
			$prod["nome"] 	= $ResultRow["nome"];

			$optionGen .= '<option value="' . $prod["codigo"] . '">' . $prod["nome"] . '</option>';
		}
	}
	print $optionPadrao . $optionGen;
}

if ($reagente) {
	$Query = "SELECT * FROM comofazer WHERE reagente_cod = " . $reagente . "";
	$QueryApply = mysqli_query($bd_connect, $Query);
	$QueryResults = mysqli_num_rows($QueryApply);
	if ($QueryResults > 0) {
		while ($ResultRow = mysqli_fetch_array($QueryApply)) {
			$prod["codigo"] = $ResultRow["codigo"];
			$prod["nome"] 	= $ResultRow["nome"];

			print '<li><label><input type="radio" name="comofazer" value="' . $prod["codigo"] . '"><span>' . $prod["nome"] . '</span></label></li>';
		}
	}
}

if ($comofazer) {
	$Query = "SELECT * FROM resultado WHERE comofazer_cod = " . $comofazer . "";
	$QueryApply = mysqli_query($bd_connect, $Query);
	$QueryResults = mysqli_num_rows($QueryApply);
	if ($QueryResults > 0) {
		while ($ResultRow = mysqli_fetch_array($QueryApply)) {
			$prod["codigo"] = $ResultRow["codigo"];
			$prod["nome"] 	= $ResultRow["nome"];

			print '<li><label><input type="radio" name="resultado" value="' . $prod["codigo"] . '"><span>' . $prod["nome"] . '</span></label></li>';
		}
	}
}

if ($resultado) {
	$Query = "
		SELECT 
				res.produto_cod,
				prod.nome
		FROM 
				resultado AS res
		INNER JOIN
				produto AS prod
		ON
				prod.codigo = res.produto_cod
		WHERE 
				res.comofazer_cod = " . $resultado . "
		";
	$QueryApply = mysqli_query($bd_connect, $Query);
	$QueryResults = mysqli_num_rows($QueryApply);
	if ($QueryResults > 0) {
		while ($ResultRow = mysqli_fetch_array($QueryApply)) {
			$prod["codigo"] = $ResultRow["produto_cod"];
			$prod["nome"] 	= $ResultRow["nome"];

			print $prod["nome"];
		}
	}
}

?>