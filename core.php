<?php

	$action = $_GET["action"];
	
	switch($action)
	{
		case "portifolio-site":
			print tela_portsite();
		break;
		case "portifolio-soft":
			print tela_portsoft();
		break;
		case "tela_quemsomos":
			print tela_quemsomos();
		break;
		case "mail_send":
			print mail_send();
		break;
	}

function tela_portsite()
{
	$html = '
	<div id="port-all" class="filters demo3">
		<div class="filters">
			<div class="filter">
				<div class="title">Filtrar Modelos de Sites por:</div>
				<a href="javascript:void();" rel="basico">Básico</a>
				<a href="javascript:void();" rel="medio">Médio</a>
				<a href="javascript:void();" rel="avancado">Avançado</a>
				<a href="javascript:void();" rel="ecommerce">E-Commerce</a>
				<a href="javascript:void();" rel="all">Todos</a>
			</div>
			<div class="container">
				<ul>
					<li class="basico">
						<img src="images/portfolio/site/img-espacolar.jpg" alt="" />
						<div>
							<h3>Espaço Lar</h3>
							<p>Site Modelo Básico, sem Banco de Dados e Sem Painel de Atualização.</p>
							<a href="javascript:void();" id="http://jobs.levelhard.com.br/jobs/site_espacolar/">Descontinuado</a>
						</div>
					</li>
					<li class="basico">
						<img src="images/portfolio/site/img-fazconarte.jpg" alt="" />
						<div>
							<h3>FazConArte</h3>
							<p>Site Modelo Básico, sem Banco de Dados e Sem Painel de Atualização.</p>
							<a href="javascript:void();" id="http://jobs.levelhard.com.br/jobs/site_fazconarte/">Descontinuado</a>
						</div>
					</li>
					<li class="avancado">
						<img src="images/portfolio/site/img-imprimil.jpg" alt="" />
						<div>
							<h3>Pensou? ImpriMil!</h3>
							<p>Site que Trabalha Bastante com a UI, Atendendo o Usuário de uma Forma Rápida e Limpa.</p>
							<a href="javascript:void();" id="http://www.imprimil.com">www.imprimil.com.br</a>
						</div>
					</li>
					<li class="avancado">
						<img src="images/portfolio/site/img-imprimil-slide.jpg" alt="" />
						<div>
							<h3>Slide ImpriMil</h3>
							<p>Site que Trabalha Bastante com a UI, Atendendo o Usuário de uma Forma Rápida e Limpa.</p>
							<a href="javascript:void();" id="http://jobs.levelhard.com.br/jobs/site_imprimil-slide/">Demonstração</a>
						</div>
					</li>
					<li class="basico">
						<img src="images/portfolio/site/img-lenhaecomartins.jpg" alt="" />
						<div>
							<h3>Lenha Eco Martins</h3>
							<p>Site Modelo Básico, sem Banco de Dados e Sem Painel de Atualização.</p>
							<a href="javascript:void();" id="http://jobs.levelhard.com.br/jobs/site_lenhaecologicamartins/">www.lenhaecologicamartins.com.br</a>
						</div>
					</li>
					<li class="medio">
						<img src="images/portfolio/site/img-meta.jpg" alt="" />
						<div>
							<h3>META</h3>
							<p>Site Trabalhado em Conjunto ao Cliente sobre a Plataforma Básica.</p>
							<a href="javascript:void();" id="http://jobs.levelhard.com.br/jobs/site_meta/">Não Publicado</a>
						</div>
					</li>
					<li class="avancado">
						<img src="images/portfolio/site/img-rodapiao.jpg" alt="" />
						<div>
							<h3>Roda Pião</h3>
							<p>Site Protótipo que não foi ao Ar, Usa Tecnologia de Ponta como HTML5, CSS3 e jQuery.</p>
							<a href="javascript:void();" id="http://jobs.levelhard.com.br/jobs/site_estudiorodapiao/">Não Publicado</a>
						</div>
					</li>
					<li class="avancado">
						<img src="images/portfolio/site/img-sapatosecia.jpg" alt="" />
						<div>
							<h3>Sapatos & Cia</h3>
							<p>Site que Trabalha Bastante com a UI, Atendendo o Usuário de uma Forma Rápida e Limpa.</p>
							<a href="javascript:void();" id="http://www.sapatosecia.com.br">www.sapatosecia.com.br</a>
						</div>
					</li>
					<li class="medio">
						<img src="images/portfolio/site/img-superpao.jpg" alt="" />
						<div>
							<h3>Super Pão</h3>
							<p>Site Trabalhado em Conjunto ao Cliente sobre a Plataforma Básica.</p>
							<a href="javascript:void();" id="http://jobs.levelhard.com.br/jobs/site_panificadorasuperpao/">Descontinuado</a>
						</div>
					</li>
					<li class="basico">
						<img src="images/portfolio/site/img-tatuiembalagens.jpg" alt="" />
						<div>
							<h3>Embalagens Tatuí</h3>
							<p>Site Modelo Básico, sem Banco de Dados e Sem Painel de Atualização.</p>
							<a href="javascript:void();" id="http://www.embalagenstatui.com.br">www.embalagenstatui.com.br</a>
						</div>
					</li>
					<li class="basico">
						<img src="images/portfolio/site/img-vipax.jpg" alt="" />
						<div>
							<h3>Vipax</h3>
							<p>Site Modelo Básico, sem Banco de Dados e Sem Painel de Atualização. "Alterações Feitas Pelo Usuário"</p>
							<a href="javascript:void();" id="http://jobs.levelhard.com.br/jobs/site_vipax/">www.vipax.com.br</a>
						</div>
					</li>
					<li class="avancado">
						<img src="images/portfolio/site/img-votofix.jpg" alt="" />
						<div>
							<h3>VotoFix</h3>
							<p>Site Avançado com Tecnologias HTML5, CSS3 e jQuery sem Banco de Dados MySQL.</p>
							<a href="javascript:void();" id="http://jobs.levelhard.com.br/jobs/site_votofix/">www.votofix.com.br</a>
						</div>
					</li>
					<li class="basico">
						<img src="images/portfolio/site/img-warfire.jpg" alt="" />
						<div>
							<h3>Banda WarFire</h3>
							<p>Site Modelo Básico, sem Banco de Dados e Sem Painel de Atualização.</p>
							<a href="javascript:void();" id="http://jobs.levelhard.com.br/jobs/site_warfire/">www.warfire.com.br</a>
						</div>
					</li>
					<li class="ecommerce">
						<img src="images/portfolio/site/img-zalk.jpg" alt="" />
						<div>
							<h3>Zalk Marcenaria</h3>
							<p>e-Commerce Avançado usando uma Plataforma OpenSource.</p>
							<a href="javascript:void();" id="http://www.zalkmarcenaria.com.br">www.zalkmarcenaria.com.br</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	';
	
	return $html;
	
}

