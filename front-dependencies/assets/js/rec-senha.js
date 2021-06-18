$(document).ready(function() {
    $('#bt-rec').click(function(){
        var back_response;
        var user =  $('#login').val();
        var data = {
            login: user,
        }

        request = criptografiassimetrica(3, data);

        console.log(request);

        request = JSON.parse(request);
       
        if(request.sucess){
            $('#alert_msg').html('<p id="mensage">Email enviado com um link para recuperação de senha</p>');
        }else{
            $('#alert_msg').html('<p id="mensage">Usuario não existe</p>');
        }
    });
});
