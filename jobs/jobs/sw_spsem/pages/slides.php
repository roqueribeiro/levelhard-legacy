<?php

require("../common/connection.php");
require("../common/permissions.php");

$preview 		= (!isset($_GET["preview"]) ? true : false);
$usuario 		= (!$preview ? "usuario_cod = " . $msSession['usuario_cod'] . " AND " : "");
$reuniao 		= "reuniao_cod = " . $_GET['reuniao'];

$capa 			= '';
$cabecalho 		= '';
$apresentacao 	= '';

$msQuery 		= "SELECT * FROM mostra_atividades WHERE " . $usuario . $reuniao;
$msResult 		= mysqli_query($msConn, $msQuery);
$msNumRows 		= mysqli_num_rows($msResult);
if ($msNumRows) {

	while ($row = mysqli_fetch_array($msResult)) {
		$grupo 		= utf8_encode($row["grupo"]);
		$data 		= explode(".", date('d.M.Y', strtotime($row["data"])));
		$usuario 	= explode(".", $row["usuario"]);

		$apresentacao .= '
		<section>
			<section>
				<h3>' . ucfirst(strtolower($usuario[0])) . ' ' . ucfirst(strtolower($usuario[1])) . '</h3>
				<br />
				<p><b>Ações implementadas</b></p>
				<small>' . $row["executada"] . '</small>
			</section>
			<section>
				<h3>' . ucfirst(strtolower($usuario[0])) . ' ' . ucfirst(strtolower($usuario[1])) . '</h3>
				<br />
				<p><b>Ações a implementar</b> </p>
				<small>' . $row["planejada"] . '</small>
			</section>
		</section>
		';
	}

	if ($preview) {
		$capa = '
		<section>
			<h1>TI Central</h1>
			<h4>Reunião Semanal</h4>
			<br />
			<h4>' . $grupo . '</h4>
		</section>		
		';
		$cabecalho = '
		<div class="logo">
			<img src="../images/logo.png" alt="">
			<p>' . $grupo . '</p>
			<div class="date">
			  <span class="day">' . $data[0] . '</span>
			  <span class="month">' . $data[1] . '</span>
			  <span class="year">' . $data[2] . '</span>
			</div>
		</div>
		';
	}
} else {
	$capa = '
	<section>
		<small>Apresentação indisponível</small>
	</section>		
	';
}

?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Apresentação</title>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="../styles/reveal/reveal.min.css">
	<link rel="stylesheet" href="../styles/reveal/theme/solarized.css" id="theme">
	<link rel="stylesheet" href="../styles/reveal/zenburn.css">
	<!--[if lt IE 9]>
		<script src="../scripts/reveal/html5shiv.js"></script>
		<![endif]-->
</head>

<body>
	<div class="reveal">
		<?php print $cabecalho; ?>
		<div class="slides">
			<?php print $capa; ?>
			<?php print $apresentacao; ?>
		</div>
	</div>
	<script type="text/javascript" src="../scripts/reveal/head.min.js"></script>
	<script type="text/javascript" src="../scripts/jquery.reveal.min.js"></script>
	<script type="text/javascript">
		Reveal.initialize({
			controls: true,
			progress: true,
			history: true,
			center: true,
			transition: 'concave',
			dependencies: [{
					src: '../scripts/reveal/classList.js',
					condition: function() {
						return !document.body.classList;
					}
				},
				{
					src: '../scripts/reveal/markdown/showdown.js',
					condition: function() {
						return !!document.querySelector('[data-markdown]');
					}
				},
				{
					src: '../scripts/reveal/markdown/markdown.js',
					condition: function() {
						return !!document.querySelector('[data-markdown]');
					}
				},
				{
					src: '../scripts/reveal/highlight/highlight.js',
					async: true,
					callback: function() {
						hljs.initHighlightingOnLoad();
					}
				},
				{
					src: '../scripts/reveal/zoom-js/zoom.js',
					async: true,
					condition: function() {
						return !!document.body.classList;
					}
				},
				{
					src: '../scripts/reveal/notes/notes.js',
					async: true,
					condition: function() {
						return !!document.body.classList;
					}
				}
			]
		});
	</script>
</body>

</html>