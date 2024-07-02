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
	case "news":
		print $obj->mountNews();
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
				<a href="javascript:ajaxContextLoad(\'core.php\',\'product\');"><img src="img/slider/img001.jpg" data-thumb="" alt="" title="Texto Exemplo" /></a>
				<a href="javascript:ajaxContextLoad(\'core.php\',\'history\');"><img src="img/slider/img002.jpg" data-thumb="" alt="" title="Texto Exemplo" /></a>
			</div>
		</div>
		<div id="uniquecol">
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Home16.png" alt="">Cabecalho</div>
				<div id="cont">
				<p>Podemos já vislumbrar o modo pelo qual o desenvolvimento contínuo de distintas formas de atuação possibilita uma melhor visão global das posturas dos órgãos dirigentes com relação às suas atribuições. A nível organizacional, a consulta aos diversos militantes estende o alcance e a importância do investimento em reciclagem técnica. Pensando mais a longo prazo, a consolidação das estruturas acarreta um processo de reformulação e modernização das diretrizes de desenvolvimento para o futuro. Não obstante, a necessidade de renovação processual pode nos levar a considerar a reestruturação do processo de comunicação como um todo.</p>
				</div>
				<div id="more"><input type="button" name="more" value="Leia Mais" onclick="ajaxContextLoad(\'core.php\',\'product\');"></div>
			</div>
		</div>
		<div id="multicol">
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Info16.png" alt="">Cabecalho</div>
				<div id="cont">
				<p>Percebemos, cada vez mais, que a consolidação das estruturas pode nos levar a considerar a reestruturação de alternativas às soluções ortodoxas. Por outro lado, a consulta aos diversos militantes possibilita uma melhor visão global das direções preferenciais no sentido do progresso. Todavia, a execução dos pontos do programa acarreta um processo de reformulação e modernização do remanejamento dos quadros funcionais. Podemos já vislumbrar o modo pelo qual o surgimento do comércio virtual estende o alcance e a importância dos conhecimentos estratégicos para atingir a excelência.</p>
				</div>
				<div id="more"><input type="button" name="more" value="Leia Mais" onclick="ajaxContextLoad(\'core.php\',\'product\');"></div>
			</div>
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Info16.png" alt="">Cabecalho</div>
				<div id="cont">
				<p>Ainda assim, existem dúvidas a respeito de como a execução dos pontos do programa garante a contribuição de um grupo importante na determinação das direções preferenciais no sentido do progresso. Por conseguinte, a contínua expansão de nossa atividade cumpre um papel essencial na formulação dos índices pretendidos. O empenho em analisar a complexidade dos estudos efetuados obstaculiza a apreciação da importância do levantamento das variáveis envolvidas.</p>
				</div>
				<div id="more"><input type="button" name="more" value="Leia Mais" onclick="ajaxContextLoad(\'core.php\',\'product\');"></div>
			</div>    
		</div>	
		
		<div id="uniquecol">
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Folder16.png" alt="">Galeria</div>
				<div id="cont">
					<div id="gallery" class="jcarousel-skin-tango">
						<ul>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
						</ul>
					</div>
				</div>
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
				<div id="cab"><img src="img/icon/Home16.png" alt="">Cabecalho</div>
				<div id="cont">
				Podemos já vislumbrar o modo pelo qual o desenvolvimento contínuo de distintas formas de atuação possibilita uma melhor visão global das posturas dos órgãos dirigentes com relação às suas atribuições. A nível organizacional, a consulta aos diversos militantes estende o alcance e a importância do investimento em reciclagem técnica. Pensando mais a longo prazo, a consolidação das estruturas acarreta um processo de reformulação e modernização das diretrizes de desenvolvimento para o futuro. Não obstante, a necessidade de renovação processual pode nos levar a considerar a reestruturação do processo de comunicação como um todo. 
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
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
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
				<div id="cab"><img src="img/icon/Home16.png" alt="">Cabecalho</div>
				<div id="cont">
				Podemos já vislumbrar o modo pelo qual o desenvolvimento contínuo de distintas formas de atuação possibilita uma melhor visão global das posturas dos órgãos dirigentes com relação às suas atribuições. A nível organizacional, a consulta aos diversos militantes estende o alcance e a importância do investimento em reciclagem técnica. Pensando mais a longo prazo, a consolidação das estruturas acarreta um processo de reformulação e modernização das diretrizes de desenvolvimento para o futuro. Não obstante, a necessidade de renovação processual pode nos levar a considerar a reestruturação do processo de comunicação como um todo. 
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
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		';
		return $html;
	}
	function mountNews()
	{
		$html='
		<div id="uniquecol">
			<div id="ajax-box">
				<div id="cab"><img src="img/icon/Home16.png" alt="">Cabecalho</div>
				<div id="cont">
				Podemos já vislumbrar o modo pelo qual o desenvolvimento contínuo de distintas formas de atuação possibilita uma melhor visão global das posturas dos órgãos dirigentes com relação às suas atribuições. A nível organizacional, a consulta aos diversos militantes estende o alcance e a importância do investimento em reciclagem técnica. Pensando mais a longo prazo, a consolidação das estruturas acarreta um processo de reformulação e modernização das diretrizes de desenvolvimento para o futuro. Não obstante, a necessidade de renovação processual pode nos levar a considerar a reestruturação do processo de comunicação como um todo. 
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
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
							<li><a href="img/galeria/produto001/img001.jpg" class="fancybox" rel="fancybox"><img src="img/galeria/produto001/img001_s.jpg"></a></li>
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
							<li>Telefone</li>
							<li>(99) 9999-9999</li>
						</ul>
						<ul>
							<li>Telefone</li>
							<li>(99) 9999-9999</li>
						</ul>
						<ul>
							<li>Fax</li>
							<li>(99) 9999-9999</li>
						</ul>
						<ul>
							<li>E-Mail</li>
							<li><a href="mailto:contato@meudominio.com.br" target="_blank">contato@meudominio.com.br</a></li>
						</ul>
						<ul>
							<li>Endereço</li>
							<li>Rua Exemplo, 999</li>
						</ul>
						<ul>
							<li>Bairro</li>
							<li>Vila Exemplo</li>
						</ul>
						<ul>
							<li>CEP</li>
							<li>99999-999</li>
						</ul>
						<ul>
							<li>Cidade/UF</li>
							<li>Tatuí - SP</li>
						</ul>
					</div>
					
					<iframe width="100%" height="380" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=tatu%C3%AD&amp;aq=&amp;sll=-22.546052,-48.635514&amp;sspn=8.669049,16.907959&amp;ie=UTF8&amp;hq=&amp;hnear=Tatu%C3%AD+-+S%C3%A3o+Paulo&amp;t=m&amp;z=12&amp;iwloc=A&amp;output=embed"></iframe><small><a href="http://maps.google.com.br/maps?f=q&amp;source=embed&amp;hl=pt-BR&amp;geocode=&amp;q=tatu%C3%AD&amp;aq=&amp;sll=-22.546052,-48.635514&amp;sspn=8.669049,16.907959&amp;ie=UTF8&amp;hq=&amp;hnear=Tatu%C3%AD+-+S%C3%A3o+Paulo&amp;t=m&amp;z=12&amp;iwloc=A" style="color:#0000FF;margin:0 0 0 10px">Exibir mapa ampliado</a></small>
					
				</div>
			</div>    
		</div>
		';
		
		return $html;
	}
	function actionContact()
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

}

?>