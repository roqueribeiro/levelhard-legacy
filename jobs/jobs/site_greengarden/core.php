<?php

$actGet = $_GET["act"];

$obj = new htmlContext;

switch($actGet)
{
	case "home":
		print $obj->mountHome();
	break;
	case "product":
		print $obj->mountProduct();
	break;
	case "history":
		print $obj->mountHistory();
	break;
	case "services":
		print $obj->mountServices();
	break;
	case "contact":
		print $obj->mountContact();
	break;
	case "sendContact":
		print $obj->actionContact();
	break;
}

class htmlContext
{
	private $action;
	
	function set($prop,$value)
	{
		$this->$prop = $value;
	}
	function mountHome()
	{
		$html = '
		<div class="slider-wrapper theme-light">
			<div id="slider" class="nivoSlider">
				<a href="javascript:ajaxContextLoad(\'core.php\',\'product\');"><img src="img/slider/img001.jpg" data-thumb="" alt="" title="<b>Atendimento Veterinário</b> Animais de Grande Porte" /></a>
				<a href="javascript:ajaxContextLoad(\'core.php\',\'product\');"><img src="img/slider/img002.jpg" data-thumb="" alt="" title="<b>Adubo Orgânico</b> Fertilizante orgânico de compostagem rico em macro e micronutrientes" /></a>
				<a href="javascript:ajaxContextLoad(\'core.php\',\'product\');"><img src="img/slider/img003.jpg" data-thumb="" alt="" title="<b>Hortaliças e Legumes</b> Eco Garden Adubo Orgânico de Compostagem Excelente para Hortaliças e Legumes" /></a>
				<a href="javascript:ajaxContextLoad(\'core.php\',\'product\');"><img src="img/slider/img004.jpg" data-thumb="" alt="" title="<b>Calagem</b> Correçao da Acidez do Solo com Calcario" /></a>
				<a href="javascript:ajaxContextLoad(\'core.php\',\'product\');"><img src="img/slider/img005.jpg" data-thumb="" alt="" title="<b>Milho e Cana</b> aGreen Nitro Adubo Orgânico de Compostagem Rico em Nitrogenio Excelente Para Plantações em Geral" /></a>
			</div>
		</div>
		<div id="uniquecol">
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Home16.png" alt="">A Empresa</div>
				<div id="cont" class="simpleText">
					<p>A <b>GREEN GARDEN</b> é uma empresa que encontra suas bases de atuação no mais moderno conceito de sustentabilidade e preservação do meio ambiente, pois se trata de uma empresa especializada na coleta, destinação e transformação de lixos orgânicos residenciais, comerciais e industriais descartados, em ricos fertilizantes/adubos específicos e indicados para o desenvolvimento e manutenção de cultivos em geral, tais como de hortaliças, jardinagem, plantações, pastagens etc., promovendo, ainda, a recuperação e correção dos solos, sempre buscando a conjunção da produção e comercialização de fertilizantes/adubos de alta qualidade à diminuição dos vultosos impactos ambientais, sociais e econômicos que a equivocada destinação de resíduos/lixos orgânicos acarreta para a sociedade como um todo.</p>
				</div>
				<div id="more"><input type="button" name="more" value="Leia Mais" onclick="ajaxContextLoad(\'core.php\',\'history\');"></div>
			</div>
		</div>
		<div id="multicol">
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Info16.png" alt="">Produtos</div>
				<div id="cont" class="simpleText">
				<p>› <b>ECO GARDEN</b> Fertilizante orgânico de compostagem rico em macro e micronutrientes, excelente para jardins, pomares e hortaliças; 
				<br /><i>Embalagens de 2 kg, 5 kg, 25 kg</i></p>
				<p>› <b>GREEN FIELD</b> Fertilizante orgânico de compostagem, rico em macro e micronutrientes excelente para gramados; 
				<br /><i>Embalagens de 2 kg, 5 kg, 25 kg</i></p>
				</div>
				<div id="more"><input type="button" name="more" value="Leia Mais" onclick="ajaxContextLoad(\'core.php\',\'product\');"></div>
			</div>
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Info16.png" alt="">Serviços</div>
				<div id="cont" class="simpleText">
				<p>Dentre os nossos serviços, podemos citar: </p>
				<p><b>›</b> Comercialização de insumos orgânicos e mudas em geral;</p>
				<p><b>›</b> Consultoria Agronômica;</p>
				<p><b>›</b> Atendimento Veterinário <b>(Grande Porte)</b>;</p>
				<p><b>›</b> Análise de solo e bromatológica.</p>
				</div>
				<div id="more"><input type="button" name="more" value="Leia Mais" onclick="ajaxContextLoad(\'core.php\',\'services\');"></div>
			</div>    
		</div>	
		
		';
		
		return $html;
	}
	function mountProduct()
	{
		$html='
		<div id="uniquecol">
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Home16.png" alt="">Produtos</div>
				<div id="cont" class="massiveText">
					<p>› <b>ECO GARDEN</b> Fertilizante orgânico de compostagem rico em macro e micronutrientes, excelente para jardins, pomares e hortaliças; 
					<br /><i>Embalagens de 2 kg, 5 kg, 25 kg</i></p>
					<p>› <b>GREEN FIELD</b> Fertilizante orgânico de compostagem, rico em macro e micronutrientes excelente para gramados; 
					<br /><i>Embalagens de 2 kg, 5 kg, 25 kg</i></p>
					<p>› <b>GREEN FÓS</b> Fertilizante orgânico de compostagem rico em fósforo (6%  de fósforo) e micronutrientes, excelente para plantios em geral.  Alem do fornecimento de nutrientes também é muito rico em Matéria Orgânica (40% M.O.)  facilitando a absorção de nutrientes pelas plantas, aumenta a capacidade do solo em armazenar nutrientes e melhora a sua estrutura. Consulte sempre um Engenheiro Agrônomo;</p>
					<p>› <b>GREEN NITRO</b> Fertilizante orgânico de compostagem rico em nitrogênio (3%)   potássio (1,5%) , micronutrientes e Matéria Orgânica (40%) excelente na adubação de pastagens, grãos, hortaliças, jardins, etc. Reduz o processo erosivo, maior produtividade, maior disponibilidade de nutrientes, maior retenção de água, menor diferença de temperatura do solo durante o dia e a noite, estimula a atividade biológica do solo, aumenta a taxa de infiltração e maior agregação de partículas do solo.  Consulte sempre um Engenheiro Agrônomo;</p>
					<p>› <b>GREEN GARDEN Coelhos</b> Fertilizante orgânico a base de esterco de coelho,  excelente para hortaliças, gramados e pomares; 
					<br /><i>Embalagens de 1 kg, 2 kg e 5 kg</i></p>
					<p>› <b>GREEN GARDEN Frango</b> Adubo orgânico a base de cama de frango, excelente para hortaliças gramados e pomares; 
					<br /><i>Embalagens de 25 kg e a granel</i></p>
					<p>› <b>Calcário Dolomítico (PRNT 90%)</b> Os principais objetivos da calagem são eliminar a acidez do solo e fornecer suprimento de cálcio e magnésio para as plantas. O cálcio estimula o crescimento das raízes e, portanto, com a calagem ocorre o aumento do sistema radicular e uma maior exploração da água e dos nutrientes do solo, auxiliando a planta na tolerância à seca e na melhor absorção de nutrientes do solo. Consulte sempre um Engenheiro Agrônomo.</p>
					<p>› <b>Gesso Agrícola</b> A aplicação do gesso agrícola como condicionador de solo reduz a saturação de alumínio e aumenta a quantidade de cálcio e enxofre ( camada a baixo de 20 cm) melhorando o ambiente do solo e propiciando o desenvolvimento das raízes em camadas mais profundas. Alem disso, promove maior acesso ao volume de água e nutrientes, aumenta a resistência a seca, aumenta a resistência a doença e o mais importante, aumenta e muito a produtividade. Consulte sempre um Engenheiro Agrônomo.</p>
					<p>› <b>Adubos Formulados</b> Comercializamos adubos formulados para culturas em geral (ex: 20-05-20, 36-00-12, 04-14-08, etc.). Consulte sempre um Engenheiro Agrônomo.</p>
					<p>› <b>Gramas</b> Gramas de excelente qualidade das variedades Esmeralda, São Carlos, Bermudas, Santo Agostinho e Coreana;</p>
					<p>› <b>Mudas Frutíferas</b> Mudas sadias e livre de doenças e pragas;</p>
					<p>› <b>Mudas Ornamentais e Exóticas</b> Mudas sadias e livre de doenças e pragas;</p>
					<p>› <b>Mudas de Palmeiras em Geral</b> Mudas sadias e livre de doenças e pragas;</p>
					<p>› <b>Mudas de Arvores Nativas</b> Mudas sadias e livre de doenças e pragas;</p>
					<p>› <b>Mudas de Cerca Viva</b> Sansão do campo, pingo de ouro, murta, podocarpus,etc;</p>
					<p>› <b>Mudas de Eucalipto</b> Mudas sadias livres de doenças e pragas. Mudas em tubete e saquinho.</p>	
					<p>› <b>Feno</b> Produzimos feno de coast cross, tifton e vaqueiro de excelente qualidade.</p>
					<p>› <b>Implementos Agrícolas</b> Implementos novos, usados e também desenvolvemos maquinários de acordo com a sua necessidade.</p>
					<p>› <b>Defensivos Agrícolas</b> Comercialização de Defensivos agrícolas em geral. Consulte sempre um Engenheiro Agrônomo.</p>
				</div>
			</div>
		</div>
		<div id="uniquecol">
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Folder16.png" alt="">Galeria</div>
				<div id="cont">
					<div id="gallery" class="jcarousel-skin-tango">
						<ul>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img002.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img002_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img003.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img003_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img004.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img004_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img005.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img005_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img006.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img006_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img007.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img007_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img008.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img008_s.jpg"></a></li>							
						</ul>
					</div>
				</div>
			</div>
		</div>
		';
		return $html;
	}
	function mountHistory()
	{
		$html='
		<div id="uniquecol">
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Home16.png" alt="">A Empresa</div>
				<div id="cont" class="massiveText">
				<p>A <b>GREEN GARDEN</b> é uma empresa que encontra suas bases de atuação no mais moderno conceito de sustentabilidade e preservação do meio ambiente, pois se trata de uma empresa especializada na coleta, destinação e transformação de lixos orgânicos residenciais, comerciais e industriais descartados, em ricos fertilizantes/adubos específicos e indicados para o desenvolvimento e manutenção de cultivos em geral, tais como de hortaliças, jardinagem, plantações, pastagens etc., promovendo, ainda, a recuperação e correção dos solos, sempre buscando a conjunção da produção e comercialização de fertilizantes/adubos de alta qualidade à diminuição dos vultosos impactos ambientais, sociais e econômicos que a equivocada destinação de resíduos/lixos orgânicos acarreta para a sociedade como um todo.</p>
				<p>Atualmente, cada indivíduo produz cerca de 1,0 kg de lixo/resíduo por dia e mais da metade desse montante é matéria orgânica. São 22,0 milhões de toneladas de alimentos que vão parar nas lixeiras diariamente e, por sua vez, são descartados por residências, comércio e indústria em geral. Tais resíduos descartados se tornam uma bomba relógio ambiental na maioria das cidades brasileiras, que acabam por dar uma destinação inadequada e essas matérias.</p>
				<p>Diante das informações acima, vale reforçar que o ponto forte da <b>GREEN GARDEN</b> é a transformação de problemas e impactos ambientais em soluções socioeconômicas, já que sua expertise é a produção e comercialização de fertilizantes/adubos orgânicos a partir de materiais que seriam descartadas inadequadamente, na sua grande maioria, destacando que a produção destes fertilizantes/adubos orgânicos passa por um rigoroso processo, que não polui o meio ambiente e possibilita um custo final bastante acessível aos seus clientes, que, por sua vez, colaboram com a GREEN GARDEN na sua missão de buscar uma sociedade e planeta mais sustentáveis, fundada em princípios como a inovação, transparência, qualidade, seriedade, ética e efetividade.</p>
				</div>
			</div>
		</div>
		';
		return $html;
	}
	function mountServices()
	{
		$html='
		<div id="uniquecol">
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Home16.png" alt="">Serviços</div>
				<div id="cont" class="massiveText">
				<p>› Comercialização de Insumos Orgânicos, Inorgânicos e Mudas em Geral</p>
				<p>› Consultoria Agronômica</p>
				<p>› Atendimento Veterinário <b>(Grande Porte)</b></p>
				<p>› Analise de Solo e Bromatológica</p>
				</div>
			</div>
		</div>
		<div id="uniquecol">
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Folder16.png" alt="">Galeria</div>
				<div id="cont">
					<div id="gallery" class="jcarousel-skin-tango">
						<ul>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img002.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img002_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img003.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img003_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img004.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img004_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img005.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img005_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img006.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img006_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img007.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img007_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img008.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img008_s.jpg"></a></li>							
						</ul>
					</div>
				</div>
			</div>
		</div>
		';
		return $html;
	}
	function mountContact()
	{
		$jquery = "
		$(document).ready(function(e){
			
			$('input[name=telefone]').mask('(99) 9999-9999',{placeholder:''});
			$('form[name=contato] input[type=text], form[name=contato] select, form[name=contato] textarea').removeAttr('disabled').removeAttr('value');
			$('form[name=contato]').ajaxForm({
				beforeSubmit:function(){
								
					if($('form[name=contato] input[name=nome]').val().length < 5)
					{
						$('form[name=contato] input, form[name=contato] select, form[name=contato] textarea').removeAttr('disabled');
						$('form[name=contato] input[name=nome]').css('background','#FFDFDF').focus();
						$('form[name=contato] input[name=nome]').keyup(function(){
							if($(this).val().length >= 5) $('form[name=contato] input[name=nome]').css('background','#FFF');
						});
						return false;
					}
					else if($('form[name=contato] input[name=telefone]').val().length < 14)
					{
						$('form[name=contato] input, form[name=contato] select, form[name=contato] textarea').removeAttr('disabled');
						$('form[name=contato] input[name=telefone]').css('background','#FFDFDF').focus();
						$('form[name=contato] input[name=telefone]').keyup(function(){
							if($(this).val().length >= 14) $('form[name=contato] input[name=telefone]').css('background','#FFF');
						});
						return false;
					}
					else if($('form[name=contato] input[name=email]').val().length < 6)
					{
						$('form[name=contato] input, form[name=contato] select, form[name=contato] textarea').removeAttr('disabled');
						$('form[name=contato] input[name=email]').css('background','#FFDFDF').focus();
						$('form[name=contato] input[name=email]').keyup(function(){
							if($(this).val().length >= 6) $('form[name=contato] input[name=email]').css('background','#FFF');
						});
						return false;
					}
					else if(!$('form[name=contato] select[name=assunto]').val())
					{
						$('form[name=contato] input, form[name=contato] select, form[name=contato] textarea').removeAttr('disabled');
						$('form[name=contato] select[name=assunto]').css('background','url(img/form/select.png) right center no-repeat #FFDFDF').focus();
						$('form[name=contato] select[name=assunto]').change(function(){
							$(this).css('background','url(img/form/select.png) right center no-repeat #FFF')
						});
						return false;
					}
					else if($('form[name=contato] textarea[name=texto]').val().length < 10)
					{
						$('form[name=contato] input, form[name=contato] select, form[name=contato] textarea').removeAttr('disabled');
						$('form[name=contato] textarea[name=texto]').css('background','#FFDFDF').focus();
						$('form[name=contato] textarea[name=texto]').keyup(function(){
							if($(this).val().length >= 10) $('form[name=contato] textarea[name=texto]').css('background','#FFF');
						});
						return false;
					}
					else
					{
						$('#contato #preloader').fadeIn(300);
						$('form[name=contato] input, form[name=contato] select, form[name=contato] textarea').attr('disabled','disabled');
					}
					
				},
				success:function(){
					$('#contato #preloader').fadeOut(300);
					$('form[name=contato] input[type=text], form[name=contato] select, form[name=contato] textarea').removeAttr('disabled').removeAttr('value');
					$('form[name=contato] input[type=submit]').removeAttr('disabled');
					$('form[name=contato] input[name=nome]').focus();
					
					alert('E-Mail enviado! Retornamos em Breve!');
				} 
			});
			
		});
		";
		$html = '
		<script type="text/javascript">'.$jquery.'</script>
		<div id="multicol">
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Communicate16.png" alt="">Formulario de Contato</div>
				<div id="cont" style="height:auto">
				<div id="contato">
					<form name="contato" action="core.php" method="get">
					<input type="hidden" name="action" value="mail_send">
					<ul>
						<li>Nome*</li>
						<li><input type="text" name="nome" value="" placeholder="Nome Completo"></li>
					</ul>
					<ul>
						<li>Telefone*</li>
						<li><input type="text" name="telefone" value="" placeholder="Telefone para Contato"></li>
					</ul>
					<ul>
						<li>E-Mail*</li>
						<li><input type="text" name="email" value="" placeholder="E-Mail"></li>
					</ul>
					<ul>
						<li>Como nos achou?</li>
						<li><select name="rede">
							<option>Sites de Busca</option>
							<option>Redes Sociais</option>
							<option>Indicação</option>
							<option>Outro</option>
						</select></li>
					</ul>
					<ul>
						<li>Assunto*</li>
						<li><select name="assunto">
							<option>Pergunta</option>
							<option>Orçamento</option>
							<option>Sugestões e Dicas</option>
							<option>Outro</option>
						</select></li>
					</ul>
					<ul>
						<li>Texto*</li>
						<li><textarea name="texto" placeholder="Perguntas, Orçamentos etc."></textarea></li>
					</ul>
					<ul>
						<li><input type="submit" value="Enviar"></li>
					</ul>
					</form>
					</div>
				</div>
			</div>
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Telephone16.png" alt="">Telefones e Endereço</div>
				<div id="cont">
					<div id="contato">
						<ul>
							<li>Telefone(1)</li>
							<li>(15) 9139 3846</li>
						</ul>
						<ul>
							<li>Telefone(2)</li>
							<li>(15) 8179 7901</li>
						</ul>
						<ul>
							<li>E-Mail(1)</li>
							<li><a href="mailto:contato@greengarden.eco.br" target="_blank">contato@greengarden.eco.br</a></li>
						</ul>
						<ul>
							<li>E-Mail(2)</li>
							<li><a href="mailto:bruno@greengarden.eco.br" target="_blank">bruno@greengarden.eco.br</a></li>
						</ul>
						<ul>
							<li>Cidade/UF</li>
							<li>Cesário Lange - SP</li>
						</ul>
					</div>
					
					<iframe width="100%" height="380px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Ces%C3%A1rio+Lange+-+S%C3%A3o+Paulo&amp;aq=0&amp;oq=cesa&amp;sll=-22.546052,-48.635514&amp;sspn=7.058534,11.590576&amp;ie=UTF8&amp;hq=&amp;hnear=Ces%C3%A1rio+Lange+-+S%C3%A3o+Paulo&amp;t=m&amp;ll=-23.228806,-47.95043&amp;spn=0.029972,0.008497&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com.br/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Ces%C3%A1rio+Lange+-+S%C3%A3o+Paulo&amp;aq=0&amp;oq=cesa&amp;sll=-22.546052,-48.635514&amp;sspn=7.058534,11.590576&amp;ie=UTF8&amp;hq=&amp;hnear=Ces%C3%A1rio+Lange+-+S%C3%A3o+Paulo&amp;t=m&amp;ll=-23.228806,-47.95043&amp;spn=0.029972,0.008497&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left" target="_blank">Ver Mapa Completo</a></small>
					
				</div>
			</div>    
		</div>
		';
		
		return $html;
	}
	function actionContact()
	{
		
		// ============= Direcionamento =============
		$mail_endereco	= "contato@greengarden.eco.br";
		$mail_descricao	= "E-Mail de Contato pelo Site Green Garden";
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

}

?>