<?php

	$post_mail[1] = "roque.ribeiro@webrocky.com.br";
	$post_mail[2] = $_POST["email"];
	$post_mail[3] = $_POST["nome"];
	$post_mail[4] = $_POST["assunto"];
	$post_mail[5] = "<b>E-mail Enviado Pelo WebClin</b><br /><br />".$_POST["texto"];
	
	$post_mail[6]  = 'MIME-Version: 1.0'."\r\n";
	$post_mail[6] .= 'Content-type: text/html; charset=utf-8'."\r\n";
	$post_mail[6] .= 'To: <'.$post_mail[0].'>'."\r\n";
	$post_mail[6] .= 'From: '.$post_mail[3].' <'.$post_mail[2].'>'."\r\n";
	
	$send_mail = mail($post_mail[1],$post_mail[4],$post_mail[5],$post_mail[6]);
	
	if($send_mail > 0){	print 1; } else { print 0; }
	
?>