<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>TorrentProject</title>
<script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery-table.js"></script>
<script type="text/javascript" src="fancybox/jquery-mousewheel-3.0.2.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery-fancybox-1.3.1.js"></script>
<script type="text/javascript"> 
$(document).ready(function() {	
	$("a[rel=gallery_group]").fancybox({
		'padding'			: 1,
		'transitionIn'		: 'elastic',
		'transitionOut'		: 'fade',
		'overlayOpacity'	: '0.8',
		'overlayColor'		: '#333'
	});
	$("a#webfiles").fancybox({
		'padding'			: 1,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'width'				: '90%',
		'height'			: '90%',
		'overlayOpacity'	: '0.8',
		'overlayColor'		: '#333',
		'type'				: 'iframe'
	});
});
</script>
<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="fancybox/jquery-fancybox-1.3.1.css" media="screen" />
</head>
<body>
<?php

	$dir_padrao = "download";
	$dir_atual 	= $_GET["dir"];
	
	function ver_pasta($pasta) 
	{
		$extensao = array_reverse(explode("/",$pasta));
		return $extensao[0];
	}
	$pasta = ver_pasta($dir_atual);
	$pasta_len1 = strlen($dir_atual); 
	$pasta_len2 = strlen($pasta); 
	$pasta_len = (($pasta_len1 - $pasta_len2) - 1);
	$pasta_anterior = substr($dir_atual, 0, $pasta_len);

	if(!$dir_atual)
	{
		$dir_atual = $dir_padrao;
	}
	else
	{
		$dir_padrao = $dir_atual;
	}

	if($dir_atual == "download")
	{
		$dir_back = "";
	}
	else
	{
		$dir_back = "
		<tr bgcolor='#FFFFFF'>
			<td align='center'>
			<img src='images/6148_16x16.png' />
			</td>
			<td>
			<a href='index.php?dir=$pasta_anterior'>Voltar</a>
			</td>
			<td>
			</td>
		</tr>
		";
	}

?>
<div id="theme_container">
	<div id="tablewrapper">
		<div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Total de Itens: <span id="totalrecords"></span></div>
        	</span>
        </div>
		
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
                <tr>
                    <th width="40px" class="nosort"><h3>Tipo</h3></th>
                    <th width="640px" class="nosort"><h3>Nome</h3></th>
                    <th class="nosort"><h3>Tamanho</h3></th>
                </tr>
				<?php print $dir_back; ?>
            </thead>
				
            <tbody>
			<?php
                        
            chdir($dir_atual);
            $diretorio = getcwd();
            $ponteiro  = opendir($diretorio);
                        
            while ($nome_itens = readdir($ponteiro))
            {
                $itens[] = $nome_itens;
            }
             
            sort($itens);
            foreach ($itens as $listar) 
            {
                if ($listar!="." && $listar!="..")
                { 
                    if (is_dir($listar)) 
                    { 
                        $pastas[]=$listar; 		
                    } 
                    else
                    {
                        $arquivos[]=$listar;		
                    }   
                }
            }
            
            if ($pastas != "" ) 
            { 
                foreach($pastas as $listar)
                {   
                    print "
					<tr>
						<td align='center'>
						<img src='images/3783_16x16.png' />
						</td>
						<td>
						<a href='index.php?dir=$dir_padrao/$listar'>$listar</a>
						</td>
						<td>
						</td>
					</tr>
					";
                }   
            }
            function ver_extensao($arquivo) 
            {
                $extensao = array_reverse(explode(".",$arquivo));
                return $extensao[0];
            }
            if ($arquivos != "") 
            {
                foreach($arquivos as $listar)
                {   
                    $test = strtolower(ver_extensao($listar));
                    
                    switch ($test) 
                    {
                        case ($test == "html" || $test == "htm" || $test == "php"):
                            $icon = "images/2221_16x16.png";
                            break;
                        case ($test == "zip" || $test == "rar" || $test == "cab"):
                            $icon = "images/664_16x16.png";
                            break;
                        case ($test == "xls" || $test == "xlsx" || $test == "csv"):
                            $icon = "images/4506_16x16.png";
                            break;
                        case ($test == "doc" || $test == "docx" || $test == "rtf"):
                            $icon = "images/4662_16x16.png";
                            break;
                        case ($test == "txt" || $test == "lis"):
                            $icon = "images/1110_16x16.png";
                            break;
                        case ($test == "exe" || $test == "bat"):
                            $icon = "images/6257_16x16.png";
                            break;
                        case ($test == "dll" || $test == "ini" || $test == "sys" || $test == "bin"):
                            $icon = "images/1034_16x16.png";
                            break;
						case ($test == "jpg" || $test == "jpeg" || $test == "bmp" || $test == "png" || $test == "gif"):
                            $icon = "images/8388_16x16.png";
                            break;
						case ($test == "mp3"):
                            $icon = "images/297_16x16.png";
                            break;
                        case ($test == "torrent"):
                            $icon = "images/726_16x16.png";
                            break;
                        default:
                            $icon = "images/8305_16x16.png";
                            break;
                    }		
					
					$file_size = filesize($listar);
					
					if($file_size > 1048576)
					{
						$file_sizeShow = round($file_size/1048576,2)." Mb";
					}
					else
					{
						$file_sizeShow = round($file_size/1024,2)." Kb";
					}
					
					if($icon == "images/8388_16x16.png" || $icon == "images/1110_16x16.png")
					{					
						$lista_arq = "
						<tr>
							<td align='center'>
							<img src='$icon' />
							</td>
							<td>
							<a id='gallery' rel='gallery_group' href='$dir_padrao/$listar'>$listar</a>
							</td>
							<td>
							$file_sizeShow
							</td>
						</tr>
						";
					}
					elseif($icon == "images/2221_16x16.png")
					{					
						$lista_arq = "
						<tr>
							<td align='center'>
							<img src='$icon' />
							</td>
							<td>
							<a id='webfiles' href='$dir_padrao/$listar'>$listar</a>
							</td>
							<td>
							$file_sizeShow
							</td>
						</tr>
						";
					}
					else
					{
						$lista_arq = "
						<tr>
							<td align='center'>
							<img src='$icon' />
							</td>
							<td>
							<a href='$dir_padrao/$listar'>$listar</a>
							</td>
							<td>
							$file_sizeShow
							</td>
						</tr>
						";
					}
					print $lista_arq;
                }
            }
			if($pastas == "" and $arquivos == "")
			{
				print "
				<tr>
					<td align='center'>
					<img src='images/5917_16x16.png' />
					</td>
					<td>
					Nada Encontrado
					</td>
					<td>
					</td>
				</tr>
				";
			}
            ?>
            </tbody>
        </table>
        <div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
            </div>
			<div id="tablelocation">
                <div class="page">Pagina <span id="currentpage"></span> de <span id="totalpages"></span></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var sorter = new TINY.table.sorter('sorter','table',{
	headclass:'head',
	ascclass:'asc',
	descclass:'desc',
	evenclass:'evenrow',
	oddclass:'oddrow',
	evenselclass:'evenselected',
	oddselclass:'oddselected',
	paginate:true,
	size:8,
	colddid:'columns',
	currentid:'currentpage',
	totalid:'totalpages',
	totalrecid:'totalrecords',
	hoverid:'selectedrow',
	pageddid:'pagedropdown',
	navid:'tablenav',
	sortcolumn:1,
	init:true
});
</script>
</body>
</html>