$(document).ready(function() {
    $("#bt-login").click(function() {
        var user = $('#login').val();
        var pass = $('#senha').val();
        var login_result = login_user(user, pass);
        // se login não deu boa da um alert
        //se deu boa tratar a mudança de pagina la no master.js
        if(!login_result){
            alert("usuario ou senha incorretos");
            // mudar para um elemento html no layout um texto vemelhão cai bem
        }
    });
});
