<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>jBarata</title>
<link rel="stylesheet" href="style.css">
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	if(!$.browser.webkit)
		window.location = 'http://navsupport.webrocky.com.br/?a[]=1&a[]=5';
			
	//Configurações	
	var optConsole 	= false;
	var KeyPresType	= 'keyup';
	var MoveEase 	= '';
	var MoveVel 	= 10;
	var MoveEff 	= 100;
	var MoveAutoEff	= 500;
	var nTop		= 0;
	var funcEnter	= 0;
	var destroyObj	= new Array();
		
	//============================ Menu Lateral
	$('#menu li').hover(function(){
		$(this).stop().animate({'padding-left':'-20px','opacity':'1'},1000);	
	},function(){
		$(this).stop().animate({'padding-left':'10px','opacity':'0.3'},300);	
	});
	$('#menu li').live({
		click: function(){
			if( $(this).attr('class') == 'iniciar' )
			{
				ActiveGame(e='iniciar')
			}
			if( $(this).attr('class') == 'restart' )
			{
				ActiveGame(e='restart');
			}
			if( $(this).attr('class') == 'console' )
			{
				ActiveGame(e='console');
			}
			if( $(this).attr('class') == 'gravar' || $(this).attr('class') == 'painel' )
			{
				$('#wrap').fadeIn(300,function(){
					$('#box').animate({'left':'2%'},600,'easeOutBack',function(){
						$('#loading').fadeIn(300,function(){
							$.get('core.php',{'action':'gravar'},function(data){ 
								$('#loading').fadeOut(300,function(){
									$('#box #texto').html(data);	
								});
							});
						});
					});
				});
			}
		},
	});
		
	$('body').bind(KeyPresType,function(e){	ActiveGame(e); });
	
	function ActiveGame(e)
	{
		
		var xSize 	= $('#objeto').css('width');
		var ySize 	= $('#objeto').css('height');
		var ObjTop 	= $('#objeto').css('top');
		var ObjLeft = $('#objeto').css('left');
		
		if(e.keyCode == 49){ MoveAutoEff = 250; }
		if(e.keyCode == 50){ MoveAutoEff = 500; }
		if(e.keyCode == 51){ MoveAutoEff = 1000; }
		
		if($('div#objetoAuto').length != 0)
		{
										
			//============================ Controles
			if(e.keyCode == 38 || e.keyCode == 87)
			{//Cima
				if(ObjTop == '0%' || ObjTop < '0%')
				{
					$('body').unbind(KeyPresType);
					$('#objeto').stop().animate({'top':'0%'},MoveEff,MoveEase,function(){ 
						$('body').bind(KeyPresType,function(e){	ActiveGame(e); });
					});
				}
				else
				{
					$('body').unbind(KeyPresType);
					$('#objeto').stop().animate({'top':'-='+MoveVel+'%'},MoveEff,MoveEase,function(){ 
						$('body').bind(KeyPresType,function(e){	ActiveGame(e); });
					});
				}
			}
			if(e.keyCode == 40 || e.keyCode == 83)
			{//Baixo
				if(ObjTop > '75%')
				{
					$('#wrap').fadeIn(300,function(){
						$('#box').stop().animate({'left':'2%'},MoveAutoEff,'easeOutBack',function(){
						
							$('#loading').fadeIn(300,function(){
								$.get('core.php',{'action':'win'},function(data){
									$('#loading').fadeOut(300,function(){
										$('#box #texto').html(data);
									});
								});
							});
							
						});
					});
					
				}
				
				if(ObjTop == '90%' || ObjTop > '90%')
				{
					$('body').unbind(KeyPresType);
					$('#objeto').stop().animate({'top':'90%'},MoveEff,MoveEase,function(){ 
						$('body').bind(KeyPresType,function(e){	ActiveGame(e); });
					});
				}
				else
				{
					$('body').unbind(KeyPresType);
					$('#objeto').stop().animate({'top':'+='+MoveVel+'%'},MoveEff,MoveEase,function(){ 
						$('body').bind(KeyPresType,function(e){	ActiveGame(e); });
					});
				}
			}
			if(e.keyCode == 37 || e.keyCode == 65)
			{//Esquerda
				if(ObjLeft == '0%' || ObjLeft < '0%')
				{
					$('body').unbind(KeyPresType);
					$('#objeto').stop().animate({'left':'0%'},MoveEff,MoveEase,function(){ 
						$('body').bind(KeyPresType,function(e){	ActiveGame(e); });
					});
				}
				else
				{
					$('body').unbind(KeyPresType);
					$('#objeto').stop().animate({'left':'-='+MoveVel+'%'},MoveEff,MoveEase,function(){ 
						$('body').bind(KeyPresType,function(e){	ActiveGame(e); });
					});
				}
			}
			if(e.keyCode == 39 || e.keyCode == 68)
			{//Direita
				if(ObjLeft == '90%' || ObjLeft > '90%')
				{
					$('body').unbind(KeyPresType);
					$('#objeto').stop().animate({'left':'90%'},MoveEff,MoveEase,function(){ 
						$('body').bind(KeyPresType,function(e){	ActiveGame(e); });
					});
				}
				else
				{
					$('body').unbind(KeyPresType);
					$('#objeto').stop().animate({'left':'+='+MoveVel+'%'},MoveEff,MoveEase,function(){ 
						$('body').bind(KeyPresType,function(e){	ActiveGame(e); });
					});
				}
			}
			
		}
		if(e.keyCode == 192 || e == 'console')
		{//Console
			if(optConsole == false)
				$('#console').fadeIn(600,function(){ optConsole = true });
			else
				$('#console').fadeOut(600,function(){ optConsole = false });
		}	
		if(e.keyCode == 82 || e == 'restart')
		{//Reiniciar Jogo
			$('body').unbind(KeyPresType);
			$('#wrap').fadeIn(300,function(){
				$('#loading').fadeIn(300,function(){
					$('div#objetoAuto').fadeOut(300,function(){
						$(this).remove();
						$('#console #objauto div').remove();
					});
					$('#box').stop().animate({'left':'-100%'},600,'easeInBack',function(){
						$('#loading').fadeOut(300,function(){
							$('#box #texto').html('');
							$('#wrap').fadeOut(300);	
						});
					});
				});
				destroyObject();
			});
		}	
		
		//============================ Animação
		if(e.keyCode == 32 || e == 'iniciar')
		{//ObjetoAutomatico
			
			length 	= $('div#objetoAuto').length;
			if(length == 0) nTop = 0;
			
			nTop = nTop+10;
			
			if(length <= 7)
			{//Insere ObjetoAutomatico
				html = '<div id="objetoAuto" class="objetoAuto_'+length+'" style="top:'+nTop+'%"><img src="images/vassoura.png" alt="" /></div>';
				$('body').append(html);
				
				$('#console #objauto').append('<div id="consoleObj_'+length+'"></div>');
								
				animeObject(MoveAutoEff,MoveEase,length);
			}
		}		
		
		$('#console #button').html('<div>'+e.type+'='+e.keyCode+' - '+ObjTop+ObjLeft+' - '+xSize+ySize+nTop+'</div>');
		
	}
		
	function destroyObject()
	{//Funções destroi Objeto
		$('#objeto').stop().animate({'top':'0%','left':'40%'},MoveAutoEff,MoveEase,function(){
			$('#objeto img').css({'width':'120%','height':'80%','margin-top':'10%','margin-left':'-10%'}).attr('src','images/barata.gif').fadeIn(300,function(){
				$('body').bind(KeyPresType,function(e){	ActiveGame(e); });
			});
		});
	}
	
	function animeObject(MoveAutoEff,MoveEase,MoveClass)
	{//Funções do ObjetoAutomatico
							
		destroyObj[MoveClass] = false;
							
		$('.objetoAuto_'+MoveClass).animate({'left':'90%'},{
			'duration':MoveAutoEff,
			'easing':MoveEase,
			'step':function(){
				
				yPosAuto 	= $(this).css('top');
				xPosAuto 	= $(this).css('left');
				ObjTop 		= $('#objeto').css('top');
				ObjLeft 	= $('#objeto').css('left');
				
				n_yPosAuto 	= parseInt(yPosAuto.substring(0,(yPosAuto.length - 1)),10);
				n_xPosAuto 	= parseInt(xPosAuto.substring(0,(xPosAuto.length - 1)),10);
				n_ObjTop 	= parseInt(ObjTop.substring(0,(ObjTop.length - 1)),10);
				n_ObjLeft 	= parseInt(ObjLeft.substring(0,(ObjLeft.length - 1)),10);
				
				if(n_yPosAuto == n_ObjTop)
				{
					if(n_xPosAuto <= n_ObjLeft)
					{
						destroyObj[MoveClass] = true;
						$('body').unbind(KeyPresType);
						$('#objeto img').css({'width':'150%','height':'150%','margin-top':'-20%','margin-left':'-20%'}).attr('src','images/error.png').fadeOut(300);
					}
				}
				
			$('#console #consoleObj_'+MoveClass).html('destroyObj['+MoveClass+']'+destroyObj[MoveClass]+' n_yPosAuto: '+n_yPosAuto+' n_xPosAuto: '+n_xPosAuto+' n_ObjTop: '+n_ObjTop+' n_ObjLeft: '+n_ObjLeft);
																						
			},
			'complete':function(){
				
				$(this).animate({'left':'-10%'},{
					'duration':MoveAutoEff,
					'easing':MoveEase,
					'step':function(){
						
						yPosAuto 	= $(this).css('top');
						xPosAuto 	= $(this).css('left');
						ObjTop 		= $('#objeto').css('top');
						ObjLeft 	= $('#objeto').css('left');
						
						n_yPosAuto 	= parseInt(yPosAuto.substring(0,(yPosAuto.length - 1)),10);
						n_xPosAuto 	= parseInt(xPosAuto.substring(0,(xPosAuto.length - 1)),10);
						n_ObjTop 	= parseInt(ObjTop.substring(0,(ObjTop.length - 1)),10);
						n_ObjLeft 	= parseInt(ObjLeft.substring(0,(ObjLeft.length - 1)),10);
						
						if(n_yPosAuto == n_ObjTop)
						{
							if(n_xPosAuto <= n_ObjLeft)
							{
								destroyObj[MoveClass] = true;
								$('body').unbind(KeyPresType);
								$('#objeto img').css({'width':'150%','height':'150%','margin-top':'-20%','margin-left':'-20%'}).attr('src','images/error.png').fadeOut(300);
							}
						}
						
					$('#console #consoleObj_'+MoveClass).html('destroyObj['+MoveClass+']'+destroyObj[MoveClass]+' n_yPosAuto: '+n_yPosAuto+' n_xPosAuto: '+n_xPosAuto+' n_ObjTop: '+n_ObjTop+' n_ObjLeft: '+n_ObjLeft);
				
					},
					'complete':function(){
						animeObject(MoveAutoEff,MoveEase,MoveClass);
					}
				});
			}
		});
			
		if(destroyObj[MoveClass]) destroyObject();
	}
	
});
</script>
</head>
<body>
	<div id="loading"><img src="images/loader.gif" alt=""></div>
    <div id="wrap"></div>
    <div id="logo">jBeta</div>
    <div id="gradient"></div>
    
	<div id="menu">
    	<ul>
        	<li class="iniciar"><img src="images/config/default/start64.png" alt=""></li>
        	<li class="restart"><img src="images/config/default/order64.png" alt=""></li>
            <li class="console"><img src="images/config/default/unit64.png" alt=""></li>
            <!--
            <li class="gravar"><img src="images/config/default/billboard64.png" alt=""></li>
            <li class="painel"><img src="images/config/default/maintenance64.png" alt=""></li>
            -->
        </ul>
    </div>
    
    <div id="box"><div id="cabecalho">WebRoCkY Games</div><div id="texto"></div></div>
    <div id="console"><span id="button"></span><span id="objauto"></span></div>
    <div id="objeto"><img src="images/barata.gif" alt=""></div>
</body>
</html>