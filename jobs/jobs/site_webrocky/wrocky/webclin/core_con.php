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
			case "con_add":
				print wclinConAdd();
			break;
			case "con_ant":
				print wclinConAnt();
			break;
			default:
				print wclinConPrinc();
			break;
		}
	}
	else
	{
		die($wclin_error_msg[0]); 
	}

function wclinConPrinc()
{
	
	@$wclin_pac_edit = $_GET["pac_cod"];
	
	if(isset($wclin_pac_edit))
	{
		$Query = "
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
				CLN_PAC_COD = '".$wclin_pac_edit."';
		";
		
		$QueryApply 	= mysql_query($Query);
		$QueryResults 	= mysql_num_rows($QueryApply);
		if($QueryResults != 0)
		{
			while ($ResultRow = mysql_fetch_array($QueryApply)) 
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
				
				@$wclin_pac_info .= "
				<ul>
					<li style=\"width:120px\">Convênio:</li>
					<li>".$bd_result[1]."</li>
				</ul>
				<ul style=\"background:rgba(0,0,0,0.03)\">
					<li style=\"width:120px\">Nome:</li>
					<li>".$bd_result[2]."</li>
				</ul>
				<ul>
					<li style=\"width:120px\">Sobrenome:</li>
					<li>".$bd_result[3]."</li>
				</ul>
				<ul style=\"background:rgba(0,0,0,0.03)\">
					<li style=\"width:120px\">D. Nascimento:</li>
					<li>".$bd_result[7]."</li>
				</ul>
				<ul>
					<li style=\"width:120px\">Idade:</li>
					<li>".wclin_pac_age($bd_result[7])."</li>
				</ul>
				<ul style=\"background:rgba(0,0,0,0.03)\">
					<li style=\"width:120px\">Telefone:</li>
					<li>".$bd_result[4]."</li>
				</ul>
				<ul>
					<li style=\"width:120px\">Celular:</li>
					<li>".$bd_result[5]."</li>
				</ul>
				<ul style=\"background:rgba(0,0,0,0.03)\">
					<li style=\"width:120px\">CPF.:</li>
					<li>".$bd_result[6]."</li>
				</ul>
				<ul>
					<li style=\"width:120px\">CEP:</li>
					<li>".$bd_result[8]."</li>
				</ul>
				<ul style=\"background:rgba(0,0,0,0.03)\">
					<li style=\"width:120px\">Endereço:</li>
					<li>".$bd_result[9]." ".$bd_result[10]."</li>
				</ul>
				<ul>
					<li style=\"width:120px\">Bairro:</li>
					<li>".$bd_result[11]."</li>
				</ul>
				<ul style=\"background:rgba(0,0,0,0.03)\">
					<li style=\"width:120px\">Cidade:</li>
					<li>".$bd_result[12]."</li>
				</ul>
				<ul>
					<li style=\"width:120px\">Estado:</li>
					<li>".$bd_result[13]."</li>
				</ul>
				<ul style=\"background:rgba(0,0,0,0.03)\">
					<li style=\"width:120px\">Cadastro Por:</li>
					<li>".$bd_result[14]." ".$bd_result[15]."</li>
				</ul>
				<ul>
					<li style=\"width:120px\">Cadastro Em:</li>
					<li>".$bd_result[16]." às ".$bd_result[17]."</li>
				</ul>
				";
			}
		}
	}
	
	$jQuery = "
	<script type=\"text/javascript\">
	$(document).ready(function(){
		$('.jclock').jclock();
		$.getScript('wclin_script/tiny_mce/jquery.tinymce.js',function(){
			$('textarea.tinymce').tinymce({
				
				theme 		: 'advanced',
				script_url 	: 'wclin_script/tiny_mce/tiny_mce.js',
				content_css : 'wclin_theme/wclin_default/wclin_style/wclin_css_tinymce.css',
				language 	: 'pt',
				
				theme_advanced_buttons1 : 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect,|,forecolor,backcolor,|,bullist,numlist,|,undo,redo',
				theme_advanced_buttons2 : '',
				theme_advanced_buttons3 : '',
				theme_advanced_buttons4 : '',
				theme_advanced_toolbar_location : 'top',
				theme_advanced_toolbar_align 	: 'left',
				
				skin 			: 'o2k7',
				skin_variant 	: 'silver',			
			});
		});
	});
	
	$('#wclin_con_ant_cab').click(function(){
		if($('#wclin_con_ant_con').css('height') == '0px')
		{
			$(this).text('Ocultar Consultas Anteriores');
			$('#wclin_loader').animate({'opacity':'1','top':'0px'},100);				
			$.get('core_con.php',{'wclin_act':'con_ant','pac_cod':'".$wclin_pac_edit."'},function(data){
				$('#wclin_con_ant_con').animate({'height':'400px'},function(){
					$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
						$('#wclin_con_ant_con').html(data);
						$('div#wclin_con_ant_data').click(function(){
							if($('#wclin_con_ant_data_info',this).css('height') == '0px')
							{
								$('#wclin_con_ant_data_info',this).show(0,function(){
									$(this).animate({'height':'150px'},300,function(){
										$(this).click(function(){ return false; });
									});
								});
							}
							else
							{
								$('#wclin_con_ant_data_info',this).animate({'height':'0px'},100,function(){
									$(this).hide();
								});
							}
						});
					});					
				});
			});
		}
		else
		{
			$(this).text('Mostrar Consultas Anteriores');
			$('#wclin_con_ant_con').animate({'height':'0px'},function(){
				$('#wclin_con_ant_con').html('');	
			});
		}
	});
	
	$('#wclin_con_form').ajaxForm({
		beforeSubmit:function()
		{
			$('#wclin_loader').animate({'opacity':'1','top':'0px'},100);
			$('#wclin_con input[type=submit]').attr('disabled','disabled');
			if(!$('textarea[name=wclin_aten_anam]').val())
			{
				wclin_pac_valid('textarea[name=wclin_aten_anam]','rgba(255,240,230,1)',3);
				$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
					wclin_float_msg('( Digite a Anamnese )',3000);
					$('#wclin_con input[type=submit]').removeAttr('disabled');
				});
				return false;
			}
		},
		success: function(data)
		{
			$('#wclin_loader').animate({'opacity':'0','top':'-24px'},100,function(){
				wclin_float_msg(data,3000);
				$('#wclin_con input[type=text]').attr('value','');
				$('#wclin_con textarea').text('');
				$('#wclin_con input[type=submit]').removeAttr('disabled');
			});
		}
	});
	</script>	
	";
	
	$html = '
	<div id="wclin_con">
		<div id="wclin_con_cab">Consultar Paciente</div>
		<div id="wclin_con_box_a">
			<form action="core_con.php" id="wclin_con_form" method="post">
			<input type="hidden" name="wclin_act" value="con_add">
			<input type="hidden" name="wclin_aten_pac" value="'.$wclin_pac_edit.'">
			<div id="wclin_con_box_1">
				<div id="wclin_con_pac">
					<div id="wclin_con_cab">Informações do Paciente</div>
					<div id="wclin_con_pac_con">
					'.$wclin_pac_info.'
					</div>
				</div>
				<div id="wclin_con_tipo">
					<div id="wclin_con_cab">Informações da Consulta</div>
					<div id="wclin_con_tipo_con">
					<ul>
						<li style="width:60px;">Data:</li>
						<li>'.date("d/m/Y").'</li>
					</ul>
					<ul>
						<li style="width:60px;">Hora:</li>
						<li class="jclock"></li>
					</ul>
					<ul>
						<li style="width:60px;">Tipo:</li>
						<li><select name="wclin_aten_tipo">
							<option value="1">Consulta</option>
							<option value="2">Retorno</option>
						</select></li>
					</ul>
					<ul>
						<li style="width:60px;">CID:</li>
						<li style="width:95px;"><input type="text" name="wclin_aten_cid" size="10" maxlength="5"></li>
						<li><a href="http://www.datasus.gov.br/cid10/v2008/webhelp/cid10.htm" target="_blank" class="fancy_button">CID-10 [2008]</a></li>
					</ul>
					</div>
				</div>
			</div>
			<div id="wclin_con_box_2">
				<div id="wclin_con_anam">
					<div id="wclin_con_cab">Anamnese</div>
					<div id="wclin_con_anam_con">
						<ul>
							<li><textarea name="wclin_aten_anam" class="tinymce"></textarea></li>
						</ul>
						<ul>
							<li><input type="submit" value="Salvar Consulta"></li>
						</ul>
					</div>
				</div>
			</div>
			</form>
		</div>
		<div id="wclin_con_box_3">
			<div id="wclin_con_ant">
				<div id="wclin_con_ant_cab">Mostrar Consultas Anteriores</div>
				<div id="wclin_con_ant_con">
				</div>
			</div>
		</div>
	</div>
	';
	
	return $jQuery.$html;
}

