$(document).ready(function () {

    //Funções padrões jqxGrid
    $('.jqxgrid').jqxGrid({
        width: $('#main.default article section dl dt').width() + 16,
        theme: 'bootstrap',
        columnsresize: true,
        autoheight: true,
        sortable: true,
        groupable: true,
        filterable: true,
        showfilterrow: true,
        pageable: true,
        pagesize: 35,
        pagesizeoptions: ['35', '70', '140'],
    }).disableSelection();

    var source =
    {
        datatype: "json",
        datafields: [
            { name: 'usuario_cod', type: 'int' },
            { name: 'planta', type: 'string' },
            { name: 'planta_local', type: 'string' },
            { name: 'planta_host', type: 'string' },
            { name: 'usuario', type: 'string' },
            { name: 'rubrica', type: 'string' },
            { name: 'nivel', type: 'string' },
            { name: 'grupo', type: 'string' }
        ],
        id: 'id',
        url: 'pages/usuarios.php?action=show'
    };

    var dataAdapter = new $.jqx.dataAdapter(source);

    $('#jqxUsers').jqxGrid({
        source: dataAdapter,
        columns: [
            { text: 'Grupo/Setor', datafield: 'grupo', filtertype: 'list', width: 260 },
            { text: 'Host', datafield: 'planta_host', filtertype: 'list', width: 180 },
            { text: 'Usuario', datafield: 'usuario', width: 180 },
            { text: 'Nivel Hierárquico', datafield: 'nivel', filtertype: 'list', width: 180 },
            { text: 'Localização', datafield: 'planta_local', filtertype: 'list', minwidth: 180 },
        ]
    });

    $("#jqxUsers").bind('bindingcomplete', function () {
        var localizationobj = {};
            localizationobj.groupsheaderstring = "Arraste a coluna até aqui para agrupar",
            localizationobj.pagergotopagestring = "Pagina:";
            localizationobj.pagershowrowsstring = "Linhas:";
            localizationobj.pagerrangestring = " de ";
            localizationobj.pagernextbuttonstring = "Próximo";
            localizationobj.pagerpreviousbuttonstring = "Anterior";
            localizationobj.sortascendingstring = "Ascendente";
            localizationobj.sortdescendingstring = "Descendente";
            localizationobj.sortremovestring = "Remover Ordem";
            localizationobj.sortremovestring = "Remover Ordenamento",
            localizationobj.groupbystring = "Agrupar por esta coluna",
            localizationobj.groupremovestring = "Remover do Agrupamento"
        $("#jqxUsers").jqxGrid('localizestrings', localizationobj);
    });

    //Dimensiona jqxGrid ao tamanho atual da janela
    $(window).resize(function () {
        $('.jqxgrid').jqxGrid({ width: $('#main.default article section dl dt').width() });
    });

});