// =========== Funções WebDesk jQuery =========== //

//Função Centraliza Elemento
jQuery.fn.center = function () {
    this.css({
        top: ($(window).height() - this.height()) / 2 + $(window).scrollTop() + 'px',
        left: ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + 'px'
    });
    return this;
}

//Função Cria Elemento Janela
function windowOpen(janela_id, titulo, endereco, tamanhoX, tamanhoY, ativaDrag, ativaResize) {

    //Verifica se a Janela ja foi Criada
    if ($('.' + janela_id).attr('id')) {
        $('#cobertor').show();
        $('div#janela').css('opacity', '0.2');
        $('div#conteudo_j').hide();
        $('.' + janela_id).css('opacity', '1').center().stop().effect('shake', 600, function () {
            $('div#janela').css('opacity', '1');
            $('div#conteudo_j').show().css({ 'opacity': 100 });
            $('#cobertor').hide();
        });
        $('#drop #' + janela_id).remove();
    }
    else {


        //Cria HTML do Elemento Janela
        if (!endereco.search('http')) {
            //alert('tem http');
            var html = '<div id="janela" class="' + janela_id + '" style="width:' + tamanhoX + '; height:' + tamanhoY + ';">';
            html += '<div id="titulo">';
            html += '<img src="imagens/icones/windows/add_list.png" alt="" />';
            html += '<p>' + titulo + '</p>';
            html += '</div>';
            html += '<div id="funcoes">';
            html += '<img class="close" src="imagens/icones/windows/delete.png" alt="" />';
            html += '</div>';
            html += '<div id="conteudo_j"><iframe src="' + endereco + '"></iframe></div>';
            html += '</div>';
        }
        else {
            //alert('nao tem http');
            var html = '<div id="janela" class="' + janela_id + '" style="width:' + tamanhoX + '; height:' + tamanhoY + ';">';
            html += '<div id="titulo">';
            html += '<img src="imagens/icones/windows/add_list.png" alt="" />';
            html += '<p>' + titulo + '</p>';
            html += '</div>';
            html += '<div id="funcoes">';
            html += '<img class="close" src="imagens/icones/windows/delete.png" alt="" />';
            html += '</div>';
            html += '<div id="conteudo_j"></div>';
            html += '</div>';
        }

        //Aplica o HTML do Elemento Janela no Corpo
        $('body').append(html);

        //Ativa Funções de Navegação Interface Usuario
        $('.' + janela_id).draggable({
            cursor: 'move',
            handle: '#titulo',
            cancel: '#titulo img',
            containment: '#corpo',
            scroll: false,
            stack: 'div#janela',
            iframeFix: true,
            start: function () {
                $('#conteudo_j', this).hide();
                $('#cobertor').show();
            },
            stop: function () {
                $('#conteudo_j', this).show();
                $('#cobertor').hide();
            }
        }).resizable({
            containment: '#corpo',
            minHeight: 200,
            minWidth: 300,
            start: function () {
                $('#conteudo_j', this).hide();
                $('#cobertor').show();
            },
            stop: function () {
                $('#conteudo_j', this).show();
                $('#cobertor').hide();
            }
        });

        //Se Verdadeiro Desativa Draggable
        if (!ativaDrag) {
            $('.' + janela_id).draggable('destroy');
            $('#cobertor_2').show();
        }

        //Se Verdadeiro Desativa Resize
        if (!ativaResize) {
            $('.' + janela_id).resizable('destroy');
        }

        //Centraliza Elemento Janela e Mostra
        $('.' + janela_id).center().show('puff', 300, function () {
            if (endereco.search('http')) {
                $('#conteudo_j', this).html('Carregando...');
                $.ajax({
                    url: endereco,
                    success: function (dados) {
                        $('.' + janela_id + ' #conteudo_j').html(dados);
                    },
                });
            }
        });

        //Função do Botão Fechar Janela
        $('div#janela #funcoes .close').click(function () {
            var essa_janela = $(this).parent('#funcoes').parent('#janela');
            $('#conteudo_j', essa_janela).hide();
            essa_janela.hide('puff', 300, function () {
                $(this).remove();
                $('#drop #' + $(this).attr('class')).remove();
                $('#cobertor_2').fadeOut();
            });
        });

    }

}

