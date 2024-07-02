<?php

session_start();

require "config/db_connect.php";

//===========================Classes

class Principal
{
	function ShowPrinc()
	{
		$Query = "SELECT titulo, texto FROM principal;";
		$QueryApply = mysql_query($Query);
		$QueryResults = mysql_num_rows($QueryApply); 
		if ($QueryResults > 0)
		{
			while ($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result[1] = $ResultRow["titulo"];
				$bd_result[2] = $ResultRow["texto"];
				
				print "
				<fieldset>
					<legend>".$bd_result[1]."</legend>
					<label>".$bd_result[2]."</label>
				</fieldset>
				";
			}
		}
		else
		{
			print "Nenhum Resultado Encontrado";
		}
	}
}

class Proprietario 
{

	public $propData;
	public $idCod;
	public $t;
	
	function ShowMulta($idCod,$t)
	{
		$QueryMult = "
			SELECT 
				multa.pontos
			FROM 
				proprietario
			INNER JOIN
				veiculo
			ON
				veiculo.cod_proprietario = proprietario.codigo
			INNER JOIN
				multa
			ON
				multa.cod_veiculo = veiculo.codigo
			WHERE
				proprietario.codigo = ".$idCod."
			ORDER BY 
				nome;
		";
		$QueryMultApply = mysql_query($QueryMult);
		$QueryMultResults = mysql_num_rows($QueryMultApply);
		if ($QueryMultResults > 0)
		{
			while ($QueryMultRow = mysql_fetch_array($QueryMultApply)) 
			{
				$bd_result_m[1] = (int) $QueryMultRow[0];
				
				$m_soma = $m_soma+$bd_result_m[1];
			}
		}
		
		if($t)
		{
			return $m_soma;
		}
		else
		{
			return $QueryMultResults;
		}
		
	}
	
	function ShowMultaDev($idCod,$idCodV,$t)
	{
		if($idCodV)
		{
			$QueryDev = "
				SELECT 
					cod_veiculo,
					pagamento
				FROM 
					multa
				WHERE
					cod_veiculo = ".$idCodV."
				AND
					pagamento = 0
			";			
		}
		else
		{
			$QueryDev = "
				SELECT 
					proprietario.codigo,
					multa.valor,
					multa.pontos
				FROM 
					proprietario
				INNER JOIN
					veiculo
				ON
					veiculo.cod_proprietario = proprietario.codigo
				INNER JOIN
					multa
				ON
					multa.cod_veiculo = veiculo.codigo
				WHERE
					proprietario.codigo = ".$idCod."
				AND
					multa.pagamento = 0
			";
		}
		$QueryDevApply = mysql_query($QueryDev);
		$QueryDevResults = mysql_num_rows($QueryDevApply);
		if ($QueryDevResults > 0)
		{
			while ($ResultDevRow = mysql_fetch_array($QueryDevApply)) 
			{
				$bd_result_d[2] = $ResultDevRow[1];
				$bd_result_d[3] = $ResultDevRow[2];
				
				$bd_dev .= '<li style=\'color:#F00;\'>Valor: '.$bd_result_d[2].' / '.$bd_result_d[3].' Pontos.</li>';
			}
		}
		else
		{
			$bd_dev = 'Não Possuí';
		}
		
		if($t)
		{
			return $bd_dev;
		}
		else
		{
			if ($QueryDevResults > 0)
			{
				return 'style="background:rgba(255,0,0,0.05);"'.$QueryDev;;
			}
		}
		
	}
		
