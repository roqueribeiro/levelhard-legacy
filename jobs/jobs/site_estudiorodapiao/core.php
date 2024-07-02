<?php
	
	switch($_POST['action'])
	{
		case "gallery";
			print createGallery($_POST['typeGal']);
		break;
		case "gallery";
			print createGallery($_POST['typeGal']);
		break;
		case "gallery";
			print createGallery($_POST['typeGal']);
		break;
		case "gallery";
			print createGallery($_POST['typeGal']);
		break;
	}

function createGallery($typeGal)
{
	
	if($typeGal=='websites')
	{
		$imgGal = '
		<img src="images/clientes/logo-alfacastello.png" width="280" height="320" longdesc="http://www.alfacastello.com.br" alt="Construtora AlfaCastello" />
		<img src="images/clientes/logo-espacolar.png" longdesc="http://www.espacolardecoracao.com.br" alt="Espaço Lar Decorações" />
		<img src="images/clientes/logo-ipetec.png" longdesc="http://www.decisoesinteligentes.com.br" alt="IPETEC - Decisões Inteligentes" />
		<img src="images/clientes/logo-lenhaeco.png" longdesc="http://www.lenhaecologicamartins.com.br" alt="Lenha Ecologica Martins" />
		<img src="images/clientes/logo-sapatos.png" longdesc="http://www.sapatosecia.com.br" alt="Sapatos & Cia" />
		<img src="images/clientes/logo-superpao.png" longdesc="http://www.panificadorasuperpao.com.br" alt="Panificadora Super Pão" />
		<img src="images/clientes/logo-warfire.png" longdesc="http://www.warfire.com.br" alt="Banda Warfire" />
		<img src="images/clientes/logo-zalk.png" longdesc="http://www.zalkmarcenaria.com.br" alt="Zalk Marcenaria" />
		<img src="images/clientes/logo-gdata.png" longdesc="http://www.gdata.com.br" alt="Global Data Soluções de Internet" />
		<img src="images/clientes/logo-videoteca.png" longdesc="http://www.videotecatatui.com.br" alt="Videoteca Locadora Tatuí" />
		<img src="images/clientes/logo-costuraria.png" longdesc="http://www.costuraria.com" alt="Costuraria Desenvolvimento de Moda" />
		<img src="images/clientes/logo-montana.png" longdesc="http://www.montanatransportes.com.br" alt="Montana Transportes" />
		<img src="images/clientes/logo-carrosavenida.png" longdesc="http://www.carrosavenida.com.br" alt="Carros Avenida" />
		<img src="images/clientes/logo-votofix.png" longdesc="http://www.votofix.com.br" alt="VotoFix" />
		';
	}
	if($typeGal=='impressos')
	{
		$imgGal = '
		<img src="images/portifolio/impressos/img001_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img002_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img003_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img004_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img005_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img006_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img007_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img008_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img009_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img010_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img011_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img012_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img013_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img014_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img015_s.jpg" longdesc="" alt="" />
		<img src="images/portifolio/impressos/img016_s.jpg" longdesc="" alt="" />
		';
	}
	
	$html = '<div id="myImageFlow" class="imageflow">'.$imgGal.'</div>';
	
	return $html;
	
}

?>