<?php

	require "wclin_config/wclin_acs.php";
	require "wclin_config/wclin_lang_ptBR.php";
			
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php print $wclin_lang["sitename"]; ?></title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="wclin_theme/wclin_future/wclin_style/wclin_css.css" />
<link rel="stylesheet" type="text/css" href="wclin_comp/chat/default.css" />
<link rel="stylesheet" type="text/css" href="wclin_script/fancybox/jquery.fancybox-1.3.4.css" />
<link rel="stylesheet" type="text/css" href="wclin_theme/wclin_future/wclin_style/wclin_css_autocomplete.css" />
<style type="text/css">
#wclin_loader
{
	position:absolute;
	width:160px;
	height:24px;
	top:-24px;
	left:50%;
	margin:0 0 0 -84px;
	border:3px #FFF solid;
	background:url(wclin_theme/wclin_default/wclin_image/wclin_loader.gif) no-repeat rgba(255,255,255,1);
	
	-webkit-box-shadow:0 0 10px rgba(0,0,0,0.3);
	-moz-box-shadow:0 0 10px rgba(0,0,0,0.3);
	box-shadow:0 0 10px rgba(0,0,0,0.3);
	-webkit-border-bottom-right-radius:5px;
	-webkit-border-bottom-left-radius:5px;
	-moz-border-radius-bottomright:5px;
	-moz-border-radius-bottomleft:5px;
	border-bottom-right-radius:5px;
	border-bottom-left-radius:5px;
	-webkit-opacity:0px;
	-moz-opacity:0px;
	opacity:0;
	
	z-index:9999;
}
</style>
<script type="text/javascript" src="wclin_script/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="wclin_script/jquery-ui.min.js"></script>
<script type="text/javascript" src="wclin_script/jquery.form.js"></script>
<script type="text/javascript" src="wclin_script/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="wclin_script/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="wclin_script/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="wclin_script/jquery-tooltip.js"></script>
<script type="text/javascript" src="wclin_script/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript" src="wclin_script/jquery.jclock.js"></script>
<script type="text/javascript" src="wclin_script/jquery.cookie.js"></script>
<script type="text/javascript">
function wclinFancyBox()
{
	$('a#fancy_ajax').fancybox({
		'padding'     		: 1,
		'width'				: 'auto',
		'height'			: 'auto',
		'titleShow'     	: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
//		'transitionIn'		: 'elastic',
//		'transitionOut'		: 'elastic',
//		'easingIn'      	: 'easeOutBack',
//		'easingOut'     	: 'easeInBack',
		'overlayOpacity'	: '0',
		'scrolling'			: 'no',
		'autoScale'			: false,
		'showCloseButton'	: true
	});	
}
function wclinTooltip()
{
	$('#wclin_princ_list_load a').tooltip({ 
		track	: false, 
		delay	: 600, 
		showURL	: false, 
		fade	: 0
	});	
}
function wclin_pac_valid(input,color,len)
{
	$(input).css('background',color);
	$(input).focus();
	$(input).keyup(function(){
		length = $(this).val().length;
		if(length >= len)
		{
			$(this).css('background','rgba(255,255,255,1)')
		}
	});
}
function wclin_float_msg(msg,time)
{
	float_msg_c = $('body div#wclin_float_msg:last').attr('class');
		
	if(!float_msg_c) float_msg_c = 1; else float_msg_c = ((float_msg_c*1)+1);
	
	float_msg_t = ((float_msg_c*1)*10);
	float_msg = '<div id="wclin_float_msg" class="'+float_msg_c+'">'+msg+'</div>';
	
	$('body').append(float_msg);
	
	$('body div#wclin_float_msg:last').animate({right:'30px',top:float_msg_t+'px',opacity:'1'},300,function(){
		$('body div#wclin_float_msg').animate({opacity: '+=0'}, 1000,function(){
			$(this).animate({top:'-80px',opacity:'0'},1000,function(){
				$(this).remove();
			});
		});
	});
}
$(document).ready(function(){
		
	wclin_acs = <?php print $wclin_usr_acs; ?>;
	if(wclin_acs)
	{
		$.post('core_princ.php',{'wclin_act':''},function(data){
			$('#wclin_content').fadeOut(300,function(){
				$(this).html(data).fadeIn(600);
				wclinFancyBox();
			});
		});		
	}
	else
	{
		$('#wclin_loader').animate({'opacity':'1','top':'0px'},100,function(){
			$.post('core_login.php',{'wclin_act':'login'},function(data){
				$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
					$('#wclin_content').html(data).fadeIn(600);
					$('input[name=wclin_login]').focus();
				});
			});	
		});
	}
});
</script>

</head>

<body>
    <div id="wclin_loader"></div>
    <div id="wclin_content"></div>
</body>
</html>