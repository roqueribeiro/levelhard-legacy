<?php
	
	require "wclin_config/wclin_acs.php";
	require "wclin_config/wclin_lang_ptBR.php";
	require "wclin_config/wclin_db_conn.php";

	if(!@$_POST["wclin_act"])
		@$wclin_act = $_GET["wclin_act"];
	else
		@$wclin_act = $_POST["wclin_act"];
	
	if($wclin_acs_session[1] > 0 or $wclin_acs_cookie[1] > 0)
	{
		switch($wclin_act)
		{
			case "princ_list":
				print wclinPrincList();
			break;
			case "princ_contact":
				print wclinPrincContact();
			break;
			default:
				print wclinPrinc();
			break;
		}
	}
	else
	{
		die($wclin_error_msg[0]); 
	}
		
function wclinPrinc()
{
	global $wclin_usr_data, $wclin_usr_cod, $wclin_usr_cln;
	
	@$wclin_cookie 		= $_COOKIE['WCLINSEARCH'];
	@$wclin_list_search	= explode(",",$wclin_cookie);
	
	if(@$wclin_list_search[2])
	{
		$wclin_list_npag[$wclin_list_search[2]] = 'selected="selected"';
		$wclin_list_order[$wclin_list_search[3]] = 'selected="selected"';
	}
	else
	{
		$wclin_list_npag[15] = 'selected="selected"';
		$wclin_list_order[3] = 'selected="selected"';
	}
		
	$jQuery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		
		//chat escape
		$(window).unload(function(){ $.get('wclin_comp/chat/core.php',{'action':'usrStatus','snd_cod':'".$wclin_usr_cod."','snd_status':'0'}); });
		
		$('title').text('Clínica ".wclinClnData($wclin_usr_cln,1)."');
		
		$.get('wclin_comp/chat/index.php',{'snd_cod':'".$wclin_usr_cod."'},function(data){
			$('#wclin_chat').html(data);
			$.get('wclin_comp/chat/core.php',{'action':'usrStatus','snd_cod':'".$wclin_usr_cod."','snd_status':'1'},function(){
				$('#wclin_chat').fadeIn(300);
			});
		})

		$('#wclin_princ_info_nome').html('Carregando...');
		$.post('core_usr.php',{'wclin_act':'usr_nome'},function(data){
			$('#wclin_princ_info_nome').html(data);
		});
		
		html  = '<ul id=\"wclin_princ_list_item\">';
		html += '<li class=\"col0\">';
		html += '<img src=\"wclin_theme/wclin_default/wclin_image/wclin_loader_list.gif\">';
		html += '</li><li>Carregando...</li></ul>';
		
		$('#wclin_princ_list_load').html(html);
		$.post('core_princ.php',{'wclin_act':'princ_list'},function(data){
			$('#wclin_princ_list_load').fadeOut(300,function(){
				$(this).html(data).fadeIn(600);
				wclinTooltip();
				wclinFancyBox();
			});
		});
				
		$('input[name=wclin_search]').bind('keyup',function(){ $('form#wclin_search_form').submit(); });
										
		$('form#wclin_search_form').ajaxForm({
			beforeSubmit:function()
			{
				$('input[name=wclin_search]').unbind('keyup');	
			},
			success: function(data)
			{
				$('#wclin_princ_list_load').html(data);
				$('input[name=wclin_search]').bind('keyup',function(){ $('form#wclin_search_form').submit(); });	
				wclinTooltip();
				wclinFancyBox();
			} 
		});
		
		$('#wclin_but_home').click(function(){
			$('#wclin_loader').animate({'opacity':'1','top':'0px'},100,function(){
				$.cookie('WCLINSEARCH',undefined);
				$.post('core_princ.php',{'wclin_act':'princ_list'},function(data){
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						$('#wclin_princ_list_load').html(data).fadeIn(600);
						wclinTooltip();
						wclinFancyBox();
						$('select[name=wclin_list_npag] option[value=15]').attr('selected','selected');
						$('select[name=wclin_list_order] option[value=3]').attr('selected','selected');
					});
				});	
			});
		});
		
		$('#wclin_princ_info_but').click(function(){
			if($('#wclin_princ_info_list').css('display') == 'none')
			{
				$('#wclin_loader').animate({'opacity':'1','top':'0px'},100,function(){
					$.post('core_usr.php',{'wclin_act':''},function(data){
						$('#wclin_princ_info_list').html(data).fadeIn(600,function(){
							$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100);
						});
					});
				});
			}
			else
			{
				$('#wclin_princ_info_list').fadeOut(600);
			}
		});
		
		$('input[name=wclin_chat]').click(function(){
			
			if($('#wclin_chat').css('display') == 'none')
				$('#wclin_chat').fadeIn(300);
			else
				$('#wclin_chat').fadeOut(600);
			
		});
		
		$('select[name=wclin_list_npag]').change(function(){
			$('form#wclin_list_edit').submit();
		});
		$('select[name=wclin_list_order]').change(function(){
			$('form#wclin_list_edit').submit();
		});
		$('form#wclin_list_edit').ajaxForm({
			beforeSubmit:function()
			{
				$('select[name=wclin_list_npag]').attr('disabled','disabled');
				$('select[name=wclin_list_order]').attr('disabled','disabled');
				$('#wclin_loader').animate({'opacity':'1','top':'0px'},100);
			},
			success: function(data)
			{
				$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
					$('#wclin_princ_list_load').html(data);
					$('select[name=wclin_list_npag]').removeAttr('disabled');
					$('select[name=wclin_list_order]').removeAttr('disabled');
					wclinTooltip();
					wclinFancyBox();
				});
			}
		});
		$('#wclin_princ_foot_atv').click(function(){
			if($('#wclin_princ_foot').css('bottom') == '0px')
			{
				$('#wclin_princ_foot').animate({'opacity':'0','bottom':'-50px'},600);
				$('#wclin_princ_foot_atv img').fadeOut(100,function(){
					$(this).attr('src','wclin_theme/wclin_default/wclin_image/wclin_icon_expand.png').fadeIn(100);
				});
			}
			else
			{
				$('#wclin_princ_foot').animate({'opacity':'1','bottom':'0px'},600);
				$('#wclin_princ_foot_atv img').fadeOut(100,function(){
					$(this).attr('src','wclin_theme/wclin_default/wclin_image/wclin_icon_collapse.png').fadeIn(100);
				});
			}
		});
	});
	</script>
	";
	$html = '
	<div id="wclin_princ">
		<div id="wclin_princ_menu">
		<ul>
			<li><img src="wclin_theme/wclin_default/wclin_image/wclin_icon_home.png" id="wclin_but_home"></li>
			<li><a href="core_pac.php" id="fancy_ajax"><img src="wclin_theme/wclin_default/wclin_image/wclin_icon_add.png"></a></li>
			<li><a href="javascript:void(0)" id="" style="opacity:0.3"><img src="wclin_theme/wclin_default/wclin_image/wclin_icon_config.png"></a></li>
			<li><a href="core_login.php" id="fancy_ajax"><img src="wclin_theme/wclin_default/wclin_image/wclin_icon_exit.png"></a></li>
		</ul>
		</div>
		<div id="wclin_princ_bar">
			<div id="wclin_princ_info">
			<ul>
				<li id="wclin_princ_info_but">
					<img src="wclin_theme/wclin_default/wclin_image/wclin_icon_user.png">
					<div id="wclin_princ_info_nome"></div>
				</li>
				<li id="wclin_princ_info_list">
				</li>
			</ul>
			</div>
			<div id="wclin_princ_search">
			<form id="wclin_search_form" action="core_princ.php" method="post">
				<input type="hidden" name="wclin_act" value="princ_list">
				<input type="hidden" name="wclin_search_type" value="1">
				<input type="text" name="wclin_search">
				<input type="submit" value="Buscar" style="display:none;">
			</form>
			</div>
		</div>
		<div id="wclin_princ_list">
			<ul id="wclin_princ_list_cab">
				<li class="col0"></li>
				<li class="col0"></li>
				<li class="col0"></li>
				<li class="col1">Convênio</li>
				<li class="col3">Nome Completo</li>
				<li class="col4">CPF</li>
			</ul>
			<div id="wclin_princ_list_load"></div>
			<ul id="wclin_princ_list_menu">
				<li>
				Desenvolvido por Roque Ribeiro 2011.
				Dúvidas, Sugestões ou Problemas <a href="core_princ.php?wclin_act=princ_contact" id="fancy_ajax"><b>Clique Aqui</b></a>
				</li>
			</ul>
		</div>
	</div>
	<div id="wclin_chat"></div>
	<div id="wclin_princ_foot_atv"><img src="wclin_theme/wclin_default/wclin_image/wclin_icon_collapse.png"></div>
	<div id="wclin_princ_foot">
	<form id="wclin_list_edit" action="core_princ.php" method="post">
	<input type="hidden" name="wclin_act" value="princ_list">
	<ul>
		<li>
			<p>Pacientes Por Pagina</p>
			<select name="wclin_list_npag">
				<option value="10" 	'.@$wclin_list_npag[10].'>10</option>
				<option value="15" 	'.@$wclin_list_npag[15].'>15</option>
				<option value="30" 	'.@$wclin_list_npag[30].'>30</option>
				<option value="50" 	'.@$wclin_list_npag[50].'>50</option>
				<option value="100" '.@$wclin_list_npag[100].'>100</option>
				<option value="200" '.@$wclin_list_npag[200].'>200</option>
			</select>
		</li>
		<li>
			<p>Ordenar Por</p>
			<select name="wclin_list_order">
				<option value="1" '.@$wclin_list_order[1].'>Convênio Ascendente</option>
				<option value="2" '.@$wclin_list_order[2].'>Convênio Descendente</option>
				<option value="3" '.@$wclin_list_order[3].'>Nome Ascendente</option>
				<option value="4" '.@$wclin_list_order[4].'>Nome Descendente</option>
				<option value="5" '.@$wclin_list_order[5].'>Registro Ascendente</option>
				<option value="6" '.@$wclin_list_order[6].'>Registro Descendente</option>
			</select>
		</li>
		<li><input type="button" name="wclin_chat" value="Comunicação (beta)"></li>
		<li><input type="button" value="Pacientes em Espera" disabled="disabled"></li>
	</ul>
	</form>
	</div>
	';
	
	return $jQuery.$html;
}

