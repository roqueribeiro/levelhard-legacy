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
            ajaxLoadPage('home')
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

    $('.navbar-wrapper .navbar').find('a').click(function () {
        var url = $(this).attr('href').replace('#', '');
        if (url) {
            $('.navbar-wrapper .navbar .collapse').find('li').removeClass('active');
            $(this).parent().addClass('active');
            ajaxLoadPage(url);
        }
    });

    function ajaxLoadPage(pageName) {

        $('.preloader').fadeIn('fast');

        var request = $.ajax({
            url: 'pages/' + pageName + '.php',
            type: 'POST',
            dataType: 'html',
            beforeSend: function () {
            }
        });

        request.done(function (data) {
            $('#gdata-content').html(data);
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