$(document).ready(function(){
		
	if($.browser.msie && $.browser.version != '9.0') window.location = 'http://navsupport.webrocky.com.br/?a[]=1&a[]=2&a[]=3&a[]=4&a[]=5';
	
	$('#social, #menu').disableSelection();
	
	function createGallery(galleryId,galleryName,galleryObs,galleryUrl)
	{
		var instanceOne = new ImageFlow();					
		$('input[name=action-data]').val(galleryId);
		$('#logo').animate({scale:[0.8]},1000);
		$('#corpo #menu').animate({'opacity':'0','bottom':'-100px'},600);
		$('.logo-active, #info, #social').animate({'opacity':'0'},600,function(){ $(this).hide(); });
		$('.logo-focus').animate({'opacity':'1'},600,function(){
			$('#overlay, #overlay-close, #galeria').fadeIn(300);
			$('#conteudo #galeria').html('<div id="cabecalho">'+galleryName+'<p>'+galleryObs+'</p></div><div id="images"></div>');
			$.post('core.php',{'action':'gallery','typeGal':galleryUrl},function(data){
				$('#menu-overlay').hide();
				$('#conteudo #galeria #images').html(data);
				instanceOne.init({ 
					ImageFlowID		: 'myImageFlow', 
					imageCursor		: 'pointer',
					circular		: true,
					buttons			: true,
					reflectionPNG	: 'reflect3.php',
					onClick			: function(){
						$.fancybox.open({
							href 		: this.url,
							type 		: 'iframe',
							width		: '100%',
							height		: '100%',
							margin		: 30,
							padding		: 0,
							helpers 	: {
								overlay : {
									opacity : '0.6'
								}
							}
						});
					}
				});
			});
		});
	}
	
	$('#corpo #overlay-close').hover(function(){
		$(this).animate({
			'opacity'	:'1'
		},{
			queue		:false,
			duration	:300
		});
	},function(){
		$(this).animate({
			'opacity'	:'0.6'
		},{
			queue		:false,
			duration	:300
		});
	});
	
    $('#corpo #menu li').hover(function(){
		if($('.pri',this).attr('id') != 0)
		{
			$('.pri',this).css('z-index','15').animate({
				paddingBottom	:'15px',
				bottom			:'0px',
				boxShadow		:'0 0 25px rgba(0,0,0,0.8)'
			},{
				queue			:false,
				duration		:300,
				complete		:function(){
					
				}
			});
		}
		else
		{
			$('ul',this).animate({
				bottom			:'85px',
				opacity			:'1',
				boxShadow		:'0 -5px 25px rgba(0,0,0,0.6)'
			},{
				queue			:false,
				duration		:300
			});
		}
	},function(){
		if($('.pri',this).attr('id') != 0)
		{
			$('.pri',this).css('z-index','10').animate({
				paddingBottom	:'0px',
				bottom			:'0px',
				boxShadow		:'none'
			},{
				queue			:false,
				duration		:300
			});
		}
		else
		{
			$('ul',this).animate({
				bottom			:'-100px',
				opacity			:'0',
				boxShadow		:'none'
			},{
				queue			:false,
				duration		:600
			});
		}
	});
		
	$('#corpo #social li').hover(function(){
		$(this).animate({
			opacity		:'1',
			boxShadow	:'0 0 30px rgba(0,0,0,0.6)'
		},{
			queue		:false,
			duration	:300
		});
	},function(){
		$(this).animate({
			opacity		:'0.3',
			boxShadow	:'none'
		},{
			queue		:false,
			duration	:300
		});
	});
	
	$('#corpo #social #button').hover(function(){
		$('p',this).animate({
			color		:'#c67329'
		},{
			queue		:false,
			duration	:300
		});
	},function(){
		$('p',this).animate({
			color		:'#FFF'
		},{
			queue		:false,
			duration	:300
		});
	});
	
	$('#corpo #social #button').click(function(){
		if($(this).parent().css('top') != '0px')
		{
			$('p',this).html('Fechar Social');
			$(this).parent().animate({
				top			:'0px'
			},{
				queue		:false,
				duration	:800,
				easing		:'easeOutBounce',
				complete	:function(){
					$('ul',this).animate({
						opacity		:'1'
					},{
						queue		:false,
						duration	:300
					});
				}
			});
		}
		else
		{
			$('p',this).html('Mostrar Social');
			$(this).parent().animate({
				top			:'-350px'
			},{
				queue		:false,
				duration	:800,
				easing		:'easeInBack',
				complete	:function(){
					$('ul',this).css({'opacity':'0'});
				}
			});
		}
	});
	
	$('#menu div, #overlay-close').click(function(){
				
		if(!$('input[name=action-data]').val())
		{
			if($(this).attr('id') == '1')
			{
				$('#menu-overlay').show();
				
				if($('.logo-focus').css('opacity')!=1)
				{
					var galleryId	= $(this).attr('id');
					var galleryName = 'Sites Roda Pião';
					var galleryObs 	= 'Tecnologias mais recentes como HTML5, jQuery, CSS3, PHP5 e Mais.<br /><br />Confira Alguns Desenvolvimentos';
					var galleryUrl	= 'websites'
					
					createGallery(galleryId,galleryName,galleryObs,galleryUrl);
				}
			}
			if($(this).attr('id') == '2')
			{
			}
			if($(this).attr('id') == '3')
			{
			}
			if($(this).attr('id') == '4')
			{
			}
			if($(this).attr('id') == '5')
			{
				$('#menu-overlay').show();
				
				if($('.logo-focus').css('opacity')!=1)
				{
					var galleryId	= $(this).attr('id');
					var galleryName = 'Artes Para Impressos';
					var galleryObs 	= '';
					var galleryUrl	= 'impressos'
					
					createGallery(galleryId,galleryName,galleryObs,galleryUrl);
				}
			}
			if($(this).attr('id') == '6')
			{
			}
			if($(this).attr('id') == '7')
			{
				$.fancybox.open({
					href 		: 'http://admin.estudiorodapiao.com.br',
					type 		: 'iframe',
					width		: '100%',
					height		: '100%',
					margin		: 30,
					padding		: 1,
					helpers 	: {
						overlay : {
							opacity : '0.6'
						}
					}
				});			
			}
			if($(this).attr('id') == '8')
			{
				$('#menu-overlay').show();
			
				if($('#contato').css('right')!='0px')
				{
					$('input[name=action-data]').val($(this).attr('id'));
					$('#logo').animate({scale:[0.8]},1000);
					$('.logo-active, #info, #social').animate({'opacity':'0'},600,function(){ $(this).hide(); });
					$('.logo-focus').animate({'opacity':'1'},600,function(){
						$('#overlay, #overlay-close').fadeIn(300,function(){
							$('#contato').animate({'right':'0px','opacity':'1'},{queue:false,duration:600,specialEasing:{
								right		: 'easeOutBack',
								opacity		: 'linear'
							},complete:function(){
								$('#menu-overlay').hide();
								$('input[name=nome]').focus();
							}});
						});
					});
				}				
			}
		}
		else
		{
			if($('input[name=action-data]').val()>0 && $('input[name=action-data]').val()<6)
			{
				$('#menu-overlay').show();
				$('input[name=action-data]').val('');
				$('#conteudo #galeria #cabecalho, #conteudo #galeria #images').remove();
							
				$('#logo').animate({scale:[1]},1000);
				$('#corpo #menu').animate({'opacity':'1','bottom':'0px'},600);
				$('#overlay, #overlay-close').fadeOut(600);
				
				$('.logo-focus').animate({'opacity':'0'},600);
				$('.logo-active, #info, #social').show().animate({'opacity':'1'},600,function(){
					$('#menu-overlay').hide();
				});
			}
			if($('input[name=action-data]').val()==8)
			{
				$('#menu-overlay').show();
				$('input[name=action-data]').val('');
				$('#contato').animate({
					right			:'-1000px',
					opacity			:'0'
				},{
					queue			:false,
					duration		:600,
					specialEasing	:{
						right			: 'easeInBack',
						opacity			: 'linear'
					},
					complete		:function(){
						$('#logo').animate({scale:[1]},1000);
						$('#overlay, #overlay-close').fadeOut(600);
						$('.logo-focus').animate({'opacity':'0'},600);
						$('.logo-active, #info, #social').show().animate({'opacity':'1'},600,function(){
							$('#menu-overlay').hide();	
						});
					}	
				});
			}			
		}
	});
	
	$('#open-msn').fancybox({
		type 		: 'iframe',
		width		: 550,
		height		: 420,
		margin		: 30,
		padding		: 0,
		scrolling	: 'no',
		helpers 	: {
			overlay : {
				opacity : '0.6'
			}
		}
	});			
		
	$('.logo-active').css({'opacity':'0'});
	$('.logo-focus').css({'opacity':'1'});
	$('#logo').transform({scale:[0.8]});
	$('#corpo #menu').css({'opacity':'0','bottom':'-100px'});
	$('#corpo #social').css({'opacity':'0','top':'-450px'});
	$('#info').css({'opacity':'0'});
	$('#overlay, #loader').css('z-index','999').show();
	window.onload = function(){
		$('#overlay, #loader').fadeOut(300,function(){
			$(this).css('z-index','10');
			$('#corpo #menu').animate({'opacity':'1','bottom':'0px'},600);
			$('#corpo #social').animate({'opacity':'1','top':'-350px'},600);
			$('.logo-active').animate({'opacity':'1'},600);
			$('.logo-focus').animate({'opacity':'0'},600);
			$('#logo').animate({scale:[1]},600,function(){
				$('#info').animate({'opacity':'1'},600);
				$('#menu-overlay').hide();
			});
		});
	};
	
});
