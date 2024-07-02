<?php

	function ver_nome($arquivo) 
	{
		$nome = explode(".",$arquivo);
		return $nome[0];
	}

	chdir('wrocky_wall');
	$diretorio = getcwd();
	$ponteiro  = opendir($diretorio);
	while ($nome_itens = readdir($ponteiro)){ $itens[] = $nome_itens; }
	sort($itens);
	foreach ($itens as $listar) 
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
	
	$selected["Default.jpg"] = 'selected=\"selected\"';
	
	if ($arquivos != "") 
	{
		foreach($arquivos as $listar)
		{   
			$lista_arq .= "<option value=\"$listar\" $selected[$listar]>".ver_nome($listar)."</option>";
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noodp,noydir" />
<meta name="description" content="Site demonstrativo que apresenta trabalhos desenvolvidos por Roque Ribeiro. Tecnologias usadas: HTML5, jQuery, CSS3, PHP5, MySQL" /> 
<meta name="keywords" content="web,webdesign,design,html5,jquery,css3,php,php5,mysql,webrocky,rocky,roque,roque ribeiro,ribeiro" />
<title>TiWolf.com</title>

<link rel="stylesheet" href="wrocky_theme/css/StyleAll.css" />
<link rel="stylesheet" href="wrocky_theme/css/StyleSystem.css" />
<link rel="stylesheet" href="wrocky_theme/css/StyleTemplate.css" />
<link rel="stylesheet" href="wrocky_theme/css/StyleEffects.css" />
<link rel="stylesheet" href="wrocky_theme/css/StyleMenu.css" />
<link rel="stylesheet" href="wrocky_theme/css/StyleWindow.css" />
<link rel="stylesheet" href="scripts/fancybox/jquery.fancybox-1.3.4.css" />
<link rel="stylesheet" href="wrocky_theme/css/jquery-ui-1.8.12.custom.css" />
<link rel="stylesheet" href="wrocky_theme/css/AeroWindow.css" />
<link rel="stylesheet" href="wrocky_act/wrocky_chat/themes/default.css" />
<link rel="stylesheet" type="text/css" href="scripts/jcarousel/wrocky/skin.css" />

<script type="text/javascript" src="scripts/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery-form.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.8.12.custom.min.js"></script>
<script type="text/javascript" src="scripts/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="scripts/jquery-AeroWindow.js"></script>
<script type="text/javascript" src="scripts/rf.sparks.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#wrocky_chat').html('<img src="wrocky_theme/loader.gif">');
	$('#loading').fadeIn(600);
	$('#loadingbg').css('opacity','0.3');
	$('#loadingbg').fadeIn(200);
	$('#wrocky_effect_icons').jcarousel({
		animation: 100,
		visible: 3
	});
	
	$('#wrocky_persona').remove();
	$('#wrocky_chat').remove();
	
	window.onload = function(){
		
		$('#loading').fadeOut(600);
		$('#loadingbg').fadeOut(1000,function(){
		
			if( navigator.userAgent.search('Chrome') != -1 )
			{
				$('#wrocky_chat_drag').draggable({
					cancel: ".wrocky_chat_msgs, .wrocky_chat_form"	
				});
			}			
			else if( navigator.userAgent.search('Firefox') != -1 )
			{
				$('#opacRange').remove();
				$('#veloRange').remove();
				$('#wrocky_chat').remove();
			}
			else if( navigator.userAgent.search('Opera') != -1 )
			{
				$('#veloRange').remove();
			}
			else if( navigator.userAgent.search('MSIE') != -1 )
			{
				$('#wrocky_persona').remove();
				$('#wrocky_chat').remove();
				alert('Seu navegador não tem suporte as tecnologias usadas neste site! \n\n Navegadores Suportados \n Google Chrome, Mozilla Firefox, Opera e Safari');
			}	
			else
			{
				alert('Seu navegador pode não apresentar o site corretamente! \n\n Navegadores Suportados \n Google Chrome, Mozilla Firefox, Opera e Safari');
			}
							
			$('#bg_size').change(function(){
				bg_size = $(this).attr('value');
				$('#background').css('background-size',bg_size);
			});
			
			$('#bg_select').change(function(){
				bg_select = $(this).attr('value');
				$('#background').fadeOut(300,function(){
					$('#background').css('background','url(wrocky_wall/'+bg_select+')');
					$('#background').fadeIn(2000);
				});
			});
			
			$('#bg_slider').change(function(){
				bg_slider = $(this).attr('value');
				$('#background').css('opacity',bg_slider);
			});
			
			$('#bg_speed').change(function(){
				bg_speed = $(this).attr('value');
				$('#background').css('-webkit-animation-duration',bg_speed+'s');
			});
			
			$('#sis_icon').change(function(){
				if(!$(this).attr('checked'))
				{
					$('#wrocky_menu').css({
						'-webkit-transform'		:'scale(0)',
						'-moz-transform'		:'scale(0)',
						'-o-transform'			:'scale(0)'
					});
					$('#wrocky_effect_cab').css({
						'-webkit-transform'		:'scale(0)',
						'-moz-transform'		:'scale(0)',
						'-o-transform'			:'scale(0)'
					});
				}
				else
				{
					$('#wrocky_menu').css({
						'-webkit-transform'		:'scale(1)',
						'-moz-transform'		:'scale(1)',
						'-o-transform'			:'scale(1)'
					});
					$('#wrocky_effect_cab').css({
						'-webkit-transform'		:'scale(1)',
						'-moz-transform'		:'scale(1)',
						'-o-transform'			:'scale(1)'
					});
				}
			});
			
			$('#sis_bg').change(function(){
				if(!$(this).attr('checked'))
				{
					$('#wrocky_logo').css('opacity','0.2');
					$('#wrocky_fback').css('opacity','0');
					$('#wrocky_fback').css('top','500px');
				}
				else
				{
					$('#wrocky_logo').css('opacity','1');
					$('#wrocky_fback').css('opacity','1');
					$('#wrocky_fback').css('top','190px');
				}
			});
			
			$('#sis_spk').change(function(){
				if($(this).attr('checked'))
				{
					$('#sparks').fadeIn(1600)
				}
				else
				{
					$('#sparks').fadeOut(1000)
				}
			});
			
			$('a#fancy_ajax').fancybox({
				'padding'			: 0,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'fade',
				'easingIn'      	: 'easeOutBack',
				'easingOut'     	: 'easeInBack',
				'overlayColor' 		: '#666'
			});
			
			$('a#fancy_frame').fancybox({
				'padding'			: 0,
				'width'				: '100%',
				'height'			: '100%',
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'fade',
				'type'				: 'iframe',
				'overlayColor' 		: '#666'
			});
			
			$("a#fancy_frame_down").fancybox({
				'padding'			: 0,
				'titleShow'			: false,
				'width'				: 800,
				'height'			: 400,
				'scrolling'			: 'no',
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'fade',
				'type'				: 'iframe',
				'overlayColor' 		: '#666'
			});
			
			$('#sparks').sparks([
				{
					number	: 15,
					speed	: 1,
					img		: 'wrocky_theme/spark/luz_type00.png'
				},
				{
					number	: 10,
					speed	: 2,
					img		: 'wrocky_theme/spark/luz_type01.png'
				},
				{
					number	: 8,
					speed	: 1,
					img		: 'wrocky_theme/spark/luz_type02.png'
				}
			]);
			
			$.get('wrocky_act/wrocky_chat.php',function(data){
				$('#wrocky_chat').html(data);
			});
			
			$('#wrocky_effect_icons img').mouseover(function(){
				$('#wrocky_inform').html($(this).attr('alt')).fadeIn(100);
			});
			$('#wrocky_effect_icons img').mouseout(function(){
				$(this).html('');
				$('#wrocky_inform').fadeOut(100);
			});
									
		});
	}	
			
});
function OpenWindowBox(title,content,sx,sy,px,py)
{
	now 	= new Date();
	winID 	= (now.getSeconds()*now.getMilliseconds())+10;
	
	html  	 = '<div id="Windown'+winID+'">';
	html  	+= '<iframe src="'+content+'" runat="server" width="100%" height="100%" frameborder="0"></iframe>';
	html  	+= '<div id="iframeHelper"></div>';
	html  	+= '</div>';
	
	$('body').append(html);
	
	$('div#Windown'+winID+'').AeroWindow({
	  WindowTitle:          title,
	  WindowPositionTop:    'center',
	  WindowPositionLeft:   'center',
	  WindowMinWidth:		500,
	  WindowMinHeight:		400,
	  WindowWidth:          sx,
	  WindowHeight:         sy,
	  WindowAnimation:      'easeOutExpo',
	  WindowMinimize:       false      
	});
	
}
</script>
</head>

