(function ($) {

    $.fn.jcontextMenu = function (options) {

        $('body').contextmenu(function () { return false; });

        var element = this,
            mouseposX = -1,
            mouseposY = -1;

        var defaults = {
            bgcolor: 'transparent',
            zindex: '9999',
            itens: {
                'default': {
                    title: 'Sample Action',
                    icon: 'fa fa-refresh',
                    callback: function () {
                        alert('Action');
                    }
                }
            }
        };

        var settings = $.extend({}, defaults, options);

        $(window).mousemove(function (event) {
            mouseposX = event.pageX;
            mouseposY = event.pageY;
        });

        element.mousedown(function (event) {
            if (mouseposX != -1 && mouseposY != -1) {
                var clicked_element = $(this);
                if (event.which == 3) {
                    $('<div>', {
                        'class': 'jcm-overlay'
                    }).css({
                        'position': 'fixed',
                        'top': '0px',
                        'left': '0px',
                        'right': '0px',
                        'bottom': '0px',
                        'background': settings.bgcolor,
                        'z-index': settings.zindex
                    }).appendTo('body');

                    $('<ul>', {
                        'class': 'jcm-context dropdown-menu',
                    }).css({
                        'top': mouseposY,
                        'left': mouseposX
                    }).appendTo('body > .jcm-overlay');

                    var tmp_icon = '';
                    var callbacks = $.Callbacks();

                    $.each(settings.itens, function (i, item) {

                        if (item.type == 'header') {
                            $('<li>', {
                                'class': 'dropdown-header',
                                'text': item.title
                            }).appendTo('body > .jcm-overlay > ul');
                        }

                        if (item.type == 'action') {
                            if (clicked_element.data(i) == 'hidden') {
                            }
                            else if (clicked_element.data(i) == 'disabled') {
                                if (item.icon) {
                                    tmp_icon = '<i class="' + item.icon + '" style="width: 30px;"></i>';
                                }
                                $('<li>', {
                                    'class': 'disabled',
                                    'html': '<a href="">' + tmp_icon + item.title + '</a>'
                                }).appendTo('body > .jcm-overlay > ul');
                            }
                            else {
                                if (item.icon) {
                                    tmp_icon = '<i class="' + item.icon + '" style="width: 30px;"></i>';
                                }
                                $('<li>', {
                                    'html': '<a href="">' + tmp_icon + item.title + '</a>'
                                }).appendTo('body > .jcm-overlay > ul').click(function (e) {
                                    e.preventDefault();
                                    callbacks.add(item.callback);
                                    callbacks.fire(clicked_element);
                                });
                            }
                        }

                        if (item.type == 'divider') {
                            $('<li>', {
                                'class': 'divider'
                            }).appendTo('body > .jcm-overlay > ul');
                        }

                    })

                    var overlay = $('.jcm-overlay');
                    var context = $('.jcm-context');

                    var objTop = parseInt(context.css('top').replace('px', ''));
                    var objLeft = parseInt(context.css('left').replace('px', ''));
                    var objWidth = context.width();
                    var objHeight = context.height();
                    var areaWidth = $(document).width();
                    var areaHeight = $(document).height();

                    if ((objTop + objHeight) + 40 > areaHeight) {
                        context.css('top', (objTop - objHeight) - 15);
                    }

                    if ((objLeft + objWidth) + 40 > areaWidth) {
                        context.css('left', (objLeft - objWidth));
                    }

                    context.fadeIn('fast');

                    overlay.click(function () {
                        context.stop(true, false).fadeOut(100, function () {
                            overlay.remove();
                        });
                    });
                }
            }
        });
    };
})(jQuery);