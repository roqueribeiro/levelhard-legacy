﻿<!DOCTYPE html>
<html lang="en">
<head>
<title></title>
<style type="text/css" media="screen">
#editor { 
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
}
</style>
</head>
<body>

<div id="editor"></div>
    
<script src="http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/dreamweaver");
    editor.getSession().setMode("ace/mode/dreamweaver");
</script>
</body>
</html>