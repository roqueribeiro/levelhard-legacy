<?php 
	
	//Linguagem do Site
	require "languages/language-ptbr.php";
	
?>
	<script type="text/javascript">
    $(document).ready(function(){	
			
		style = 'padding-left:20px; background: url(themes/default/mini_loading.gif) no-repeat left;';
		
		$('#theme_content_box_ajax input:checked').each(function() {
				checkarr.push($(this).val());
		});
		
		$('input[name=c_submit]').click(function(){
			var checkarr = [];
			$('#theme_content_box_ajax input:checked').each(function() {
				checkarr.push($(this).val());
			});
			$('input[name=c_check]').val(checkarr);
		})
		
		$('form[name=form_search]').ajaxForm({
			beforeSubmit: function() {
										
				c_area 		= $('select[name=c_area]').attr('value');
				c_periodo 	= $('select[name=c_periodo]').attr('value');
				c_dia 		= $('select[name=c_dia]').attr('value');
				c_busca 	= $('input[name=c_busca]').attr('value');
				if(!c_area && !c_periodo && !c_dia && !c_busca)
				{ 
					return false; 
				}
				else
				{
					$("#theme_loading").fadeIn(300);
				}
				
			},
			target: '#theme_content_box_ajax',
			data: { action: 's_curso' },
			success: function() { 
				$('#theme_loading').fadeOut(300);
				
				total = $('#theme_content_box_ajax input:checked').length;
				if(total == 1){text = ' - '+total+' Curso'}
				if(total > 1){s = 's'; text = ' - '+total+' Curso'+s }
				$('#theme_content_item_chk_c span').html(text);
				$('#theme_content_box_foot').hide();
				$('#theme_content_box_menu span').html('');
			} 
		});
		
		$('form[name=form_ins]').ajaxForm({
			beforeSubmit: function() {
				checks = $('#theme_content_box_ajax input:checked').length;
				if(checks == 0)
				{
					return false
				}
				else
				{
					$('#theme_loading').fadeIn(600);
				}
			},
			success: function(form_ins) {
				$('#theme_loading').fadeOut(200);
				$.fancybox({
					'padding'		: 6,
					'titleShow'		: false,
					'transitionIn'	: 'fade',
					'transitionOut'	: 'fade',
					'speedIn'		: 600,
					'speedOut'		: 300,
					'overlayOpacity': '0.1',
					'overlayColor'	: '#333',
					'content'		: form_ins
				})			
			} 
		});
					
		$('select[name=c_area]').html('<option>Carregando...</option>');
		$('select[name=c_area]').load('actions/fs_ajax_query_c.php', {action: 'a_combo'});
		$('select[name=c_area]').change(function(){
			codigo = $('select[name=c_area] option:selected').attr('value');
			$('select[name=c_periodo]').html('<option>Carregando...</option>');
			$('select[name=c_periodo]').load('actions/fs_ajax_query_c.php', {action: 'p_combo', codigo: codigo});
		});
		
		$('select[name=c_periodo]').html('<option>Carregando...</option>');
		$('select[name=c_periodo]').load('actions/fs_ajax_query_c.php', {action: 'p_combo'});
		$('select[name=c_periodo]').change(function(){
			codigo = $('select[name=c_periodo] option:selected').attr('id');
			periodo = $('select[name=c_periodo] option:selected').attr('value');
			$('select[name=c_dia]').html('<option>Carregando...</option>');
			$('select[name=c_dia]').load('actions/fs_ajax_query_c.php', {action: 'd_combo',codigo: codigo, periodo: periodo});
		});

		$('select[name=c_dia]').html('<option>Carregando...</option>');
		$('select[name=c_dia]').load('actions/fs_ajax_query_c.php', {action: 'd_combo'});
		
		$('#theme_content_box_ajax').html('<p style=\"margin-left:10px; '+style+'\">Carregando lista de cursos...</p>');
		$('#theme_content_box_ajax').load('actions/fs_ajax_query.php', {action: 'i_curso'}, function(){
			$(this).hide().fadeIn(600);
			$('#theme_content_box_foot').fadeIn(600);
		});
		
		$('#mais').click(function() {
			var ultimo = $('#theme_content_box_ajax ul:last').attr('id');
			$('#theme_content_box_foot').css('background','url(themes/default/mini_loading.gif) no-repeat left');
			$.post('actions/fs_ajax_query.php', {action: 'm_curso', ultimo: ultimo}, function(resposta) {
				$('#theme_content_box_foot').css('background','');
				$('#theme_content_box_ajax').append(resposta);
				$('#theme_content_box_foot').hide();
			});
		});
		
    });
	function AjaxLoadExp(div,id)
	{
		$(document).ready(function(){	
			display = $(div+' ul').css('display');
			if(display == 'none')
			{
				$(div+' ul').show();
				$(div+' ul').html('<p style=\"'+style+'\">Carregando informações do curso...</p>');
				$(div+' ul').load('actions/fs_ajax_query.php', {action: 'curso_info', codigo: id}, function(){
					$(div+' li').fadeIn(600);
				});
			}
			else
			{
				$(div+' ul').slideUp(300);
			}
		});
	}	
    </script>
    <div id="theme_content_search">
    <form name="form_search" action="actions/fs_ajax_query.php" method="post">
    <input name="c_check" type="hidden" value="" />
    <fieldset id="theme_content_fieldset">
        <label><?php print $language["index_search_area"] ?> 	<select name="c_area"><?php print $opt_area ?></select></label>
        <label><?php print $language["index_search_periodo"] ?> <select name="c_periodo"><?php print $opt_per ?></select></label>
        <label><?php print $language["index_search_dia"] ?> 	<select name="c_dia"><?php print $opt_dia ?></select></label>
        <label><?php print $language["index_search_busca"] ?> 	<input name="c_busca" type="text" /></label>
        <label><input name="c_submit" type="submit" value="<?php print $language["index_search_pesquisar"] ?>" /></label>
    </fieldset>
    </form>
    </div>
    <div id="theme_content_box">
    <form name="form_ins" action="fs_form_ins.php" method="post">
    	<div id="theme_content_box_cab"><u>V Simpósio de Tecnologia - Lista de Cursos Disponíveis </u></div>
        <div id="theme_content_box_menu">
        <input id="but_ins" type="submit" value="Inscrever-se nos cursos selecionados" />
        <span></span>
        </div>
        <div id="theme_content_box_ajax">
			<?php print $div_cursos ?>
        </div>
        <div id="theme_content_box_foot">
            <a href="javascript:void(0)" id="mais">Todos Cursos »</a>
        </div>
    </form>
    </div>
