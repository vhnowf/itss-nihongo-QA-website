$('.count_char').each(function() {
    var charCount = $(this).val().length;
    $(this).closest('.form-group').find('.count_total').text(charCount);
});

$('.count_char').on('keyup change', function() {
    var charCount = $(this).val().length;
    $(this).closest('.form-group').find('.count_total').text(charCount);
});

// active sidebar when in editing screen
$("#side-menu a").each(function () {
    let t = window.location.href.split(/[?#]/)[0];
    if(t.search(this.href) >= 0 && (t.search("edit") >= 0 || t.search("log") >= 0 || t.search("create") >= 0 || t.search("show") >= 0)) {
        $(this).parent().addClass("active"),
        $(this).parent().parent().addClass("in"),
        $(this).parent().parent().prev().addClass("active")
    }
});