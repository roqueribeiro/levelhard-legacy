$(document).ready(function () {

    var db = openDatabase('packageTracking', '1.0', 'Tracking of user-executed packages', 2 * 1024 * 1024);

    if (!db) {
        alert('Seu navegador não suporta a tecnologia necessária para gravar o histórico das consultas realizadas.');
    } else {
        db.transaction(function (tx) {
            tx.executeSql("CREATE TABLE IF NOT EXISTS searchResults (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, searchCode, timestamp REAL)");
        });
        listSearchResults(db);
    }

    $('form[name=searchPackageTracking]').ajaxForm({
        beforeSubmit: function () {
            $('#content_result').html('<p class="text-center"><i class="fa fa-cog fa-spin fa-fw"></i><span>Conectando...</span></p>');
            $('form[name=searchPackageTracking] button').attr('disabled', true);
        },
        success: function (data) {
            $('form[name=searchPackageTracking] button').attr('disabled', false);
            if (data != '') {
                $('#content_result').hide().html(data).fadeIn();
                db.transaction(function (tx) {
                    tx.executeSql("SELECT * FROM searchResults WHERE searchCode == '" + $('input[name=packageCode]').val() + "'", [], function (tx, results) {
                        if (results.rows.length == 0) {
                            tx.executeSql(
                                "INSERT INTO searchResults (searchCode, timestamp) VALUES (?,?) ",
                                ['' + $('input[name=packageCode]').val() + '', new Date().getTime()],
                                function (tx) {
                                    console.log(tx);
                                },
                                function (erro) {
                                    console.log(erro);
                                }
                            );
                        }
                    }, null);
                });
                listSearchResults(db);
            } else {
                $('#content_result').html('<p class="text-center text-danger"><i class="fa fa-meh-o" aria-hidden="true"></i><span> Nenhum resultado encontrado</span></p>');
            }
        },
        error: function () {
            $('#content_result').html('<p class="text-center text-danger"><i class="fa fa-meh-o" aria-hidden="true"></i><span> Houve um erro de comunicação com o servidor! Tente novamente mais tarde.</span></p>');
        }
    });
});

function listSearchResults(db) {
    $('#search_results').html('');
    db.transaction(function (tx) {
        tx.executeSql("SELECT * FROM searchResults", [], function (tx, results) {
            var len = results.rows.length;
            for (var i = 0; i < len; i++) {
                var searchCode = results.rows.item(i).searchCode;
                $('#search_results').append($("<a />", {
                    "href": "javascript:executeSearchByHistory('" + searchCode + "');",
                    "class": "btn btn-default btn-sm",
                    "html": searchCode
                }));
            }
        }, null);
    });
}

function executeSearchByHistory(searchCode) {
    $('input[name=packageCode]').val(searchCode);
    $('form[name=searchPackageTracking]').submit();
}