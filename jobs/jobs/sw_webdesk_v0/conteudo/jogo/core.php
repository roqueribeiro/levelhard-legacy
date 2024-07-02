<?php

	$action = $_GET["action"];
	
	switch($action)
	{
		case "win":
			print telaWin();
		break;
	}
	
function telaWin()
{
	$html = '
	<div id="mensagem">
		<p style="font-size:24px;"><b>Parabéns! Você Venceu!</b></p>
		<p>Pressione <b>"R"</b> para Jogar novamente.</p>
		<p style="margin-top:150px;"><a href="http://www.levelhard.com" target="_blank"><img src="images/logo.png" alt="" width="300px"></a></p>
	</div>';
	
	return $html;
}

?>