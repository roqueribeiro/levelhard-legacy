<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<?php $tela = $_POST["tela"];
	
	switch($tela)
	{
		case "principal";
			print principal();
		break;
		case "warfire";
			print warfire(1);
		break;
		case "integrantes";
			print integrantes(1);
		break;
		case "agenda";
			print agenda(1);
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
	<script type=\"text/javascript\">
	$(document).ready(function(){
		$('#slider').nivoSlider({
			pauseTime: 4000,	
		});
		$('#submain li').click(function(){
			var destino = $(this).attr('class');
			if(destino)
			{
				$('#wrap, #carregador').show()
				$.post('core/core.php',{'tela':destino},function(data){
					$('#wrap, #carregador').hide();
					$('#centro div').html(data);
					fancyActive();
				});
			}
		});		
	});
	</script>
	";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/Home24.png">Banda Warfire Site Oficial</li>
		</ul>
		<ul id="escopo" style="padding:25px 5px 25px 5px; !important">
			<div class="slider-wrapper theme-levelhard">
				<div class="ribbon"></div>
				<div id="slider" class="nivoSlider">
					<img src="image/galeria/home/imagem2.jpg" alt="" title="CONTATO: WARFIRE_OFICIAL@HOTMAIL.COM" />
					<img src="image/galeria/home/imagem.JPG" alt="" title="EP ITS TIME TO WAR" />
				</div>
			</div>
			<li>
			<ul id="submain">
				<li class="agenda"><img src="image/icones/Billboard48.png" alt=""><p>Agenda</p></li>
				<li class="warfire"><img src="image/icones/Info48.png" alt=""><p>A Banda Warfire</p></li>
				<li class="integrantes"><img src="image/icones/Users48.png" alt=""><p>Integrantes</p></li>
				<li class="contato"><img src="image/icones/Telephone48.png" alt=""><p>Contato</p></li>
			</li>
		</ul>
	</div>
	';
	
	return $jQuery.$html;
}