	function ShowProp($propData,$relat='')
	{
		
		$multa 	= new Proprietario;
		$veic 	= new Veiculo;
								
		$Query = "SELECT * FROM proprietario WHERE nome LIKE '%".$propData."%' OR sobrenome LIKE '%".$propData."%' OR num_cpf LIKE '%".$propData."%' ORDER BY nome;";
		$QueryApply = mysql_query($Query);
		$QueryResults = mysql_num_rows($QueryApply); 
		if ($QueryResults > 0)
		{
			while ($ResultRow = mysql_fetch_array($QueryApply)) 
			{
								
				$bd_result[1] 	= $ResultRow["codigo"];
				$bd_result[2] 	= $ResultRow["nome"];
				$bd_result[3] 	= $ResultRow["sobrenome"];
				$bd_result[4] 	= $ResultRow["telefone"];
				$bd_result[5] 	= $ResultRow["celular"];
				$bd_result[6] 	= $ResultRow["end_rua"];
				$bd_result[7] 	= $ResultRow["end_numero"];
				$bd_result[8] 	= $ResultRow["end_bairro"];
				$bd_result[9] 	= $ResultRow["end_cep"];
				$bd_result[10] 	= $ResultRow["end_cidade"];
				$bd_result[11] 	= $ResultRow["end_estado"];
				$bd_result[12] 	= $ResultRow["num_rg"];
				$bd_result[13] 	= $ResultRow["num_cpf"];
				$bd_result[14] 	= $ResultRow["num_cnh"];
												
				$prop_data = '
				<ul class=\'t_col1\'>
					<li>Nome</li>
					<li>Sobrenome</li>
					<li>RG</li>
					<li>CPF</li>
					<li>CNH</li>
					<li>Endereço</li>
					<li>Bairro</li>
					<li>CEP</li>
					<li>Cidade</li>
					<li>Estado</li>
					<li>Total de Multas</li>
					<li>Total de Pontos</li>
					<li>Total de Veiculos</li>
					<li>Multas a Pagar</li>
				</ul>
				<ul class=\'t_col2\'>
					<li>'.$bd_result[2].'</li>
					<li>'.$bd_result[3].'</li>
					<li>'.$bd_result[12].'</li>
					<li>'.$bd_result[13].'</li>
					<li>'.$bd_result[14].'</li>
					<li>'.$bd_result[6].', '.$bd_result[7].'</li>
					<li>'.$bd_result[8].'</li>
					<li>'.$bd_result[9].'</li>
					<li>'.$bd_result[10].'</li>
					<li>'.$bd_result[11].'</li>
					<li>'.$multa->ShowMulta($bd_result[1],0).'</li>
					<li>'.$multa->ShowMulta($bd_result[1],1).'</li>
					<li>'.$veic->ShowVeicProp($bd_result[1]).'</li>
					<li><ul>'.$multa->ShowMultaDev($bd_result[1],0,1).'</ul></li>
				</ul>
				';
				
				if(!$relat)
				{
					$veicACT = '
					<li class="p_col0"><a id="fancy_ajax" href="action/fs_prop_form.php?idCod='.$bd_result[1].'"><img src="images/ico_edit.png" alt="Editar" /></a></li>
					<li class="p_col0"><a id="but_delete" class="'.$bd_result[1].'" href="javascript:void(0);"><img src="images/ico_delete.png" alt="Deletar" /></a></li>
					<li class="p_col1"><a href="javascript:void(0);" title="'.$prop_data.'">'.$bd_result[2].'</a></li>
					';
				}
				else
				{
					$veicACT = '
					<li class="p_col1">'.$bd_result[2].'</li>
					';
				}
				
				print '
				<ul '.$multa->ShowMultaDev($bd_result[1],0,0).'>
					'.$veicACT.'
					<li class="p_col2">'.$bd_result[3].'</li>
					<li class="p_col3">'.$bd_result[4].'</li>
					<li class="p_col4">'.$bd_result[5].'</li>
					<li class="p_col5">'.$bd_result[13].'</li>
				</ul>
				';
			}
		}
		else
		{
			print '
			<ul style="text-align:center;">
				<li>Nenhum Resultado Encontrado</li>
			</ul>
			';
		}
	}

	function AddProp($propData)
	{
		$Query = "
		INSERT INTO  
		proprietario 
		(
			codigo,
			nome,
			sobrenome,
			telefone,
			celular,
			end_rua,
			end_numero,
			end_bairro,
			end_cep,
			end_cidade,
			end_estado,
			num_rg,
			num_cpf,
			num_cnh
		)
		VALUES 
		(
			NULL, 
			'".$propData[2]."',
			'".$propData[3]."',
			'".$propData[4]."',
			'".$propData[5]."',
			'".$propData[6]."',
			'".$propData[7]."',
			'".$propData[8]."',
			'".$propData[9]."',
			'".$propData[10]."',
			'".$propData[11]."',
			'".$propData[12]."',
			'".$propData[13]."',
			'".$propData[14]."'
		);
		";	
		mysql_query($Query);		
	}
	
	function DelProp($propData)
	{
		$Query = "DELETE FROM proprietario WHERE codigo = ".$propData.";";
		mysql_query($Query);		
	}
	
	function EditProp($propData)
	{
		$Query = "
		UPDATE  
			proprietario 
		SET  
			nome 		= '".$propData[2]."',
			sobrenome 	= '".$propData[3]."',
			telefone 	= '".$propData[4]."',
			celular 	= '".$propData[5]."',
			end_rua 	= '".$propData[6]."',
			end_numero 	= '".$propData[7]."',
			end_bairro 	= '".$propData[8]."',
			end_cep 	= '".$propData[9]."',
			end_cidade 	= '".$propData[10]."',
			end_estado 	= '".$propData[11]."',
			num_rg 		= '".$propData[12]."',
			num_cpf 	= '".$propData[13]."',
			num_cnh 	= '".$propData[14]."' 
		WHERE 
			codigo = ".$propData[1].";
		";	
		mysql_query($Query);
	}

}

class Veiculo 
{

	public $veicData;
	
	function ShowVeicProp($idCod)
	{
		
		$Query = "
			SELECT 
				*
			FROM 
				veiculo
			WHERE
				cod_proprietario = ".$idCod."
			ORDER BY 
				marca;
		";
		$QueryApply = mysql_query($Query);
		$QueryResults = mysql_num_rows($QueryApply);
		if ($QueryResults > 0)
		{
			while ($QueryRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result[1] = $QueryRow[0];
			}
		}
		
		return $QueryResults;
		
	}
	
