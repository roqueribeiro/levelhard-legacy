$(document).ready(function () {

    //Funções padrões jqxGrid
    $('.jqxgrid').jqxGrid({
        width: $('#main.default article section dl dt').width() + 16,
        theme: 'fresh',
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
            { name: 'nome', type: 'string' }
        ],
        id: 'id',
        url: 'pages/niveis.php?action=show'
    };

    var dataAdapter = new $.jqx.dataAdapter(source);

    $('#jqxUsers').jqxGrid({
        source: dataAdapter,
        columns: [
            { text: 'Codigo', hidden: true, datafield: 'codigo', width: 0 },
            { text: 'Nivel', datafield: 'nome', minwidth: 120 }
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