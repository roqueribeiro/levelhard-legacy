<?php

$busca_cep = $_POST['busca_cep'];

if($busca_cep)
{
	$webservice_url		= 'http://webservice.uni5.net/web_cep.php';
	$webservice_query	= array(
		'auth'    => 'c2f7831a05af0cdcff1a3ecfa64ae72f',
		'formato' => 'query_string',
		'cep'     => ''.$busca_cep.''
	);
	$webservice_url .= '?';
	foreach($webservice_query as $get_key => $get_value)
	{
		$webservice_url .= $get_key.'='.urlencode($get_value).'&';
	}
	@parse_str(file_get_contents($webservice_url), $resultado);
}

$rua 	= utf8_encode($resultado['tipo_logradouro'].' '.$resultado['logradouro']);
$bairro = utf8_encode($resultado['bairro']);
$cidade = utf8_encode($resultado['cidade']);
$uf 	= utf8_encode($resultado['uf']);

print "{'rua':'".$rua."','bairro':'".$bairro."','cidade':'".$cidade."','uf':'".$uf."'}";

?>

