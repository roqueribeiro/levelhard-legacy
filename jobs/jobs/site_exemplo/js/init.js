
// ============= LevelHard init Funcions ============= //

			
//$("div").first().show("fast", function showNext() {
//	$(this).next("div").show("fast", showNext);
//});

// ============= Chama as Telas
function ajaxContextLoad(url,act)
{
	$.ajax({
		type		:'GET',
		url			:url,
		data		:{act:act},
		dataType	:'html',
		beforeSend	: function(){
			$('#preloader').show();
			$('#content #ajax').html('').hide();
		}
	}).done(function(data){
		
		$('#content #ajax').html(data);
		$('#gallery').jcarousel().disableSelection();
		$('#slider').nivoSlider();
		$('.fancybox').fancybox({
			scrolling : 'no',
			padding : '0',
			margin : 50,
			helpers : {
				thumbs: {
					width  : 50,
					height : 50
				}
			}
		});
		
		$('#content #ajax').fadeIn();
		$('#preloader').delay(600).fadeOut();
		
		$('.ajaxTooltip').tooltip({ 
			track: true, 
			delay: 0, 
			showURL: false, 
			showBody: " - ", 
			fade: 250 
		});
		
		$('body').getNiceScroll().resize();
		//$.scrollTo( '#container #menu', 600 );
		
	}).fail(function(){
		alert('Erro ao carregar! Tente Novamente');
	});
}

$(document).ready(function(e){
	
	// ============= Loader PlugIn
	$('body').queryLoader2({
		barColor			:'#FFF',
		backgroundColor		:'#222',
		percentage			:true,
		barHeight			:1,
		completeAnimation	:'grow',
		minimumTime			:300,
		onComplete			:function(){
			ajaxContextLoad('core.php','home');
		}
	});				
					
	//Desabilita Seleção
    $('#container #header, #container #footer').disableSelection();
	
	// ============= ScrollBar PlugIn
	$('body').niceScroll({
		cursorcolor			:'#111',
		cursoropacitymax	:0.6,
		cursorwidth			:8,
		cursorborder		:'none',
		cursorborderradius 	:'0px',
		boxzoom				:true,
		dblclickzoom 		:true,
		gesturezoom			:true,
		bouncescroll		:true,
		railpadding			:{top:3,right:3,left:3,bottom:3},
	});
	
	$('.homeTooltip').tooltip({ 
		track: true, 
		delay: 0, 
		showURL: false, 
		showBody: " - ", 
		fade: 250 
	});
	
	// ============= Menu e SubMenu Efeitos
	$('#menu ul li').hover(function(){
		$(this).animate({backgroundColor:'#DDD',borderColor:'#AAA'},{queue:false,duration:0});
		$('ul',this).stop(true, true).slideDown(300,'easeOutBack',function(){
			$('li',this).animate({'opacity':'1'},{queue:false,duration:300});
		});
	},function(){
		$(this).animate({backgroundColor:'#FFF',borderColor:'#FFF'},{queue:false,duration:300});
		$('ul li',this).animate({'opacity':'0'},{queue:false,duration:300});
		$('ul',this).stop(true, true).fadeOut(300);
	});
	
	// ============= Executa Chamadas do Menu e SubMenu
	$('#menu ul li, #logo').click(function(){
		if($(this).attr('class')) ajaxContextLoad('core.php',$(this).attr('class'));
	});
	
});