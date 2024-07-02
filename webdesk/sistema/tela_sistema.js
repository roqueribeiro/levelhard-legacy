$('#cobertor_degrade, #preloader').delay(600).fadeOut(600);
$('#sistema_bg_default').hide();
$.get('core.php', {
    'acao': 'mostra_bg'
}, function(data) {
    $('#sistema_bg_default').css('background-image', 'url(' + data + ')');
    $('#sistema_bg_default').fadeIn(600);
});

//Tooltip
$('#tela_inicial #navegacao ul, #tela_inicial #navegacao #menu li').qtip({
    position: {
        my: 'top center',
        at: 'bottom center'
    }
});

//Ativa Plugin Relogio
$.clock.locale = {
    'pt': {
        'weekdays': [
            'Domingo',
            'Segunda-Feira',
            'Terça-Feira',
            'Quarta-Feira',
            'Quinta-Feira',
            'Sexta-Feira',
            'Sábado'
        ],
        'months': [
            'Janeiro',
            'Fevereiro',
            'Março',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro'
        ]
    }
}
$('#tela_inicial #info #botao_relogio p').clock({
    'langSet': 'pt'
});

//Ativa Plugin Weather
$('#weather').hide();
$.simpleWeather({
    location: 'tatui, sao paulo',
    unit: 'c',
    success: function(weather) {
        html = '<h2>' + weather.city + weather.region + '</h2>';
        html += '<img src="' + weather.image + '">';
        html += '<p>' + weather.temp + 'º' + weather.units.temp + '</p>';
        $("#weather").html(html).fadeIn(600);
    },
    error: function(error) {
        $("#weather").remove();
    }
});

//Ativa Movimentação dos Icones
$('div#conteudo #icones').disableSelection();
$('div#conteudo #icones ul').sortable({
    placeholder: 'ui-state-highlight',
    containment: '#corpo #icones',
    opacity: '0.8',
    start: function(e, ui) {
        //$(ui.placeholder).slideUp(300);
    },
    change: function(e, ui) {
        //$(ui.placeholder).hide().slideDown(300);
    },
    beforeStop: function(e, ui) {
        ui.item.hide().fadeIn(600);
        $('img', ui.item).hide().show('scale', {
            duration: 1000,
            easing: 'easeOutElastic',
        });
    }
});

//Ativa Relogio
$('#botao_relogio').click(function() {
    $('#cobertor, #preloader').show();
    $('#wallclock').load('conteudo/relogio/index.html', function() {
        $('#wallclock, #wallclock #clock').fadeIn(1000, function() {
            $('#cobertor, #preloader').fadeOut();
        });
        $('#tela_inicial, span#janela, #drop').animate({
            'opacity': '0.3'
        }, 600);
    });
});
$('#wallclock').click(function() {
    $('#cobertor').show();
    $('#wallclock, #wallclock #clock').fadeOut(1000, function() {
        $('#cobertor').fadeOut(function() {
            $('#wallclock').html('');
        });
    });
    $('#tela_inicial, span#janela, #drop').animate({
        'opacity': '1'
    }, 600);
});

//Inidicador Mensagem
setInterval(function() {
    $.get('core.php', {
        'acao': 'indicador_mensagem'
    }, function(data) {
        if (data > 0) {
            $('#botao_mensagem').addClass('nova_mensagem', 500, function() {
                $('#botao_mensagem').removeClass('nova_mensagem', 500);
            });
        } else {
            $('#botao_mensagem').removeClass('nova_mensagem');
        }
    });
}, 1000);

//Menu e SubMenu Efeitos
$('#info ul').hover(function() {
    $(this).animate({
        backgroundColor: '#255562',
        borderColor: '#5c8a97'
    }, {
        queue: false,
        duration: 0
    });
    $('.submenu:first', this).stop(true, true).slideDown(300, 'easeOutBack', function() {
        $('li', this).animate({
            'opacity': '1'
        }, {
            queue: false,
            duration: 300
        });
    });
}, function() {
    $(this).animate({
        backgroundColor: '#3b636e',
        borderColor: '#FFF'
    }, {
        queue: false,
        duration: 300
    });
    $('ul li', this).animate({
        'opacity': '0'
    }, {
        queue: false,
        duration: 300
    });
    $('.submenu:first', this).stop(true, true).fadeOut(300);
});

