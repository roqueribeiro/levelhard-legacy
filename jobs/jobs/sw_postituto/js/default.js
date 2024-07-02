$(document).ready(function () {

    $('.hds-notification').jnotifyInizialize({
        oneAtTime: false,
        appendType: 'prepend'
    });

    $(window).load(function () {
        $('.hds-bg').fadeTo(8000, 0.6);
        $.ajax({
            url: 'core.php',
            type: 'POST',
            data: { acao: 'verifica' },
            dataType: "html"
        }).done(function (data) {
            $('.hds-preloader').delay(800).fadeOut(600, function () {
                if (data == 'aceito') {
                    $('.hds-logon').fadeOut(600, function () {
                        $('.hds-content').fadeIn(600);
                        $('.new-postit').animate({
                            'top': '-55px',
                            'left': '-60px',
                        }, 600, 'easeOutBack');
                        $('form[name=autenticacao] input').attr('disabled', false);
                    });
                } else {
                    $('.hds-logon').fadeIn(600, function () {
                        $('form[name=autenticacao] input[name=apelido]').focus();
                    });
                }
            });
        });
    })

    $(window).resize(function (e) {
        if (e.target == window) {
            //Reseta Posicoes dos Postits
            $('.hds-postit-area .hds-postit').animate({
                top: '15px',
                left: '15px'
            }, {
                duration: 600,
                easing: 'easeOutCubic',
                queue: false
            });
        }
    });

    $('form[name=autenticacao]').ajaxForm({
        dataType: 'html',
        beforeSubmit: function () {
            apelido = $('form[name=autenticacao] input[name=apelido]');
            senha = $('form[name=autenticacao] input[name=senha]');
            if (!apelido.val()) {
                apelido.focus();
                apelido.css('border-left', '4px #F00 solid');
                apelido.on('keyup', function () {
                    if (apelido.val().length > 0) {
                        apelido.css('border-left', '4px #01468b solid');
                    }
                });
                return false;
            } else if (!senha.val()) {
                senha.focus();
                senha.css('border-left', '4px #F00 solid');
                senha.on('keyup', function () {
                    if (senha.val().length > 0) {
                        senha.css('border-left', '4px #01468b solid');
                    }
                });
                return false;
            } else {
                $('form[name=autenticacao] input').attr('disabled', true);
            }
        },
        success: function (data) {
            console.log(data);
            if (data == 'recusado') {
                $('.hds-logon .box form').effect('shake', 600, function () {
                    $('form[name=autenticacao] input').attr('disabled', false);
                    $('form[name=autenticacao] input[name=apelido]').focus();
                });
                $('.hds-notification').jnotifyAddMessage({
                    text: 'Login e Senha Incorretos.',
                    type: 'error',
                    permanent: false,
                });
            }
            if (data == 'desativado') {
                $('.hds-logon .box form').effect('shake', 600, function () {
                    $('form[name=autenticacao] input').attr('disabled', false);
                    $('form[name=autenticacao] input[name=apelido]').focus();
                });
                $('.hds-notification').jnotifyAddMessage({
                    text: 'Usuário desativado, verifique sua conta de email para ativar.',
                    type: 'error',
                    permanent: false,
                });
            }
            if (data == 'aceito') {
                $('.hds-logon').fadeOut(600, function () {
                    $('.hds-content').fadeIn(600);
                    $('.new-postit').animate({
                        'top': '-40px',
                        'left': '-40px',
                    }, 600, 'easeOutBack');
                    $('form[name=autenticacao] input').attr('disabled', false);
                    $('form[name=autenticacao] input[name=apelido]').val('');
                    $('form[name=autenticacao] input[name=senha]').val('');
                });
                //Busca Informacoes do Usuario
                $.ajax({
                    url: 'core.php',
                    type: 'POST',
                    data: { acao: 'informacoes' },
                    dataType: "json"
                }).done(function (data) {
                    console.log(data);
                });
            }
        }
    });

    $('.hds-modal #close').click(function () {
        $('.hds-logon .box').fadeIn(600);
        $('.hds-modal').show(0, function () {
            $('.hds-modal .box').fadeOut(600);
            $('.hds-modal').delay(600).fadeOut(0);
        });
    });

    $('#novousuario').click(function () {
        $('.hds-logon .box').fadeOut(600);
        $('.hds-modal').show(0, function () {
            $('.hds-modal .box').fadeIn(600);
        });
    });

    $('#menu').click(function (e) {
        e.stopPropagation();
        $('#menu').stop(true, true).fadeOut(300);
        $('.menu').animate({
            'right': '-5px',
            'opacity': '1'
        }, { duration: 600, easing: 'easeOutBack', queue: false });
    });

    $('body').click(function () {
        $('#menu').stop(true, true).fadeIn(300);
        $('.menu').animate({
            'right': '-240px',
            'opacity': '0'
        }, { duration: 300, queue: false });
    });

    $('.menu a').click(function () {
        switch ($(this).attr('id')) {
            case "sair":
                $.ajax({
                    url: 'core.php',
                    type: 'POST',
                    data: { acao: 'desconecta' },
                    dataType: "html"
                }).done(function (data) {
                    $('.hds-content').fadeOut(600, function () {
                        $('.hds-postit-area .hds-postit').remove();
                        $('.new-postit').css({ 'top': '-200px', 'left': '-200px' });
                        $('.hds-logon').fadeIn(600, function () {
                            $('form[name=autenticacao] input[name=apelido]').focus();
                        });
                    });
                });
                break;
        }
    });

    var z_indexi = 1;
    $('#new').click(function () {

        //Define Postit no Centro
        var areaW = $('.hds-content .hds-postit-area').width();
        var areaH = $('.hds-content .hds-postit-area').height();
        var postitW = $('.hds-postit-model .hds-postit').width();
        var postitH = $('.hds-postit-model .hds-postit').height();
        var newposX = (areaW / 2) - (postitW / 2);
        var newposY = (areaH / 2) - (postitH / 2);

        $($('.hds-postit-model .hds-postit').clone()).appendTo('.hds-content .hds-postit-area').css({
            top: newposY,
            left: newposX,
            zIndex: z_indexi++
        }).draggable({
            containment: 'parent',
            handle: '.fixe',
            stack: '.hds-content .hds-postit-area .hds-postit',
            start: function () {
                tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
            },
            stop: function () {
                tinymce.activeEditor.getBody().setAttribute('contenteditable', true);
            }
        }).resizable({
            containment: 'parent',
            autoHide: true,
            minWidth: 390,
            minHeight: 260,
            animate: true,
            animateDuration: 'fast',
            animateEasing: 'easeOutCubic',
            start: function () {
                $(this).find('.fixe').hide();
            },
            stop: function () {
                $(this).find('.fixe').delay('fast').fadeIn('fast');
            }
        }).show('scale', {
            duration: 400,
            easing: 'easeOutBack',
            complete: function () {
                $(this).find('.fixe').fadeIn('fast');
                $(this).click(function () {
                    $(this).siblings().css('z-index');
                    $(this).css('z-index', z_indexi++);
                });
            }
        });

        tinymce.init({
            language: 'pt_BR',
            selector: '.hds-postit:last .textarea',
            inline: true,
            menubar: false,
            toolbar_items_size: 'small',
            plugins: [
                "advlist autolink link image lists charmap hr spellchecker",
                "searchreplace wordcount visualblocks visualchars media nonbreaking",
                "table contextmenu directionality emoticons textcolor paste"
            ],
            toolbar1: "fontselect | fontsizeselect | forecolor backcolor | table | charmap ",
            toolbar2: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | searchreplace "
        });
    });

    $(document).on('click', '.hds-postit #close', function () {
        $(this).parents('.hds-postit').find('.fixe, .textarea').hide();
        $(this).parents('.hds-postit').hide('puff', {
            duration: 400,
            easing: 'easeInBack',
            complete: function () {
                $(this).remove();
            }
        });
    });

    $(document).on('click', '.hds-postit .footer ul ul a', function () {
        var thisObj = $(this).parents('.hds-postit');
        thisObj.animate({ backgroundColor: $('span', this).css('background-color') }, 'fast');
        $('.footer ul ul', thisObj).animate({ backgroundColor: $('span', this).css('background-color') }, 'fast');
        $('.footer .color', thisObj).css('background-color', $('span', this).css('background-color'));
    });

    $('.hds-modal .nav button').click(function () {
        div_ativa = $('.hds-modal .main > div.active');
        div_ativar = $(this);
        if (div_ativa.attr('id') != div_ativar.attr('id')) {
            $('.hds-modal .nav button').attr('disabled', true);
            $('.hds-modal .nav button#' + div_ativa.attr('id')).parents('li.active').removeClass('active');
            $('.hds-modal .nav button#' + div_ativar.attr('id')).parents('li').addClass('active');
            div_ativa.hide('drop', 300, function () {
                $(this).removeClass('active');
                $('.hds-modal .main > div#' + div_ativar.attr('id')).show('drop', 300, function () {
                    $(this).addClass('active');
                    $('.hds-modal .nav button').attr('disabled', false);
                });
            })
        }
    });

    $('form[name=novousuario] input[name=foto]').change(function () {
        if ($('form[name=novousuario] input[name=foto]').val()) {
            //$('.hds-modal .box .nav ul li > button#feedback').click();
        }
    });

    $('form[name=novousuario] input').on('keyup', function () {
        if ($(this).val().length > 4) {
            $(this).css('border-left', '4px #01468b solid');
        }
    });

    $('form[name=novousuario]').ajaxForm({
        dataType: 'html',
        beforeSubmit: function () {

            nome = $('form[name=novousuario] input[name=nome]');
            sobrenome = $('form[name=novousuario] input[name=sobrenome]');
            email = $('form[name=novousuario] input[name=email]');
            apelido = $('form[name=novousuario] input[name=apelido]');
            senha = $('form[name=novousuario] input[name=senha]');
            vsenha = $('form[name=novousuario] input[name=verifica-senha]');
            foto = $('form[name=novousuario] input[name=foto]');
            btn_user = $('.hds-modal .box .nav ul li > button#user');
            btn_photo = $('.hds-modal .box .nav ul li > button#photo');
            btn_feed = $('.hds-modal .box .nav ul li > button#feedback');

            if (nome.val().length < 5) {
                nome.focus();
                nome.css('border-left', '4px #F00 solid');
                btn_user.click();
                return false;
            } else if (sobrenome.val().length < 5) {
                sobrenome.focus();
                sobrenome.css('border-left', '4px #F00 solid');
                btn_user.click();
                return false;
            } else if (email.val().length < 5) {
                email.focus();
                email.css('border-left', '4px #F00 solid');
                btn_user.click();
                return false;
            } else if (apelido.val().length < 5) {
                apelido.focus();
                apelido.css('border-left', '4px #F00 solid');
                btn_user.click();
                return false;
            } else if (senha.val().length < 5) {
                senha.focus();
                senha.css('border-left', '4px #F00 solid');
                btn_user.click();
                return false;
            } else if (vsenha.val().length < 5 || vsenha.val() != senha.val()) {
                vsenha.focus();
                vsenha.css('border-left', '4px #F00 solid');
                btn_user.click();
                return false;
            } else if (!foto.val()) {
                $('.hds-modal .box .nav ul li > button#photo').click();
                return false;
            } else {
                $('form[name=novousuario] input').attr('disabled', true);
            }

        },
        success: function (data) {
        }
    });
});