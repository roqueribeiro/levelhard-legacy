$(document).ready(function(){
				
	$('div#icones').click(function(){
		
		current_v	= $('#show_video video');
		video_id 	= $('video', this).attr('id');
		video_src 	= $('video', this).attr('src');
		
		if(!current_v.attr('src'))
		{
			$(this).css('top','500px');
			$(this).css('width','0px');
			$(this).css('heigth','0px');
			$(this).css('margin-left','-25px');
			$(this).css('margin-rigth','-25px');
			$('#show_video p').html('HTML5 Videos').fadeIn(600);
			$('#show_video video').attr({
				'name':	video_id,
				'src':	video_src
			});
			$('#show_video video').get(0).load();
			$('#show_video video').get(0).play();
		}
		
	})
	
	$('input[name=fechar]').click(function(){
		
		current_v	= $('#show_video video');
		current_i	= $('.'+current_v.attr('name'));
		
		if($('#show_video').css('width') == '95%')
		{
			if(current_v.attr('src'))
			{
				current_v.attr('src','');
				current_v.get(0).pause();
				current_i.css('top','-20px');
				current_i.css('width','160px');
				current_i.css('heigth','90px');
				current_i.css('margin-left','25px');
				current_i.css('margin-rigth','25px');
				$('div#controls').css('opacity','0');
			}
			$('#show_video').css('width','50%');
			$('#show_video').css('height','50%');
			$('#show_video').css('top','15%');
			$('#show_video').css('left','25%');
			$('#show_video').css('background','rgba(255,255,255,0.2)');
			$('#show_video').css('-webkit-box-shadow','inset 0 0 300px rgba(255,255,255,0.8), 0 0 20px rgba(0,0,0,1)');
			
			$('input[name=fullscreen]').attr('value','Maximizar');
			
		}
		else
		{
			if(current_v.attr('src'))
			{
				current_v.attr('src','');
				current_v.get(0).pause();
				current_i.css('top','-20px');
				current_i.css('width','160px');
				current_i.css('heigth','90px');
				current_i.css('margin-left','25px');
				current_i.css('margin-rigth','25px');
				$('div#controls').css('opacity','0');
			}
		}
	});
		
	$('input[name=fullscreen]').click(function(){
		
		current_v = $('#show_video video');
						
		if($('#show_video').css('width') == '95%')
		{
			$('#show_video').css('width','50%');
			$('#show_video').css('height','50%');
			$('#show_video').css('top','15%');
			$('#show_video').css('left','25%');
			$('#show_video').css('background','rgba(255,255,255,0.2)');
			$('#show_video').css('-webkit-box-shadow','inset 0 0 300px rgba(255,255,255,0.8), 0 0 20px rgba(0,0,0,1)');
			
			$('input[name=fullscreen]').attr('value','Maximizar');
		}
		else
		{
			$('#show_video').css('width','95%');
			$('#show_video').css('height','95%');
			$('#show_video').css('top','2.5%');
			$('#show_video').css('left','2.5%');
			$('#show_video').css('background','rgba(0,0,0,0.8)');
			$('#show_video').css('-webkit-box-shadow','inset 0 0 300px rgba(0,0,0,0.9), 0 0 100px rgba(0,0,0,1)');
			
			$('input[name=fullscreen]').attr('value','Minimizar');
		}
		
	});
	
	$('div#icones').mouseover(function(){
		$(this).css('-webkit-transform','scale(1.4) translate(0,-12px)');
		$('video', this).get(0).muted=true;
		$('video', this).get(0).play();
	})
	
	$('div#icones').mouseout(function(){
		$(this).css('-webkit-transform','scale(1.0) translate(0,0)');
		$('video', this).get(0).pause();
	})
	
	$('video#current_video').mouseover(function(){
		if($(this).attr('src'))
		{
			$('div#controls').css('opacity','1');
		}
	});
	
	$('video#current_video').mouseout(function(){
		$('div#controls').css('opacity','0');
	});
	
	$('div#controls').mouseover(function(){
		if($('#show_video video').attr('src'))
		{
			$(this).css('opacity','1');
		}
		if($('#fullscreen video').attr('src'))
		{
			$(this).css('opacity','1');
		}
	});
	
});