	function ShowVeic($veicData,$cod_prop='',$relat='')
	{
		
		$multa 	= new Proprietario;
		$veic 	= new Veiculo;
		
		if($veicData or $cod_prop)
		{
			$Query = "
			SELECT 
				* 
			FROM 
				veiculo 
			INNER JOIN 
				proprietario 
			ON 
				proprietario.codigo = veiculo.cod_proprietario 
			WHERE 
				cod_proprietario = '".$cod_prop."' 
			AND
			(
				marca 	LIKE '%".$veicData."%' 
			OR
				modelo 	LIKE '%".$veicData."%' 
			OR
				ano 	LIKE '%".$veicData."%' 
			OR
				placa 	LIKE '%".$veicData."%' 
			)
			ORDER BY 
				nome;
			";
		}
		else
		{
			$Query = "
			SELECT 
				* 
			FROM 
				veiculo 
			INNER JOIN 
				proprietario 
			ON 
				proprietario.codigo = veiculo.cod_proprietario 
			ORDER BY 
				nome;
			";
		}
						
		$QueryApply = mysql_query($Query);
		$QueryResults = mysql_num_rows($QueryApply);
		if ($QueryResults > 0)
		{
			while ($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result[1] 	= $ResultRow[0];
				$bd_result[2] 	= $ResultRow["nome"];
				$bd_result[3] 	= $ResultRow["sobrenome"];
				$bd_result[4] 	= $ResultRow["marca"];
				$bd_result[5] 	= $ResultRow["modelo"];
				$bd_result[6] 	= $ResultRow["ano"];
				$bd_result[7] 	= $ResultRow["placa"];
				
				if(!$relat)
				{
					$veicACT = '
					<li class="p_col0"><a id="fancy_ajax" href="action/fs_veic_form.php?idCod='.$bd_result[1].'"><img src="images/ico_edit.png" alt="Editar" /></a></li>
					<li class="p_col0"><a id="but_delete" class="'.$bd_result[1].'" href="javascript:void(0);"><img src="images/ico_delete.png" alt="Deletar" /></a></li>
					';
				}
												
				print '
				<ul '.$multa->ShowMultaDev(0,$bd_result[1],0).'>
					'.$veicACT.'
					<li class="p_col2">'.$bd_result[2].' '.$bd_result[3].'</li>
					<li class="p_col3">'.$bd_result[4].'</li>
					<li class="p_col1">'.$bd_result[5].'</li>
					<li class="p_col4">'.$bd_result[6].'</li>
					<li class="p_col5">'.$bd_result[7].'</li>
				</ul>
				';
			}
		}
		else
		{
			print '
			<ul style="text-align:center;">
				<li>Nenhum Resultado Encontrado</li>
			</ul>
			';
		}
	}

	function AddVeic($veicData)
	{
		$Query = "
		INSERT INTO  
		veiculo 
		(
			codigo,
			cod_proprietario,
			marca,
			modelo,
			ano,
			placa
		)
		VALUES 
		(
			NULL,
			'".$veicData[2]."',
			'".$veicData[3]."',
			'".$veicData[4]."',
			'".$veicData[5]."',
			'".$veicData[6]."'
		);
		";	
		mysql_query($Query);
	}
	
	function DelVeic($veicData)
	{
		$Query = "DELETE FROM veiculo WHERE codigo = ".$veicData.";";
		mysql_query($Query);		
	}
	
	function EditVeic($veicData)
	{
		$Query = "
		UPDATE  
			veiculo 
		SET
			cod_proprietario 	= '".$veicData[2]."',
			marca 				= '".$veicData[3]."',
			modelo 				= '".$veicData[4]."',
			ano 				= '".$veicData[5]."',
			placa 				= '".$veicData[6]."'
		WHERE 
			codigo = ".$veicData[1].";
		";	
		mysql_query($Query);	
	}

}

class Multa 
{

	public $multaData;
	
	function ShowMulta()
	{
	}

	function AddMulta()
	{
	}
	
	function DelMulta()
	{
	}
	
	function EditMulta()
	{
	}

}

//===========================Funções Genéricas

function Truncate($str, $len=40, $etc='...') 
{
	 
	$end = array(' ', '.', ',', ';', ':', '!', '?');

	if (strlen($str) <= $len)
	{
		return $str;
	}

	if (!in_array($str{$len - 1}, $end) && !in_array($str{$len}, $end))
	{
		while (--$len && !in_array($str{$len - 1}, $end));
	}

	return rtrim(substr($str, 0, $len)).$etc;
}

function Format($str)
{
	 
	$str = strtolower($str);
	$str = str_replace("Â","â",$str);
	$str = str_replace("Á","á",$str);
	$str = str_replace("Ã","ã",$str);
	$str = str_replace("À","à",$str);
	$str = str_replace("Ê","ê",$str);
	$str = str_replace("É","é",$str);
	$str = str_replace("Î","î",$str);
	$str = str_replace("Í","í",$str);
	$str = str_replace("Ó","ó",$str);
	$str = str_replace("Õ","õ",$str);
	$str = str_replace("Ô","ô",$str);
	$str = str_replace("Ú","ú",$str);
	$str = str_replace("Û","û",$str);
	$str = str_replace("Ç","ç",$str);
	
	return (ucwords($str));
}

?>