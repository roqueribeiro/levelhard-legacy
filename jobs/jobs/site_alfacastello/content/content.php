<?php

	require("connection.php");

	$action = $_GET["action"];
	
	switch($action)
	{
		case "Principal":
			//Tela Principal
			print Principal();
		break;
		case "Construtora":
			//Tela Construtora
			print Construtora();
		break;
		case "Servicos":
			//Tela Servicos
			print Servicos();
		break;
		case "Novidade":
			//Tela Novidade
			print Novidade();
		break;
		case "Portifolio":
			//Tela Portifolio
			print Portifolio();
		break;
		case "Contato":
			//Tela Contato
			print Contato();
		break;
		case "SenEmail":
			//Envia os dados do formulario de contato
			print SenEmail();
		break;
	}
	
function Principal()
{//Tela Inicial
 //Roque Ribeiro
 //26-07-2011
 
 	$jQuery = "";
 	$html 	= '
	<script type="text/javascript">'.$jQuery.'</script>
	<div id="montador">Principal</div>	
	';
	
	return $html;
	
}

function Construtora()
{//Tela Construtora
 //Roque Ribeiro
 //26-07-2011
 
 	$jQuery = "";
 	$html 	= '
	<script type="text/javascript">'.$jQuery.'</script>
	<div id="montador">Construtora</div>	
	';
	
	return $html;
}

function Servicos()
{//Tela Servicos
 //Roque Ribeiro
 //26-07-2011
 
 	$jQuery = "";
 	$html 	= '
	<script type="text/javascript">'.$jQuery.'</script>
	<div id="montador">Servicos</div>	
	';
	
	return $html;
}

function Novidade()
{//Tela Novidade
 //Roque Ribeiro
 //26-07-2011
 
 	$jQuery = "";
 	$html 	= '
	<script type="text/javascript">'.$jQuery.'</script>
	<div id="montador">Novidade</div>	
	';
	
	return $html;
}

function Portifolio()
{//Tela Portifolio
 //Roque Ribeiro
 //26-07-2011
 
	$Query 			= "SELECT * FROM galeria";
	$QueryApply 	= mysql_query($Query);
	$QueryResults 	= mysql_num_rows($QueryApply);
	if($QueryResults != 0)
	{
		while ($ResultRow = mysql_fetch_array($QueryApply)) 
		{
			$bd_result[0] 	= $ResultRow[0];
			$bd_result[1] 	= $ResultRow[1];
			$bd_result[2] 	= $ResultRow[2];
			$bd_result[3] 	= $ResultRow[3];
			$bd_result[4] 	= $ResultRow[4];
			
			$html_tooltip = "
			<div>
				<ul>
					<li><b>".$bd_result[1]."</b></li>
				</ul>
				<ul>
					<li>".$bd_result[2]."</li>
				</ul>
			</div>
			";
			
			$html_galeria .= '
			<a href="gallery/gallery.php?dir='.$bd_result[3].'&tit='.$bd_result[1].'&des='.$bd_result[2].'" id="fancybox">
				<li><img src="gallery/'.$bd_result[3].'/miniatura.png" title="'.$html_tooltip.'" alt=""></li>
			</a>
			';
		}
	}
			 
 	$jQuery = "
	$(document).ready(function(){
		
		$('a#fancybox').fancybox({
			'width'				: '95',
			'height'			: '58',
			'autoDimensions'	: false,
			'padding'			: '1px',
			'margin'			: '0px',
			'transitionIn'		: 'fade',
			'transitionOut'		: 'fade',
			'speedIn'			: 600, 
			'speedOut'			: 300,
			'overlayColor'		: '#CCC',
			'overlayOpacity'	: '0.6',
			'scrolling'			: 'no',
			'type'				: 'iframe'
		});
		
		$('#imagens img').tooltip({ 
			track	: true, 
			delay	: 600, 
			showURL	: false, 
			fade	: 300
		});
		
	});	
	";
	
 	$html 	= '
	<script type="text/javascript">'.$jQuery.'</script>
	<div id="montador">
	<ul id="escopo" style="background:none; box-shadow:none;">
		<li>
		<ul id="cabecalho" style="margin:-15px 0 15px 0;">
			<li style="text-align:center;">Clique sobre a imagem que deseja visualizar a galeria de fotos</li>
		</ul>
		<div id="galeria">
		<ul id="imagens">
		'.$html_galeria.'
		</ul>
		</div>
		</li>
	</ul>
	</div>	
	';
	
	return $html;
}

