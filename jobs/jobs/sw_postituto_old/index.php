<!DOCTYPE html>

<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Post It's</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/ui-lightness/jquery-ui.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/prefixfree.min.js"></script>
    <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $(window).load(function () {
                $('.hds-bg').show('fade', 1000);
                $('.hds-preloader').delay(800).fadeOut(600, function () {
                    $('.new-postit').animate({
                        'top': '-40px',
                        'left': '-40px',
                    }, 600, 'easeOutBack');
                });
            });

            $('#new').click(function () {

                $($('.hds-postit-model .hds-postit').clone()).appendTo('.hds-container').draggable({
                    containment: 'parent',
                    handle: '.fixe',
                    stack: '.hds-container .hds-postit',
                    snap: true,
                    grid: [20, 20],
                    snapTolerance: 15
                }).resizable({
                    containment: 'parent',
                    minWidth: 390,
                    minHeight: 310,
                    maxWidth: 600,
                    animate: true,
                    animateDuration: 'fast',
                    animateEasing: 'easeOutCubic',
                    grid: 20
                }).show('scale', 'fast');

                tinymce.init({
                    language: 'pt_BR',
                    selector: '.hds-postit:last .textarea',
                    inline: true,
                    menubar: false,
                    toolbar_items_size: 'small',
                    plugins: [
                        "advlist autolink autosave link image lists charmap hr spellchecker",
                        "searchreplace wordcount visualblocks visualchars media nonbreaking",
                        "table contextmenu directionality emoticons textcolor paste"
                    ],
                    toolbar1: "fontselect | fontsizeselect | forecolor backcolor | table | charmap ",
                    toolbar2: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | searchreplace "
                });

            });

            $(document).on('click', '.hds-postit #close', function () {
                $(this).parents('.hds-postit').hide('puff', 'fast');
            });

            $(document).on('click', '.hds-postit .footer ul ul a', function () {
                var thisObj = $(this).parents('.hds-postit');
                thisObj.animate({ backgroundColor: $('span', this).css('background-color') }, 'fast');
                $('.footer ul ul', thisObj).animate({ backgroundColor: $('span', this).css('background-color') }, 'fast');
                $('.footer .color', thisObj).css('background-color', $('span', this).css('background-color'));
            });
        });
    </script>
</head>
<body>
    <div class="hds-bg"></div>
    <div class="hds-container">

        <div id="new" class="new-postit"></div>

        <div class="hds-preloader">
            <div class="pre-anime">L</div>
            <div class="pre-anime">O</div>
            <div class="pre-anime">A</div>
            <div class="pre-anime">D</div>
            <div class="pre-anime">I</div>
            <div class="pre-anime">N</div>
            <div class="pre-anime">G</div>
        </div>

        <div class="hds-postit-model">
            <div class="hds-postit">
                <div class="fixe"></div>
                <div class="box">
                    <div class="header">
                        <div class="title">
                            <input type="text" />
                        </div>
                        <div class="control">
                            <input id="close" type="button" value="&#x2715" />
                        </div>
                    </div>
                    <div class="main">
                        <div class="textarea"></div>
                    </div>
                    <div class="footer">
                        <ul>
                            <li><a href="javascript:void();"><span class="color" style="background: #f8ec52"></span></a>
                                <ul>
                                    <li><a href="javascript:void();"><span style="background: #c4ffa5"></span></a></li>
                                    <li><a href="javascript:void();"><span style="background: #ffd3d3"></span></a></li>
                                    <li><a href="javascript:void();"><span style="background: #9ab4f1"></span></a></li>
                                    <li><a href="javascript:void();"><span style="background: #fafafa"></span></a></li>
                                    <li><a href="javascript:void();"><span style="background: #f8ec52"></span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
