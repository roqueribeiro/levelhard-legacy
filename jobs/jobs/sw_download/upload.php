<?php

	$pasta 		= "downloads/";
	$action		= $_POST["action"];
		
	switch($action)
	{
		case "enviar":
			upload_arquivo();
		break;
		case "deletar":
			deleta_arquivo();
		break;
		default:
			lista_arquivo();
		break;
	}

function ver_nome($arquivo,$type)
{
	$nome = explode(".",$arquivo);
	return $nome[$type];
}

function resize_imagem($arquivoTmp,$max_x,$max_y,$arquivo) 
{//Resize de Imagem

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
			print "erro";
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
	
	$tamanho_x 	= $original_x * ($porcentagem / 100); 
	$tamanho_y 	= $original_y * ($porcentagem / 100); 
	$image_p 	= imagecreatetruecolor($tamanho_x, $tamanho_y); 
	$image 		= imagecreatefromjpeg($arquivoTmp); 
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $tamanho_x, $tamanho_y, $width, $height); 
	return imagejpeg($image_p, $arquivo, 100); 
	
}

function upload_arquivo()
{//Envia Arquivo

	global $pasta;
	
	if(isset($_FILES['arquivo']))
	{
		foreach($_FILES['arquivo']['name'] as $key => $value)
		{			
			if(ver_nome($_FILES['arquivo']['name'][$key],1)=='jpg')
			{
				resize_imagem($_FILES['arquivo']['tmp_name'][$key],180,180,$pasta.$_FILES['arquivo']['name'][$key]."_min");
				resize_imagem($_FILES['arquivo']['tmp_name'][$key],1024,800,$pasta.$_FILES['arquivo']['name'][$key]);
			}
			else
			{
				move_uploaded_file($_FILES['arquivo']['tmp_name'][$key],$pasta.$_FILES['arquivo']['name'][$key]);
			}
		}
	}
		
}

function deleta_arquivo()
{//Deleta Arquivo
		
	foreach($_POST["delete_select"] as $key => $value)
	{
		if(ver_nome($_POST["delete_select"][$key],1) == "jpg")
		{
			unlink($_POST["delete_select"][$key]."_min");
			unlink($_POST["delete_select"][$key]);
		}
		else
		{
			unlink($_POST["delete_select"][$key]);
		}		
	}
	
}

function lista_arquivo()
{//Lista Arquivo na Pasta

	global $pasta;
	
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
			$arquivos[]=$listar;
	   }
	}
		
	if ($arquivos != "") 
	{
		foreach($arquivos as $listar)
		{		
			$jArquivos[] = array( 'filename' => $pasta.$listar );
		}
	}
	else
	{
		$jArquivos[] = array( 'filename' => 'vazio' );
	}
	
	print json_encode($jArquivos); 
	
}

?>