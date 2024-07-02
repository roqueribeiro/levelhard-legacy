<?php 

	// ============ Função Republica Virtual ============
	
	function busca_cep($cep)
	{
		$resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');
		if(!$resultado)
		{ 
			$resultado = "&resultado=3"; 
		}
		parse_str($resultado,$retorno); 
		return $retorno;
	}
	
	$resultado_busca = busca_cep($_POST["wclin_cep"]);

	switch($resultado_busca['resultado'])
	{
		case 1:
			$html = "
			{
				'res'			:'1',
				'logradouro'	:'".utf8_encode($resultado_busca['logradouro'])."',
				'tp_logradouro'	:'".utf8_encode($resultado_busca['tipo_logradouro'])."',
				'bairro'		:'".utf8_encode($resultado_busca['bairro'])."',
				'cidade'		:'".utf8_encode($resultado_busca['cidade'])."',
				'uf'			:'".utf8_encode($resultado_busca['uf'])."'
			}
			";
		break;
		case 2:
			$html = "
			{
				'res'			:'2',
				'logradouro'	:'',
				'tp_logradouro'	:'',
				'bairro'		:'".utf8_encode($resultado_busca['bairro'])."',
				'cidade'		:'".utf8_encode($resultado_busca['cidade'])."',
				'uf'			:'".utf8_encode($resultado_busca['uf'])."'
			}
			";	
		break;
		case 3:
			$html = "
			{
				'res'			:'3',
				'logradouro'	:'',
				'tp_logradouro'	:'',
				'bairro'		:'',
				'cidade'		:'',
				'uf'			:''
			}
			";	
		break;
	}

	print $html;
	
?>