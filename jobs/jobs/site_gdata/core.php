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
		
		// ============= Direcionamento =============
		$mail_endereco	= "roque.ribeiro@levelhard.com.br"; //Email de Contato (Quem recebera os emails)
		$mail_descricao	= "E-Mail de contato pelo site Global Data";
		$mail_assunto	= "Email recebido pelo site";
		// ============= Dados do Formulario =============
		$mail_nome 		= $_GET["nome"];
		$mail_telefone 	= $_GET["telefone"];
		$mail_celular	= $_GET["celular"];
		$mail_email 	= $_GET["email"];
		$mail_texto 	= $_GET["texto"];
		// ============= Header =============
		$mail_html  	= "MIME-Version: 1.0\r\n";
		$mail_html     .= "Content-type: text/html; charset=utf-8\r\n";
		$mail_html     .= "From: ".$mail_nome." <".$mail_email.">\r\n";
		$mail_html     .= "Return-Path: ".$mail_email."\r\n";
		// ============= Monta E-Mail =============
		$mail_content  	= "<p align=\"center\"><b>".$mail_descricao."</b></p><br /><br />";
		$mail_content  .= "<p align=\"center\">";
		$mail_content  .= "<b>Nome:</b> ".$mail_nome;
		$mail_content  .= "<b> Tel.:</b> ".$mail_telefone;
		$mail_content  .= "<b> Cel.:</b> ".$mail_celular;
		$mail_content  .= "</p><br /><br />";
		$mail_content  .= $mail_texto;
		// ============= Envia E-Mail =============
		$send_mail 		= @mail($mail_endereco,$mail_assunto,$mail_content,$mail_html);
	
		//Espaco para o procedimento de envio do email (print_r($data))
		print "Sua mensagem foi encaminhada com sucesso! Obrigado pelo contato, retornaremos o mais breve possível.";
	} 
	catch (Exception $e) 
	{
		print $e->getMessage();
	}
	
}	
	
?>