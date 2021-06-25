$(document).ready(function() {
    $('#bt_logar').click(function(event){
        var codigo =  $('#input-codigo').val();
        var data = {
            codigo: codigo,
        }
        var request = $.ajax({
            url: "./backend/2fa.php",
            type: "post",
            dataType: 'json',
            data: data,
            async: false
        });
        var codeMatch = JSON.parse(request.responseText);

        if(codeMatch.sucess){
            window.location = '/Logged';
        }else{
            window.location = '/form-login';
        }

    });
});
