$(document).on("click", ".like", function (event) {
    event.preventDefault();
    var id = $(this).attr('id');

    $.ajax({
        method: 'POST',
        type: 'POST',
        url: urlLike,
        data: {isLike: id, _token: token},
    })
        .done(function (data) {
            if (data == 0) {
                window.location.replace(urlLogin);
            }
            $('#likeblock').replaceWith($(data).find('#likeblock'));
        })
});

$(document).on("click", ".commentLike", function (event) {
    event.preventDefault();
    var id = $(this).attr('id');
    var url = $(this).attr('href');
    var url2 = $(this).closest('ul').attr('id');

    $.ajax({
        method: 'POST',
        type: 'POST',
        url: url,
        data: {isCommentLike: id, _token: token},
    })
        .done(function (data) {
            if (data == 0) {
                window.location.replace(urlLogin);
            }
            console.log('#' + url2);
            $('#' + url2).replaceWith($(data).find('#' + url2));
        })
});

$(document).ready(function () {
    getVisitors();
});


function getVisitors() {
    var currentVisitors = Math.floor((Math.random() * 10) + 1);
    $.ajax({
        method: 'POST',
        type: 'POST',
        url: urlVisit,
        data: {visit: currentVisitors, _token: token},
        success(data) {
            setTimeout(function () {
                getVisitors();
            }, 5000);
            $('#totalViews').text(data);
            $('#currentrlyViews').text(currentVisitors);
        }
    })

}






