<?php
	require "../core.php";
	$news = new Principal;
?>
<script type="text/javascript">ActFancyBox();</script>
<div id="content_box_text">
<?php
	$news->ShowPrinc();
?>
</div>