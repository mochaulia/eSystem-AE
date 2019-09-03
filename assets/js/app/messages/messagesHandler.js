var MENUS_URL = $('input#ajaxGet').val() + '/';

var divSpinner =
    '<div style="height:100px;">' +
    '<div class="spinloader">' +
    '</div>' +
    '</div>';

function readMsg(id) {
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_read',
        cache: false,
        data: {
            id: id
        },
        beforeSend: function () {
            $('#readRight').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#readRight').html(data);
            afterReadMessage();
            getMessages(false);
        }
    });
    return false;
}

function getLastUri() {
    var uri;
    var last_uri = window.location.pathname.split('/').pop();
    if (last_uri == 'inbox.ae' || last_uri == 'inbox') {
        uri = 'inbox';
    }
    else if (last_uri == 'sents.ae' || last_uri == 'sents') {
        uri = 'sents';
    }
    else if (last_uri == '') {
        var key;
        var key_cek = window.location.pathname.lastIndexOf('/') - 3;
        if (window.location.pathname.substr(key_cek) == '.ae/') {
            key = window.location.pathname.lastIndexOf('/') - 8;
            uri = window.location.pathname.substr(key).split('.')[0];

        }
        else {
            key = window.location.pathname.lastIndexOf('/') - 5;
            uri = window.location.pathname.substr(key, 5);
        }
    }
    return uri;
}

function urlGetParams(name, url) {
    if (!url) url = location.href;
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(url);
    return results == null ? null : results[1];
}

function checkGetUrl() {
    var msg_id = urlGetParams('read');
    if (msg_id !== null) {
        readMsg(window.atob(msg_id));
    }
}

function afterGetMessages() {
    $('.readMsg').on('click', function (e) {
        e.preventDefault();
        readMsg($(this).data('id'));
    });
}

function afterReadMessage() {
    $('.showReplyFor').on('click', function (e) {
        e.preventDefault();
        var ID = $(this).data('reply-id');
        $.ajax({
            type: 'get',
            url: MENUS_URL + 'ajax_reply_for',
            cache: false,
            data: {
                id: ID
            },
            beforeSend: function () {
                $('#replyForDiv' + ID).html(divSpinner);
            },
            error: function () {
                alert('There is an error when getting data.');
            },
            success: function (data) {
                $('#replyForDiv' + ID).html(data);
                afterReadMessage();
            }
        });
        return false;
    });
}

function afterModalCompose() {
    var resources = {
        url: MENUS_URL + 'json_users',
        getValue: function (json) {
            $('input[name="id_to"]').val(json.id)
            return json.email;
        },
        list: {
            match: {
                enabled: true
            }
        }
    };
    $("input#email_to").easyAutocomplete(resources);
    tinymce.remove();
    tinymce.init({
        selector: 'textarea',
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste wordcount"
        ],
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
    });
    $('form#createForm').parsley();
    $('form#createForm').on('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        tinyMCE.triggerSave();
        if ($(this).parsley().isValid()) {
            var URI;
            ($('input[name="reply_for"]').length) ? URI = '/reply' : URI = '';
            $.ajax({
                type: 'post',
                url: MENUS_URL + 'ajax_post' + URI,
                data: $('form#createForm').serialize(),
                cache: false,
                success: function (data) {
                    if (data == 'sent') {
                        new PNotify({
                            title: 'Success',
                            text: 'Message sent',
                            type: 'success',
                        });
                        $('#modalCompose').modal('hide');
                    }
                    else if (data == 'null') {
                        new PNotify({
                            title: 'Error',
                            text: 'Message cannot be empty',
                            type: 'warning',
                        });
                    }
                    else {
                        new PNotify({
                            title: 'Error',
                            text: 'An unknown error accoured',
                            type: 'warning',
                        });
                    }
                }
            });
            return false;
        }
    });
}

function successDelete(data) {
    if (data == 'success') {
        new PNotify({
            title: 'Success',
            text: 'Message deleted',
            type: 'success',
        });
        $('#modalDelete').modal('hide');
        $('#readRight').html('');
    }
}

function afterModalDelete() {
    var deleteFor;
    var msg_id = $('input#messageID').val();
    $('.deleteFor').on('click', function () {
        deleteFor = $(this).data('sel');
        $.ajax({
            type: 'post',
            url: MENUS_URL + 'ajax_delete/delete',
            data: {
                id: msg_id,
                for: deleteFor
            },
            cache: false,
            success: function (data) {
                successDelete(data);
            }
        });
    });
    $('#toTrash').on('click', function () {
        $.ajax({
            type: 'post',
            url: MENUS_URL + 'ajax_delete/trash',
            data: {
                id: msg_id
            },
            cache: false,
            success: function (data) {
                successDelete(data);
            }
        });
    });
}

function getMessages(spin = true, error = true) {
    var URI = '/' + getLastUri();
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_get' + URI,
        cache: false,
        beforeSend: function () {
            if (spin) {
                $('#messagesLeft').html(divSpinner);
            }
        },
        error: function () {
            if (error) {
                alert('There is an error when getting data.');
            }
        },
        success: function (data) {
            $('#messagesLeft').html(data);
            afterGetMessages();
        }
    });
    return false;
}

checkGetUrl();
getMessages();
setInterval(function () {
    getMessages(false, false)
}, 2500);
$('#modalCompose').on('hidden.bs.modal', function () {
    $('#modalCompose').find('.modal-content').html('');
});
$('#modalDelete').on('hidden.bs.modal', function () {
    $('#modalDelete').find('.modal-content').html('');
});

$('#modalCompose').on('shown.bs.modal', function (e) {
    var DATA;
    var ID = $(e.relatedTarget).data('msg-id');
    var FROM = $(e.relatedTarget).data('from-id');
    if ((ID === undefined || ID === null) && (FROM === undefined || FROM === null)) {
        DATA = {}
    }
    else {
        DATA = {
            reply_for: ID,
            id_to: FROM
        }
    }
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_create',
        data: DATA,
        cache: false,
        beforeSend: function () {
            $('#modalCompose').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalCompose').find('.modal-content').html(data);
            afterModalCompose();
        }
    });
    return false;
});

$('#modalDelete').on('shown.bs.modal', function (e) {
    var ID = $(e.relatedTarget).data('msg-id');
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_delete',
        data: {
            id: ID
        },
        cache: false,
        beforeSend: function () {
            $('#modalDelete').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalDelete').find('.modal-content').html(data);
            afterModalDelete();
        }
    });
    return false;
});