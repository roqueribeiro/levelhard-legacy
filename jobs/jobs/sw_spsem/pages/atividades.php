<?php

require("../common/connection.php");
require("../common/permissions.php");

$presentation = new presentation();
//Controle de Apresentacoes e Atividades
//Roque Ribeiro 
//22-04-2013
switch ($_GET["action"]) {
	case "form":
		if ($msSession["active"]) $presentation->form();
		break;
	case "add":
		if ($msSession["active"]) $presentation->add();
		break;
	case "edit":
		if ($msSession["active"]) $presentation->edit();
		break;
	case "delete":
		if ($msSession["active"]) $presentation->delete();
		break;
}

class presentation
{
	function form()
	{
		//Formulário de Adicao e Alteracao de Atividades
		//Roque Ribeiro 
		//22-04-2013

		global $msConn, $msSession;

		$executada = "";
		$planejada = "";

		$reuniao	= $_GET["reuniao_cod"];
		$msQuery 	= "SELECT * FROM atividades WHERE usuario = " . $msSession['usuario_cod'] . " AND reuniao = " . $reuniao;
		$msResult 	= mysqli_query($msConn, $msQuery);
		$msNumRows	= mysqli_num_rows($msResult);
		if ($msNumRows) {
			$temp_action = "edit";
			$row = mysqli_fetch_array($msResult);
			$executada = $row["executada"];
			$planejada = $row["planejada"];
		} else {
			$temp_action = "add";
		}

		$html = '
		<script type="text/javascript" src="scripts/pages/atividades.js"></script>
		<div class="window-title">
			<hgroup>
				<h3><img src="images/icons/white/new_window_16x16.png" alt="" />Adicionar Atividades</h3>
			</hroup>
		</div>
		<div id="jqxWidget">
			<div id="jqxTabs">
				<ul>
					<li style="margin-left: 3px;">Adicionar</li>
					<li>Visualizar</li>
				</ul>
				<div id="content_1">
					<form name="atividades" action="pages/atividades.php" method="get">
						<div class="jqxContent">
							<ul id="impl">
								<li><p>Ações implementadas:</p></li>
								<li><textarea class="jqte" name="impl">' . $executada . '</textarea></li>
							</ul>
							<ul id="aimpl">
								<li><p>Ações a implementar:</p></li>
								<li><textarea class="jqte" name="aimpl">' . $planejada . '</textarea></li>
							</ul>
							<input type="hidden" name="action" value="' . $temp_action . '">
							<input type="hidden" name="reuniao_cod" value="' . $reuniao . '">
						</div>
						<nav>
							<input type="submit" value="Salvar" id="jqxButton">
						</nav>
					</form>
				</div>
				<div id="content_view">
					<div class="jqxContent">
						<iframe src="about:blank"></iframe>
					</div>
				</div>
			</div>
		</div>
		';

		print $html;
	}

	function add()
	{
		global $msConn, $msSession;

		$msQuery 	= "SELECT * FROM atividades WHERE usuario = " . $msSession['usuario_cod'] . " AND reuniao = " . $_GET["reuniao_cod"];
		$msResult 	= mysqli_query($msConn, $msQuery);
		$msNumRows	= mysqli_num_rows($msResult);
		if (!$msNumRows) {
			$msQuery = "
			INSERT INTO atividades (
				executada,
				planejada,
				usuario,
				reuniao
			) VALUES (
				'" . $_GET["impl"] . "',
				'" . $_GET["aimpl"] . "',
				" . $msSession['usuario_cod'] . ",
				" . $_GET["reuniao_cod"] . "
			)
			";
			$msResult = mysqli_query($msConn, $msQuery);

			if ($msResult) {
				print '1';
			} else {
				print '0';
			}
		} else {
			print '2';
		}
	}

	function edit()
	{
		global $msConn, $msSession;

		$msQuery = "
		UPDATE 
			atividades
		SET 
			executada = '" . $_GET["impl"] . "',
			planejada = '" . $_GET["aimpl"] . "'
		WHERE 
			usuario = " . $msSession['usuario_cod'] . "
		AND
			reuniao = " . $_GET["reuniao_cod"] . "
		";
		$msResult = mysqli_query($msConn, $msQuery);

		if ($msResult) {
			print '1';
		} else {
			print '0';
		}
	}

	function delete()
	{ }
}

?>