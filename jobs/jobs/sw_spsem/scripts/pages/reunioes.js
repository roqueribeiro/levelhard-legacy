$(document).ready(function () {

	$('#jqxTabs').jqxTabs({
		width: 400,
		height: 555,
		position: 'top',
		theme: 'fresh',
		animationType: 'fade',
		selectionTracker: true
	});

	var salas = [
		'1',
		'2',
		'3',
		'4',
		'5',
		'6',
		'7',
		'8'
	];

	$('#jqxData').jqxDateTimeInput({ width: '250px', height: '25px', formatString: 'yyyy-MM-dd', theme: 'web' });
	$('#jqxHora').jqxDateTimeInput({ width: '250px', height: '25px', formatString: 'HH:mm:ss', value: new Date(2013, 6, 5, 08, 00, 00, 00), showCalendarButton: false, theme: 'web' });
	$('#jqxSala').jqxDropDownList({ source: salas, selectedIndex: 0, width: '250', height: '25px', dropDownHeight: 200, theme: 'web' });
	$('#jqxButton').jqxButton({ width: '150', theme: 'web' });
	$("#jqxAppoint").jqxCheckBox({ width: 120, height: 25, checked: true, theme: 'web' });

	tinymce.init({
		selector: 'textarea',
		language: 'pt_BR',
		plugins: ['contextmenu', 'link'],
		toolbar: 'undo redo | bold italic | link',
		menubar: false,
		statusbar: false,
		height: 100
	});

	$('form[name=reunioes]').ajaxForm({
		beforeSubmit: function () {
		},
		success: function (data) {
			if (data == 1) {
				$('.notification').jnotifyAddMessage({
					text: 'A reunião foi marcada!',
					type: 'success',
					permanent: false
				});
				if ($('input[name=jqxAppoint]').val() == 'true') {
					$.ajax({
						type: 'POST',
						url: 'common/createappointment.php',
						data: {
							datestart: $('input[name=jqxData]').val(),
							dateend: $('input[name=jqxData]').val(),
							timestart: $('input[name=jqxHora]').val(),
							timeend: $('input[name=jqxHora]').val(),
							local: $('input[name=jqxSala]').val(),
							to: 'roque.ribeiro@hotmail.com.br',
						},
						success: function (data) {
							$('.notification').jnotifyAddMessage({
								text: 'O Appointment foi enviado!',
								type: 'success',
								permanent: false
							});
						},
						error: function (data) {
							$('.notification').jnotifyAddMessage({
								text: 'Ocorreu um erro ao criar o Appointment!',
								type: 'error',
								permanent: false
							});
						}
					});
				}
				$('#jqxUsers').jqxGrid('updatebounddata', 'cells');
			} else {
				$('.notification').jnotifyAddMessage({
					text: 'Ocorreu um erro ao salvar!',
					type: 'error',
					permanent: false
				});
			}
		}
	});

});
