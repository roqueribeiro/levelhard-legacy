<?php

	//================Config
	$descricao_oc	= "open"; //open ou close
	$site_link		= "../";

	//================Config Texto
	$titulo 		= "WebClin 2";
	$logo			= "WebClin 2";
	$logo_sub		= "Mini Sistema de Gerкnciamento de Pacientes";
	$cabecalho		= "Sobre o Sistema WebClin 2";
	$botao			= "Clique Aqui para Testar";
	
	//================Config Imagem
	//imagem-min
	$imagem[0][0]	= "images/webclin-001min.jpg";
	$imagem[0][1]	= "images/webclin-002min.jpg";
	$imagem[0][2]	= "images/webclin-003min.jpg";
	//imagem-max
	$imagem[1][0]	= "images/webclin-001.jpg";
	$imagem[1][1]	= "images/webclin-002.jpg";
	$imagem[1][2]	= "images/webclin-003.jpg";
	//imagem-text
	$imagem[2][0]	= "[ Tela de Cadastro de Pacientes ] Com Completa CEP e Carregamento Dinвmico dos Registros Apуs Cadastro.";
	$imagem[2][1]	= "[ Tela de Consulta ] Com Consulta ao CID Online, Ferramenta de ediзгo de Texto e Consultas Anteriores.";
	$imagem[2][2]	= "[ Tela de Consulta Anteriores ]";
	
	//================Config Descriзгo
	$ponteiro = fopen ("texto.txt","r");
	while(!feof($ponteiro))
	{
	  $linha 	  = fgets($ponteiro,4096);
	  $descricao .= $linha;
	}
	fclose ($ponteiro);

?>