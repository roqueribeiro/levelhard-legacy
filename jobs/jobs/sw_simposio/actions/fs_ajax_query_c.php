<?php

	//Conexão do Banco de Dados
	require "../config/connect_db.php";
	
	//Linguagem do Site
	require "../languages/language-ptbr.php";
	
	//Funções Globais
	require "../actions/function.php";
	
	//Recuperando informações
	$action = $_POST['action'];
	
	switch($action)
	{
		case "a_combo":
			print a_combo();
		break;
		case "p_combo":
			print p_combo();
		break;
		case "d_combo":
			print d_combo();
		break;
	}

function a_combo()
{	
	global $bd_connect;

    //Query Combobox Area
    $QueryArea = "SELECT codigo, nome FROM fs_fcurso ORDER BY codigo;";
    $QueryAreaApply = mysqli_query($bd_connect, $QueryArea);
    $QueryAreaResults = mysqli_num_rows($QueryAreaApply); 
    if ($QueryAreaResults > 0)
    {
		$opt_area .= '<option value="">Selecione</option>';
		
        while ($ResultAreaRow = mysqli_fetch_array($QueryAreaApply)) 
        {
            $bd_result_area[1]	= $ResultAreaRow["codigo"];
            $bd_result_area[2]	= $ResultAreaRow["nome"];
            
            $opt_area .= '<option value="'.$bd_result_area[1].'">'.$bd_result_area[2].'</option>';
        }
    }
	return $opt_area;
}
function p_combo()
{	
	global $bd_connect;

	$codigo = $_POST['codigo'];
	
	if($codigo){$combo_query = "WHERE fcurso_codigo = '".$codigo."'";}

	//Query Combobox Periodo
    $QueryPer = "SELECT DISTINCT periodo FROM fs_curso ".$combo_query." ORDER BY periodo;";
    $QueryPerApply = mysqli_query($bd_connect, $QueryPer);
    $QueryPerResults = mysqli_num_rows($QueryPerApply); 
    if ($QueryPerResults > 0)
    {
		$opt_per .= '<option value="">Selecione</option>';
		
        while ($ResultPerRow = mysqli_fetch_array($QueryPerApply)) 
        {
            $bd_result_per[1]	= $ResultPerRow["periodo"];
            
            $opt_per .= '<option id="'.$codigo.'" value="'.$bd_result_per[1].'">'.ver_periodo($bd_result_per[1]).'</option>';
        }
    }
	return $opt_per;
}
function d_combo()
{	
	global $bd_connect;

	$codigo = $_POST['codigo'];
	$periodo = $_POST['periodo'];
	
	if($codigo and $periodo)
	{
		$combo_query = "WHERE fcurso_codigo = '".$codigo."' AND periodo = '".$periodo."'";
	}
	elseif($periodo)
	{
		$combo_query = "WHERE periodo = '".$periodo."'";
	}
	
    //Query Combobox Dia
    $QueryDia = "SELECT DISTINCT data_inicio FROM fs_curso ".$combo_query." ORDER BY data_inicio;";
    $QueryDiaApply = mysqli_query($bd_connect, $QueryDia);
    $QueryDiaResults = mysqli_num_rows($QueryDiaApply); 
    if ($QueryDiaResults > 0)
    {
		$opt_dia .= '<option value="">Selecione</option>';
		
        while ($ResultDiaRow = mysqli_fetch_array($QueryDiaApply)) 
        {
            $bd_result_dia[1] = $ResultDiaRow["data_inicio"];
            
            $opt_dia .= '<option>'.$bd_result_dia[1].'</option>';
        }
    }
	return $opt_dia;
}

?>