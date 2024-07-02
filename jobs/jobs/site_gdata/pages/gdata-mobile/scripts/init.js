$(document).ready(function () {

    //Touch Simulador
    //$('.gdata-home').niceScroll({
    //    cursoropacitymax: 0,
    //    cursorwidth: 10,
    //    cursorborder: 'none',
    //    cursorborderradius: '0px',
    //    boxzoom: true,
    //    dblclickzoom: true,
    //    gesturezoom: true,
    //    bouncescroll: true,
    //    touchbehavior: true
    //});

    //Inicia Plugin Datepicker
    //$('.show-visits, .add-visits').datepicker({
    //    closeText: 'Fechar',
    //    prevText: '&#x3c;Anterior',
    //    nextText: 'Pr&oacute;ximo&#x3e;',
    //    currentText: 'Hoje',
    //    monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    //    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    //    dayNames: ['Domingo', 'Segunda-feira', 'Ter&ccedil;a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado'],
    //    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    //    dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    //    weekHeader: 'Sm',
    //    dateFormat: 'dd/mm/yy',
    //    firstDay: 0,
    //    isRTL: false,
    //    showMonthAfterYear: false,
    //    yearSuffix: ''
    //});

    //Efeito de Transicao Carousel
    $("#owl-gdata-house, #owl-gdata-family").owlCarousel({
        slideSpeed: 300,
        paginationSpeed: 400,
        lazyLoad: true,
        singleItem: true,
        touchDrag: true,
        addClassActive: true,
        afterMove: function () {
            var html = '<b>Endereço:</b> ' + $('#owl-gdata-house .active img').attr('data-end') + '<br />';
            html += '<b>Bairro:</b> ' + $('#owl-gdata-house .active img').attr('data-bai') + '<br />';
            html += '<b>N. Família:</b> ' + $('#owl-gdata-house .active img').attr('data-fam') + '<br />';
            $('.gdata-notepad-body').hide().html(html).fadeIn();
        }
    });

    //Variaveis Globais
    var effects_vel = 400;
    var effects_ease = 'snap';
    var effects_type = 'simpleFade'; //slideTop, slideLeft, scaleCenter, rotate3d

    //Efeito ao Iniciar App
    $('body').css({
        opacity: 0,
        scale: 0
    }).transition({
        opacity: 1,
        scale: 1.0,
    }, effects_vel, effects_ease);

    //Ao Enviar Formulario de Login
    $('.gdata-login form[name=login]').ajaxForm({
        beforeSubmit: function () {
            //Validacao de Campos Nulos
            var username = $('.gdata-login form[name=login] input[name=username]');
            var password = $('.gdata-login form[name=login] input[name=password]');
            if (!username.val()) {
                username.focus();
                return false;
            }
            else if (!password.val()) {
                password.focus();
                return false;
            }
            else {
                //Bloquear Inputs ao Enviar
                $('.gdata-login form[name=login] input').attr('disabled', true);
            }
        },
        success: function (data) {
            //Inicia Funcoes da Tela Inicial
            $('.gdata-login form[name=login] input').removeAttr('disabled');
            $('body > .gdata-login').hide();
            $('body > .gdata-home').show();
            //Carrega Primeira Tela
            transitionEffect('.gdata-info', effects_vel, effects_ease, 'rotate3d');
        }
    });

    //Menu de Navegacao
    $('a.gdata-nav-link').click(function () {
        //Remove Informacoes Modal Table
        $('body > .modal .table thead').remove();
        $('body > .modal .table tbody').remove();
        var choice = $(this).attr('data-function');
        //Verifica Visivel Atualmente
        if (!$('.' + choice).is(':visible')) {
            //Retorna ao Topo
            $('.gdata-home').animate({ scrollTop: 0 }, 0);
            switch (choice) {
                case 'gdata-info':
                    //Funcoes Informacoes
                    transitionEffect('.gdata-info', effects_vel, effects_ease, effects_type);
                    break;
                case 'gdata-calendar':
                    //Funcoes Agenda
                    transitionEffect('.gdata-calendar', effects_vel, effects_ease, effects_type);
                    break;
                case 'gdata-visited':
                    //Funcoes Visita
                    transitionEffect('.gdata-visited', effects_vel, effects_ease, effects_type);
                    break;
                case 'gdata-family-visit':
                    //Funcoes Visita
                    $('body > .modal .modal-title').html('<span class="glyphicon glyphicon-inbox"></span>&nbsp;&nbsp;Tipo de Visita');
                    $('body > .modal .modal-body').html('<p><span class="fa fa-spinner fa-spin"></span>&nbsp;&nbsp;Carregando...</p>');
                    $('body > .modal .modal-body').load('form-visit.html', function () {
                        $("#owl-gdata-visit").owlCarousel({
                            slideSpeed: 300,
                            paginationSpeed: 400,
                            lazyLoad: true,
                            singleItem: true,
                            touchDrag: true,
                            addClassActive: true,
                            afterMove: function () {
                                var action = $('#owl-gdata-visit .active img').attr('data-action');
                                var desc = $('#owl-gdata-visit .active img').attr('data-desc');
                                $('input[name=visit-action]').val(action);
                                $('.help-block').text(desc);
                            }
                        });
                    });
                    $('body > .modal .gdata-modal-btn-cancel').html('Cancelar');
                    $('body > .modal .gdata-modal-btn-accept').html('Visitar');
                    $('body > .modal').modal('show');
                    break;
                case 'gdata-house':
                    //Funcoes Residencia
                    transitionEffect('.gdata-house', effects_vel, effects_ease, effects_type);
                    break;
                case 'gdata-3dhouse':
                    //Funcoes Casa 3D
                    $('body > .modal .modal-title').html('<span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inf. da Residência');
                    //Carregamento da Casa 3D
                    $('body > .modal .modal-body').html('<p><span class="fa fa-spinner fa-spin"></span>&nbsp;&nbsp;Carregando...</p>');
                    $('body > .modal .modal-body').load('3dhouse.html', function () {
                        $('.gdata-house-container .scene').hide().css({
                            'transform': 'rotateX(-20deg) rotateY(-90deg) rotateZ(0deg)'
                        }).delay(400).fadeIn(effects_vel);
                    });
                    //Carregamento do Form da Casa
                    $('body > .modal .table').load('form-house.html', function () {
                        //Altera Tipo de Casa
                        $('select[name=form-house-wall]').change(function () {
                            //Identifica Option Selecionado
                            var opt_selected = $(this).find('option:selected').attr('data-value');
                            //Altera Paredes
                            $('#tridiv .house-base .face, #tridiv .roof-base-left .face, #tridiv .roof-base-right .face').css({
                                'background': 'url(images/house/wall/texture-' + opt_selected + '.jpg) #faf8f8'
                            });
                            //Altera Portas
                            $('#tridiv .door .lt').css({
                                'background': 'url(images/house/door/texture-' + opt_selected + '.jpg) #faf8f8'
                            });
                            //Altera Janelas
                            $('#tridiv .window-right .ft, #tridiv .window-left .bk').css({
                                'background': 'url(images/house/window/texture-' + opt_selected + '.jpg) #faf8f8'
                            });
                            //Altera Telhado Esquerdo
                            $('#tridiv .roof-left .face').css({
                                'background': 'url(images/house/roof/texture-' + opt_selected + '-left.jpg) #faf8f8'
                            });
                            //Altera Telhado Direito
                            $('#tridiv .roof-right .face').css({
                                'background': 'url(images/house/roof/texture-' + opt_selected + '-right.jpg) #faf8f8'
                            });
                            //Altera Telhado Centro
                            $('#tridiv .roof-top .face').css({
                                'background': 'url(images/house/roof/texture-' + opt_selected + '-left.jpg) #faf8f8'
                            });
                        });
                        //Se Possuir Coleta Municipal
                        $('select[name=form-house-trash').change(function () {
                            var opt_selected = $(this).find('option:selected').attr('data-value');
                            //Converte para Bool
                            opt_selected = opt_selected == 'true' ? true : false
                            if (opt_selected) {
                                $('#tridiv .trash').stop(true, true).fadeIn();
                            } else {
                                $('#tridiv .trash').stop(true, true).fadeOut();
                            }
                        });
                        //Altera Tipo de Pavimento
                        $('select[name=form-house-floor]').change(function () {
                            var opt_selected = $(this).find('option:selected').attr('data-value');
                            $('#tridiv .floor .face').css({
                                'background': 'url(images/house/floor/texture-' + opt_selected + '.jpg) #81ae15'
                            });
                        });
                        //Se Possuir Eletricidade
                        $('select[name=form-house-eletric').change(function () {
                            var opt_selected = $(this).find('option:selected').attr('data-value');
                            //Converte para Bool
                            opt_selected = opt_selected == 'true' ? true : false
                            if (opt_selected) {
                                $('#tridiv .lamppost-base, #tridiv .lamppost-support, #tridiv .lamppost-lamp').stop(true, true).fadeIn();
                            } else {
                                $('#tridiv .lamppost-base, #tridiv .lamppost-support, #tridiv .lamppost-lamp').stop(true, true).fadeOut();
                            }
                        });
                    });
                    $('body > .modal .gdata-modal-btn-cancel').html('Cancelar');
                    $('body > .modal .gdata-modal-btn-accept').html('Salvar');
                    $('body > .modal').modal('show');
                    break;
                case 'gdata-family':
                    //Funcoes Familia
                    transitionEffect('.gdata-family', effects_vel, effects_ease, effects_type);
                    break;
                case 'gdata-familyview':
                    //Funcoes Visualizar Familia
                    $('body > .modal .modal-title').html('<span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inf. da Família');
                    //Carregamento da Casa 3D
                    $('body > .modal .modal-body').html('<p><span class="fa fa-spinner fa-spin"></span>&nbsp;&nbsp;Carregando...</p>');
                    $('body > .modal .modal-body').load('form-family.html', function () {
                        //Carrega Questionario de Visita da Pessoa Selecionada
                        $('select[name=form-family-person').change(function () {
                            if ($(this).val() > 0) {
                                $('body > .modal .modal-body .gdata-form-person-visit').hide();
                                $('body > .modal .modal-body .gdata-form-person-visit').load('form-person.html', { personid: $(this).val() }, function () {
                                    $(this).slideDown(effects_vel);
                                });
                            } else {
                                $('body > .modal .modal-body .gdata-form-person-visit').html('');
                            }
                        });
                        //Carrega Lista de CEP das Residencias Cadastradas
                        var countries = new Bloodhound({
                            datumTokenizer: function (d) { return Bloodhound.tokenizers.whitespace(d.name); },
                            queryTokenizer: Bloodhound.tokenizers.whitespace,
                            limit: 10,
                            prefetch: {
                                url: 'countries.json',
                                filter: function (list) {
                                    return $.map(list, function (country) { return { name: country }; });
                                }
                            }
                        });
                        countries.initialize();
                        $('.typeahead').typeahead(null, {
                            name: 'countries',
                            displayKey: 'name',
                            source: countries.ttAdapter()
                        });
                        //Funcoes dos Botoes do Modal
                        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                            var targetTab = e.target.href.split('#')[1];
                            if (targetTab == 'person-pesr') {
                                $('body > .modal .gdata-modal-btn-accept').html('Salvar Questionário');
                            }
                            if (targetTab == 'person-add') {
                                $('body > .modal .gdata-modal-btn-accept').html('Adicionar Pessoa');
                            }
                            if (targetTab == 'family-home') {
                                $('body > .modal .gdata-modal-btn-accept').html('Vincular Residência');
                            }
                        })
                    });
                    $('body > .modal .gdata-modal-btn-cancel').html('Cancelar');
                    $('body > .modal .gdata-modal-btn-accept').html('Salvar Questionário');
                    $('body > .modal').modal('show');
                    break;
                case 'gdata-about':
                    //Funcoes Familia
                    $('.gdata-about').show(0, function () {
                        $('.gdata-about-content', this).fadeIn(effects_vel);
                        $(this).click(function () {
                            $('.gdata-about-content', this).hide().parent().fadeOut(effects_vel);
                        });
                    });
                    break;
                case 'gdata-logout':
                    //Funcoes Logout
                    $('body > .modal .modal-title').html('<span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;Logout');
                    $('body > .modal .modal-body').html('<p>Você deseja realmente sair da aplicação?</p>');
                    $('body > .modal .gdata-modal-btn-cancel').html('Não');
                    $('body > .modal .gdata-modal-btn-accept').html('Sim');
                    $('body > .modal').modal('show');
                    $('body > .modal .gdata-modal-btn-accept').click(function () {
                        $('body > .modal').modal('hide');
                        $('body > .gdata-home').fadeOut(effects_vel, function () {
                            $('body > .gdata-home .gdata-content').hide();
                        });
                        $('body > .gdata-login').fadeIn(effects_vel);
                    });
                    break;
                default:
                    return false;
                    break;
            }
        } else {
            //Retorna ao Topo
            $('.gdata-home').animate({ scrollTop: 0 }, effects_vel);
        }
    });

});

