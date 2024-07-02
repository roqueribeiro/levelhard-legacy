<?php

require("connection.php");
require("permissions.php");
//Se usuario Logado
if ($msSession['active']) {
	//POST informacoes
	$me_datestart 	= $_POST["datestart"];
	$me_dateend 	= $_POST["dateend"];
	$me_timestart 	= $_POST["timestart"];
	$me_timeend 	= $_POST["timeend"];
	$me_local 		= $_POST["local"];
	$me_summary 	= $_POST["summary"];
	$me_from 		= $mailConf["from"];
	$me_to			= $_POST["to"];
	$me_subject 	= $msSession['grupo'];
	//Se Existir informações
	if ($me_datestart and $me_dateend) {
		//Definições de Servidor
		ini_set("SMTP", $mailConf["host"]);
		ini_set("smtp_port", $mailConf["port"]);
		//Data 2000-01-01
		$me_datestart 	= explode("/", $me_datestart);
		$me_datestart	= $me_datestart[2] . $me_datestart[1] . $me_datestart[0];
		$me_dateend 	= explode("/", $me_dateend);
		$me_dateend		= $me_dateend[2] . $me_dateend[1] . $me_dateend[0];
		//Hora 00:00:00 (UTC-03:00)
		$me_timediff 	= ($me_timestart == $me_timeend ? 1 : 0);
		$me_timestart 	= explode(":", $me_timestart);
		$me_timestart	= ($me_timestart[0] + 3) . $me_timestart[1] . $me_timestart[2];
		$me_timeend 	= explode(":", $me_timeend);
		$me_timeend		= (($me_timeend[0] + $me_timediff) + 3) . $me_timeend[1] . $me_timeend[2];
		//Monta Data e Hora
		$me_dtstart		= $me_datestart . "T" . $me_timestart . "Z";
		$me_dtend		= $me_dateend . "T" . $me_timeend . "Z";
		//Busca Usuarios que Receberao Appointment
		$msQuery 		= "SELECT * FROM mostra_usuarios WHERE situacao = 1 AND grupo_cod = " . $msSession['grupo_cod'] . " ORDER BY nivel_cod";
		$msResult 		= mysqli_query($msConn, $msQuery);
		$msNumRows		= mysqli_num_rows($msResult);
		if ($msNumRows) {
			while ($row = mysqli_fetch_array($msResult)) {
				$msGroup .= "ATTENDEE;CN=\"" . $row["usuario"] . $row["mail"] . "\";ROLE=REQ-PARTICIPANT;
								 RSVP=FALSE:MAILTO:" . $row["usuario"] . $row["mail"] . "\r\n";
			}
		}
		//Monta Reuniao
		$vcal  = "BEGIN:VCALENDAR\r\n";
		$vcal .= "VERSION:2.0\r\n";
		$vcal .= "PRODID:-//CompanyName//ProductName//EN\r\n";
		$vcal .= "METHOD:REQUEST\r\n";
		$vcal .= "BEGIN:VEVENT\r\n";
		$vcal .= $msGroup;
		$vcal .= "UID:" . date('Ymd') . 'T' . date('His') . "-" . rand() . "-domain.com\r\n";
		$vcal .= "DTSTAMP:" . date('Ymd') . 'T' . date('His') . "\r\n";
		$vcal .= "DTSTART:" . $me_dtstart . "\r\n";
		$vcal .= "DTEND:" . $me_dtend . "\r\n";
		$vcal .= "LOCATION:" . $me_local . "\r\n";
		$vcal .= "SUMMARY:" . $me_summary . "\r\n";
		$vcal .= "BEGIN:VALARM\r\n";
		$vcal .= "TRIGGER:-PT15M\r\n";
		$vcal .= "ACTION:DISPLAY\r\n";
		$vcal .= "DESCRIPTION:Reminder\r\n";
		$vcal .= "END:VALARM\r\n";
		$vcal .= "END:VEVENT\r\n";
		$vcal .= "END:VCALENDAR\r\n";
		$headers  = "From: " . $me_from . "\r\nReply-To: " . $me_from;
		$headers .= "\r\nMIME-version: 1.0\r\nContent-Type: text/calendar; method=REQUEST; charset=\"UTF-8\"";
		$headers .= "\r\nContent-Transfer-Encoding: 7bit\r\nX-Mailer: Microsoft Office Outlook 12.0";
		//Envia Email Montado
		print mail($me_to, $me_subject, $vcal, $headers);
	}
}

?>