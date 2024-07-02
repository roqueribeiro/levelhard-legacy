<?php

require("../common/connection.php");
require("../common/permissions.php");

//Define JSON
header('Content-Type: application/json; charset=utf-8', true, 200);

$projects = new projects();
switch ($_GET["action"]) {
	case "screen":
		if ($msSession["active"]) $projects->screen();
		break;
	case "show":
		if ($msSession["active"]) $projects->show();
		break;
	case "edit":
		if ($msSession["nivel_cod"] <= 1) $projects->edit();
		break;
	case "delete":
		if ($msSession["nivel_cod"] <= 1) $projects->delete();
		break;
}

class projects
{
	function screen()
	{
		$html = '
		<script type="text/javascript" src="scripts/pages/plantas.js"></script>
		<nav>
			<ul>
				<li><a href="#" class="fancybox-button"><img src="images/icons/white/cloud_upload_16x16.png" alt="" /><span>Salvar</span></a></li>
				<li><a href="#" class="fancybox-button"><img src="images/icons/white/plus_16x16.png" alt="" /><span>Novo</span></a></li>
				<li><a href="#" class="fancybox-button"><img src="images/icons/white/trash_stroke_16x16.png" alt="" /><span>Excluir</span></a></li>
				<li><a href="#" class="fancybox-button"><img src="images/icons/white/info_8x16.png" alt="" /><span>Informações</span></a></li>
			</ul>
		</nav>
		<article class="form">
			<header>
				<hgroup>
					<h1>Plantas</h1>
					<h4>Controle de Plantas</h4>
				</hgroup>
			</header>
			<section>
				<dl>
					<dt><img src="images/icons/black/map_pin_fill_10x16.png" alt="" /><span>Lista de Plantas Ativas</span></dt>
					<dd><div class="jqxgrid" id="jqxUsers"></div></dd>
				</dl>
			</section>
		</article>
		';

		print $html;
	}

	function show()
	{
		global $msConn, $msSession;

		$msQuery 	= "SELECT * FROM mostra_usuarios WHERE situacao = 1 AND grupo_cod = " . $msSession["grupo_cod"] . " ORDER BY usuario";
		$msResult 	= mysqli_query($msConn, $msQuery);
		$msNumRows	= mysqli_num_rows($msResult);

		if ($msNumRows) {
			while ($row = mysqli_fetch_array($msResult)) {
				$msRows[] = array(
					'usuario_cod' 	=> $row["usuario_cod"],
					'planta' 		=> utf8_encode($row["planta"]),
					'planta_local' 	=> utf8_encode($row["planta_local"]),
					'planta_host' 	=> utf8_encode($row["planta_host"]),
					'usuario' 		=> utf8_encode($row["usuario"]),
					'rubrica' 		=> utf8_encode($row["rubrica"]),
					'nivel_cod' 	=> $row["nivel_cod"],
					'nivel' 		=> utf8_encode($row["nivel"]),
					'grupo_cod' 	=> $row["grupo_cod"],
					'grupo' 		=> utf8_encode($row["grupo"]),
					'situacao' 		=> $row["situacao"]
				);
			}
			print json_encode($msRows);
		}
	}

	function edit()
	{ }

	function delete()
	{ }
}

?>