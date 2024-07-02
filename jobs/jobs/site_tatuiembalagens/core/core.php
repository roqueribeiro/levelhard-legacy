<?php

	$tela = $_POST["tela"];
	
	switch($tela)
	{
		// ======= Tela Inicial ======= //
		case "principal";
			print principal();
		break;
		case "loja1";
			print loja1();
		break;
		case "loja2";
			print loja2();
		break;
		case "industria";
			print industria();
		break;
		case "sacos";
			print sacos();
		break;
		case "embalagens";
			print embalagens();
		break;
		case "limpeza";
			print limpeza();
		break;
		case "acessorios";
			print acessorios();
		break;
		case "parceiros";
			print parceiros();
		break;
		case "imprensa";
			print imprensa();
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
	$img = MontaImagem('Home');
	$jQuery = "";
	$html = '
	<div id="container">
	
		<div class="slider-wrapper theme-default">
			<div id="slider" class="nivoSlider">
				<a href="javascript:ajaxContextLoad(\'sacos\');"><img src="image/Banner-Home01.jpg" alt="" title="Sacos para batatas" /></a>
				<a href="javascript:ajaxContextLoad(\'sacos\');"><img src="image/Banner-Home02.jpg" alt="" title="Fitilho para a produção de tomates" /></a>
				<a href="javascript:ajaxContextLoad(\'sacos\');"><img src="image/Banner-Home03.jpg" alt="" title="Big Bag" /></a>
				<a href="javascript:ajaxContextLoad(\'sacos\');"><img src="image/Banner-Home04.jpg" alt="" title="Sacos para milho" /></a>
			</div>
		</div>
		
		<div id="container-princ">
		
			<div style="width:470px; margin:5px 0 5px 0; padding:0; background:#FFF; box-shadow:0 1px 1px rgba(0,0,0,0.1)">
				<ul id="cabecalho" style="width:455px; background:#232495; color:#FFF;">
					<li><img src="image/icones/home.png">Notícias</li>
				</ul>
				<ul id="escopo" style="width:455px; padding:0 20px 10px 10px;">
					› A Embalagens Tatuí se associa e filia com a Assossiação Brasileira de Batata (ABBA).
				</ul>
			</div>
			
			<div style="width:295px; margin:5px 5px 5px 0px; vertical-align:top; padding:5px; background: #FFF; box-shadow:0 1px 1px rgba(0,0,0,0.1)">
				<p><object width="295" height="200"><param name="movie" value="http://www.youtube.com/v/y82IaOk2_EY?version=3&amp;hl=pt_BR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/y82IaOk2_EY?version=3&amp;hl=pt_BR" type="application/x-shockwave-flash" width="295" height="200" allowscriptaccess="always" allowfullscreen="true"></embed></object></p>
				<p style="padding:15px 10px 10px 10px; text-align:justify">Assista aos vídeos da nossa empresa e conheça um pouco sobre a nossa história</p>
			</div>
			
		</div>
			
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
	return $html.$jQuery;
}

