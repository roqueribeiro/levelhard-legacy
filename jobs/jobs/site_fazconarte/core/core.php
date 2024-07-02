<?php

	$tela = $_POST["tela"];
	
	switch($tela)
	{
		// ======= Tela Inicial ======= //
		case "principal";
			print principal();
		break;
		case "projetos";
			print projetos();
		break;
		case "servicos";
			print servicos();
		break;
		case "parceiros";
			print parceiros();
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
		$('#slider').nivoSlider();
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
			<li><img src="image/icones/home.png">FazConArte - Fazendo e Conhecendo Arte</li>
		</ul>
		<ul id="escopo">
			<p align="left"></p>
		</ul>
	</div>
	';
	return $html.$jQuery;
}

function projetos()
{
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">Projetos</li>
		</ul>
		<ul id="escopo">
			<li></li>
		</ul>
		<ul>
			<li>
			<div id="galeria">
			<ul id="cabecalho">
				<li><img src="image/icones/galeria.png">Galeria de Imagens</li>
			</ul>
			<ul id="imagens">
				<li>
					<a href="image/galeria/projetos/img001.jpg" rel="group" title="Cond. Minha Casa Minha Vida Tatuí-SP">
						<img src="image/galeria/projetos/img001_s.jpg">
					</a>
				</li>
				<li>
					<a href="image/galeria/projetos/img002.jpg" rel="group" title="Cond. Oasis Itapetininga-SP">
						<img src="image/galeria/projetos/img002_s.jpg">
					</a>
				</li>
				<li>
					<a href="image/galeria/projetos/img003.jpg" rel="group" title="Estudo Padaria Tatuí-SP">
						<img src="image/galeria/projetos/img003_s.jpg">
					</a>
				</li>
				<li>
					<a href="image/galeria/projetos/img004.jpg" rel="group" title="Jokey Club Campinas-SP">
						<img src="image/galeria/projetos/img004_s.jpg">
					</a>
				</li>
				<li>
					<a href="image/galeria/projetos/img005.jpg" rel="group" title="Jokey Club Campinas-SP">
						<img src="image/galeria/projetos/img005_s.jpg">
					</a>
				</li>
				<li>
					<a href="image/galeria/projetos/img006.jpg" rel="group" title="Residência em Tiête-SP">
						<img src="image/galeria/projetos/img006_s.jpg">
					</a>
				</li>
				<li>
					<a href="image/galeria/projetos/img007.jpg" rel="group" title="Residência Itu-SP">
						<img src="image/galeria/projetos/img007_s.jpg">
					</a>
				</li>
				<li>
					<a href="image/galeria/projetos/img008.jpg" rel="group" title="Residência Tatuí-SP">
						<img src="image/galeria/projetos/img008_s.jpg">
					</a>
				</li>
				<li>
					<a href="image/galeria/projetos/img009.jpg" rel="group" title="Residência Tatuí-SP">
						<img src="image/galeria/projetos/img009_s.jpg">
					</a>
				</li>
				<li>
					<a href="image/galeria/projetos/img010.jpg" rel="group" title="Residência Tatuí-SP">
						<img src="image/galeria/projetos/img010_s.jpg">
					</a>
				</li>
				<li>
					<a href="image/galeria/projetos/img011.jpg" rel="group" title="Residência Tatuí-SP">
						<img src="image/galeria/projetos/img011_s.jpg">
					</a>
				</li>
				<li>
					<a href="image/galeria/projetos/img012.jpg" rel="group" title="Residência Tatuí-SP">
						<img src="image/galeria/projetos/img012_s.jpg">
					</a>
				</li>				
			</ul>
			</div>
			</li>
		</ul>
	</div>
	';
	return $jQuery.$html;
}

function servicos()
{
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">Serviços</li>
		</ul>
		<ul id="escopo" style="padding:30px 0 30px 0">
			<li>Em Desenvolvimento...</li>
		</ul>
			</div>
			</li>
		</ul>
	</div>
	';
	return $jQuery.$html;
}

function parceiros()
{
	$desc_1 = "
	LevelHard - <br />
	Desenvolvimento de Softwares para Internet com Interface Intuitiva para Navegadores e Sites com as Tecnologias mais Recentes.
	";
	
	$desc_2 = "
	CEMAG - <br />
	Construções e Engenharia.
	";
	
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">Serviços</li>
		</ul>
		<ul id="escopo" style="padding:30px 0 30px 0;">
			<li>
			<a id="tooltipAct" href="http://site.levelhard.com" target="_blank" title="'.$desc_1.'">
				<img src="image/galeria/parceiros/levelhard.png" width="328">
			</a>
			</li>
			<li>
			<a id="tooltipAct" href="javascript:void(0);" target="_blank" title="'.$desc_2.'">
				<img src="image/galeria/parceiros/cemag.png" width="328">
			</a>
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
					<li style="width:100%; text-align:center; padding:15px;"><b>FCA - Projetos de Arquitetura e Engenharia LTDA</b></li>
				</ul>
				<ul>
					<li style="width:60px;">Endereço:</li>
					<li>Rua Juvenal de Campos</li>
				</ul>
				<ul>
					<li style="width:60px;">Número:</li>
					<li>316</li>
				</ul>
				<ul>
					<li style="width:60px;">Bairro:</li>
					<li>Centro</li>
				</ul>
				<ul>
					<li style="width:60px;">CEP:</li>
					<li>18270000</li>
				</ul>
				<ul>
					<li style="width:60px;">Cidade:</li>
					<li>Tatuí</li>
				</ul>
				<ul>
					<li style="width:60px;">Telefone:</li>
					<li>(15) 3305-5844</li>
				</ul>
				<ul>
					<li style="width:60px;">E-Mail:</li>
					<li><a href="mailto:contato@fazconarte.com.br">contato@fazconarte.com.br</a></li>
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
	$post_mail[1] = "contato@fazconarte.com.br";
	$post_mail[2] = $_POST["nome"];
	$post_mail[3] = $_POST["mail"];
	$post_mail[4] = "E-Mail FazConArte Site";
	
	$post_mail[5]  = "<p align=\"center\"><b>E-Mail FazConArte</b></p><br />";
	$post_mail[5] .= $_POST["texto"];
	
	$post_mail[6]  = "MIME-Version: 1.0\r\n";
	$post_mail[6] .= "Content-type: text/html; charset=utf-8\r\n";
	$post_mail[6] .= "From: ".$post_mail[2]." <".$post_mail[3].">\r\n";
	$post_mail[6] .= "Return-Path: ".$post_mail[3]."\r\n";
	
	$send_mail = @mail($post_mail[1],$post_mail[4],$post_mail[5],$post_mail[6]);
			
	if($send_mail) return 1;
	
}

?>