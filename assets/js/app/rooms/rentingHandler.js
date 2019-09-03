/*
===============================================================
======================LOCAL VARS AND PROCEDUR==================
===============================================================
*/
var MENUS_URL = 'renting/';

var divSpinner =
    '<div style="height:180px;">' +
    '<div class="spinloader">' +
    '</div>' +
    '</div>';

function getContent() {
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_calendar',
        cache: false,
        beforeSend: function () {
            $('#roomRenting').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#roomRenting').html(data);
        }
    });
    return false;
}

function afterCreateModal() {
    var startDate = $('input#startDateTemp').val();
    var endDate = $('input#endDateTemp').val();
    $('input#start').val(startDate);
    $('input#end').val(endDate);
    $('input#startDate').val(moment(startDate).format('dddd, DD-MM-YYYY HH:mm'));
    $('input#endDate').val(moment(endDate).format('dddd, DD-MM-YYYY HH:mm'));
    $('select#room').change(function () {
        $('#image-prev').attr('src', $('select#room option:selected').data('pic'));
    });
    $('#dateTempCreate').html('');
    $('form#createForm').parsley();
    $('form#createForm').on('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        if ($(this).parsley().isValid()) {
            var formData = new FormData(this);
            $.ajax({
                type: 'post',
                url: MENUS_URL + '/ajax_add/post',
                data: formData,
                cache: false,
                async: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data == 'sent') {
                        new PNotify({
                            title: 'Success',
                            text: 'Proposal has been sent successfully',
                            type: 'success',
                        });
                        $('#modalCreate').modal('hide');
                        getContent();
                    }
                    else {
                        new PNotify({
                            title: 'Error',
                            text: data,
                            type: 'warning',
                        });
                    }
                }
            });
            return false;
        }
    });
}

function afterReadModal() {
    $('#uniqueTempUpdate').html('');
    $('textarea#app_note').keyup(function () {
        var ID = $(this).data('id');
        var NOTE = $(this).val();
        $.ajax({
            type: 'post',
            url: MENUS_URL + 'ajax_approval_note_keyup',
            data: {
                id: ID,
                note: NOTE
            },
            cache: false
        });
        return false;
    });
    $('button.approveButton').on('click', function () {
        // console.log($(this).data('appr'));
        var ID = $(this).data('id');
        var APPR = $(this).data('appr');
        $.ajax({
            type: 'post',
            url: MENUS_URL + 'ajax_read/post',
            data: {
                id: ID,
                approved: APPR
            },
            cache: false,
            success: function (data) {
                if (data == 'updated') {
                    getContent();
                    new PNotify({
                        title: 'Success',
                        text: 'Booking has been replied successfully',
                        type: 'success',
                    });
                    $.ajax({
                        type: 'get',
                        url: MENUS_URL + 'ajax_read',
                        data: {
                            id: ID
                        },
                        cache: false,
                        beforeSend: function () {
                            $('#modalRead').find('.modal-content').html(divSpinner);
                        },
                        error: function () {
                            alert('There is an error when getting data.');
                        },
                        success: function (data) {
                            $('#modalRead').find('.modal-content').html(data);
                            afterReadModal();
                        }
                    });
                    return false;
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
    });
}

/*
===============================================================
==============================BIND=============================
===============================================================
*/

// direct
getContent();
$('[data-toggle="tooltip"]').tooltip();

// with trigger
$('button#refreshTable').on('click', function () {
    getContent();
});
$('select#myShow').change(function () {
    getContent();
});
$('select#statusShow').change(function () {
    getContent();
});
$('select#roomsShow').change(function () {
    getContent();
});


// reset modal
$('#modalCreate').on('hidden.bs.modal', function () {
    $('#modalCreate').find('.modal-content').html('');
});
$('#modalRead').on('hidden.bs.modal', function () {
    $('#modalRead').find('.modal-content').html('');
});

/*
===============================================================
=============================MODAL=============================
===============================================================
*/

$('#modalCreate').on('shown.bs.modal', function () {
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_add',
        cache: false,
        beforeSend: function () {
            $('#modalCreate').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalCreate').find('.modal-content').html(data);
            afterCreateModal();
        }
    });
    return false;
});

$('#modalRead').on('shown.bs.modal', function () {
    var ID = $('input#uniqueTemp').val();
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_read',
        data: {
            id: ID
        },
        cache: false,
        beforeSend: function () {
            $('#modalRead').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalRead').find('.modal-content').html(data);
            afterReadModal();
        }
    });
    return false;
});
