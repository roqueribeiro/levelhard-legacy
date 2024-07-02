<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Upload</title>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('input[type=file]').bind('change', function() {
			var fileSize = this.files[0].size/1024/1024;
			if (fileSize > 1024) {
				alert('O arquivo selecionado excede o limite de 1024Mb.');
				$('input[type=file]').val('');
			}else{
				$('form[name=upload]').submit();
			}
		});
		$('input[type=checkbox]').click(function(){					
			if($(this).prop('checked')) {
				$(this).parent().find('input[type=checkbox]').prop('checked', true);
			}
			else
			{
				$(this).parent().find('input[type=checkbox]').prop('checked', false);
			}
		});
		$('input[name=selectall]').click(function(){					
			if($(this).prop('checked')) {
				$('form[name=list]').find('input[type=checkbox]').prop('checked', true);
			}
			else
			{
				$('form[name=list]').find('input[type=checkbox]').prop('checked', false);
			}
		});
	});
	</script>
	<style>
	* {
		outline: none;
	}
	body {
		font-family: Verdana;
		font-size: 12px;
		background: #F5F5F5;
	}
	ol {
		list-style: none;
		padding: 0;
		margin: 0;
	}
	li {
		padding: 0;
		margin: 10px 25px;
	}
	a {
		text-decoration: none;
		color: #4286f4;
	}
	input[type=file]{
		position: relative;
		width: 128px;
		height: 64px;
		background: none;
		border: none;
		margin: 25px;
	}
	input[type=file]:before{
		position: absolute;
		content: '';
		background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGhlaWdodD0iODVweCIgaWQ9IkNhcGFfMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTAwIDg1OyIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgMTAwIDg1IiB3aWR0aD0iMTAwcHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxnPjxwYXRoIGQ9Ik01MC4wMDEsMGwtMjYsMjQuMzk4aDE2LjVWNTBoMTlWMjQuMzk4aDE2LjVMNTAuMDAxLDB6IE05Ni42OTgsNTcuNzExTDgwLjc4LDQ3aC05LjgxNmwxNy4wMDIsMTMuMDQzSDcwLjI0MyAgIGMtMC41MDgsMC0wLjk2OSwwLjI1OC0xLjE5NywwLjY2NEw2NC45Niw3MS44ODNIMzUuMDM4bC00LjA4Ni0xMS4xNzZjLTAuMjI3LTAuNDA2LTAuNjg5LTAuNjY0LTEuMTk3LTAuNjY0SDEyLjAzMkwyOS4wMzYsNDcgICBoLTkuODE4TDMuMzAyLDU3LjcxMWMtMi4zNjksMS40MTUtMy43ODUsNC42NzYtMy4xNSw3LjI0NmwyLjgwNywxNS4zNjlDMy41OTUsODIuODk2LDYuNDExLDg1LDkuMjE2LDg1aDgxLjU2OCAgIGMyLjgwNSwwLDUuNjIxLTIuMTA0LDYuMjU4LTQuNjc0bDIuODA1LTE1LjM2OUMxMDAuNDg1LDYyLjM4Nyw5OS4wNjcsNTkuMTI2LDk2LjY5OCw1Ny43MTF6Ii8+PC9nPjxnLz48Zy8+PGcvPjxnLz48Zy8+PGcvPjxnLz48Zy8+PGcvPjxnLz48Zy8+PGcvPjxnLz48Zy8+PGcvPjwvc3ZnPg==');
		background-color: #EEE;
		background-repeat: no-repeat;
		background-position: center;
		background-size: 36%;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		border: 1px #CCC solid;
		z-index: 1;
	}
	input[type=submit]{
		background: none;
		border: none;
		color: #4286f4;
		cursor: pointer;
	}
	input[type=checkbox]{
		position: relative;
		float: left;
		padding: 0;
		margin: 0 10px 0 0;
		top: 2px;
	}
	form[name=list]{
		padding: 25px;
	}
	.folder {
		position: relative;
		width: 16px;
		height: 15px;
		background: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGhlaWdodD0iNjAuMDAxcHgiIGlkPSJMYXllcl8xIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2NCA2MC4wMDE7IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA2NCA2MC4wMDEiIHdpZHRoPSI2NHB4IiB4bWw6c3BhY2U9InByZXNlcnZlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48ZyBpZD0iRm9sZGVyIj48Zz48cGF0aCBkPSJNNjAsNC4wMDFIMjRDMjQsMS43OTIsMjIuMjA5LDAsMjAsMEg0ICAgIEMxLjc5MSwwLDAsMS43OTIsMCw0LjAwMVY4djYuMDAxdjJjMCwyLjIwOSwxLjc5MSw0LDQsNGg1NmMyLjIwOSwwLDQtMS43OTEsNC00VjhDNjQsNS43OTEsNjIuMjA5LDQuMDAxLDYwLDQuMDAxeiIgc3R5bGU9ImZpbGwtcnVsZTpldmVub2RkO2NsaXAtcnVsZTpldmVub2RkO2ZpbGw6I0NDQTM1MjsiLz48L2c+PC9nPjxnIGlkPSJGaWxlXzFfIj48Zz48cGF0aCBkPSJNNTYsOEg4Yy0yLjIwOSwwLTQsMS43OTEtNCw0LjAwMXY0YzAsMi4yMDksMS43OTEsNCw0LDRoNDhjMi4yMDksMCw0LTEuNzkxLDQtNHYtNCAgICBDNjAsOS43OTEsNTguMjA5LDgsNTYsOHoiIHN0eWxlPSJmaWxsOiNGRkZGRkY7Ii8+PC9nPjwvZz48ZyBpZD0iRm9sZGVyXzFfIj48Zz48cGF0aCBkPSJNNjAsMTIuMDAxSDRjLTIuMjA5LDAtNCwxLjc5MS00LDR2NDBjMCwyLjIwOSwxLjc5MSw0LDQsNGg1NmMyLjIwOSwwLDQtMS43OTEsNC00di00MCAgICBDNjQsMTMuNzkyLDYyLjIwOSwxMi4wMDEsNjAsMTIuMDAxeiIgc3R5bGU9ImZpbGw6I0ZGQ0M2NjsiLz48L2c+PC9nPjxnLz48Zy8+PGcvPjxnLz48Zy8+PGcvPjxnLz48Zy8+PGcvPjxnLz48Zy8+PGcvPjxnLz48Zy8+PGcvPjwvc3ZnPg==');
		background-size: 100%;
		float: left;
		margin-right: 10px;
	}
	.file {
		position: relative;
		width: 16px;
		height: 15px;
		background: url('data:image/png;base64,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');
		background-size: 100%;
		float: left;
		margin-right: 10px;
	}
	</style>
