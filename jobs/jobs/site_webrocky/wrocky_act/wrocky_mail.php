<script type="text/javascript">
$(document).ready(function(){
	
	$('input[name=nome]').focus();
	
	$('#mail_form').ajaxForm({
		target: '#wrocky_form_ajax',
		beforeSubmit: function(){
			
			$('input[type=submit]').val('Enviando...');
			
			if(!$('input[name=nome]').attr('value'))
			{
				alert('Digite o seu Nome');
				$('input[name=nome]').focus();
				$('#wrocky_form_loader').hide();
				$('input[type=submit]').val('Enviar');
				return false;
			}
			
			if(!$('input[name=email]').attr('value'))
			{
				alert('Digite o seu E-Mail');
				$('input[name=email]').focus();
				$('#wrocky_form_loader').hide();
				$('input[type=submit]').val('Enviar');
				return false;
			}
			
			if(!$('input[name=assunto]').attr('value'))
			{
				alert('Digite o Assunto');
				$('input[name=assunto]').focus();
				$('#wrocky_form_loader').hide();
				$('input[type=submit]').val('Enviar');
				return false;
			}
			
			if(!$('textarea[name=texto]').attr('value'))
			{
				alert('Digite o texto da mensagem!');
				$('textarea[name=texto]').focus();
				$('#wrocky_form_loader').hide();
				$('input[type=submit]').val('Enviar');
				return false;
			}
			
		},
		success: function(){ 
			$('input[type=submit]').val('Enviar');
		} 
	}); 
});
</script>	
<div id="wrocky_form">
	<div id="wrocky_form_loader">
		<img src="wrocky_theme/loader.gif" />
	</div>
	<div id="wrocky_form_ajax">
	<form action="wrocky_act/wrocky_act.php" id="mail_form" method="post">
	<input type="hidden" name="action" value="mail_send" />
	<ul>
		<li>Nome Completo</li>
		<li><input type="text" id="nome" name="nome" /></li>
	</ul>
	<ul>
		<li>E-Mail</li>
		<li><input type="text" id="email" name="email" /></li>
	</ul>
	<ul>
		<li>Assunto</li>
		<li><input type="text" id="assunto" name="assunto" /></li>
	</ul>
	<ul>
		<li>Texto da mensagem</li>
		<li><textarea id="texto" name="texto"></textarea></li>
	</ul>
	<ul>
		<li style="text-align:center;"><input type="submit" value="Enviar" /></li>
	</ul>
	</form>
	</div>
</div>
