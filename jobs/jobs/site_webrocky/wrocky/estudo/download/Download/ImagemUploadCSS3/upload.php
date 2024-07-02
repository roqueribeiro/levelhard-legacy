<script type="text/javascript">
<?php

$diretorio = "upload/";

if( isset( $_POST["enviar"] ) ) 
{	

	function FilesArray(&$files)
	{
		$names = array( 'name' => 1, 'type' => 1, 'tmp_name' => 1, 'error' => 1, 'size' => 1);
	
		foreach ($files as $key => $part) {
			$key = (string) $key;
			if (isset($names[$key]) && is_array($part)) 
			{
				foreach ($part as $position => $value) 
				{
					$files[$position][$key] = $value;
				}
				unset($files[$key]);
			}
		}
	}
	
	function ResizeIMG($arquivoTmp, $max_x, $max_y, $arquivo) 
	{ 		
		list($width, $height) = getimagesize($arquivoTmp); 
		$original_x = $width; 
		$original_y = $height;
		
		if($original_x < $max_x or $original_y < $max_y)
		{
			if( move_uploaded_file( $arquivoTmp, $arquivo ) )
			{
				if( file_exists( $arquivoTmp ) )
				{
					unlink( $arquivoTmp );
				}
			}
			else
			{
				print "alert('Erro! Não foi possível enviar, tente novamente mais tarde.');";
			}
		}
		else
		{
			if($original_x > $original_y) 
			{ 
				$porcentagem = (100 * $max_x) / $original_x; 
			}
			else 
			{ 
				$porcentagem = (100 * $max_y) / $original_y; 
			} 
		}
		
		$tamanho_x = $original_x * ($porcentagem / 100); 
		$tamanho_y = $original_y * ($porcentagem / 100); 
		$image_p = imagecreatetruecolor($tamanho_x, $tamanho_y); 
		$image = imagecreatefromjpeg($arquivoTmp); 
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $tamanho_x, $tamanho_y, $width, $height); 
		return imagejpeg($image_p, $arquivo, 100); 
		
	}
	
	FilesArray($_FILES["arquivo"]);
	
	foreach ($_FILES['arquivo'] as $position => $file) 
	{
		//var_dump($file);
		
		if($file["name"]!= "") 
		{
			
			$arquivoTmp = $file["tmp_name"];
			$arquivo 	= $diretorio.$file["name"];
						
			ResizeIMG($arquivoTmp, 640, 480, $arquivo);
	
		} 
		else 
		{
			print "alert('Erro! Nenhuma imagem foi selecionada para o envio.');";
		} 
		
	}
	
}

?>
</script>
<?php

$ponteiro  = opendir($diretorio);
while ($nome_itens = readdir($ponteiro))
{
    $itens[] = $nome_itens;
}
sort($itens);
foreach ($itens as $listar)
{
   if ($listar!="." && $listar!="..")
   { 
        if (is_dir($listar))
        { 
            $pastas[]=$listar;
        } 
        else
        { 
            $arquivos[]=$listar;
        }
   }
}
if ($pastas != "" ) 
{
    $i=1;
    foreach($pastas as $listar)
    {
        $img_files = "";
        $i++;
    }
}
if ($arquivos != "") 
{
    $i=1;
    foreach($arquivos as $listar)
    {
        $img_files .= "<li><img id=\"img$i\" src=\"$diretorio/$listar\" /></li>";
        $i++;
    }
}

print "<ul>".$img_files."</ul>";

?>