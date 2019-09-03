var divSpinner =
    '<div class="spinloader"></div>';

var LAST_URI = window.location.href.split("/").pop().split('?')[0];
var URI;
(LAST_URI == 'read.ae' ||
    LAST_URI == 'category.ae' ||
    LAST_URI == 'search.ae' ||
    LAST_URI == '') ?
    URI = '' : URI = 'news/';

var CAT;

$(function () {
    $.ajax({
        type: 'get',
        url: URI + 'ajax_slider',
        cache: false,
        beforeSend: function () {
            $('#sliderNews').html(divSpinner);
        },
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#sliderNews').html(data);
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
        }
    });
    return false;
});

$(function () {
    $.ajax({
        type: 'get',
        url: URI + 'ajax_trending',
        cache: false,
        beforeSend: function () {
            $('#trendingNews').html(divSpinner);
        },
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#trendingNews').html(data);
        }
    });
    return false;
});

$(function () {
    $.ajax({
        type: 'get',
        url: URI + 'ajax_latest',
        cache: false,
        beforeSend: function () {
            $('#latestNews').html(divSpinner);
        },
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#latestNews').html(data);
            $('#owl-carousel-3').owlCarousel({
                items: 1,
                loop: true,
                margin: 0,
                dots: false,
                nav: true,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                autoplay: true,
            });
        }
    });
    return false;
});

$(function () {
    $.ajax({
        type: 'get',
        url: URI + 'ajax_categories_top',
        cache: false,
        beforeSend: function () {
            $('#catTopNews').html(divSpinner);
        },
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#catTopNews').html(data);
        }
    });
    return false;
});

$(function () {
    $.ajax({
        type: 'get',
        url: URI + 'ajax_categories_bottom',
        cache: false,
        beforeSend: function () {
            $('#catBottomNews').html(divSpinner);
        },
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#catBottomNews').html(data);
        }
    });
    return false;
});

if ($("input#category").length) {
    CAT = $("input#category").val();
    ID = $("input#id").val();
    $(function () {
        $.ajax({
            type: 'get',
            url: URI + 'ajax_related',
            cache: false,
            data: {
                category: CAT,
                id: ID
            },
            beforeSend: function () {
                $('#relatedNews').html(divSpinner);
            },
            error: function () {
                console.log('There is an error when getting data.');
            },
            success: function (data) {
                $('#relatedNews').html(data);
            }
        });
        return false;
    });
}