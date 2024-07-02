<? 

function odontograma($Company, $PacienteID, $CCSTCST, $ExpertID)
{
	require("./common/db/config.inc.php");
	require_once("./common/db/Database.class.php");
	$db = new Database($config['server'], $config['user'], $config['pass'], $config['database'], $config['tablePrefix']);
	$db->connect();
	
	Global $database, $fusotime;
//echo  $Company." company ".$PacienteID." paciente ".$CCSTCST." consulta
//".$ExpertID." expert ";
	// fazer a validacao se esta ï¿½ primeira consulta.i
	$_SESSION["cliente"] = $PacienteID;
	$_SESSION["consulta"] = $CCSTCST;
	$_SESSION["nome_cliente"] = $PacienteID;


	//Insere os dados necessï¿½rios na tabela de acesso

	//Verifica se a consulta esta aberta e se o flag de odonto está incluido
	$sqlConsulta = "SELECT Status, I_ODO from TB_CST_SAU where C_CST_CST = $CCSTCST";
	//echo $sqlConsulta."<br>";
	//$rowConsulta = $db->query_first($sqlConsulta);

	$result = MetabaseQuery($database,$sqlConsulta);

	$status = MetabaseFetchResult($database,$result,0,0);
	$i_odo = MetabaseFetchResult($database,$result,0,1);
	
	/*
	 * clonar Ãºltima consulta
	 */	
	
	//$sqlConsulta = "SELECT Status from TB_CST_SAU where C_CST_CST = $CCSTCST";
	//$rowConsulta = $db->query_first($sqlConsulta);
	
	
	//$sqlTMP = "SELECT count(C_CST_CST) as total from TB_TMP_ODO where C_CST_CST = $CCSTCST";
	//$rowTMP = $db->query_first($sqlTMP);
	//&& ($rowTMP['total'] == 0 || $rowTMP['total'] == 1 )
	
		
		//echo("### CREATION ###");
	//	$queryDuplicate = "SELECT C_CST_CST from TB_CST_SAU where D_CST_CST = (SELECT max(D_CST_CST) from TB_CST_SAU where  Status = 1 and I_ODO = 1 and C_USR_USR = $PacienteID)";


		$queryDuplicate = "SELECT max(C_CST_CST) as C_CST_CST FROM TB_CST_SAU WHERE STATUS = 1 AND I_ODO = 1 AND C_USR_USR = $PacienteID ";
		//echo $queryDuplicate."\n";
		$rowq = $db->query_first($queryDuplicate);
		$newcid = $rowq['C_CST_CST'];
		
		//ECHO $newcid."    ".$CCSTCST."  ".$queryDuplicate." <BR>";
		//if($CCSTCST < $newcid):
		
		//echo ("### $newcid ###");
	//	$_SESSION["cid"] = $newcid;
		
		$data['tmp'] = 0;
		$data['odo_id'] = $CCSTCST;

		//$statusDuplicate = "insert into status (odo_id, dente, status_1, status_2, status_3) select $CCSTCST, dente, status_1, status_2, status_3 from status where odo_id =" .$newcid  ;
		//$db->query($statusDuplicate);
	//	$db->query_update("status",$data, " tmp = 1 and odo_id =" . $CCSTCST);

		//echo $SQL."\n";
	
	//$flag_cos_ini  não permite que seja duplicada caso flag de odonto já marcado e consulta em aberto
	if (!$i_odo)
	{
		$SQL = "UPDATE TB_CST_SAU set I_ODO = 1 where C_USR_USR = $PacienteID and C_CST_CST = $CCSTCST";
		MetabaseQuery($database,$SQL);

		//echo $newcid."   num consulta anterior  <br>";

		if($newcid)
		{
			$_SESSION['new'] = 1;

			//Busca as ações realizadas anteriormente e define o profissional que a realizou
			$SQL = "SELECT CST.C_MED_CST, CST.C_CST_CST, ACA.dente, ACA.acao_1, ACA.acao_2, ACA.acao_3, ACA.acao_4, ACA.acao_5, ACA.acao_6, ACA.acao_7, ACA.acao_8, ACA.acao_9, ACA.acao_10, ACA.acao_11, 
				  ACA.acao_12, ACA.acao_13, ACA.acao_14, ACA.acao_15, ACA.acao_16, ACA.acao_17, ACA.acao_18, ACA.acao_19, ACA.acao_20, ACA.acao_21, ACA.acao_22, ACA.acao_23, ACA.acao_24, ACA.acao_25, 
				  ACA.acao_26, ACA.acao_27, ACA.acao_28, ACA.acao_29, ACA.acao_30, ACA.acao_31, ACA.acao_32, ACA.acao_33, ACA.acao_34, ACA.acao_35, ACA.acao_36, ACA.acao_37, ACA.acao_38,
				  ACA.acao_39, ACA.acao_40 FROM TB_CST_SAU CST, acoes ACA WHERE ACA.odo_id = CST.C_CST_CST AND CST.STATUS = 1 AND CST.I_ODO = 1 AND CST.C_USR_USR = $PacienteID 
				  ORDER BY DATE_FORMAT(D_CST_CST,\"%Y%m%d%H%i\"), CST.C_CST_CST, ACA.dente";
			//echo $SQL."<br>";
			
			$result2 = MetabaseQuery($database,$SQL);
			$NumRows = @MetabaseNumberOfRows($database,$result2);

			
			FOR($i=0;$i<$NumRows;$i++)
			{
				$medic = MetabaseFetchResult($database,$result2,$i,0);
				$consulta = MetabaseFetchResult($database,$result2,$i,1);
				$dente = MetabaseFetchResult($database,$result2,$i,2);

				//echo $consulta." Consulta ".$medic. " medico  ".$ExpertID."  prof logado <br>";  
				for($z=0;$z<40;$z++)
				{
					$zz = $z+3;
					
					$acao = MetabaseFetchResult($database,$result2,$i,$zz);

					//caso realizado por outro medico e ação igual a 2 muda para 3 (realizado por outro profissional)
					if($medic != $ExpertID && $acao == 2)
					{
						$arr_acao[$dente][$z] = 3;
					}
					else
					{
						$arr_acao[$dente][$z] = $acao;
					}
					//echo $dente."dente  ".$zz." posicao do campo -> ".$arr_acao[$dente][$z]." <br> ";
				}
			}

			//Pega os dados das ações para incluir no novo atendimento
//			$SQL = "select $CCSTCST, dente, acao_1, acao_2, acao_3, acao_4, acao_5, acao_6, acao_7, acao_8, acao_9, acao_10, acao_11, acao_12, acao_13, acao_14, acao_15, acao_16, acao_17, 
//			  acao_18, acao_19, acao_20, acao_21, acao_22, acao_23, acao_24, acao_25, acao_26, acao_27, acao_28, acao_29, acao_30, acao_31, acao_32, acao_33, acao_34, acao_35, acao_36, acao_37, acao_38, 
//			  acao_39, 0, 0, 0 , 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 from acoes where odo_id =" . $newcid ;  

			$acoesDuplicate_Cab = "insert into acoes (odo_id, dente, acao_1, acao_2, acao_3, acao_4, acao_5, acao_6, acao_7, acao_8, acao_9, acao_10, acao_11, acao_12, acao_13, acao_14, acao_15, acao_16, 
			  acao_17, acao_18, acao_19, acao_20, acao_21, acao_22, acao_23, acao_24, acao_25, acao_26, acao_27, acao_28, acao_29, acao_30, acao_31, acao_32, acao_33, acao_34, acao_35, acao_36, acao_37, 
			  acao_38, acao_39, acao_40, I_ATU_1, I_ATU_2, I_ATU_3, I_ATU_4, I_ATU_5, I_ATU_6, I_ATU_7, I_ATU_8, I_ATU_9, I_ATU_10, I_ATU_11, I_ATU_12, I_ATU_13, I_ATU_14, I_ATU_15, I_ATU_16, I_ATU_17, I_ATU_18, 
			  I_ATU_19, I_ATU_20, I_ATU_21, I_ATU_22, I_ATU_23, I_ATU_24, I_ATU_25, I_ATU_26, I_ATU_27, I_ATU_28, I_ATU_29, I_ATU_30, I_ATU_31, I_ATU_32, I_ATU_33, I_ATU_34, I_ATU_35, I_ATU_36, I_ATU_37, 
			  I_ATU_38, I_ATU_39, I_ATU_40) VALUES ($CCSTCST";

			$tot_dentes = count($arr_acao);
			reset($arr_acao);
			//echo $tot_dentes." total de dentes <br>";
			for($i=0;$i<$tot_dentes;$i++)
			{
				$dente = key($arr_acao);
			
				$tot_acoes = count($arr_acao[$dente]);
				//echo $total_acoes." total de acoes <br> ";
				FOR($z=0;$z<$tot_acoes;$z++)
				{
					$k = key($arr_acao[$dente]);
					$acoesDuplicate .= ",".$arr_acao[$dente][$k];
					next($arr_acao[$dente]);
				}
				$acoesDuplicate2 .= ", 0, 0, 0 , 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)"; 
				$SQL = $acoesDuplicate_Cab.",".$dente.$acoesDuplicate.$acoesDuplicate2;
				//$db->query($acoesDuplicate);
				$result2 = MetabaseQuery($database,$SQL);

				next($arr_acao);
				$acoesDuplicate2 = "";
				$acoesDuplicate = "";
			}
	
			//$db->query($acoesDuplicate);
			  //	$db->query_update("acoes", $data, "  tmp = 1 and odo_id =" . $CCSTCST);
				  
			$dentesDuplicate = "insert into dentes (odo_id, dente, dente_1, dente_2, dente_3, dente_4, dente_5, I_ATU_1, I_ATU_2, I_ATU_3, I_ATU_4, I_ATU_5) select $CCSTCST, dente, dente_1, dente_2, dente_3, 
				  dente_4, dente_5, 0, 0, 0, 0, 0 from dentes where odo_id =" . $newcid;
			$db->query($dentesDuplicate);
			  //	$db->query_update("dentes", $data, " tmp = 1 and odo_id =" . $CCSTCST);
			//echo $dentesDuplicate." \n";  
			//$globaisDuplicate = "insert into globais (odo_id, global_1, global_2, global_3, global_4, global_5, global_6, global_7, global_8, global_9, global_10, global_11, global_12, global_13, global_14, 
			//		    I_ATU_1, I_ATU_2, I_ATU_3, I_ATU_4, I_ATU_5, I_ATU_6, I_ATU_7, I_ATU_8, I_ATU_9, I_ATU_10, I_ATU_11, I_ATU_12, I_ATU_13, I_ATU_14,) select $CCSTCST, global_1, global_2, 
			//  global_3, global_4, global_5,global_6,global_7,global_8,global_9,global_10,global_11,global_12,global_13,global_14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 from globais where odo_id =" . $newcid ;

			$globaisDuplicate = "insert into globais (odo_id, global_1, global_2, global_3, global_4, global_5, global_6, global_7, global_8, global_9, global_10, global_11, global_12, I_ATU_1, I_ATU_2, I_ATU_3, I_ATU_4, I_ATU_5, I_ATU_6, I_ATU_7, I_ATU_8, I_ATU_9, I_ATU_10, I_ATU_11, I_ATU_12, ) select $CCSTCST, global_1, global_2, 
			  global_3, global_4, global_5,global_6, global_7, global_8,global_9, global_10, global_11,global_12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0  from globais where odo_id =" . $newcid ;

			//echo $globaisDuplicate." <br>";
			$db->query($globaisDuplicate);
			  //	$db->query_update("globais", $data, "  tmp = 1 and odo_id =" . $CCSTCST);
			  
			$PropriedadesDuplicate = "insert into propriedades (odo_id, dente, propriedade_1, propriedade_2, propriedade_3, propriedade_4, propriedade_5, propriedade_6, propriedade_7, propriedade_8, propriedade_9, 
				propriedade_10, propriedade_11, propriedade_12, propriedade_13, propriedade_14, propriedade_15, propriedade_16, propriedade_17, propriedade_18, propriedade_19, propriedade_20, propriedade_21, propriedade_22, 
				I_ATU_1, I_ATU_2, I_ATU_3, I_ATU_4, I_ATU_5, I_ATU_6, I_ATU_7, I_ATU_8, I_ATU_9, I_ATU_10, I_ATU_11, I_ATU_12, I_ATU_13, I_ATU_14, I_ATU_15, I_ATU_16, I_ATU_17, I_ATU_18, I_ATU_19, I_ATU_20, I_ATU_21, I_ATU_22)
				select $CCSTCST, dente, propriedade_1, propriedade_2, propriedade_3, propriedade_4, propriedade_5, propriedade_6, propriedade_7, propriedade_8, propriedade_9, propriedade_10, propriedade_11, propriedade_12, 
				propriedade_13, propriedade_14, propriedade_15, propriedade_16, propriedade_17, propriedade_18, propriedade_19, propriedade_20, propriedade_21, propriedade_22, 
				0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 from propriedades where odo_id =" . $newcid ;
			$db->query($PropriedadesDuplicate);
			//echo $PropriedadesDuplicate."<br>";
		  //	$db->query_update("propriedades", $data, " tmp = 1 and odo_id =" . $CCSTCST);

			//$db->query("insert into TB_TMP_ODO values ($CCSTCST)");
		}
		
	}
	
	
	// else 

	//exit;

	$tela = "   
	
	<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
	<head>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
	<title>ODONTOGRAMA</title>
	<script language=\"JavaScript\" type=\"text/javascript\">
	<!--
	//v1.7
	// Flash Player Version Detection
	// Detect Client Browser type
	// Copyright 2005-2008 Adobe Systems Incorporated.  All rights reserved.
	var isIE  = (navigator.appVersion.indexOf(\"MSIE\") != -1) ? true : false;
	var isWin = (navigator.appVersion.toLowerCase().indexOf(\"win\") != -1) ? true : false;
	var isOpera = (navigator.userAgent.indexOf(\"Opera\") != -1) ? true : false;
	function ControlVersion()
	{
		var version;
		var axo;
		var e;
		// NOTE : new ActiveXObject(strFoo) throws an exception if strFoo isn't in the registry
		try {
			// version will be set for 7.X or greater players
			axo = new ActiveXObject(\"ShockwaveFlash.ShockwaveFlash.7\");
			version = axo.GetVariable(\"$version\");
		} catch (e) {
		}
		if (!version)
		{
			try {
				// version will be set for 6.X players only
				axo = new ActiveXObject(\"ShockwaveFlash.ShockwaveFlash.6\");
				
				// installed player is some revision of 6.0
				// GetVariable(\"$version\") crashes for versions 6.0.22 through 6.0.29,
				// so we have to be careful. 
				
				// default to the first public version
				version = \"WIN 6,0,21,0\";
				// throws if AllowScripAccess does not exist (introduced in 6.0r47)		
				axo.AllowScriptAccess = \"always\";
				// safe to call for 6.0r47 or greater
				version = axo.GetVariable(\"$version\");
			} catch (e) {
			}
		}
		if (!version)
		{
			try {
				// version will be set for 4.X or 5.X player
				axo = new ActiveXObject(\"ShockwaveFlash.ShockwaveFlash.3\");
				version = axo.GetVariable(\"$version\");
			} catch (e) {
			}
		}
		if (!version)
		{
			try {
				// version will be set for 3.X player
				axo = new ActiveXObject(\"ShockwaveFlash.ShockwaveFlash.3\");
				version = \"WIN 3,0,18,0\";
			} catch (e) {
			}
		}
		if (!version)
		{
			try {
				// version will be set for 2.X player
				axo = new ActiveXObject(\"ShockwaveFlash.ShockwaveFlash\");
				version = \"WIN 2,0,0,11\";
			} catch (e) {
				version = -1;
			}
		}
		
		return version;
	}
	// JavaScript helper required to detect Flash Player PlugIn version information
	function GetSwfVer(){
		// NS/Opera version >= 3 check for Flash plugin in plugin array
		var flashVer = -1;
		
		if (navigator.plugins != null && navigator.plugins.length > 0) {
			if (navigator.plugins[\"Shockwave Flash 2.0\"] || navigator.plugins[\"Shockwave Flash\"]) {
				var swVer2 = navigator.plugins[\"Shockwave Flash 2.0\"] ? \" 2.0\" : \"\";
				var flashDescription = navigator.plugins[\"Shockwave Flash\" + swVer2].description;
				var descArray = flashDescription.split(\" \");
				var tempArrayMajor = descArray[2].split(\".\");			
				var versionMajor = tempArrayMajor[0];
				var versionMinor = tempArrayMajor[1];
				var versionRevision = descArray[3];
				if (versionRevision == \"\") {
					versionRevision = descArray[4];
				}
				if (versionRevision[0] == \"d\") {
					versionRevision = versionRevision.substring(1);
				} else if (versionRevision[0] == \"r\") {
					versionRevision = versionRevision.substring(1);
					if (versionRevision.indexOf(\"d\") > 0) {
						versionRevision = versionRevision.substring(0, versionRevision.indexOf(\"d\"));
					}
				}
				var flashVer = versionMajor + \".\" + versionMinor + \".\" + versionRevision;
			}
		}
		// MSN/WebTV 2.6 supports Flash 4
		else if (navigator.userAgent.toLowerCase().indexOf(\"webtv/2.6\") != -1) flashVer = 4;
		// WebTV 2.5 supports Flash 3
		else if (navigator.userAgent.toLowerCase().indexOf(\"webtv/2.5\") != -1) flashVer = 3;
		// older WebTV supports Flash 2
		else if (navigator.userAgent.toLowerCase().indexOf(\"webtv\") != -1) flashVer = 2;
		else if ( isIE && isWin && !isOpera ) {
			flashVer = ControlVersion();
		}	
		return flashVer;
	}
	// When called with reqMajorVer, reqMinorVer, reqRevision returns true if that version or greater is available
	function DetectFlashVer(reqMajorVer, reqMinorVer, reqRevision)
	{
		versionStr = GetSwfVer();
		if (versionStr == -1 ) {
			return false;
		} else if (versionStr != 0) {
			if(isIE && isWin && !isOpera) {
				// Given \"WIN 2,0,0,11\"
				tempArray         = versionStr.split(\" \"); 	// [\"WIN\", \"2,0,0,11\"]
				tempString        = tempArray[1];			// \"2,0,0,11\"
				versionArray      = tempString.split(\",\");	// ['2', '0', '0', '11']
			} else {
				versionArray      = versionStr.split(\".\");
			}
			var versionMajor      = versionArray[0];
			var versionMinor      = versionArray[1];
			var versionRevision   = versionArray[2];
			// is the major.revision >= requested major.revision AND the minor version >= requested minor
			if (versionMajor > parseFloat(reqMajorVer)) {
				return true;
			} else if (versionMajor == parseFloat(reqMajorVer)) {
				if (versionMinor > parseFloat(reqMinorVer))
					return true;
				else if (versionMinor == parseFloat(reqMinorVer)) {
					if (versionRevision >= parseFloat(reqRevision))
						return true;
				}
			}
			return false;
		}
	}
	function AC_AddExtension(src, ext)
	{
	if (src.indexOf('?') != -1)
	return src.replace(/\?/, ext+'?'); 
	else
	return src + ext;
	}
	function AC_Generateobj(objAttrs, params, embedAttrs) 
	{ 
	var str = '';
	if (isIE && isWin && !isOpera)
	{
	str += '<object ';
	for (var i in objAttrs)
	{
	str += i + '=\"' + objAttrs[i] + '\" ';
	}
	str += '>';
	for (var i in params)
	{
	str += '<param name=\"' + i + '\" value=\"' + params[i] + '\" /> ';
	}
	str += '</object>';
	}
	else
	{
	str += '<embed ';
	for (var i in embedAttrs)
	{
	str += i + '=\"' + embedAttrs[i] + '\" ';
	}
	str += '> </embed>';
	}
	document.write(str);
	}
	function AC_FL_RunContent(){
	var ret = 
	AC_GetArgs
	(  arguments, \".swf\", \"movie\", \"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\"
	, \"application/x-shockwave-flash\"
	);
	AC_Generateobj(ret.objAttrs, ret.params, ret.embedAttrs);
	}
	function AC_SW_RunContent(){
	var ret = 
	AC_GetArgs
	(  arguments, \".dcr\", \"src\", \"clsid:166B1BCA-3F9C-11CF-8075-444553540000\"
	, null
	);
	AC_Generateobj(ret.objAttrs, ret.params, ret.embedAttrs);
	}
	function AC_GetArgs(args, ext, srcParamName, classid, mimeType){
	var ret = new Object();
	ret.embedAttrs = new Object();
	ret.params = new Object();
	ret.objAttrs = new Object();
	for (var i=0; i < args.length; i=i+2){
	var currArg = args[i].toLowerCase();    
	switch (currArg){	
	case \"classid\":
		break;
	case \"pluginspage\":
		ret.embedAttrs[args[i]] = args[i+1];
		break;
	case \"src\":
	case \"movie\":	
		args[i+1] = AC_AddExtension(args[i+1], ext);
		ret.embedAttrs[\"src\"] = args[i+1];
		ret.params[srcParamName] = args[i+1];
		break;
	case \"onafterupdate\":
	case \"onbeforeupdate\":
	case \"onblur\":
	case \"oncellchange\":
	case \"onclick\":
	case \"ondblclick\":
	case \"ondrag\":
	case \"ondragend\":
	case \"ondragenter\":
	case \"ondragleave\":
	case \"ondragover\":
	case \"ondrop\":
	case \"onfinish\":
	case \"onfocus\":
	case \"onhelp\":
	case \"onmousedown\":
	case \"onmouseup\":
	case \"onmouseover\":
	case \"onmousemove\":
	case \"onmouseout\":
	case \"onkeypress\":
	case \"onkeydown\":
	case \"onkeyup\":
	case \"onload\":
	case \"onlosecapture\":
	case \"onpropertychange\":
	case \"onreadystatechange\":
	case \"onrowsdelete\":
	case \"onrowenter\":
	case \"onrowexit\":
	case \"onrowsinserted\":
	case \"onstart\":
	case \"onscroll\":
	case \"onbeforeeditfocus\":
	case \"onactivate\":
	case \"onbeforedeactivate\":
	case \"ondeactivate\":
	case \"type\":
	case \"codebase\":
	case \"id\":
		ret.objAttrs[args[i]] = args[i+1];
		break;
	case \"width\":
	case \"height\":
	case \"align\":
	case \"vspace\": 
	case \"hspace\":
	case \"class\":
	case \"title\":
	case \"accesskey\":
	case \"name\":
	case \"tabindex\":
		ret.embedAttrs[args[i]] = ret.objAttrs[args[i]] = args[i+1];
		break;
	default:
		ret.embedAttrs[args[i]] = ret.params[args[i]] = args[i+1];
	}
	}
	ret.objAttrs[\"classid\"] = classid;
	if (mimeType) ret.embedAttrs[\"type\"] = mimeType;
	return ret;
	}
	// -->
	</script>
	</head>
	<body bgcolor=\"#ffffff\">
	<iframe name=\"odonto\" src=\"\" width=\"1px\" height=\"1px\"></iframe>
	<!--url's used in the movie-->
	<!--text used in the movie-->
	<!--
	<p align=\"left\"></p>
	<p align=\"right\"></p>
	<p align=\"right\"></p>
	-->
	<!-- saved from url=(0013)about:internet -->
	<script language=\"JavaScript\" type=\"text/javascript\">
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '1024',
			'height', '717',
			'src', 'dentista',
			'quality', 'high',
			'pluginspage', 'http://www.adobe.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'dentista',
			'bgcolor', '#ffffff',
			'name', 'dentista',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', 'dentista',
			'salign', '',
			'flashvars', 'tempoDados=60000'
			); //end AC code
	</script>
	<noscript>
		<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"1024\" height=\"717\" id=\"dentista\" align=\"middle\">
		<param name=\"allowScriptAccess\" value=\"sameDomain\" />
		<param name=\"allowFullScreen\" value=\"false\" />
		<param name=\"wmode\" value=\"transparent\">
		<param name=\"flashvars\" value=\"tempoDados=5000\" />
		<param name=\"movie\" value=\"dentista.swf\" /><param name=\"quality\" value=\"high\" /><param name=\"bgcolor\" value=\"#ffffff\" />	<embed src=\"dentista.swf\" quality=\"high\" bgcolor=\"#ffffff\" width=\"1024\" height=\"717\" name=\"dentista\" align=\"middle\" allowScriptAccess=\"sameDomain\" allowFullScreen=\"false\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.adobe.com/go/getflashplayer\" />
		</object>
	</noscript>
	</body>
	</html>
	";
	return $tela;
}
?>
