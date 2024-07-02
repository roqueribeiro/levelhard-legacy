<?php 
function ver_periodo($codigo)
{
	switch($codigo)
	{
		case 1:
			$fct_per = "Manhã";
		break;
		case 2:
			$fct_per = "Tarde";
		break;
		case 3:
			$fct_per = "Noite";
		break;
	}
	return $fct_per;
}
?>