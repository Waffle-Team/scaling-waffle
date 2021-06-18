$(document).ready(function() {
    $("#bt-login").click(function(){
        var login_result;
        var user = $('#login').val();
        var pass = $('#senha').val();
        // login_result = login_user(user, pass);
        // //se deu boa

        // login_result = JSON.parse(login_result);

        // console.log(login_result);

        // if(login_result.sucess){

            // var senha = hash(pass);
            // var data = {
            //     usuario: user,
            //     passe: senha
            // }

            $informacoes = criptografarChaveSimetrica(user);

            var request = $.ajax({
                url: "/backend/team_lib/criptografia/descriptografar-simetrica.php",
                type: 'post',
                data: {dados: $informacoes},
                dataType: "json",
                async: false
            });

            // console.log('responsetext : ' + request.responseText);

            // request = JSON.parse(request.responseText);

            // if (request.success){
            //     //guardou a chave na bd
            // }
            // else{
            //     //problemas
            // }

            //gerar chave secreta no criptografar-simetrica COM VETOR DE INICIALIZACAO e salve em um arquivo
            //mandar a chave secreta criptografada para descriptografar-simetrica
            //dentro do simetrica ele chama o outro
            //salva a chave secreta no banco de dados
            //return sucesso
            // ai sim ---> window.location = '/form-codigo';




            // window.location = '/form-codigo';
            // mudar para um elemento html no layout um texto vemelhão cai bem
        // }else{
        //     alert(login_result.msg);
        // }
    });
});
