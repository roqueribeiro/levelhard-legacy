<?php

require("../common/connection.php");
require("../common/permissions.php");

$home = new home();
switch ($_GET["action"]) {
	case "screen":
		if ($msSession["active"]) $home->screen();
		break;
	case "show":
		if ($msSession["active"]) $home->show();
		break;
	case "edit":
		if ($msSession["nivel_cod"] <= 1) $home->edit();
		break;
	case "delete":
		if ($msSession["nivel_cod"] <= 1) $home->delete();
		break;
}

class home
{
	function screen()
	{
		global $msConn, $msSession;

		$usuario = explode(".", $msSession['usuario']);

		$html = '
		<script type="text/javascript" src="scripts/pages/home.js"></script>
		<nav>
			<ul>
				<li>
					<a href="#" class="fancybox-button">
						<img src="images/icons/white/info_8x16.png" alt="" /><span>Informações</span>
					</a>
				</li>
				<li>
					<a href="#" class="fancybox-button">
						<img src="images/icons/white/question_mark_8x16.png" alt="" /><span>Ajuda</span>
					</a>
				</li>
			</ul>
		</nav>
		<article class="home">
			<header>
				<hgroup>
					<h1>Bem-Vindo(a) ' . ucfirst(strtolower($usuario[0])) . ' ' . ucfirst(strtolower($usuario[1])) . '</h1>
					<h4>Módulos do ApSem</h4>
				</hgroup>
			</header>
			<section>
				<dl>
					<dt><img src="images/icons/black/new_window_16x16.png" alt="" /><span id="home_mod"></span></dt>
					<dd>
						<ul>
							<li>
								<a href="#apresentacoes" onclick="accessUrl($(this).attr(\'href\'));">
									<img src="images/icons/home/personalization.png" alt="" /><div>Apresentações</div>
								</a>
							</li>
							<li>
								<a href="#" onclick="accessUrl($(this).attr(\'href\'));">
									<img src="images/icons/home/catalogues.png" alt="" /><div>Projetos</div>
								</a>
							</li>
							<li>
								<a href="#" onclick="accessUrl($(this).attr(\'href\'));">
									<img src="images/icons/home/documents.png" alt="" /><div>Assuntos Relevantes</div>
								</a>
							</li>
						</ul>
					</dd>
					<dt><img src="images/icons/black/cog_16x16.png" alt="" /><span id="home_adm"></span></dt>
					<dd>
						<ul>
							<li>
								<a href="#plantas" onclick="accessUrl($(this).attr(\'href\'));">
									<img src="images/icons/home/folder.png" alt="" /><div>Plantas</div>
								</a>
							</li>
							<li>
								<a href="#grupos" onclick="accessUrl($(this).attr(\'href\'));">
									<img src="images/icons/home/folder-blank.png" alt="" /><div>Grupos</div>
								</a>
							</li>
							<li>
								<a href="#niveis" onclick="accessUrl($(this).attr(\'href\'));">
									<img src="images/icons/home/folder-blank.png" alt="" /><div>Niveis</div>
								</a>
							</li>
							<li>
								<a href="#usuarios" onclick="accessUrl($(this).attr(\'href\'));">
									<img src="images/icons/home/user.png" alt="" /><div>Usuarios</div>
								</a>
							</li>
						</ul>
					</dd>
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