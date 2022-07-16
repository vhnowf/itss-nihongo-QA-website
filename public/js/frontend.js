var showPopupUser = function (type = 'login') {
    if (type == 'login') {
        $('#login-tab').trigger('click');
    } else {
        $('#register-tab').trigger('click');
    }
    $("#popup_user").modal("show");
}

var showListProduct = function () {
    $('#products-list').click(function (event) {
        event.preventDefault();
        $('#products .item').addClass('list-group-item');
        $('#products-grid').removeClass('btn-active');
        $('#products-list').addClass('btn-active');
    });
    $('#products-grid').click(function (event) {
        event.preventDefault();
        $('#products .item').removeClass('list-group-item');
        $('#products .item').addClass('grid-group-item');
        $('#products-list').removeClass('btn-active');
        $('#products-grid').addClass('btn-active');
    });
};

// var keywordSearch = function () {
//     $('.popup_keyword').addClass('hidden');
//     $('.popup_keyword').empty();
//     $('.popup_keyword_mobile').addClass('hidden');
//     $('.popup_keyword_mobile').empty();
//     if (screen.width > 768) {
//         var keyword = $('.input_search').val();
//     } else {
//         var keyword = $('.search_mobile').val();
//     }

//     $.ajax({
//         type: "GET",
//         url: BASE_API_URL + "/auto-complete",
//         data: {
//             keyword: keyword,
//         },
//         dataType: "JSON",
//         success: function (data) {
//             $('.popup_keyword').html(data.html);
//             $('.popup_keyword').removeClass('hidden');
//             $('.popup_keyword_mobile').html(data.html);
//             $('.popup_keyword_mobile').removeClass('hidden');
//         },
//         error: function (xhr, ajaxOptions, thrownError) {
//             console.log(xhr.status);
//             console.log(thrownError);
//         }
//     });
// }

function delay(callback, ms) {
    var timer = 0;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}
// $(document).ready(function e() {
//     $('.input_search, .search_mobile').keyup(delay(function (e) {
//         keywordSearch();
//     }, 500));

// })

$(document).ready(function () {
    $(".input_search, .search_mobile, .tag-input").one("click", function () {
        // keywordSearch();
    });
    $(".input_search").click(function () {
        $('.popup_keyword').removeClass('hidden');
    });
    $(".search_mobile").click(function () {
        $('.popup_keyword_mobile').removeClass('hidden');
    });
})

$(document).mouseup(function (e) {
    var container = $(".input_search");
    var container_mobile = $('.search_mobile');
    var tag_0 = $("#tag-input-0");
    var tag_1 = $("#tag-input-1");
    var tag_2 = $("#tag-input-2");
    var tag_3 = $("#tag-input-3");
    var tag_4 = $("#tag-input-4");

    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('.popup_keyword').addClass('hidden');
    }

    if (!container_mobile.is(e.target) && container_mobile.has(e.target).length === 0) {
        $('.popup_keyword_mobile').addClass('hidden');
    }

    if (!tag_0.is(e.target) && tag_0.has(e.target).length === 0) {
        $('#tag-suggestions-0').addClass('hidden');
    }

    if (!tag_1.is(e.target) && tag_1.has(e.target).length === 0) {
        $('#tag-suggestions-1').addClass('hidden');
    }

    if (!tag_2.is(e.target) && tag_2.has(e.target).length === 0) {
        $('#tag-suggestions-2').addClass('hidden');
    }

    if (!tag_3.is(e.target) && tag_3.has(e.target).length === 0) {
        $('#tag-suggestions-3').addClass('hidden');
    }

    if (!tag_4.is(e.target) && tag_4.has(e.target).length === 0) {
        $('#tag-suggestions-4').addClass('hidden');
    }
});

function sendEmail(){
    var email = $(".iputEmail").val();
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(regex.test(email)){
        $.ajax({
            type: "GET",
            url: BASE_API_URL +"/emails/create",
            data: {
                "email": email,
            },
            dataType: "JSON",
            success: function (response) { 
                $(".iputEmail").val('');
                $('#popup_alert .title').html('Đăng ký nhận mail thành công'); 
                $('#popup_alert .message').html(response.message);
                $('#popup_alert').modal('show');   
            },
            error: function (response) {
                console.log(response);
            }
        });
    } else {
        $('#popup_alert .title').html('Đăng ký nhận mail thất bại'); 
        $('#popup_alert .message').html('Lỗi email không đúng định dạng hoặc trống.');
        $('#popup_alert').modal('show');
    }
}

function openMenu() {
    $(".header").toggleClass("open");
    $("#menu_mask").toggle();
}
