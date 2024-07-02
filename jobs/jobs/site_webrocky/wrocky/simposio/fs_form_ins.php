<?php

	//Conexão do Banco de Dados
	require "config/connect_db.php";
	
	//Linguagem do Site
	require "languages/language-ptbr.php";
	 
	$check_arr = $_POST['check_curso']; 
	
	foreach ($check_arr as $arr) {
		
		if ($check_narr == "")
		{
			$check_narr .= $arr;
		}
		else
		{
			$check_narr .= ",".$arr;
		}
		
	}
	
	$QueryCursos = "
		SELECT 
			codigo, 
			nome
		FROM
			fs_curso
		WHERE 
			codigo IN (".$check_narr.")
		ORDER BY 
			nome 
	";
	
	$QueryCursosApply = mysql_query($QueryCursos);
	$QueryCursosResults = mysql_num_rows($QueryCursosApply); 
	if ($QueryCursosResults > 0)
	{
		while ($ResultCursosRow = mysql_fetch_array($QueryCursosApply)) 
		{
			$bd_result_cursos[1] = $ResultCursosRow["codigo"];
			$bd_result_cursos[2] = $ResultCursosRow["nome"];
		}
	}
	
	$OptEstados = '
	<option value="AC">AC</option> 
	<option value="AL">AL</option> 
	<option value="AM">AM</option> 
	<option value="AP">AP</option> 
	<option value="BA">BA</option> 
	<option value="CE">CE</option> 
	<option value="DF">DF</option> 
	<option value="ES">ES</option> 
	<option value="GO">GO</option> 
	<option value="MA">MA</option> 
	<option value="MG">MG</option> 
	<option value="MS">MS</option> 
	<option value="MT">MT</option> 
	<option value="PA">PA</option> 
	<option value="PB">PB</option> 
	<option value="PE">PE</option> 
	<option value="PI">PI</option> 
	<option value="PR">PR</option> 
	<option value="RJ">RJ</option> 
	<option value="RN">RN</option> 
	<option value="RO">RO</option> 
	<option value="RR">RR</option> 
	<option value="RS">RS</option> 
	<option value="SC">SC</option> 
	<option value="SE">SE</option> 
	<option value="SP">SP</option> 
	<option value="TO">TO</option> 
	';
	
?>
<script type="text/javascript">
$(document).ready(function() {
	$("input[name=tel]").mask("(99) 9999-9999");
	$("input[name=cel]").mask("(99) 9999-9999");
	$("input[name=ra]").mask("999.999.99.9.9.999",{placeholder:""});
	$("input[name=cpf]").mask("999.999.999-99");
	$("input[name=cep]").mask("99999-999",{placeholder:""});
	//AutoCompleta Nome do Aluno
	$('#form_ins input[name=ra]').keypress(function(){
		ra_num = $('#form_ins input[name=ra]').attr('value');
		if(ra_num.length == 18)
		{
			$('#form_ins input[name=nome]').attr('value','Carregando...');
			$.post('actions/fs_ajax_query_a.php', {check_ra: ra_num}, function(resposta) {
				$('#form_ins input[name=nome]').attr('value',resposta);
			});
		}
	})
	//AutoCompleta Endereço
	$('#form_ins input[name=cep]').keypress(function(){
		cep_num = $('#form_ins input[name=cep]').attr('value');
		if(cep_num.length == 9)
		{
			$('#form_ins input[name=rua]').attr('value','Carregando...');
			$('#form_ins input[name=bai]').attr('value','Carregando...');
			$('#form_ins input[name=cid]').attr('value','Carregando...');
			$.post('actions/fs_ajax_cep.php', {busca_cep: cep_num}, function(resposta) {
				eval("var arr = "+resposta);
				$('#form_ins input[name=rua]').attr('value',arr.rua);
				$('#form_ins input[name=bai]').attr('value',arr.bairro);
				$('#form_ins input[name=cid]').attr('value',arr.cidade);
				$('#form_ins select[name=uf] option').each(function() {
					if($(this).attr('value') == arr.uf)
					{
						$(this).attr('selected','selected');
					}
				});
			});
		}
	})
	//Enviar Inscrição do Aluno
	$('form[name=form_ins_submit]').ajaxForm({
		target: '#form_ins',
		beforeSubmit: function() {
			if($('input[name=cpf]').validateCPF())
			{
				return true;
			}
			else
			{
				alert('CPF invalido, verifique se você digitou corretamente!');
				return false;
			}
		},
		success: function(form_ins) {
			if(form_ins.search('<h2>') == '-1')
			{
				parent.$.fancybox.close();
				var CPFString 	= new String(form_ins);
				var CPFArray 	= CPFString.split(',');
				var CPFCount 	= CPFArray.length;
				for(i=0;i<CPFCount;i++)
				{
					$('.theme_content_item'+CPFArray[i]+' > #theme_content_item').css('border','1px #F00 solid');
					$('.theme_content_item'+CPFArray[i]+' input').attr('disabled','disabled').attr('checked','');
				}
				$('#theme_content_box_menu span').html('<img src="themes/default/ico_alert.png" /><span>Você já esta cadastrado!</span>');
			}
		} 
	});	
});
</script>
<div id="form_ins">
<legend><b>Formulário de Inscrição</b></legend>
<form name="form_ins_submit" action="actions/fs_ajax_ins.php" method="post">
<input type="hidden" name="cursos" value="<?php print $check_narr ?>" />
<fieldset>
<label>*RA: 				</label><input name="ra" 	type="text" size="15" /><br />
<label>*Nome Completo:	 	</label><input name="nome" 	type="text" size="20" /><br />
<label>*E-Mail: 			</label><input name="mail" 	type="text" size="20" /><br />
<label>Telefone:	 		</label><input name="tel" 	type="text" size="10" /><br />
<label>Celular: 			</label><input name="cel" 	type="text" size="10" /><br />
<label>*CPF: 				</label><input name="cpf" 	type="text" size="10" /><br />
<label>*CEP: 				</label><input name="cep" 	type="text" size="8"  /><br />
<label>*Rua:	 			</label><input name="rua" 	type="text" size="20" /><br />
<label>*Numero: 			</label><input name="num" 	type="text" size="1"  /><br />
<label>*Bairro: 			</label><input name="bai" 	type="text" size="20" /><br />
<label>*Cidade: 			</label><input name="cid" 	type="text" size="20" /><br />
<label>*Estado: 			</label><select name="uf"><?php print $OptEstados ?></select><br />
</fieldset>
<input type="submit" value="Enviar" />
</form>
</div>