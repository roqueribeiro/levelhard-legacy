//Função Centraliza Elemento
jQuery.fn.center = function() {
    this.css({
        top: ($(window).height() - this.height()) / 2 + $(window).scrollTop(),
        left: ($(window).width() - this.width()) / 2 + $(window).scrollLeft()
    });
    return this;
}

var z_indexi = 3;
var animaVel = 400;

//Função Cria Elemento Janela
function windowOpen(tipoConteudo, janela_id, titulo, endereco, tamanhoX, tamanhoY, ativaDrag, ativaResize) {

    //Verifica se a Janela ja foi Criada
    if ($('.' + janela_id).attr('id')) {
        $('#cobertor').show();
        $('.' + janela_id).center().css('z-index', z_indexi++).show('puff', {
            easing: 'easeOutBack'
        }, animaVel, function() {
            $('#cobertor').hide();
            $('#conteudo_j, #titulo, #funcoes', this).css({
                'opacity': 1
            });
        });
        $('#drop #' + janela_id).fadeOut(function() {
            $(this).remove();
        })
    } else {

        //Cria HTML do Elemento Janela
        var html = '<span id="janela" class="' + janela_id + '" style="width:' + tamanhoX + '; height:' + tamanhoY + '; z-index: ' + z_indexi++ + '">';
        html += '<div id="titulo">';
        html += '<img src="imagens/icones/windows/add_list.png" alt="" />';
        html += '<p>' + titulo + '</p>';
        html += '</div>';
        html += '<div id="funcoes">';
        html += '<img class="close" src="imagens/icones/windows/delete.png" alt="" />';
        html += '</div>';
        html += '<div id="conteudo_j"></div>';
        html += '</span>';

        //Aplica o HTML do Elemento Janela no Corpo
        $('#corpo').append(html);

        //Traz Janela Para Frente
        $('.' + janela_id).click(function() {
            $(this).siblings().css('z-index');
            $(this).css('z-index', z_indexi++);
        });

        //Ativa Funções de Navegação Interface Usuario
        $('.' + janela_id).draggable({
            cursor: 'move',
            handle: '#titulo',
            cancel: '#titulo img',
            containment: '#corpo',
            scroll: false,
            iframeFix: true,
            start: function() {
                $(this).css('z-index', z_indexi++);
                $('#conteudo_j, #titulo, #funcoes', this).hide();
                $('#cobertor').show();
            },
            stop: function() {
                $('#conteudo_j, #titulo, #funcoes', this).show();
                $('#cobertor').hide();
            }
        }).resizable({
            containment: '#corpo',
            minHeight: 250,
            minWidth: 350,
            start: function() {
                $('#conteudo_j, #titulo, #funcoes', this).hide();
                $('#cobertor').show();
            },
            stop: function() {
                $('#conteudo_j, #titulo, #funcoes', this).show();
                $('#cobertor').hide();
            }
        });

        //Se Verdadeiro Desativa Draggable
        if (!ativaDrag) {
            $('.' + janela_id).css('z-index', '9999').draggable('destroy');
            $('#cobertor_window').css('z-index', '9998').show();
        }

        //Se Verdadeiro Desativa Resize
        if (!ativaResize) {
            $('.' + janela_id).resizable('destroy');
        }

        //Se Verdadeiro Ativa Maximizar
        $('.' + janela_id + ' #titulo').dblclick(function() {
            if (ativaResize) {
                if ($(this).parent().css('width') != $(window).width() + 'px') {
                    essa_janela_r = $(this).parent();
                    atual_top = essa_janela_r.css('top');
                    atual_left = essa_janela_r.css('left');
                    atual_width = essa_janela_r.css('width');
                    atual_height = essa_janela_r.css('height');
                    $('#conteudo_j', essa_janela_r).hide();
                    $('#titulo', essa_janela_r).hide();
                    $('#funcoes', essa_janela_r).hide();
                    $(this).parent().animate({
                        'top': '0px',
                        'left': '0px',
                        'width': '100%',
                        'height': '100%'
                    }, {
                        'duration': 300,
                        'complete': function() {
                            $('#conteudo_j', essa_janela_r).show();
                            $('#titulo', essa_janela_r).show();
                            $('#funcoes', essa_janela_r).show();
                        }
                    });
                } else {
                    $('#conteudo_j', essa_janela_r).hide();
                    $('#titulo', essa_janela_r).hide();
                    $('#funcoes', essa_janela_r).hide();
                    $(this).parent().animate({
                        'top': atual_top,
                        'left': atual_left,
                        'width': atual_width,
                        'height': atual_height
                    }, {
                        'duration': animaVel,
                        easing: 'easeOutBack',
                        'complete': function() {
                            $('#conteudo_j', essa_janela_r).show();
                            $('#titulo', essa_janela_r).show();
                            $('#funcoes', essa_janela_r).show();
                        }
                    });
                }
            }
        });

        //Centraliza Elemento Janela e Mostra
        $('.' + janela_id).center().show('puff', {
            easing: 'easeOutBack'
        }, animaVel, function() {
            if (!tipoConteudo) {
                $.ajax({
                    url: endereco,
                    success: function(dados) {
                        $('.' + janela_id + ' #conteudo_j').html(dados);
                    },
                });
            } else if (tipoConteudo == 1) {
                $('#conteudo_j', this).html('<iframe src="' + endereco + '"></iframe>');
                $('#conteudo_j iframe', this).show();
            } else if (tipoConteudo == 2) {
                html_opt = '<div id="conteudo_opt"><input name="conteudo_close" type="button" value="Ok"></div>';
                $('#conteudo_j', this).html(endereco + html_opt);
                $('#conteudo_j input', this).focus();
                $('#conteudo_j input', this).click(function() {
                    $('.close', $(this).parent().parent().parent()).click();
                });
            }
        });

        //Função do Botão Fechar Janela
        $('.' + janela_id + ' #funcoes .close').click(function() {
            var essa_janela = $(this).parent('#funcoes').parent('#janela');
            $('#conteudo_j', essa_janela).hide();
            $('#titulo', essa_janela).hide();
            $('#funcoes', essa_janela).hide();
            essa_janela.hide('puff', 300, function() {
                $(this).remove();
                $('#drop #' + $(this).attr('class')).remove();
                $('#cobertor_window').hide();
            });
        });

    }

}
$(document).ready(function() {
    $('body').disableSelection();
    $('#cobertor_degrade, #preloader').show();
    $.ajax({
        url: "core.php",
        data: {
            'acao': 'tela_login'
        }
    }).done(function(data) {
        $('#corpo').html(data);
    });
});