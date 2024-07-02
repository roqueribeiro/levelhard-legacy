<?php

require("../common/connection.php");
require("../common/permissions.php");

$company = new company();
switch ($_GET["action"]) {
	case "screen":
		if ($msSession["active"]) $company->screen();
		break;
	case "show":
		if ($msSession["active"]) $company->show();
		break;
	case "edit":
		if ($msSession["nivel_cod"] <= 1) $company->edit();
		break;
	case "delete":
		if ($msSession["nivel_cod"] <= 1) $company->delete();
		break;
}

class company
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
		header('Content-Type: application/json; charset=utf-8', true, 200);

		$msQuery 	= "SELECT * FROM plantas WHERE situacao = 1 ORDER BY abreviatura";
		$msResult 	= mysqli_query($msConn, $msQuery);
		$msNumRows	= mysqli_num_rows($msResult);

		if ($msNumRows) {
			while ($row = mysqli_fetch_array($msResult)) {
				$msRows[] = array(
					'codigo' 		=> $row["codigo"],
					'abreviatura' 	=> utf8_encode($row["abreviatura"]),
					'localizacao' 	=> utf8_encode($row["localizacao"]),
					'host' 			=> utf8_encode($row["host"])
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