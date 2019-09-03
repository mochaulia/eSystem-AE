/*
===============================================================
======================LOCAL VARS AND PROCEDUR==================
===============================================================
*/
var MENUS_URL = 'clients/';

var divSpinner =
    '<div style="height:180px;">' +
    '<div class="spinloader">' +
    '</div>' +
    '</div>';

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image-prev').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function getTable() {
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_table',
        cache: false,
        beforeSend: function () {
            $('#tableDiv').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#tableDiv').html(data);
            // reinitializing DataTable
            $('#menuTable').DataTable().draw();
            afterGetTable();
        }
    });
    return false;
}

function afterGetTable() {
    $('[data-toggle="tooltip"]').tooltip();
}
function afterCreateModal() {
    $("input#logo").change(function () {
        readURL(this);
    });
    $('form#createForm').parsley();
    $('form#createForm').on('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: MENUS_URL + 'ajax_add/post',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == 'created') {
                    new PNotify({
                        title: 'Success',
                        text: 'Data has been created successfully',
                        type: 'success',
                    });
                    $('#modalCreate').modal('hide');
                    getTable();
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
    });
}

function afterEditModal() {
    $('form#editForm').parsley().on('form:submit', function () {
        $.ajax({
            type: 'post',
            url: MENUS_URL + 'ajax_edit/post',
            data: $('form#editForm').serialize(),
            cache: false,
            success: function (data) {
                if (data == 'updated') {
                    new PNotify({
                        title: 'Success',
                        text: 'Data has been updated successfully',
                        type: 'success',
                    });
                    $('#modalEdit').modal('hide');
                    getTable();
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

function afterDeleteModal() {
    $('form#deleteForm').on('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            type: 'post',
            url: MENUS_URL + 'ajax_delete/post',
            data: $('form#deleteForm').serialize(),
            cache: false,
            success: function (data) {
                new PNotify({
                    title: 'Success',
                    text: 'Data has been deleted successfully',
                    type: 'success',
                });
                $('#modalDelete').modal('hide');
                getTable();
            }
        });
        return false;
    });
}

function afterEditPicModal() {
    $("input#logo").change(function () {
        readURL(this);
    });
    $('form#editImageForm').parsley();
    $('form#editImageForm').on('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: MENUS_URL + 'ajax_edit_image/post',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (data === 'updated') {
                    new PNotify({
                        title: 'Success',
                        text: 'Image has been updated successfully',
                        type: 'success',
                    });
                    $('#modalEditPic').modal('hide');
                    getTable();
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
    });
}

/*
===============================================================
==============================BIND=============================
===============================================================
*/

// direct
getTable();
$('[data-toggle="tooltip"]').tooltip();

// with trigger
$('button#refreshTable').on('click', function () {
    getTable();
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
$('#modalEditPic').on('hidden.bs.modal', function () {
    $('#modalEditPic').find('.modal-content').html('');
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
    var ID = $(e.relatedTarget).data('menu-id');
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

$('#modalDelete').on('shown.bs.modal', function (e) {
    var ID = $(e.relatedTarget).data('menu-id');
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
            afterDeleteModal();
        }
    });
    return false;
});

$('#modalEditPic').on('shown.bs.modal', function (e) {
    var ID = $(e.relatedTarget).data('menu-id');
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_edit_image',
        data: {
            id: ID
        },
        cache: false,
        beforeSend: function () {
            $('#modalEditPic').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalEditPic').find('.modal-content').html(data);
            afterEditPicModal();
        }
    });
    return false;
});