<body>

<div id="loading">
	<ul>
    	<li>Carregando...</li>
    </ul>
    <ul>
    	<li><img src="wrocky_theme/loader.gif"></li>
    </ul>
</div>
<div id="loadingbg"></div>
<div id="background"></div>
<div id="sparks"></div>

<div id="wrocky_persona">
<ul id="nav">
	<li id="nav_persona">Personalizar
    <ul>
    	<li>
		<div id="wrocky_custom_config">
		<table>
			<tr>
				<td>Fundo</td>
				<td>
				<select id="bg_select">
                <option value="">Nenhum</option>
                <?php print $lista_arq; ?>
				</select>
				</td>
			</tr>
			<tr>
				<td>Posição</td>
				<td>
				<select id="bg_size">
				<option value="auto">Normal</option>
				<option value="contain">Contain</option>
				<option value="cover">Cover</option>
                <option value="10%">10%</option>
                <option value="15%">15%</option>
                <option value="20%">20%</option>
				<option value="25%">25%</option>
				<option value="50%">50%</option>
				<option value="75%">75%</option>
				<option value="100%">100%</option>
				</select>
				</td>
			</tr>
			<tr id="opacRange">
				<td>Opacidade</td>
				<td>
				<input id="bg_slider" type="range" min="0" max="1" step="0.01" value="1">
				</td>
			</tr>
			<tr id="veloRange">
				<td>Velocidade</td>
				<td>
				<input id="bg_speed" type="range" min="0" max="1000" step="10" value="0">
				</td>
			</tr>
			<tr>
				<td>Icones</td>
				<td style="height:20px;">
				<input id="sis_icon" type="checkbox" checked="checked">
				</td>
			</tr>
			<tr>
				<td>Logo</td>
				<td style="height:20px;">
				<input id="sis_bg" type="checkbox" checked="checked">
				</td>
			</tr>
			<tr>
				<td>Sparks</td>
				<td style="height:20px;">
				<input id="sis_spk" type="checkbox">
				</td>
			</tr>
		</table>  
		</div>  
        </li>
    </ul>
    </li>
    <li id="nav_estudo">
    Estudos
    <ul>
    	<a href="javascript:OpenWindowBox('Web Agenda','wrocky/agenda',980,600);">
        	<li style="width:100px">Agenda</li>
        </a>
    	<a href="javascript:OpenWindowBox('IV Simpósio da Fatec de Tatuí','wrocky/simposio',980,500);">
        	<li style="width:100px">Simpósio</li>
        </a>
    	<a href="javascript:OpenWindowBox('APS2010 - Software Orientado a Objetos','wrocky/aps',980,500);">
        	<li style="width:100px">APS2010</li>
        </a>
        <a href="javascript:OpenWindowBox('Exemplo de HTML5 e CSS3','wrocky/video',860,485);">
            <li style="width:100px">HTML5 Video</li>
        </a>
    </ul>
    </li>
    <li id="nav_inspira">
    Inspirações
    <ul>
    	<li style="width:100px">
        HTML 5
        <ul>
            <a href="javascript:OpenWindowBox('HTML5 ROCKS','http://www.html5rocks.com',980,500);">
                <li style="width:100px">HTML5 Rocks</li>
            </a>
            <a href="javascript:OpenWindowBox('HTML 5 Demos and Examples','http://html5demos.com',980,500);">
                <li style="width:100px">HTML 5 Demos</li>
            </a>
            <a href="javascript:OpenWindowBox('HTML5 Gallery','http://html5gallery.com',1000,500);">
                <li style="width:100px">HTML5 Gallery</li>
            </a>
            <a href="javascript:OpenWindowBox('Apple HTML5 Showcase','http://www.apple.com/html5',980,500);">
                <li style="width:100px">HTML5 Apple</li>
            </a>
        </ul>
        </li>
    	<li style="width:100px">
        CSS3
        <ul>
            <a href="javascript:OpenWindowBox('CSS3 Info','http://www.css3.info',980,500);">
                <li style="width:100px">CSS3 Info</li>
            </a>
            <a href="javascript:OpenWindowBox('CSS no Lanche','http://www.cssnolanche.com.br',980,500);">
                <li style="width:100px">CSS no Lanche</li>
            </a>
            <a href="javascript:OpenWindowBox('Site do Maujor','http://maujor.com',1000,500);">
                <li style="width:100px">Site do Maujor</li>
            </a>
            <a href="javascript:OpenWindowBox('w3schools.com','http://www.w3schools.com/css',980,500);">
                <li style="width:100px">w3schools.com</li>
            </a>
        </ul>
        </li>
    	<li style="width:100px">
        jQuery
        <ul>
            <a href="javascript:OpenWindowBox('jQuery.com','http://www.jquery.com',980,500);">
                <li style="width:100px">jQuery.com</li>
            </a>
            <a href="javascript:OpenWindowBox('FancyBox','http://fancybox.net',980,500);">
                <li style="width:100px">FancyBox</li>
            </a>
            <a href="javascript:OpenWindowBox('jQuery Malsup','http://jquery.malsup.com',1000,500);">
                <li style="width:100px">jQuery Malsup</li>
            </a>
            <a href="javascript:OpenWindowBox('jQuery User Interface','http://jqueryui.com',980,500);">
                <li style="width:100px">jQuery UI</li>
            </a>
        </ul>
        </li>
    </ul>
    </li>
    <li>
    Jogos
    <ul>
    	<a href="javascript:OpenWindowBox('jBarata jQuery','wrocky_games/barata',550,550);">
            <li style="width:100px">jBarata</li>
        </a>
    </ul>
    </li>
