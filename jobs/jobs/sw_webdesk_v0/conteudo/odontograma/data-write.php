<?
session_start();
require("./common/db/config.inc.php");
require("common/db/connect.php");
require("common/admin/security.php");
require("common/admin/admin.php");
require("common/db/config.inc.php");
require("common/db/Database.class.php");

$G_Security = new GaqSecurity;
$ExpertID = $G_Security->Validate(&$fusotime);
$G_Admin = new GaqAdmin($ExpertID, $_SESSION["cliente"]);

$cid = $_SESSION['consulta'];

//checa o acesso 
if ($G_Admin->ExpertCan["ManageConsulta"] and $G_Admin->ExpertCan["Odonto"]) 
{
	$Query 	 = "SELECT C_ICC_CST FROM  TB_CST_SAU WHERE C_CST_CST = $cid AND (C_MED_CST = $ExpertID) AND (Status = 0) AND C_USR_USR =".$_SESSION["cliente"];
	echo $Query;
	$result  = @MetabaseQuery($database,$Query);
	$CCSTCST = @MetabaseFetchResult($database,$result,0,0);
	
	if(!$CCSTCST)
	{
	    exit;  
	}
}
else
{
	exit;
}
 
 

  
$db = new Database($config['server'], $config['user'], $config['pass'], $config['database'], $config['tablePrefix']);
$db->connect();

//Primeiro
$quadrante [1]= 1;
$quadrante [2]= 1;
$quadrante [3]= 1;
$quadrante [4]= 1;
$quadrante [5]= 1;

$quadrante [6]= 1;
$quadrante [7]= 1;
$quadrante [8]= 1;

//Segundo
$quadrante [9]= 2;
$quadrante [10]= 2;
$quadrante [11]= 2;
$quadrante [12]= 2;
$quadrante [13]= 2;
$quadrante [14]= 2;
$quadrante [15]= 2;
$quadrante [16]= 2;

//Terceiro
$quadrante [17]= 2;
$quadrante [18]= 2;
$quadrante [19]= 2;
$quadrante [20]= 2;
$quadrante [21]= 2;
$quadrante [22]= 2;
$quadrante [23]= 2;
$quadrante [24]= 2;

//Quarto
$quadrante [25]= 2;
$quadrante [26]= 2;
$quadrante [27]= 2;
$quadrante [28]= 2;
$quadrante [29]= 2;
$quadrante [30]= 2;
$quadrante [31]= 2;
$quadrante [32]= 2;

//Anteriores = 1
$posicao[6]= 1;
$posicao[7]= 1;
$posicao[8]= 1;
$posicao[9]= 1;
$posicao[10]= 1;
$posicao[11]= 1;
$posicao[22]= 1;
$posicao[23]= 1;
$posicao[24]= 1;
$posicao[25]= 1;
$posicao[26]= 1;
$posicao[27]= 1;

//Posteriores =2
$posicao[1]= 2;
$posicao[2]= 2;
$posicao[3]= 2;
$posicao[4]= 2;
$posicao[5]= 2;
$posicao[12]= 2;
$posicao[13]= 2;
$posicao[14]= 2;
$posicao[15]= 2;
$posicao[16]= 2;
$posicao[17]= 2;
$posicao[18]= 2;
$posicao[19]= 2;
$posicao[20]= 2;
$posicao[21]= 2;
$posicao[28]= 2;
$posicao[29]= 2;
$posicao[30]= 2;
$posicao[31]= 2;
$posicao[32]= 2;


//Quantidade de Raizes nos dentes

$radicu[1]=3;
$radicu[2]=3;
$radicu[3]=3;

$radicu[4]=1;

$radicu[5]=2;

$radicu[6]=1;
$radicu[7]=1;
$radicu[8]=1;
$radicu[9]=1;
$radicu[10]=1;
$radicu[11]=1;

$radicu[12]=2;

$radicu[13]=1;

$radicu[14]=3;
$radicu[15]=3;
$radicu[16]=3;

$radicu[17]=2;
$radicu[18]=2;
$radicu[19]=2;

$radicu[20]=1;
$radicu[21]=1;
$radicu[22]=1;
$radicu[23]=1;
$radicu[24]=1;
$radicu[25]=1;
$radicu[26]=1;
$radicu[27]=1;
$radicu[28]=1;
$radicu[29]=1;

$radicu[30]=2;
$radicu[31]=2;
$radicu[32]=2;


//Codigo do procedimento muda de acordo com a propriedade do dente permanente ou não

//$pro_prop[414020138][1][0] = 414020120;

//opção 0 é dente Permanente
// $aca_dent[1][0]= ;
// $aca_dent[2][0]= ;
// $aca_dent[3][0]= ;
// $aca_dent[4][0]= ;
// $aca_dent[5][0]= ;

//Codigo do procedimento com mais de uma ocorrencia





$acao_cod[2] = 414020138;

$glob_cod[1] = 101020074;
$glob_cod[2] = 101020074;
$glob_cod[3] = 101020074;
$glob_cod[4] = 101020074;
$glob_cod[5] = 101020074;




// var_dump($_POST);
// echo '#####';
// var_dump($_GET);

