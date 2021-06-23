//cookies function
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++){
        var c = ca[i];
        while (c.charAt(0) == ' '){
            c = c.substring(1);
        }if (c.indexOf(name) == 0){
            return c.substring(name.length, c.length);
        }
    }
    return "";
}



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
        url: "http://"+location.hostname+"/backend/team_lib/_handshake.php",
        type: "post",
        dataType: 'json',
        data: handshakeCall,
        async: false
    });
    return request.responseText;
}
function negociate_handshake(){
    //gerando chave AES e vetor de inicialização
    var chave_secreta = sjcl.codec.hex.fromBits(sjcl.hash.sha256.hash(Math.random() * (2000 - 100) + 100));
    var iv = sjcl.codec.hex.fromBits(sjcl.hash.sha256.hash(Math.random() * (200 - 10) + 10));

    //substrings para deixar chaver de tamnho compativel com AES-256
    chave_secreta = chave_secreta.substring(0, 64);
    iv = iv.substring(0, 32);


    console.log("chave_tentativa: \n" + chave_secreta);
    console.log("iv_tentativa: \n" + iv);

    //request da chave publica
    var pubkey_request = $.ajax({
        url: "http://"+location.hostname+"/backend/team_lib/_getPubKey.php",
        async: false
    });
    var pubkey = pubkey_request.responseText;

    console.log("pubkey resposta do servidor: \n"+pubkey);
    var crip_asimetrico = new JSEncrypt();
    crip_asimetrico.setKey(pubkey);

    var iv_criptografado = crip_asimetrico.encrypt(chave_secreta);
    var chave_secreta_criptografada = crip_asimetrico.encrypt(chave_secreta);
    console.log("chave secreceta criptografada na publica front: \n"+ chave_secreta_criptografada);
    console.log("iv criptografada na publica front: \n"+ iv_criptografado);

    var handshakeCall = {
        call: 'negociate',
        key: chave_secreta_criptografada,
        iv: iv_criptografado
    }
    var request = $.ajax({
        url: "http://"+location.hostname+"/backend/team_lib/_handshake.php",
        type: "post",
        dataType: 'json',
        data: handshakeCall,
        async: false
    });


    //salvar chave nos cookies
    var chave_back = JSON.parse(request.responseText);
    if(chave_back.sucess){
        setCookie('handshake_key', chave_secreta);
        setCookie('handshake_iv', iv);
        /*
        temp start
        */
        console.log("chave aceita: " + getCookie('handshake_key'));
        console.log("iv aceito: " + getCookie('handshake_iv'));

        /*
        temp end
        */
    }else{
        console.log("chave recusada");
        alert("A chave AES foi recusada pelo servidor");
    }
}
function handshake(){//handshake control
    var status = handshake_status();
    console.table("handshake status: \n"+status);
    status = JSON.parse(status);
    if(!status.status){
        negociate_handshake();
    }

}


//classes
class AesCript{
    constructor(){
        this.key = getCookie('handshake_key');
        this.iv = getCookie('handshake_iv');
    }
    encrypt(mensage){
        return CryptoJS.AES.encrypt(mensage, this.key,{
            iv: this.iv,
            padding: CryptoJS.pad.Pkcs7,
            mode: CryptoJS.mode.CBC

        }).toString();
    }
    decrypt(mensage){
        return CryptoJS.AES.decrypt(mensage, this.key,{
            iv: this.iv,
            padding: CryptoJS.pad.Pkcs7,
            mode: CryptoJS.mode.CBC

        }).toString(CryptoJS.enc.Utf8);
    }
}
$(document).ready(function(){
    handshake();
    
});
