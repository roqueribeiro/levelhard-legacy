<?php

	$tela = $_POST["tela"];
	
	switch($tela)
	{
		// ======= Tela Inicial ======= //
		case "principal";
			print principal();
		break;
		
		// ======= Decoração ======= //
		case "decoracao_vaso";
			print decoracao(1);
		break;
		case "decoracao_abajur";
			print decoracao(2);
		break;
		case "decoracao_almofada";
			print decoracao(3);
		break;
		case "decoracao_retrato";
			print decoracao(4);
		break;
		case "decoracao_outros";
			print decoracao(5);
		break;

		// ======= Presentes ======= //
		case "presentes_acessorios";
			print presentes(1);
		break;
		case "presentes_bebida";
			print presentes(2);
		break;
		case "presentes_utilidade";
			print presentes(3);
		break;
		// ======= Lista de Casamento ======= //
		case "casamento_1";
			print casamento(1);
		break;		
		// ======= Parceiros ======= //
		case "parceiros";
			print parceiros(1);
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
	$jQuery = "";
	$html = '
	<div id="conteudo" style="background:url(image/galeria/inicio/bg001.jpg) bottom center; background-size:100%;">
		<ul id="cabecalho">
			<li><img src="image/icones/home.png">Bem-Vindo(a) ao Espaço Lar Decorações e Presentes</li>
		</ul>
		<ul id="escopo" style="padding:30px 60px 60px 60px !important;">
			<li style="text-align:justify; font-size:16px;">
			<p>A Espaço Lar Decorações & Presentes, surgiu em 2011 com uma proposta diferenciada de comercio em Cerquilho, trabalhando com produtos finos e importados.São diversas opções de artigos de decoração, vasos, esculturas, almofadas, tudo para decorar o seu Lar e também utensílios domésticos, em inox (Brinox), faqueiros, aparelhos de jantar, pratos e xícaras em porcelana, cristais (Bohemia), aparelhos de fondue, porta-retrato e luminárias (abajur).</p>
			<br />
			<p>Produtos importados, enfim, tudo para presentear quem você gosta.</p>
			<br />
			<p>Aproveite para fazer sua lista de casamento (presentes), chá de cozinha e chá bar.</p>
			<br />
			<p>A Espaço Lar oferece também uma vasta diversidade em bebidas importadas vodkas, tequilas, licores, whisky, das melhores marcas.</p>
			<br />
			<p>Vale a pena conferir as novidades que não param de chegar.</p>
			<br /><br />
			</li>
		</ul>
		<ul id="minilogo">
			<li><img src="image/font.png"></li>
		</ul>
	</div>
	';
	
	return $jQuery.$html;
}

function decoracao($type)
{
	
	if($type == 1)
	{//Decoração Vaso	
		$tit = 'Decoração - Vasos Decorativos';
		$txt = '<p>Para todos os ambientes, peças exclusivas, importadas e nacional, feita de resina, cerâmica, cristal e etc.</p>';
		$img = MontaImagem('vasos');
	}
	if($type == 2)
	{//Decoração Abajur
		$tit = 'Decoração - Abajur';
		$txt = '<p>Para todos os ambientes, com padrão de qualidade trazendo a inovação como principal conceito.</p>';
		$img = MontaImagem('abajur');
	}
	if($type == 3)
	{//Decoração Almofadas
		$tit = 'Decoração - Almofadas';
		$txt = '<p>Vários tecidos com enchimento de silicone, com muita simplicidade e sofisticação.</p>';
		$img = MontaImagem('almofadas');
	}
	if($type == 4)
	{//Decoração Porta Retrato
		$tit = 'Decoração - Porta Retratos';
		$txt = '<p>Para lembrar de momentos incríveis com a família e amigos. Produtos com novos designs e acabamentos em vidro, madeira, aço escovado e etc.</p>';
		$img = MontaImagem('porta_retrato');
	}
	if($type == 5)
	{//Decoração Outros
		$tit = 'Decoração - Outros';
		$txt = '<p align="left">Produtos diferenciados, dedicado a ambientes únicos, onde cada peça ressalta uma forma diferente de se expressar. </p>';
		$img = MontaImagem('varios');
	}
	
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">'.$tit.'</li>
		</ul>
		<ul id="escopo">
			<li style="width:100%;">
			'.$txt.'
			</li>
		</ul>
		<ul>
			<li>
			<div id="galeria">
				<ul id="cabecalho">
					<li style="padding-left:0px !important;">Galeria de Imagens</li>
				</ul>
				<ul id="imagens">
				'.$img.'
				</ul>
			</div>
			</li>
		</ul>
		<ul id="minilogo">
			<li><img src="image/font.png"></li>
		</ul>
	</div>
	';
	return $jQuery.$html;
}

