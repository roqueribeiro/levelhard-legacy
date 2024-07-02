<?php

	if($_POST['download']) {
		$link 		= explode('/',$_POST['download']);
		$filename 	= end($link);
		exec('wget '.$_POST['download'].' -O downloads/'.$filename.date('dmY'));
	}

?>