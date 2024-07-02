<?php

	//Conexão do Banco de Dados
	require "../config/connect_db.php";
	
	//Linguagem do Site
	require "../languages/language-ptbr.php";
	 
	$check_ra = $_POST['check_ra']; 
		
	$QueryRa = "SELECT * FROM fs_aluno WHERE matricula = '".$check_ra."'";
	
	$QueryRaApply = mysql_query($QueryRa);
	$QueryRaResults = mysql_num_rows($QueryRaApply); 
	if ($QueryRaResults > 0)
	{
		while ($ResultRaRow = mysql_fetch_array($QueryRaApply)) 
		{
			$bd_result_ra[1] = $ResultRaRow["matricula"];
			$bd_result_ra[2] = $ResultRaRow["nome"];
			$bd_result_ra[3] = $ResultRaRow["curso"];
			$bd_result_ra[4] = $ResultRaRow["periodo"];
			$bd_result_ra[5] = $ResultRaRow["ingresso"];
			$bd_result_ra[6] = $ResultRaRow["rg"];
			$bd_result_ra[7] = $ResultRaRow["nascimento"];
		}
	}
	
	print $bd_result_ra[2];
	
?>