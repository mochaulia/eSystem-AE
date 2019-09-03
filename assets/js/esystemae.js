function countUnreadMsg() {
    if ($('input#urlCountUnreadMsg').length) {
        var URL = $('input#urlCountUnreadMsg').val();
        $.ajax({
            type: 'get',
            url: URL,
            cache: false,
            success: function (data) {
                if (parseInt(data) > 0) {
                    $('span#countUnreadMsg').addClass('badge bg-green');
                    $('span#countUnreadMsg').html(data);
                }
                else {
                    $('span#countUnreadMsg').removeClass('badge bg-green');
                    $('span#countUnreadMsg').html('')
                }
            }
        });
    }
}

function notifUnreadMsg() {
    if ($('input#urlNotifUnreadMsg').length) {
        var URL = $('input#urlNotifUnreadMsg').val();
        $.ajax({
            type: 'get',
            url: URL,
            cache: false,
            success: function (data) {
                $('ul#notifUnreadMsg').html(data);
            }
        });
    }
}

function roomPendingCount() {
    if ($('input#urlRoomPendingCount').length) {
        var URL = $('input#urlRoomPendingCount').val();
        $.ajax({
            type: 'get',
            url: URL,
            cache: false,
            success: function (data) {
                if (parseInt(data) > 0) {
                    $('span#roomPendingCount').addClass('label label-success pull-right');
                    $('span#roomPendingCount').html(data);
                }
                else {
                    $('span#roomPendingCount').removeClass('label label-success pull-right');
                    $('span#roomPendingCount').html('')
                }
            }
        });
    }
}

countUnreadMsg();
setInterval(function () {
    countUnreadMsg();
}, 3000);
notifUnreadMsg();
setInterval(function () {
    notifUnreadMsg()
}, 3000);
roomPendingCount();
setInterval(function () {
    roomPendingCount();
}, 3000);