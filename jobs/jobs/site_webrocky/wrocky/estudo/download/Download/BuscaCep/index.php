<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Busca CEP</title>
<script type="text/javascript" src="scripts/jquery-1.4.2.js"></script>
<script type="text/javascript" src="scripts/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("input[name=busca_cep]").mask("99999-999");
	$("#busca_loading").hide();
    $('form[name=form_cep]').ajaxForm({ 
        target: '#busca_result',
		beforeSubmit: function(){ 
			$("#busca_loading").fadeIn(300);
		},
		success: function() { 
			$("#busca_loading").fadeOut(400);
		} 
    }); 
	
});
</script>
<style>

body	{ font-family:Verdana, Geneva, sans-serif; font-size:12px; }
p		{ margin:0px 0px 0px 0px; padding:0px; }
form	{ margin:0px; padding:0px; }
input	{ margin:0px; padding:0px; }

input[type=text]		{ border:1px #999 solid; background:#FFF; padding:1px 4px 1px 4px; }
input[type=password]	{ border:1px #999 solid; background:#FFF; padding:1px 4px 1px 4px; }
input[type=button]		{ border:1px #999 solid; background:#FFF; padding:1px 4px 1px 4px; }
input[type=submit]		{ border:1px #999 solid; background:#FFF; padding:1px 4px 1px 4px; }

#busca_corpo	{ margin:0 auto; padding:0px; width:500px; border:1px #999 solid; background:#E5E5E5; }
#busca_form		{ margin:0; padding:5px; }
#busca_result	{ margin:0; padding:5px; background:#FFF; }

#busca_loading	{ margin-left:5px; width:80px; }

</style>
</head>

<body>

<div id="busca_corpo">
    <div id="busca_form">
    <table cellpadding="0px" cellspacing="0px">
    	<tr>
        	<td>
            <form name="form_cep" action="act_busca.php" method="get">
            <input type="text" name="busca_cep">
            <input type="submit" value="Pesquisar">
            </form>
            </td>
            <td>
            <div id="busca_loading"><img src="images/loading.gif" /></div>
            </td>
        </tr>
    </table>
    </div>
    <div id="busca_result"></div>
</div>

</body>
</html>