function warfire($type)
{
	
	if($type == 1)
	{
		$tit = 'A Banda Warfire';
		$txt = '
		<p>&nbsp;&nbsp;&nbsp;Oriunda de Tatuí, no interior paulista, a Banda Warfire é composta por: Cerbo (Bateria), Paul Cappotish (Baixo), Gamba (Guitarra), Andrews Neander (Guitarra) e Loiz Krieg (Vocais), tendo sua sonoridade galgada num heavy metal, violento e direto!</p>
		<p>&nbsp;&nbsp;&nbsp;Seus integrantes, remanescentes de outros projetos, sempre encontraram dificuldades em montar um grupo engajado em fazer um trabalho sério... Após o coincidente término de suas respectivas bandas decidiram se unir em meados de março de 2010, na tentativa de desenvolver algo sólido.</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;Atualmente, a Warfire, concentra-se na divulgação de seu primeiro EP, intitulado "Its Time to War" produzido no estudio Mr. Som, sob tutela de Marcello Pompeu e Heros Trench (Korzus).</p>
		<ul id="social">
			<li>
			<a href="http://www.facebook.com/warfire.tatui.brazil" target="_blank"><img src="image/social/FaceBook-icon.png" alt=""></a>
			<a href="http://www.youtube.com/user/warfiretatuioficial" target="_blank"><img src="image/social/Youtube-icon.png" alt=""></a>
			<a href="http://www.myspace.com/warfire_tatui" target="_blank"><img src="image/social/MySpace-icon.png" alt=""></a>
			</li>
			<li>
			<a href="http://www.orkut.com.br/Main#Community?cmm=105601040" target="_blank"><p>Acesse Também a nossa Comunidade no Orkut! Clicando Aqui.</p></a>
			</li>
		</ul>
		';
		$img = MontaImagem('banda');
	}
	
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/Info24.png">'.$tit.'</li>
		</ul>
		<ul id="escopo">
			<li style="width:100%; text-align:justify; line-height:25px;">
			'.$txt.'
			</li>
		</ul>
		<ul>
			<li>
			<div id="galeria">
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

function integrantes($type)
{
	
	if($type == 1)
	{
		$tit = 'Integrantes da Banda Warfire';
		$txt = '
		<ul id="integra">
			<li style="background:url(image/galeria/integrante/andrews.jpg) center no-repeat">
			<p>Andrews - Guitarra</p>
			<a href="http://www.facebook.com/#!/profile.php?id=100003639495926" target="_blank"><img src="image/social/FaceBook-icon.png" alt=""></a>
			</li>
			<li style="background:url(image/galeria/integrante/cerbo.jpg) center no-repeat">
			<p>Cerbo - Bateria</p>
			<a href="http://www.facebook.com/profile.php?id=100004459234035" target="_blank"><img src="image/social/FaceBook-icon.png" alt=""></a>
			</li>
			<li style="background:url(image/galeria/integrante/gamba.jpg) center no-repeat">
			<p>Gamba - Guitarra</p>
			<a href="http://www.facebook.com/profile.php?id=100000416737306" target="_blank"><img src="image/social/FaceBook-icon.png" alt=""></a>
			</li>
			<li style="background:url(image/galeria/integrante/loiz.jpg) center no-repeat">
			<p>Loiz - Vocal</p>
			<a href="http://www.facebook.com/profile.php?id=100000513252746" target="_blank"><img src="image/social/FaceBook-icon.png" alt=""></a>
			</li>			
			<li style="background:url(image/galeria/integrante/paul.jpg) center no-repeat">
			<p>Paul - Baixo</p>
			<a href="http://www.facebook.com/profile.php?id=100002417200044" target="_blank"><img src="image/social/FaceBook-icon.png" alt=""></a>
			</li>
		</ul>
		';
		$img = MontaImagem('banda');
	}
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/Info24.png">'.$tit.'</li>
		</ul>
		<ul id="escopo">
			<li style="width:100%;">
			'.$txt.'
			</li>
		</ul>
		<ul>
			<li>
			<div id="galeria">
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


function agenda($type)
{
	if($type == 1)
	{
		$tit = 'Agenda e Eventos';
		$txt = '
		<div id="agenda-list">
		<ul>	
			<li><a href="image/galeria/agenda/14012012.jpg" rel="group"><img src="image/galeria/agenda/14012012_s.jpg"></a></li>	
			<li><p><b>JUDAS FEST 08 de Dezembro de 2012</b> Av. Francisco Matarazzo, 694, São Paulo - SP</li>
		</ul>
		</div>
		';
	}	
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/Info24.png">'.$tit.'</li>
		</ul>
		<ul id="escopo">
			<li style="width:100%;">
			'.$txt.'
			</li>
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
		</ul></div>	
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
					alert('Serviço Indisponível, contato via e-mail: warfire_oficial@hotmail.com');
					$('#formulario input[type=text], #formulario textarea').val('');
				}
				else
				{
					alert('Serviço Indisponível, contato via e-mail: warfire_oficial@hotmail.com');
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
			<li><img src="image/icones/Edit24.png">Contato</li>
		</ul>
		<ul id="escopo">
			<li>
			<div id="formulario">
			<ul>
				<li style="padding-bottom:20px;"><b>Temporariamente Indisponível</b></li>
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
					<li><b>Banda Warfire</b></li>
				</ul>
				<ul>
					<li style="width:60px;">Endereço:</li>
					<li>Rua Exemplo</li>
				</ul>
				<ul>
					<li style="width:60px;">Número:</li>
					<li></li>
				</ul>
				<ul>
					<li style="width:60px;">Compl.:</li>
					<li></li>
				</ul>
				<ul>
					<li style="width:60px;">Bairro:</li>
					<li></li>
				</ul>
				<ul>
					<li style="width:60px;">Telefone:</li>
					<li></li>
				</ul>
				<ul>
					<li style="width:60px;">E-Mail:</li>
					<li></li>
				</ul>
				</li>
			</ul>
			</div>
			</li>
		</ul></div>	
	';
	return $jQuery.$html;
}

function email()
{
	$post_mail[1] = "warfire_oficial@hotmail.com";
	$post_mail[2] = $_POST["nome"];
	$post_mail[3] = $_POST["mail"];
	$post_mail[4] = "E-Mail Espaço Lar Site";
	
	$post_mail[5]  = "<p align=\"center\"><b>E-Mail Espaço Lar</b></p><br />";
	$post_mail[5] .= $_POST["texto"];
	
	$post_mail[6]  = "MIME-Version: 1.0\r\n";
	$post_mail[6] .= "Content-type: text/html; charset=utf-8\r\n";
	$post_mail[6] .= "From: ".$post_mail[2]." <".$post_mail[3].">\r\n";
	$post_mail[6] .= "Return-Path: ".$post_mail[3]."\r\n";
	
	$send_mail = @mail($post_mail[1],$post_mail[4],$post_mail[5],$post_mail[6]);
			
	if($send_mail) return 1;
	
}

?>
</head><body>
<br>

<br>

</body></html>