<?php
	require "../core.php";
	$news = new Proprietario;
	
	$_SESSION["search_prop"] = "";
?>
<script type="text/javascript">
function AjaxDelete()
{
	$(document).ready(function(){
		$('a#but_delete').click(function(){
			id = $(this).attr('class');
			if(window.confirm('Você deseja deletar este item?'))
			{
				$('#loading').fadeIn(200);
				$.get("action/fs_prop_del.php",{'idCod':id},function(data){
					$('#loading').fadeOut(200);
					$('#p_data').html(data);
					ActFancyBox();
					AjaxDelete();
				    AjaxToolTip();
				});			
			}
			else
			{
				return false;
			}
		});
	});
}
function AjaxToolTip()
{
	$('#p_cont a').tooltip({ 
		track	:true,
		delay	:0, 
		showURL	:false, 
		fade	:600 
	});
}
$(document).ready(function(){
	
	AjaxDelete();
	AjaxToolTip();
	
	$('form[name=prop_search]').ajaxForm({
		target: '#p_data', 
		beforeSubmit:  function() { 
			$('#loading').fadeIn(200);
		},
		success: function() {
			AjaxDelete();
			ActFancyBox();
			AjaxToolTip();
			$('#loading').fadeOut(200);
		} 
	});
		
});
</script>
<div id="p_cont">
	<div id="p_menu">
        <div id="p_act">
        <a id="fancy_ajax" class="fancy_button" href="action/fs_prop_form.php">Adicionar Proprietário</a>
        <a id="fancy_frame" class="fancy_button" href="action/fs_prop_rel.php">Gerar Relatório</a>
        </div>
        <div id="p_search">
        <form name="prop_search" action="action/fs_prop_search.php" method="get">
            <input type="text" name="search">
            <input type="submit" value="Procurar">
        </form>
        </div>
    </div>
    <div id="p_header">
    <ul>
        <li class="p_col0"></li>
        <li class="p_col0"></li>
        <li class="p_col1">Nome</li>
        <li class="p_col2">Sobrenome</li>
        <li class="p_col3">Telefone</li>
        <li class="p_col4">Celular</li>
        <li class="p_col5">CPF</li>
    </ul>
    </div>
    <div id="p_data">
	<?php
        $news->ShowProp($search_prop);
    ?>
    </div>
</div>