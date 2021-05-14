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



//Reset de seção com ajax
