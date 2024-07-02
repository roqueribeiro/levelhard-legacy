<?php

class sw_userinfo
{
	
	function sw_username()
	{//Metodo Busca Nome do Usuario
	 //Roque Ribeiro
	 //06-06-2012
	 
		$Query = "
		SELECT 
			IMP_USR_NOM,
			IMP_USR_SNO
		FROM
			TB_IMP_USR
		WHERE
			IMP_USR_COD = '".$_SESSION['IMP_USR_COD']."';
		";
		$QueryApply = mysql_query($Query);
		$QueryResults = mysql_num_rows($QueryApply);
		
		if($QueryResults > 0)
		{
			while($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result[1] = $ResultRow["IMP_USR_NOM"];
				$bd_result[2] = $ResultRow["IMP_USR_SNO"];
			}
		}
		
		return $bd_result[1].'&nbsp;'.$bd_result[2];
	}
	
	function sw_login()
	{//Metodo Busca Login do Usuario
	 //Roque Ribeiro
	 //06-06-2012
	 
		$Query = "
		SELECT 
			IMP_USR_LGN
		FROM
			TB_IMP_USR
		WHERE
			IMP_USR_COD = '".$_SESSION['IMP_USR_COD']."';
		";
		$QueryApply = mysql_query($Query);
		$QueryResults = mysql_num_rows($QueryApply);
		
		if($QueryResults > 0)
		{
			while($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result[1] = $ResultRow["IMP_USR_LGN"];
			}
		}
		
		return $bd_result[1];
	}

	function sw_access()
	{//Metodo Busca Acesso do Usuario
	 //Roque Ribeiro
	 //06-06-2012
	 
		$Query = "
		SELECT 
			IMP_USR_GRP
		FROM
			TB_IMP_USR
		WHERE
			IMP_USR_COD = '".$_SESSION['IMP_USR_COD']."';
		";
		$QueryApply = mysql_query($Query);
		$QueryResults = mysql_num_rows($QueryApply);
		
		if($QueryResults > 0)
		{
			while($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result[1] = $ResultRow["IMP_USR_GRP"];
			}
		}
		
		return $bd_result[1];
	}
	
}

?>