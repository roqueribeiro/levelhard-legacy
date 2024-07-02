<?php

	$g_dir = $_GET["dir"];
	$g_tit = $_GET["tit"];
	$g_des = $_GET["des"];
	
	chdir($g_dir."/max/");
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
		
	if ($arquivos != "") 
	{
		foreach($arquivos as $listar)
		{   
				$lista_gallery .= '
				<li>
					<a class="thumb" name="leaf" href="'.$g_dir.'/max/'.$listar.'">
						<img src="'.$g_dir.'/min/'.$listar.'" alt="Title #0" />
					</a>
					<div class="caption">
						<div class="image-title">'.$g_tit.'</div>
						<div class="image-desc">'.$g_des.'</div>
					</div>
				</li>
				';
		}
	}


?>

<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>WebGallery</title>
		<link rel="stylesheet" href="../styles/galleriffic.css" type="text/css" />
		<link rel="stylesheet" href="../styles/galleriffic-basic.css" type="text/css" />
		<script type="text/javascript" src="../scripts/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../scripts/jquery.galleriffic.js"></script>
		<script type="text/javascript" src="../scripts/jquery.opacityrollover.js"></script>
	</head>
	<body>
		<div id="page">
			<div id="container">
				<div id="gallery" class="content">
					<div id="controls" class="controls"></div>
					<div class="slideshow-container">
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
					</div>
					<div id="caption" class="caption-container"></div>
				</div>
				<div id="thumbs" class="navigation">
					<ul class="thumbs noscript">
					<?php print $lista_gallery ?>
					</ul>
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
		<script type="text/javascript">
		$(document).ready(function($){
			
			$('div.navigation').css({'width' : '300px', 'float' : 'left'});
			$('div.content').css('display', 'block');
		
			var onMouseOutOpacity = 0.5;
			$('#thumbs ul.thumbs li').opacityrollover({
				mouseOutOpacity:   onMouseOutOpacity,
				mouseOverOpacity:  1.0,
				fadeSpeed:         'fast',
				exemptionSelector: '.selected'
			});
			
			var gallery = $('#thumbs').galleriffic({
				delay:                     2500,
				numThumbs:                 21,
				preloadAhead:              10,
				enableTopPager:            true,
				enableBottomPager:         true,
				maxPagesToShow:            7,
				imageContainerSel:         '#slideshow',
				controlsContainerSel:      '#controls',
				captionContainerSel:       '#caption',
				loadingContainerSel:       '#loading',
				renderSSControls:          true,
				renderNavControls:         true,
				playLinkText:              'Iniciar Slideshow',
				pauseLinkText:             'Pausar',
				prevLinkText:              '&lsaquo; Anterior',
				nextLinkText:              'Proxima &rsaquo;',
				nextPageLinkText:          'Proxima &rsaquo;',
				prevPageLinkText:          '&lsaquo; Anterior',
				enableHistory:             false,
				autoStart:                 false,
				syncTransitions:           true,
				defaultTransitionDuration: 1000,
				onSlideChange:function(prevIndex,nextIndex){
					this.find('ul.thumbs').children()
						.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
						.eq(nextIndex).fadeTo('fast', 1.0);
				},
				onPageTransitionOut:function(callback){
					this.fadeTo('fast', 0.0, callback);
				},
				onPageTransitionIn:function(){
					this.fadeTo('fast', 1.0);
				}
			});
		});
		</script>
	</body>
</html>