<?php

	$bd_server 		= "127.0.0.1";
	$bd_usuario 	= "root";
	$bd_senha 		= "";
	$bd_name		= "bd_chat";
	
	$bd_connect = mysql_connect($bd_server,$bd_usuario,$bd_senha);
	$bd_select	= mysql_select_db($bd_name);
	$bd_charset	= mysql_set_charset('utf8',$bd_connect);
	
	$action = $_GET["action"];
	
	switch($action)
	{
		case "msgLoad":
			print chatMsgLoad();
		break;
		case "msgSend":
			print chatMsgSend();
		break;
		case "msgVis":
			print chatMsgVis();
		break;
		case "usrList":
			print chatUsrList();
		break;
		case "usrStatus":
			print chatUsrStatus();
		break;
	}
	
function chatMsgLoad()
{
	$snd_cod = $_GET["snd_cod"];
	$rec_cod = $_GET["rec_cod"];
	
	$Query = "
		SELECT
			U.CHT_USR_NOM,
			M.CHT_MSG_MSG,
			DATE_FORMAT(M.CHT_MSG_DAT,'%H:%i')
		FROM 
			TB_CHT_USR AS U
		INNER JOIN
			TB_CHT_MSG AS M
		ON
			M.CHT_MSG_SND = U.CHT_USR_COD
		WHERE
			M.CHT_MSG_SND IN ('".$rec_cod."','".$snd_cod."')
		AND 
			M.CHT_MSG_REC IN ('".$rec_cod."','".$snd_cod."')
		ORDER BY
			M.CHT_MSG_COD DESC
		LIMIT 
			0,50
	";
    $QueryApply = mysql_query($Query);
    $QueryResults = mysql_num_rows($QueryApply);
    if($QueryResults != 0)
    {
        while($ResultRow = mysql_fetch_array($QueryApply)) 
        {
			$bd_result[0] = $ResultRow[0];
			$bd_result[1] = $ResultRow[1];
			$bd_result[2] = $ResultRow[2];
			
			$html .= "
            <ul>
                <li>".$bd_result[2]." ".$bd_result[0]." diz:</li>
                <li>".$bd_result[1]."</li>
            </ul>
			";
        }
	}
	else
	{
		$html .= "<ul><li>Nenhum Registro de Conversa</li></ul>";
	}
	
	return $html;
}

function chatMsgSend()
{
	$snd_cod 	= $_GET["snd_cod"];
	$rec_cod 	= $_GET["rec_cod"];
	$chat_msg 	= $_GET["chat_msg"];
	
	//Emoticons
	$chat_msg 	= str_replace('=)','<img alt="" src="components/chat/images/emoticon/Happy.png">',$chat_msg);
	$chat_msg 	= str_replace('=>','<img alt="" src="components/chat/images/emoticon/Smile.png">',$chat_msg);
	$chat_msg 	= str_replace('=/','<img alt="" src="components/chat/images/emoticon/Sad.png">',$chat_msg);
	$chat_msg 	= str_replace('=(','<img alt="" src="components/chat/images/emoticon/Angry.png">',$chat_msg);
	$chat_msg 	= str_replace('=0','<img alt="" src="components/chat/images/emoticon/Surprised.png">',$chat_msg);
	$chat_msg 	= str_replace('=p','<img alt="" src="components/chat/images/emoticon/tongue.png">',$chat_msg);
	$chat_msg 	= str_replace(';)','<img alt="" src="components/chat/images/emoticon/Winking.png">',$chat_msg);
	$chat_msg 	= str_replace(':)','<img alt="" src="components/chat/images/emoticon/Laughing.png">',$chat_msg);
	$chat_msg 	= str_replace(':(','<img alt="" src="components/chat/images/emoticon/Crying.png">',$chat_msg);
	$chat_msg 	= str_replace('8)','<img alt="" src="components/chat/images/emoticon/Cool.png">',$chat_msg);
	$chat_msg 	= str_replace('=8','<img alt="" src="components/chat/images/emoticon/Blushing.png">',$chat_msg);
	$chat_msg 	= str_replace(':8','<img alt="" src="components/chat/images/emoticon/Sick.png">',$chat_msg);
	$chat_msg 	= str_replace('8]','<img alt="" src="components/chat/images/emoticon/Nerd.png">',$chat_msg);
	$chat_msg 	= str_replace('=]','<img alt="" src="components/chat/images/emoticon/Smile Face.png">',$chat_msg);
	
	$Query = "
		INSERT INTO TB_CHT_MSG 
		(
			CHT_MSG_COD,
			CHT_MSG_SND,
			CHT_MSG_REC,
			CHT_MSG_MSG,
			CHT_MSG_DAT,
			CHT_MSG_GRP,
			CHT_MSG_VIS
		)
		VALUES
		(
			NULL, '".$snd_cod."', '".$rec_cod."', '".$chat_msg."', '".date("Y-m-d  H:i:s")."', NULL, '1'
		);	
	";
    $QueryApply = mysql_query($Query);
	
	return $html;
}