function captur_info($string_odon)
{//pega as informações do HTML e joga no array para incluão
 //03/02/2012
 //Mario Costa

      
    //Configuração do array de envio
    //divisao de dentes          	|
    //divisao entre procedimentos   	_
    //divisao de itens procedimento    	,
    //divisao sub procedimento   	-
      
    //quebra por dentes
    $dent = explode("|",$string_odon);

    reset($dent);
    $tot_dent = count($dent);

    for($x=0;$x<$tot_dent;$x++)
    {
	  

	  //retira os procedimentos
	  $proced = explode("_",$dent[$x]);
	  
	  $tot_proced = count($proced[$x])
	  

	  for($i=0;$i<$tot_proced;$i++)
	  {
		if(!$i)
		{
		      $dente = $proced[$i];   //retira o dente 
		}
		else
		{
		      $iten_proc = explode(",",$proced[$i]);
		}

		$TOT_itens_proc = count($iten_proc);

		for($z=0;$z<$TOT_itens_proc;$z++)
		{
			if(!$z)
			{
			      $procedimento = $iten_proc[$z];  //procedimento
			}
			else
			{
			      $sub_proc = explode("-",$sub_proc[$z]);

			      $itens_proc = $sub_procedi[0]; //itens do procedimento
			      $sub_procedimento = $sub_procedi[1]; //sub procedimento
			}

			//TB_ODO_ACA_SAU
			
			//TB_ODO_PRO_SAU
			
			//TB_ODO_VIS_SAU
			
			//TB_ODO_GLO_SAU

			//insere no banco de dados
			$SQL = "INSERT INTO ";



			next($iten_proc);
		}
		next($proced);
	  }
	  next($dent);
    }


}


function translateTrueFalse($ins)
{
	if ($ins == 'true')
	{
		return 1;
	}
	else if($ins == 'false')
	{
		return 0;
	}
	return $ins;
}

function assertNum($num)
{
	try
	{
		return intval($num);
	}
	catch(Exception $e)
	{
		return 0;
	}
}


$isTmp = 0;


// if ($_SESSION['new'] != 1 && $isTmp == 0)
// {
// 	$_SESSION['new'] = 1;
// 	//echo("### CREATION ### hhhhhbbbb");
// 
// 	$queryDuplicate = "SELECT max(C_CST_CST) FROM TB_CST_SAU WHERE STATUS = 1 AND I_ODO = 1 AND C_USR_USR = $PacienteID ";
// 	echo $queryDuplicate."\n";
// 	$rowq = $db->query_first($queryDuplicate);
// 	$newcid = $rowq['C_CST_CST'];
// 
// // 	$queryDuplicate = "insert into consultas (data, pas_id, cli_id, med_id, oth_id) SELECT max(data), pas_id, cli_id, med_id, oth_id FROM consultas where cli_id= " . $_SESSION["cliente"] . " group by cli_id ";
// // 	$db->query($queryDuplicate);
// // 	//echo $queryDuplicate." <br> ";
// // 	$newcid = mysql_insert_id();
// 	echo ("### $newcid ###");
// 	$_SESSION["cid"] = $newcid;
// 	
// 	$data['tmp'] = 0;
// 	$data['odo_id'] = $newcid;
// 
// 	//$statusDuplicate = "insert into status (odo_id, dente, status_1, status_2, status_3) select odo_id, dente, status_1, status_2, status_3 from status where odo_id =" .$cid  ;
// 	//$db->query($statusDuplicate);
// 	
// 	//$db->query_update("status",$data, " tmp = 1 and odo_id =" . $cid);
// 
// 	$acoesDuplicate = "insert into acoes (odo_id, dente, acao_1, acao_2, acao_3, I_ATU_1, I_ATU_2, I_ATU_3) select odo_id, dente, acao_1, acao_2, acao_3, 0, 0, 0 from acoes where odo_id =" . $cid ;
// 	$db->query($acoesDuplicate);
// 	$db->query_update("acoes", $data, "  tmp = 1 and odo_id =" . $cid);
// 	
// 	$dentesDuplicate = "insert into dentes (odo_id, dente, dente_1, dente_2, dente_3, dente_4, dente_5, I_ATU_1, I_ATU_2, I_ATU_3, I_ATU_4, I_ATU_5) select odo_id, dente, dente_1, dente_2, dente_3, 
// 		dente_4, dente_5, 0, 0, 0, 0, 0 from dentes where odo_id =" . $cid ;
// 	$db->query($dentesDuplicate);
// 	$db->query_update("dentes", $data, " tmp = 1 and odo_id =" . $cid);
// 	
// 	$globaisDuplicate = "insert into globais (odo_id, global_1, global_2, global_3, global_4, global_5, I_ATU_1, I_ATU_2, I_ATU_3, I_ATU_4, I_ATU_5 ) select odo_id, global_1, global_2, global_3, 
// 		global_4, global_5, 0, 0, 0, 0, 0 from globais where odo_id =" . $cid ;
// 	$db->query($globaisDuplicate);
// 	$db->query_update("globais", $data, "  tmp = 1 and odo_id =" . $cid);
// 	
// 	$PropriedadesDuplicate = "insert into propriedades (odo_id, dente, propriedade_1, propriedade_2, propriedade_3, propriedade_4, propriedade_5, propriedade_6, propriedade_7, propriedade_8, propriedade_9, 
// 	      propriedade_10, propriedade_11, propriedade_12, propriedade_13, propriedade_14, propriedade_15, propriedade_16, propriedade_17, propriedade_18, propriedade_19, propriedade_20, propriedade_21, propriedade_22, 
// 	      I_ATU_1, I_ATU_2, I_ATU_3, I_ATU_4, I_ATU_5, I_ATU_6, I_ATU_7, I_ATU_8, I_ATU_9, I_ATU_10, I_ATU_11, I_ATU_12, I_ATU_13, I_ATU_14, I_ATU_15, I_ATU_16, I_ATU_17, I_ATU_18, I_ATU_19, I_ATU_20, I_ATU_21, I_ATU_22) 
// 	      select odo_id, dente, propriedade_1, propriedade_2, propriedade_3, propriedade_4, propriedade_5, propriedade_6, propriedade_7, propriedade_8, propriedade_9, propriedade_10, propriedade_11, propriedade_12, 
// 	      propriedade_13, propriedade_14, propriedade_15, propriedade_16, propriedade_17, propriedade_18, propriedade_19, propriedade_20, propriedade_21, propriedade_22, 
// 	      0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 from propriedades where odo_id =" . $cid ;
// 	//echo $PropriedadesDuplicate."\n";
// 	/*
//      *  Incluir dentes de cima	
// 	*/
// 	$db->query($PropriedadesDuplicate);
// 	$db->query_update("propriedades", $data, " tmp = 1 and odo_id =" . $cid);
// 	$_SESSION['recover'] = 1;
// 	
// } 
// else