function wclinConAnt()
{
	global $wclin_usr_cln;
	
	@$wclin_pac_edit = $_GET["pac_cod"];
	
	if(isset($wclin_pac_edit))
	{
		$Query = "
		SELECT 
			CLN_ATN_COD,
			DATE_FORMAT(CLN_ATN_DAT,'%d/%m/%Y'),
			DATE_FORMAT(CLN_ATN_DAT,'%H:%i:%s'),
			CLN_ATN_TPO,
			CLN_ATN_CID,
			CLN_ATN_ANM,
			CLN_ATN_PAC,
			CLN_ATN_USR
		FROM 
			TB_CLN_ATN 
		WHERE 
			CLN_ATN_PAC = '".$wclin_pac_edit."' 
		AND 
			CLN_ATN_CLN = '".$wclin_usr_cln."' 
		ORDER BY 
			CLN_ATN_COD DESC;
		";
		$QueryApply 	= mysql_query($Query);
		$QueryResults 	= mysql_num_rows($QueryApply);
		if($QueryResults != 0)
		{
			while ($ResultRow = mysql_fetch_array($QueryApply)) 
			{
				@$bd_result[0] 	= $ResultRow[0];
				@$bd_result[1] 	= $ResultRow[1];
				@$bd_result[2] 	= $ResultRow[2];
				@$bd_result[3] 	= $ResultRow[3];
				@$bd_result[4] 	= $ResultRow[4];
				@$bd_result[5] 	= $ResultRow[5];
				@$bd_result[6] 	= $ResultRow[6];
				@$bd_result[7] 	= $ResultRow[7];
				
				@$html .= '
				<div id="wclin_con_ant_data">
					<div id="wclin_con_ant_data_cab">
						Data: '.$bd_result[1].' Hora: '.$bd_result[2].' Tipo de Consulta: '. wclin_tipo($bd_result[3]).' CID: '.strtoupper($bd_result[4]).'
					</div>
					<div id="wclin_con_ant_data_info">
						'.$bd_result[5].'
					</div>
				</div>
				';
				
			}
		}
		else
		{
			@$html .= '
			<div id="wclin_con_ant_data">
				<div id="wclin_con_ant_data_cab">
					Este Paciente Não Possuí Consulta
				</div>
			</div>
			';			
		}
	}
	
	return $html;
}

