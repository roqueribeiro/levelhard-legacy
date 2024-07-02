<?php

	$tela = $_POST["tela"];
	
	switch($tela)
	{
		case "principal";
			print principal();
		break;
		case "sobre";
			print sobre(1);
		break;
		case "parceiros";
			print parceiros(1);
		break;
		case "portifolio";
			print portifolio(1);
		break;		
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
	<div id='fb-root'></div>
	<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = '//connect.facebook.net/en_US/all.js#xfbml=1';
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/home.png">Bem-Vindo(a) ao portal da Empresa IPETEC</li>
		</ul>
		<ul id="escopo">
			<li style="width:500px; padding:10px;">
			Bem Vindo ao portal da empresa IPETEC, fique a vontade para ver o andamento de nossos projetos ao lado, pelo pluigin que se atualiza conforme colocamos atualizações.
			</li>
			<li style="background:#F7F7F7; padding:5px;">
			<div class="fb-like-box" data-href="http://www.facebook.com/pages/Ipetec-Instituto-de-Pesquisa-e-Tecnologia/269271946438983" data-width="300" data-show-faces="true" data-border-color="#d8dfea" data-stream="true" data-header="false"></div>			
			</li>
		</ul>
		<ul id="minilogo">
			<li>Decisões Inteligentes</li>
		</ul>
	</div>
	';
	
	return $jQuery.$html;
}

function sobre($type)
{
	if($type == 1)
	{
		$tit = 'Sobre a IPETEC Decisões Inteligentes';
		$txt = '
		<p style="padding:15px 5px 30px 5px; text-align:center">A empresa IPETEC surgiu dentro da FATEC - Tatuí, com um grupo de estudos interdisciplinares.</p>
		<p style="padding:5px 5px 10px 5px;"><b>Como podemos ajudar?</b></p>
		<p>O foco de nossa empresa, é ajudar através de pesquisas a centrar mais fortemente a gestão de sua empresa no cliente, seja ele externo ou interno.</p>
		
		<p style="padding:10px 5px 10px 5px;"><b>Principais objetivos</b></p>
		<p>Entender e mensurar expectativas, necessidades e satisfação dos diversos tipos de clientes de uma organização: 
		clientes externos, clientes internos, consumidores, distribuidores, empregados, comunidade e outros públicos de interesse.
		Apresentar informações úteis e inteligentes capazes de apoiar a definição das ações de melhoria e inovação.
		Promover o realinhamento da cultura organizacional focando a gestão do negócio, dos processos e das pessoas no cliente.</p>
		
		<p style="padding:10px 5px 10px 5px;"><b>Serviços</b></p>
		<p style="padding:2px 10px 2px 5px;">› Pesquisa de Clima organizacional;</p>
		<p style="padding:2px 10px 2px 5px;">› Pesquisa 360°;</p>
		<p style="padding:2px 10px 2px 5px;">› Pesquisa de Satisfação do Cliente;</p>
		<p style="padding:2px 10px 2px 5px;">› Top of  Mind;</p>
		<p style="padding:2px 10px 2px 5px;">› Intenção de Votos;</p>
		<p style="padding:2px 10px 2px 5px;">› Extração de Perfis;</p>
		<p style="padding:2px 10px 2px 5px;">› Itinerante;</p>
		<p style="padding:2px 10px 2px 5px;">› Tabulação de dados existentes;</p>
		<p style="padding:2px 10px 2px 5px;">› Eleições diversas;</p>
		<p style="padding:2px 10px 2px 5px;">› Data Mining;</p>
		
		<p style="padding:15px 5px 30px 5px; text-align:center">Os projetos repercutiram de forma positiva na mídia da região e na mídia nacional, como visto nas reportagens abaixo:</p>
		
		<ul id="video">
			<li><a href="" style="display:block;width:540px;height:340px; z-index:1 !important;" id="player"></a></li>
		</ul>
		';
		$img = MontaImagem('ipetec');
	}	
	
	$jQuery = "
		
	<script>
		flowplayer('player', 'script/flowplayer/flowplayer-3.2.7.swf', {
			clip: {
				autoPlay: false,
				autoBuffering: true,
				scale: 'half'
			},
			canvas: {backgroundColor: 'transparent'},
			playlist: [ 'videos/video001-terminais.mp4', 'videos/video002-jn.mp4', 'videos/video003-superbem.mp4'],
			plugins: {
			   controls: {
				  playlist: true,
				  autoHide: 'never',
				  buttonColor: '#ffffff',
				  buttonOverColor: '#ffffff',
				  progressColor: '#112233',
				  bufferColor: '#445566',
				  timeColor: '#ffffff',
				  backgroundGradient: 'none',
				  durationColor: '#a3a3a3',
				  backgroundColor: 'transparent',
				  buttonOffColor: 'rgba(130,130,130,1)',
				  tooltipColor: '#000000',
				  timeBgColor: 'rgb(0, 0, 0, 0)',
				  progressGradient: 'none',
				  timeBorder: '0px solid rgba(0, 0, 0, 0.3)',
				  sliderGradient: 'none',
				  volumeColor: '#ffffff',
				  bufferGradient: 'none',
				  sliderBorder: '1px solid rgba(128, 128, 128, 0.7)',
				  sliderColor: '#000000',
				  timeSeparator: ' ',
				  borderRadius: '5',
				  volumeSliderColor: '#ffffff',
				  tooltipTextColor: '#ffffff',
				  volumeSliderGradient: 'none',
				  volumeBorder: '1px solid rgba(128, 128, 128, 0.7)',
				  height: 24,
				  opacity: 1.0
			   }
			}
		});
	</script>
	";
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
			<li>Decisões Inteligentes</li>
		</ul>
	</div>
	';
	return $jQuery.$html;
}