//Ativa Multitarefa
$('#drop').droppable({
    accept: '#janela',
    over: function(event, ui) {
        $(this).animate({
            height: '140px',
            opacity: '1'
        }, {
            duration: 300
        });
        $('ul', this).delay(300).fadeIn(300);
    },
    drop: function(event, ui) {
        $('#cobertor_drop_ac').show();
        $('#menu #' + ui.draggable.attr('class').split(" ")[0]).clone().appendTo('#drop ul');
        $('.' + ui.draggable.attr('class').split(" ")[0] + ' #conteudo_j').css({
            'opacity': 0
        });
        $('.' + ui.draggable.attr('class').split(" ")[0] + ' #titulo').css({
            'opacity': 0
        });
        $('.' + ui.draggable.attr('class').split(" ")[0] + ' #funcoes').css({
            'opacity': 0
        });
        $('ul', this).fadeOut();
        ui.draggable.hide('puff', 400);
        $('#drop').animate({
            height: '40px',
            opacity: '0.5'
        }, 300);
        $('#cobertor_drop_ac').delay(400).fadeOut();
    },
    out: function(event, ui) {
        $('ul', this).stop(true, true).fadeOut();
        $(this).animate({
            height: '40px',
            opacity: '0.5'
        }, {
            queue: false,
            duration: 300
        });
    },
    tolerance: 'touch'
});
$('#drop').hover(function() {
    if ($('#cobertor_drop').is(':hidden')) {
        $('#drop').animate({
            height: '80px',
            opacity: '1'
        }, {
            queue: false,
            duration: 300
        });
    }
}, function() {
    if ($('#cobertor_drop').is(':hidden')) {
        $('#drop').animate({
            height: '40px',
            opacity: '0.5'
        }, {
            queue: false,
            duration: 300
        });
    }
});
$('#drop, #cobertor_drop').bind('click', function() {
    if ($('#cobertor_drop').is(':hidden')) {
        $('#cobertor_drop_ac').show();
        $('#drop').css('z-index', '9991').animate({
            height: '140px',
            opacity: '1'
        }, {
            queue: false,
            duration: 300
        });
        $('#drop ul').delay(300).fadeIn(300);
        $('#cobertor_drop').fadeIn(300);
        $('#cobertor_drop_ac').delay(400).fadeOut();
    } else {
        $('#cobertor_drop_ac').show();
        $('#drop').css('z-index', '').animate({
            height: '40px',
            opacity: '0.5'
        }, {
            queue: false,
            duration: 300
        });
        $('#drop ul').fadeOut();
        $('#cobertor_drop').fadeOut(300);
        $('#cobertor_drop_ac').delay(400).fadeOut();
    }
});

//MultiDesktop
$('#corpo').attr('class', 'conteudo-1');
$('#tela_inicial #conteudo').not('.conteudo-1').hide();
$('#tela_inicial #conteudo, #multi-desk').dblclick(function() {
    if ($('#multi-desk').css('display') == 'none') {
        $('#tela_inicial, span#janela, #drop').animate({
            'opacity': '0.3'
        }, 600);
        $('#multi-desk').fadeIn(600);
        $('#cube').addClass('show-init');
    } else {
        $('#tela_inicial, span#janela, #drop').animate({
            'opacity': '1'
        }, 600);
        $('#multi-desk').fadeOut();
        $('#cube').addClass('show-front').removeClass();
    }
});
$('.cube-nav div').click(function() {
    $('#cube').removeClass().addClass($(this).attr('id'));
});
$('.cube-nav div').hover(function() {
    $('#cube figure:nth-child(' + $(this).text() + ')').animate({
        backgroundColor: 'rgba(255,0,0,0.4)'
    }, {
        queue: false,
        duration: 0
    });
}, function() {
    $('#cube figure:nth-child(' + $(this).text() + ')').animate({
        backgroundColor: 'rgba(255,0,0,0)'
    }, {
        queue: false,
        duration: 300
    });
});
$('#cube figure').hover(function() {
    $(this).animate({
        backgroundColor: 'rgba(255,0,0,0.4)'
    }, {
        queue: false,
        duration: 300
    });
}, function() {
    $(this).animate({
        backgroundColor: 'rgba(255,0,0,0)'
    }, {
        queue: false,
        duration: 300
    });
});
$('#cube figure').click(function() {
    $('#multi-desk').fadeOut();
    $('#cube').addClass('show-front').removeClass();
    $('#tela_inicial, span#janela, #drop').animate({
        'opacity': '1'
    }, 600);
});

//Sair do Sistema
$('#botao_sair').click(function() {
    $('#cobertor_degrade, #preloader').show();
    $('div#janela').remove();
    $.ajax({
        url: 'core.php',
        data: {
            'acao': 'sair_sistema'
        }
    }).done(function(data) {
        $('#corpo').html(data);
        $('#cobertor_degrade, #preloader').fadeOut(300);
    });
});