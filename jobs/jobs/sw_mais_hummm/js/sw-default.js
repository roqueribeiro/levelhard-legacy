$(document).ready(function () {

    var anchor_url = '';
    if (window.location.hash) {
        anchor_url = window.location.hash.replace('#', '');
    }

    $('.notification').jnotifyInizialize({
        appendType: 'prepend',
        oneAtTime: true,
    });

    //Definicoes Iniciais de Elementos
    $('.sw-theme-nav').transition({
        x: '-100%',
        duration: 0
    });

    //Funcoes do Menu de Navegacao
    $('#active-menu').click(function () {
        $('.sw-theme-overlay').show();
        if ($('.sw-theme-nav').hasClass('menu-open')) {
            $('.sw-theme-nav').transition({
                x: '-100%',
                easing: 'easeOutCubic',
                duration: 400
            }, function () {
                $(this).removeClass('menu-open');
                $('.sw-theme-overlay').hide();
            });
        } else {
            $('.sw-theme-nav').transition({
                x: '0%',
                easing: 'easeOutCubic',
                duration: 400
            }, function () {
                $(this).addClass('menu-open');
                $('.sw-theme-overlay').hide();
            });
        }
    });

    $('.sw-theme-nav ul li a').on('click', function (event) {
        event.preventDefault();
        var anchor_hash = this.hash;
        $('#active-menu').click();
        openModulePage('pages/' + anchor_hash.replace('#', '') + '.html');
        window.location.hash = anchor_hash;
    });

    $(document).on('click', '.sw-theme-content a.sw-anchor[href*=#]', function () {
        event.preventDefault();
        var anchor_hash = this.hash;
        openModulePage('pages/' + anchor_hash.replace('#', '') + '.html');
        window.location.hash = anchor_hash;
    });   

    $('login').waitForImages().done(function () {
        $('login').show().transition({
            x: '-100%',
            opacity: 0,
            duration: 0,
        }).transition({
            x: '0%',
            opacity: 1,
            easing: 'easeOutCirc',
            duration: 1000,
        });
    });

    $('form[name=form-login]').ajaxForm({
        beforeSubmit: function () {
            $('login').transition({
                x: '-100%',
                opacity: 0,
                easing: 'easeInCirc',
                duration: 600,
            }, function () {
                $(this).hide();
                $('content').show().transition({
                    x: '-100%',
                    opacity: 0,
                    duration: 0,
                }).transition({
                    x: '0%',
                    opacity: 1,
                    easing: 'easeOutCirc',
                    duration: 1000,
                }, function () {
                    openModulePage('pages/estab-lista.html');
                });
            });
        },
        success: function () {
        }
    });

});

function openModulePage(page) {

    if (!$('.sw-theme-content > div').length) { $('<div>').appendTo('.sw-theme-content'); }
    $('.sw-theme-content > div').transition({
        opacity: 0,
        duration: 0,
    }, function () {
        $(this).remove();
        $('.preloader').show().transition({ opacity: 1, duration: 400 });
        $.ajax({
            url: page
        }).done(function (data) {           
            $('.sw-theme-content').hide().html(data).transition({
                perspective: '100px',
                rotateX: '-10deg',
                y: '100%',
                opacity: 0,
                duration: 0
            });
            //Animacao de Introducao
            $('.sw-theme-overlay').show();
            $('.preloader').transition({
                opacity: 0,
                duration: 300
            }, function () {
                $(this).hide();
                $('.sw-theme-content').waitForImages().done(function () {
                    $(this).show().transition({
                        perspective: '200px',
                        rotateX: '0deg',
                        y: '0%',
                        opacity: 1,
                        easing: 'easeOutCirc',
                        duration: 1000
                    }, function () {
                        $('.sw-theme-overlay').hide();
                    });
                });
            });
        }).error(function () {
            openModulePage('pages/erro-conexao.html');
            $('.sw-notification').jnotifyAddMessage({
                text: 'Ocorreu um erro ao carregar o conteudo. Verifique sua conexão e tente novamente mais tarde.',
                type: 'error'
            });
        });
    });

}