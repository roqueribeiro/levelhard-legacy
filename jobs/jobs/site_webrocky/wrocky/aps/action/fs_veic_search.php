<?php

	require "../core.php";
	
	$search_prop = $_GET['cod_prop'];
	$search_veic = $_GET['search'];
	$search_type = $_GET['type'];
	
	$_SESSION["search_prop2"] 	= $search_prop;
	$_SESSION["search_veic"] 	= $search_veic;
	
	$news = new Veiculo;
	
	if($search_type)
	{
		$news->ShowVeic($search_veic,$search_prop,1);
	}
	else
	{
		$news->ShowVeic($search_veic,$search_prop);
	}
	
?>