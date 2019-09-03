/*
===============================================================
======================LOCAL VARS AND PROCEDUR==================
===============================================================
*/
var MENUS_URL = 'academic_schedule/';

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
            $('#academicSchedule').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#academicSchedule').html(data);
        }
    });
    return false;
}

function afterCreateModal() {
    $('#colorPick').colorpicker();
    $('form#createForm').append(
        $('<input>', {
            type: 'hidden',
            id: 'startDate',
            name: 'startDate',
            val: $('input#startDateTemp').val()
        })
    );
    $('form#createForm').append(
        $('<input>', {
            type: 'hidden',
            id: 'endDate',
            name: 'endDate',
            val: $('input#endDateTemp').val()
        })
    );
    $('#dateTempCreate').html('');
    $('form#createForm').parsley();
    $('form#createForm').on('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        if ($(this).parsley().isValid()) {
            $.ajax({
                type: 'post',
                url: MENUS_URL + 'ajax_add/post',
                data: $('form#createForm').serialize(),
                cache: false,
                success: function (data) {
                    if (data == 'success') {
                        new PNotify({
                            title: 'Success',
                            text: 'Data has been created successfully',
                            type: 'success',
                        });
                        $('#modalCreate').modal('hide');
                        getContent();
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

function afterEditModal() {
    $('#uniqueTempUpdate').html('');
    $('#colorPick').colorpicker();
    $('form#editForm').parsley();
    $('form#editForm').on('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            type: 'post',
            url: MENUS_URL + 'ajax_edit/post',
            data: $('form#editForm').serialize(),
            cache: false,
            success: function (data) {
                if (data == 'success') {
                    new PNotify({
                        title: 'Success',
                        text: 'Data has been updated successfully',
                        type: 'success',
                    });
                    $('#modalEdit').modal('hide');
                    getContent();
                }
                else if (data == 'null') {
                    new PNotify({
                        title: 'Error',
                        text: 'Content cannot be null',
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

// reset modal
$('#modalCreate').on('hidden.bs.modal', function () {
    $('#modalCreate').find('.modal-content').html('');
});
$('#modalEdit').on('hidden.bs.modal', function () {
    $('#modalEdit').find('.modal-content').html('');
});
$('#modalDelete').on('hidden.bs.modal', function () {
    $('#modalDelete').find('.modal-content').html('');
});
$('#modalAddYear').on('hidden.bs.modal', function () {
    $('#modalAddYear').find('.modal-content').html('');
});
$('#modalAddClass').on('hidden.bs.modal', function () {
    $('#modalAddClass').find('.modal-content').html('');
});
$('select#yearShow').on('change', function () {
    getContent();
});
$('select#classShow').on('change', function () {
    getContent();
});

/*
===============================================================
=============================MODAL=============================
===============================================================
*/

$('#modalCreate').on('shown.bs.modal', function (e) {
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

$('#modalEdit').on('shown.bs.modal', function (e) {
    var ID = $('input#uniqueTemp').val();
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_edit',
        data: {
            id: ID
        },
        cache: false,
        beforeSend: function () {
            $('#modalEdit').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalEdit').find('.modal-content').html(data);
            afterEditModal();
        }
    });
    return false;
});

$('#modalEdit').on('shown.bs.modal', function () {
    var ID = $('input#uniqueTemp').val();
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_edit',
        data: {
            id: ID
        },
        cache: false,
        beforeSend: function () {
            $('#modalEdit').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalEdit').find('.modal-content').html(data);
            afterEditModal();
        }
    });
    return false;
});

$('#modalAddYear').on('shown.bs.modal', function () {
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_add_comp/year_',
        cache: false,
        beforeSend: function () {
            $('#modalAddYear').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalAddYear').find('.modal-content').html(data);
            $('form#addYearForm').parsley();
            $('form#addYearForm').on('submit', function (e) {
                e.preventDefault();
                e.stopPropagation();
                if ($(this).parsley().isValid()) {
                    $.ajax({
                        type: 'post',
                        url: MENUS_URL + 'ajax_add_comp/year_post',
                        data: $('form#addYearForm').serialize(),
                        cache: false,
                        success: function (data) {
                            var id = data;
                            var ht = '<option value="' + id + '">' +
                                $('input#name_comp').val() +
                                '</option>';
                            $('select#year').append(ht);
                            $('#modalAddYear').modal('hide');
                        }
                    });
                    return false;
                }
            });
        }
    });
    return false;
});

$('#modalAddClass').on('shown.bs.modal', function () {
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_add_comp/class_',
        cache: false,
        beforeSend: function () {
            $('#modalAddClass').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalAddClass').find('.modal-content').html(data);
            $('form#addYearForm').parsley();
            $('form#addYearForm').on('submit', function (e) {
                e.preventDefault();
                e.stopPropagation();
                if ($(this).parsley().isValid()) {
                    $.ajax({
                        type: 'post',
                        url: MENUS_URL + 'ajax_add_comp/class_post',
                        data: $('form#addYearForm').serialize(),
                        cache: false,
                        success: function (data) {
                            var id = data;
                            var ht = '<option value="' + id + '">' +
                                $('input#name_comp').val() +
                                '</option>';
                            $('select#class').append(ht);
                            $('#modalAddClass').modal('hide');
                        }
                    });
                    return false;
                }
            });
        }
    });
    return false;
});