</ul>
</div>
<div id="wrocky_fback"></div>
<div id="wrocky_back">
    <div id="wrocky_logo">
        <img src="wrocky_theme/wrocky_logo.png" />
    </div>
    <div id="wrocky_icons">
    	<div id="wrocky_icons_cab">
            <ul id='wrocky_effect_cab'>
            	<li>
                Desenvolvimentos
               	</li>
            </ul>
        </div>
        <div id='wrocky_menu_reflect'>
            <div id='wrocky_menu'>
        	<ul id="wrocky_effect_icons" class="jcarousel-skin-wrocky">
            	<li>
                <a id="fancy_frame" href="http://www.deliciartsconfeitaria.com.br/">
                <img src="icones/deliciarts.jpg" alt="Deliciarts Confeitaria" />
                </a>
                </li>
            	<li>
                <a id="fancy_frame" href="http://www.sapatosecia.com.br">
                <img src="icones/sapatosecia.jpg" alt="Sapatos & Cia" />
                </a>
                </li>
            	<li>
                <a id="fancy_frame" href="http://www.geratividade.com.br">
                <img src="icones/geratividade.jpg" alt="Paola de Campos - Geratividade.com" />
                </a>
                </li>
            	<li>
                <a id="fancy_frame" href="http://www.lenhaecologicamartins.com.br">
                <img src="icones/lenhaecologicamartins.jpg" alt="Lenha Ecológica Martins" />
                </a>
                </li>
            </ul>
            </div>
        </div>
    </div>
    <div id="wrocky_inform"></div>
    <div id="wrocky_foot">
    	<div id="wrocky_foot_text">
        <a id="fancy_ajax" href="wrocky_act/wrocky_mail.php" title="tiago@tiwolf.com"><b>Entre em Contato! Clique Aqui.</b></a>
        </div>
    </div>
        
    <div id="wrocky_chat_drag"><div id="wrocky_chat"></div></div>
    
    <div id="wrocky_html5">
        <a href="http://www.w3.org/html/logo/">
            <img src="http://www.w3.org/html/logo/badge/html5-badge-h-css3-multimedia-performance-semantics.png" alt="" title="">
        </a>
    </div>
        
</div>

</body>
</html>
