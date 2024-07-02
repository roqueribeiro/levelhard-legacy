<?php

	$action = $_POST["action"];

	switch($action)
	{
		case "mail_send":
			print MailSend();
		break;
	}
	
function MailSend()
{	
	$post_mail[1] = "roque.ribeiro@levelhard.com.br";
	$post_mail[2] = $_POST["email"];
	$post_mail[3] = $_POST["nome"];
	$post_mail[4] = $_POST["assunto"];
	
	$post_mail[6]  = "<p align=\"center\"><b>E-mail Enviado Pelo Site WebRoCkY</b></p><br />";
	$post_mail[6] .= $_POST["texto"];
	
	$post_mail[7]  = "MIME-Version: 1.0\r\n";
	$post_mail[7] .= "Content-type: text/html; charset=utf-8\r\n";
	$post_mail[7] .= "From: ".$post_mail[3]." <".$post_mail[2].">\r\n";
	$post_mail[7] .= "Return-Path: ".$post_mail[2]."\r\n";
	
	$send_mail = mail($post_mail[1],$post_mail[4],$post_mail[6],$post_mail[7]);
			
	if($send_mail)
	{
		$html = "
		<div id=\"wrocky_form\" style=\"text-align:center;\">
			E-Mail enviado! Obrigado.
			<br /><br />
			<input type=\"button\" value=\"Fechar\" onclick=\"$.fancybox.close();\">
		</div>
		";
	}
	else
	{
		$html = "
		<div id=\"wrocky_form\" style=\"text-align:center;\">
			Erro ao enviar, Possível problema interno. Tente novamente mais tarde!
			<br /><br />
			<input type=\"button\" value=\"Fechar\" onclick=\"$.fancybox.close();\">
		</div>
		";
	}
	
	return $html;
}

?>