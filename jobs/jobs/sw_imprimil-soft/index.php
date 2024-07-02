<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ImpriMil-Soft</title>
<!-- Favicon -->
<link rel="icon" href="favicon.png" type="image/x-icon"> 
<link rel="shortcut icon" href="favicon.png" type="image/x-icon"> 
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="themes/default/default.css" media="all">
<link rel="stylesheet" type="text/css" href="themes/default/stylesheet.css" media="all">
<link rel="stylesheet" type="text/css" href="themes/default/jquery-ui/jquery-ui-1.8.20.custom.css">
<link rel="stylesheet" type="text/css" href="jquery/fancybox/jquery.fancybox.css">
<!-- jQuery -->
<script type="text/javascript" src="jquery/jquery.min.js"></script>
<script type="text/javascript" src="sw-default.js"></script>
<script type="text/javascript" src="jquery/jquery.ui.js"></script>
<script type="text/javascript" src="jquery/jquery.form.js"></script>
<script type="text/javascript" src="jquery/jquery.transform.js"></script>
<script type="text/javascript" src="jquery/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	window.onload = function(){
		
		$.ajax({
			type		: 'POST',
			url			: 'system/sw_login.php',
			data		: { 'sw_action':'sw_window' },
			error		: function(){ preWindow('icon-alert',1); },
			beforeSend	: function(){ $('#loader').show(); },
			success		: function(data){ if(!data) preWindow('icon-alert',1); else $('#false-body').html(data); }
		});
		
	}
			
});
</script>
</head>

<body>

<div id="loader"></div>

<div id="gradient">
	<div id="false-body"></div>
</div>

</body>
</html>
