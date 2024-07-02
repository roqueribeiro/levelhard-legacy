<?php

	global $bd_conexao;

	if($_SESSION['acesso'])
	{
		$SecQuery = "
		SELECT
			TB_WDK_USR.WDK_USR_COD,
			TB_WDK_USR.WDK_USR_NOM,
			TB_WDK_USR.WDK_USR_EMA,
			TB_WDK_USR.WDK_USR_ACE,
			TB_WDK_USR.WDK_USR_EMP,
			TB_WDK_EMP.WDK_EMP_NOM,
			TB_WDK_EMP.WDK_EMP_HST,
			TB_WDK_EMP.WDK_EMP_SNH
		FROM 
			TB_WDK_USR
		INNER JOIN 
			TB_WDK_EMP 
		ON 
			TB_WDK_USR.WDK_USR_EMP = TB_WDK_EMP.WDK_EMP_COD
		WHERE 
			TB_WDK_USR.WDK_USR_COD = '".$_SESSION['codigo']."'
		";
		$SecQueryApply = mysqli_query($bd_conexao, $SecQuery);
		$SecQueryResults = mysqli_num_rows($SecQueryApply); 
		if($SecQueryResults > 0)
		{
			while($ResultSecRow = mysqli_fetch_array($SecQueryApply)) 
			{
				$sec_usr[0] 	= $ResultSecRow["WDK_USR_COD"];
				$sec_usr[1] 	= $ResultSecRow["WDK_USR_NOM"];
				$sec_usr[2] 	= $ResultSecRow["WDK_USR_EMA"];
				$sec_usr[3] 	= $ResultSecRow["WDK_USR_ACE"];
				$sec_usr[4] 	= $ResultSecRow["WDK_USR_EMP"];
				$sec_usr[5] 	= $ResultSecRow["WDK_EMP_NOM"];
				$sec_usr[5] 	= $ResultSecRow["WDK_EMP_HST"];
				$sec_usr[6] 	= $ResultSecRow["WDK_EMP_SNH"];
			}
		}
	}

?>