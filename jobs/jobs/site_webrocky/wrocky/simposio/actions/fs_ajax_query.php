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
		case "curso_info":
			print curso_info();
		break;
		case "i_curso":
			print i_curso();
		break;
		case "s_curso":
			print s_curso();
		break;
		case "m_curso":
			print m_curso();
		break;
	}
	
function lista_curso($check,$cod,$nom)
{
	if($check == 1)
	{
		$checked 	= 'checked="checked"';
		$itemslc	= 'style="width:880px;"';
		$bg			= 'style="background:url(themes/default/pixel_white.jpg) top repeat-x #E8E8E8"';
	}
	else
	{
		$checked = '';
	}
	$html = '
	<span class="theme_content_item'.$cod.'">
	<div id="theme_content_item" '.$itemslc.'>
	<div id="theme_content_item_cab" '.$bg.'>
	<table cellpadding="0px" cellspacing="0px">
		<tr>
			<td><input type="checkbox" id="check'.$cod.'" name="check_curso[]" value="'.$cod.'" '.$checked.'></td>
			<td><a href="javascript:void(0)" onclick="AjaxLoadExp(\'.theme_content_item'.$cod.'\','.$cod.')">'.$nom.' »</a></td>
		</tr>
	</table>
	</div>
	<ul id="'.$cod.'">
	</ul>
	</div>
	</span>
	';
	return $html;
}
function curso_info()
{
	$c_cod = $_POST['codigo'];
	
	$QueryCursos = "
		SELECT 
			curso.codigo, 
			curso.periodo, 
			curso.vagas, 
			curso.data_inicio, 
			curso.hora_inicio, 
			curso.hora_fim,
			curso.sobre,
			pales.nome as pales_nome,
			fcurso.nome as fcurso_nome
		FROM
			fs_curso as curso
		INNER JOIN
			fs_palestrante as pales
		ON
			curso.pales_codigo = pales.codigo
		INNER JOIN
			fs_fcurso as fcurso
		ON
			curso.fcurso_codigo = fcurso.codigo 
		WHERE 
			curso.codigo = '".$c_cod."'
		ORDER BY 
			curso.nome 
	";
	
	$QueryCursosApply = mysql_query($QueryCursos);
	$QueryCursosResults = mysql_num_rows($QueryCursosApply); 
	if ($QueryCursosResults > 0)
	{
		while ($ResultCursosRow = mysql_fetch_array($QueryCursosApply)) 
		{
			$bd_result_cursos[1] = $ResultCursosRow["periodo"];
			$bd_result_cursos[2] = $ResultCursosRow["vagas"];
			$bd_result_cursos[3] = $ResultCursosRow["data_inicio"];
			$bd_result_cursos[4] = $ResultCursosRow["hora_inicio"];
			$bd_result_cursos[5] = $ResultCursosRow["hora_fim"];
			$bd_result_cursos[6] = $ResultCursosRow["sobre"];
			$bd_result_cursos[7] = $ResultCursosRow["pales_nome"];
			$bd_result_cursos[8] = $ResultCursosRow["fcurso_nome"];
			
            $div_cursos .= '
				<li><b>Periodo:</b> '.ver_periodo($bd_result_cursos[1]).'</li>
				<li><b>Vagas:</b> '.$bd_result_cursos[2].'</li>
				<li><b>Data:</b> '.$bd_result_cursos[3].'</li>
				<li><b>Hora Inicio:</b> '.$bd_result_cursos[4].'</li>
				<li><b>Hora Fim:</b> '.$bd_result_cursos[5].'</li>
				<li><b>Palestrante:</b> '.$bd_result_cursos[7].'</li>
				<li><b>Descrição:</b> '.$bd_result_cursos[6].'</li>
			';
		}
		return $div_cursos;
	}
}
function i_curso()
{
    $QueryCursos = "
		SELECT 
			codigo, 
			nome
		FROM
			fs_curso
		ORDER BY 
			nome 
		LIMIT 
			0,12;
	";
    $QueryCursosApply = mysql_query($QueryCursos);
    $QueryCursosResults = mysql_num_rows($QueryCursosApply); 
    if ($QueryCursosResults > 0)
    {
        while ($ResultCursosRow = mysql_fetch_array($QueryCursosApply)) 
        {
            $bd_result_cursos[1] = $ResultCursosRow["codigo"];
			$bd_result_cursos[2] = $ResultCursosRow["nome"];
            
            $div_cursos .= lista_curso(0,$bd_result_cursos[1],$bd_result_cursos[2]);
        }
    }
	else
	{
		$div_cursos = '
		<div id="theme_content_item">
		<div id="theme_content_item_cab">Nenhum Curso Encontrado</div>
		</div>
		';		
	}
	return $div_cursos;	
}
function s_curso()
{
	$c_check 	= $_POST['c_check'];
	$c_area 	= $_POST['c_area'];
	$c_periodo 	= $_POST['c_periodo'];
	$c_dia 		= $_POST['c_dia'];
	$c_busca 	= $_POST['c_busca'];
					
	if( $c_area || $c_periodo || $c_dia || $c_busca ){$w_Query = "WHERE 1 ";}
	
	if($c_check)	{$c_Query = "AND curso.codigo NOT IN (".$c_check.") ";}
	if($c_area)		{$a_Query = "AND fcurso.codigo = '".$c_area."' ";}
	if($c_periodo)	{$p_Query = "AND curso.periodo = '".$c_periodo."' ";}
	if($c_dia)		{$d_Query = "AND curso.data_inicio = '".$c_dia."' ";}
	if($c_busca)
	{
		$b_Query = "AND ( curso.nome LIKE '%".$c_busca."%' "; 
		$b_Query .= "OR curso.sobre LIKE '%".$c_busca."%' ";
		$b_Query .= "OR pales.nome LIKE '%".$c_busca."%' ";
		$b_Query .= "OR fcurso.nome LIKE '%".$c_busca."%' )";
	}
	$QueryCursos = "
		SELECT 
			curso.codigo, 
			curso.nome, 
			curso.periodo, 
			curso.data_inicio,
			pales.nome as pales_nome,
			fcurso.nome as fcurso_nome
		FROM
			fs_curso as curso
		INNER JOIN
			fs_palestrante as pales
		ON
			curso.pales_codigo = pales.codigo
		INNER JOIN
			fs_fcurso as fcurso
		ON
			curso.fcurso_codigo = fcurso.codigo
		".$w_Query.$c_Query.$a_Query.$p_Query.$d_Query.$b_Query."
		ORDER BY 
			curso.nome 
	";	
				
	$QueryCursosApply = mysql_query($QueryCursos);
	$QueryCursosResults = mysql_num_rows($QueryCursosApply); 
	if ($QueryCursosResults > 0)
	{
		while ($ResultCursosRow = mysql_fetch_array($QueryCursosApply)) 
		{
			$bd_result_cursos[1] = $ResultCursosRow["codigo"];
			$bd_result_cursos[2] = $ResultCursosRow["nome"];
			
            $div_cursos .= lista_curso(0,$bd_result_cursos[1],$bd_result_cursos[2]);
		}
	}
	else
	{
		$div_cursos = '
		<div id="theme_content_item">
		<div id="theme_content_item_cab">Nenhum Curso Encontrado ou Estão Selecionados.</div>
		</div>
		';		
	}
	
	if($c_check)
	{
		$QueryChecked = "SELECT codigo, nome FROM fs_curso WHERE codigo IN (".$c_check.")";	
				
		$QueryCheckedApply = mysql_query($QueryChecked);
		$QueryCheckedResults = mysql_num_rows($QueryCheckedApply); 
		if ($QueryCheckedResults > 0)
		{
			while ($ResultCheckedRow = mysql_fetch_array($QueryCheckedApply)) 
			{
				$bd_result_checked[1] = $ResultCheckedRow["codigo"];
				$bd_result_checked[2] = $ResultCheckedRow["nome"];
				
				$div_cursos_chk .= lista_curso(1,$bd_result_checked[1],$bd_result_checked[2]);
			}
		}
		$div_c_chk = '<div id="theme_content_item_chk"><div id="theme_content_item_chk_c">Cursos Selecionados antes da Pesquisa<span></span></div>'.$div_cursos_chk.'</div>';
	}
	else
	{
		$div_cursos;
	}
	
	return $div_cursos.$div_c_chk;
}
function m_curso()
{
	
	$ultimo = (int) $_POST['ultimo'];
	
	$QueryCursos = "
		SELECT 
			codigo, 
			nome
		FROM
			fs_curso
		WHERE 
			codigo > '".$ultimo."'
		ORDER BY 
			nome 
	";
	
	$QueryCursosApply = mysql_query($QueryCursos);
	$QueryCursosResults = mysql_num_rows($QueryCursosApply); 
	if ($QueryCursosResults > 0)
	{
		while ($ResultCursosRow = mysql_fetch_array($QueryCursosApply)) 
		{
			$bd_result_cursos[1] = $ResultCursosRow["codigo"];
			$bd_result_cursos[2] = $ResultCursosRow["nome"];
			
            $div_cursos .= lista_curso(0,$bd_result_cursos[1],$bd_result_cursos[2]);
		}
		return $div_cursos;
	}
	
}
	
?>