<?php

	$bd_server 	= "mysql.votofix.com.br";
	$bd_usuario = "votofix01";
	$bd_senha 	= "m1c2r3t4";
	$bd_name	= "votofix01";
	$bd_connect = @mysql_connect($bd_server,$bd_usuario,$bd_senha);
	$bd_select	= @mysql_select_db($bd_name);
	$bd_charset	= @mysql_set_charset('utf8',$bd_connect);
	
	if(!$_POST["action"])
		$action = $_GET["action"];
	else
		$action = $_POST["action"];
	
	if($bd_connect)
	{		
		switch($action)
		{
			case "vtx_form":
				print VtxFormCad();
			break;
			case "vtx_download":
				print VtxDownload();
			break;
			case "cto_form";
				print CtoFormContato();
			break;
			case "cto_send";
				print CtoSendMail();
			break;
		}
	}
	else
	{
		print '<div id="formulario" style="padding:50px;">Serviço Temporariamente Indisponível.</div>';
	}
	
function VtxFormCad()
{
	$jQuery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		$('form[name=download]').ajaxForm({
			beforeSubmit: function() {
				$('#formulario input').attr('disabled','disabled');
				if($('input[name=nome]').val() == '')
				{
					alert('Digite seu Nome!');
					$('#formulario input').removeAttr('disabled');
					$('input[name=nome]').focus();
					return false;
				}
				else if($('input[name=mail]').val() == '')
				{
					alert('Digite seu E-Mail!');
					$('#formulario input').removeAttr('disabled');
					$('input[name=mail]').focus();
					return false;
				}
				else
				{
					$.fancybox.close();
				}
			},
			success: function(data) {
				$('#download').html(data);
			} 
		});
	});
	</script>
	";
	$html = '
	<div id="formulario">
		<form name="download" action="core.php?action=vtx_download" method="get">
		<ul>
			<li style="width:110px;">Nome Completo</li>
			<li><input type="text" name="nome"></li>
		</ul>
		<ul>
			<li style="width:110px;">E-Mail</li>
			<li><input type="text" name="mail"></li>
		</ul>
		<ul>
			<li><input type="submit" value="Baixar Demonstração"></li>
		</ul>
		</form>
	</div>
	';
	
	return $jQuery.$html;
}

function VtxDownload()
{
	$nome = $_GET["nome"];
	$mail = $_GET["mail"];

	if( $nome and $mail )
	{
		$Query = "
		INSERT INTO 
			usuario_tmp 
			(
				nome, 
				email, 
				data_hora, 
				ip_usr, 
				nav_usr
			) 
			VALUES 
			(
				'".$nome."',
				'".$mail."', 
				'".date("Y-m-d  H:i:s")."', 
				'".$_SERVER['REMOTE_ADDR']."', 
				'".$_SERVER['HTTP_USER_AGENT']."'
			);
		";
		$QueryApply = mysql_query($Query);
		
		if($QueryApply)
		{
			$programa 	= "http://membros.votofix.com.br/file/software/setupBDVotofix.rar";
			$jQuery 	= "<script type=\"text/javascript\"> $(document).ready(function(){ window.location = '".$programa."'; }); </script>";
		}
		else
		{
			$jQuery = "
			<script type=\"text/javascript\">
			$(document).ready(function(){ 
				alert('Erro! Não Foi Possível Encaminhar Download, Verifique se Preencheu Corretamente ou Tente Novamente Mais Tarde.');
			});
			</script>
			";
		}
		
	}
	else
	{
		$jQuery = "
		<script type=\"text/javascript\">
		$(document).ready(function(){ 
			alert('Erro! Não Foi Possível Encaminhar Download, Verifique se Preencheu Corretamente ou Tente Novamente Mais Tarde.');
		});
		</script>
		";
	}

	return $jQuery;
}

