<?php

	$tela = $_POST["tela"];
	
	switch($tela)
	{
		// ======= Tela Inicial ======= //
		case "principal";
			print principal();
		break;
		
		// ======= Produtos ======= //
		case "produtos_paes";
			print produtos(1);
		break;
		case "produtos_frios";
			print produtos(2);
		break;
		case "produtos_bolos";
			print produtos(3);
		break;		
		case "produtos_lanches";
			print produtos(4);
		break;
		case "produtos_encomendas";
			print produtos(5);
		break;		


		// ======= Empresa ======= //
		case "empresa";
			print empresa(1);
		break;
		
		// ======= Trabalhe Conosco ======= //
		case "novidade";
			print novidade(1);
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
		<ul id="cabecalho">
			<li><img src="image/icones/home.png">Bem-Vindo(a) ao Site Panificadora Super Pão</li>
		</ul>
		<ul id="escopo">
			<div class="slider-wrapper theme-levelhard">
				<div class="ribbon"></div>
				<div id="slider" class="nivoSlider">
					<img src="image/galeria/home/imagem.jpg" alt="" title="Pães, Doces, Salgadas e Etc." />
					<img src="image/galeria/home/imagem2.jpg" alt="" title="Pães Quentes a Toda Hora!" />
					<img src="image/galeria/home/imagem3.jpg" alt="" title="Variedades & Diversidades" />
					<img src="image/galeria/home/imagem4.jpg" alt="" title="Bolos Sob Encomenda!" />
				</div>
			</div>
			<li>
			Textos
			</li>
		</ul>
		<ul id="minilogo">
			<li><img src="image/logo-lenhaeco-font.png"></li>
		</ul>
	</div>
	';
	return $html.$jQuery;
}

