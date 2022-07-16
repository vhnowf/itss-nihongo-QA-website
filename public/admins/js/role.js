$('select.select2-limiting').select2();

var processPermission = function(e){
    let idRole = $(e.currentTarget).val();

    let listCheckBox = $('input:checkbox.permissionuser');
    for (let index = 0; index < listCheckBox.length; index++) {
        let element = listCheckBox[index]['disabled'];
        if(element){
            //proccess when checkbox is disabled
            $('#'+listCheckBox[index]['id']).prop('checked',false);
            $('#'+listCheckBox[index]['id']).prop('disabled',false);
        }

    }

    $.ajax({
        url: '/admin/roles/get-permission',
        type: 'get',
        data: {
            role: idRole
        },
        beforeSend: function(){
            $('.permission_id').prop('checked', false);
        },
        success: function (response) {
            response.forEach(element => {
                $('#permission_'+element).prop('checked', true);
            });
        },
        error: function (e) {
            console.error(e);
        }

    });
}

$('#addUserRole').on('select2:select', function (e) {
    processPermission(e);
});

$('#addUserRole').on('select2:unselect', function (e) {
    processPermission(e);
});

var removeDisPer = function() {
    $('.permission_id').prop('disabled', false);
}
