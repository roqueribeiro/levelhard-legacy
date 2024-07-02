<?php

	$snd_cod = 1;

?>
<link rel="stylesheet" href="components/chat/default.css" />
<script type="text/javascript" src="components/chat/scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="components/chat/scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="components/chat/scripts/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#chat-user').disableSelection();
	if($('input[name=rec_cod]').val() == '') $('#chat-user').slideDown(0);
	
	setInterval(function(){
		$.get('components/chat/core.php',{'action':'usrList','snd_cod':'<?php print $snd_cod ?>'},function(data){
			$('#user-list').html(data);
			$('#user-list a').click(function(){
				$('input[name=rec_cod]').val($(this).attr('id'));
				$('#chat-status').html('Conversando com '+$(this).attr('class'));
				$('#chat-user').slideUp(300,function(){
					setInterval(function(){
						var rec_cod = $('input[name=rec_cod]').val();
						$.get('components/chat/core.php',{'action':'msgVis','snd_cod':'<?php print $snd_cod ?>','rec_cod':rec_cod});					
						$.get('components/chat/core.php',{'action':'msgLoad','snd_cod':'<?php print $snd_cod ?>','rec_cod':rec_cod},function(data){
							$('#chat-msg').html(data);
						});
					},300);
				});
			});
		});	
	},1000);

	$('#msg-emot img').click(function(){
		if($('#msg-emot-list').css('display')=='none')
		{
			$('#msg-emot-list').slideDown(300,function(){
				$('#msg-emot-list img').click(function(){
					$('input[name=chat_msg]').val($('input[name=chat_msg]').val()+$(this).attr('id'));
				});	
			});
		}
		else
		{
			$('#msg-emot-list').slideUp(300);
		}
	});
		
	$('form[name=chat_form]').ajaxForm({
		beforeSubmit: function()
		{
			if($('input[name=chat_msg]').val() == '')
				return false;
		},
		success: function()
		{
			$('input[name=chat_msg]').val('');
		} 
	});
	
	$('#chat-nav li').click(function(){
	
		nav_item = $(this).attr('id');
		
		switch(nav_item)
		{
			case 'online':
				$.get('components/chat/core.php',{'action':'usrStatus','snd_cod':'<?php print $snd_cod ?>','snd_status':'1'},function(){
					$('#chat-atual img').attr('src','components/chat/images/user-on.png');
				});
			break;
			case 'ocupado':
				$.get('components/chat/core.php',{'action':'usrStatus','snd_cod':'<?php print $snd_cod ?>','snd_status':'2'},function(){
					$('#chat-atual img').attr('src','components/chat/images/user-ocp.png');
				});
			break;
			case 'ausente':
				$.get('components/chat/core.php',{'action':'usrStatus','snd_cod':'<?php print $snd_cod ?>','snd_status':'3'},function(){
					$('#chat-atual img').attr('src','components/chat/images/user-aus.png');
				});
			break;
			case 'contato':
				$('#chat-user').slideDown(300,function(){
					$('#user-close').click(function(){
						$('#chat-user').slideUp(300);
					});
				});
			break;
		}
		
	});
	
});
</script>

<div id="chat-box">
    <div id="chat-cont">
        <div id="chat-atual"><img src="components/chat/images/user-on.png" width="24" height="24" alt="" /></div>
        <div id="chat-nav">
        <ul>
            <li id="">Status
                <ul>
                    <li id="online">Online</li>
                    <li id="ocupado">Ocupado</li>
                    <li id="ausente">Ausente</li>
                </ul>
            </li>
            <li id="contato">Contatos</li>
            <li id="">Opções
                <ul>
                    <li id="perfil">Perfil</li>
                    <li id="config">Configurações</li>
                </ul>
            </li>
        </ul>
        </div>
        <div id="chat-no">
            <div id="chat-user">
                <div id="user-close">Usuarios Online</div>
                <div id="user-list"></div>
            </div>
            <div id="chat-msg"></div>
            <div id="chat-status">Conversando em Grupo</div>
            <div id="chat-form">
            <form name="chat_form" action="components/chat/core.php" method="get">
            <input type="hidden" name="action" value="msgSend" />
            <input type="hidden" name="snd_cod" value="<?php print $snd_cod ?>" />
            <input type="hidden" name="rec_cod" value="" />
            <ul>
                <li>
                <input type="text" name="chat_msg">
                </li>
            </ul>
            </form>
            <div id="msg-emot-list">
            <ul>
                <li><img id="=)" alt="" src="components/chat/images/emoticon32/Happy.png" /></li>
                <li><img id="=>" alt="" src="components/chat/images/emoticon32/Smile.png" /></li>
                <li><img id="=/" alt="" src="components/chat/images/emoticon32/Sad.png" /></li>
                <li><img id="=(" alt="" src="components/chat/images/emoticon32/Angry.png" /></li>
                <li><img id="=0" alt="" src="components/chat/images/emoticon32/Surprised.png" /></li>
                <li><img id="=p" alt="" src="components/chat/images/emoticon32/tongue.png" /></li>
                <li><img id=";)" alt="" src="components/chat/images/emoticon32/Winking.png" /></li>
                <li><img id=":)" alt="" src="components/chat/images/emoticon32/Laughing.png" /></li>
                <li><img id=":(" alt="" src="components/chat/images/emoticon32/Crying.png" /></li>
                <li><img id="8)" alt="" src="components/chat/images/emoticon32/Cool.png" /></li>
                <li><img id="=8" alt="" src="components/chat/images/emoticon32/Blushing.png" /></li>
                <li><img id=":8" alt="" src="components/chat/images/emoticon32/Sick.png" /></li>
                <li><img id="8]" alt="" src="components/chat/images/emoticon32/Nerd.png" /></li>
                <li><img id="=]" alt="" src="components/chat/images/emoticon32/Smile Face.png" /></li>
            </ul>
            </div>
            <div id="msg-emot"><img src="components/chat/images/emoticon32/Happy.png" alt="" /></div>
            </div>
        </div>
    </div>
</div>