function produtos($type)
{
	if($type == 1)
	{
		$tit = 'Pães';
		$txt = '
		<div id="topicos">
		<ul>
		
			<li><p><b>Pães Tradicionais</b></p>
			<ul>
				<li>Pão Francês</li>
				<li>Pão Francês com Queijo</li>
				<li>Pão Francês com Parmesão</li>
				<li>Pão de Leite</li>
				<li>Pão de Fuba</li>
				<li>Pão de Batata</li>
				<li>Pão de Cenoura</li>
				<li>Pão Temperado</li>
				<li>Caseirinho</li>
				<li>Bisnaguinha</li>
			</ul>
			<li>
			
			<li><p><b>Pães Doces</b></p>
			<ul>
				<li>Pão Docê Cocô</li>
				<li>Pão de Leite Condensado</li>
				<li>Caracol com Creme de Baunilha</li>
				<li>Fatia Hungaras</li>
				<li>Lua de Mel Doce de Leite</li>
				<li>Lua de Mel Creme de Baunilha</li>
			</ul>
			<li>

			<li><p><b>Massas Artesanais</b></p>
			<ul>
				<li>Pão de Queijo</li>
				<li>Chocotone</li>
				<li>Panetone</li>
				<li>Stollen</li>
				<li>Pão Integral</li>
				<li>Pão de Aveia e Fibras</li>
				<li>Cangalha de Queijo</li>
			</ul>
			<li>

			<li><p><b>Baguetas Recheadas</b></p>
			<ul>
				<li>Baguete de Presunto e Queijo</li>
				<li>Baguete de Calabresa</li>
				<li>Baguete de Frango com Catupiry</li>
				<li>Baguete de Quatro Queijos</li>
				<li>Baguete de Lombo</li>
			</ul>
			<li>
			
		</ul>
		</div>
		';
		$img = MontaImagem('paes');
	}
	if($type == 2)
	{
		$tit = 'Frios & Patês';
		$txt = '
		<div id="topicos">
		<ul>
		
			<li><p><b>Frios</b></p>
			<ul>
				<li>Queijo mussarela</li>
				<li>Queijo prato</li>
				<li>Queijo provolone</li>
				<li>Queijo parmesão ralado</li>
				<li>Queijo fresco caseiro</li>
				<li>Queijo fresco embalado</li>
				<li>Presunto</li>
				<li>Presunto de frango</li>
				<li>Apresuntado</li>
				<li>Calabresa fatiada</li>
				<li>Lombo canadense</li>
				<li>Mortadela marba</li>
				<li>Mortadela defumada perdigão</li>
				<li>Salame</li>
				<li>Salsicha pacote</li>
			</ul>
			<li>
			
			<li><p><b>Frios especiais</b></p>
			<ul>
				<li>Queijo mussarela búfala</li>
				<li>Fiambre’s</li>
				<li>Presunto de frango ceratti</li>
				<li>Mortadela ceratti Bologna</li>
				<li>Salame copa ouro</li>
				<li>Queijo no especial</li>
				<li>Queijo no com orégano</li>
				<li>Queijo artesanal de minas</li>
			</ul>
			<li>
			
			<li><p><b>Patês</b></p>
			<ul>
				<li>Patê de salsicha</li>
				<li>Patê de atum</li>
				<li>Patê de frango</li>
				<li>Patê de azeitonas</li>
				<li>Patê de azeitona preta</li>
				<li>Patê de presunto</li>
				<li>Patê de salame</li>
				<li>Patê de quatro queijos</li>
			</ul>
			<li>
			
		</ul>
		</div>
		';
		$img = MontaImagem('frios');
	}
	if($type == 3)
	{
		$tit = 'Bolos & Doces';
		$txt = '
		<div id="topicos">
		<ul>
		
			<li><p><b>Bolos e tortas</b></p>
			<ul>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló chocolate, brigadeiro)</p>">Bolo de brigadeiro</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló chocolate, beijinho, coco)</p>">Bolo de prestígio</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló chocolate, chantilly, cerejas, raspas de chocolate)</p>">Bolo floresta negra</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló, chantilly, cerejas, raspas de chocolate branco)</p>">Bolo floresta branca</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló chocolate, morango, brigadeiro, raspas chocolate, açúcar confeiteiro)</p>">Bolo sensação</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló chocolate, chantilly de morango, morango, creme paris, chantilly)</p>">Bolo sedução</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló, creme de leite condensado, morango, cobertura chantilly c/ morango)</p>">Bolo delicia de morango</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló, creme de leite condensado, abacaxi, chantilly)</p>">Bolo de abacaxi</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló chocolate,chantilly,creme paris,raspas chocolate)</p>">Bolo aerado chocolate</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló,chantilly,creme paris branco,raspas chocolate branco)</p>">Bolo aerado chocolate branco</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló,chantily,creme de nozes,nozes picada)</p>">Bolo de nozes</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló,mousse de morango,chantily,morango)</p>">Torta mousse de morango</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(pão-de-ló,mousse de limão,chantilly,limão)</p>">Torta mousse de limão</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(base fina de pão de lo,mousse de chocolate e creme paris)</p>">Torta mousse de chocolate</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>(creme holandês,bolacha maisena,creme paris,bolacha calipso)</p>">Torta holandesa</a></li>
			</ul>
			<li>
			
			<li><p><b>Doces</b></p>
			<ul>
				<li>Pudim de leite condensado</li>
				<li>Pudim de chocolate</li>
				<li>Pudim de padaria</li>
				<li>Pudim de bolo</li>
				<li>Torta holandesa pote</li>
				<li>Mousse chocolate</li>
				<li>Mousse morango</li>
				<li>Mousse de limão</li>
				<li>Bomba de brigadeiro</li>
				<li>Bomba de fruta</li>
				<li>Bolo trufado</li>
				<li>Bolo gelado</li>
				<li>Pão de mel</li>
				<li>Tortinha de frutas</li>
			</ul>
			<li>
			
			<li><p><b>Mini doces</b></p>
			<ul>
				<li>Brigadeiro</li>
				<li>Beijinho</li>
				<li>Camafeu</li>
				<li>Mini bomba</li>
				<li>Carolina recheada</li>
				<li>Carolina açucarada</li>
				<li>Samantha</li>
				<li>Suspiro</li>
				<li>Quindim</li>
				<li>Maria mole</li>
			</ul>
			<li>
			
			<li><p><b>Bolos caseiros e muffins</b></p>
			<ul>
				<li>Bolo de cenoura</li>
				<li>Bolo de fubá</li>
				<li>Bolo de coco</li>
				<li>Bolo de maracujá</li>
				<li>Bolo de laranja</li>
				<li>Bolo de baunilha</li>
				<li>Muffins chocolate</li>
				<li>Muffins baunilha</li>
				<li>Bombocado</li>
				<li>Cocada caseira</li>
			</ul>
			<li>
			
		</ul>
		</div>
		';
		$img = MontaImagem('bolos');
	}
	if($type == 4)
	{
		$tit = 'Lanches & Salgados';
		$txt = '
		<div id="topicos">
		<ul>
		
			<li><p><b>Lanches</b></p>
			<ul>
				<li><a id="tooltipAct" href="javascript:void(0)" title="">Pão com manteiga na chapa</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>presunto,mussarela,tomate,maionese</p>">Misto quente</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Mussarela,tomate</p>">Queijo quente</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>mortadela,queijo,tomate</p>">Cheese – Mortadelão</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>4 fatias ceratti,mussarela,tomate</p>">Mortadela especial Ceratti</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>hambúrguer,presunto,queijo,tomate,maionese</p>">Cheese – Burguer</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>hambúrguer,calabresa,presunto,queijo,tomate,maionese</p>">Cheese – calabresa</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>hambúrguer,alface,presunto,queijo,tomate,maionese</p>">Cheese – Salada</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>frango desfiado,requeijão,tomate,queijo,maionese</p>">Cheese – Frango com Catupiry</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Contra-filet,queijo,tomate,maionese</p>">Churrasquinho</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Pernil,queijo,tomate,maionese</p>">Chesse – Pernil</a></li>
			</ul>
			<li>
			
			<li><p><b>Salgados</b></p>
			<ul>
				<li>Bauruzinho</li>
				<li>Pão de frios</li>
				<li>Enroladinho de queijo</li>
				<li>Esfiha de carne</li>
				<li>Esfiha de frango com catupiry</li>
				<li>Esfiha de calabresa</li>
				<li>x-burguer</li>
				<li>empada de frango</li>
				<li>empada de palmito</li>
				<li>empada calabresa</li>
				<li>empada de queijo</li>
				<li>coxinha de frango</li>
				<li>coxinha de frango com catupiry</li>
				<li>kibe</li>
			</ul>
			<li>
			
			<li><p><b>Mini Salgados</b></p>
			<ul>
				<li>Coxinha</li>
				<li>Bolinha de queijo</li>
				<li>Kibe</li>
				<li>Empada</li>
				<li>Folhado de frios</li>
				<li>Pão de frios</li>
				<li>Esfiha de frango</li>
				<li>Esfiha de carne</li>
				<li>Esfiha calabresa</li>
				<li>Enroladinho</li>
			</ul>
			<li>
			
			<li><p><b>Folhados</b></p>
			<ul>
				<li>Rocambole de frango com catupiry</li>
				<li>Rocambole de 4 queijos</li>
				<li>Rocambole de calabresa</li>
				<li>Rocambole de frios</li>
				<li>X-pizza</li>
				<li>Croassain’t de queijo</li>
				<li>Croassain’t presunto de queijo</li>
				<li>Palito de queijo</li>
				<li>Fatias húngaras de coco</li>
			</ul>
			<li>	
			
		</ul>
		</div>
		';
		$img = MontaImagem('lanches');
	}
	if($type == 5)
	{
		$tit = 'Encomendas & Delivery';
		$txt = '
		<div id="width:100%">
		<ul>
		
			<li><p><b>Coffe Break</b></p>
			<ul>
				<li style="padding:10px 10px 20px 10px; text-align:justify;">
				<p>Servimos coffe break para eventos de sua organização,com produtos de qualidade de uma empresa com mais de 15 anos de tradição.
				Temos toda a estrutura para que você se preocupe apenas com o evento,ligue e faça um orçamento.
				Kit festa.</p>
				<p align="center"><b>Faça sua festa e encomende doces e bolos da Panificadora Super Pão.</b></p>
				
				<p align="center"><b>Kits</b></p>
				<p align="center" style="text-decoration:underline;">30 pessoas</p>
				<p align="center" style="font-size:10px;">1 bolo de brigadeiro 3kg,100 mini doces,100 mini salgados,50 mini lanches,bolo aproximadamente 3kg.</p>
				<p align="center" style="text-decoration:underline;">45 pessoas</p>
				<p align="center" style="font-size:10px;">150 mini salgados, 90 mini lanches,100 mini doces,bolo aproximadamente 5kg</p>
				<p align="center" style="text-decoration:underline;">60 pessoas</p>
				<p align="center" style="font-size:10px;">200 mini salgados,150 mini lanches,150 mini doces,bolo de 5kg</p>
				
				</li>
			</ul>
			<li>
			
		</ul>
		</div>
		<div id="topicos">
		<ul>
		
			<li><p><b>Baguete de Metro</b></p>
			<ul>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Queijo Prato,salame,Alface,Tomate,patê de azeitonas</p>">Baguete de queijo prato</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Presunto queijo,alface,Tomate,maionese</p>">Baguete de Presunto e queijo</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Mussarela,queijo,prato,tomate,alface,patê de azeitonas</p>">Baguete de 2 queijos</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Mussarela, salame, alface, tomate, patê de salame</p>">Baguete salame</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Mortadela Ceratti, tomate, patê de azeitona</p>">Baguete Mortadela Ceratti</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Fiambre Ceratti, queijo prato, alface, tomate, maionese</p>">Baguete Fiambre</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Provolone, tomate, alface, patê de salsicha</p>">Baguete provolone</a></li>
			</ul>
			<li>
			
			<li><p><b>Pizzas</b></p>
			<ul>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Presunto, Mussarela, ervilha, milho, cebola, ovo, azeitona</p>">Portuguesa</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Mussarela, tomate, parmesão, azeitona</p>">Mussarela</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Calabresa, mussarela, tomate, cebola, azeitona</p>">Calabresa</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Mussarela, salame, cebola, tomate, azeitona</p>">Salame</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Mussarela,queijo prato,parmesão,catupiry</p>">4 queijos</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Frango, catupiry, azeitona, tomate</p>">Frango c/ catupiry</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Tomate seco, queijo branco, mussarela, azeitona</p>">Tomate seco</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Atum, mussarela, cebola, azeitona, tomate</p>">Atum</a></li>
				<li><a id="tooltipAct" href="javascript:void(0)" title="<p>Bacon,ovo,champignon,mussarela,presunto,tomate,azeitona</p>">Super Pizza</a></li>
			</ul>
			<li>
									
		</ul>
		</div>
		';
		$img = MontaImagem('encomendas');
	}

	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/produtos.png">'.$tit.'</li>
		</ul>
		<ul id="escopo">
			<li>
			'.$txt.'
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
		<ul id="minilogo">
			<li><img src="image/logo-lenhaeco-font.png"></li>
		</ul>
	</div>
	';
	return $jQuery.$html;
}

