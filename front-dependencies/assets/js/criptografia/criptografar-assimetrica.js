//tipo 1 = register, tipo 2 = login, tipo 3 = recupera senha
function criptografiassimetrica(tipo, dados){

    var publica = `-----BEGIN PUBLIC KEY-----
    MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvIBVbJ/+X5ec6tyLNxDB
    XnoOENSiGZpKgTtF/k/0QyJhzG22v3iho47g20Ybb6rRahS5kRoGkVmR3SDy5GEj
    Jm9knD/Tc6uGAhvcKhRmg8EyyFOVL1+RadoWUnGJdOrdCCjV7vNaS422aTG+tC5S
    hme1cNsncPTSHwzaXwYKRFMrozLwNJH9l00pWNLzFiGEZCVdOPl/eWQ/LB8dZ31V
    0gsrtvHJSJ6Rf1kzvcZWLRrHOSAZjPNwYFY0VQu8RBvbHZz97TibYP1ZwNJkWbIz
    q+eh3mRZizpwiEFaX6wALSf1e+4/T6ujHwv3RCeS5dbj4Pocxswnvn0zUOE5mMKp
    MwIDAQAB
    -----END PUBLIC KEY-----
    `;

    var valores = JSON.stringify(dados);

    //cria um objeto da classe JSEncrypt
    var criptografia = new JSEncrypt({default_key_size: 2048});
    // adiciona a chave pública ao objeto
    criptografia.setPublicKey(publica);

    // Realiza a criptografia
    var mensagem_criptografada = criptografia.encrypt(valores);
    console.log(mensagem_criptografada)

    if (tipo == 1){
        var request = $.ajax({
            url: "/backend/register.php",
            type: 'post',
            data: {dados: mensagem_criptografada},
            dataType: "json",
            async: false
        });
        return request.responseText;
    }
    else if(tipo == 2){
        var request = $.ajax({
            url: "./backend/login.php",
            type: "post",
            data: {dados: mensagem_criptografada},
            dataType: 'json',
            async: false
        });
        return request.responseText;
    }
    else if(tipo == 3){  
        var request = $.ajax({
            url: "./backend/recuperacao.php",
            type: "post",
            data: {dados: mensagem_criptografada},
            dataType: 'json',
            async: false
        });
        return request.responseText;
    }
}