function parceiros($type)
{
	if($type == 1)
	{		
		$tit = 'Parceiros';
		$txt = '
		<ul id="parceiro">
			<a href="http://www.fatectatui.edu.br" target="_blank" title="<div>Faculdade de Tecnologia de Tatuí</div>"><li><img src="image/galeria/parceiros/logo-fatec.png" alt=""></li></a>
			<a href="http://www.levelhard.com" target="_blank" title="<div>Desenvolvimento de Sites e Outras Soluções para Internet e Publicidade.</div>"><li><img src="image/galeria/parceiros/logo-levelhard.png" alt=""></li></a>
		</ul>
		';
	}	
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">'.$tit.'</li>
		</ul>
		<ul id="escopo">
			<li style="width:100%; text-align:center;">
			'.$txt.'
			</li>
		</ul>
		<ul id="minilogo">
			<li>Decisões Inteligentes</li>
		</ul>
	</div>
	';
	return $jQuery.$html;
}


function portifolio($type)
{
	if($type == 1)
	{		
		$tit = 'IPETEC Decisões Inteligentes Portifólio';
		$txt = '<p>Para entender melhor o que a IPETEC oferece à você, um portifólio foi criado, que você pode visualizar nessa página.</p>';
	}	
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">'.$tit.'</li>
		</ul>
		<ul id="escopo">
			<li style="width:100%; text-align:center;">
			'.$txt.'
			</li>
		</ul>
		<ul id="minilogo">
			<li>Decisões Inteligentes</li>
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
					formValid('input[name=nome]','#FFEAEA',3);
					return false;
				}
				else if($('input[name=nome]').val().length < 3)
				{
					$('#formulario input, #formulario textarea').removeAttr('disabled');
					formValid('input[name=nome]','#FFEAEA',3);
					return false;
				}
				if(!$('input[name=email]').val())
				{
					$('#formulario input, #formulario textarea').removeAttr('disabled');
					formValid('input[name=email]','#FFEAEA',6);
					return false;
				}
				else if($('input[name=email]').val().length < 6)
				{
					$('#formulario input, #formulario textarea').removeAttr('disabled');
					formValid('input[name=email]','#FFEAEA',6);
					return false;
				}
				if(!$('textarea[name=texto]').val())
				{
					$('#formulario input, #formulario textarea').removeAttr('disabled');
					formValid('textarea[name=texto]','#FFEAEA',10);
					return false;
				}
				else if($('textarea[name=texto]').val().length < 10)
				{
					$('#formulario input, #formulario textarea').removeAttr('disabled');
					formValid('textarea[name=texto]','#FFEAEA',10);
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
					<li style="width:100%;" >IPETEC Decisões Inteligentes</li>
				</ul>
				<!--
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
				-->
				<ul>
					<li style="width:60px;">E-Mail:</li>
					<li><a href="mailto:contato@decisoesinteligentes.com.br">contato@decisoesinteligentes.com.br</a></li>
				</ul>
				</li>
			</ul>
			</div>
			</li>
		</ul>
		<ul id="minilogo">
			<li>Decisões Inteligentes</li>
		</ul>
	</div>	
	';
	return $jQuery.$html;
}

function email()
{
	$post_mail[1] = "contato@decisoesinteligentes.com.br";
	$post_mail[2] = $_POST["nome"];
	$post_mail[3] = $_POST["email"];
	$post_mail[4] = $_POST["telefone"];
	$post_mail[4] = "IPETEC Decisões Inteligentes Contato";
	
	$post_mail[5]  = "<p align=\"center\"><b>E-Mail IPETEC Decisões Inteligentes</b></p><br />";
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