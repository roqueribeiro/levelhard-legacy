$(document).ready(function () {

    //Carregamento da pagina principal
    accessUrlAjax({ url: "_template_home" });

    //Carregar pagina pelo menu principal
    $(document).on("click", "._template_home_content ._template_home_content_menu > div", function () {
        accessUrlAjax({ url: $(this).data("url") });
    });

    //Retornar a pagina principal
    $(document).on("click", "#_btn_return", function () {
        accessUrlAjax({ url: "_template_home" });
    });

    // =========== _template_gallery Begin
    $(document).on("click", "#_template_gallery > ._dropdown_menu a", function () {
        if ($(this).parent().find("ul").length == 0) {
            if ($(this).data("path") != undefined) {
                $.ajax({
                    async: true,
                    method: "POST",
                    url: "codes/_template_gallery.php",
                    data: {
                        varUserAction: "getGalleryImageFiles",
                        varActivePath: $(this).data("path") + "/"
                    },
                    cache: false,
                    dataType: "json",
                    beforeSend: function (xhr) {
                        $("#_template_gallery > ._template_gallery_content > section").find("a").hide();
                        $("body > preloader").show().transition({ opacity: 1 }, 300);
                    }
                }).done(function (data, textStatus, jqXHR) {
					
					//console.log(data);
					
                    $("body > preloader").transition({ opacity: 0 }, 600, function () {
                        $(this).hide();
                        $("#_template_gallery > preloader").show().css("visibility", "visible").transition({ opacity: 1 }, 300);
                        $("#_template_gallery > preloader p").show().transition({ opacity: 1, scale: 1.0 }, 0);
                        $("#_template_gallery > preloader p").html(0);
                        $("#_template_gallery > ._template_gallery_content > section").find("a").remove();
                        $.each(data, function (index, value) {
                            $("<a />", {
                                "data-fancybox": "gallery",
                                "href": value.image,
                                "html": [
                                    $("<img />", {
                                        "src": value.thumb,
                                        "alt": value.filename
                                    }).transition({
                                        opacity: 0
                                    }, 0)
                                ]
                            }).appendTo("#_template_gallery > ._template_gallery_content > section");
                        });
                        $("img").preload(function (perc, done) {
                            $(this).transition({
                                opacity: 1
                            }, 1000, "snap");
                            $("#_template_gallery > preloader p").html(perc.toFixed());
                            if (done) {
                                $("#_template_gallery > preloader p").transition({
                                    opacity: 0,
                                    scale: 2.0
                                }, 600, "ease", function () {
                                    $("#_template_gallery > preloader").transition({
                                        opacity: 0
                                    }, 1000, function () {
                                        $(this).hide();
                                    });
                                });
                            }
                        });
                    });
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    fancyboxModal({
                        title: "Problemas!",
                        message: "Ocorreu um erro ao tentar acessar o caminho solicitado! Tente novamente mais tarde... <br /><br />Erro: " + jqXHR.status + "<br />Sobre: " + jqXHR.statusText,
                        callback: function (value) {
                            accessUrlAjax({ url: "_template_gallery" });
                        }
                    });
                }).always(function () {
                });
            }
        }
    });

    $(document).on("mouseenter", "#_template_gallery a", function () {
        $("img", this).stop(true, true).transition({
            perspective: "600px",
            rotateX: "12deg",
            opacity: 0.8,
            scale: 0.95
        }, 200, "ease");
    });

    $(document).on("mouseleave", "#_template_gallery a", function () {
        $("img", this).stop(true, true).transition({
            rotateX: "0deg",
            opacity: 1,
            scale: 1
        }, 100, "ease");
    });

    // =========== _template_gallery End

});

$.fn.preload = function (fn) {
    var len = this.length, i = 0;
    return this.each(function () {
        var tmp = new Image, self = this;
        if (fn) tmp.onload = function () {
            fn.call(self, 100 * ++i / len, i === len);
        };
        tmp.src = this.src;
    });
};

function accessUrlAjax(opts) {
    $.ajax({
        async: true,
        method: "POST",
        url: "screens/" + opts.url + ".html",
        cache: false,
        dataType: "html",
        beforeSend: function (xhr) {
            $("body > main > content > div").transition({ opacity: 0 }, 300);
            $("body > preloader").show().transition({ opacity: 1 }, 300);
        }
    }).done(function (data, textStatus, jqXHR) {
        $("body > preloader").transition({ opacity: 0 }, 600, function () {
            $(this).hide();
            $("body > main > content").html(data);
            $("body > main > content > div").hide().transition({ opacity: 0 }, 0);
            $("body > main > content > div").show().transition({ opacity: 1 }, 600);
        });
    }).fail(function (jqXHR, textStatus, errorThrown) {
        fancyboxModal({
            title: "Problemas!",
            message: "Ocorreu um erro ao tentar acessar o caminho solicitado! Tente novamente mais tarde... <br /><br />Erro: " + jqXHR.status + "<br />Sobre: " + jqXHR.statusText,
            callback: function (value) {
                accessUrlAjax({ url: "_template_home" });
            }
        });
    }).always(function () {
    });
}

function fancyboxModal(opts) {
    $.fancybox.open(
        "<div class=\"fancybox_modal\">" +
            "<h3>" + opts.title + "</h3>" +
            "<p>" + opts.message + "</p>" +
            "<p class=\"tright\">" +
                "<button data-value=\"1\" data-fancybox-close>Fechar</button>" +
            "</p>" +
        "</div>", {
            smallBtn: false,
            buttons: false,
            keyboard: false,
            afterClose: function (instance, e) {
                var button = e ? e.target || e.currentTarget : null;
                var value = button ? $(button).data("value") : 0;
                opts.callback(value);
            }
        }
    );
}