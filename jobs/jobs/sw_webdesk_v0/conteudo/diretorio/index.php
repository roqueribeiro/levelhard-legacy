<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WebRoCkY Upload</title>
<link rel="stylesheet" href="scripts/jquery.fancybox.css" />
<script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript" src="scripts/jquery.fancybox.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	function FancyBoxActive()
	{
		$(".fancy").fancybox({
			padding : 0,	
		});		
	}
	
	function DelData()
	{
		$('#resultado img').click(function(){
			$('#loading, #wrap').show();
			img = $(this).attr('title');
			$.ajax({
				type	: 'POST',
				url		: 'upload.php',
				data	: 'action=deletar&img='+img,
				success	: function(data) {
					$('#resultado ul').html(data);
					$('#loading, #wrap').hide();
					DelData();
					FancyBoxActive();
				}
			});
		});
	}
	
	$('#resultado ul').html('Carregando...');
	
	$('#resultado ul').load('upload.php',function(){
		DelData();
		FancyBoxActive();
		setInterval(function()
		{
			$('#resultado ul').load('upload.php',function(){
				DelData();
				FancyBoxActive();
			});
		},5000);
	});
	
	$('#upload').ajaxForm({
		beforeSubmit: function() {
			$('#loading, #wrap').show();
		},
		success: function(data) {
			$('#resultado ul').html(data);
			$('#loading, #wrap').hide();
			DelData();
			FancyBoxActive();
		}
	});
	
	$('input[type="file"]').change(function(){
		$('#upload').submit();
	});
		
});
</script>
<style type="text/css">

body
{ 
	margin:0px; 
	padding:0px; 
	width:100%; 
	height:100%; 
	font-family:Verdana, Geneva, sans-serif; 
	font-size:14px; 
	overflow:hidden; 
}
#loading
{
	 position:absolute; 
	 right:0px; 
	 bottom:0px; 
	 padding:10px; 
	 background:#FFF; 
	 border-top-left-radius:5px;
	 box-shadow:-1px -1px 8px rgba(0,0,0,0.2);
	 display:none; 
	 z-index:20;
}
#wrap				{ position:absolute; width:100%; height:100%; background:rgba(0,0,0,0.2); display:none; z-index:19; }
#corpo				{ position:absolute; width:100%; height:100%; background: url(background.jpg) right no-repeat #F5F5F5;  }
#formulario
{ 
	position:absolute; 
	width:100%; 
	height:45px; 
	right:16px; 
	margin:0px; 
	background: -webkit-linear-gradient(#EEE, #DDD);
	background: -moz-linear-gradient(#EEE, #DDD);
	background: -o-linear-gradient(#EEE, #DDD);
	background: -ms-linear-gradient(#EEE, #DDD);
	border-bottom:1px #CCC solid; 
	z-index:10; 
}

input[type="file"]
{
	position:relative;
	width:280px;
	padding:1px;
	opacity:0;
	-moz-opacity:0;
	filter:alpha(opacity:0);
}

#form-false
{
	position:absolute;
	top:7px;
	right:7px;
	width:auto;
	background: url(selecione.png) no-repeat 99% 51% #FFF;
	border:1px #CCC solid;
	border-radius:3px;
	color:#CCC;
	box-shadow:inset 1px 1px 3px rgba(0,0,0,0.15);
}

#arquivo			{ position:relative; width:auto; height:100%; font-size:12px; overflow-y:scroll; }
#resultado img		{ }
#resultado ul		{ margin:0px; padding:60px 5px 5px 5px; text-align:center; }
#resultado li		{ margin:0 0 0 0; list-style:none; margin:5px; padding:3px; display:inline-block; }
#resultado li		{ background:#FFFFFF; text-align:left; border:1px #BBB solid; }
#resultado li #del	{ position:absolute; width:26px; height:26px; margin-left:-10px; margin-top:-10px; }
#resultado li #mini	{ width:60px; height:60px; margin:0px; }

</style>
</head>

<body>
<div id="loading"><img src="loading.gif" /></div>
<div id="wrap"></div>
<div id="corpo">
	<form id="upload" action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="enviar" />
	<div id="formulario">
        <div id="form-false"><input name="arquivo[]" type="file" multiple="multiple" /></div>
    </div>
    </form>
    <div id="arquivo">
        <div id="resultado"><ul></ul></div>
    </div>
</div>
</body>
</html>