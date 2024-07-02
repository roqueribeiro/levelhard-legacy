<?php

	$nomedoarquivozip = $_GET['arquivo'];
	$zip = new ZipArchive;

	if ($zip->open($nomedoarquivozip) === TRUE) {
		$zip->extractTo('./');
		$zip->close();
		echo 'ok';
	} else {
		echo 'failed';
	}
 
?>