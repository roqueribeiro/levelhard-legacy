$(document).ready(function () {

    $("body").niceScroll({
        cursorcolor: '#AAA',
        cursoropacitymax: 0.6,
        cursorwidth: 10,
        cursorborder: 'none',
        cursorborderradius: '0px',
        boxzoom: true,
        dblclickzoom: true,
        gesturezoom: true,
        bouncescroll: true,
        railpadding: {
            top: 5,
            right: 5,
            left: 5,
            bottom: 5
        }
    });

    // =========== Definicoes dos Plugins
    $(".formulario ul li select").select2();
    $("input[name=cadastro_nascimento]").datepicker({ format: 'dd/mm/yyyy', language: 'pt-BR' });

    // =========== Aplicacao de mascaras e validacoes
    $("input[name=cadastro_nascimento]").mask('00/00/0000');
    //Valida CPF
    var vpfIsValid = false;
    $("input[name=cadastro_cpf]").mask('000.000.000-00', {
        onKeyPress: function (value) {
            value = value.replace('.', '');
            value = value.replace('.', '');
            cpf = value.replace('-', '');
            while (cpf.length < 11) cpf = "0" + cpf;
            var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
            var a = [];
            var b = new Number;
            var c = 11;
            for (i = 0; i < 11; i++) {
                a[i] = cpf.charAt(i);
                if (i < 9) b += (a[i] * --c);
            }
            if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11 - x }
            b = 0;
            c = 11;
            for (y = 0; y < 10; y++) b += (a[y] * c--);
            if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11 - x; }
            vpfIsValid = true;
            if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) vpfIsValid = false;
        }
    }).blur(function () {
        if ($(this).val()) {
            if (!vpfIsValid) {
                $(this).val('');
                $('.notification').jnotifyAddMessage({
                    text: 'CPF Inválido! Verifique se o CPF digitado está correto.',
                    type: 'error',
                    permanent: false,
                });
            }
        }
    });
    $("input[name=cadastro_rg]").mask('00.000.000', { clearIfNotMatch: true });
    //Valida nono digito Celular
    $("input[name=cadastro_telefone]").mask('(00) 0000-0000', { clearIfNotMatch: true });
    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    }, spOptions = {
        onKeyPress: function (val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    $("input[name=cadastro_celular]").mask(SPMaskBehavior, spOptions).blur(function () {
        if ($(this).val().replace(/\D/g, '').length < 10) $(this).val('');
    });
    $("input[name=cadastro_cep]").mask('00000-000', { clearIfNotMatch: true });
    //Valida email
    $("input[name=cadastro_email]").blur(function () {
        if ($(this).val()) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test($(this).val())) {
                $(this).val('');
                $('.notification').jnotifyAddMessage({
                    text: 'E-Mail Inválido! Verifique se o E-Mail digitado está correto.',
                    type: 'error',
                    permanent: false,
                });
            }
        }
    });

});