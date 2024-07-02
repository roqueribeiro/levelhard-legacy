// ============= Default Functions jQuery ============= //

function preWindow(img,type)
{
	if(type==1)	text = '<b>Erro ao carregar!</b><br />Tente novamente mais tarde.';
	
	html  = '<div id="error" class="box">';
	html += '<div id="error-content">';
    html += '<ul>';
	html += '<li><img src="themes/default/images/prewin-icon/'+img+'.png" alt="" width="64" height="64"></li>';
	html += '<li>'+text+'</li>';
	html += '</ul>';
	html += '</div>';
	html += '</div>';
	
	$('#loader').animate({scale:[0],opacity:'0'},300,function(){
		$('#false-body').html(html);
		$('#error').css('opacity','0').transform({scale:[0]});
		$('#error').animate({
			scale			:[1],
			opacity			:'1'
		},{
			specialEasing	:{ 
				scale	:'easeOutBounce' 
			}, 
			duration		:1000
		});
	});
	
}