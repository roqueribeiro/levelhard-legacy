<?php

	session_start();

	$cookie_time = 172800;

	if(isset($_SESSION['CLN_USR_ACS']))
	{
		$wclin_acs_session[0] = $_SESSION['CLN_USR_COD'];
		$wclin_acs_session[1] = $_SESSION['CLN_USR_ACS'];
		$wclin_acs_session[2] = $_SESSION['CLN_USR_TYP'];
		$wclin_acs_session[3] = $_SESSION['CLN_USR_CLN'];
	}
	else
	{
		$wclin_acs_session[0] = NULL;
		$wclin_acs_session[1] = 0;
		$wclin_acs_session[2] = 0;
		$wclin_acs_session[3] = 0;
	}

	if(isset($_COOKIE['WCLINCOOKIE']))
	{
		$wclin_acs_cookie = explode(",",$_COOKIE['WCLINCOOKIE']);
		
		$wclin_acs_cookie[0] = ($wclin_acs_cookie[0]/$cookie_time);
		$wclin_acs_cookie[1] = ($wclin_acs_cookie[1]/$cookie_time);
		$wclin_acs_cookie[2] = ($wclin_acs_cookie[2]/$cookie_time);
		$wclin_acs_cookie[3] = ($wclin_acs_cookie[3]);
	}
	else
	{
		$wclin_acs_cookie[0] = NULL;
		$wclin_acs_cookie[1] = 0;
		$wclin_acs_cookie[2] = 0;
		$wclin_acs_cookie[3] = 0;
	}
		
	if(!$wclin_acs_session[0])
	{
		$wclin_usr_cod = $wclin_acs_cookie[0];
		$wclin_usr_acs = $wclin_acs_cookie[1];
		$wclin_usr_typ = $wclin_acs_cookie[2];
		$wclin_usr_cln = $wclin_acs_cookie[3];
	}
	else
	{
		$wclin_usr_cod = $wclin_acs_session[0];
		$wclin_usr_acs = $wclin_acs_session[1];
		$wclin_usr_typ = $wclin_acs_session[2];
		$wclin_usr_cln = $wclin_acs_session[3];
	}
					
?>