function loja1()
{
	$img = MontaImagem('Loja01');
	$jQuery = "";
	$html = '
	<div id="container">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">EMBALAGENS TATUÍ - <b>SACARIA & CIA.</b></li>
		</ul>
		<ul id="escopo">
			<li>
				<p align="left" style="margin-bottom: 5px;">A empresa iniciou suas atividades em março de 1990 com o 
				propósito de comercializar sacos de juta para batatas, atendendo somente a região do 
				sudoeste paulista.</p>
				<p align="left" style="margin-bottom: 5px;">Com o passar do tempo percebemos que se tratava de um 
				produto que teria espaço muito aceitável no mercado, e na 2ª década começamos com várias opções 
				de produtos e sintéticos como ráfia, nylon, barbantes, chicotes, big bag, linhas, etc... </p>
				<p align="left" style="margin-bottom: 5px;">Avançamos para o Centro Oeste no Nordeste e 
				atendemos praticamente em todo o território nacional, com uma infinidade de produtos.</p>
				<p align="left" style="margin-bottom: 5px;">Os sacos são fornecidos até hoje pela companhia 
				têxtil de Castanhal-PA, oferecendo um produto 100% biodegradável, dando uma proteção especial 
				para as batatas. </p>
				<p align="left" style="margin-bottom: 5px;">Nossos produtos são produzidos com a maciez de 
				fibras especiais, que não causam danos ao meio ambiente, suportando regiões muito quentes e 
				viagens de longa distância.</p>
				<p align="left" style="margin-bottom: 5px;">Quando o assunto é batata contribuímos a parceria 
				com os bataticultores, pois a embalagem é praticamente a finalização do ciclo de todo o seu 
				trabalho e nós temos o papel de representar o produto da melhor forma, evidenciando o destaque 
				das batatas.</p>
				<p align="left" style="margin-bottom: 5px;">O nosso lema é se preocupar com a qualidade e não com 
				a quantidade, pois tudo é resultado de um bom trabalho, grandes parcerias, flexibilidade, honestidade 				e responsabilidade.</p>
			</li>
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

function loja2()
{
	$img = MontaImagem('Loja02');
	$jQuery = "";
	$html = '
	<div id="container">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">EMBALAGENS TATUÍ - <b>DESCARTÁVEIS</b></li>
		</ul>
		<ul id="escopo">
			<li>
				<p align="left" style="margin-bottom: 5px;">A embalagens descartáveis Tatuí, começou em 2005, 
				quando ainda vendíamos somente sacos para batatas q cereais e barbantes, com a loja aberta 
				ao publico, sempre apareciam clientes procurando por copos descartáveis, assim para atendermos 
				os clientes e aproveitarmos o espaço que tínhamos na loja, colocamos copos descartáveis em 
				nossa linha de produtos, mas os clientes começaram a pedir outros produtos sacolas, pratos 
				para marmitex, etc e nos fomos introduzindo em nossa linha de produtos.</p>
				<p align="left" style="margin-bottom: 5px;">Quando nos demos conta a linha de produtos 
				descartáveis já tinha tomado conta de toda nossa loja e deposito, foi ai que decidimos que 
				as embalagens descartáveis tinha que ter seu espaço próprio e em 2007 inauguramos  uma loja 
				com uma área   construída de 300 m², com gondolas de supermercado  conseguimos expor melhor 
				nossos produtos, hoje temos  em nossa linha de produtos mais de 3.000 itens, contamos também com 
				um amplo deposito, equipe de vendedores  externos, veículos para entregas com essa estrutura 
				e colaboradores motivados, trabalhando com transparência e  honestidade conquistamos a confiança 
				de nossos clientes e hoje atendemos industrias, padarias, restaurantes, açougues, lanchonetes 
				etc. de Tatuí e região. Crescemos mas não perdemos o objetivo do início: atender bem nossos clientes.
			</li>
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

function industria()
{
	$img = MontaImagem('Industria');
	$jQuery = "";
	$html = '
	<div id="container">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">Indústria</li>
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

function sacos()
{
	$img = MontaImagem('Sacos');
	$jQuery = "";
	$html = '
	<div id="container">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">Produtos/Sacos</b></li>
		</ul>
		<ul id="escopo">
			<li>
				<p align="left"><b>SACOS PARA BATATA</b></p>
				<p align="left">10Kg - 25Kg - 30Kg - 50Kg - 60Kg</p>
				<p align="left">Juta</p>
				<p align="left">Nylon</p>
				<p align="left">G.I.</p>
				<p align="left" style="margin-top: 15px;">----------------------------------------------</p>
				<p align="left" style="margin-top: 15px;"><b>SACOS DE RACHEL</b></p>
				<p align="left">Milho Verde</p>
				<p align="left">Repolho</p>
				<p align="left">Cambotiã</p>
				<p align="left">Laranja</p>
				<p align="left">Limão</p>
				<p align="left" style="margin-top: 15px;">----------------------------------------------</p>
				<p align="left"><b>BIG BAG</b></p>
				<p align="left">Liso 100% Gardelon</p>
				<p align="left">Misto Gardelon</p>
				<p align="left" style="margin-top: 15px;">----------------------------------------------</p>
				<p align="left"><b>EMBALAGENS CHAPADA</b></p>
				<p align="left">Milho Verde</p>
				<p align="left">Repolho</p>
				<p align="left">Cambotiã</p>
				<p align="left">Laranja</p>
				<p align="left">Limão</p>
				<p align="left" style="margin-top: 15px;">----------------------------------------------</p>
				<p align="left" style="margin-bottom: 15px;"><b>SELOS</b></p>
				<p align="left"> <img src="image/Produto-Biodegradavel-01_s.png" /> 
					<img src="image/Produtos-ecologicamente-corretos-01_s.png" /></p>
			</li>
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

function embalagens()
{
	$img = MontaImagem('Embalagens');
	$jQuery = "";
	$html = '
	<div id="container">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">Produtos/Embalagens</b></li>
		</ul>
		<ul id="escopo" style="text-align: left;">
			<li>
				<p align="left">› Caixa de Pizza</p>
				<p align="left">› Bexiga</p>
				<p align="left">› Celofane</p>
				<p align="left">› Cooler isopor</p>
				<p align="left">› Copos de acrílico</p>
				<p align="left">› Copos plásticos</p>
				<p align="left">› Embalagens de alumínio</p>
				<p align="left">› Embalagens de isopor</p>
				<p align="left">› Filme PVC</p>
				<p align="left">› Palitos</p>
				<p align="left">› Papel alumínio</p>
				<p align="left">› Pratos de alumínio</p>
				<p align="left">› Pratos de aniversário</p>
				<p align="left">› Talheres de plástico</p>			
			</li>
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

function limpeza()
{
	$img = MontaImagem('Limpeza');
	$jQuery = "";
	$html = '
	<div id="container">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">Produtos/Limpeza</b></li>
		</ul>
		<ul id="escopo">
			<li>
				<p align="left">› Baldes</p>
				<p align="left">› Detergentes</p>
				<p align="left">› Lixeiras</p>
				<p align="left">› Pá</p>
				<p align="left">› Papel higiênico</p>
				<p align="left">› Produtos de limpeza</p>
				<p align="left">› Refil para saboneteira</p>
				<p align="left">› Rodos</p>
				<p align="left">› Sabonete Líquido</p>
				<p align="left">› Saboneteira</p>
				<p align="left">› Sacos de lixos</p>
				<p align="left">› Vassouras</p>
			</li>
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

function acessorios()
{
	$img = MontaImagem('Acessorios');
	$jQuery = "";
	$html = '
	<div id="container">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">Produtos/Acessórios</b></li>
		</ul>
		<ul id="escopo">
			<li>
				<p align="left">› Balaio de Pneu (Colheita no campo)</p>
				<p align="left">› Barbantes para costura</p>
				<p align="left">› Chicotes em roca para tomates</p>
				<p align="left">› Fitilho ouro</p>
				<p align="left">› Linha para costuras (100% Poliester)</p>
				<p align="left">› Máquina manual para costuras</p>
			</li>
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

function parceiros()
{
	$desc_1 = "
	Companhia Têxtil de Castanhal
	";
	
	$desc_2 = "
	SOL Pack - Telas, Lonas e Sacaria Agrícola.
	";
	
	$desc_3 = "
	UNIÃO BAG -	Big Bags e Sacarias.
	";
		
	$desc_4 = "
	IPANEMA - Ipanema Têxtil.
	";
	
	
	$jQuery = "";
	$html = '
	<div id="container">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">Parceiros</li>
		</ul>
		<ul id="escopo" style=" text-align: center;">
			<li>
			<a href="http://www.castanhal.com.br/" target="_blank" title="'.$desc_1.'" style="margin-left: 30px; box-shadow: 0 1px 4px rgba(0,0,0,0.2);">
				<img src="image/parceiros/Castanhal.jpg" width="105" height="75">
			</a>
			</li>
			<li>
			<a href="http://www.solpack.com.br" target="_blank" title="'.$desc_2.'" style="margin-left: 30px; box-shadow: 0 1px 4px rgba(0,0,0,0.2);">
				<img src="image/parceiros/Sol.png" width="105" height="75">
			</a>
			</li>
			<li>
			<a href="http://www.uniaobag.com.br" target="_blank" title="'.$desc_3.'" style="margin-left: 30px; box-shadow: 0 1px 4px rgba(0,0,0,0.2);">
				<img src="image/parceiros/Uniao.png" width="105" height="75">
			</a>
			</li>
		</ul>
	</div>
	';
	return $jQuery.$html;
}

function imprensa()
{
	$img = MontaImagem('Imprensa');
	$jQuery = "";
	$html = '
	<div id="container">
		<ul id="cabecalho">
			<li><img src="image/icones/galeria.png">Imprensa</li>
		</ul>
	</div>
	';
	return $jQuery.$html;
}

function contato()
{
	$jQuery = "";
	$html = '
	<div id="container">
		<ul id="cabecalho">
			<li><img src="image/icones/contato.png">Contato</li>
		</ul>
		<ul id="escopo">
			<li>
			<div id="contato">
				<ul>
					<li>
					<ul>
						<li><b>Embalagens Tatuí - Sacaria & Companhia</b></li>
					</ul>
					<ul>
						<li style="width:100px;">Endereço:</li>
						<li>Rua 15 de Novembro</li>
					</ul>
					<ul>
						<li style="width:100px;">Número:</li>
						<li>2135</li>
					</ul>
					<ul>
						<li style="width:100px;">Cidade:</li>
						<li>Tatuí</li>
					</ul>
					<ul>
						<li style="width:100px;">Estado:</li>
						<li>São Paulo</li>
					</ul>
					<ul>
						<li style="width:100px;">Telefone:</li>
						<li>(15) 3251-2183</li>
					</ul>
					<ul>
						<li style="width:100px;">E-Mail:</li>
						<li><a href="mailto:sacosparabatata@uol.com.br">sacosparabatata@uol.com.br</a></li>
					</ul>
					</li>
				</ul>
				<ul >
					<li>
					<ul>
						<li><b>Embalagens Tatuí - Descartáveis</b></li>
					</ul>
					<ul>
						<li style="width:100px;">Endereço:</li>
						<li>Rua 15 de Novembro</li>
					</ul>
					<ul>
						<li style="width:100px;">Número:</li>
						<li>2007</li>
					</ul>
					<ul>
						<li style="width:100px;">Cidade:</li>
						<li>Tatuí</li>
					</ul>
					<ul>
						<li style="width:100px;">Estado:</li>
						<li>São Paulo</li>
					</ul>
					<ul>
						<li style="width:100px;">Telefone:</li>
						<li>(15) 3305-6171</li>
					</ul>
					<ul>
						<li style="width:100px;">E-Mail:</li>
						<li><a href="mailto:embalagenstatui@uol.com.br">embalagenstatui@uol.com.br</a></li>
					</ul>
					</li>
				</ul>
				<ul>
					<li>
					<ul>
						<li><b>Embalagens Chapada (Sacaria & CIA.)</b></li>
					</ul>
					<ul>
						<li style="width:100px;">Endereço:</li>
						<li>Rod. BR 142</li>
					</ul>
					<ul>
						<li style="width:100px;">Altura:</li>
						<li>Km 03</li>
					</ul>
					<ul>
						<li style="width:100px;">Cidade:</li>
						<li>Ibicoara</li>
					</ul>
					<ul>
						<li style="width:100px;">Estado:</li>
						<li>Bahia</li>
					</ul>
					<ul>
						<li style="width:100px;">Telefone:</li>
						<li>(77) 3413-5442</li>
					</ul>
					<ul>
						<li style="width:100px;">E-Mail:</li>
						<li><a href="mailto:embalagenschapada@yahoo.com.br">embalagenschapada@yahoo.com.br</a></li>
					</ul>
					</li>
				</ul>
			</div>
			</li>
		</ul>
	</div>	
	';
	return $html;
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