function chatMsgVis()
{
	$snd_cod 	= $_GET["snd_cod"];
	$rec_cod 	= $_GET["rec_cod"];
	
	$Query 		= "UPDATE TB_CHT_MSG SET CHT_MSG_VIS = '0' WHERE CHT_MSG_SND = '".$rec_cod."' AND CHT_MSG_REC = '".$snd_cod."'";
	$QueryApply = mysql_query($Query);
}

function chatUsrList()
{
	$snd_cod = $_GET["snd_cod"];
	
	$Query = "
		SELECT
			CHT_USR_COD,
			CHT_USR_NOM,
			CHT_USR_STS
		FROM 
			TB_CHT_USR
		WHERE
			CHT_USR_COD <> '".$snd_cod."'
		ORDER BY
			CHT_USR_NOM
	";
    $QueryApply = mysql_query($Query);
    $QueryResults = mysql_num_rows($QueryApply);
    if($QueryResults != 0)
    {
        while($ResultRow = mysql_fetch_array($QueryApply)) 
        {			
			$bd_result[0] = $ResultRow[0];
			$bd_result[1] = $ResultRow[1];
			$bd_result[2] = $ResultRow[2];
			
			$QueryCount = "SELECT COUNT(*) FROM TB_CHT_MSG WHERE CHT_MSG_SND = '".$bd_result[0]."' AND CHT_MSG_REC = '".$snd_cod."' AND CHT_MSG_VIS = '1';";
			$QueryCountApply = mysql_query($QueryCount);
			$QueryCountResults = mysql_num_rows($QueryCountApply);
			if($QueryCountResults != 0)
			{
				while($ResultCountRow = mysql_fetch_array($QueryCountApply)) 
				{
					if($ResultCountRow[0]) 
						$num_vis = "<b>(".$ResultCountRow[0].")</b>"; 
					else 
						$num_vis = "";
				}
			}
			
			if($bd_result[2]==1)
			{
				$user_on .= '
				<a href="javascript:void(0)" id="'.$bd_result[0].'" class="'.$bd_result[1].'">
				<ul>
					<li><img src="components/chat/images/user-on.png" alt="" /></li>
					<li>'.$bd_result[1].' '.$num_vis.'</li>
				</ul>
				</a>
				';
			}
			if($bd_result[2]==2)
			{
				$user_on .= '
				<a href="javascript:void(0)" id="'.$bd_result[0].'" class="'.$bd_result[1].'">
				<ul>
					<li><img src="components/chat/images/user-ocp.png" alt="" /></li>
					<li>'.$bd_result[1].' '.$num_vis.'</li>
				</ul>
				</a>
				';
			}
			if($bd_result[2]==3)
			{
				$user_on .= '
				<a href="javascript:void(0)" id="'.$bd_result[0].'" class="'.$bd_result[1].'">
				<ul>
					<li><img src="components/chat/images/user-aus.png" alt="" /></li>
					<li>'.$bd_result[1].' '.$num_vis.'</li>
				</ul>
				</a>
				';
			}
			if($bd_result[2]==0)
			{
				$user_off .= '
				<ul>
					<li><img src="components/chat/images/user-off.png" alt="" /></li>
					<li>'.$bd_result[1].'</li>
				</ul>
				';
			}					

        }
	}
	
	$html = '
	<ul>
		<li>Online
		'.$user_on.'
		</li>
	</ul>
	<ul>
		<li>Offline
		'.$user_off.'
		</li>
	</ul>
	';
	
	return $html;
}

function chatUsrStatus()
{
	$snd_cod 	= $_GET["snd_cod"];
	$snd_status = $_GET["snd_status"];
	
	$Query 		= "UPDATE  TB_CHT_USR SET CHT_USR_STS = '".$snd_status."' WHERE CHT_USR_COD = '".$snd_cod."';";
	$QueryApply = mysql_query($Query);
}

?>