</head>
<body>

  <div>
    <form method="POST" name="upload" enctype="multipart/form-data">
      <input type="file" name="files[]" id="files[]" multiple="multiple" />
    </form>
    <?php
		error_reporting(0);
		ini_set('post_max_size', '1024M');
		ini_set('upload_max_filesize', '1024M');
		ini_set('max_execution_time', '600000');
	
		$directory = 'gallery/';
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$files = $_FILES['files'];	
			for($i = 0, $c = count($files); $i <= $c; ++ $i) {
				$upload = move_uploaded_file($files['tmp_name'][$i], $directory . $files['name'][$i]);				
				$zip = new ZipArchive;
				if ($zip->open($directory . $files['name'][$i]) === TRUE) {
					$zip->extractTo($directory);
					$zip->close();
					//echo 'ok';
				} else {
					//echo 'Erro ao descompactar o arquivo.';
				}
			}
		}
		
		if($_POST['files']){
			foreach (array_reverse($_POST['files']) as $fileInfo) {
				if(unlink($fileInfo) != 1) rmdir($fileInfo);
			}
		}
		
		echo '<form name="list" method="POST">';
		echo '<input type="checkbox" name="selectall" />';
		echo '<input type="submit" value="Apagar Selecionados" />';
		$files = scandir($directory);
		function listFolderFiles($dir)
		{
			echo '<ol>';
			foreach (new DirectoryIterator($dir) as $fileInfo) {
				if (!$fileInfo->isDot()) {
					if ($fileInfo->isDir()) {
						echo '<li><div class="folder"></div><input type="checkbox" name="files[]" value="' . $fileInfo->getPathname() . '" />' . $fileInfo->getFilename();
						listFolderFiles($fileInfo->getPathname());
					}
					else
					{
						echo '<li><div class="file"></div><input type="checkbox" name="files[]" value="' . $fileInfo->getPathname() . '" /><a href="'.$fileInfo->getPathname().'">' . $fileInfo->getFilename() . '</a>';
					}
					echo '</li>';
				}
			}
			echo '</ol>';
		}
		listFolderFiles($directory);
		echo '</form>';
		
    ?>
  </div>
</body>
</html>