$(document).ready(function () {

    //Funções padrões jqxGrid
    $('.jqxgrid').jqxGrid({
        width: $('#main.default article section dl dt').width() + 16,
        theme: 'bootstrap',
        columnsresize: true,
        selectionmode: 'multiplerowsextended',
        autoheight: true,
        sortable: true
    }).disableSelection();

    var source =
    {
        datatype: "json",
        datafields: [
            { name: 'codigo', type: 'int' },
            { name: 'nome', type: 'string' },
            { name: 'abreviatura', type: 'string' },
            { name: 'localizacao', type: 'string' }
        ],
        id: 'id',
        url: 'pages/grupos.php?action=show'
    };

    var dataAdapter = new $.jqx.dataAdapter(source);

    $('#jqxUsers').jqxGrid({
        source: dataAdapter,
        columns: [
            { text: 'codigo', hidden: true, datafield: 'codigo', width: 0 },
            { text: 'Nome', datafield: 'nome', width: 200 },
            { text: 'Abreviatura', datafield: 'abreviatura', width: 140 },
            { text: 'Localização', datafield: 'localizacao', minwidth: 200 }
        ]
    });

    $("#jqxUsers").bind('bindingcomplete', function () {
        var localizationobj = {};
            localizationobj.sortascendingstring = "Ascendente";
            localizationobj.sortdescendingstring = "Descendente";
            localizationobj.sortremovestring = "Remover Ordenamento",
            $("#jqxUsers").jqxGrid('localizestrings', localizationobj);
    });

    //Dimensiona jqxGrid ao tamanho atual da janela
    $(window).resize(function () {
        $('.jqxgrid').jqxGrid({ width: $('#main.default article section dl dt').width() });
    });

});