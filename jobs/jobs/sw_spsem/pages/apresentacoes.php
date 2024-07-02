<?php

require("../common/connection.php");
require("../common/permissions.php");

$presentation = new presentation();
//Controle de Apresentacoes e Atividades
//Roque Ribeiro 
//22-04-2013
switch ($_GET["action"]) {
	case "screen":
		if ($msSession["active"]) $presentation->screen();
		break;
	case "show":
		if ($msSession["active"]) $presentation->show();
		break;
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
	function screen()
	{ //Mostra a Tela Principal de Apresentacoes
		//Roque Ribeiro 
		//22-04-2013

		$html = '
		<script type="text/javascript" src="scripts/pages/apresentacoes.js"></script>
		<nav>
		<ul>
			<li>
				<a href="javascript:void(0);" id="act-presentation">
					<img src="images/icons/white/play_alt_16x16.png" alt="" /><span>Apresentar</span>
				</a>
			</li>
			<li>
				<a href="javascript:void(0);" id="act-activities">
					<img src="images/icons/white/plus_alt_16x16.png" alt="" /><span>Adicionar Atividades</span>
				</a>
			</li>
			<li>
				<a href="javascript:void(0);" id="add-presentation">
					<img src="images/icons/white/plus_16x16.png" alt="" /><span>Novo</span>
				</a>
			</li>
			<li>
				<a href="javascript:void(0);" id="delete-presentation">
					<img src="images/icons/white/trash_stroke_16x16.png" alt="" /><span>Excluir</span>
				</a>
			</li>
		</ul>
		</nav>
		<article class="form">
		<header>
			<hgroup>
				<h1>Apresentações</h1>
				<h4>Controle de Apresentações Semanais</h4>
			</hgroup>
		</header>
		<section>
			<dl>
				<dt><img src="images/icons/black/play_alt_16x16.png" alt="" /><span>Lista de Apresentações</span></dt>
				<dd><div class="jqxgrid" id="jqxUsers"></div></dd>
			</dl>
		</section>
		</article>
		';

		print $html;
	}

	function show()
	{
		//Listagem em JSON das apresentacoes para jqxGrid
		//Roque Ribeiro 
		//22-04-2013		

		global $msConn, $msSession;

		$msQuery 	= "SELECT * FROM mostra_reunioes WHERE situacao = 1 AND grupo_cod = " . $msSession['grupo_cod'] . " ORDER BY data";
		$msResult 	= mysqli_query($msConn, $msQuery);
		$msNumRows	= mysqli_num_rows($msResult);

		if ($msNumRows) {
			header('Content-Type: application/json; charset=utf-8', true, 200);
			while ($row = mysqli_fetch_array($msResult)) {
				$msRows[] = array(
					'reuniao_cod' 	=> $row["reuniao_cod"],
					'grupo' 		=> utf8_encode($row["grupo"]),
					'data' 			=> date('d/m/Y', strtotime($row["data"])),
					'hora' 			=> date('H:i:s', strtotime($row["hora"])),
					'sala' 			=> utf8_encode($row["sala"]),
					'observacao' 	=> utf8_encode($row["observacao"])
				);
			}
			print json_encode($msRows);
		}
	}

	function form()
	{
		//Formulário de Adicao e Alteracao de Apresentacoes
		//Roque Ribeiro 
		//22-04-2013

		$html = '
		<script type="text/javascript" src="scripts/pages/reunioes.js"></script>
		<div class="window-title">
			<hgroup>
				<h3><img src="images/icons/white/new_window_16x16.png" alt="" />Marcar Reunião Semanal</h3>
			</hroup>
		</div>
		<div id="jqxWidget">
			<div id="jqxTabs">
				<ul>
					<li style="margin-left: 3px;">Adicionar</li>
				</ul>
				<div>
					<form name="reunioes" action="pages/apresentacoes.php" method="get">
						<div class="jqxContent">
							<ul>
								<li><p>Data:</p></li>
								<li><div id="jqxData"></div></li>
							</ul>
							<ul>
								<li><p>Hora:</p></li>
								<li><div id="jqxHora"></div></li>
							</ul>
							<ul>
								<li><p>Sala:</p></li>
								<li><div id="jqxSala"></div></li>
							</ul>
							<ul>
								<li><p>Observações:</p></li>
								<li><textarea name="tinyObs"></textarea></li>
							</ul>
							<ul>
								<li><div id="jqxAppoint"><span>Gerar Appointment Automático</span></div></li>
							</ul>
							<input type="hidden" name="action" value="add">
						</div>
						<nav>
							<input type="submit" value="Salvar" id="jqxButton">
						</nav>
					</form>
				</div>
			</div>
		</div>
		';

		print $html;
	}

	function add()
	{
		global $msConn, $msSession;

		$msQuery = "
		INSERT INTO reunioes
			(	
				data,
				hora,
				sala,
				observacao,
				situacao,
				grupo
			)
			VALUES
			(
				'" . $_GET["jqxData"] . "',
				'" . $_GET["jqxHora"] . "',
				'" . $_GET["jqxSala"] . "',
				'" . $_GET["tinyObs"] . "',
				'1',
				'" . $msSession['grupo_cod'] . "'
			)
		";
		$msResult = mysqli_query($msConn, $msQuery);

		if ($msResult) {
			print '1';
		} else {
			print '0';
		}
	}

	function edit()
	{ }

	function delete()
	{
		global $msConn;

		$msQuery = "DELETE FROM reunioes WHERE codigo = " . $_GET["reuniao_cod"];
		$msResult = mysqli_query($msConn, $msQuery);

		if ($msResult) {
			print '1';
		} else {
			print '0';
		}
	}
}

?>