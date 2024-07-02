<?php

$action		= $_POST["action"];

$pasta 		= "upload/";

$arq_name 	= $_FILES["arquivo"]["name"];
$arq_tmp 	= $_FILES["arquivo"]["tmp_name"];

if($action == 1)
{
	
	$dest = $pasta.$arq_name;
	
	if(!move_uploaded_file($arq_tmp, $dest)) 
	{
	   echo "Não foi possível enviar o arquivo!";
	} 
	else 
	{
	   echo "Arquivo enviado com sucesso!";
	}
}

if($action == 2)
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
			$files	.= "<img src=".$pasta.$listar." />";
		}
	}
	
	print $files;
	
}

?>