function transitionEffect(divShow, effects_vel, effects_ease, effects_type) {
    $('body > .gdata-home .gdata-content').hide();
    switch (effects_type) {
        case 'simpleFade':
            $('body > .gdata-home ' + divShow).delay(effects_vel).fadeIn(effects_vel);
            break;
        case 'slideTop':
            $('.gdata-home ' + divShow + ' > .col-sm-10').hide();
            $('body > .gdata-home ' + divShow).show().css({
                opacity: 0,
                y: '-100%'
            }).transition({
                opacity: 1,
                y: '0%'
            }, effects_vel, effects_ease, function () {
                $('.gdata-home ' + divShow + ' > .col-sm-10').fadeIn(effects_vel);
            });
            break;
        case 'slideLeft':
            $('.gdata-home ' + divShow + ' > .col-sm-10').hide();
            $('body > .gdata-home ' + divShow).show().css({
                opacity: 0,
                x: '-100%'
            }).transition({
                opacity: 1,
                x: '0%'
            }, effects_vel, effects_ease, function () {
                $('.gdata-home ' + divShow + ' > .col-sm-10').fadeIn(effects_vel);
            });
            break;
        case 'scaleCenter':
            $('.gdata-home ' + divShow + ' > .col-sm-10').hide();
            $('body > .gdata-home ' + divShow).show().css({
                opacity: 0,
                scale: 0
            }).transition({
                opacity: 1,
                scale: 1.0,
            }, effects_vel, effects_ease, function () {
                $('.gdata-home ' + divShow + ' > .col-sm-10').fadeIn(effects_vel);
            });
            break;
        case 'rotate3d':
            $('.gdata-home ' + divShow + ' > .col-sm-10').hide();
            $('body > .gdata-home ' + divShow).show().css({
                opacity: 0,
                perspective: '0px',
                transformOrigin: '0px 0px',
                rotateY: '180deg'
            }).transition({
                opacity: 1,
                perspective: '500px',
                transformOrigin: '10px 10px',
                rotateY: '0deg'
            }, effects_vel, effects_ease, function () {
                $('.gdata-home ' + divShow + ' > .col-sm-10').fadeIn(effects_vel);
            });
            break;
    }
}