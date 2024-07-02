<?php

ini_set("display_errors",0);
include("database.php");
session_start();

switch($_POST["acao"]){

    case "verifica":
        if($_SESSION["logado"]) print $_SESSION["logado"];
        break;
    
    case "autenticacao":
        $verifica = new autenticacao;
        $verifica->verifica($_POST["apelido"],$_POST["senha"]);
        break;
    
    case "desconecta":
        if($_SESSION["logado"]) session_destroy();
        break;
    
    case "informacoes":
        $usuario = new usuario;
        $usuario->informacoes($_SESSION["apelido"]);
        break;
    
}

class autenticacao
{
    var $apelido;
    var $senha;
    
    function verifica($apelido,$senha){
        $mysql = new conexao;
        $this->apelido = $apelido;
        $this->senha = $senha;
        $verifica = $mysql->sql_query("CALL sp_verificaLogin('".$this->apelido."','".$this->senha."');");
        while($usuario = mysql_fetch_object($verifica)) {
            if($usuario->retorno){
                $_SESSION["apelido"] = $this->apelido;
                $_SESSION["logado"] = $usuario->retorno;
                print $_SESSION["logado"];
            } else {
                print $usuario->retorno;
            }
        }
    }
}

class usuario
{
    var $apelido;
    
    function informacoes($apelido){
        $mysql = new conexao;
        $this->apelido = $apelido;
        $usuarios_lista = $mysql->sql_query("SELECT * FROM usuarios WHERE apelido = '".$this->apelido."';");
        $resultados = array();
        while($usuarios = mysql_fetch_object($usuarios_lista)) {
            $resultados[] = array(
                'codigo' => $usuarios->codigo,
                'nome' => $usuarios->nome,
                'sobrenome' => $usuarios->sobrenome,
                'email' => $usuarios->email,
                'foto' => $usuarios->foto,
                'diretorio' => $usuarios->diretorio,
                'nivel' => $usuarios->nivel,
                'situacao' => $usuarios->situacao,
            );
        }
        print json_encode($resultados);
    }
}

?>