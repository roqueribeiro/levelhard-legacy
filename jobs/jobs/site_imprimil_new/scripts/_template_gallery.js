$(document).ready(function () {

    $.ajax({
        async: true,
        method: "POST",
        url: "codes/_template_gallery.php",
        data: {
            varUserAction: "getGalleryDirectories"
        },
        cache: false,
        dataType: "json",
        beforeSend: function (xhr) {
            $("#_template_gallery > ._dropdown_menu").html("<ul><li><a href='javascript:void(0);'>Carregando...</a></li></ul>");
        }
    }).done(function (data, textStatus, jqXHR) {
        $("#_template_gallery > ._dropdown_menu").html($("<ul />", { "id": "gallery" }));
        $.each(data, function (index, value) {
            if (value.father != "gallery") {
                if ($("#_template_gallery > ._dropdown_menu").find("[data-id='" + value.father + "']").parent().find("ul").length == 0) {
                    $("<ul />", {
                        "id": value.father
                    }).appendTo($("#_template_gallery > ._dropdown_menu").find("[data-id='" + value.father + "']").parent());
                }
            }
            $("<li />", {
                "html": $("<a />", {
                    "href": "javascript:void(0);",
                    "data-id": value.name,
                    "data-father": value.father,
                    "data-path": value.relative,
                    "text": value.name
                })
            }).appendTo("#_template_gallery > ._dropdown_menu #" + value.father);
        });
    }).fail(function (jqXHR, textStatus, errorThrown) {
    }).always(function () {
    });

});

