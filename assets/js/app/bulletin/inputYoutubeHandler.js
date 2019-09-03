$('form#savePlaylist').parsley().on('form:submit', function () {
    $.ajax({
        type: 'post',
        url: 'youtube/post',
        data: $('form#savePlaylist').serialize(),
        cache: false,
        success: function (data) {
            if (data == 'success') {
                var PNtitle = 'Success';
                var PNtext = 'YouTube Playlist updated successfully';
                var PNtype = 'success';
            }
            else {
                var PNtitle = 'Failed';
                var PNtext = 'An unknown error accoured';
                var PNtype = 'warning';
            }
            new PNotify({
                title: PNtitle,
                text: PNtext,
                type: PNtype,
            });
        }
    });
    return false;
});