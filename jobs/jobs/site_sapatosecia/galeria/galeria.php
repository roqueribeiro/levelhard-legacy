<?php

	switch($_POST["typeGal"])
	{
		case "primaveraverao":
			print GalleryMount("01_primaveraverao");
		break;
		
		case "sneaker":
			print GalleryMount("02_sneaker");
		break;
		
		case "botas":
			print GalleryMount("03_botas");
		break;
		
		case "sapatos":
			print GalleryMount("04_sapatos");
		break;
		
		case "masculino":
			print GalleryMount("05_masculino");
		break;
		
		case "bolsas":
			print GalleryMount("06_bolsas");
		break;
		
		case "kipling":
			print GalleryMount("07_kipling");
		break;

		case "acessorios":
			print GalleryMount("08_acessorios");
		break;

		case "fom":
			print GalleryMount("09_fom");
		break;
	}
	
function GalleryMount($img_dir)
{
	chdir($img_dir);
	$diretorio = getcwd();
	$ponteiro  = opendir($diretorio);
	while($nome_itens = readdir($ponteiro)){ $itens[] = $nome_itens; }
	sort($itens);
	foreach($itens as $listar) 
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
	if ($arquivos != "") 
	{
		foreach($arquivos as $listar)
		{
			$img_ext = explode('.',$listar);
			$img_min = explode('_',$img_ext[0]);
			$img_ref = explode('-',$img_min[0]);
						
			if(!$img_min[1] && $img_ext[1] != 'db')
			{
				$img_list .= '
				<img 
					src="galeria/'.$img_dir.'/'.$img_min[0].'_s.png" 
					longdesc="galeria/'.$img_dir.'/'.$img_min[0].'.jpg" 
					alt="Código Referência: '.$img_ref[1].'"
				/>
				';
			}
		}
	}	
	
	return '<div id="myImageFlowCab">'.$_POST["nameGal"].'</div><div id="myImageFlow" class="imageflow">'.$img_list.'</div>';
}

?>