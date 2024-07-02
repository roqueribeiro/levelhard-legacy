<?php

	header('Content-Type: text/html; charset=utf-8');
		
	$language["sitename"] = "APS2010 - Multas";

//=================Truncar Frases=================
function truncate($str, $len=80, $etc='') 
{ 
	$end = array(' ', '.', ',', ';', ':', '!', '?');

	if (strlen($str) <= $len)
	{
		return $str;
	}

	if (!in_array($str{$len - 1}, $end) && !in_array($str{$len}, $end))
	{
		while (--$len && !in_array($str{$len - 1}, $end));
	}

	return rtrim(substr($str, 0, $len)).$etc;
}

?>