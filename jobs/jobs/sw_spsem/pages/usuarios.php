<?php

require("../common/connection.php");
require("../common/permissions.php");

$user = new user();
switch ($_GET["action"]) {
	case "screen":
		if ($msSession["active"]) $user->screen();
		break;
	case "show":
		if ($msSession["active"]) $user->show();
		break;
	case "edit":
		if ($msSession["nivel_cod"] <= 1) $user->edit();
		break;
	case "delete":
		if ($msSession["nivel_cod"] <= 1) $user->delete();
		break;
}

class user
{
	function screen()
	{
		$html = '
		<script type="text/javascript" src="scripts/pages/usuarios.js"></script>
		<nav>
			<ul>
				<li><a href="#"><img src="images/icons/white/plus_16x16.png" alt="" /><span>Novo</span></a></li>
				<li><a href="#" class="fancybox-button"><img src="images/icons/white/pen_alt2_16x16.png" alt="" /><span>Editar</span></a></li>
				<li><a href="#" class="fancybox-button"><img src="images/icons/white/trash_stroke_16x16.png" alt="" /><span>Excluir</span></a></li>
			</ul>
		</nav>
		<article class="form">
			<header>
				<hgroup>
					<h1>Usuários</h1>
					<h4>Controle de Usuários</h4>
				</hgroup>
			</header>
			<section>
				<dl>
					<dt><img src="images/icons/black/user_12x16.png" alt="" /><span>Lista de Usuarios Ativos</span></dt>
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
		header('Content-Type: application/json; charset=utf-8', true, 200);

		$msQuery 	= "SELECT * FROM mostra_usuarios WHERE situacao = 1 ORDER BY grupo";
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