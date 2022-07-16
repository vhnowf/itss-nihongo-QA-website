function comfirmDelete(formClass){
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "Bạn sẽ không thể khôi phục được dữ liệu sau khi xóa!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.value) {
            $(formClass).submit();
        }
    })
}

function comfirmDeleteLink(url){
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "Bạn sẽ không thể khôi phục được dữ liệu sau khi xóa!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.value) {
            window.location.href = url;
        }
    })
}

function formatNumber(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    } 
    return x1 + x2;
}

function goToByScroll(ele) {
    // Scroll
    $('html,body').animate({
        scrollTop: $(ele).offset().top - 100
    }, 'slow');
}

$("#avatar").change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.avatar_preview img').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
});

var stringToSlug = function(str)
{
    // Chuyển hết sang chữ thường
    str = str.toLowerCase();     
 
    // xóa dấu
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');
 
    // Xóa ký tự đặc biệt
    str = str.replace(/([^0-9a-z-\s])/g, '');
 
    // Xóa khoảng trắng thay bằng ký tự -
    str = str.replace(/(\s+)/g, '-');
 
    // xóa phần dự - ở đầu
    str = str.replace(/^-+/g, '');
 
    // xóa phần dư - ở cuối
    str = str.replace(/-+$/g, '');
 
    // return
    return str;
}

var onlyNumber = function (evt) {
    var theEvent = evt || window.event;
    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

$(".money-format").on({
    keyup: function() {
        let input_val = $(this).val();
        input_val = numberToCurrencyCore(input_val);
        $(this).val(input_val);
    },
    blur: function() { 
        let input_val = $(this).val();
        input_val = numberToCurrencyCore(input_val, true, true);
        $(this).val(input_val);
    }
});

window.numberToCurrencyCore = function (input_val, fixed, blur) {
    if(fixed === undefined) {
        fixed = false;
    }
    
    if(blur === undefined) {
        blur = false;
    }

    // don't validate empty input
    if(!input_val) {
        return 0;
    }
    
    if(blur) {
        if (input_val === "" || input_val == 0) {
            return 0;
        }
    }
   
    if(input_val.length == 1) {
        return parseInt(input_val);
    }

    input_val = ''+input_val;
    
    let negative = '';
    if(input_val.substr(0, 1) == '-'){
        negative = '-';
    }
    // check for decimal
    if (input_val.indexOf(".") >= 0) {
        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = left_side.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if(fixed && right_side.length > 3) {
            right_side = parseFloat(0+right_side).toFixed(2);
            right_side =  right_side.substr(1, right_side.length);
        }

        // validate right side
        right_side = right_side.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // Limit decimal to only 2 digits
        if(right_side.length > 2) {
            right_side = right_side.substring(0, 2);
        }
    
        if(blur && parseInt(right_side) == 0) {
            right_side = '';
        }

        // join number by .
        // input_val = left_side + "." + right_side;

        if(blur && right_side.length < 1) {
            input_val = left_side;
        } else {
            input_val = left_side + "." + right_side;
        }
    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = input_val.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    if(input_val.length > 1 && input_val.substr(0, 1) == '0' && input_val.substr(0, 2) != '0.' ) {
        input_val = input_val.substr(1, input_val.length);
    } else if(input_val.substr(0, 2) == '0,') {
        input_val = input_val.substr(2, input_val.length);
    }
    
    return negative+input_val;
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var gooToId = function (id, top = 50) {
    if(id) {
        $("html, body").animate({
            scrollTop: $('#' + id).offset().top - top
        }, 1000);
    }
}
