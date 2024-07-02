<?php

	$tela = $_POST["tela"];
	
	switch($tela)
	{
		case "principal";
			print principal();
		break;
		case "empresa";
			print empresa(1);
		break;
		case "testes";
			print testes(1);
		break;
		case "durabilidade";
			print durabilidade(1);
		break;
		case "clientes";
			print prototipo(1);
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
			<a href="image/galeria/'.$img_dir.'/'.$img_min[0].'.'.$img_ext[1].'" rel="group" title="META Métodos em Testes Automotivos Ltda">
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
			pauseTime: 8000,	
		});
	});
	</script>
	";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/Home24.png">Meta - Métodos em Testes Automotivos</li>
			<div id="social">
            <ul>
				<li><a href="#"><img src="image/icones/social/youtube.png" alt=""></a></li>
                <li><a href="#"><img src="image/icones/social/twitter.png" alt=""></a></li>
                <li><a href="#"><img src="image/icones/social/facebook.png" alt=""></a></li>
            </ul>
			</div>
		</ul>
		<ul id="escopo">
			<div class="slider-wrapper theme-levelhard">
				<div class="ribbon"></div>
				<div id="slider" class="nivoSlider">
					<img src="image/galeria/home/imagem.jpg" alt="" title="" />
					<img src="image/galeria/home/imagem2.jpg" alt="" title="" class="" />
					<img src="image/galeria/home/imagem3.jpg" alt="" title="" class="" />
				</div>
			</div>
			<li>
			</li>
		</ul>
	</div>
	';
	return $html.$jQuery;
}

function empresa($type)
{
	
	if($type == 1)
	{
		$txt = '
		<p id="txt-cab"><b>Infraestrutura da Meta</b></p>
		<p>A Meta é uma empresa sediada no município de Tatuí, a 140 km de São Paulo, contando hoje com sede
		própria em área de 2000 m², totalmente fechado e isolado nas suas divisas com ruas e rodovias.</p>
		<p>Atualmente contamos com aproximadamente 45 colaboradores, todos registrados em carteira com
		regime CLT.</p>
		<p>Nesta sede estão localizados, escritórios, oficinas, área para treinamento e palestras, sala de reunião,
		banheiros, 1400 m² de área construída.</p>
		<p>As Oficinas estão instaladas dentro de um galpão fechado perto de 600 m² de área construída em
		alvenaria, com piso em concreto de malha dupla, valeta de inspeção e Box privativo. Estrutura metálica e
		cobertura em telhas de chapa galvanizadas com isolamento termo- acústico.</p>
		<p>Parte da área da oficina está disponível aos testes estáticos.</p>
		<p>Como equipamento, temos:</p>
		<p>Quadro completo de ferramentas, elevadores, linhas de ar comprimido, linha elétrica distribuídas pela
		área, calibradores de pneu, bancadas, furadeiras de bancadas para instrumentação, morsas, etc.
		Equipamentos de ponta calibrados (certificado de calibração no prazo de validade).</p>
		<p id="txt-cab"><b>Proteção ao Patrimonio</b></p>
		<p>Nossa base conta com cerca elétrica em toda extensão das divisas, câmaras de monitoramento com
		sistema de registro, alarme monitorado da SPI, equipe de segurança presente vinte e quatro horas por dia,
		sete dias por semana.</p>
		<p>Seguro dos veículos sob nossa responsabilidade, mediante contrato de comodato.</p>
		<p id="txt-cab"><b>Sigilo e Confiabilidade</b></p>
		<p>Possuímos contrato de sigilo e confidencialidade próprios e colocamos a disposição do cliente a qualquer
		tempo, para conhecimento e aprovação do mesmo.</p>
		<p id="txt-cab"><b>Sistema de Gestão de Qualidade</b></p>
		<p>META, empresa certificada no sistema de gestão da qualidade ISO 9001.</p>
		<p align="center" style="margin-top:20px;">Faça-nos uma visita!</p>
		<p align="center" style="font-size:10px;">“O projeto de hoje, será o produto de amanhã”</p>
		';
		$img000 = MontaImagem('empresa');
	}
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/Info24.png">Empresa</li>
			<div id="social">
            <ul>
				<li><a href="#"><img src="image/icones/social/youtube.png" alt=""></a></li>
                <li><a href="#"><img src="image/icones/social/twitter.png" alt=""></a></li>
                <li><a href="#"><img src="image/icones/social/facebook.png" alt=""></a></li>
            </ul>
			</div>
		</ul>
		<ul id="escopo">
			<li style="text-align:justify !important;">
			'.$txt.'
			</li>
		</ul>
		<ul>
			<li>
			<div id="galeria">
				<ul>
					<li id="titulo">META Métodos em Testes Automotivos Ltda</li>
				</ul>
				<ul id="imagens">
				'.$img000.'
				</ul>
			</div>
			</li>
		</ul>
	</div>
	';
	return $jQuery.$html;
}

