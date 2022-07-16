var AcceptRating = function(obj, rating, id){
    var star_rating = parseInt(obj.attr('value'));
    obj.parent().children('.value_rating').attr('value', star_rating);
    obj.addClass('checked');
    obj.prevAll('.rating_star').addClass('checked');
    obj.nextAll('.rating_star').removeClass('checked');
    obj.parent().parent().parent().children('.comment_rating').removeClass('hidden');
    obj.parent().parent().parent().children('.image_rating').removeClass('hidden');
    
    $('#'+id).validate({
        rules: {
            rating: {
                required: true,
            },
            
        },
        messages: {
            rating: {
                required: "Vui lòng đánh giá",
            },
        },
    });

    if($('#'+id).valid()){
        obj.closest('form').find('.button_send_from').removeClass('hidden');
        obj.closest('form').find('.button_processing').addClass('hidden');
    };
}

var closeRating = function(obj){
    $('.rating_star').removeClass('checked');
    $('.comment_rating').addClass('hidden');
    $('.image_rating').addClass('hidden');
    obj.closest('form').find("input[type=text], textarea").val("");
    obj.closest('form').find(".upload-list-img").empty();
    obj.closest('form').find('.button_send_from').addClass('hidden');
    obj.closest('form').find('.button_processing').removeClass('hidden');

}

var sendForm = function(id){
    $.ajax({
        type: "POST",
        url: BASE_API_URL +"/rating-products/create",
        data: $('#rate_form_'+id).serialize(),
        dataType: "JSON",
        success: function (data) { 
           $('#'+id).remove();
           $('#modal-'+id).modal('hide');
        },
        error:function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

var upLoadMultiFile = function(event, product_id, image_name){
    var files = event.target.files;
    var qty_image = $("input[name='"+image_name+"']").length;
    $.each(files, function(i, file){
        if( (qty_image+1)+i <= 6){
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e){
                $("#"+product_id).append('<div class="image_rating">'+
                '<img src="'+e.target.result+'" style="width: 30px; height:30px">'+
                '<i class="far fa-times-circle icon_delete" onclick="removeImg($(this))"></i>'+
                '<input  type="text" name="'+image_name+'" value="'+e.target.result+'" hidden>'+ 
                '</div>')
            }     
        }
    });
}

var removeImg = function(obj){
    obj.parent().remove();
}

$(document).ready(function(){
    let skip=0;
    $(".order_status").click(function(){
        var order_status = $(this).val();
        var keyword_order = $('.keyword_order').val();
        $(".order_status").removeClass('active');
        skip=0;
        $(this).addClass('active');
        $.ajax({
            type: 'GET',
            url: BASE_URL+"/user/orders/",
            data: {
                "order_status":order_status,
                "keyword_order":keyword_order,
                "skip":skip

            },  
            dataType: 'JSON',
            beforeSend: function() {
                $("#notice").empty();
                $('.list-order').empty();
                $('.order-loading').show();
            },
            success: function(data){
                $('.order-loading').hide();
                $('.list-order').html(data.html);
            },
        });
    });

    $(".search_icon_btn").click(function(){
        var order_status = $('.order_status.active').val();
        var keyword_order = $('.keyword_order').val();
        skip=0;
        $.ajax({
            type: 'GET',
            url: BASE_URL+"/user/orders/",
            data: {
                "order_status":order_status,
                "keyword_order":keyword_order,
                "skip":skip

            },  
            dataType: 'JSON',
            beforeSend: function() {
                $("#notice").empty();
                $('.list-order').empty();
                $('.order-loading').show();
            },
            success: function(data){
                $('.order-loading').hide();
                $('.list-order').html(data.html);
            },
        });
    });

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
            var order_status = $('.order_status.active').val();
            var keyword_order = $('.keyword_order').val();
            skip += 10;
            $.ajax({
                type: 'GET',
                url: BASE_URL+"/user/orders/",
                data: {
                    "order_status":order_status,
                    "keyword_order":keyword_order,
                    "skip":skip,
                    
                },  
                dataType: 'JSON',
                beforeSend: function() {
                    $('.order-loading-scroll').show();
                },
                success: function(data){
                    $('.order-loading-scroll').hide();
                    if(data.count_orders >0){
                        $('.list-order').append(data.html);
                    }
                    else{
                        $("#notice").empty();
                        $("#notice").html("<p class='m-t-24'>Bạn không còn đơn hàng nào</p>");
                    }
                },
            });
        }
    });
})
