tinymce.init({ 
    selector:'#host_introduction',
    height: 160,
    menubar: false
});

$(document).ready(function() {
    $('#group_id').change(function() {
        if($('#group_id').val() == 2) {
            $('#group-host').show();
            $('#group-guest').hide();
        } else if($('#group_id').val() == 3) {
            $('#group-host').hide();
            $('#group-guest').show();
        } else {
            $('#group-host').hide(); 
            $('#group-guest').hide(); 
        }
    });
  
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
});