function empresa($type)
{
	
	if($type == 1)
	{//Presentes Bar Objetos
		$txt = '
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A panificadora Super Pão, nasceu de um sonho do empreendedor Jose Antonio Dias "Zé Dias" e de sua Esposa Dona Vera, de montarem uma padaria, o Sr. José desde pequeno trabalhou na parte de produção em padarias na cidade de Conchas interior de São Paulo, mudou com seus pais e a família para Tatuí onde fazia bicos de vendedor de sonhos que ele mesmo produzia para ajudar seus pais, trabalhou em padarias na cidade, montou vários negócios na parte de varejo, mas sempre quis mesmo ter uma padaria, pois era o que gostava de fazer, teve a oportunidade de abrir seu primeiro negocio em 1993, a padaria Cantinho doce no Valinhos, porem surgiu novas oportunidades de negócio e entre fracassos e acertos conseguiu o ponto onde hoje encontra-se a loja principal em frente ao SESI, no ano de 1997, a padaria passou por mudanças conforme necessidade de atendimento, hoje com o foco no cliente de loja e com pensamento em sempre melhorar a qualidade em produtos e serviços no setor de alimentação,dentro e fora do lar, com foco no atendimento e qualidade, fazendo com que a experiência de compra em uma padaria seja a mais agradável possível.		
		';
		$img = MontaImagem('empresa');
	}
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/empresa.png">Quem Somos</li>
		</ul>
		<ul id="escopo">
			<li style="width:880px; text-align:justify; line-height:26px;">
			'.$txt.'
			</li>
		</ul>
		<ul>
			<li>
			<div id="galeria" style="width:930px; !important">
				<ul id="cabecalho">
					<li><img src="image/icones/galeria.png">Panificadora Super Pão. Tatuí-SP</li>
				</ul>
				<ul id="imagens">
				'.$img.'
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

function novidade($type)
{
	if($type == 1)
	{
		$txt = '<p style="padding:50px 0 0 0; color:#F00; ">Redes Socias em Desenvolvimento. Volte em Breve!</p>';
	}
	
	$jQuery = "";
	$html = '
	<div id="conteudo">
		<ul id="cabecalho">
			<li><img src="image/icones/empresa.png">Novidades</li>
		</ul>
		<ul id="escopo">
			<li>
			'.$txt.'
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
					<li style="width:100%; text-align:center; padding:15px;"><b>Panificadora Super Pão</b></li>
				</ul>
				<ul>
					<li style="width:60px;">Endereço:</li>
					<li>Av. Monsenhor Silvestre Murari</li>
				</ul>
				<ul>
					<li style="width:60px;">Número:</li>
					<li>102</li>
				</ul>
				<ul>
					<li style="width:60px;">Bairro:</li>
					<li>Doutor Laurindo</li>
				</ul>
				<ul>
					<li style="width:60px;">CEP:</li>
					<li>18270010</li>
				</ul>
				<ul>
					<li style="width:60px;">Cidade:</li>
					<li>Tatuí</li>
				</ul>
				<ul>
					<li style="width:60px;">Telefone:</li>
					<li>(15) 3205-1074</li>
				</ul>
				<ul>
					<li style="width:60px;">E-Mail:</li>
					<li>contato@panificadorasuperpao.com.br</li>
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
	$post_mail[1] = "roque.ribeiro@levelhard.com.br";
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