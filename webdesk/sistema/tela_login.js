//Menu Login Funcoes Iniciais
$('#tela_login #logo').hide();
$('#tela_login #login_menu').css({
    'right': '-314px',
    'opacity': '0'
});
$('#tela_login #autentica, #tela_login #cadastro').hide();
$('#tela_login #login_menu').animate({
    'opacity': '1'
}, 1000);
$('#tela_login #logo').show();
$('#cobertor_degrade, #preloader').delay(600).fadeOut(600);
//Abre Menu Login
$('#tela_login #login_menu #ativa').mouseover(function() {
    $('#cobertor').show();
    $('#cobertor_login').fadeIn(300);
    $('#tela_login #login_menu').animate({
        'right': '0px'
    }, 300);
    $('#tela_login #autentica, #tela_login #cadastro').show('drop', {
        direction: 'right'
    }, 600, function() {
        $('#tela_login input[name=usuario]').focus();
        $('#cobertor').hide();
    });
});
//Esconde Menu Login com Click
$('#tela_login #login_menu #ativa, #cobertor_login').click(function() {
    $('#cobertor').show();
    $('#cobertor_login').fadeOut(600);
    $('#tela_login #login_menu').animate({
        'right': '-314px'
    }, 600, function() {
        $('#cobertor').hide();
    });
    $('#tela_login #autentica, #tela_login #cadastro').hide('drop', {
        direction: 'right'
    }, 300);
});
//Efeito Hover no Menu Ativa
$('#tela_login #login_menu #ativa').hover(function() {
    $(this).animate({
        backgroundColor: '#255562'
    }, {
        queue: false,
        duration: 300
    });
}, function() {
    $(this).animate({
        backgroundColor: '#3b636e'
    }, {
        queue: false,
        duration: 300
    });
});
//Executa Login e Confere Usuario
$('form[name=autentica]').ajaxForm({
    url: 'core.php',
    data: {
        'acao': 'verifica_usuario'
    },
    type: 'GET',
    beforeSubmit: function() {
        $('#tela_login input').attr('disabled', 'disabled');
        if (!$('#tela_login input[name=usuario]').val()) {
            $('#tela_login input').removeAttr('disabled');
            $('#tela_login input[name=usuario]').focus();
            return false;
        } else if (!$('#tela_login input[name=senha]').val()) {
            $('#tela_login input').removeAttr('disabled');
            $('#tela_login input[name=senha]').focus();
            return false;
        }
    },
    success: function(data) {
        if (data == 'aceito') {
            $('#cobertor_degrade, #preloader').show();
            $.ajax({
                url: 'core.php',
                data: {
                    'acao': 'tela_sistema'
                }
            }).done(function(data) {
                $('#corpo').html(data);
                $('#cobertor_degrade, #preloader').fadeOut(300);
            });
        } else {
            $('#tela_login input').removeAttr('disabled');
            $('#tela_login input[name=usuario]').focus();
            $('#tela_login #autentica').effect('shake', {
                percent: 80
            }, 600);
        }
    }
});

$('#cadastro input').qtip({
    position: {
        my: 'right center',
        at: 'left center'
    },
    style: {
        width: 180,
    },
    show: {
        event: 'focus'
    },
    hide: {
        event: 'blur'
    }
});

$('#tela_login input[name=usr_usuario]').mask('******?******', {
    placeholder: ''
});
$('#tela_login input[name=usr_senha]').mask('******?**', {
    placeholder: ''
});

$('form[name=cadastro]').ajaxForm({
    url: 'core.php',
    data: {
        'acao': 'cadastro_usuario'
    },
    type: 'GET',
    beforeSubmit: function() {
        //Desativa Campos
        $('#tela_login input').attr('disabled', 'disabled');
        //Verifica Campo Nome
        if (!$('#tela_login input[name=usr_nome]').val()) {
            $('#tela_login input').removeAttr('disabled');
            $('#tela_login input[name=usr_nome]').focus();
            return false;
        }
        //Verifica Campo Usuario
        else if (!$('#tela_login input[name=usr_usuario]').val()) {
            $('#tela_login input').removeAttr('disabled');
            $('#tela_login input[name=usr_usuario]').focus();
            return false;
        }
        //Verifica Campo Senha
        else if (!$('#tela_login input[name=usr_senha]').val()) {
            $('#tela_login input').removeAttr('disabled');
            $('#tela_login input[name=usr_senha]').focus();
            return false;
        }
        //Verifica Campo Ver Senha
        else if (!$('#tela_login input[name=usr_senha_ver]').val()) {
            $('#tela_login input').removeAttr('disabled');
            $('#tela_login input[name=usr_senha_ver]').focus();
            return false;
        }
        //Verifica as Senhas
        else if ($('#tela_login input[name=usr_senha]').val() != $('#tela_login input[name=usr_senha_ver]').val()) {
            $('#tela_login input').removeAttr('disabled');
            windowOpen(2, 'erro', 'Alerta', '<p style="padding:40px 0px;">As senhas não são idênticas!</p>', '340px', '200px', 0, 0);
            return false;
        }
        //Verifica Campo Email
        else if (!$('#tela_login input[name=usr_email]').val()) {
            $('#tela_login input').removeAttr('disabled');
            $('#tela_login input[name=usr_email]').focus();
            return false;
        }
    },
    success: function(data) {
        $('#tela_login input').removeAttr('disabled');
        if (!data) {
            windowOpen(2, 'existe', 'Alerta', '<p style="padding:40px 0px;">Login escolhido esta em uso!</p>', '340px', '200px', 0, 0);
            $('#tela_login input[name=usr_usuario]').focus();
        }
        if (data) {
            windowOpen(2, 'aceito', 'Alerta', '<p style="padding:40px 0px;">Usuario Cadastrado com Sucesso!</p>', '340px', '200px', 0, 0);
            $('#tela_login input[type=text], #tela_login input[type=password]').val('');
            $('#tela_login input[name=usuario]').focus();
        }
        if (!data) {
            windowOpen(2, 'erro', 'Alerta', '<p style="padding:40px 0px;">Erro no Cadastro, Tente mais Tarde!</p>', '340px', '200px', 0, 0);
        }
    }
});