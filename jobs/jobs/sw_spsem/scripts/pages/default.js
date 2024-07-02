function activeLanguage(lang) {
    //Carrega XML com linguagens
    if (!lang) {
        //Pega a Linguagem do Navegador
        navLanguage = window.navigator.userLanguage || window.navigator.language;
        activeLanguage(navLanguage);
    } else {
        //Carrega XML com linguagens
        $.ajax({
            type: 'GET',
            url: 'languages/' + lang + '.xml',
            dataType: 'xml',
            success: function (xml) {
                //Aplica a linguagem utilizada	
                $(xml).find('translation').each(function () {
                    var id = $(this).attr('id');
                    var text = $(this).text();
                    $("#" + id).text(text);
                });
                //Marca o icone com a linguagem em uso
                $('header.default div.language img#' + lang).animate({ 'opacity': '1' }, 300);
                $('header.default div.language img').not('#' + lang).animate({ 'opacity': '0.2' }, 300);
            },
            error: function () {
                $('.notification').jnotifyAddMessage({
                    text: 'Ocorreu um erro ao carregar biblioteca de linguagens!',
                    type: 'error',
                    permanent: true
                });
            }
        });
    }
}
function accessUrl(url) {
    //Verifica URL
    var ini = 'home';
    var rld = document.location.href;
    var url = (url) ? url.split('#') : rld.split('#');
    var url = (url[1]) ? url[1] : ini;
    //Executa Transição de Pagina
    $('.wrapper, .preloader').show();
    //Carrega Informações Acionadas
    $.get('pages/' + url + '.php?action=screen', function (data) {
        $('.preloader').hide('puff');
        $('#main.default').html(data);
        //Efeitos
        $('#main.default nav ul').hide().show('drop', { direction: 'right', easing: 'easeOutCirc' }, 600);
        $('#main.default article hgroup').hide().show('blind', { direction: 'left' }, 2000);
        $('#main.default section').hide().show('fade', 800, function () {
            $('.wrapper').hide('puff');
        });
        //Define botão Recarregar do Rodapé
        $('footer.default #refresh').attr('href', '#' + url);
        //Ativa FancyBox
        $(".fancybox-button").fancybox({ type: 'iframe', padding: 0, margin: 50 });
        //Ativa NiceScroll
        $('#main.default article').niceScroll({
            cursorwidth: '10px',
            cursorborderradius: '0px',
            cursorborder: 'none'
        });
        //Executa Leitura do Edioma
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
    //Ativa Notificacao
    $('.notification').jnotifyInizialize({
        oneAtTime: false,
        appendType: 'prepend'
    });
    //Menu DropDown
    $('header.default nav li').hover(function () {
        $('ul:first', this).stop(true, true).show();
    }, function () {
        $('ul', this).stop(true, true).hide('blind', 300);
    });
    //Expandir Conteudo
    $('footer.default #fit-height').click(function () {
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
    //Logout
    $('footer.default #logout').click(function () {
        $.post('pages/login.php', { action: 'logout' }, function (data) {
            $.cookie('alert_beta', null);
            window.location = '';
        })
    });
    //Inicia Sistema
    accessUrl();
    if (!$.cookie('alert_beta')) {
        $('.notification').jnotifyAddMessage({
            text: '<b>O ApSem é uma versão Beta!</b><br /><br />Favor reportar todos os Bugs encontrados para <a href="mailto:roque.ribeiro@hotmail.com.br">Roque Junior</a>',
            permanent: false,
            disappearTime: 15000
        });
        //Cria Cookie de Alerta Lido
        $.cookie('alert_beta', 'read', { expires: 1, path: '/' });
    }

});