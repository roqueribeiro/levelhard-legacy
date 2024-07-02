<?php

	$pasta 		= "upload/";
	$action		= $_POST["action"];
		
	switch($action)
	{
		case "enviar":
			Upload($pasta);
		break;
		case "deletar":
			Deletar();
		break;
		default:
			print Listar($pasta);
		break;
	}

function Upload($pasta)
{
	global $arq_name, $arq_tmp;
		
	$arq_name 	= $_FILES["arquivo"]["name"];
	$arq_tmp 	= $_FILES["arquivo"]["tmp_name"];
	
	$arq_nname 	= uniqid().".".end(explode(".",strtolower($arq_name)));
	
	$dest_n 	= $pasta.$arq_nname;
	$dest_m 	= $pasta.$arq_nname.".min";
	
	if(ver_nome($arq_name,1) != "jpg")
	{
		 if(!move_uploaded_file($arq_tmp,$dest_n))
		 {
			 echo "Não foi possível enviar o arquivo!";
		 }
	}
	else
	{
		if(!ResizeIMG($arq_tmp,120,120,$dest_m)) 
		{
			echo "Não foi possível enviar o arquivo!";
		} 
		else 
		{
			if(!ResizeIMG($arq_tmp,2560,1600,$dest_n)) 
			{
				print Listar($pasta);
			}
		}
	}
}

function Deletar()
{
	$img_del = $_POST["img"];
	if(unlink($img_del))
	{
		if(ver_nome($img_del,1)=="jpg")
		{
			if(unlink($img_del.".min"))
			{
				header('Location: upload.php');
			}
		}
		else
		{
			header('Location: upload.php');
		}
	}
}

function Listar($pasta)
{
	
	$ponteiro  = opendir($pasta);
	
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
		foreach($pastas as $listar)
		{
			$files = "";
		}
	}
	
	if ($arquivos != "") 
	{
		foreach($arquivos as $listar)
		{		
			if(ver_nome($listar,2))
			{	
				$files	.= '<li><img id="del" src="delete.png" title="'.$pasta.ver_nome($listar,0).'.jpg" alt="" /><a href="'.$pasta.ver_nome($listar,0).'.jpg"><div id="mini" style=" background:url(\''.$pasta.$listar.'\') center; border:3px #FFF solid; box-shadow:0 0 3px rgba(0,0,0,0.4);"></div></a></li>';
			}
			elseif(ver_nome($listar,1)!="jpg")
			{
				$files	.= '<li><img id="del" src="delete.png" title="'.$pasta.$listar.'" alt="" /><a href="'.$pasta.$listar.'"><div id="mini" style="background:url(\'file.png\');"></div></a></li>';
			}
		}
	}
	else
	{
		$files	.= '<li>Nenhum Arquivo</li>';
	}
	
	return $files;
	
}

function ver_nome($arquivo,$type)
{
	$nome = explode(".",$arquivo);
	return $nome[$type];
}

function ResizeIMG($arquivoTmp,$max_x,$max_y,$arquivo) 
{ 		
	list($width, $height) = @getimagesize($arquivoTmp); 
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
	$image_p = @imagecreatetruecolor($tamanho_x, $tamanho_y); 
	$image = @imagecreatefromjpeg($arquivoTmp); 
	@imagecopyresampled($image_p, $image, 0, 0, 0, 0, $tamanho_x, $tamanho_y, $width, $height); 
	return @imagejpeg($image_p, $arquivo, 100); 
	
}


?>