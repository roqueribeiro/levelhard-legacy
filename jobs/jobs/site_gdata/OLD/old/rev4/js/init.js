$(document).ready(function (e) {

    $('.notification').jnotifyInizialize({
        oneAtTime: false,
        appendType: 'append'
    });

    $('body').queryLoader2({
        barColor: '#FFF',
        backgroundColor: '#444',
        percentage: true,
        barHeight: 1,
        completeAnimation: 'grow',
        minimumTime: 300,
        onLoadComplete: function () {
            ajaxLoadPage('home', '');
        }
    });

    $('body').niceScroll({
        background: '#EEE',
        cursorcolor: '#111',
        cursoropacitymax: 0.6,
        cursorwidth: 10,
        cursorborder: 'none',
        cursorborderradius: '0px',
        boxzoom: true,
        dblclickzoom: true,
        gesturezoom: true,
        bouncescroll: true,
        autohidemode: false,
        scrollspeed: 150,
        mousescrollstep: 100,
    });

    $('.change-page').find('a').click(function () {
        var url = $(this).attr('href').replace('#', '');
        if (url) {
            $('.navbar-wrapper .navbar .collapse').find('li').removeClass('active');
            $(this).parent().addClass('active');
            ajaxLoadPage(url);
        }
    });

    $('.change-lang').find('a').click(function () {
        var url = $(this).attr('href').replace('#', '');
        if (url) {

            var deFlag = $(this).parents('.change-lang').find('a:first span');
            var deFlagClass = deFlag.attr('class').split(' ');
            deFlag.removeClass(deFlagClass[1]);
            deFlag.addClass('flag-icon-' + url);

            activeLanguage(url);

        }
    });

    function activeLanguage(language) {
        if (!language) {

            var navLanguage = window.navigator.userLanguage || window.navigator.language;
            var navLangSplit = navLanguage.split('-');

            if (navLanguage) {

                if (navLangSplit.length > 1) {
                    activeLanguage(navLangSplit[1].toLowerCase());
                }
                else {
                    activeLanguage(navLangSplit[0].toLowerCase());
                }

            } else {
                activeLanguage('en');
            }

        } else {

            var request = $.ajax({
                url: 'languages.xml',
                type: 'POST',
                dataType: 'xml',
                beforeSend: function () {
                }
            });

            request.done(function (xml) {
                $(xml).find('translation').each(function () {
                    var id = $(this).attr('id');
                    var text = $(this).find(language).text();
                    $('*[id*=lang-' + id + ']').css({
                        'font-weight': 'normal'
                    }).html(text);
                });
                $('input[name=default-lang]').val(language);
            });

            request.fail(function () {
                $('.notification').jnotifyAddMessage({
                    text: 'Ocorreu um erro ao tentar carregar o arquivo de linguagem! tente novamente mais tarde.',
                    type: 'error'
                });
            });

        }
    }

    function ajaxLoadPage(pageName) {

        $('.preloader').fadeIn('fast');

        var request = $.ajax({
            url: 'pages/' + pageName + '.html',
            type: 'POST',
            dataType: 'html',
            beforeSend: function () {
            }
        });

        request.done(function (data) {
            $('#gdata-content').html(data);
            activeLanguage($('input[name=default-lang]').val());
            $('#gdata-content #gdata-transit').hide().fadeIn('slow', function () {
                $('.preloader').fadeOut('fast');
            });
            $('body').getNiceScroll().resize();
        });

        request.fail(function () {
            $('.notification').jnotifyAddMessage({
                text: 'Ocorreu um erro ao tentar carregar a pagina! tente novamente mais tarde.',
                type: 'error'
            });
            $('.preloader').fadeOut('fast');
        });

    }

});