function wclinPrincList()
{
	global $cookie_time, $wclin_usr_cln, $wclin_usr_typ;
	
	$wclin_auto 		= @$_GET["wclin_auto"];
	$wclin_search_type 	= @$_POST["wclin_search_type"];
	$wclin_list_npag	= @$_POST["wclin_list_npag"];
	$wclin_list_order	= @$_POST["wclin_list_order"];
	
	if(!$wclin_auto)
		$wclin_search = @$_POST["wclin_search"];
	else
		$wclin_search = @$_GET["q"];
	
	if(isset($_COOKIE['WCLINSEARCH']))
	{
		
		$wclin_list_search 	= explode(",",$_COOKIE['WCLINSEARCH']);
		$wclin_search_arr 	= explode(" ",$wclin_search);
		
		foreach ($wclin_search_arr as &$wclin_search_a) 
		{
			if(!@$wclin_search_n)
			{
				$wclin_search_c = "C.CLN_CON_NOM LIKE '%".$wclin_search_a."%' ";
				$wclin_search_n = "P.CLN_PAC_NOM LIKE '%".$wclin_search_a."%' ";
				$wclin_search_s = "P.CLN_PAC_SNO LIKE '%".$wclin_search_a."%' ";
				$wclin_search_f = "P.CLN_PAC_CPF LIKE '%".$wclin_search_a."%' ";
			}
			else
			{
				$wclin_search_n .= "AND P.CLN_PAC_SNO LIKE '%".$wclin_search_a."%' ";
				$wclin_search_s .= "AND P.CLN_PAC_NOM LIKE '%".$wclin_search_a."%' ";
			}
		}	
		$wclin_search_a = "
				(".$wclin_search_c.") 
			OR 
				(".$wclin_search_n.") 
			OR 
				(".$wclin_search_s.") 
			OR 
				(".$wclin_search_f.")
			OR
				(P.CLN_PAC_NOM LIKE '%".$wclin_search."%')
			OR
				(P.CLN_PAC_SNO LIKE '%".$wclin_search."%')
		";
		
		if(isset($wclin_search))		$wclin_list_search[0] = $wclin_search_a;
		if(isset($wclin_search_type)) 	$wclin_list_search[1] = $wclin_search_type;
		if(isset($wclin_list_npag)) 	$wclin_list_search[2] = $wclin_list_npag;
		if(isset($wclin_list_order)) 	$wclin_list_search[3] = $wclin_list_order;
		
		if(!$wclin_auto)
			setcookie("WCLINSEARCH",$wclin_list_search[0].",".$wclin_list_search[1].",".$wclin_list_search[2].",".$wclin_list_search[3]);
		
		if($wclin_list_search)
		{
			if($wclin_list_search[1] == 1)
			{
				$wclin_list_search[1] = "AND (".$wclin_list_search[0].")";
			}
			if($wclin_list_search[3] == 1)
			{ 
				$wclin_list_search[3] = "ORDER BY C.CLN_CON_NOM ASC"; 
			}
			if($wclin_list_search[3] == 2)
			{ 
				$wclin_list_search[3] = "ORDER BY C.CLN_CON_NOM DESC"; 
			}
			if($wclin_list_search[3] == 3)
			{ 
				$wclin_list_search[3] = "ORDER BY P.CLN_PAC_NOM ASC, P.CLN_PAC_SNO ASC"; 
			}
			if($wclin_list_search[3] == 4)
			{ 
				$wclin_list_search[3] = "ORDER BY P.CLN_PAC_NOM DESC, P.CLN_PAC_SNO DESC"; 
			}
			if($wclin_list_search[3] == 5)
			{ 
				$wclin_list_search[3] = "ORDER BY P.CLN_PAC_COD ASC"; 
			}
			if($wclin_list_search[3] == 6)
			{ 
				$wclin_list_search[3] = "ORDER BY P.CLN_PAC_COD DESC"; 
			}
		}
	}
	else
	{
		if(!$wclin_auto)
			setcookie("WCLINSEARCH",$wclin_search.",".$wclin_search_type.",".$wclin_list_npag.",".$wclin_list_order);
	}
	
	if(!@$wclin_list_search[2])
	{
		$wclin_list_search[2] = 15; 
	}
	if(!@$wclin_list_search[3])
	{ 
		$wclin_list_search[3] = "ORDER BY P.CLN_PAC_NOM, P.CLN_PAC_SNO"; 
	}
						
	$Query 	= "
	SELECT 
		P.CLN_PAC_COD, 
		C.CLN_CON_NOM, 
		P.CLN_PAC_NOM, 
		P.CLN_PAC_SNO,
		P.CLN_PAC_TEL,
		P.CLN_PAC_CEL,
		P.CLN_PAC_CPF,
		DATE_FORMAT(P.CLN_PAC_NAS,'%d/%m/%Y'),
		P.CLN_PAC_CEP,
		P.CLN_PAC_RUA,
		P.CLN_PAC_NUM,
		P.CLN_PAC_BAI,
		P.CLN_PAC_CID,
		P.CLN_PAC_EST,
		U.CLN_USR_NOM,
		U.CLN_USR_SNO,
		DATE_FORMAT(P.CLN_PAC_DAT,'%d/%m/%Y'),
		DATE_FORMAT(P.CLN_PAC_DAT,'%T')
	FROM 
		TB_CLN_PAC AS P
	INNER JOIN
		TB_CLN_CON AS C
	ON
		P.CLN_PAC_CON = C.CLN_CON_COD
	INNER JOIN
		TB_CLN_USR AS U
	ON
		P.CLN_PAC_USR = U.CLN_USR_COD
	WHERE
		P.CLN_PAC_CLN = ".$wclin_usr_cln."
		".@$wclin_list_search[1]."
		".@$wclin_list_search[3]."
	LIMIT 
		0,".$wclin_list_search[2].";
	";
		
    $QueryApply 	= @mysql_query($Query);
    $QueryResults 	= @mysql_num_rows($QueryApply);
    if ($QueryResults > 0)
    {
		$i = 0;
        while($ResultRow = mysql_fetch_array($QueryApply)) 
        {
			$bd_result[0] 	= $ResultRow[0];
			$bd_result[1] 	= wclin_format($ResultRow[1]);
			$bd_result[2] 	= wclin_format($ResultRow[2]);
			$bd_result[3] 	= wclin_format($ResultRow[3]);
			$bd_result[4] 	= $ResultRow[4];
			$bd_result[5] 	= $ResultRow[5];
			$bd_result[6] 	= $ResultRow[6];
			$bd_result[7] 	= $ResultRow[7];
			$bd_result[8] 	= $ResultRow[8];
			$bd_result[9] 	= wclin_format($ResultRow[9]);
			$bd_result[10] 	= wclin_format($ResultRow[10]);
			$bd_result[11] 	= wclin_format($ResultRow[11]);
			$bd_result[12] 	= wclin_format($ResultRow[12]);
			$bd_result[13] 	= $ResultRow[13];
			$bd_result[14] 	= wclin_format($ResultRow[14]);
			$bd_result[15] 	= wclin_format($ResultRow[15]);
			$bd_result[16] 	= $ResultRow[16];
			$bd_result[17] 	= $ResultRow[17];
			
			$html_tooltip = "
			<div>
				<ul>
					<li>Telefone:</li>
					<li>".$bd_result[4]."</li>
				</ul>
				<ul>
					<li>Celular:</li>
					<li>".$bd_result[5]."</li>
				</ul>
				<ul>
					<li>D. Nascimento:</li>
					<li>".$bd_result[7]."</li>
				</ul>
				<ul>
					<li>Idade:</li>
					<li>".wclin_pac_age($bd_result[7])."</li>
				</ul>
				<ul>
					<li>CEP:</li>
					<li>".$bd_result[8]."</li>
				</ul>
				<ul>
					<li>Endereço:</li>
					<li>".$bd_result[9]." ".$bd_result[10]."</li>
				</ul>
				<ul>
					<li>Bairro:</li>
					<li>".$bd_result[11]."</li>
				</ul>
				<ul>
					<li>Cidade:</li>
					<li>".$bd_result[12]."</li>
				</ul>
				<ul>
					<li>Estado:</li>
					<li>".$bd_result[13]."</li>
				</ul>
				<ul>
					<li>Cadastro Por:</li>
					<li>".$bd_result[14]." ".$bd_result[15]."</li>
				</ul>
				<ul>
					<li>Cadastro Em:</li>
					<li>".$bd_result[16]." às ".$bd_result[17]."</li>
				</ul>
				<ul>
					<li>CID:</li>
					<li>".wclinClnCID($bd_result[0])."</li>
				</ul>
			</div>
			";
			
			if($i % 2)
			{ 
				$wclin_princ_list_style = 'style="background:rgba(0,0,0,0.05)"'; 
			} 
			else 
			{ 
				$wclin_princ_list_style = 'style="background:rgba(0,0,0,0)"'; 
			}
			
			if($wclin_usr_typ == 2)
			{
				$wclin_med_href = 'href="core_con.php?pac_cod='.$bd_result[0].'" id="fancy_ajax"';
				$wclin_med_none = 'style="opacity:1;"';
			}
			else
			{
				$wclin_med_href = 'href="javascript:void(0);" id=""';
				$wclin_med_none = 'style="opacity:0.2;"';
			}
			
			@$html .= "
			<ul id=\"wclin_princ_list_item\" ".$wclin_princ_list_style.">
				<li class=\"col0\">
					<a ".$wclin_med_href.">
						<img src=\"wclin_theme/wclin_default/wclin_image/wclin_icon_list_manage.png\" ".$wclin_med_none.">
					</a>
				</li>
				<li class=\"col0\">
					<a href=\"core_pac.php?pac_cod=".$bd_result[0]."\" id=\"fancy_ajax\">
						<img src=\"wclin_theme/wclin_default/wclin_image/wclin_icon_list_edit.png\">
					</a>
				</li>
				<li class=\"col0\">
					<a href=\"core_pac.php?wclin_act=pac_del_form&pac_cod=".$bd_result[0]."\" id=\"fancy_ajax\">
						<img src=\"wclin_theme/wclin_default/wclin_image/wclin_icon_list_del.png\">
					</a>
				</li>
				<a href=\"javascript:void(0);\" title='".$html_tooltip."'>
					<li class=\"col1\">".$bd_result[1]."</li>
					<li class=\"col3\">".$bd_result[2]." ".$bd_result[3]."</li>
					<li class=\"col4\">".$bd_result[6]."</li>
				</a>
			</ul>
			";
			
			@$html_auto .= "".$bd_result[2]." ".$bd_result[3]."\n";
			
			$i++;
        }				
    }
	else
	{
		@$html = '<ul id="wclin_princ_list_item" style="text-align:center; padding-bottom:5px;"><li>Nenhum Paciente Encontrado</li></ul>';
		
		@$html_auto = "";
	}
	
	if($wclin_auto)
		return $html_auto;
	else
		return $html;
}