if(isset($_POST['dente1Prop1'])) 
{
	//echo("### UPDATE ###");
	$tmp = 1;
	//echo("### " . $_POST['end']);
	if (isset($_POST['end']) && intval($_POST['end']) == 1)
	{
		//echo("### END ###");
		$tmp = 0;
//		$db->query_update("TB_CST_SAU", array("tmp"=>0), "c_id=".$cid);
		//echo ($cid);
	}
	
	$VAR_ARRAY = array( "Prop", "Acao", "Cima");
	//Totais de eventos dos dentes
	$VAR_CONT = array( "Prop" => 22, "Globais" => 12, "Acao" => 31, "Cima" => 5);
	//Nome das tabelas
	$VAR_TABLES = array( "Prop" => "propriedades", "Globais" => "globais", "Acao" => "acoes", "Cima"=>"dentes");
	//nome das colunas das tabelas
	$VAR_COLUMNS = array( "Prop" => "propriedade_", "Globais" => "global_", "Acao" => "acao_", "Cima"=>"dente_");

	//limpa os campos da tabela
	$SQL = " DELETE FROM propriedades WHERE tmp = 1 and odo_id = ".$cid;
	//echo $SQL." <br> ";
	$result = MetabaseQuery($database,$SQL);

	
	
	for ($i = 0; $i < sizeof($VAR_ARRAY); $i ++)
	{
		$dentesq = "SELECT dente from " . $VAR_TABLES[$VAR_ARRAY[$i]] . " where odo_id = " . $cid;
		$all_rows = $db->fetch_all_array($dentesq);
		$dentesarr = array();

		// print out array later on when we need the info on the page
		foreach($all_rows as $key=>$val)
		{
			array_push($dentesarr, $val['dente']);
		}
	
		$compl_nome = "";
		$compl_nome_dads = "";
		$compl = "";
		$compl_dent = "";
 		$compl_nome_dent ="";
 		$compl_nome_dads_dent = "";

		$query = "UPDATE " . $VAR_TABLES[$VAR_ARRAY[$i]] . " set ";
		$queryI = "INSERT into ". $VAR_TABLES[$VAR_ARRAY[$i]];
	
		$updates = array();
		$inserts = array();
		//Dentes
		for ($n = 1; $n <=32; $n ++)
		{
			$compl = "";
			$compl_nome ="";
			$compl_nome_dads = "";
			$compl_aca = "";
			$tmpq = array();
			$tmp1 = array('nomes'=> array(), 'valores'=> array());
//			if($i== 1)  echo $VAR_CONT[$VAR_ARRAY[$i]]."quant <br> ";
			for ($p = 1; $p <= $VAR_CONT[$VAR_ARRAY[$i]]; $p ++)
			{
				
				$tmppassonome = array();
				$tmppassovalor = array();
				if ($VAR_CONT[$VAR_ARRAY[$i]] == 1)
				{
					$passo = "";
				}
				else
				{
					$passo = $p;
				}
				if($n == 1 && $i == 1)
				echo $n."dente ".$p." ".$VAR_ARRAY[$i]." -  ".assertNum(translateTrueFalse($_POST["dente" . $n . $VAR_ARRAY[$i] . $passo]))."  \n " ;
				if (assertNum(translateTrueFalse($_POST["dente" . $n . $VAR_ARRAY[$i] . $passo])) >= 1)
				{ 

					//OBS: So insere I_ATU_  quando atividade foi realizada na consulta que está aberta caso contrário o valor é 0
					if(in_array($n, $dentesarr))
					{
						array_push($tmpq,  $VAR_COLUMNS[$VAR_ARRAY[$i]] . $p . " = " . assertNum(translateTrueFalse($_POST["dente" . $n . $VAR_ARRAY[$i] . $passo])));
						//echo $n." dentess   \n";
						//echo $_POST["dente" . $n . $VAR_ARRAY[$i] . $passo]." variav ".$passo." num acao";  
						//pega as variaveis importantes para codigo do procedimento
						if($i == 0 ) //procedimentos do dente
						{
						      $props[$n][$p] = 1;
 						      //UPDATE
 						      $compl .=  ", I_ATU_".$p." = 1"; 
 
 						      //INSERT
 						      $compl_nome .=  ", I_ATU_".$p;
 						      $compl_nome_dads .= ", 1";
 						}

						if($i == 1 ) //Açao
						{
							//if($n == 32)
							//{
							//	echo $p." acoes <br>  ";
							//}
						      //echo assertNum(translateTrueFalse($_POST["dente" . $n . $VAR_ARRAY[$i] . $passo]))." dddd <br> ";
						      if(assertNum(translateTrueFalse($_POST["dente" . $n . $VAR_ARRAY[$i] . $passo])) == 2)
						      {
							   $props_acao[$n][$p] = 1;
							   $aux = 1;
						      }
	  					      else $aux = 0;
						      //UPDATE
 						      $compl_aca .=  ", I_ATU_".$p." = ".$aux;
 						}

						if($i == 2 ) //Dentes
						{
						      if(assertNum(translateTrueFalse($_POST["dente" . $n . $VAR_ARRAY[$i] . $passo])) == 3)
						      {
							    $aux = 1;
							    $props_dent[$n][$p] = 1;
						      }
						      else $aux = 0;
						      //UPDATE
 						      $compl_dent .=  ", I_ATU_".$p." = ".$aux;
 
 						}
					}
					else
					{
						array_push($tmp1['valores'],  assertNum(translateTrueFalse($_POST["dente" . $n . $VAR_ARRAY[$i] . $passo])));
						array_push($tmp1['nomes'], $VAR_COLUMNS[$VAR_ARRAY[$i]] . $p);
						
						//pega as variaveis importantes para codigo do procedimento
						if($i == 0 ) 
						{
						      $props[$n][$p] = 1;

						      //UPDATE
						      $compl .=  ", I_ATU_".$p." = 1";

						      //INSERT
						      $compl_nome .=  ", I_ATU_".$p;
						      $compl_nome_dads .= ", 1";
						}
 						if($i == 1 ) //Açao
						{
						      if(assertNum(translateTrueFalse($_POST["dente" . $n . $VAR_ARRAY[$i] . $passo])) == 2)
						      {
							    $aux = 1;
							    $props_acao[$n][$p] = 1;
						      }
						      else
						      {
							    $aux = 0;
							    //$props_acao[$n][$p] = 0;
						      }
						      //UPDATE
 						      $compl_aca .=  ", I_ATU_".$p." = ".$aux;
 						}
						if($i == 2 ) //Dentes
						{
						      

						      if(assertNum(translateTrueFalse($_POST["dente" . $n . $VAR_ARRAY[$i] . $passo])) == 3)
						      {
							    $aux = 1;
							    $props_dent[$n][$p] = 1;
						      }
						      else $aux = 0;
						      //UPDATE
 						      $compl_dent .=  ", I_ATU_".$p." = ".$aux;
 						}
					}
				}
			} 
			//echo var_dump($tmp1);
			if (sizeof($tmpq) > 0)
			{
				array_push($updates, $query . join(", ", $tmpq).$compl.$compl_dent.$compl_aca.", tmp=0 where dente = " . $n . " and odo_id =" . $cid);
				$db->query($query . join(", ", $tmpq) . $compl.$compl_dent.$compl_aca.", tmp=" . $tmp .  " where dente = " . $n . " and odo_id =" . $cid);
			}
			if (sizeof($tmp1['nomes']) > 0)
			{
				array_push($inserts, $queryI . " (odo_id, dente, " . join(", ", $tmp1['nomes']) .$compl_nome.") values (" . $cid . " , " . $n . " ," . join(", ", $tmp1['valores']) .$compl_nome_dads. ")");
				$db->query($queryI . " (odo_id, dente, " . join(", ", $tmp1['nomes']) . $compl_nome.") values (" . $cid . " , " . $n . " ," . join(", ", $tmp1['valores']) . $compl_nome_dads.")");
			}
		}

		if($i == 1)
		{
		      //echo $VAR_TABLES[$VAR_ARRAY[$i]]."<br>";
		      //echo ("<br>update -> " . var_dump($updates) . " <br>");
		     // echo ("<br>insert -> " . var_dump($inserts) . " <br>");
		}
	}
	
	$dentesq = "SELECT * from globais where odo_id = " . $cid;
	$all_rows = $db->fetch_all_array($dentesq);

	$cols = "";
	$ins_cols = "";
	//varre todos as colunas da tabela globais para informar se tem alteração
	for($x=1;$x<=12;$x++)
	{
	      if($_POST['globais'.$x]) 
	      {
		    $cols .= ", I_ATU_".$x." = 1";
		    $ins_cols .= ", 1 ";
		    $glob_cod_cap[$x] = 1;
	      }
	      else
	      {
		    $cols .= ", I_ATU_".$x." = 0";
		    $ins_cols .= ", 0 ";
	      }
	}

	if(sizeof($all_rows) >=1)
	{
		$queryGlobais = 'update globais set global_1 = '. $_POST['globais1'] .', global_2 = '. $_POST['globais2'] .',global_3 = '. $_POST['globais3'] .',global_4 = '. $_POST['globais4'] .',global_5 = '. $_POST['globais5'].',global_6 = '. $_POST['globais6'].',global_7 = '. $_POST['globais7'] .',global_8 = '. $_POST['globais8'].',global_9 = '. $_POST['globais9'].',global_10 = '. $_POST['globais10'] .',global_11 = '. $_POST['globais11'].',global_12 = '. $_POST['globais12'] .$cols.' where odo_id = ' .$cid;
		//$queryGlobais = 'update globais set global_1 = '. $_POST['globais1'] .', global_2 = '. $_POST['globais2'] .',global_3 = '. $_POST['globais3'] .$cols.' where odo_id = ' .$cid;
		//$queryGlobais = 'update globais set global_1 = '. $_POST['globais1'] .', global_2 = '. $_POST['globais2'] .',global_3 = '. $_POST['globais3'].',global_4 = '. $_POST['globais4'].',global_5 = '. $_POST['globais5'].',global_6 = '. $_POST['globais6'].',global_7 = '. $_POST['globais7'].',global_8 = '. $_POST['globais8'].',global_9 = '. $_POST['globais9'].',global_10 = '. $_POST['globais10'].',global_11 = '. $_POST['globais11'].',global_12 = '. $_POST['globais12'].',global_13 = '. $_POST['globais13'].',global_14 = '. $_POST['globais14'] .$cols.' where odo_id = ' .$cid;
	}
	else
	{
		$queryGlobais = 'insert into globais values (NULL, '. $cid .', '. $_POST['globais1'] .','. $_POST['globais2'] .','. $_POST['globais3'] .','. $_POST['globais4'] .','. $_POST['globais5'].','. $_POST['globais6'].','. $_POST['globais7'] .','. $_POST['globais8'].','. $_POST['globais9'].','. $_POST['globais10'] .','. $_POST['globais11'].','. $_POST['globais12'] .$ins_cols.',0)';
		//$queryGlobais = 'insert into globais values (NULL, '. $cid .', '. $_POST['globais1'] .','. $_POST['globais2'] .','. $_POST['globais3'] .$ins_cols.',0)';
		//$queryGlobais = 'insert into globais values (NULL, '. $cid .', '. $_POST['globais1'] .','. $_POST['globais2'] .','. $_POST['globais3'].','. $_POST['globais4'].','. $_POST['globais5'].','. $_POST['globais6'].','. $_POST['globais7'].','. $_POST['globais8'].','. $_POST['globais9'].','. $_POST['globais10'].','. $_POST['globais11'].','. $_POST['globais12'].','. $_POST['globais13'].','. $_POST['globais14'] .$ins_cols.',0)';
	}
	//echo ("################  " . $queryGlobais);
	
	$db->query($queryGlobais);
	
}
elseif ($_SESSION['new'] != 1 || ($_POST["novaAba"] == "true" && $isTmp == 1)) 
{
	//echo("### RECOVER ###");
	$_SESSION['new'] = 1;
	$_SESSION['recover'] = 1;
}
//echo $_POST['end']." asas  ";
if (isset($_POST['end']) && intval($_POST['end']) == 1)
{
	//echo(" ### DESTROY ###");
//	session_destroy();
}

