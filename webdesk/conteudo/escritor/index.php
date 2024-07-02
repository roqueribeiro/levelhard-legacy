<?php

	$usuario	= $_GET["usuario"];
	$texto 		= $_GET["texto"];
	$n_texto 	= $_GET["n_texto"];
			
	if($texto)
	{
		$ponteiro = fopen($texto,"r+");
		
		while (!feof($ponteiro)) 
		{
		  $linha .= fgets($ponteiro,4096);
		}
		
		fclose ($ponteiro);
		
	}
	
	if($n_texto)
	{
		if(!$texto)
		{
			$texto = '../diretorio/upload/'.$usuario.'/texto.wtxt';
		}
		
		$ponteiro = fopen($texto,"w+");
				
		fwrite($ponteiro,$n_texto);
		fclose($ponteiro);
		
		$linha = $n_texto;
		
	}
	
?>
<script type="text/javascript" src="../../scripts/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

		oninit : function() {
			tinyMCE.get('tinymce').execCommand('mceFullScreen');
		}
});
</script>

<form method="get">
	<input type="hidden" name="usuario" value="<?php print $usuario; ?>" />
    <textarea name="n_texto" id="tinymce">
		<?php print $linha; ?>
    </textarea>
</form>