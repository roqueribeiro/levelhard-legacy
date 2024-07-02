$(document).ready(function (e) {

    $('.notification').jnotifyInizialize({
        oneAtTime: false,
        appendType: 'append'
    });

    $('body').queryLoader2({
        barColor: '#444',
        backgroundColor: '#FFF',
        percentage: true,
        barHeight: 1,
        completeAnimation: 'grow',
        minimumTime: 300,
        onComplete: function () {
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
        hwacceleration: true
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

        var request = $.ajax({
            url: 'pages/' + pageName + '.php',
            type: 'POST',
            dataType: 'html',
            beforeSend: function () {
            }
        });

        request.done(function (data) {
            $('#gdata-content').html(data);
            $('#gdata-content #gdata-transit:last').hide().fadeIn(1000);
            $('body').getNiceScroll().resize();
        });

        request.fail(function () {
            $('.notification').jnotifyAddMessage({
                text: 'Ocorreu um erro ao tentar carregar a pagina! tente novamente mais tarde.',
                type: 'error'
            });
        });

    }

});