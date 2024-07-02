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
            { name: 'planta', type: 'string' },
            { name: 'planta_local', type: 'string' },
            { name: 'planta_host', type: 'string' },
            { name: 'usuario', type: 'string' },
            { name: 'rubrica', type: 'string' },
            { name: 'nivel', type: 'string' },
            { name: 'grupo', type: 'string' }
        ],
        id: 'id',
        url: 'pages/projetos.php?action=show'
    };

    var dataAdapter = new $.jqx.dataAdapter(source);

    $('#jqxUsers').jqxGrid({
        source: dataAdapter,
        columns: [
            { text: 'Usuario', datafield: 'usuario', width: 160 },
            { text: 'Abreviatura', datafield: 'rubrica', width: 80 },
            { text: 'Host', datafield: 'planta_host', width: 140 },
            { text: 'Planta', datafield: 'planta', width: 80 },
            { text: 'Nivel Hierárquico', datafield: 'nivel', filtertype: 'list', filteritems: ['grupo'], width: 120 },
            { text: 'Localização', datafield: 'planta_local', width: 180 },
            { text: 'Grupo/Setor', datafield: 'grupo', minwidth: 120 }
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