function tela_portsoft()
{
	$html = '
	<div id="port-all" class="filters demo3">
		<div class="filters">
			<div class="filter">
				<div class="title">Filtrar Modelos de Softwares por:</div>
				<a href="javascript:void();" rel="estudo">Estudo</a>
				<a href="javascript:void();" rel="producao">Produção</a>
				<a href="javascript:void();" rel="all">Todos</a>
			</div>
			<div class="container">
				<ul>
					<li class="producao">
						<img src="images/portfolio/soft/img-agenda.jpg" alt="" />
						<div>
							<h3>WebAgenda v1.8</h3>
							<p>Agenda Telefônica.</p>
							<a href="javascript:void();" id="http://webdesk.levelhard.com.br">webdesk.levelhard.com.br</a>
						</div>
					</li>
					<li class="estudo">
						<img src="images/portfolio/soft/img-barata.jpg" alt="" />
						<div>
							<h3>jBarata</h3>
							<p>Jogo Simples em jQuery, CSS3 e HTML5.</p>
							<a href="javascript:void();" id="http://webdesk.levelhard.com.br">webdesk.levelhard.com.br</a>
						</div>
					</li>
					<li class="producao">
						<img src="images/portfolio/soft/img-chat.jpg" alt="" />
						<div>
							<h3>Chat v1.5</h3>
							<p>Sistema de Chat Simples Criado de Acordo com a Necessidade do Cliente.</p>
							<a href="javascript:void();" id="http://webdesk.levelhard.com.br">webdesk.levelhard.com.br</a>
						</div>
					</li>
					<li class="producao">
						<img src="images/portfolio/soft/img-odonto.jpg" alt="" />
						<div>
							<h3>Odontograma</h3>
							<p>Software para Dentistas</p>
							<a href="javascript:void();" id="http://jobs.levelhard.com.br/jobs/sw_webdesk_v0/conteudo/odontograma/">webdesk.levelhard.com.br</a>
						</div>
					</li>
					<li class="estudo">
						<img src="images/portfolio/soft/img-upload.jpg" alt="" />
						<div>
							<h3>jUpLoad v1.5</h3>
							<p>Sistema de upload para envio multiplo de arquivos.</p>
							<a href="javascript:void();" id="http://webdesk.levelhard.com.br">webdesk.levelhard.com.br</a>
						</div>
					</li>
					<li class="producao">
						<img src="images/portfolio/soft/img-webclin.jpg" alt="" />
						<div>
							<h3>WebClin v3</h3>
							<p>Sistema para Administração de Consultórios Médicos.</p>
							<a href="javascript:void();" id="https://webclin.iwantproject.com.br">WebClin</a>
						</div>
					</li>
					<li class="estudo">
						<img src="images/portfolio/soft/img-webdesk.jpg" alt="" />
						<div>
							<h3>WebDesk v2</h3>
							<p>Sistema em jQuery, CSS3 e HTML5 que simula um ambiente Desktop.</p>
							<a href="javascript:void();" id="http://webdesk.levelhard.com.br">webdesk.levelhard.com.br</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	';

	return $html;
	
}

