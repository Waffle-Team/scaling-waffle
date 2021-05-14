$(document).ready(function() {
    var senha;
    var senha_2;
    var token_get;
    var user_get;

    $('#bt-rec').click(function(event) {
        senha = $('#senha').val();
        senha_2 = $('#senha-confirm').val();

        if(senha != senha_2){
            $('#alert_msg').html('As senhas não são iguais');
        }else{
            token_get = getUrlParameter('token');
            user_get = getUrlParameter('user');
            senha = hash(senha);
            var back_response;
            var data = {
                senha: senha,
                token: token_get,
                user: user_get
            }
            var request = $.ajax({
                url: "./backend/nova_senha.php",
                type: "post",
                dataType: 'json',
                data: data,
                async: false
            });
            back_response = JSON.parse(request.responseText);
            console.log(back_response);
            if(back_response.sucess){
                window.location = './form-login';
            }else{
                $('.mensage-link').html(back_response.msg);
            }
        }
    });
});
