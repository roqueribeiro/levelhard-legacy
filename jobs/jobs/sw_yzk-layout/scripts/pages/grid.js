$(document).ready(function () {

    collapseGrid();

    //Funções padrões jqxGrid
    $('.jqxgrid').jqxGrid({
        width: $('#main.default article section dl dt').width() + 16,
        theme: 'metro',
        columnsresize: true,
        showfilterrow: true,
        filterable: true,
        selectionmode: 'multiplerowsextended',
        pageable: true,
        autoheight: true,
        editable: true,
        editmode: 'dblclick'
    }).disableSelection();

    //1# Carrega Informações e Monta jqxGrid
    var sourceFirst =
    {
        datatype: "json",
        datafields: [
            { name: 'name', type: 'string' },
            { name: 'type', type: 'string' },
            { name: 'calories', type: 'int' },
            { name: 'totalfat', type: 'string' },
            { name: 'protein', type: 'string' }
        ],
        id: 'id',
        url: 'scripts/pages/grid.json'
    };
    var dataAdapterFirst = new $.jqx.dataAdapter(sourceFirst);
    $('#jqxFirst').jqxGrid({
        source: dataAdapterFirst,
        columns: [
            { text: 'Name', datafield: 'name', width: 250 },
            { text: 'Beverage Type', datafield: 'type', width: 250 },
            { text: 'Calories', datafield: 'calories', width: 180 },
            { text: 'Total Fat', datafield: 'totalfat', width: 120 },
            { text: 'Protein', datafield: 'protein', minwidth: 120 }
        ]
    });

    //2# Carrega Informações e Monta jqxGrid
    var sourceSecond =
    {
        datatype: "json",
        datafields: [
            { name: 'name', type: 'string' },
            { name: 'type', type: 'string' },
            { name: 'calories', type: 'int' },
            { name: 'totalfat', type: 'string' },
            { name: 'protein', type: 'string' }
        ],
        id: 'id',
        url: 'scripts/pages/grid.json'
    };
    var dataAdapterSecond = new $.jqx.dataAdapter(sourceSecond);
    $('#jqxSecond').jqxGrid({
        source: dataAdapterSecond,
        columns: [
            { text: 'Name', datafield: 'name', width: 250 },
            { text: 'Beverage Type', datafield: 'type', width: 250 },
            { text: 'Calories', datafield: 'calories', width: 180 },
            { text: 'Total Fat', datafield: 'totalfat', width: 120 },
            { text: 'Protein', datafield: 'protein', minwidth: 120 }
        ]
    });

    //3# Carrega Informações e Monta jqxGrid
    var sourceThird =
    {
        datatype: "json",
        datafields: [
            { name: 'name', type: 'string' },
            { name: 'type', type: 'string' },
            { name: 'calories', type: 'int' },
            { name: 'totalfat', type: 'string' },
            { name: 'protein', type: 'string' }
        ],
        id: 'id',
        url: 'scripts/pages/grid.json'
    };
    var dataAdapterThird = new $.jqx.dataAdapter(sourceThird);
    $('#jqxThird').jqxGrid({
        source: dataAdapterThird,
        columns: [
            { text: 'Name', datafield: 'name', width: 250 },
            { text: 'Beverage Type', datafield: 'type', width: 250 },
            { text: 'Calories', datafield: 'calories', width: 180 },
            { text: 'Total Fat', datafield: 'totalfat', width: 120 },
            { text: 'Protein', datafield: 'protein', minwidth: 120 }
        ]
    });

    //4# Carrega Informações e Monta jqxGrid
    var sourceFourth =
    {
        datatype: "json",
        datafields: [
            { name: 'name', type: 'string' },
            { name: 'type', type: 'string' },
            { name: 'calories', type: 'int' },
            { name: 'totalfat', type: 'string' },
            { name: 'protein', type: 'string' }
        ],
        id: 'id',
        url: 'scripts/pages/grid.json'
    };
    var dataAdapterFourth = new $.jqx.dataAdapter(sourceFourth);
    $('#jqxFourth').jqxGrid({
        source: dataAdapterFourth,
        columns: [
            { text: 'Name', datafield: 'name', width: 250 },
            { text: 'Beverage Type', datafield: 'type', width: 250 },
            { text: 'Calories', datafield: 'calories', width: 180 },
            { text: 'Total Fat', datafield: 'totalfat', width: 120 },
            { text: 'Protein', datafield: 'protein', minwidth: 120 }
        ]
    });

    //5# Carrega Informações e Monta jqxGrid
    var sourceFifth =
    {
        datatype: "json",
        datafields: [
            { name: 'name', type: 'string' },
            { name: 'type', type: 'string' },
            { name: 'calories', type: 'int' },
            { name: 'totalfat', type: 'string' },
            { name: 'protein', type: 'string' }
        ],
        id: 'id',
        url: 'scripts/pages/grid.json'
    };
    var dataAdapterFifth = new $.jqx.dataAdapter(sourceFifth);
    $('#jqxFifth').jqxGrid({
        source: dataAdapterFifth,
        columns: [
            { text: 'Name', datafield: 'name', width: 250 },
            { text: 'Beverage Type', datafield: 'type', width: 250 },
            { text: 'Calories', datafield: 'calories', width: 180 },
            { text: 'Total Fat', datafield: 'totalfat', width: 120 },
            { text: 'Protein', datafield: 'protein', minwidth: 120 }
        ]
    });

    //6# Carrega Informações e Monta jqxGrid
    var sourceSixth =
    {
        datatype: "json",
        datafields: [
            { name: 'name', type: 'string' },
            { name: 'type', type: 'string' },
            { name: 'calories', type: 'int' },
            { name: 'totalfat', type: 'string' },
            { name: 'protein', type: 'string' }
        ],
        id: 'id',
        url: 'scripts/pages/grid.json'
    };
    var dataAdapterSixth = new $.jqx.dataAdapter(sourceSixth);
    $('#jqxSixth').jqxGrid({
        source: dataAdapterSixth,
        columns: [
            { text: 'Name', datafield: 'name', width: 250 },
            { text: 'Beverage Type', datafield: 'type', width: 250 },
            { text: 'Calories', datafield: 'calories', width: 180 },
            { text: 'Total Fat', datafield: 'totalfat', width: 120 },
            { text: 'Protein', datafield: 'protein', minwidth: 120 }
        ]
    });

    //Dimensiona jqxGrid ao tamanho atual da janela
    $(window).resize(function () {
        $('.jqxgrid').jqxGrid({ width: $('#main.default article section dl dt').width() });
    });

});