$(document).ready(function () {

    //Desativa Seleção do Navegador
    $('body').disableSelection();

    //Ativa Scrollbar Modificado
    $('#tela_inicial #conteudo').mCustomScrollbar({
        scrollEasing: "easeOutQuint",
        advanced: {
            updateOnContentResize: true,
            autoExpandHorizontalScroll: true
        },
    });

    //Ativa Relogio jQuery
    $.clock.locale = {
        "pt": {
            "weekdays": ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"],
            "months": ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "October", "Novembro", "Dezembro"]
        }
    }
    $('#tela_inicial #info #botao_relogio p').clock({ "langSet": "pt" });

    //$('#tela_login').fadeOut(0);
    //$('#tela_inicial, #drop').fadeIn(0);

    //Login Nuvens 3D
    $('#nuvens').smart3d();

    //Executa Login e Confere Usuario
    $('form[name=autenticacao]').ajaxForm({
        url: 'usuarios.xml',
        type: 'GET',
        dataType: 'json',
        beforeSubmit: function () {
            //Verifica Campo Usuario
            if (!$('#tela_login input[name=usuario]').val()) {
                $('#tela_login .resultado p').text('Digite seu usuario!').addClass('loginErro', 600);
                $('#tela_login input[name=usuario]').focus();
            }
                //Verifica Campo Senha
            else if (!$('#tela_login input[name=senha]').val()) {
                $('#tela_login .resultado p').text('Digite sua senha!').addClass('loginErro', 600);
                $('#tela_login input[name=senha]').focus();
            } else {
                $('#tela_login').delay(600).fadeOut(300);
                $('#tela_inicial, #drop').fadeIn(600);
            }
        },
        success: function () {
        }
    });

    //Sair do Sistema
    $('#botao_sair').click(function () {
        $('div#janela').fadeOut(300, function () { $(this).remove(); });
        $('#tela_login').fadeIn(300);
        $('#tela_inicial, #drop').fadeOut(600, function () { $('#drop ul li').remove(); });
    });

    $.supersized({
        slide_interval: 3000,
        transition: 1,
        transition_speed: 700,
        slides: [
			{ image: 'imagens/wallpaper/wallpaper_1.jpg', title: '' },
			{ image: 'imagens/wallpaper/wallpaper_2.jpg', title: '' },
			{ image: 'imagens/wallpaper/wallpaper_3.jpg', title: '' },
			{ image: 'imagens/wallpaper/wallpaper_4.jpg', title: '' },
			{ image: 'imagens/wallpaper/wallpaper_5.jpg', title: '' },
        ]
    });

    //Menu e SubMenu Efeitos
    $('#info ul').hover(function () {
        $(this).animate({ backgroundColor: '#255562', borderColor: '#5c8a97' }, { queue: false, duration: 0 });
        $('.submenu:first', this).stop(true, true).slideDown(300, 'easeOutBack', function () {
            $('li', this).animate({ 'opacity': '1' }, { queue: false, duration: 300 });
        });
    }, function () {
        $(this).animate({ backgroundColor: '#3b636e', borderColor: '#FFF' }, { queue: false, duration: 300 });
        $('ul li', this).animate({ 'opacity': '0' }, { queue: false, duration: 300 });
        $('.submenu:first', this).stop(true, true).fadeOut(300);
    });
    $('#info ul').click(function () {
        $('.submenu', this).stop(true, true).fadeOut(300);
    });

    $.simpleWeather({
        location: 'tatui, sao paulo',
        unit: 'c',
        success: function (weather) {
            html = '<h2>' + weather.city + weather.region + '</h2>';
            html += '<img src="' + weather.image + '">';
            html += '<p>' + weather.temp + 'º' + weather.units.temp + '</p>';

            $("#weather").html(html);
        },
        error: function (error) {
            $("#weather").remove();
        }
    });

    //Ativa Multitarefa
    $('#drop').droppable({
        accept: '#janela',
        over: function (event, ui) {
            $(this).animate({ bottom: '0px', opacity: '1' }, { queue: false, duration: 300 });
            $('ul', this).delay(300).fadeIn(300);
        },
        drop: function (event, ui) {
            //Esconde conteudo da Janela
            $('.' + ui.draggable.attr('class').split(" ")[0] + ' #conteudo_j').css({ 'opacity': 0 });

            //Se a Janela Existe no Multitarefa
            if ($('#drop ul #' + ui.draggable.attr('class').split(" ")[0]).attr('id')) {
                ui.draggable.hide('puff', 600);
            }
                //Se a Janela Existe no Multitarefa
            else {
                ui.draggable.hide('puff', 600);
                $('#menu #' + ui.draggable.attr('class').split(" ")[0]).clone().appendTo('#drop ul');
                $(this).animate({ bottom: '-100px', opacity: '0.5' }, { queue: false, duration: 300 });
            }
            $('ul', this).fadeOut(300);
        },
        out: function (event, ui) {
            $(this).animate({ bottom: '-100px', opacity: '0.5' }, { queue: false, duration: 300 });
            $('ul', this).fadeOut(300);
        },
        tolerance: 'touch'
    });

    //Ações da Multirefa
    $('#drop').hover(function () {
        if ($('#cobertor').is(':hidden')) {
            $('#drop').animate({ bottom: '-60px', opacity: '1' }, { queue: false, duration: 300 });
        }
    }, function () {
        if ($('#cobertor').is(':hidden')) {
            $('#drop').animate({ bottom: '-100px', opacity: '0.5' }, { queue: false, duration: 300 });
        }
    });
    $('#drop').bind('click', function () {
        if ($('#cobertor').is(':hidden')) {
            $('#drop').css('z-index', '9991').animate({ bottom: '0px', opacity: '1' }, { queue: false, duration: 300 });
            $('#drop ul').delay(300).fadeIn(300);
            $('#cobertor').show();
        } else {
            $('#drop').css('z-index', '').animate({ bottom: '-100px', opacity: '0.5' }, { queue: false, duration: 300 });
            $('#drop ul').fadeOut(300);
            $('#cobertor').hide();
        }
    });

    // ========== Monta Listagem ========== //
    //var grade_cab = '<ul>';
    //grade_cab += '<li class="col_1">';
    //grade_cab += '<img src="imagens/icones/16/1351696339_file_edit.png" alt="" />';
    //grade_cab += '<img src="imagens/icones/16/1351696334_file_delete.png" alt="" />';
    //grade_cab += '<img src="imagens/icones/16/1351696344_message.png" alt="" />';
    //grade_cab += '</li>';
    //grade_cab += '<li class="col_2">Nome</li>';
    //grade_cab += '<li class="col_3">Telefone</li>';
    //grade_cab += '<li class="col_4">Celular</li>';
    //grade_cab += '<li class="col_5">Ramal</li>';
    //grade_cab += '<li class="col_6">E-Mail</li>';
    //grade_cab += '<li class="col_7">Planta</li>';
    //grade_cab += '</ul>';

    //$('#grade #cabecalho').html(grade_cab);

    //for (var i = 0; i <= 30; i++) {

    //    var grade_list = '<ul>';
    //    grade_list += '<li class="col_1">';
    //    grade_list += '<img src="imagens/icones/16/1351696339_file_edit.png" alt="" />';
    //    grade_list += '<img src="imagens/icones/16/1351696334_file_delete.png" alt="" />';
    //    grade_list += '<img src="imagens/icones/16/1351696344_message.png" alt="" />';
    //    grade_list += '</li>';
    //    grade_list += '<li class="col_2">Nome</li>';
    //    grade_list += '<li class="col_3">Telefone</li>';
    //    grade_list += '<li class="col_4">Celular</li>';
    //    grade_list += '<li class="col_5">Ramal</li>';
    //    grade_list += '<li class="col_6">E-Mail</li>';
    //    grade_list += '<li class="col_7">Planta</li>';
    //    grade_list += '</ul>';

    //    $('#grade #listagem').append(grade_list);

    //}

    // ========== Ativa Selecao na Listagem ========== //
    //$('#grade #listagem').selectable({ filter: 'ul' });

});
