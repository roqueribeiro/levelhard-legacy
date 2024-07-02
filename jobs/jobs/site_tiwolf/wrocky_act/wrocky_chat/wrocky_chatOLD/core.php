<?php

	require "database.php";

//============ CoreWebRoCkYChat ============//
class MsgOptions
{
	function ShowMsg()
	{
		$Query = "SELECT cod, cod_usr_in, cod_usr_out, DATE_FORMAT(date_time,'%H:%i:%s'), msg, private FROM msg_history ORDER BY cod DESC LIMIT 0,8;";
		$QueryApply = mysql_query($Query);
		$QueryResults = mysql_num_rows($QueryApply); 
		if ($QueryResults > 0)
		{
			while ($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				$bd_result[0] = $ResultRow[0];
				$bd_result[1] = $ResultRow[1];
				$bd_result[2] = $ResultRow[2];
				$bd_result[3] = $ResultRow[3];
				$bd_result[4] = $ResultRow[4];
				$bd_result[5] = $ResultRow[5];
				
				if($bd_result[1] == 0)
				{
					$bd_result[1] = "Anônimo";
				}
				
				print '
				<ul class="msg_cab"><li>'.$bd_result[1].' - '.$bd_result[3].'</li></ul>
				<ul class="msg_msg"><li>'.$bd_result[4].'</li></ul>
				';
			}
		}
		else
		{
			print '<ul class="msg_cab"><li>Deixe sua mensagem.</li></ul>';
		}
	}
	
	function SendMsg($sendMsg)
	{
		$Query = "
		INSERT INTO 
			msg_history
			(
				cod, cod_usr_in, cod_usr_out, date_time, msg, private
			) 
			VALUES 
			(
				NULL, '".$sendMsg[1]."', '".$sendMsg[2]."', '".$sendMsg[3]."', '".$sendMsg[4]."', '".$sendMsg[5]."'
			);
		";
		mysql_query($Query);
	}
}

?>