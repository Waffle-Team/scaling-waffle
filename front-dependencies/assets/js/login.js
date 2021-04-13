function login(pass, user){
    //Implementar
    var session_token;
    session_token = true;
    return session_token;
}
$(document).ready(function() {
    $("#bt-login").click(function() {
        var user = $('#login').val();
        var pass = $('#senha').val();
        var login_result = login_user(user, pass);
        // se login não deu boa da um alert
        //se deu boa tratar a mudança de pagina la no master.js
        if(!login_result){
            alert("usuario ou senha incorretos");
        }
    });

});