function Contato()
{//Tela Contato
 //Roque Ribeiro
 //26-07-2011
 
	$jQuery = "
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
								
				if(data==1)
				{
					alert('Email Enviado! Em Breve Entraremos em Contato.');
					$('#formulario input[type=text], #formulario textarea').val('');
				}
				if(data==0)
				{
					alert('Erro ao Enviar, Tente Novamente mais Tarde!');
				}
					
				$('#formulario input, #formulario textarea').removeAttr('disabled');
			} 
		});
		
	});
	";
	
	$html = '
	<script type="text/javascript">'.$jQuery.'</script>
	<div id="montador">
		<ul id="escopo">
			<li>
			<div id="formulario">
			<ul id="campos">
				<form name="contato" action="content/content.php" method="post">
				<input type="hidden" name="action" value="SenEmail">
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
					<li style="width:100%;">Alfa Castello Negócios da Construção</li>
				</ul>
				<ul>
					<li style="width:60px;">Endereço:</li>
					<li>Rua Vice-Prefeito Nelson Fiuza</li>
				</ul>
				<ul>
					<li style="width:60px;">Número:</li>
					<li>431/439</li>
				</ul>
				<ul>
					<li style="width:60px;">Bairro:</li>
					<li>Jd. Ternura</li>
				</ul>
				<ul>
					<li style="width:60px;">Cidade:</li>
					<li>Tatuí-SP</li>
				</ul>
				<ul>
					<li style="width:60px;">CEP:</li>
					<li>18279-450</li>
				</ul>
				<ul>
					<li style="width:60px;">Telefones:</li>
					<li>(15) 3259.5591 / (15) 3259.6236</li>
				</ul>
				<ul>
					<li style="width:60px;">E-Mail:</li>
					<li><a href="mailto:contato@alfacastello.com.br">contato@alfacastello.com.br</a></li>
				</ul>
				</li>
			</ul>
			<ul id="cabecalho" style="margin-top:0px; margin-bottom:10px;">
				<li style="text-align:center;">Os campos com * são obrigatórios</li>
			</ul>
			<ul>
			<iframe width="700" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=R+Vice+Prefeito+Nelson+Fiuza,+431&amp;aq=&amp;sll=-23.336821,-47.848545&amp;sspn=0.10986,0.209255&amp;ie=UTF8&amp;hq=R+Vice+Prefeito+Nelson+Fiuza,+431&amp;hnear=&amp;ll=-23.336821,-47.848545&amp;spn=0.10986,0.209255&amp;output=embed">
			</iframe>
			</ul>
			</div>
			</li>
		</ul>
	</div>	
	';
		
	return $html;
}

function SenEmail()
{
	
	$post_mail[1] = "roque.ribeiro@webrocky.com.br";
	$post_mail[2] = $_POST["email"];
	$post_mail[3] = $_POST["nome"];
	$post_mail[4] = $_POST["telefone"];
	
	$post_mail[6]  = "<p align=\"center\"><b>E-mail Enviado Pelo Site AlfaCastello.com.br</b></p><br />";
	$post_mail[6] .= $_POST["texto"];
	
	$post_mail[7]  = "MIME-Version: 1.0\r\n";
	$post_mail[7] .= "Content-type: text/html; charset=utf-8\r\n";
	$post_mail[7] .= "From: ".$post_mail[3]." <".$post_mail[2].">\r\n";
	$post_mail[7] .= "Return-Path: ".$post_mail[2]."\r\n";
	
	$send_mail = mail($post_mail[1],"Email do Site AlfaCastello",$post_mail[6],$post_mail[7]);
		
	if($send_mail){	return 1; } else { return 0; }
	
}

?>