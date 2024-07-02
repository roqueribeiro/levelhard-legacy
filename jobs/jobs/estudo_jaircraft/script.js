$(document).ready(function() {

    const objClassName = $('.object');
    const areaClassName = $('.area');
    const objSize = 120;
    const pxMoveSize = 60;
    const pxMoveEffIn = 300;
    const pxMoveEffOut = 400;

    var pxMoveVelocity = 2000;

    var treeId = 0;
    var maxAreaX = areaClassName.width();
    var maxAreaY = areaClassName.height();

    $('.object').width(objSize).height(objSize);
    $('.object').css('top', maxAreaY - 140);
    $('.object').css('left', (maxAreaX / 2) - (objSize / 2));

    $(this).on('keyup', function(e) {
        e.preventDefault();
        switch (e.which) {
            case 37:
                $('button[name=moveLeft]:enabled').click();
                break;
            case 39:
                $('button[name=moveRight]:enabled').click();
                break;
        }
    });

    $('button[name=moveLeft]').click(function(e) {
        e.preventDefault();
        $('button').prop('disabled', true);
        moveObjLeft();
    });

    $('button[name=moveRight]').click(function(e) {
        e.preventDefault();
        $('button').prop('disabled', true);
        moveObjRight();
    });

    function moveObjLeft() {

        var posTransformX = objClassName.css('transform').split(',')[12];
        if (((posTransformX == null) ? 0 : posTransformX) > -240) {
            objClassName.transition({
                perspective: '100px',
                x: '-=' + pxMoveSize,
                rotateY: '-10deg'
            }, pxMoveEffIn).transition({
                rotateY: '0deg'
            }, pxMoveEffOut, function() {
                if (objClassName.css('transform').split(',')[12] < -240) {
                    moveObjRight();
                }
                $('button').prop('disabled', false);
            });
        }
        else {
            $('button').prop('disabled', false);
        }

    }

    function moveObjRight() {

        var posTransformX = objClassName.css('transform').split(',')[12];
        if (((posTransformX == null) ? 0 : posTransformX) < 240) {
            objClassName.transition({
                perspective: '100px',
                x: '+=' + pxMoveSize,
                rotateY: '10deg'
            }, pxMoveEffIn).transition({
                rotateY: '0deg'
            }, pxMoveEffOut, function() {
                if (objClassName.css('transform').split(',')[12] > 240) {
                    moveObjLeft();
                }
                $('button').prop('disabled', false);
            });
        }
        else {
            $('button').prop('disabled', false);
        }

    }

    function spawnTrees() {

        treeId++;

        var randomWidth = parseInt(Math.random() * 100);
        var leftElementSize = randomWidth / 2;
        var rightElementSize = 60 - leftElementSize;

        $('<div>', {
            'id': 'left-' + treeId,
            'class': 'tree tree-left',
            'style': 'width: ' + leftElementSize + '%'
        }).appendTo(areaClassName);

        $('<div>', {
            'id': 'right-' + treeId,
            'class': 'tree tree-right',
            'style': 'width: ' + rightElementSize + '%'
        }).appendTo(areaClassName);

        for (var i = 0; i <= 5; i++) {

            $('<img>', {
                'src': './tree-' + (Math.floor(Math.random() * 3) + 1) + '.png',
                'style': 'right: ' + (-20 + (i * (Math.floor(Math.random() * 11) + 40))) + 'px;',
                'alt': ''
            }).appendTo($('#left-' + treeId));

            $('<img>', {
                'src': './tree-' + (Math.floor(Math.random() * 3) + 1) + '.png',
                'style': 'left: ' + (-20 + (i * (Math.floor(Math.random() * 11) + 40))) + 'px;',
                'alt': ''
            }).appendTo($('#right-' + treeId));

        }

        if (treeId > 2) {
            $('.score').html(treeId - 3);
        }

        $(areaClassName).find('.tree').slice(0, -10).remove();

    }

    function moveTrees() {
        var objLenth = $(areaClassName).find('.tree').length;
        $(areaClassName).find('.tree').slice(objLenth - 2, objLenth).transition({
            y: '800px'
        }, pxMoveVelocity * 4, 'linear');
    }

    var int = setInterval(function() {
        spawnTrees();
        moveTrees();
    }, pxMoveVelocity);

    // ===== Accelerometer
    // window.addEventListener('deviceorientation', function(event) {
    //     if (Math.round(event.gamma) > 0) {
    //         objClassName.css('transform', 'translateX(' + Math.round(event.gamma) * 2.5 + 'px)');
    //     }
    //     else if (Math.round(event.gamma) < 0) {
    //         objClassName.css('transform', 'translateX(' + Math.round(event.gamma) * 2.5 + 'px)');
    //     }
    // });

});