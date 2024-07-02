<?php

$msQuery 	= "SELECT * FROM mostra_usuarios WHERE usuario_cod = " . $_SESSION["usuario_cod"];
$msResult 	= mysqli_query($msConn, $msQuery);
$msNumRows	= mysqli_num_rows($msResult);

if ($msNumRows) {
	while ($row = mysqli_fetch_array($msResult)) {
		$msSession['active'] 		= true;
		$msSession['usuario_cod'] 	= $row["usuario_cod"];
		$msSession['usuario'] 		= $row["usuario"];
		$msSession['nivel_cod'] 	= $row["nivel_cod"];
		$msSession['nivel'] 		= utf8_encode($row["nivel"]);
		$msSession['grupo_cod'] 	= $row["grupo_cod"];
		$msSession['grupo'] 		= utf8_encode($row["grupo"]);
		$msSession['situacao'] 		= $row["situacao"];
	}
} else {
	$msSession['active'] = false;
}

?>