//echo($_POST['globais1']);
$db->close();


Insere_Procedimentos($acao_cod, $cid);
//Insere_globais($acao_cod, $cid);

Function Busca_cod($cod_sus)
{//Busca o codigo do sistema
 //27/07/2010
 //Mário Costa

	Global $database;

	if(!$cod_sus) return "";

	$SQL = " SELECT C_PRC FROM TB_PRC_SAU WHERE U_PRC = $cod_sus ";
	//echo $SQL." <br> ";
	$result = @MetabaseQuery($database,$SQL);
	$cod = @MetabaseFetchResult($database,$result,0,0);

	return $cod;
}

Function Insere_Procedimentos($acao_cod, $Consulta)
{//Insere dados na tabela de procedimento dos procedimentos Globais 
 //27/07/2010
 //Mário Costa

	Global $database, $fusotime, $ExpertID, $props, $props_acao, $glob_cod_cap, $props_dent, $radicu;

	//Busca procedimentos que estão setados para este paciente.
	$SQL = " SELECT odo_id, dente, propriedade_1, propriedade_2, propriedade_3, propriedade_4, propriedade_5, propriedade_6, propriedade_7, propriedade_8, propriedade_9, 
 	      propriedade_10, propriedade_11, propriedade_12, propriedade_13, propriedade_14, propriedade_15, propriedade_16, propriedade_17, propriedade_18, propriedade_19, propriedade_20, propriedade_21, propriedade_22, 
 	      I_ATU_1, I_ATU_2, I_ATU_3, I_ATU_4, I_ATU_5, I_ATU_6, I_ATU_7, I_ATU_8, I_ATU_9, I_ATU_10, I_ATU_11, I_ATU_12, I_ATU_13, I_ATU_14, I_ATU_15, I_ATU_16, I_ATU_17, I_ATU_18, I_ATU_19, I_ATU_20, I_ATU_21, I_ATU_22 FROM propriedades  WHERE ODO_ID = $Consulta ";
	//echo $SQL." \n";
	$result = MetabaseQuery($database,$SQL);
	$qtd = MetabaseNumberOfRows($database,$result); 

	for($x=0;$x<$qtd;$x++)
	{
	      $consulta = MetabaseFetchResult($database,$result,$x,0);
	      $dente = MetabaseFetchResult($database,$result,$x,1);
	      $propriedade1 = MetabaseFetchResult($database,$result,$x,2);
	      $propriedade2 = MetabaseFetchResult($database,$result,$x,3);
	      $propriedade3 = MetabaseFetchResult($database,$result,$x,4);
	      $propriedade4 = MetabaseFetchResult($database,$result,$x,5);
	      $propriedade5 = MetabaseFetchResult($database,$result,$x,6);
	      $propriedade6 = MetabaseFetchResult($database,$result,$x,7);
	      $propriedade7 = MetabaseFetchResult($database,$result,$x,8);
	      $propriedade8 = MetabaseFetchResult($database,$result,$x,9);
	      $propriedade9 = MetabaseFetchResult($database,$result,$x,10);
	      $propriedade10 = MetabaseFetchResult($database,$result,$x,11);
	      $propriedade11 = MetabaseFetchResult($database,$result,$x,12);
	      $propriedade12 = MetabaseFetchResult($database,$result,$x,13);
	      $propriedade13 = MetabaseFetchResult($database,$result,$x,14);
	      $propriedade14 = MetabaseFetchResult($database,$result,$x,15);
	      $propriedade15 = MetabaseFetchResult($database,$result,$x,16);
	      $propriedade16 = MetabaseFetchResult($database,$result,$x,17);
	      $propriedade17 = MetabaseFetchResult($database,$result,$x,18);
	      $propriedade18 = MetabaseFetchResult($database,$result,$x,19);
	      $propriedade19 = MetabaseFetchResult($database,$result,$x,20);
	      $propriedade20 = MetabaseFetchResult($database,$result,$x,21);
	      $propriedade21 = MetabaseFetchResult($database,$result,$x,22);
	      $propriedade22 = MetabaseFetchResult($database,$result,$x,23);
	      
	      $prop[$dente][1] = $propriedade1;
	      $prop[$dente][2] = $propriedade2;
	      $prop[$dente][3] = $propriedade3;
	      $prop[$dente][4] = $propriedade4;
	      $prop[$dente][5] = $propriedade5;
	      $prop[$dente][6] = $propriedade6;
	      $prop[$dente][7] = $propriedade7;
	      $prop[$dente][8] = $propriedade8;
	      $prop[$dente][9] = $propriedade9;
	      $prop[$dente][10] = $propriedade10;
	      $prop[$dente][11] = $propriedade11;
	      $prop[$dente][12] = $propriedade12;
	      $prop[$dente][13] = $propriedade13;
	      $prop[$dente][14] = $propriedade14;
	      $prop[$dente][15] = $propriedade15;
	      $prop[$dente][16] = $propriedade16;
	      $prop[$dente][17] = $propriedade17; //deciduo
	      $prop[$dente][18] = $propriedade18;
	      $prop[$dente][19] = $propriedade19;
	      $prop[$dente][20] = $propriedade20;
	      $prop[$dente][21] = $propriedade21;
	      $prop[$dente][22] = $propriedade22;
	}

	$qtd_proc = 0;


	//------------------------------------------- Verifica as ações de tratamento nos dentes CIMA
	$tot = count($props_dent);
	if($tot > 0)
	{
		reset($props_dent);
		for($x=1;$x<=$tot;$x++)
		{
		    $dente = key($props_dent);

		    $tot_prop_den = count($props_dent[$dente]);
		    for($y=0;$y<$tot_prop_den;$y++)
		    {
			 $posic_trat = key($props_dent[$dente]);

			 if($prop[$dente][17]) //Dentes deciduos (de leite)
			 {
			      //if($codig[307010023])
			      //{
				//    $codig[307010023]++;
			      //}
			      //else
			      //{
				    $codig[307010023] = 1;
			      //}
			 }
			 else
			 {
			      if(($dente >= 6 && $dente <= 11)||($dente >= 22 && $dente <= 27))
			      {
				    //if($codig[307010031])
				    //{
					//  $codig[307010031]++;
				    //}
				    //else
				    //{
					  $codig[307010031] = 1;
				    //}
			      }
			      else
			      {
				    //if($codig[307010040])
				    //{
					//  $codig[307010040]++;
				    //}
				    //else
				    //{
					  $codig[307010040] = 1;
				    //}
			      }
			 }
		    }
		    next($props_dent);
		}
	}

	//---------------------------------

	//------------------------------------------- Verifica as ações Globais

	$tot_glob = count($glob_cod_cap);

	if($tot_glob > 0)
	{
	    reset($glob_cod_cap);
      
	    for($x=0;$x<$tot_glob;$x++)
	    {
		  $ativ_glo = key($glob_cod_cap);

		  if($ativ_glo == 1) //fluor
		  {
			$codig[101020074] = 1;
		  }
		  elseif($ativ_glo == 2) //placa de mordida
		  {
			$codig[307040011] = 1;
		  }
		  elseif($ativ_glo == 3) //Evidenciador de Placa bacteriana
		  {
			$codig[101020082] = 1;
		  }
		  elseif($ativ_glo == 4) //Correção de Bridas Musculares
		  {
			$codig[414020049] = 1;
		  }
		  elseif($ativ_glo == 5) //Glossorrafia
		  {
			$codig[414020170] = 1;
		  }
		  elseif($ativ_glo == 6) //Reconstrução de Sulco Gengivo-Labial
		  {
			$codig[414020227] = 1;
		  }
		  elseif($ativ_glo == 7) //Reconstrução Parcial Labio Traumatizado
		  {
			$codig[414020235] = 1;
		  }
		  elseif($ativ_glo == 8) //Remoção Corpo Estranho Buco-Maxilo-Facial
		  {
			$codig[414020260] = 1;
		  }
		  elseif($ativ_glo == 9) //Remoção de Foco Residual
		  {
			$codig[414020286] = 1;
		  }
		  elseif($ativ_glo == 10) //Remoção de Torus e Exostoses
		  {
			$codig[414020294] = 1;
		  }
		  elseif($ativ_glo == 11) //Selamento Fistula Cutanea Odontogenica
		  {
			$codig[414020316] = 1;
		  }
		  elseif($ativ_glo == 12) //Tratamento Cirurgico Fistula Intra/Extra-Oral
		  {
			$codig[414020340] = 1;
		  }


		  next($glob_cod_cap);
	    }
	}

	//---------------------------------

	//------------------------------------------- Verifica as ações de tratamento nos dentes
	
	$tot_aca = count($props_acao);
	if($tot_aca > 0)
	{
		reset($props_acao);

		for($x=0;$x<$tot_aca;$x++)
		{
		    $dente = key($props_acao);
		    $tot_dent = count($props_acao[$dente]);
		    for($z=0;$z<$tot_dent;$z++)
		    {
			//ação realizada
			$pro_aca = key($props_acao[$dente]);
			
			echo $pro_aca." acao do produto   <br>";
			if($pro_aca == 1) //extração
			{
				if($prop[$dente][17]) //Dentes deciduos (de leite)
				{
				      if($codig[414020120]) 
					      $codig[414020120]++;
				      else
					      $codig[414020120] = 1;
				}
				elseif($prop[$dente][1]) //Remocao de dente incluso ou impactado  
				{
				      if($codig[414020278]) 
					$codig[414020278]++;
				      else
					$codig[414020278] = 1;
				}
				else //Dentes permanenstes
				{
				      if($codig[414020138]) 
					$codig[414020138]++;
				      else
					$codig[414020138] = 1;
				}
			}
			elseif($pro_aca == 2) // Obturação
			{
				//Verifica se dente Decidou (leite)
				if($prop[$dente][17])
				{
				      if($codig[307020037])
				      {
					      $codig[307020037]++;
				      }
				      else
					      $codig[307020037] = 1;
				}
				else
				{
				      //Quantas raizes possui o dente
				      $num_raizes = $radicu[$dente];
				      if($num_raizes == 1)
				      {
					      if($codig[307020061])
					      {
						      $codig[307020061]++;
					      }
					      else
						      $codig[307020061] = 1;
				      }
				      elseif($num_raizes == 2)
				      {
					      if($codig[307020045]) 
						      $codig[307020045]++;
					      else
						      $codig[307020045] = 1;
				      }
				      else
				      {
					      if($codig[307020053]) 
						      $codig[307020053]++;
					      else
						      $codig[307020053] = 1;
				      }
				}
			}
			elseif($pro_aca == 3) //Aveolotomia
			{
				if($codig[414020014]) 
				      $codig[414020014]++;
				else
				      $codig[414020014] = 1;
			}
			elseif($pro_aca == 4) //Correção Irre. Rebordo Alveolar
			{
				if($codig[414020057]) 
				      $codig[414020057]++;
				else
				      $codig[414020057] = 1;
			}
			elseif($pro_aca == 5) //Curetagem Periapical
			{
				if($codig[414020073]) 
				      $codig[414020073]++;
				else
				      $codig[414020073] = 1;
			}
			elseif($pro_aca == 6) //Enxerto Gengival
			{
				if($codig[414020081]) 
				      $codig[414020081]++;
				else
				      $codig[414020081] = 1;
			}
			elseif($pro_aca == 7) //Gengivectomia (sextante)
			{
				if($codig[414020154]) 
				      $codig[414020154]++;
				else
				      $codig[414020154] = 1;
			}
			elseif($pro_aca == 8) //Gengivoplastia (sextante)
			{
				if($codig[414020162]) 
				      $codig[414020162]++;
				else
				      $codig[414020162] = 1;
			}

			elseif($pro_aca == 9) //Odontoseccao
			{
				if($codig[414020219]) 
				      $codig[414020219]++;
				else
				      $codig[414020219] = 1;
			}

			elseif($pro_aca == 10) //Reimplante e Transplante Dental
			{
				if($codig[414020243]) 
				      $codig[414020243]++;
				else
				      $codig[414020243] = 1;
			}
			elseif($pro_aca == 11) //Remoção de Cisto
			{
				if($codig[414020251]) 
				      $codig[414020251]++;
				else
				      $codig[414020251] = 1;
			}
			elseif($pro_aca == 12) //Retirada de Material Sintese Ossea/Dentaria
			{
				if($codig[414020308]) 
				      $codig[414020308]++;
				else
				      $codig[414020308] = 1;
			}
			elseif($pro_aca == 13) //Tratamento Cirurgico Hemorragia Buco Dental
			{
				if($codig[414020359]) 
				      $codig[414020359]++;
				else
				      $codig[414020359] = 1;
			}
			elseif($pro_aca == 14) //Tratamento Cirurgico Periodontal
			{
				if($codig[414020375]) 
				      $codig[414020375]++;
				else
				      $codig[414020375] = 1;
			}
			elseif($pro_aca == 15) //Tratamento Aveolite
			{
				if($codig[414020383]) 
				      $codig[414020383]++;
				else
				      $codig[414020383] = 1;
			}
			elseif($pro_aca == 16) //Tratamento Redução Fratura Alveolo-Dentaria
			{
				if($codig[414020391]) 
				      $codig[414020391]++;
				else
				      $codig[414020391] = 1;
			}
			elseif($pro_aca == 17) //Ulotomia/Ulectomia
			{
				if($codig[414020405]) 
				      $codig[414020405]++;
				else
				      $codig[414020405] = 1;
			}
			elseif($pro_aca == 18) //Capeamento Pulpar
			{
				if($codig[307010015]) 
				      $codig[307010015]++;
				else
				      $codig[307010015] = 1;
			}
			elseif($pro_aca == 19) //Tratamento de Nevralgias Faciais
			{
				if($codig[307010058]) 
				      $codig[307010058]++;
				else
				      $codig[307010058] = 1;
			}
			elseif($pro_aca == 20) //Acesso Polpar Dentaria e Medicação
			{
				if($codig[307020010]) 
				      $codig[307020010]++;
				else
				      $codig[307020010] = 1;
			}
			elseif($pro_aca == 21) //Curativo de Demora C/ S/ Preparo Biomecanico
			{
				if($codig[307020029]) 
				      $codig[307020029]++;
				else
				      $codig[307020029] = 1;
			}
			elseif($pro_aca == 22) //Pulpotomia Dentaria
			{
				if($codig[307020070]) 
				      $codig[307020070]++;
				else
				      $codig[307020070] = 1;
			}
			elseif($pro_aca == 23) //Retratamento Endodontico Dente Permanente
			{
				if($codig[307020088]) 
				      $codig[307020088]++;
				else
				      $codig[307020088] = 1;
			}
			elseif($pro_aca == 24) //Selamento de Perfuração Radicular
			{
				if($codig[307020118]) 
				      $codig[307020118]++;
				else
				      $codig[307020118] = 1;
			}
			elseif($pro_aca == 25) //Raspagem Alisamento e Polimento Supragengivais (sextante)
			{
				if($codig[307030016]) 
				      $codig[307030016]++;
				else
				      $codig[307030016] = 1;
			}
			elseif($pro_aca == 26) //Raspagem Alisamento Subgengivais (sextante)
			{
				if($codig[307030024]) 
				      $codig[307030024]++;
				else
				      $codig[307030024] = 1;
			}
			elseif($pro_aca == 27) //Instalação e Adaptação de Protese Dentaria
			{
				if($codig[307040038]) 
				      $codig[307040038]++;
				else
				      $codig[307040038] = 1;
			}
			elseif($pro_aca == 28) //Moldagem Dento-Gengiva p protese
			{
				if($codig[307040070]) 
				      $codig[307040070]++;
				else
				      $codig[307040070] = 1;
			}
			elseif($pro_aca == 29) //Reembasamento COnserto Protese Dentaria
			{
				if($codig[307040089]) 
				      $codig[307040089]++;
				else
				      $codig[307040089] = 1;
			}
			elseif($pro_aca == 30) //Aplicação de Selante
			{
				if($codig[101020066]) 
				      $codig[101020066]++;
				else
				      $codig[101020066] = 1;
			}
			elseif($pro_aca == 31) //Selamento Provisório
			{
				if($codig[101020090]) 
				      $codig[101020090]++;
				else
				      $codig[101020090] = 1;
			}
		    }
		    next($props_acao);
		}
	}

	//echo count($codig)." aqui !!!!";

	//echo $codig."  testeeesss !!";


	//bUSCA TODOS OS PROCEDIMENTOS INCLUIDOS NA CONSULTA DE ODONTOLOGIA
	$SQL = " SELECT C_PRC_PRC, C_SAU_PRC FROM TB_USR_PRC_SAU WHERE C_USR_USR = ".$_SESSION["cliente"]." AND C_CST_CST = $Consulta ORDER BY C_SAU_PRC ";
	//echo $SQL."  aaaa $y   <br>";
	$result = @MetabaseQuery($database,$SQL);
	$qtd = MetabaseNumberOfRows($database,$result); 

	FOR($i=0;$i<$qtd;$i++)
	{
		$DOENC = @MetabaseFetchResult($database,$result,$i,0);
		$PRC_ODO = @MetabaseFetchResult($database,$result,$i,1);    

		IF(!$PRC_ODO_COD[$DOENC]) $PRC_ODO_COD[$DOENC] = $PRC_ODO;
		ELSE $PRC_ODO_COD[$DOENC] .= ",".$PRC_ODO;

	}
	$tod_doen = "";
	$tot_prc_odo = 0;
	$prc_odo = "";

	//Insere os codigos dos procedimentos na tabela de procedimentos
	if(count($codig)) // se nao possui dados nao realiza esta parte do codigo
	{
		//CASO UMA DESTES CODIGOS DE ACOES EXISTAM NO ARRAY INSERE O CODIGO NA TABELA DE PROCEDIMENTO
		reset($codig);
	
		$tot_cod = count($codig);

		for($i=0;$i<$tot_cod;$i++)
		{
			$cod_odonto = key($codig);

			//tranforma o codigo do sus no codigo do sistema
			$cid = Busca_cod($cod_odonto);
	
			// caso procedimento possa ser realizado mais de uma vez
			if($codig[$cod_odonto] > 1)  $tot_inserts = $codig[$cod_odonto];
			else $tot_inserts = 1; //procedimento incluido apenas uma vez
	
			$prc_odo = explode(",",$PRC_ODO_COD[$cid]);

			if(is_array($prc_odo))
			{
				if(array_key_exists($cid,$PRC_ODO_COD))
				{
					$tot_prc_odo = count($prc_odo);
					reset($prc_odo);
				}
				else
				{
					$tot_prc_odo = 0;
				}
			}
			else
			{
				$prc_odo;
			}

			//Insere no arry para não ser apagado
			for($z=0;$z<$tot_inserts;$z++)
			{
			      $aux_odo = key($prc_odo);
			      if($prc_odo[$aux_odo])  //impede a entrada de dados em branco
			      {
					if($tod_doen) $tod_doen .= ",".$prc_odo[$aux_odo];
					else	$tod_doen = $prc_odo[$aux_odo];
			      }
				    next($prc_odo);
			}
			if($tot_inserts > $tot_prc_odo)
			{
			      MetabaseGetSequenceNextValue($database, "TB_USR_PRC_SAU", &$NextID);
	      		      $SQL = " INSERT INTO TB_USR_PRC_SAU (C_SAU_PRC, C_PRC_PRC, C_USR_USR, C_CST_CST, T_PRC_PRC, D_ULT_ATL, C_USR_ULT_ATL) VALUES ($NextID, $cid, ".$_SESSION["cliente"].", $Consulta, NULL,'".date("Y-m-d H:i:s",$fusotime)."', $ExpertID) ";
			      $result = MetabaseQuery($database,$SQL);
			      if($tod_doen) $tod_doen .= ",".$NextID;
			      else	$tod_doen = $NextID;
			      //echo $SQL." \n ";
			}
			next($codig);
		}
		//Realiza limpeza da tabela de procedimentos antes de jogar informações	      
		//SO EXECUTA QUANDO TIVER DADOS NA STRING
		if($tod_doen)
		{
			$aux = "AND C_SAU_PRC not in ($tod_doen)";
			$SQL = " DELETE FROM TB_USR_PRC_SAU WHERE C_CST_CST = $Consulta $aux ";
			//echo $SQL."<br>";
			$result = MetabaseQuery($database,$SQL);
		}
	}
}

?>
