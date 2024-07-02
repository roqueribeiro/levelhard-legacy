<?php

$pasta = "jobs/";

$busca = $_POST["busca"];

chdir($pasta);
$diretorio = getcwd();
$ponteiro  = opendir($diretorio);
while ($nome_itens = readdir($ponteiro)) {
	$itens[] = $nome_itens;
}
sort($itens);
foreach ($itens as $listar) {
	if ($listar != "." && $listar != "..") {
		if (is_dir($listar)) {
			$pastas[] = $listar;
		} else {
			$arquivos[] = $listar;
		}
	}
}
if ($arquivos != "") {
	foreach ($arquivos as $listar) {
		if (!$busca_mount) $busca_mount .= $listar;
		else $busca_mount .= "," . $listar;

		$listar_type = explode(".", $listar);

		if ($listar_type[1] == "png" or $listar_type[1] == "jpg")
			$image = "icon-image";
		else if ($listar_type[1] == "php")
			$image = "icon-file-archive";
		else
			$image = "icon-file";

		$listagem .= '
			<ul class="' . $pasta . $listar . '">
				<li><img src="images/' . $image . '.png" alt=""></li>
				<li>' . $listar . '</li>
				<li>Arquivo</li>
			</ul>
			';
	}
}
if ($pastas != "") {
	foreach ($pastas as $listar) {
		if (!$busca_mount) $busca_mount .= $listar;
		else $busca_mount .= "," . $listar;

		if (file_exists("../" . $pasta . $listar . "/favicon.ico"))
			$image = $pasta . $listar . "/favicon.ico";
		else
			$image = "images/icon-folder.png";

		$listagem .= '
			<ul class="' . $pasta . $listar . '">
				<li><img src="' . $image . '" alt=""></li>
				<li>' . $listar . '</li>
				<li>Pasta</li>
			</ul>
			';
	}
}

if ($busca) {
	$busca_arr = explode(",", $busca_mount);

	foreach ($busca_arr as $busca_key => $busca_data) {
		$busca_res = stristr($busca, $busca_data);

		if (stristr($busca_data, $busca) != false) {

			$listar_type_arr = explode(".", $busca_arr[$busca_key]);

			if ($listar_type_arr[1]) {
				if ($listar_type_arr[1] == "png" or $listar_type_arr[1] == "jpg")
					$busca_img = "images/icon-image.png";
				else if ($listar_type_arr[1] == "php")
					$busca_img = "images/icon-file-archive.png";
				else
					$busca_img = "images/icon-file.png";
			} else {
				if (file_exists("../" . $pasta . $busca_arr[$busca_key] . "/favicon.ico"))
					$busca_img = $pasta . $busca_arr[$busca_key] . "/favicon.ico";
				else
					$busca_img = "images/icon-folder.png";
			}

			$busca_lista .= '		
				<ul class="' . $pasta . $busca_arr[$busca_key] . '">
					<li><img src="' . $busca_img . '" alt=""></li>
					<li>' . $busca_arr[$busca_key] . '</li>
					<li>Pasta</li>
				</ul>
				';
		}
	}

	if ($busca_lista)
		print $busca_lista;
	else
		print '<ul><li id="mensagem">Nenhum Projeto Encontrado</li></ul>';
} else {
	if ($listagem)
		print $listagem;
	else
		print '<ul><li id="mensagem">Nenhum Projeto Encontrado</li></ul>';
}

?>