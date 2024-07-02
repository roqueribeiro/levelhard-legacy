<?php
	
	switch($_GET["tela"])
	{
		case "empresa":
			print empresa();
		break;
		case "cadastro":
			print cadastro();
		break;
		case "contato":
			print contato();
		break;
		case "contato_send":
			print contato_send();
		break;
	}

function empresa()
{
	$jQuery = "";
	$html = '
	<style type="text/css">
	#container img
	{
		position:relative;
		width:96px;
	}
	#container img:hover
	{
		-webkit-transform:scale(2.0) translateY(-10px);
		-moz-transform:scale(2.0) translateY(-10px);
		-o-transform:scale(2.0) translateY(-10px);
		-ms-transform:scale(2.0) translateY(-10px);
		transform:scale(2.0) translateY(-10px);
		z-index:100;
	}
	</style>
	<div id="janela">
		<div id="cabecalho">
			<span>Lojas Sapatos & Cia</span>
		</div>
		<div id="container">
		<ul>
			<li style="width:700px; text-align:justify; margin:0 40px 0 40px;">
			<p>A partir da idéia de comercializar sapatos e acessórios exclusivos, a Sapatos e Cia teve sua primeira loja instalada em 1990, em Cerquilho, na rua Dr. Soares Hungria. Inicialmente o espaço que abrigava os produtos era um pequeno corredor e uma sala.</p>
			<p>Devido ao bom andamento dos negócios, a loja acabou alugando o prédio todo. Outro fator decisivo para a expansão do empreendimento foi a boa aceitação de clientes de cidades vizinhas, assim, em 1996, foi aberta uma filial em Tietê.</p>
			<p>Atualmente instalada no centro de Cerquilho, na av. presidente Washington Luiz, 155, em Tietê, na Rua Rafael de Campos, 143, centro, e também em Boituva, a mais nova, localizada na Rua São João, 82, na região central.</p>
			</li>
		</ul>
		<ul>
			<li style="width:750px; padding:15px 20px 15px 20px; text-align:center;">
				<img src="galeria/lojas/cerquilho/img001_s.jpg" longdesc="galeria/lojas/cerquilho/img001.jpg" alt="">
				<img src="galeria/lojas/cerquilho/img002_s.jpg" longdesc="galeria/lojas/cerquilho/img002.jpg" alt="">
				<img src="galeria/lojas/tiete/img001_s.jpg" longdesc="galeria/lojas/tiete/img001.jpg" alt="">
				<img src="galeria/lojas/tiete/img002_s.jpg" longdesc="galeria/lojas/tiete/img002.jpg" alt="">
				<img src="galeria/lojas/boituva/img001_s.jpg" longdesc="galeria/lojas/boituva/img001.jpg" alt="">
				<img src="galeria/lojas/boituva/img002_s.jpg" longdesc="galeria/lojas/boituva/img002.jpg" alt="">
				<img src="galeria/lojas/boituva/img003_s.jpg" longdesc="galeria/lojas/boituva/img003.jpg" alt="">
			</li>
		</ul>
		<ul>
			<li style="width:700px; text-align:center; margin:0 40px 0 40px;">
			<div style="width:220px !important;">
				<p style="font-weight:bold;">Cerquilho</p>
				<p style="font-size:12px;">Av. Pres. Washington Luiz, 115</p>
				<p style="font-size:12px;">Centro - Fone 15 3284.2795</p>
			</div>
			<div style="width:220px !important;">
				<p style="font-weight:bold;">Tietê</p>
				<p style="font-size:12px;">Rua Rafael de Campos, 143</p>
				<p style="font-size:12px;">Centro - Fone 15 3285.1097</p>
			</div>
			<div style="width:220px !important;">
				<p style="font-weight:bold;">Boituva</p>
				<p style="font-size:12px;">Rua São João, 82</p>
				<p style="font-size:12px;">Centro - Fone 15 3263.4146</p>
			</div>
			</li>
		</ul>
		<ul>
			<li style="width:700px; text-align:center; margin:0 40px 0 40px;">
			<p>Horário de Atendimento</p>
			<p>De Segunda a Sexta, das 9h as 18h e aos Sábados, das 9h as 16h</p>		
			</li>
		</ul>
		</div>
	</div>
	';
	return $jQuery.$html;
}

