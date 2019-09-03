// create public variable of <input file> tag 
var $avaCropper;

$('#inputAva').on('change', function() {
    // crate canvas for image preview <input file> with cropper
    $avaCropper = $('#avaPreview').cropper({
        aspectRatio: 1,
        zoomable: false,
    });
    if (this.files && this.files[0]) {
        // get file data
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);
        reader.onload = function (e) {
            // just work when <input file> change again
            $avaCropper.cropper('replace', e.target.result);
            // put the new data (image) in canvas
            $('#avaPreview').attr('src', e.target.result);
        }
    }
});

$('form.changeAvaForm').on('submit', function(e) {
    e.preventDefault();
    e.stopPropagation();
    try {
        // try toBlob() for aware of unblob file
        // get cropped canvas data
        $avaCropper.cropper('getCroppedCanvas', {
            minWidth: 100,
            minHeight: 100,
            maxWidth: 1920,
            maxHeight: 1920
        }).toBlob(function (blob) {
            var formData = new FormData();
            formData.append('croppedAva', blob);
            // send cropped canvas to server
            $.ajax({
                method: 'post',
                url: 'ajax_change_ava',
                data: formData,
                processData: false,
                contentType: false,
                error: function (data) {
                    var errText = data.replace('<p>', '');
                    errText = data.replace('</p>', '');
                    new PNotify({
                        title: 'Failed',
                        text: errText,
                        type: 'warning',
                    });
                },
                success: function (data) {
                    new PNotify({
                        title: 'Success',
                        text: 'Avatar has been update successfully',
                        type: 'success',
                    });
                    $('.modalChangeAva').modal('hide');                    
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            });
            return false;
        });
    }
    catch(error) {
        // getting some error when run toBlob()
        var errorText;
        if (error.message == 'Cannot read property \'toBlob\' of null') {
            errorText = 'Only allowed image file';
        }
        else if (error.message == 'Object doesn\'t support property or method \'toBlob\'') {
            errorText = 'This browser seems like doesn\'t support this method';
        }
        else {
            errorText = error.message;
        }
        new PNotify({
            title: 'Failed',
            text: errorText,
            type: 'warning',
        });
    }
});

// initialize form with parsley
$('form.editProfileForm').parsley().on('form:submit', function() {
    // send data to server after submitted
    $.ajax({
        type: 'post',
        url: 'ajax_edit_profile',
        data: $('form.editProfileForm').serialize(),
        cache: false,
        error: function () {
            new PNotify({
                title: 'Failed',
                text: 'Unknown error accoured',
                type: 'warning',
            });
        },
        success: function (data) {
            new PNotify({
                title: 'Updated',
                text: 'User has been update successfully',
                type: 'success',
            });
        }
    });
    return false;
});