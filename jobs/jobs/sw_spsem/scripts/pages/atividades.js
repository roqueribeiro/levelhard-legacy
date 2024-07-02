$(document).ready(function () {

	$('#jqxTabs').jqxTabs({
		width: 785,
		height: 585,
		position: 'top',
		theme: 'fresh',
		animationType: 'fade',
		selectionTracker: true
	});

	$('#jqxTabs').on('selected', function (event) {
		var pageIndex = event.args.item;
		if (pageIndex == 1) {
			$('#jqxTabs #content_view iframe').attr('src', 'pages/slides.php?reuniao=' + $('input[name=reuniao_cod]').val() + '&preview=1');
		} else {
			$('#jqxTabs #content_view iframe').attr('src', 'about:blank');
		}
	});

	$('#jqxButton').jqxButton({ width: '150', theme: 'web' });

	tinymce.init({
		selector: 'textarea',
		language: 'pt_BR',
		plugins: [
			'advlist autolink lists link image charmap print hr anchor',
			'searchreplace code media table contextmenu paste'
		],
		toolbar: 'undo redo | forecolor backcolor bold italic | bullist numlist outdent indent | link image media | code searchreplace',
		menubar: false,
		statusbar: false,
		height: 150
	});

	$('form[name=atividades]').ajaxForm({
		beforeSubmit: function () {
			$('form[name=atividades] input').attr('disabled', 'disabled');
		},
		success: function (data) {
			if (data == 1) {
				$('.notification').jnotifyAddMessage({
					text: 'Suas atividades foram salvas!',
					type: 'success',
					permanent: false
				});
				$('input[name=action]').val('edit');
			} else {
				$('.notification').jnotifyAddMessage({
					text: 'Ocorreu um erro ao salvar!',
					type: 'error',
					permanent: false
				});
			}
			$('form[name=atividades] input').removeAttr('disabled');
		}
	});

});