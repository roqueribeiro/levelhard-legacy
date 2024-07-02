<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	function DelData()
	{
		$('#resultado img').click(function(){
			img = $(this).attr('title');
			$.ajax({
				type	: 'POST',
				url		: 'upload.php',
				data	: 'action=deletar&img='+img,
				success	: function(data) {
					$('#resultado ul').html(data);
					DelData();
				}
			});
		});
	}
	
	$('#resultado ul').html('Carregando...');
	
	setInterval(function()
	{
		$('#resultado ul').load('upload.php',function(){
			DelData();
		});
	},1000);
	
	$('#upload').ajaxForm({
		beforeSubmit: function() {
			$('#loading').show();
		},
		success: function(data) {
			$('#resultado ul').html(data);
			$('#loading').hide();
			DelData();
		}
	});
		
});
</script>
<style type="text/css">

body 			{ background:url(background.jpg) no-repeat; margin:0px; padding:0px; width:360px; font-family:Verdana, Geneva, sans-serif; font-size:14px; }

a:link			{ color:#333; text-decoration:none; }
a:hover			{ color:#333; text-decoration:none; }
a:active		{ color:#333; text-decoration:none; }
a:visited		{ color:#333; text-decoration:none; }

fieldset 		{ width:315px; margin:10px; background:rgba(255,255,255,0.8); border:1px solid #FFF; box-shadow:0 0 10px rgba(0,0,0,0.8); }
legend			{ background:rgba(255,255,255,0.9); padding:2px 5px 2px 5px; border:1px solid #FFF; box-shadow:0 0 5px rgba(0,0,0,0.8); }
label			{ width:200px;}

#loading		{ position:absolute; left:298px; top:10px; padding:10px; background:rgba(255,255,255,1); box-shadow:0 0 5px rgba(0,0,0,0.8); display:none; }

#resultado		{ width:100%; }
#resultado img	{ }

#resultado ul	{ margin:0px; padding:5px; text-align:center; }
#resultado li	{ margin:0 0 0 0; list-style:none; padding:2px; display:inline-block; text-align:left; }
#resultado li a	{ margin:0 0 0 5px; }
#resultado li a	{ margin:0 0 0 5px; }

#resultado li #del	{ width:20px; height:20px; position:absolute; margin-left:-5px; margin-top:-5px; }
#resultado li #mini	{ width:60px; height:60px; margin:5px; }

</style>
</head>

<body>
<div id="loading"><img src="loading.gif" /></div>
<form id="upload" action="upload.php" method="POST" enctype="multipart/form-data">
<fieldset>
	<legend>Enviar Arquivos</legend>
    <input type="file" name="arquivo" multiple="multiple">        
    <input type="hidden" name="action" value="enviar" />
    <input type="submit" value="Enviar" />
</fieldset>
</form>
<fieldset>
	<legend>Arquivos Enviados</legend>
	<label><div id="resultado"><ul></ul></div></label>
</fieldset>
</body>
</html>