<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$.post('upload.php',{'action':'2'},function(data){
		$('#resultado').html(data);
	});
	$('#upload').ajaxForm({
		target: '#resultado'
	});
});
</script>
<style type="text/css">
body 		{ width:100%; font-family:Verdana, Geneva, sans-serif; font-size:14px; }
fieldset 	{ width:315px; }
#resultado		{ width:100%; }
#resultado img	{ height:100px; }
</style>
</head>

<body>
<form id="upload" action="upload.php" method="POST" enctype="multipart/form-data">
<fieldset>
	<legend>Enviar Arquivos</legend>
    <label>Arquivo:</label><input type="file" name="arquivo">
    <input type="hidden" name="action" value="1" />
    <input type="submit" value="Enviar">
</fieldset>
</form>
<fieldset>
	<legend>Arquivos Enviados</legend>
	<label><div id="resultado"></div></label>
</fieldset>
</body>
</html>