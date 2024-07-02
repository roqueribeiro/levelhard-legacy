<?php

	require("__config.php");
	require("_common_images.php");
	header("Content-type: application/json");

	$url_action = $_POST["varUserAction"];
	$dir_relative = $site_path . $_POST["varActivePath"];
	$dir_absolute = $_SERVER["DOCUMENT_ROOT"] . $dir_relative;
	$json_return = array();

	switch($url_action){
		case "getGalleryDirectories":
			echo getGalleryDirectories();
		break;
		case "getGalleryImageFiles":
			echo getGalleryImageFiles();
		break;		
		default:
		break;
	}

	//Funcao para recuperar diretorios da galeria
	//Roque Ribeiro
	//24-02-2017
	function getGalleryDirectories(){

		global $json_return, $dir_relative, $dir_absolute, $site_path;

		try {
			$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($_SERVER["DOCUMENT_ROOT"] . $site_path . "public/gallery"));
			foreach ($rii as $dir) {
				if(is_dir($dir)) {
					$path_relative = str_replace($_SERVER["DOCUMENT_ROOT"] . $site_path, "", str_replace("\\", "/", $dir->getPath()));
					$path_explode = explode("/", str_replace("\\", "/", $dir->getPath()));
					$path_name = $path_explode[count($path_explode)-1];
					$path_father = $path_explode[count($path_explode)-2];
					if($path_explode[count($path_explode)-2] != "public"){
						if(count(array_keys(array_column($json_return, "name"), $path_name)) == 0){
							array_push($json_return, array(
								"name" => $path_name,
								"father" => $path_father,
								"relative" => $path_relative,
								"absolute" => $dir->getPathname()
							));
						}
					}
				}
			}
		} catch (Exception $e) {
			array_push($json_return, array(
				"status" => -1,
				"error" => $e->getMessage()
			));
		}

		return json_encode($json_return);
	}

	//Funcao para recuperar imagens presentes no diretorio
	//Roque Ribeiro
	//23-02-2017
	function getGalleryImageFiles() {

		global $json_return, $dir_relative, $dir_absolute;

		try {
			if ($handle = opendir($dir_absolute)) {		
				while (false !== ($entry = readdir($handle))) {
					if (is_file($dir_absolute . $entry)) {
						$path_parts = pathinfo($entry);
						if ($path_parts["extension"] != "thumb") {
							
							//Verifica nome do arquivo e remove caracteres especiais
							$utf8_filename = str_replace(" ", "-", $path_parts["filename"]);
							$utf8_filename = preg_replace("/[^A-Za-z0-9\-]/", "_", $utf8_filename);
							$utf8_filename = strtolower($utf8_filename . "." . $path_parts["extension"]);
							if($entry != $utf8_filename) {
								rename($dir_absolute . $entry, $dir_absolute . $utf8_filename);
							}
							
							//Cria thumbnail para imagens que nao possuem
							$path_parts_renamed = pathinfo($utf8_filename);
							if (!file_exists($dir_absolute . $path_parts_renamed["filename"] . ".thumb")) {
								resizeImageFile($dir_absolute . $utf8_filename, $dir_absolute . $path_parts_renamed["filename"] . ".thumb", 400, 400);
							}
							
							//Verifica se imagem original necessita de redimensionamento
							list($width, $height, $image_type) = getimagesize($dir_absolute . $utf8_filename);				
							if($width > 1680 || $height > 1680){
								resizeImageFile($dir_absolute . $utf8_filename, $dir_absolute . $utf8_filename, 1680, 1680);
							}

							//Retorno em JSON
							array_push($json_return, array(
								"thumb" => $dir_relative . $path_parts_renamed["filename"] . ".thumb",
								"image" => $dir_relative . $utf8_filename,
								"filename" => $path_parts_renamed["filename"],
								"extension" => $path_parts_renamed["extension"]
							));					
						}
					}
				}

				closedir($handle);
			}
		} catch (Exception $e) {
			array_push($json_return, array(
				"status" => -1,
				"error" => $e->getMessage()
			));
		}

		return json_encode($json_return);
	}



?>