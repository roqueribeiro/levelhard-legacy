$(document).ready(function(){
	
	if($.browser.msie && $.browser.version != '9.0') window.location = 'http://browser.levelhard.com/?a[]=1&a[]=2&a[]=3&a[]=4&a[]=5';
	
	window.onload = function(){
		$('#wrap').fadeOut(300);
	}
		
	$('#corpo #cabecalho #navegacao ul li').transform({rotate:'-50deg'});
	$('#corpo #cabecalho #navegacao ul li img').transform({rotate:'50deg'});
	$('#corpo #cabecalho #navegacao ul li[value=1]').addClass('nav-active');
	$('#corpo #centro #conteudo li[value!=1]').css({'display':'none','opacity':'0'});	
	
	$('#corpo #cabecalho #navegacao ul li').hover(function(){
		$(this).animate({ backgroundColor: '#111' },{ queue:false, duration:600 });
	},function(){
		$(this).animate({ backgroundColor: '#5D5D5D' },{ queue:false, duration:600 });
	});
	
	$('#button-next, #button-prev').hover(function(){
		$(this).animate({ boxShadow: '0 0 50px rgba(0,0,0,0.3)' },{ queue:false, duration:600 });
	},function(){
		$(this).animate({ boxShadow: '0 0 20px rgba(0,0,0,0.1)' },{ queue:false, duration:600 });
	});
		
	var pagCount = 1;
	
	$('#button-next, #button-prev').click(function(){
		
		if(pagCount>=0&&pagCount<=4)	
		{
			if($(this).attr('class')==2)
			{
				if(pagCount!=4)
					pagCount = pagCount+1;
				else
					pagCount = 1;
					
				$('#wrap').show();
				$('#corpo #centro #cabecalho p').text($('#corpo #centro #conteudo li[value='+pagCount+']').attr('title'));
				$('#corpo #cabecalho #navegacao ul li[value='+pagCount+']').addClass('nav-active');
				$('#corpo #cabecalho #navegacao ul li[value='+pagCount+'] img').attr('src','images/menu-checked.png');
				$('#corpo #cabecalho #navegacao ul li[value!='+pagCount+']').removeClass('nav-active');
				$('#corpo #cabecalho #navegacao ul li[value!='+pagCount+'] img').attr('src','images/menu-check.png');
				$('#corpo #centro #conteudo li[value!='+pagCount+']').animate({ opacity: '0', height:'0px', scale:[0] },{ duration:1000, complete:function(){ $(this).hide(); $('#wrap').hide(); } });
				$('#corpo #centro #conteudo li[value='+pagCount+']').css({'display':'block','opacity':'0'}).animate({ opacity: '1', height:'100%', scale:[1] },{ duration:1000 });
			}
			
			if($(this).attr('class')==1)
			{
				if(pagCount!=1)
					pagCount = pagCount-1;
				else
					pagCount = 4;
				
				$('#wrap').show();
				$('#corpo #centro #cabecalho p').text($('#corpo #centro #conteudo li[value='+pagCount+']').attr('title'));
				$('#corpo #cabecalho #navegacao ul li[value='+pagCount+']').addClass('nav-active');
				$('#corpo #cabecalho #navegacao ul li[value='+pagCount+'] img').attr('src','images/menu-checked.png');
				$('#corpo #cabecalho #navegacao ul li[value!='+pagCount+']').removeClass('nav-active');
				$('#corpo #cabecalho #navegacao ul li[value!='+pagCount+'] img').attr('src','images/menu-check.png');
				$('#corpo #centro #conteudo li[value!='+pagCount+']').animate({ opacity: '0', height:'0px', scale:[0] },{ duration:1000, complete:function(){ $(this).hide(); $('#wrap').hide(); } });
				$('#corpo #centro #conteudo li[value='+pagCount+']').css({'display':'block','opacity':'0'}).animate({ opacity: '1', height:'100%', scale:[1] },{ duration:1000 });
			}
		}
		
		$('#pagination').text(pagCount);
				
	});
		
	$('#corpo #cabecalho #navegacao ul li').click(function(){
				
		if($(this).val()==1)
		{
			pagCount = 1; 
			
			$('#corpo #centro #cabecalho p').text($('#corpo #centro #conteudo li[value=1]').attr('title'));
			
			$('#wrap').show();
			$('#corpo #cabecalho #navegacao ul li[value=1]').addClass('nav-active');
			$('#corpo #cabecalho #navegacao ul li[value=1] img').attr('src','images/menu-checked.png');
			$('#corpo #cabecalho #navegacao ul li[value!=1]').removeClass('nav-active');
			$('#corpo #cabecalho #navegacao ul li[value!=1] img').attr('src','images/menu-check.png');
			$('#corpo #centro #conteudo li[value!=1]').animate({ opacity: '0', height:'0px', scale:[0] },{ duration:1000, complete:function(){ $(this).hide(); $('#wrap').hide(); } });
			$('#corpo #centro #conteudo li[value=1]').css({'display':'block','opacity':'0'}).animate({ opacity: '1', height:'100%', scale:[1] },{ duration:1000 });
		}
		if($(this).val()==2)
		{
			pagCount = 2; 
			
			$('#corpo #centro #cabecalho p').text($('#corpo #centro #conteudo li[value=2]').attr('title'));
			
			$('#wrap').show();
			$('#corpo #cabecalho #navegacao ul li[value=2]').addClass('nav-active');
			$('#corpo #cabecalho #navegacao ul li[value=2] img').attr('src','images/menu-checked.png');
			$('#corpo #cabecalho #navegacao ul li[value!=2]').removeClass('nav-active');
			$('#corpo #cabecalho #navegacao ul li[value!=2] img').attr('src','images/menu-check.png');
			$('#corpo #centro #conteudo li[value!=2]').animate({ opacity: '0', height:'0px', scale:[0] },{ duration:1000, complete:function(){ $(this).hide(); $('#wrap').hide(); } });
			$('#corpo #centro #conteudo li[value=2]').css({'display':'block','opacity':'0'}).animate({ opacity: '1', height:'100%', scale:[1] },{ duration:1000 });
		}
		if($(this).val()==3)
		{
			pagCount = 3; 
			
			$('#corpo #centro #cabecalho p').text($('#corpo #centro #conteudo li[value=3]').attr('title'));
			
			$('#wrap').show();
			$('#corpo #cabecalho #navegacao ul li[value=3]').addClass('nav-active');
			$('#corpo #cabecalho #navegacao ul li[value=3] img').attr('src','images/menu-checked.png');
			$('#corpo #cabecalho #navegacao ul li[value!=3]').removeClass('nav-active');
			$('#corpo #cabecalho #navegacao ul li[value!=3] img').attr('src','images/menu-check.png');
			$('#corpo #centro #conteudo li[value!=3]').animate({ opacity: '0', height:'0px', scale:[0] },{ duration:1000, complete:function(){ $(this).hide(); $('#wrap').hide(); } });
			$('#corpo #centro #conteudo li[value=3]').css({'display':'block','opacity':'0'}).animate({ opacity: '1', height:'100%', scale:[1] },{ duration:1000 });
		}
		if($(this).val()==4)
		{
			pagCount = 4; 
			
			$('#corpo #centro #cabecalho p').text($('#corpo #centro #conteudo li[value=4]').attr('title'));
			
			$('#wrap').show();
			$('#corpo #cabecalho #navegacao ul li[value=4]').addClass('nav-active');
			$('#corpo #cabecalho #navegacao ul li[value=4] img').attr('src','images/menu-checked.png');
			$('#corpo #cabecalho #navegacao ul li[value!=4]').removeClass('nav-active');
			$('#corpo #cabecalho #navegacao ul li[value!=4] img').attr('src','images/menu-check.png');
			$('#corpo #centro #conteudo li[value!=4]').animate({ opacity: '0', height:'0px', scale:[0] },{ duration:1000, complete:function(){ $(this).hide(); $('#wrap').hide(); } });
			$('#corpo #centro #conteudo li[value=4]').css({'display':'block','opacity':'0'}).animate({ opacity: '1', height:'100%', scale:[1] },{ duration:1000 });
		}
		
		$('#pagination').text(pagCount);

	});
	
	$('input[type=button]').click(function(){
		
		button_val = $(this).attr('alt');
		
		$.fancybox.open({
			href 		: button_val,
			type 		: 'iframe',
			width		: '100%',
			height		: '100%',
			margin		: 60,
			padding		: 5,
			helpers 	: {
				overlay : {
					opacity : '0.1'
				}
			}
		});
		
	});
	
});