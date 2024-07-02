<?php

	$action = $_GET["action"];
	
	switch($action) {
		case "sendmail":
			return fnExecSendEmail();
		break;
	}

function fnExecSendEmail() {
	
	try 
	{
		$data[0] = $_GET["nome"];
		$data[1] = $_GET["telefone"];
		$data[2] = $_GET["celular"];
		$data[3] = $_GET["email"];
		$data[4] = $_GET["texto"];

		//Espaco para o procedimento de envio do email (print_r($data))
		print "Sua mensagem foi encaminhada com sucesso! Obrigado pelo contato, retornaremos o mais breve possível.";
	} 
	catch (Exception $e) 
	{
		print "" + $e->getMessage();
	}
	
}	
	
?>