function tela_quemsomos()
{
	$jquery = "
	$(document).ready(function(){
		$('#qs-galeria img').click(function(){
			img = $(this).attr('id');
			$('#qs-container, #qs-galeria').fadeOut(600);
			$('#qs-galeria-full').delay(600).fadeOut(600,function(){
				$(this).css({'background':'url(images/fotos/'+img+'.jpg) center no-repeat'}).fadeIn(600);
			});
		});
		$('#qs-galeria-full').click(function(){
			$(this).fadeOut(600,function(){
				$(this).css({'background':'none'});
			});
			$('#qs-container, #qs-galeria').delay(600).fadeIn(600);
		});
		$('#qs-texto').mCustomScrollbar({
			scrollInertia	:1000,
			scrollEasing	:'easeOutQuint',
			scrollButtons	:{
				enable		:true
			},
			advanced		:{
				updateOnContentResize:true
			},
		});						
	});
	";
	$html = '
	<script type="text/javascript">'.$jquery.'</script>
	<div id="quemsomos">
		<div id="qs-galeria-full"></div>
		<div id="qs-container">
			<div id="qs-conteudo">
				<div id="qs-cabecalho">
					<p>A Equipe LevelHard</p>
				</div>
				<div id="qs-texto">
					<div id="qs-tabulacao">
					<p style="font-weight:bold;">LevelHard - WebSolution</p>
					<br />
					<p>Nascida da idéia de desenvolver portais Web na cidade de Tatuí-SP, a LevelHard atua no mercado desde 2010, oferecendo aos seus clientes ferramentas visuais para a publicidade e propaganda de suas empresas.</p> 
					<p>Atuando também na área de desenvolvimento de Softwares Web, construímos softwares de qualidade para as mais variadas necessidades que nossos clientes possuem.</p>
					<p>No ano de 2012, com a parceria entre a LevelHard e a empresa IPETEC, houve uma fusão entre as duas empresas, tornando assim, a gama de serviços que oferecemos mais extensa com a mesma qualidade que nossos clientes já conhecem.</p>
					<br />
					<p style="font-weight:bold;">Os Serviços que oferecemos:</p>
					<br />
					<p>› Desenvolvimento de Portais Web (Sites);</p>
					<p>› Desenvolvimento de Software Web, Desktop e Server-Client;</p>
					<p>› Desenvolvimento de Aplicativos de Plataforma Android®;</p>
					<p>› Implantação de Infraestrutura de Rede utilizando servidores Linux;</p>
					<p>› Pesquisas de Clima Organizacional;</p>
					<p>› Pesquisas de Satisfação do Cliente;</p>
					<p>› Top of Mind;</p>
					<p>› Pesquisas de Intenção de Votos;</p>
					<p>› Extração de Perfis;</p>
					<p>› Eleições diversas.</p>
					<br />
					<p style="font-weight:bold;">Alguns de nossos Clientes:</p>
					<br />
					<p>› Prefeitura Municipal de Tatuí;</p>
					<p>› Fatec-Tatuí;</p>
					<p>› Colégio Objetivo de Tatuí;</p>
					<p>› Secretaria de Educação de Cerquilho;</p>
					<p>› Alfa Castello;</p>
					<p>› Espaço Lar;</p>
					<p>› Imprimil;</p>
					<p>› Kumatech;</p>
					<p>› Sapatos e Cia.</p>
					</div>
				</div>
			</div>
		</div>
		<div id="qs-galeria">
			<img id="levelhard_web000" src="images/fotos/levelhard_web000_s.jpg" alt="">
			<img id="levelhard_web001" src="images/fotos/levelhard_web001_s.jpg" alt="">
			<img id="levelhard_web002" src="images/fotos/levelhard_web002_s.jpg" alt="">
		</div>
	</div>	
	';
	
	return $html;
}

function mail_send()
{
	// ============= Direcionamento =============
	$mail_endereco	= "roque.ribeiro@levelhard.com.br";
	$mail_descricao	= "E-Mail de Contato pelo LevelHard";
	// ============= Dados do Formulario =============
	$mail_nome 		= $_GET["nome"];
	$mail_telefone 	= $_GET["telefone"];
	$mail_email 	= $_GET["email"];
	$mail_rede 		= $_GET["rede"];
	$mail_assunto 	= $_GET["assunto"];
	$mail_texto 	= $_GET["texto"];
	// ============= Header =============
	$mail_html  	= "MIME-Version: 1.0\r\n";
	$mail_html     .= "Content-type: text/html; charset=utf-8\r\n";
	$mail_html     .= "From: ".$mail_nome." <".$mail_email.">\r\n";
	$mail_html     .= "Return-Path: ".$mail_email."\r\n";
	// ============= Monta E-Mail =============
	$mail_content  	= "<p align=\"center\"><b>".$mail_descricao."</b></p><br /><br />";
	$mail_content  .= "<p align=\"center\"><b>Nome:</b> ".$mail_nome." <b>Telefone:</b> ".$mail_telefone."</p><br />";
	$mail_content  .= $mail_texto;
	// ============= Envia E-Mail =============
	$send_mail 		= @mail($mail_endereco,$mail_assunto,$mail_content,$mail_html);
	
	return $send_mail;
}
