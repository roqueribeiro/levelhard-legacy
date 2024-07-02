<script type="text/javascript">
$(document).ready(function(){
	$('#chatmin').click(function(){
		alt = $(this);
		if( alt.attr('alt') == 0 )
		{
			alt.attr('alt',1);
			$('.chat_msg, .chat_snd, .wrocky_chat_msgs').slideUp(300);
		}
		else
		{
			alt.attr('alt',0);
			$('.chat_msg, .chat_snd, .wrocky_chat_msgs').slideDown(300,function(){
				$('#chatmsg').focus();
			});
		}
	});
});
</script>

<div class="wrocky_chat_logo">
    <ul>
        <li><a href="javascript:void(0);" id="chatmin" alt="1">WebRoCkY Mural</a></li>
    </ul>
</div>

<div class="wrocky_chat_msgs" id="chatwindow" style="display:none;"></div>

<div class="wrocky_chat_form">
    <ul style="display:none;">
        <li><input type="text" id="chatnick" disabled="disabled" size="1"/></li>
    </ul>
    <ul class="chat_msg" style="display:none;">
        <li><input type="text" id="chatmsg" maxlength="80" placeholder="Digite Sua Mensagem..." onkeyup="keyup(event.keyCode);" /></li>
    </ul>
    <ul class="chat_snd" style="display:none;">
        <li><input type="button" alt="0" value="Enviar Mensagem" onClick="submit_msg();" /></li>
    </ul>        
</div>

<script type="text/javascript">
 
	var waittime	= 300;		

	chatmsg.focus()
	document.getElementById("chatwindow").innerHTML = "Carregando...";

	var xmlhttp 	= false;
	var xmlhttp2 	= false;

function ajax_read(url) 
{
	if(window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
		if(xmlhttp.overrideMimeType)
		{
			xmlhttp.overrideMimeType('text/xml');
		}
	} 
	else if(window.ActiveXObject)
	{
		try
		{
			xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch(e) 
		{
			try
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			} 
			catch(e)
			{
			}
		}
	}

	if(!xmlhttp) 
	{
		alert('Erro! Tente novamente mais tarde.');
		return false;
	}

	xmlhttp.onreadystatechange = function() 
	{
		if (xmlhttp.readyState==4) 
		{
			document.getElementById("chatwindow").innerHTML = xmlhttp.responseText;
	
			zeit = new Date(); 
			ms = (zeit.getHours() * 24 * 60 * 1000) + (zeit.getMinutes() * 60 * 1000) + (zeit.getSeconds() * 1000) + zeit.getMilliseconds(); 
			intUpdate = setTimeout("ajax_read('wrocky_act/wrocky_chat/chat.txt?x=" + ms + "')", waittime)
		}
	}

	xmlhttp.open('GET',url,true);
	xmlhttp.send(null);
}

function ajax_write(url)
{
	if(window.XMLHttpRequest)
	{
		xmlhttp2=new XMLHttpRequest();
		if(xmlhttp2.overrideMimeType)
		{
			xmlhttp2.overrideMimeType('text/xml');
		}
	} 
	else if(window.ActiveXObject)
	{
		try
		{
			xmlhttp2=new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch(e) 
		{
			try
			{
				xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
			}
		}
	}

	if(!xmlhttp2) 
	{
		alert('Erro! Tente novamente mais tarde.');
		return false;
	}

	xmlhttp2.open('GET',url,true);
	xmlhttp2.send(null);
}

function submit_msg()
{
	nick 	= document.getElementById("chatnick").value;
	msg 	= document.getElementById("chatmsg").value;

	if (nick == "") 
	{ 
		check = prompt("Digite seu Apelido:"); 
		if (check === null) return 0; 
		if (check == "") check = "Sem Nome"; 
		document.getElementById("chatnick").value = check;
		nick = check;
	} 

	document.getElementById("chatmsg").value = "";
	ajax_write("wrocky_act/wrocky_chat/action.php?m=" + msg + "&n=" + nick);
}

function keyup(arg1) 
{ 
	if (arg1 == 13) submit_msg(); 
}

var intUpdate = setTimeout("ajax_read('wrocky_act/wrocky_chat/chat.txt')", waittime);

</script>
