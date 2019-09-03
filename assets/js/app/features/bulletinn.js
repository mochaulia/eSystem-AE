var spinner =
    '<div class="loader"></div>';

getFlashNews();

function getFlashNews() {
    $.ajax({
        type: 'get',
        url: 'bulletin/ajax_flash_news',
        cache: false,
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#flashNews').html(data);
        }
    });
}
getFlashNews();
setInterval(function () {
    getFlashNews();
}, 5000);

function getNewsUpdate() {
    $.ajax({
        type: 'get',
        url: 'bulletin/ajax_news_update',
        cache: false,
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#newsUpdate').html(data);
        }
    });
    return false;
}
getNewsUpdate();
setInterval(function () {
    getNewsUpdate();
}, 5000);

function getNewsByCat1() {
    $.ajax({
        type: 'get',
        url: 'bulletin/ajax_news_categories/1',
        cache: false,
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#newsByCat1').html(data);
        }
    });
    return false;
}
getNewsByCat1();
setInterval(function () {
    getNewsByCat1();
}, 5000);

function getNewsByCat2() {
    $.ajax({
        type: 'get',
        url: 'bulletin/ajax_news_categories/2',
        cache: false,
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#newsByCat2').html(data);
        }
    });
    return false;
}
getNewsByCat2();
setInterval(function () {
    getNewsByCat2();
}, 5000);

function getYotube() {
    $.ajax({
        type: 'get',
        url: 'bulletin/ajax_youtube',
        cache: false,
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#youtube').html(data);
        }
    });
    return false;
}
getYotube();
setInterval(function () {
    getYotube();
}, 900000); // 15minutes

function getApps() {
    $.ajax({
        type: 'get',
        url: 'bulletin/ajax_apps',
        cache: false,
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#apps').html(data);
        }
    });
    return false;
}
getApps();
setInterval(function () {
    getApps();
}, 5000);

function getRunningText() {
    $.ajax({
        type: 'get',
        url: 'bulletin/ajax_running_text',
        cache: false,
        error: function () {
            console.log('There is an error when getting data.');
        },
        success: function (data) {
            $('#runningText').html(data);
        }
    });
    return false;
}
getRunningText();
setInterval(function () {
    getRunningText();
}, 360000); // 6minutes