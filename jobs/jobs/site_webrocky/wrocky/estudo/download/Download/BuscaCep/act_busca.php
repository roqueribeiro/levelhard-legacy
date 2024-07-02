<?php

$busca_cep = $_GET['busca_cep'];

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
	switch($resultado['resultado'])
	{  
		case '2':  
			$texto = "
			<p><b>Cidade: </b> ".utf8_encode($resultado['cidade'])."</p>
			<p><b>UF: </b> ".utf8_encode($resultado['uf'])."</p>
			";    
		break;  
		case '1':  
			$texto = "
			<p><b>Tipo de Logradouro: </b> ".utf8_encode($resultado['tipo_logradouro'])."</p>
			<p><b>Logradouro: </b> ".utf8_encode($resultado['logradouro'])."</p>
			<p><b>Bairro: </b> ".utf8_encode($resultado['bairro'])."</p>
			<p><b>Cidade: </b> ".utf8_encode($resultado['cidade'])."</p>
			<p><b>UF: </b> ".utf8_encode($resultado['uf'])."</p>
			";  
		break;  
		default:  
			$texto = "<p>Falha ao buscar cep: ".$busca_cep."</p>";  
		break;  
	}
}
else
{
	$texto = "Digite o CEP que deseja.";
}

print $texto;

?>
