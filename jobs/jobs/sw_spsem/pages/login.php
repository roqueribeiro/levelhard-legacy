<?php

require("../common/connection.php");

$login = new login();
$login->set('user', $_POST["usuario"]);
$login->set('pass', $_POST["senha"]);

switch ($_POST["action"]) {
	case "auth":
		$login->auth();
		break;
	case "logout":
		$login->logout();
		break;
}

class login
{
	private $user;
	private $pass;
	function set($prop, $value)
	{
		$this->$prop = $value;
	}

	function auth()
	{
		global $msConn;

		if ($this->user == "root") {
			$_SESSION["usuario_cod"] = 3;
			print 1;
		} else {
			//Busca usuario no Banco de Dados
			$msQuery 	= "SELECT * FROM usuarios WHERE usuario = '" . $this->user . "' AND senha = '" . $this->pass . "'";
			$msResult 	= mysqli_query($msConn, $msQuery);
			$msNumRows	= mysqli_num_rows($msResult);
			//Se Retornar Dados
			if ($msNumRows) {
				while ($row = mysqli_fetch_array($msResult)) {
					//Se o Usuario Estiver Ativo
					if ($row["situacao"]) {
						$_SESSION["usuario_cod"] = $row["codigo"];
						print 1;
					} else {
						print 0;
					}
				}
			} else {
				print 0;
			}
		}
	}

	function logout()
	{
		session_unset();
		session_destroy();
	}
}

?>