function wclinConAdd()
{
	global $wclin_usr_cod, $wclin_usr_cln;
	
	@$wclin_aten_add[0] = $_POST["wclin_aten_pac"];
	@$wclin_aten_add[1] = $_POST["wclin_aten_tipo"];
	@$wclin_aten_add[2] = $_POST["wclin_aten_cid"];
	@$wclin_aten_add[3] = str_replace ("'","\'",$_POST["wclin_aten_anam"]);;
	
	$Query = "
	INSERT INTO  
		TB_CLN_ATN
		(
			CLN_ATN_COD,
			CLN_ATN_DAT,
			CLN_ATN_TPO,
			CLN_ATN_CID,
			CLN_ATN_ANM,
			CLN_ATN_PAC,
			CLN_ATN_USR,
			CLN_ATN_CLN
		)
		VALUES 
		(
			NULL, 
			'".date("Y-m-d  H:i:s")."',
			'".$wclin_aten_add[1]."', 
			'".strtoupper($wclin_aten_add[2])."',
			'".$wclin_aten_add[3]."', 
			'".$wclin_aten_add[0]."', 
			'".$wclin_usr_cod."',
			'".$wclin_usr_cln."'
		);
	";
	
	$QueryApply = mysql_query($Query);
	
	if($QueryApply)
		$html = "<p style=\"color:#0C0\">( Consulta Realizada! )</p>";
	else
		$html = "<p style=\"color:#F00\">( Erro! Tente Novamente. )</p>";
				
	return $html;
	
}

?>