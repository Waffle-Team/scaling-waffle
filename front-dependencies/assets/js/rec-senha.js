$(document).ready(function() {
    $('#bt-rec').click(function(){
        var back_response;
        var user =  $('#login').val();

        var data = {
            login: user,
        }
        var request = $.ajax({
            url: "./backend/recuperacao.php",
            type: "post",
            dataType: 'json',
            data: data,
            async: false
        });
        back_response = JSON.parse(request.responseText);
        console.table(back_response);
       
        if(back_response.sucess){
            $('#alert_msg').html('<p id="mensage">Email enviado com um link para recuperação de senha</p>');
        }else{
            $('#alert_msg').html('<p id="mensage">Usuario não existe</p>');
        }

    });
});