function presentes($type)
{
	
	if($type == 1)
	{//Presentes Bar Objetos
		$tit = 'Presentes - Bar Acessórios';
		$txt = 'Tudo que vc precisa para completar o seu bar em seu lar, abridor de vinho, baldes para gelo, decanter, suporte para garrafas e etc. Os mais variados produtos e marcas à sua disposição.';
		$img = MontaImagem('bar_acessorios_2');
	}
	if($type == 2)
	{//Presentes Bar Bebidas
		$tit = 'Presentes - Bar Bebidas';
		$txt = 'Bebidas importadas, nacionais, miniaturas para completar sua coleção e etc.';
		$img = MontaImagem('bebidas');
	}
	if($type == 3)
	{//Presentes Utilidades
		$tit = 'Presentes - Utilidades';
		$txt = 'Tudo em utilidades para facilitar o seu dia – dia e para presentear. Os mais variados produtos e marcas à sua disposição';
		$img = MontaImagem('utencilios');
	}	
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">'.$tit.'</li>
		</ul>
		<ul id="escopo">
			<li style="width:100%;">
			'.$txt.'
			</li>
		</ul>
		<ul>
			<li>
			<div id="galeria">
				<ul id="cabecalho">
					<li style="padding-left:0px !important;">Galeria de Imagens</li>
				</ul>
				<ul id="imagens">
				'.$img.'
				</ul>
			</div>
			</li>
		</ul>
		<ul id="minilogo">
			<li><img src="image/font.png"></li>
		</ul>
	</div>	
	';
	return $jQuery.$html;
}


