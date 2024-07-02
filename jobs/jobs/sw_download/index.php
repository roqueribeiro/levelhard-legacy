<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
	<meta name="copyright" content="Roque Ribeiro" />
	<meta name="language" content="pt-br">
	<meta name="theme-color" content="#f5f5f5">
	<title>SSDownloader</title>
	<link rel="icon" href="favicon32.png" sizes="32x32" />
	<link rel="icon" href="favicon48.png" sizes="48x48" />
	<link rel="icon" href="favicon64.png" sizes="64x64" />
	<link rel="icon" href="favicon128.png" sizes="128x128" />
	<style type="text/css">
		* {
			margin: 0px;
			padding: 0px;
			font-family: Verdana;
			font-size: 12px;
			outline: none;
		}

		body {
			width: 100%;
			height: 100%;
			overflow: hidden;
			background: #DDD;
			text-align: center;
		}

		form {
			position: absolute;
			width: 100%;
			margin: 0 auto 40px auto;
			background: #EEE;
		}

		form {
			padding: 15px 0;
			box-shadow: 0 2px #BBB;
			z-index: 10;
		}

		input {
			margin-right: -4px;
		}

		input[type=text] {
			position: relative;
			padding: 10px;
			top: -1px;
			border: none;
			width: 550px;
			box-shadow: 0 2px #BBB;
		}

		input[type=text] {
			border-bottom-left-radius: 10px;
		}

		input[type=submit],
		input[type=button] {
			position: relative;
			padding: 10px 25px;
			top: -1px;
			border: none;
		}

		input[type=submit],
		input[type=button] {
			background: #888;
			color: #FFF;
			box-shadow: 0 2px #666;
			-webkit-transition: 100ms;
		}

		#status {
			position: relative;
			display: none;
		}

		#status p {
			margin: 15px 0 0 0;
		}

		#iframe {
			position: absolute;
			top: 80px;
			bottom: 12px;
			left: 12px;
			right: 12px;
			z-index: 5;
		}

		#iframe {
			background: #FFF;
			border-radius: 15px;
			box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.3), 1px 1px #FFF;
		}

		#iframe {
			padding: 5px;
		}

		input[type=submit]:not(:disabled):hover,
		input[type=button]:not(:disabled):hover {
			background: #777;
		}

		input[type=submit]:not(:disabled):active,
		input[type=button]:not(:disabled):active {
			top: 1px;
			box-shadow: none;
		}
	</style>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('input[name=atualiza]').click(function() {
				$('iframe').attr('src', $('iframe').attr('src'));
			});
			$('form').ajaxForm({
				beforeSubmit: function() {
					$('form input[type=submit], form input[type=text]').attr('disabled', 'disabled');
					if (!$('input[type=text]').val()) {
						$('#status').html('<p style="color:#F00">Digite o Link para Download</p>').show(100, function() {
							$(this).delay(1000).hide(300, function() {
								$('form input[type=submit], form input[type=text]').removeAttr('disabled');
							});
						});
						return false;
					} else {
						$('#status').html('<p style="color:#00F">Fazendo Download do Arquivo...</p>').show(100);
					}
				},
				complete: function(data) {
					console.log(data);
					$('iframe').attr('src', $('iframe').attr('src'));
					$('#status').html('<p style="color:#000">Arquivo Baixado com Sucesso!</p>').show(100, function() {
						$(this).delay(1000).hide(300, function() {
							$('form input[type=submit], form input[type=text]').removeAttr('disabled');
						});
					});
				}
			});
		});
	</script>
</head>

<body>
	<form action="download.php" method="post" enctype="multipart/form-data">
		<input type="text" name="download" placeholder="Digite o Link do Arquivo">
		<input type="submit" value="Fazer Download">
		<input type="button" name="atualiza" value="Atualizar">
		<div id="status"></div>
		</div>
	</form>
	<div id="iframe">
		<iframe src="diretorio.php" width="100%" height="100%" frameborder="0" scrolling="yes"></iframe>
	</div>
</body>

</html>