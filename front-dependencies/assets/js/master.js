// funções de uso geral
function validaSenha(senha){

    var teste = true;

    if (/(?=.*[a-z])/.test(senha) == false){ // deve conter ao menos uma letra minúscula
        $('#alert-area').append("- A senha deve conter ao menos uma letra minúscula\n");
        teste = false;
    }

    if (/(?=.*[A-Z])/.test(senha) == false) { // deve conter ao menos uma letra maiúscula
        $('#alert-area').append("- A senha deve conter ao menos uma letra maiúscula\n");
        teste = false;
    }

    if (/(?=.*[$*&@#])/.test(senha) == false) { // deve conter ao menos um caractere especial
        $('#alert-area').append("- A senha deve conter ao menos um caractere especial\n");
        teste = false;
    }

    if (senha.length < 10) { // deve conter ao menos 10 dos caracteres mencionados
        $('#alert-area').append("- A senha deve conter ao menos 10 caracteres\n");
        teste = false;
    }

    return teste;
}

function validaEmail(email){
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function validaTelefone(telefone){
    var regex = /[\d|+|\-|.| ]{11,20}/g;
    if (regex.test(telefone) && telefone.length <= 20){
        return true;
    }
    else{
        return false;
    }
}
function hash(entrada){
    var hash = sjcl.hash.sha256.hash(entrada);
    var hashHex = sjcl.codec.hex.fromBits(hash);
    return hashHex;
}


// Funções especificas
function login_user(_login, _senha){
    var userMatch;
    var password_hashed = hash(_senha);
    var data = {
        user: _login,
        pass: password_hashed
    }
    var request = $.ajax({
        url: "./backend/login.php",
        type: "post",
        dataType: 'json',
        data: data,
        async: false
    });

    //trabalhar com json
    console.log(request.responseText);
    userMatch = JSON.parse(request.responseText);
    console.log(userMatch);
    return userMatch;
}


function register_user(_nome, _sobrenome, _email, _apelido, _telefone, _senha){
    var password = hash(_senha);
    var userData = {
        nome: _nome,
        sobrenome: _sobrenome,
        email: _email,
        apelido: _apelido,
        telefone: _telefone,
        senha: password
    }


    var request = $.ajax({
        url: "./backend/register.php",
        type: "post",
        dataType: 'json',
        data: userData,
        async: false
    });
    console.log(request.responseText);
    var res_back = JSON.parse(request.responseText);

    if(res_back.sucess){
        window.location = './form-confirmado';
        return true;
    }else{
        alert($res_back.erro_msg);
        return false;
    }


}

function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
}

function handshake_status(){
    var handshakeCall = {
        call: 'status'
    }
    var request = $.ajax({
        url: "./backend/team_lib/_handshake.php",
        type: "post",
        dataType: 'json',
        data: handshakeCall,
        async: false
    });
    return request.responseText;
}
function negociate_handshake(){
    var chave_secreta = sjcl.codec.hex.fromBits(sjcl.hash.sha256.hash( Math.random() * (2000 - 100) + 100));

    console.log("chave_no_front: \n"+chave_secreta);

    var pubkey_request = $.ajax({
        url: "./backend/team_lib/_getPubKey.php",
        async: false
    });
    var pubkey = pubkey_request.responseText;

    console.log("pubkey resposta do servidor: \n"+pubkey);
    var crip_simetrico = new JSEncrypt();
    crip_simetrico.setKey(pubkey);

    var chave_secreta_criptografada = crip_simetrico.encrypt(chave_secreta);
    console.log("chave secreceta criptografada na publica front: \n"+chave_secreta_criptografada);

    var handshakeCall = {
        call: 'negociate',
        key: chave_secreta_criptografada
    }
    var request = $.ajax({
        url: "./backend/team_lib/_handshake.php",
        type: "post",
        dataType: 'json',
        data: handshakeCall,
        async: false
    });

    var chave_back = request.responseText;
    console.log("negocite resposta: \n"+chave_back);

}
function handshake(){//handshake control
    var status = handshake_status();
    console.log("handshake status: \n"+status);
    status = JSON.parse(status);
    if(!status.status){
        negociate_handshake();
    }

}
handshake();
//Reset de seção com ajax
