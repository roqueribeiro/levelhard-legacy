<?php

	require "../core.php";
	
	$sendMsg[1] 	= 0;
	$sendMsg[2] 	= 0;
	$sendMsg[3] 	= date("Y-m-d  H:i:s");
	$sendMsg[4] 	= $_POST["chat_msg"];
	$sendMsg[5] 	= $_POST["private"];
	
	$msg = new MsgOptions;
	$msg->SendMsg($sendMsg);
	
?>