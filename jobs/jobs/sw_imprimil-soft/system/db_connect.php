<?php

	$db_exec = new db_connect;
	$db_exec->db_set('db_name','bd_imprimil');
	$db_exec->db_set('db_host','localhost');
	$db_exec->db_set('db_user','root');
	$db_exec->db_set('db_pass','');
	$db_exec->db_conn();

class db_connect
{//Classe de Conexão com Banco
 //Roque Ribeiro
 //29-05-2012
	
	private $db_host;
	private $db_user;
	private $db_pass;
	private $db_name;
	
	function db_set($prop,$value)
	{//Metodo Seta Variavel da Classe
	 //Roque Ribeiro
	 //29-05-2012
	 
		$this->$prop=$value;
	}
	
	function db_conn()
	{//Metodo Executa Conexão com Banco
	 //Roque Ribeiro
	 //29-05-2012
	 
		$db_conn	= mysql_connect($this->db_host,$this->db_user,$this->db_pass);
		$db_select 	= mysql_select_db($this->db_name);
		$db_charset = mysql_set_charset('utf8',$db_conn);
	  
		if(!$db_conn or !$db_select) die();
	}
   
}

?>