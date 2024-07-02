<?php

	$tela = $_POST["tela"];
	
	switch($tela)
	{
		// ======= Tela Inicial ======= //
		case "principal";
			print principal();
		break;
		case "empresa";
			print empresa();
		break;
				
		// ======= Contato ======= //
		case "contato";
			print contato();
		break;
		case "email";
			print email();
		break;
	}
	
function MontaImagem($img_dir)
{
	chdir("../image/galeria/".$img_dir);
	$diretorio = getcwd();
	$ponteiro  = opendir($diretorio);
	while($nome_itens = readdir($ponteiro)){ $itens[] = $nome_itens; }
	sort($itens);
	foreach($itens as $listar) 
	{
		if ($listar!="." && $listar!="..")
		{ 
			if (is_dir($listar)) 
			{ 
				$pastas[]=$listar; 		
			} 
			else
			{
				$arquivos[]=$listar;		
			}   
		}
	}
	if ($arquivos != "") 
	{
		foreach($arquivos as $listar)
		{
			$img_ext = explode('.',$listar);
			$img_min = explode('_',$img_ext[0]);
			if(!$img_min[1] && $img_ext[1] != 'db')
			$img_list .= '
			<a href="image/galeria/'.$img_dir.'/'.$img_min[0].'.'.$img_ext[1].'" rel="group">
				<li style="background:url(image/galeria/'.$img_dir.'/'.$img_min[0].'_s.'.$img_ext[1].') center;"></li>
			</a>
			';
		}
	}	
	
	return $img_list;
}	

function principal()
{
	$jQuery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		$('#slider').nivoSlider({
			effect				: 'fold',
			animSpeed			: 600,
			pauseTime			: 9000,
			controlNavThumbs	: true, 
			directionNavHide	: false
		});
	});
	</script>
	";
	$html = '
	<div id="conteudo">
		<div class="slider-wrapper theme-levelhard">
			<div class="ribbon"></div>
			<div id="slider" class="nivoSlider">
				<img src="image/galeria/home/imagem.jpg" alt="" title="" />
				<img src="image/galeria/home/imagem2.jpg" alt="" title="" />
				<img src="image/galeria/home/imagem3.jpg" alt="" title="" />
				<img src="image/galeria/home/imagem4.jpg" alt="" title="" />
			</div>
		</div>
		<ul id="cabecalho">
			<li><img src="image/icones/home.png">Vipax - Cortes a Laser</li>
		</ul>
		<ul id="escopo" style="font-size:15px;">
			<p align="left">A VIPAX vem ao longo do tempo atuando no desenvolvimento de novos processos e produtos.</p>
			<p align="left">Nosso Objetivo é auxiliá-lo no desenvolvimento e produção de seus produtos dentro de  suas especificações  afim de melhorar a qualidade e satisfazer a necessidade de seus clientes.</p>
		</ul>
	</div>
	';
	return $html.$jQuery;
}


function empresa()
{
	$img = MontaImagem('empresa');
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/home.png">A Empresa</li>
		</ul>
		<ul id="escopo" style="font-size:15px;">
			<p align="left">A VIPAX esta no mercado oferecendo sua experiência para que sua empresa  possa desenvolver seus produtos, melhorar e aprimorar os seus processos a fim de satisfazer a necessidade e expectativa de seus clientes e parceiros.</p>
			<p align="left">Trabalhamos com corte e gravação a laser de materiais não metálico na execução de protótipos, peças técnicas  complexas de muita precisão  ou sua produção. </p>
			<p align="left">Além disso temos nossa loja virtual a qual disponibilizamos diversos produtos de nossa criação com design exclusivo VIPAX bem como produtos de nossos clientes e parceiros.</p>
		</ul>
		<ul>
			<li>
			<div id="galeria">
			<ul id="cabecalho">
				<li><img src="image/icones/galeria.png">Galeria de Imagens</li>
			</ul>
			<ul id="imagens">
				'.$img.'
			</ul>
			</div>
			</li>
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
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/contato.png">Contato</li>
		</ul>
		<ul id="escopo">
			<li>
			<div id="formulario">
			<ul>
				<li style="width:100%; text-align:center; padding:15px;"><b>Os Campos com * são Obrigatórios</b></li>
			</ul>
			<ul id="campos">
				<form name="contato" action="core/core.php" method="post">
				<input type="hidden" name="tela" value="email">
				<li>
				<ul>
					<li>Nome Completo*</li>
					<li><input type="text" name="nome" placeholder="Nome e Sobrenome"></li>
				</ul>
				<ul>
					<li>Telefone</li>
					<li><input type="text" name="telefone" placeholder="Telefone ou Celular"></li>
				</ul>
				<ul>
					<li>Email*</li>
					<li><input type="text" name="email" placeholder="E-Mail"></li>
				</ul>
				<ul>
					<li>Texto*</li>
					<li><textarea name="texto" placeholder="Digite aqui sua pergunta..."></textarea></li>
				</ul>
				<ul id="enviar">
					<li><input type="submit" value="Enviar"></li>
				</ul>
				</li>
				</form>
			</ul>
			<ul id="campos">
				<li>
				<ul>
					<li style="width:100%; text-align:center; padding:15px;"><b>Vipax - Cortes a Laser</b></li>
				</ul>
				<ul>
					<li style="width:60px;">Endereço:</li>
					<li>Av. Prefeito Luiz La torre</li>
				</ul>
				<ul>
					<li style="width:60px;">Número:</li>
					<li>4401, Box 1</li>
				</ul>
				<ul>
					<li style="width:60px;">CEP:</li>
					<li>13.290-430</li>
				</ul>
				<ul>
					<li style="width:60px;">Cidade:</li>
					<li>Jundiaí</li>
				</ul>
				<ul>
					<li style="width:60px;">Estado</li>
					<li>São Paulo</li>
				</ul>
				<ul>
					<li style="width:60px;">Telefone:</li>
					<li>(11) 7864-4908</li>
				</ul>
				<ul>
					<li style="width:60px;">Nextel:</li>
					<li>ID 118*10698</li>
				</ul>
				<ul>
					<li style="width:60px;">E-Mail:</li>
					<li><a href="mailto:comercial@vipax.com.br">comercial@vipax.com.br</a></li>
				</ul>
				<ul>
					<li style="width:60px;">E-Mail:</li>
					<li><a href="mailto:vipax@vipax.com.br">vipax@vipax.com.br</a></li>
				</ul>
				</li>
			</ul>
			</div>
			</li>
		</ul>
	</div>	
	';
	return $jQuery.$html;
}

function email()
{
	$post_mail[1] = "corte@vipax.com.br";
	$post_mail[2] = $_POST["nome"];
	$post_mail[3] = $_POST["mail"];
	$post_mail[4] = "E-Mail Vipax Site";
	
	$post_mail[5]  = "<p align=\"center\"><b>E-Mail Vipax</b></p><br />";
	$post_mail[5] .= $_POST["texto"];
	
	$post_mail[6]  = "MIME-Version: 1.0\r\n";
	$post_mail[6] .= "Content-type: text/html; charset=utf-8\r\n";
	$post_mail[6] .= "From: ".$post_mail[2]." <".$post_mail[3].">\r\n";
	$post_mail[6] .= "Return-Path: ".$post_mail[3]."\r\n";
	
	$send_mail = @mail($post_mail[1],$post_mail[4],$post_mail[5],$post_mail[6]);
			
	if($send_mail) return 1;
	
}

?>
