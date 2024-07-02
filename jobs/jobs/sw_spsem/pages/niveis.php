<?php

require("../common/connection.php");
require("../common/permissions.php");

$occupation = new occupation();
switch ($_GET["action"]) {
	case "screen":
		if ($msSession["active"]) $occupation->screen();
		break;
	case "show":
		if ($msSession["active"]) $occupation->show();
		break;
	case "edit":
		if ($msSession["nivel_cod"] <= 1) $occupation->edit();
		break;
	case "delete":
		if ($msSession["nivel_cod"] <= 1) $occupation->delete();
		break;
}

class occupation
{
	function screen()
	{
		$html = '
		<script type="text/javascript" src="scripts/pages/niveis.js"></script>
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
					<h1>Níveis Hierárquicos</h1>
					<h4>Controle de Níveis/Cargos do Usuario</h4>
				</hgroup>
			</header>
			<section>
				<dl>
					<dt><img src="images/icons/black/bars_16x16.png" alt="" /><span>Lista de Níves/Cargo Ativos</span></dt>
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

		$msQuery 	= "SELECT * FROM niveis";
		$msResult 	= mysqli_query($msConn, $msQuery);
		$msNumRows	= mysqli_num_rows($msResult);

		if ($msNumRows) {
			while ($row = mysqli_fetch_array($msResult)) {
				$msRows[] = array(
					'codigo' 	=> $row["codigo"],
					'nome' 		=> utf8_encode($row["nome"])
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