function CtoFormContato()
{
	$jQuery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		$('input[name=telefone]').mask('(99) 9999-9999');  
		
		$('form[name=contato]').ajaxForm({ 
			beforeSubmit: function(){
				
				$('#formulario input, #formulario textarea').attr('disabled','disabled');
				
				if(!$('input[name=nome]').val())
				{
					$('#formulario input, #formulario textarea').removeAttr('disabled');
					formValid('input[name=nome]','rgba(255,240,230,1)',3);
					return false;
				}
				else if($('input[name=nome]').val().length < 3)
				{
					$('#formulario input, #formulario textarea').removeAttr('disabled');
					formValid('input[name=nome]','rgba(255,240,230,1)',3);
					return false;
				}
				if(!$('input[name=email]').val())
				{
					$('#formulario input, #formulario textarea').removeAttr('disabled');
					formValid('input[name=email]','rgba(255,240,230,1)',6);
					return false;
				}
				else if($('input[name=email]').val().length < 6)
				{
					$('#formulario input, #formulario textarea').removeAttr('disabled');
					formValid('input[name=email]','rgba(255,240,230,1)',6);
					return false;
				}
				if(!$('textarea[name=texto]').val())
				{
					$('#formulario input, #formulario textarea').removeAttr('disabled');
					formValid('textarea[name=texto]','rgba(255,240,230,1)',10);
					return false;
				}
				else if($('textarea[name=texto]').val().length < 10)
				{
					$('#formulario input, #formulario textarea').removeAttr('disabled');
					formValid('textarea[name=texto]','rgba(255,240,230,1)',10);
					return false;
				}
			},
			success: function(data){
								
				if(data)
				{
					alert('Email Enviado! Em Breve Entraremos em Contato.');
					$('#formulario input[type=text], #formulario textarea').val('');
				}
				else
				{
					alert('Erro ao Enviar, Tente Novamente mais Tarde!');
				}
					
				$('#formulario input, #formulario textarea').removeAttr('disabled');
			} 
		});
		
	});
	</script>
	";
	$html = '
	<div id="contato">
		<div id="cabecalho">
			<span style="font-size:9px;">Os campos com * são obrigatórios</span>
		</div>
		<form name="contato" action="content/core.php?action=cto_send" method="post">
		<input type="hidden" name="tela" value="email">
		<div id="formulario">
		<ul>
			<li>Nome Completo*</li>
			<li><input type="text" name="nome"></li>
		</ul>
		<ul>
			<li>Telefone</li>
			<li><input type="text" name="telefone"></li>
		</ul>
		<ul>
			<li>Email*</li>
			<li><input type="text" name="email"></li>
		</ul>
		<ul>
			<li>Texto*</li>
			<li><textarea name="texto"></textarea></li>
		</ul>
		<ul>
			<li><input type="submit" value="Enviar"></li>
		</ul>
		</div>
		</form>
		<div id="rodape">
			<span style="font-size:9px;"><b>Contato VotoFix</b>: suporte@votofix.com.br</span>
		</div>
	</div>
	';
	return $jQuery.$html;
}

function CtoSendMail()
{
	$post_mail[1] = "suporte@votofix.com.br";
	$post_mail[2] = $_POST["email"];
	$post_mail[3] = $_POST["nome"];
	$post_mail[4] = $_POST["telefone"];
	$post_mail[5] = "Suporte VotoFix";
	
	$post_mail[6]  = "<p align=\"center\"><b>E-mail Enviado Pelo Site VotoFix</b></p><br /><br />";
	$post_mail[6] .= "<b>Enviado por:</b> ".$post_mail[3]." <b>E-Mail:</b> ".$post_mail[2]." <b>Telefone:</b> ".$post_mail[4]."<br /><br />";
	$post_mail[6] .= $_POST["texto"];
	
	$post_mail[7]  = "MIME-Version: 1.0\r\n";
	$post_mail[7] .= "Content-type: text/html; charset=utf-8\r\n";
	$post_mail[7] .= "From: ".$post_mail[3]." <".$post_mail[2].">\r\n";
	$post_mail[7] .= "Return-Path: ".$post_mail[2]."\r\n";
	
	$send_mail = mail($post_mail[1],$post_mail[5],$post_mail[6],$post_mail[7]);
		
	if($send_mail){	return 1; } else { return 0; }
	
}

?>