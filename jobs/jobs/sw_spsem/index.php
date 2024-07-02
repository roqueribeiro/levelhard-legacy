<?php

session_start();
//Se exister Session
$msSession = NULL;
if ($_SESSION) {
    $msSession = $_SESSION["usuario_cod"];
}

?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Yazaki apSem</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicons/favicon16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="images/favicons/favicon64.png" sizes="64x64" />
    <link rel="icon" type="image/png" href="images/favicons/favicon128.png" sizes="128x128" />
    <!-- CSS -->
    <link rel="stylesheet" href="styles/default/normalize.css" media="screen" />
    <link rel="stylesheet" href="styles/default/theme.css" media="screen" />
    <link rel="stylesheet" href="styles/default/jquery.jnotify.css" />
    <link rel="stylesheet" href="styles/default/jquery.qtip.css" />
    <link rel="stylesheet" href="styles/default/jquery-ui.css" />
    <link rel="stylesheet" href="styles/default/jquery.fancybox.css" />
    <link rel="stylesheet" href="scripts/jqwidgets/styles/jqx.base.css" />
    <link rel="stylesheet" href="scripts/jqwidgets/styles/jqx.classic.css" />
    <link rel="stylesheet" href="scripts/jqwidgets/styles/jqx.web.css" />
    <link rel="stylesheet" href="scripts/jqwidgets/styles/jqx.fresh.css" />
    <link rel="stylesheet" href="scripts/jqwidgets/styles/jqx.bootstrap.css" />
    <!-- jQuery -->
    <script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.cookie.js"></script>
    <script type="text/javascript" src="scripts/jquery.jnotify.js"></script>
    <script type="text/javascript" src="scripts/jquery.form.js"></script>
    <script type="text/javascript" src="scripts/jquery.qtip.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.fancybox.js"></script>
    <script type="text/javascript" src="scripts/jquery.transit.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="scripts/tinymce/tinymce.min.js"></script>
    <!-- jQuery jqxGrid -->
    <script type="text/javascript" src="scripts/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxtabs.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxmaskedinput.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxcalendar.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxdatetimeinput.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxnumberinput.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxwindow.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxgrid.sort.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxgrid.pager.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxgrid.selection.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxgrid.edit.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxgrid.columnsresize.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxgrid.filter.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqxgrid.grouping.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/globalization/jquery.global.js"></script>
    <!-- jQuery Page Scripts -->
    <script type="text/javascript">
        $(document).ready(function() {
            //Se Existir Sessão
            if ('<?php print $msSession ?>') {
                $('.login').remove();
                $.get('master.html', function(data) {
                    $('body').html(data);
                });
            }
            //Formulario de Login
            $('form[name=login]').ajaxForm({
                beforeSubmit: function() {
                    if (!$('input[name=usuario]').val()) {
                        $('input[name=usuario]').focus();
                        return false;
                    } else if (!$('input[name=senha]').val()) {
                        $('input[name=senha]').focus();
                        return false;
                    } else {
                        $('.login input').attr('disabled', 'disabled');
                        $('.login form').css({
                            'opacity': '0.2'
                        });
                    }
                },
                success: function(data) {
                    if (data == 1) {
                        $.get('master.html', function(data) {
                            $('body .login').fadeOut(400, function() {
                                $('body').html(data);
                                $('header.default, #main.default, footer.default').hide().fadeIn(400);
                            });
                        });
                    } else {
                        $('.login form').animate({
                            'opacity': '1'
                        }, function() {
                            $(this).effect('shake', 500, function() {
                                $('.login input').removeAttr('disabled');
                            });
                        });
                    }
                }
            });
        });
    </script>
</head>

<body>
    <div class="login">
        <fieldset>
            <legend><img class="logo" src="images/logo.png" /></legend>
            <form name="login" action="pages/login.php" method="post">
                <input type="hidden" name="action" value="auth" />
                <p><span><img src="images/icons/white/user_12x16.png" /></span><input type="text" name="usuario" placeholder="Usuario" /></p>
                <p><span><img src="images/icons/white/key_fill_16x16.png" /></span><input type="password" name="senha" placeholder="Senha" /></p>
                <p><input type="submit" value="Entrar"></p>
            </form>
            <p>Problemas para acessar? <a href="http://172.22.7.213:8080" target="_blank">Clique Aqui</a></p>
        </fieldset>
        <footer>
            <div class="browser">
                <p><b>Recommended Browser:</b> Chrome / Firefox</p>
            </div>
            <div class="information">
                <h3>YAZAKI Corporation</h3> Copyright © <b>YAZAKI Corporation</b> All Rights Reserved
            </div>
        </footer>
    </div>
</body>

</html>