function casamento($type)
{
	if($type == 1)
	{//Lista de Casamento
	
		chdir("lista/");
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
				$data = explode('-',$listar);
				$nome = explode('_',$listar);
				$arq_name = $data[0].'/'.$data[1].'/'.$data[2].'&nbsp;'.$nome[1].'&nbsp;&&nbsp;'.$nome[2];
				
				$lista_casamento .= '<p style="text-align:center;"><a href="core/lista/'.$listar.'" id="fancylist">'.$arq_name.'</a></p>';
			}
		}		
	
		$tit = 'Lista de Casamento';
		$txt = '
		<p align="left">A Espaço Lar Decorações e Presentes oferece uma grande diversidade de itens para sua lista de casamento, facilitando aos noivos e convidados na escolha dos presentes desejados!</p>
		<p>Teremos o enorme prazer de fazer parte dessa linda historia de AMOR!</p>
		<p style="margin-top:35px; text-align:center;"><b>Visualizar Lista de Casamento dos Noivos</b></p>
		'.$lista_casamento.'
		';
	}	
	
	$jQuery = "";
	$html = '
	<div id="conteudo" style="background:url(image/galeria/casamento/bg001.jpg) top center;">
		<ul id="cabecalho">
			<li><img src="image/icones/lista.png">'.$tit.'</li>
		</ul>
		<ul id="escopo">
			<li>
			'.$txt.'
			</li>
		</ul>
		<ul id="minilogo">
			<li><img src="image/font.png"></li>
		</ul>
	</div>	
	';
	return $jQuery.$html;
}
function parceiros($type)
{
	if($type == 1)
	{//Parceiros
		$tit = 'Parceiros';
		$txt = '
		<ul id="parceiro">
			<a href="javascript:void(0);" target="_blank" title="<div><ul><li>Telefone:</li><li>(15)7834-4030</li></ul><ul><li>Telefone:</li><li>(15)9731-4540</li></ul><ul><li>Email:</li><li>andressadalava@hotmail.com</li></ul></div>"><li><img src="image/parceiros/parceiro_1.png" alt=""></li></a>
			<a href="http://www.wix.com/sublimaxx/sublimaster" target="_blank" title="<div><ul><li>Site:</li><li>www.wix.com/sublimaxx/sublimaster</li></ul></div>"><li><img src="image/parceiros/parceiro_2.png" alt=""></li></a>
			<a href="http://www.fjsse.com.br" title="<div><ul><li>Site:</li><li>www.fjsse.com.br</li></ul></div>" target="_blank"><li><img src="image/parceiros/parceiro_3.png" alt=""></li></a>
			<a href="http://www.empactomv.com.br" target="_blank" title="<div><ul><li>Telefone:</li><li>(15)3384-1830</li></ul><ul><li>Site</li><li>www.empactomv.com.br</li></ul></div>"><li><img src="image/parceiros/parceiro_4.png" alt=""></li></a>
		</ul>
		';
	}
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/empresa.png">'.$tit.'</li>
		</ul>
		<ul id="escopo" style="text-align:center;>
			<li">
			'.$txt.'
			</li>
		</ul>
		<ul id="minilogo">
			<li><img src="image/font.png"></li>
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
			<li><img src="image/icones/email.png">Contato</li>
		</ul>
		<ul id="escopo">
			<li>
			<div id="formulario">
			<ul id="cabecalho" style="background:none !important">
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
					<li style="width:100%;" >Espaço Lar Decorações e Presentes</li>
				</ul>
				<ul>
					<li style="width:60px;">Endereço:</li>
					<li>Av. Presidente Woshignton Luiz, 47</li>
				</ul>
				<ul>
					<li style="width:60px;">CEP:</li>
					<li>18520-000</li>
				</ul>
				<ul>
					<li style="width:60px;">Cidade:</li>
					<li>Cerquilho - SP</li>
				</ul>
				<ul>
					<li style="width:60px;">Telefone:</li>
					<li>(15) 3384-4808</li>
				</ul>
				<ul>
					<li style="width:60px;">E-Mail:</li>
					<li>atendimento@espacolardecoracao.com.br</li>
				</ul>
				</li>
			</ul>
			</div>
			</li>
		</ul>
		<ul id="minilogo">
			<li><img src="image/font.png"></li>
		</ul>
	</div>	
	';
	return $jQuery.$html;
}

function email()
{
	$post_mail[1] = "atendimento@espacolardecoracao.com.br";
	$post_mail[2] = $_POST["nome"];
	$post_mail[3] = $_POST["email"];
	$post_mail[4] = $_POST["telefone"];
	$post_mail[5] = "E-Mail Espaço Lar Site";
	
	$post_mail[6]  = "<p align=\"center\"><b>E-Mail Espaço Lar</b></p><br />";
	$post_mail[6] .= "<p align=\"center\" style=\"font-size:10px;\">".$post_mail[2]." (".$post_mail[3].") ".$post_mail[4]."</p>";
	$post_mail[6] .= $_POST["texto"];
	
	$post_mail[7]  = "MIME-Version: 1.0\r\n";
	$post_mail[7] .= "Content-type: text/html; charset=utf-8\r\n";
	$post_mail[7] .= "From: ".$post_mail[2]." <".$post_mail[3].">\r\n";
	$post_mail[7] .= "Return-Path: ".$post_mail[3]."\r\n";
	
	$send_mail = @mail($post_mail[1],$post_mail[5],$post_mail[6],$post_mail[7]);
			
	if($send_mail) return 1;
	
}

?>