function contato()
{
	$jQuery = "
	<script type=\"text/javascript\">
	function formValid(input,color,len)
	{
		$(input).css('background',color);
		$(input).focus();
		$(input).keyup(function(){
			length = $(this).val().length;
			if(length >= len) $(this).css('background','rgba(255,255,255,1)');
		});
	}	
	$(document).ready(function(){
		
		$('input[name=telefone]').mask('(99) 9999-9999');  
		
		$('form[name=contato]').ajaxForm({ 
			beforeSubmit: function(){
				
				$('#container input, #container textarea').attr('disabled','disabled');
				
				if(!$('input[name=nome]').val())
				{
					$('#container input, #container textarea').removeAttr('disabled');
					formValid('input[name=nome]','rgba(255,240,230,1)',3);
					return false;
				}
				else if($('input[name=nome]').val().length < 3)
				{
					$('#container input, #container textarea').removeAttr('disabled');
					formValid('input[name=nome]','rgba(255,240,230,1)',3);
					return false;
				}
				if(!$('input[name=email]').val())
				{
					$('#container input, #container textarea').removeAttr('disabled');
					formValid('input[name=email]','rgba(255,240,230,1)',6);
					return false;
				}
				else if($('input[name=email]').val().length < 6)
				{
					$('#container input, #container textarea').removeAttr('disabled');
					formValid('input[name=email]','rgba(255,240,230,1)',6);
					return false;
				}
				if(!$('textarea[name=texto]').val())
				{
					$('#container input, #container textarea').removeAttr('disabled');
					formValid('textarea[name=texto]','rgba(255,240,230,1)',10);
					return false;
				}
				else if($('textarea[name=texto]').val().length < 10)
				{
					$('#container input, #container textarea').removeAttr('disabled');
					formValid('textarea[name=texto]','rgba(255,240,230,1)',10);
					return false;
				}
			},
			success: function(data){
												
				if(data)
				{
					alert('Email Enviado! Em Breve Entraremos em Contato.');
					$('#container input[type=text], #container textarea').val('');
				}
				else
				{
					alert('Erro ao Enviar, Tente Novamente mais Tarde!');
				}
					
				$('#container input, #container textarea').removeAttr('disabled');
			} 
		});
		
	});
	</script>
	";
	
	$html = '
	<div id="janela">
		<div id="cabecalho">
			<span>Os campos com * são obrigatórios</span>
		</div>
		<form name="contato" action="core.php" method="get">
		<input type="hidden" name="tela" value="contato_send">
		<div id="container">
		<ul>
			<li>Nome Completo*</li>
			<li><input type="text" name="nome"></li>
		</ul>
		<ul>
			<li>Empresa</li>
			<li><input type="text" name="empresa"></li>
		</ul>
		<ul>
			<li>Telefone*</li>
			<li><input type="text" name="telefone"></li>
		</ul>
		<ul>
			<li>Email*</li>
			<li><input type="text" name="email"></li>
		</ul>
		<ul>
			<li>Produto*</li>
			<li><select name="produto">
				<option>Personalização de Frota</option>
				<option>Fachadas</option>
				<option>Banners</option>
				<option>Lonas</option>
				<option>Outdoor</option>
				<option>Cardápios</option>
				<option>Toldos</option>
				<option>Adesivos/Recorte Eletrônico</option>
				<option>Adesivos Diversos</option>
				<option>Outros</option>
			</select></li>
		</ul>
		<ul>
			<li>Quantidade</li>
			<li><input type="text" name="quantidade"></li>
		</ul>
		<ul>
			<li>Descrição*</li>
			<li><textarea name="texto"></textarea></li>
		</ul>
		<ul>
			<li>Como nos achou?*</li>
			<li><select name="midia">
				<option>Sites de Busca</option>
				<option>Redes Sociais</option>
				<option>Outdoor</option>
				<option>Mídias</option>
				<option>Indicação</option>
				<option>Outros</option>
			</select></li>
		</ul>
		<ul>
			<li><input type="submit" value="Enviar"></li>
		</ul>
		</div>
		</form>
		<div id="rodape">
			<span><b>ImpriMil</b>: <a href="mailto:atendimento@imprimil.com.br">atendimento@imprimil.com.br</a> <b>Tel:</b> (15) 3259-6362</span>
		</div>
	</div>
	';
	return $jQuery.$html;
}

function contato_send()
{
	$post_mail[1] = "suporte@sapatosecia.com.br";
	$post_mail[2] = $_POST["email"];
	$post_mail[3] = $_POST["nome"];
	$post_mail[4] = $_POST["telefone"];
	$post_mail[5] = "Contato Sapatos & Cia";
	
	$post_mail[6]  = "<p align=\"center\"><b>E-mail Enviado Pelo Site Sapatos & Cia</b></p><br /><br />";
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