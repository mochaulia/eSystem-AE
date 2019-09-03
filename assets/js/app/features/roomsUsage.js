var divSpinner =
    '<div class="spinloader"></div>';

$(function () {
    $.ajax({
        type: 'get',
        url: 'rooms_usage/ajax_calendar',
        cache: false,
        beforeSend: function () {
            $('#mainCol').html(divSpinner);
        },
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#mainCol').html(data);
        }
    });
    return false;
});

$(function () {
    $.ajax({
        type: 'get',
        url: 'rooms/ajax_slider/all',
        cache: false,
        beforeSend: function () {
            $('#slidersDiv').html(divSpinner);
        },
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#slidersDiv').html(data);
            $('#owl-carousel-1').owlCarousel({
                loop: true,
                margin: 0,
                dots: false,
                nav: true,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                autoplay: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    992: {
                        items: 2
                    },
                }
            });
            $('.owl-carousel').find('.owl-nav').removeClass('disabled');
            $('.owl-carousel').on('changed.owl.carousel', function (event) {
                $(this).find('.owl-nav').removeClass('disabled');
            });
        }
    });
    return false;
});

$('#modalRead').on('hidden.bs.modal', function () {
    $('#modalRead').find('.modal-content').html('');
});

$('#modalRead').on('shown.bs.modal', function (e) {
    var ID = $(e.relatedTarget).data('id');
    $.ajax({
        type: 'get',
        url: 'rooms/ajax_read',
        cache: false,
        data: {
            id: ID,
        },
        beforeSend: function () {
            $('#modalRead').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('#modalRead').find('.modal-content').html(data);
        }
    });
});