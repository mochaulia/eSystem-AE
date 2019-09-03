// initialize form with parsley validation and bind funtion when submitted
$('form.changePasswordForm').parsley().on('form:submit', function () {
    $.ajax({
        type: 'post',
        url: 'ajax_change_password',
        data: $('form.changePasswordForm').serialize(),
        cache: false,
        success: function (data) {
            // create new pnotify object
            new PNotify({
                title: data.title,
                text: data.text,
                type: data.type,
            });
            // if data is success
            if (data.type == 'success') {
                // wait 1 second before logout the user
                setTimeout(function () {
                    window.location = 'logout';
                }, 1000);
            }
        }
    });
    return false;
});