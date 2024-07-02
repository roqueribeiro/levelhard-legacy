<?php

	$tela = $_POST["tela"];
	
	switch($tela)
	{
		case "principal";
			print principal();
		break;
		case "produtos";
			print produtos();
		break;
		case "quemsomos";
			print quemsomos();
		break;
		case "contato";
			print contato();
		break;
		case "email";
			print email();
		break;
	}
	
function principal()
{
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/home.png">Bem-Vindo(a) ao Lenha Ecologica Martins</li>
		</ul>
		<ul id="escopo">
			<li>
			<p>A lenha ecológica ou briquete, como também é conhecida, é o substituto ecologicamente correto da lenha, óleo BPF e outros do gênero.</p>
			<p>O briquete é produzido a partir do pó de serra de madeiras, por isso contribui com a natureza de forma a reduzir os resíduos de madeireiras, reaproveitando as suas sobras.</p>
			<p>A lenha ecológica é de fácil manuseio, vindo embalada em sacos de farinha (também um reaproveitamento das padarias) com cerca de 35 kg.</p>
			<p>Material totalmente seco, com algo em torno de apenas 7% de umidade, grau baixíssimo para fornos e caldeiras.</p>
			<p>O briquete é também de fácil estocagem, consumindo muito pouco espaço, ideal para as pizzarias e padarias que necessitam de praticidade e fácil armazenamento, consumindo assim o mínimo de espaço possível.</p>
			</li>
		</ul>
		<ul id="minilogo">
			<li><img src="image/logo-lenhaeco-font.png"></li>
		</ul>
	</div>
	';
	return $jQuery.$html;
}

function produtos()
{
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">Produtos</li>
		</ul>
		<ul id="escopo">
			<li style="width:430px; padding-right:20px;">
			<p>O briquete produzido em nossa fábrica, vem ensacado em sacos de farinha que pesam em média 35 kg, sendo um produto de fácil manuseio e também de fácil armazenamento.</p>
			<p>Como base, uma tonelada de lenha ecológica, equivale a 5 m³ de lenha convencional (comparação baseada em poder calorífico).
			<p>Sua estocagem, como citado anteriormente é muito fácil, pois não exige um amplo espaço, sendo que em uma área de 1 m², é possível armazenar uma tonelada de briquete.</p>
			<p>O briquete possui um poder calorífico de cerca de 4500 kcal contra 2500 kcal de lenha, sendo também mais viável para consumo pois emana mais calor que a lenha.</p>
			</li>
			<li><img src="image/tabela-briquete.jpg"></li>
		</ul>
		<ul>
			<li>
			<div id="galeria">
			<ul id="cabecalho">
				<li>Galeria de Imagens</li>
			</ul>
			<ul id="imagens">
				<li><a href="image/galeria/image001.jpg" rel="group" title="LMS - Lenha Ecológica Martins"><img src="image/galeria/image001.jpg"></a></li>
				<li><a href="image/galeria/image002.jpg" rel="group" title="LMS - Lenha Ecológica Martins"><img src="image/galeria/image002.jpg"></a></li>
				<li><a href="image/galeria/image003.jpg" rel="group" title="LMS - Lenha Ecológica Martins"><img src="image/galeria/image003.jpg"></a></li>
				<li><a href="image/galeria/image004.jpg" rel="group" title="LMS - Lenha Ecológica Martins"><img src="image/galeria/image004.jpg"></a></li>
			</ul>
			</div>
			</li>
		</ul>
		<ul id="minilogo">
			<li><img src="image/logo-lenhaeco-font.png"></li>
		</ul>
	</div>
	';
	return $jQuery.$html;
}

function quemsomos()
{
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/empresa.png">Quem Somos</li>
		</ul>
		<ul id="escopo">
			<li>
			<p>Nós da Lenha Ecológica Martins, somos uma empresa familiar, que atua a cinco anos no mercado de energia renovável.</p>
			<p>Fabricamos em média 600 toneladas/mês de lenha ecológica. </p>
			<p>Nossa produção é mais voltada para o atendimento de pizzarias e padarias, atuando dessa forma principalmente no mercado de São Paulo Capital.</p>
			<br />
			<p align="center"><b>Venha nos fazer uma visita e conhecer mais sobre nossa empresa!</b></p>
			</li>
		</ul>
		<ul id="minilogo">
			<li><img src="image/logo-lenhaeco-font.png"></li>
		</ul>
	</div>	
	';
	return $jQuery.$html;
}

function contato()
{
	$jQuery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		$('input[name=telefone]').mask('(99) 9999-9999?9').ready(function(event) {
			var target, phone, element;
			target = (event.currentTarget) ? event.currentTarget : event.srcElement;
			phone = target.value.replace(/\D/g, '');
			element = $(target);
			element.unmask();
			if(phone.length > 10) {
				element.mask('(99) 99999-999?9');
			} else {
				element.mask('(99) 9999-9999?9');  
			}
		});
		
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
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/email.png">Contato</li>
		</ul>
		<ul id="escopo">
			<li>
			<div id="formulario">
			<ul id="cabecalho">
				<li style="text-align:center;">Os Campos com * são Obrigatórios</li>
			</ul>
			<ul id="campos">
				<form name="contato" action="core/core.php" method="post">
				<input type="hidden" name="tela" value="email">
				<li>
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
				<ul id="enviar">
					<li><input type="submit" value="Enviar"></li>
				</ul>
				</li>
				</form>
			</ul>
			<ul id="campos">
				<li>
				<ul id="cabecalho">
					<li style="width:100%;">Lenha Ecológica Martins</li>
				</ul>
				<ul>
					<li style="width:60px;">Endereço:</li>
					<li>Avenida Jaguarari, 5403</li>
				</ul>
				<ul>
					<li style="width:60px;">Bairro:</li>
					<li>Moinhos de Vento</li>
				</ul>
				<ul>
					<li style="width:60px;">Cidade/UF:</li>
					<li>Santa Rosa do Sul - SC</li>
				</ul>
				<ul>
					<li style="width:60px;">CEP:</li>
					<li>88965-000</li>
				</ul>
				<ul>
					<li style="width:60px;">Telefone:</li>
					<li>(48) 3534-2396</li>
				</ul>
				<ul>
					<li style="width:60px;">E-Mail:</li>
					<li><a href="mailto: contato@lenhaecologicamartins.com.br">contato@lenhaecologicamartins.com.br</a></li>
				</ul>
				</li>
			</ul>
			</div>
			</li>
		</ul>
		<ul id="minilogo">
			<li><img src="image/logo-lenhaeco-font.png"></li>
		</ul>
	</div>	
	';
	return $jQuery.$html;
}

function email()
{
	$data[0] = $_GET["nome"];
	$data[1] = $_GET["telefone"];
	$data[3] = $_GET["email"];
	$data[4] = $_GET["texto"];
	
	// ============= Direcionamento =============
	$mail_endereco	= "contato@lenhaecologicamartins.com.br";
	$mail_descricao	= "E-mail Enviado Pelo Site Lenha Ecologica Martins";
	$mail_assunto	= "Email recebido pelo site";
	// ============= Dados do Formulario =============
	$mail_nome 		= $_GET["nome"];
	$mail_telefone 	= $_GET["telefone"];
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
	$mail_content  .= "</p><br /><br />";
	$mail_content  .= $mail_texto;
	// ============= Envia E-Mail =============
	$send_mail 		= @mail($mail_endereco,$mail_assunto,$mail_content,$mail_html);
	
	if($send_mail){	return 1; } else { return 0; }
	
}

?>