/*
===============================================================
======================LOCAL VARS AND PROCEDUR==================
===============================================================
*/
var MENUS_URL = 'products/';

var divSpinner =
    '<div style="height:180px;">' +
    '<div class="spinloader">' + 
    '</div>' + 
    '</div>';

function getTable() {
    var uri;
    (window.location.href.split("/").pop() == 'mine.ae') ? uri = '/mine' : uri = '';
    $.ajax({
        type: 'get',
        url: MENUS_URL + 'ajax_table' + uri,
        cache: false,
        beforeSend: function () {
            $('#tableDiv').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#tableDiv').html(data);
            afterGetTable();
        }
    });
    return false;
}

function getGallery(url) {
    $.ajax({
        type: 'get',
        url: url,
        cache: false,
        beforeSend: function () {
            $('#modalOpenGallery').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalOpenGallery').find('.modal-content').html(data);
            afterGalleryModal();
        }
    });
    return false;
}

function afterGetTable() {
    $('#menuTable').DataTable().draw();
    $('[data-toggle="tooltip"]').tooltip();
}

function settingForm() {
    $('img#prevThumbnail').attr('src', $('input#thumbnail').val());
    tinymce.remove();
    tinymce.init({
        selector: 'textarea.tinymce',
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste wordcount"
        ],
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
    });
    $('input#thumbnail').on('change', function () {
        $('img#prevThumbnail').attr('src', $(this).val());
    });
}

function afterCreateModal() {
    $('form#createForm').parsley();
    $('form#createForm').on('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        tinyMCE.triggerSave();
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
                            text: 'Data has been updated successfully',
                            type: 'success',
                        });
                        $('#modalCreate').modal('hide');
                        getTable();
                    }
                    else if (data == 'null') {
                        new PNotify({
                            title: 'Error',
                            text: 'Description cannot be null',
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

function afterEditModal() {
    $('form#editForm').parsley();
    $('form#editForm').on('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        tinyMCE.triggerSave();
        if ($(this).parsley().isValid()) {
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
                        getTable();
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
        }
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

function afterGalleryModal() {
    $('#getGallery').on('click', function () {
        getGallery($('#buttonOpenGallery').data('src'));
    });
    $('[data-toggle="tooltip"]').tooltip();
    $('button.copyGalleryLink').on('click', function () {
        var $temp = $('<input>');
        var $related = $('span#galleryId' + $(this).data('gallery-id'));
        var $div = $('div.thumbnail' + $(this).data('gallery-id'));
        $($div).append($temp);
        $temp.val($related.data('path')).select();
        document.execCommand('copy');
        $temp.remove();
        new PNotify({
            title: 'Success',
            text: 'link successfully copied',
            type: 'success',
        });
    });
    $('button.selectGallery').on('click', function () {
        var $related = $('span#galleryId' + $(this).data('gallery-id'));
        var $thumbnailInput = $('input[name="thumbnail"]');
        $thumbnailInput.val($related.data('path')).trigger('change');
        $('#modalOpenGallery').modal('hide');
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
$('#modalOpenGallery').on('hidden.bs.modal', function () {
    $('#modalOpenGallery').find('.modal-content').html('');
});
$('select#type').on('change', function () {
    if ($(this).val() !== 'event') {
        $('#timeForm').hide();
        $('#locationForm').hide();
    }
    else {
        $('#timeForm').show();
        $('#locationForm').show();
    }
});

// reset modal
$('#modalCreate').on('hidden.bs.modal', function () {
    $('#modalCreate').find('.modal-content').html('');
});
$('#modalRead').on('hidden.bs.modal', function () {
    $('#modalRead').find('.modal-content').html('');
});
$('#modalEdit').on('hidden.bs.modal', function () {
    $('#modalEdit').find('.modal-content').html('');
});
$('#modalDelete').on('hidden.bs.modal', function () {
    $('#modalDelete').find('.modal-content').html('');
});
$('#modalOpenGallery').on('hidden.bs.modal', function () {
    $('#modalOpenGallery').find('.modal-content').html('');
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
            settingForm();
            afterGalleryModal();
            afterCreateModal();
        }
    });
    return false;
});

$('#modalRead').on('shown.bs.modal', function (e) {
    var ID = $(e.relatedTarget).data('menu-id');
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
            $('img#prevThumbnail').attr('src', $('input#thumbnail').val());
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
            settingForm();
            afterGalleryModal();
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

$('#modalOpenGallery').on('shown.bs.modal', function () {
    getGallery($('#buttonOpenGallery').data('src'));
});
