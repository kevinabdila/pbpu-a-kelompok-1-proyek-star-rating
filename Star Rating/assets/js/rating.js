function mouseOverRating(courseId, rating, appearance) {
    if (appearance == "star") {
        for (var i = 1; i <= rating; i++) {
            $('#' + courseId + "_" + i + ' img').attr('src',
                "./img/" + appearance + "-filled.png");
        }
    } else {
        ratingIconPrefix = "./img/" + appearance;
        for (var i = 1; i <= rating; i++) {
            if (appearance == "emoji") {
                ratingIconPrefix = "./img/" + appearance + "1";
            }
            if (i == rating) {
                $('#' + courseId + "_" + i + ' img').attr('src',
                    ratingIconPrefix + "-filled.png");
            }
        }
    }
}


function mouseOutRating(courseId, userRating, appearance) {
    var ratingId;
    if (appearance == "star") {
        if (userRating != 0) {
            for (var i = 1; i <= userRating; i++) {
                $('#' + courseId + "_" + i + ' img').attr('src',
                    "./img/" + appearance + "-filled.png");
            }
        }
        if (userRating <= 5) {
            for (var i = (userRating + 1); i <= 5; i++) {
                $('#' + courseId + "_" + i + ' img').attr('src',
                    "./img/" + appearance + "-open.png");


            }
        }
        $(".selected img").attr('src', "./img/" + appearance + "-filled.png");
    } else {
        ratingIconPrefix = "./img/" + appearance;


        if (userRating <= 5) {
            for (var i = 1; i <= 5; i++) {
                if (appearance == "emoji") {
                    ratingIconPrefix = "./img/" + appearance + i;
                }
                if (userRating == i) {
                    $('#' + courseId + "_" + i + ' img').attr('src',
                        ratingIconPrefix + "-filled.png");
                } else {
                    $('#' + courseId + "_" + i + ' img').attr('src',
                        ratingIconPrefix + "-open.png");
                }
            }
        }
        var selectedImageSource = $(".selected img").attr('src');
        if (selectedImageSource) {
            selectedImageSource = selectedImageSource.replace('open', "filled");
            $(".selected img").attr('src', selectedImageSource);
        }
    }
}

function addRating(currentElement, courseId, ratingValue, appearance) {
    var loaderIcon = $(currentElement).closest(".row-item");
    $.ajax({
        url: "ajax-end-point/insertRating.php",
        data: "index=" + ratingValue + "&course_id=" + courseId,
        type: "POST",
        beforeSend: function () {
            $(loaderIcon).find("#loader-icon").show();
        },
        success: function (data) {
            loaderIcon = $(currentElement).closest(".row-item");
            $(loaderIcon).find("#loader-icon").hide();
            if (data != "") {
                $('#response-' + courseId).text(data);
                return false;
            }
            if (appearance == 'star') {
                $('#list-' + courseId + ' li').each(
                    function (index) {
                        $(this).addClass('selected');
                        if (index == $('#list-' + courseId + ' li').index(
                            currentElement)) {
                            return false;
                        }
                    });
            } else {
                $(currentElement).addClass('selected');
            }
        }
    });


}