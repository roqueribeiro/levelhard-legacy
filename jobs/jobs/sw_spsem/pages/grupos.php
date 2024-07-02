<?php

require("../common/connection.php");
require("../common/permissions.php");

$group = new group();
switch ($_GET["action"]) {
	case "screen":
		if ($msSession["active"]) $group->screen();
		break;
	case "show":
		if ($msSession["active"]) $group->show();
		break;
	case "edit":
		if ($msSession["nivel_cod"] <= 1) $group->edit();
		break;
	case "delete":
		if ($msSession["nivel_cod"] <= 1) $group->delete();
		break;
}

class group
{
	function screen()
	{
		$html = '
		<script type="text/javascript" src="scripts/pages/grupos.js"></script>
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
					<h1>Grupos</h1>
					<h4>Controle de Grupos/Setores</h4>
				</hgroup>
			</header>
			<section>
				<dl>
					<dt><img src="images/icons/black/share_16x16.png" alt="" /><span>Lista de Grupos/Setores Ativos</span></dt>
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

		$msQuery 	= "SELECT * FROM mostra_grupos WHERE situacao = 1 ORDER BY nome";
		$msResult 	= mysqli_query($msConn, $msQuery);
		$msNumRows	= mysqli_num_rows($msResult);

		if ($msNumRows) {
			while ($row = mysqli_fetch_array($msResult)) {
				$msRows[] = array(
					'codigo' 		=> $row["codigo"],
					'nome' 			=> utf8_encode($row["nome"]),
					'abreviatura' 	=> utf8_encode($row["abreviatura"]),
					'localizacao' 	=> utf8_encode($row["localizacao"])
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