function wclinPrincContact()
{
	$jQuery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		
		$('#wrocky_nome').focus();
		
		$.post('core_usr.php',{'wclin_act':'usr_nome'},function(data){
			$('#wrocky_nome').attr({'value':data,'readonly':'readonly'});
		});
		
		$.getScript('wclin_script/tiny_mce/jquery.tinymce.js',function(){
			$('textarea.tinymce').tinymce({
				script_url 	: 'wclin_script/tiny_mce/tiny_mce.js',
				content_css : 'wclin_theme/wclin_default/wclin_style/wclin_css_tinymce.css',
				language 	: 'pt'
			});
		}); 
		
		$('#mail_form').ajaxForm({
			beforeSubmit: function(){
				$('#wclin_loader').animate({'opacity':'1','top':'0px'},100);	
				$('#wrocky_form input[type=submit]').attr('disabled','disabled');		
				if(!$('#wrocky_nome').attr('value'))
				{
					wclin_pac_valid('#wrocky_nome','rgba(255,240,230,1)',3);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Digite o Seu Nome )',3000);
						$('#wrocky_form input[type=submit]').removeAttr('disabled');
					});
					return false;				
				}
				else if($('#wrocky_nome').val().length < 3)
				{
					wclin_pac_valid('#wrocky_nome','rgba(255,240,230,1)',3);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Mínimo de Três Caracteres )',3000);
						$('#wrocky_form input[type=submit]').removeAttr('disabled');
					});
					return false;				
				}
				if(!$('#wrocky_email').attr('value'))
				{
					wclin_pac_valid('#wrocky_email','rgba(255,240,230,1)',5);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Digite o Seu E-Mail )',3000);
						$('#wrocky_form input[type=submit]').removeAttr('disabled');
					});
					return false;				
				}
				else if($('#wrocky_email').val().length < 5)
				{
					wclin_pac_valid('#wrocky_email','rgba(255,240,230,1)',5);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Mínimo de Três Caracteres )',3000);
						$('#wrocky_form input[type=submit]').removeAttr('disabled');
					});
					return false;				
				}
				if(!$('#wrocky_assunto').attr('value'))
				{
					wclin_pac_valid('#wrocky_assunto','rgba(255,240,230,1)',5);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Digite o Assunto )',3000);
						$('#wrocky_form input[type=submit]').removeAttr('disabled');
					});
					return false;				
				}
				else if($('#wrocky_assunto').val().length < 5)
				{
					wclin_pac_valid('#wrocky_assunto','rgba(255,240,230,1)',5);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Mínimo de Três Caracteres )',3000);
						$('#wrocky_form input[type=submit]').removeAttr('disabled');
					});
					return false;				
				}
				if(!$('#wrocky_texto').attr('value'))
				{
					wclin_pac_valid('#wrocky_texto','rgba(255,240,230,1)',10);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Digite o Texto )',3000);
						$('#wrocky_form input[type=submit]').removeAttr('disabled');
					});
					return false;				
				}
				else if($('#wrocky_texto').val().length < 10)
				{
					wclin_pac_valid('#wrocky_texto','rgba(255,240,230,1)',10);
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						wclin_float_msg('( Mínimo de Dez Caracteres )',3000);
						$('#wrocky_form input[type=submit]').removeAttr('disabled');
					});
					return false;				
				}
			},
			success: function(data){
				$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
					if(data > 0)
					{
						html  = '<div id=\"wrocky_form\">';
						html += '<div id=\"wrocky_form_ajax\">';
						html += '<ul><li id=\"wrocky_form_cab\">Contato com o Desenvolvedor</li></ul>';
						html += '<ul><li style=\"padding:20px 10px 20px 10px; text-align:center;\">E-Mail Enviado!</li></ul>';
						html += '<ul><li><input type=\"button\" id=\"wclin_alert_cancel\" value=\"Fechar\"></li></ul>';
						html += '</div>';
						html += '</div>';
						$('#wrocky_form_ajax').html(html);
						$('#wclin_alert_cancel').click(function(){ 
							$.fancybox.close(); 
						});
					}
					else
					{
						html  = '<div id=\"wrocky_form\">';
						html += '<div id=\"wrocky_form_ajax\">';
						html += '<ul><li id=\"wrocky_form_cab\">Contato com o Desenvolvedor</li></ul>';
						html += '<ul><li style=\"padding:20px 10px 20px 10px; text-align:center;\">Erro ao Enviar. Tente Novamente!</li></ul>';
						html += '<ul><li><input type=\"button\" id=\"wclin_alert_cancel\" value=\"Fechar\"></li></ul>';
						html += '</div>';
						html += '</div>';
						$('#wrocky_form_ajax').html(html);
						$('#wclin_alert_cancel').click(function(){ 
							$.fancybox.close(); 
						});
					}
				});
			} 
		}); 
	});
	</script>	
	";
	
	$html = '
	<div id="wrocky_form">
		<div id="wrocky_form_ajax">
		<form action="core_mail.php" id="mail_form" method="post">
		<input type="hidden" name="action" value="mail_send" />
		<ul>
			<li id="wrocky_form_cab">Contato com o Desenvolvedor</li>
		</ul>
		<ul>
			<li>Seu Nome Completo</li>
			<li style="text-align:center;"><input type="text" id="wrocky_nome" name="nome" /></li>
		</ul>
		<ul>
			<li>Seu E-Mail</li>
			<li style="text-align:center;"><input type="text" id="wrocky_email" name="email" /></li>
		</ul>
		<ul>
			<li>Assunto</li>
			<li style="text-align:center;"><input type="text" id="wrocky_assunto" name="assunto" /></li>
		</ul>
		<ul>
			<li>Texto da mensagem</li>
			<li style="text-align:center;"><textarea id="wrocky_texto" name="texto" class="tinymce"></textarea></li>
		</ul>
		<ul>
			<li style="text-align:center; font-size:10px;"><a href="http://www.webrocky.com.br" target="_blank">www.WebRoCkY.com.br</a></li>
		</ul>
		<ul>
			<li style="text-align:center;"><input type="submit" id="wrocky_send" value="Enviar" /></li>
		</ul>
		</form>
		</div>
	</div>
	';
	
	return $jQuery.$html;
}

?>