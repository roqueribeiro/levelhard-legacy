function activeLanguage(language) {

    //Carrega XML com linguagens
    if (!language) {

        //Pega a Linguagem do Navegador
        navLanguage = window.navigator.userLanguage || window.navigator.language;
        switch (navLanguage.substring(0, 2)) {
            case 'pt':
                activeLanguage('portuguese');
                break;
            case 'es':
                activeLanguage('spanish');
                break;
            case 'en':
                activeLanguage('english');
                break;
            default:
                activeLanguage('english');
                break;
        }

    } else {
        //Carrega XML com linguagens
        $.ajax({
            url: 'default-languages.xml',
            success: function (xml) {
                $(xml).find('translation').each(function () {
                    var id = $(this).attr('id');
                    var text = $(this).find(language).text();
                    $("#" + id).html(text);
                });
                //Marca o icone com a linguagem em uso
                $('header.default div.language img#' + language).css('opacity', '1');
                $('header.default div.language img').not('#' + language).css('opacity', '0.2');
            }
        });
    }

}
function accessUrl(url) {
    //Executa Transição de Pagina
    $('.wrapper, .preloader').show();
    $.get(url, function (data) {
        $('#main.default').html(data);
        //Define botão Recarregar do Rodapé
        $('#recarregar').parents('a').attr('href', 'javascript:accessUrl("' + url + '")');
        //Ativa FancyBox
        $(".fancybox-button").fancybox({ type: 'iframe', padding: 0, margin: 50 });
        //Ativa NiceScroll
        $('#main.default article').niceScroll({
            cursorwidth: '10px',
            cursorborderradius: '0px',
            cursorborder: 'none'
        });
        $('.wrapper, .preloader').hide('puff');
        activeLanguage();
    });
}
function collapseGrid() {
    //Conteudo Abrir e Fechar
    $('#main.default article section dl dt').click(function () {
        $('.wrapper-content').show();
        $(this).next('dd').toggle('blind', { direction: 'up' }, function () {
            $('.wrapper-content').hide('puff');
            $('#main.default article').getNiceScroll().resize();
            if ($(this).css('display') == 'block') {
                $('img.list-arrow', $(this).prev()).attr('src', 'images/icons/black/arrow_up_12x12.png');
            } else {
                $('img.list-arrow', $(this).prev()).attr('src', 'images/icons/black/arrow_down_12x12.png');
            }
        });
    });
}
$(document).ready(function () {

    //Menu DropDown
    $('header.default nav li').hover(function () {
        $('ul:first', this).show();
    }, function () {
        $('ul', this).hide('blind', 200);
    });

    //Expandir Conteudo
    $('#fit-height').click(function () {
        if ($('#main.default').css('top') == '135px') {
            $('.wrapper, .preloader').show();
            $('header.default').animate({ 'top': '-170px', 'opacity': '0' });
            $('#main.default').animate({ 'top': '-35px' }, function () {
                $('.wrapper, .preloader').hide('puff');
                $('#main.default article').getNiceScroll().resize();
            });
        } else {
            $('.wrapper, .preloader').show();
            $('header.default').animate({ 'top': '0px', 'opacity': '1' });
            $('#main.default').animate({ 'top': '135px' }, function () {
                $('.wrapper, .preloader').hide('puff');
                $('#main.default article').getNiceScroll().resize();
            });
        }
    });

    //Define Pagina Inicial
    accessUrl('form.html');

});