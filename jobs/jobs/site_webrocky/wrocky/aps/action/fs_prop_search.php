<?php

	require "../core.php";
	
	$search_prop = $_GET['search'];
	$search_type = $_GET['type'];
	
	$_SESSION["search_prop"] = $search_prop;
	
	$news = new Proprietario;
	
	if($search_type)
	{
		$news->ShowProp($search_prop,1);
	}
	else
	{
		$news->ShowProp($search_prop);
	}
		
?>