function testes($type)
{
	
	if($type == 1)
	{
		$txt = '
		<p id="txt-cab"><b>Testes Especiais</b></p>
		<p>São testes específicos realizados para os diversos sistemas / componentes do veículo. É através deles que 
		são realizadas as homologações de acordo com a legislação em  vigor no país.</p>
		
		<p id="txt-cab"><b>Testes de Cooling</b></p>
		<p>Teste realizado em estrada simulando subida de rampa com velocidade máxima e marcha lenta para 
		verificar o desempenho de refrigeração do motor através da monitoração da temperatura do líquido de 
		arrefecimento e das temperaturas nos componentes do sistema.</p>
		
		<p id="txt-cab"><b>Testes de Desempenho</b></p>
		<p>Medição da velocidade máxima e dos tempos de aceleração e retomadas de velocidade 
		do veículo conforme a norma SAE J1491.</p>
		
		<p id="txt-cab"><b>Testes de Freios</b></p>
		<p>Avaliação do sistema de freio do veículo (serviço, emergência e estacionamento) 
		por meio dos requisitos estabelecidos pelas normas Contran 777 ou ECE-R13 ou FMVSS.</p>
		
		<p id="txt-cab"><b>Medições de Esforços</b></p>
		<p>Medição dos esforços e curso dos pedais do acelerador, freios e embreagem além da medição 
		do esforço de acionamento do freio de estacionamento.</p>
		
		<p id="txt-cab"><b>Exhaust Back Pressure</b></p>
		<p>Medição de contra pressão do escapamento.</p>
		
		<p id="txt-cab"><b>Autonomia / Consumo  de combustível</b></p>
		<p>Medição do consumo de combustível em conformidade com a norma SAE J1082.</p>
		
		<p id="txt-cab"><b>Medição de emissão de fumaça (opacidade)</b></p>
		<p>Determinação da opacidade dos gases de escapamento, emitido por motor ciclo Diesel,
		em aceleração livre, de acordo com a norma NBR 13037, em regime constante, de acordo com a norma NBR 7027.</p>
		
		<p id="txt-cab"><b>Avaliação Acústica</b></p>
		<p>Determinação do nivel de ruido veicular em aceleração "pass by noise", Estático 
		em conformidade com as normas NBR15145 e NBR 9714.</p>
		
		<p id="txt-cab"><b>Medição da eficiência de desempenho do filtro de ar do motor</b></p>
		<p>Ensaio estático para medição da restrição do filtro de ar do motor.</p>
		';
		$img = MontaImagem('testes');
	}
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/Info24.png">Testes</li>
			<div id="social">
            <ul>
				<li><a href="#"><img src="image/icones/social/youtube.png" alt=""></a></li>
                <li><a href="#"><img src="image/icones/social/twitter.png" alt=""></a></li>
                <li><a href="#"><img src="image/icones/social/facebook.png" alt=""></a></li>
            </ul>
			</div>
		</ul>
		<ul id="escopo">
			<li style="text-align:justify !important;">
			'.$txt.'
			</li>
		</ul>
		<ul>
			<li>
			<div id="galeria" style="width:930px; !important">
				<ul>
					<li id="titulo">META Métodos em Testes Automotivos Ltda</li>
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

function durabilidade($type)
{
	if($type == 1)
	{
		$txt = '
		<p id="txt-cab"><b>Durability</b></p>
		<p>A durabilidade é o teste final de um projeto de um veículo
		ou de componentes do mesmo. Visando validar o projeto, coloca-se o veículo a
		situações reais de utilização.</p>
		<p>Através do teste de durabilidade pode-se
		obter, por exemplo, o consumo de óleo do motor, consumo de combustível, o
		consumo líquido de arrefecimento e projeções da vida de materiais como do disco
		de embreagem, dos pneus e do material de atrito dos freios.</p>
		
		<p id="txt-cab"><b>Rotas</b></p>
		<p>As rotas são traçadas em rodovias
		previamente analisadas pelo cliente no que diz respeito à determinação dos
		eventos de solicitação como velocidades, frenagens, curvas e depressões pavimentadas
		de vias públicas (lombadas e valetas).</p>
		
		<p id="txt-cab"><b>Highway Durability</b></p>
		<p>Rota de teste na qual o veículo trafega
		predominantemente em rodovias possuindo uma pequena porcentagem da rota na
		cidade.</p>
		
		<p id="txt-cab"><b>Off Road Durability</b></p>
		<p>Rota de teste na qual o veículo trafega
		predominantemente em trechos "fora de estrada" possuindo uma pequena porcentagem
		de rota na cidade ou rodovia.</p>
		
		<p id="txt-cab"><b>City Durability</b></p>
		<p>Rota de teste na qual o veículo trafega em
		centros urbanos.</p>
		
		<p id="txt-cab"><b>Combined Durability</b></p>
		<p>Rota de teste composta por uma combinação
		das três rotas citadas.</p>
		';
		
		$img = MontaImagem('durabilidade');
	}
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/Info24.png">Durabilidade</li>
			<div id="social">
            <ul>
				<li><a href="#"><img src="image/icones/social/youtube.png" alt=""></a></li>
                <li><a href="#"><img src="image/icones/social/twitter.png" alt=""></a></li>
                <li><a href="#"><img src="image/icones/social/facebook.png" alt=""></a></li>
            </ul>
			</div>
		</ul>
		<ul id="escopo">
			<li style="text-align:justify !important;">
			'.$txt.'
			</li>
		</ul>
		<ul>
			<li>
			<div id="galeria" style="width:930px; !important">
				<ul>
					<li id="titulo">META Métodos em Testes Automotivos Ltda</li>
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

function prototipo($type)
{
	if($type == 1)
	{
		$txt = '';
	}
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/Info24.png">Protótipo</li>
			<div id="social">
            <ul>
				<li><a href="#"><img src="image/icones/social/youtube.png" alt=""></a></li>
                <li><a href="#"><img src="image/icones/social/twitter.png" alt=""></a></li>
                <li><a href="#"><img src="image/icones/social/facebook.png" alt=""></a></li>
            </ul>
			</div>
		</ul>
		<ul id="escopo">
			<li>
			'.$txt.'
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
			<li><img src="image/icones/Users24.png">Contato</li>
			<div id="social">
            <ul>
				<li><a href="#"><img src="image/icones/social/youtube.png" alt=""></a></li>
                <li><a href="#"><img src="image/icones/social/twitter.png" alt=""></a></li>
                <li><a href="#"><img src="image/icones/social/facebook.png" alt=""></a></li>
            </ul>
			</div>
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
				<ul>
					<li style="width:100%; text-align:center; padding:15px;"><b>Meta Metodos em Teste Automotivos</b></li>
				</ul>
				<ul>
					<li style="width:60px;">Endereço:</li>
					<li>Rodovia Mário Batista Mori</li>
				</ul>
				<ul>
					<li style="width:60px;">Número:</li>
					<li>141</li>
				</ul>
				<ul>
					<li style="width:60px;">Bairro:</li>
					<li>São Cristovão</li>
				</ul>
				<ul>
					<li style="width:60px;">CEP:</li>
					<li>18280-000</li>
				</ul>
				<ul>
					<li style="width:60px;">Cidade:</li>
					<li>Tatuí</li>
				</ul>
				<ul>
					<li style="width:60px;">Telefone:</li>
					<li>(15) 3205-7750</li>
				</ul>
				<ul>
					<li style="width:60px;">E-Mail:</li>
					<li>meta@meta-sp.com.br</li>
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
	$post_mail[1] = "meta@meta-sp.com.br";
	$post_mail[2] = $_POST["nome"];
	$post_mail[3] = $_POST["email"];
	$post_mail[4] = $_POST["telefone"];
	$post_mail[5] = "E-Mail META Site";
	
	$post_mail[6]  = "<p align=\"center\"><b>E-Mail META</b></p><br />";
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