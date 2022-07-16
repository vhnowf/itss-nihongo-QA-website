// load city
$('#sl_city').change(function() {
    $.ajax({
        type: "get",
        url: BASE_API_URL + "/get-district",
        data: {
            name: $(this).val(),
        },
        beforeSend: function() {
            $('.district_loading').show();
            $('#host_district').attr('disabled', 'disabled');
        },
        dataType: "JSON",
        success: function (response) {
            html = '<option value="" selected disabled>-- Quận huyện  --</option>';
            $.each( response, function( key, district ) {
                if(old_district == district.name) {
                    html += '<option value="'+district.name+'" selected>'+district.name+'</option>';
                } else {
                    html += '<option value="'+district.name+'">'+district.name+'</option>';
                }
            });
            $('#host_district').html(html)
            $('.district_loading').hide();
            $('#host_district').removeAttr('disabled');
        },
        error: function() {
        }
    });
});

if($('#sl_city').val()) {
    $('#sl_city').trigger('change');
}
// end load city