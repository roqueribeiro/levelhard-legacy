$(document).ready(function () {

	//Funções padrões jqxGrid
	$('.jqxgrid').jqxGrid({
		width: $('#main.default article section dl dt').width() + 16,
		theme: 'bootstrap',
		columnsresize: true,
		autoheight: true,
		sortable: true,
		editable: true,
		editmode: 'dblclick'
	}).disableSelection();

	var source =
	{
		datatype: "json",
		datafields: [
			{ name: 'reuniao_cod', type: 'int' },
			{ name: 'grupo', type: 'string' },
			{ name: 'data', type: 'string' },
			{ name: 'hora', type: 'string' },
			{ name: 'sala', type: 'string' },
			{ name: 'observacao', type: 'string' }
		],
		id: 'id',
		url: 'pages/apresentacoes.php?action=show'
	};

	var dataAdapter = new $.jqx.dataAdapter(source);

	$('#jqxUsers').jqxGrid({
		source: dataAdapter,
		columns: [
			{ text: 'Grupo/Setor', datafield: 'grupo', width: 280 },
			{ text: 'Data', datafield: 'data', cellsformat: 'dd/MM/yyyy', columntype: 'datetimeinput', width: 140 },
			{ text: 'Hora', datafield: 'hora', cellsformat: 'HH:mm:ss', columntype: 'datetimeinput', width: 140 },
			{ text: 'Sala', datafield: 'sala', width: 200 },
			{ text: 'Observações', datafield: 'observacao', minwidth: 100 }
		]
	}).bind('bindingcomplete', function () {
		var localizationobj = {};
			localizationobj.sortascendingstring = "Ascendente";
			localizationobj.sortdescendingstring = "Descendente";
			localizationobj.sortremovestring = "Remover Ordenamento",
			$("#jqxUsers").jqxGrid('localizestrings', localizationobj);
	}).jqxGrid('selectrow', 0);

	$('#act-presentation').click(function () {
		var value = $('#jqxUsers').jqxGrid('getcellvalue', $(".jqxgrid").jqxGrid('getselectedrowindex'), 'reuniao_cod');
		if (value) {
			$.fancybox.open({
				href: 'pages/slides.php?reuniao=' + value,
				type: 'iframe',
				width: '100%',
				height: '100%',
				scrolling: 'no',
				padding: 0,
				helpers: {
					overlay: {
						closeClick: false
					}
				},
			});
		}
	});

	$('#act-activities').click(function () {
		var value = $('#jqxUsers').jqxGrid('getcellvalue', $("#jqxUsers").jqxGrid('getselectedrowindex'), 'reuniao_cod');
		if (value) {
			$.fancybox.open({
				href: 'pages/atividades.php?action=form&reuniao_cod=' + value,
				type: 'ajax',
				padding: 5,
				scrolling: 'no',
				helpers: {
					overlay: {
						closeClick: false
					}
				},
				beforeShow: function () {
					$('.fancybox-skin').draggable({
						handle: '.window-title',
						helper: 'original',
						containment: '.fancybox-overlay',
						scroll: false,
						iframeFix: true,
					});
				}
			});
		}
	});

	$('#add-presentation').click(function () {
		$.fancybox.open({
			href: 'pages/apresentacoes.php?action=form',
			type: 'ajax',
			padding: 5,
			scrolling: 'no',
			helpers: {
				overlay: {
					closeClick: false
				}
			},
			beforeShow: function () {
				$('.fancybox-skin').draggable({
					handle: '.window-title',
					helper: 'original',
					containment: '.fancybox-overlay',
					scroll: false,
					iframeFix: true,
				});
			}
		});
	});

	$('#delete-presentation').click(function () {
		var value = $('#jqxUsers').jqxGrid('getcellvalue', $("#jqxUsers").jqxGrid('getselectedrowindex'), 'reuniao_cod');
		if (value) {
			$.ajax({
				type: 'GET',
				url: 'pages/apresentacoes.php?action=delete&reuniao_cod=' + value,
				success: function (data) {
					$('.notification').jnotifyAddMessage({
						text: 'Reunião Removida!',
						type: 'success',
						permanent: false
					});
					$('#jqxUsers').jqxGrid('updatebounddata', 'cells');
				},
				error: function (data) {
					$('.notification').jnotifyAddMessage({
						text: 'Erro ao Remover a Reunião!',
						type: 'error',
						permanent: false
					});
				}
			});
		}
	});

	//Dimensiona jqxGrid ao tamanho atual da janela
	$(window).resize(function () {
		$('.jqxgrid').jqxGrid({ width: $('#main.default article section dl dt').width() });
	});

});