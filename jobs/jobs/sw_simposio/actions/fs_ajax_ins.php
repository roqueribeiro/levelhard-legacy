<?php

	//Conexão do Banco de Dados
	require "../config/connect_db.php";
	
	//Linguagem do Site
	require "../languages/language-ptbr.php";
		
	print $crs_count;
	
	$ra 	= $_POST['ra'];
	$nome 	= $_POST['nome'];
	$mail 	= $_POST['mail'];
	$tel 	= $_POST['tel'];
	$cel 	= $_POST['cel'];
	$cpf 	= $_POST['cpf'];
	$cep 	= $_POST['cep'];
	$rua 	= $_POST['rua'];
	$num 	= $_POST['num'];
	$bai 	= $_POST['bai'];
	$cid 	= $_POST['cid'];
	$uf 	= $_POST['uf'];
	$dt		= date("d/m/y H:i:s");
	
	$crs = $_POST['cursos'];
	$crsArr = explode(",",$crs);
	sort($crsArr);
	$crsCount = count($crsArr);
	
	if($ra and $nome and $mail and $cpf and $cep and $rua and $num and $bai and $cid and $uf)
	{
		$QueryCPF = "SELECT cpf_numero, curso_codigo FROM fs_inscricao WHERE cpf_numero = '".$cpf."' and curso_codigo IN (".$crs.");";
		$QueryCPFApply = mysql_query($QueryCPF);
		$QueryCPFResults = mysql_num_rows($QueryCPFApply); 
		if ($QueryCPFResults > 0)
		{
			while($ResultCPFRow = mysql_fetch_array($QueryCPFApply))
			{
				if(!$ResCPFArr)
				{
					if(in_array($ResultCPFRow["curso_codigo"], $crsArr))
					{
						$ResCPFArr .= $ResultCPFRow["curso_codigo"];
					}
				}
				else
				{
					if(in_array($ResultCPFRow["curso_codigo"], $crsArr))
					{
						$ResCPFArr .= ",".$ResultCPFRow["curso_codigo"];
					}
				}
			}
			print $ResCPFArr;
		}
		else
		{
			for($i=0;$i<$crsCount;$i++)
			{
				$Query = "
				INSERT INTO fs_inscricao 
				(
					codigo,
					nome,
					email,
					telefone,
					celular,
					ra_numero,
					cpf_numero,
					end_rua,
					end_numero,
					end_bairro,
					end_cep,
					end_cidade,
					end_estado,
					data_hora,
					curso_codigo
				)
				VALUES 
				(
					NULL, 
					'".$nome."',
					'".$mail."',
					'".$tel."',
					'".$cel."',
					'".$ra."',
					'".$cpf."',
					'".$rua."',
					'".$num."',
					'".$bai."',
					'".$cep."',
					'".$cid."',
					'".$uf."',
					'".$dt."',
					'".$crsArr[$i]."'
				);
				";
				$QueryApply = mysql_query($Query);
			}		
			if($QueryApply)
			{
				print '
				<br />
				<p><h2>Inscrição Concluida!</h2><p>
				<br />
				<fieldset style="text-align:center">
				<p>Seus dados serão verificados e se houver erros ou dados inválidos, o cadastro será desconsiderado.<p>
				<br />
				<p>Você pode verificar os cursos que se cadastrou, clicando no botão "Minhas Inscrições".<p>
				<br />
				<p>As informações das salas onde será ministradas as palestras ou mini-cursos, 
				será pubicada com antecedencia neste mesmo site em uma nova sessão.<p>
				<br /><br />
				<input type="submit" value="Fechar" onClick="parent.$.fancybox.close();" />
				</fieldset>
				';
			}
		}
	}
	else
	{
		print '
		<br />
		<p><h2>Erro!</h2><p>
		<br />
		<fieldset style="text-align:center">
		<p>Você esqueceu de preencher algum campo obrigatório.<p>
		<br />
		<p>Feche esta janela e clique novamente em "Inscrever-se nos cursos selecionados. Obrigado!".<p>
		<br />
		<input type="submit" value="Fechar" onClick="parent.$.fancybox.close();" />
		</fieldset>
		';
	}
?>