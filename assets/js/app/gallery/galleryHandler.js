/*
===============================================================
======================LOCAL VARS AND PROCEDUR==================
===============================================================
*/
var divSpinner =
    '<div style="height:180px;">' +
    '<div class="spinloader">' +
    '</div>' +
    '</div>';

function copyToClipboard(elem) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(elem).data('src')).select();
    document.execCommand("copy");
    $temp.remove();
    new PNotify({
        title: 'Success',
        text: 'link successfully copied',
        type: 'success',
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image-prev').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function getGalleryDiv() {
    var uri;
    (window.location.href.split("/").pop() == 'mine.ae') ? uri = '_mine' : uri = '';
    $.ajax({
        type: 'get',
        url: 'gallery/ajax_div' + uri,
        cache: false,
        beforeSend: function () {
            $('.galleryDiv').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('.galleryDiv').html(data);
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
    return false;
}

function afterEditGalleryModal() {
    $('form.editGalleryForm').parsley().on('form:submit', function () {
        $.ajax({
            type: 'post',
            url: 'gallery/ajax_edit/post',
            data: $('form.editGalleryForm').serialize(),
            cache: false,
            success: function (data) {
                $('#modalEditGallery').modal('hide');
                getGalleryDiv();
                new PNotify({
                    title: 'Success',
                    text: 'Gallery updated successfully',
                    type: 'success',
                });
            }
        });
        return false;
    });
}

function afterDeleteGalleryModal() {
    $('form.deleteGalleryForm').on('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            type: 'post',
            url: 'gallery/ajax_delete/post',
            data: $('form.deleteGalleryForm').serialize(),
            cache: false,
            success: function (data) {
                $('#modalDeleteGallery').modal('hide');
                getGalleryDiv();
                new PNotify({
                    title: 'Success',
                    text: 'Deleted success',
                    type: 'success',
                });
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

$("input#image").change(function () {
    readURL(this);
}); 
$('button.refreshGalleryTable').on('click', function () {
    getGalleryDiv();
});
$('#modalEditGallery').on('hidden.bs.modal', function () {
    $('#modalEditGallery').find('.modal-content').html('');
});
$('#modalDeleteGallery').on('hidden.bs.modal', function () {
    $('#modalDeleteGallery').find('.modal-content').html('');
});

/*
===============================================================
=============================MODAL=============================
===============================================================
*/

$('#modalEditGallery').on('shown.bs.modal', function (e) {
    var galleryId = $(e.relatedTarget).data('gallery-id');
    $.ajax({
        type: 'get',
        url: 'gallery/ajax_edit',
        data: {
            gallery_id: galleryId,
        },
        beforeSend: function () {
            $('#modalEditGallery').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalEditGallery').find('.modal-content').html(data);
            afterEditGalleryModal();
        }
    });
    return false;
});

$('#modalDeleteGallery').on('shown.bs.modal', function (e) {
    var galleryId = $(e.relatedTarget).data('gallery-id');
    $.ajax({
        type: 'get',
        url: 'gallery/ajax_delete',
        data: {
            gallery_id: galleryId,
        },
        beforeSend: function () {
            $('#modalDeleteGallery').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalDeleteGallery').find('.modal-content').html(data);
            afterDeleteGalleryModal();
        }
    });
    return false;
});
