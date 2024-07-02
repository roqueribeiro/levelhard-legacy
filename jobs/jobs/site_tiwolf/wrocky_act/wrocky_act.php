
<?php

	$action = $_POST["action"];

	switch($action)
	{
		case "mail_send":
			print MailSend();
		break;
		default:
			print "undefined";
		break;
	}
	
function MailSend()
{
	$para 		= "tiago@tiwolf.com";	
	$assunto 	= $_POST["assunto"];
	$texto 		= $_POST["texto"];
	$nome 		= $_POST["nome"];
	$email 		= $_POST["email"];
	
	$cabecalho = "Enviado por: ".$nome." E-Mail: ".$email;
	
	$envio = mail($para, $assunto, $texto, $cabecalho);
	
	if($envio)
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