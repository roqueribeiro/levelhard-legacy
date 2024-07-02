<?php require "wrocky_chat/database.php"; ?>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#wrocky_chat_msgs').hide();
	$('.chat_msg').hide();
	$('.chat_snd').hide();
	$('#chat_min').attr({ 'alt'	: 1, 'value' : 'Maximizar',	})
	
	$('#wrocky_chat_msgs').load('wrocky_act/wrocky_chat/actions/msg_show.php',function(){
		setTimeout(function(){ 
			$('#wrocky_chat_msgs').load('wrocky_act/wrocky_chat/actions/msg_show.php'); 
		},500);
	});
	
	$('form[name=sendmsg]').ajaxForm({
        success: function(){
			$('textarea[name=chat_msg]').val('');
        } 
    });
	
	$('#chat_min').click(function(){
		
		alt = $(this).attr('alt');
		if( alt == 0 )
		{
			$('#wrocky_chat_msgs').slideUp(300);
			$('.chat_msg').slideUp(300);
			$('.chat_snd').slideUp(300);
			$(this).attr({
				'alt'	: 1,
				'value'	: 'Maximizar',
			})
		}
		else
		{
			$('#wrocky_chat_msgs').slideDown(300);
			$('.chat_msg').slideDown(300);
			$('.chat_snd').slideDown(300);
			$(this).attr({
				'alt'	: 0,
				'value'	: 'Minimizar',
			})
			$('textarea[name=chat_msg]').focus();
		}
		
	});
	
	isShift = false;
	$('textarea[name=chat_msg]').bind('keyup',function(e){
		if(e.keyCode==16) isShift = false;
	});	
	$('textarea[name=chat_msg]').bind('keydown',function(e){
		if(e.keyCode==16) isShift = true;
		if(isShift == true && e.keyCode==13)
		{
			return true;
		}
		if(isShift == false && e.keyCode==13)
		{
			$('form[name=sendmsg]').submit();
		}
	});	
		
});
</script>

<div id="wrocky_chat_msgs"></div>
<div id="wrocky_chat_form">
<form name="sendmsg" action="wrocky_act/wrocky_chat/actions/msg_send.php" method="post">
<ul>
    <li class="chat_msg"><textarea name="chat_msg"></textarea></li>
</ul>
<ul>
    <li class="chat_snd"><input type="submit" id="chat_snd" alt="0" value="Enviar" /></li>
    <li class="chat_min"><input type="button" id="chat_min" alt="0" value="Minimizar" /></li>
</ul>        
</form>
</div>
