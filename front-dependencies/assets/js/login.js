$(document).ready(function() {
    $("#bt-login").click(function(){
        var user = $('#login').val();
        var pass = $('#senha').val();
        var login_result = login_user(user, pass);

        //se deu boa
        if(login_result.sucess){
            window.location('./form-codigo');
            // mudar para um elemento html no layout um texto vemelhão cai bem
        }else{
            $('#alert_msg').html(login_result.msg);
        }

    });
});
