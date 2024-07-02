$(document).ready(function () {
    //Aplica o collapseGrid
    collapseGrid();
    //Desativa Seleção
    $('#main.default article.home').disableSelection();
    //Ativa Sortable
    $('#main.default article.home ul').sortable({
        placeholder: 'ui-state-highlight',
        containment: 'parent',
        opacity: '0.5',
        beforeStop: function (e, ui) {
            ui.item.hide().fadeIn(600);
        }
    });
});