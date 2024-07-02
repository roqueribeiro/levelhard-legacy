<?php

	header('Content-Type: text/html; charset=utf-8');
		
	function wclin_pac_age($str) 
	{
		$data = @split("/",$str);	
		$diab = $data[0];
		$mesb = $data[1];
		$anob = $data[2];
		
		if($diab > 0 and $mesb > 0 and $anob > 1800)
		{
			list($dia,$mes,$ano) = explode("/",date("d/m/Y"));
			$idade = $ano-$anob;
			$idade = (($mes<$mesb) or (($mes==$mesb) and ($dia<$diab))) ? --$idade : $idade;
			if($idade == 1)
				$txt = "&nbsp;Ano";
			else
				$txt = "&nbsp;Anos";
				
			return $idade.$txt;
		}
	}
	
	function wclin_tipo($str)
	{
		if($str == 1)
			return "Consulta";
		elseif($str == 2)
			return "Retorno";
		else
			return "Não Definido";
	}
	
	function wclin_date_format($str)
	{
		list($d,$m,$y) 	= explode('/',$str);
		$str_mk			= mktime(0,0,0,$m,$d,$y);
		
		return strftime('%Y-%m-%d',$str_mk);
	}
		
	function wclin_convert($str,$type)
	{
		$convert_lower = array( 
			"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", 
			"v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï", 
			"ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж", 
			"з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы", 
			"ь", "э", "ю", "я" 
		); 
		$convert_upper = array( 
			"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", 
			"V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï", 
			"Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж", 
			"З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ", 
			"Ь", "Э", "Ю", "Я" 
		);
		if($type == 1)
		{//Minúsculo
			return str_replace($convert_upper,$convert_lower,$str);
		}
		if($type == 2)
		{//Maiúsculo
			return str_replace($convert_lower,$convert_upper,$str);
		}
	}
		
	function wclin_format($str)
	{
		$str = str_replace ("Ã","ã",$str);
		$str = str_replace ("Â","â",$str);
		$str = str_replace ("Á","á",$str);
		$str = str_replace ("À","à",$str);
		$str = str_replace ("Ê","ê",$str);
		$str = str_replace ("É","é",$str);
		$str = str_replace ("è","è",$str);
		$str = str_replace ("Í","í",$str);
		$str = str_replace ("Ì","ì",$str);
		$str = str_replace ("Õ","õ",$str);
		$str = str_replace ("Ô","ô",$str);
		$str = str_replace ("Ó","ó",$str);
		$str = str_replace ("Ò","ò",$str);
		$str = str_replace ("Û","û",$str);
		$str = str_replace ("Ú","ú",$str);
		$str = str_replace ("Ù","ù",$str);
		
		$str = str_replace ("ǟ","ã",$str);
		$str = str_replace ("ǁ","á",$str);	
		
		$str = wclin_convert($str,1);
		return (ucwords($str));
	}
	
	function wclinClnData($cod,$return)
	{
		$Query 			= "SELECT CLN_CLN_NOM, CLN_CLN_CNP, CLN_CLN_TEL, CLN_CLN_FAX, CLN_CLN_USR FROM TB_CLN_CLN WHERE CLN_CLN_COD = '".$cod."';";
		$QueryApply 	= mysql_query($Query);
		$QueryResults 	= mysql_num_rows($QueryApply);
		if ($QueryResults != 0)
		{
			while ($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result[1] = $ResultRow["CLN_CLN_NOM"];
				$bd_result[2] = $ResultRow["CLN_CLN_CNP"];
				$bd_result[3] = $ResultRow["CLN_CLN_TEL"];
				$bd_result[4] = $ResultRow["CLN_CLN_FAX"];
				$bd_result[5] = $ResultRow["CLN_CLN_USR"];
			}
			
			if($return = 1)
				return $bd_result[1];
			if($return = 2)
				return $bd_result[2];
			if($return = 3)
				return $bd_result[3];
			if($return = 4)
				return $bd_result[4];
			if($return = 5)
				return $bd_result[5];
		}
	}
	
	function wclinClnCID($cod)
	{
		$Query = "
		SELECT 
			DATE_FORMAT(CLN_ATN_DAT,'%d/%m/%Y'), 
			CLN_ATN_CID 
		FROM 
			TB_CLN_ATN 
		WHERE 
			CLN_ATN_PAC = '".$cod."' 
		AND
			CLN_ATN_CID <> ''
		ORDER BY 
			CLN_ATN_DAT DESC
		LIMIT 
			0,3;
		";
		$QueryApply 		= mysql_query($Query);
		$QueryResults 	= mysql_num_rows($QueryApply);
		if ($QueryResults > 0)
		{
			while($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result[0] = $ResultRow[0];
				$bd_result[1] = $ResultRow[1];
				
				@$wclin_cid .= "<ul><li style=\"width:50px\">".strtoupper($bd_result[1])."</li><li>".$bd_result[0]."</li></ul>";
			}
		}
		else
		{
			@$wclin_cid = "Não Possuí";
		}
		
		return @$wclin_cid;
	}
			
	$wclin_lang["sitename"] = "Bem-Vindo(a) ao WebClin";
	
	$wclin_error_msg[0] = '
	<div id="wclin_error_msg">
		<ul>
			<li><img src="wclin_theme/wclin_default/wclin_image/wclin_icon_error.png"></li>
			<li><p style="color:#F00"><b>Erro!</b> Acesso Negado ao Sistema.</p></li>
		</ul>
		<ul>
			<li><input type="button" value="Recarregar" onclick="window.location = \'index.php\'"></li>
		</ul>			
	</div>
	';
	
	$wclin_error_msg[1] = '
	<div id="wclin_error_msg">
		<ul>
			<li><img src="wclin_theme/wclin_default/wclin_image/wclin_icon_error.png"></li>
			<li><p style="color:#F00"><b>Erro!</b> Acesso Negado ao Banco de Dados.</p></li>
		</ul>
		<ul>
			<li><input type="button" value="Recarregar" onclick="window.location = \'index.php\'"></li>
		</ul>			
	</div>
	';

?>