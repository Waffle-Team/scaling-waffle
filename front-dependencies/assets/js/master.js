function validaSenha(senha){
    /*

    /^
      (?=.*\d)              // deve conter ao menos um dígito
      (?=.*[a-z])           // deve conter ao menos uma letra minúscula
      (?=.*[A-Z])           // deve conter ao menos uma letra maiúscula
      (?=.*[$*&@#])         // deve conter ao menos um caractere especial
      [0-9a-zA-Z$*&@#]{10,}  // deve conter ao menos 10 dos caracteres mencionados
    $/

    */
    var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/;
    return regex.test(senha);

}
function validaEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function hash(entrada){
    //implementar salt
    var hash = sjcl.hash.sha256.hash(entrada);
    var hashHex = sjcl.codec.hex.fromBits(hash);
    return hashHex;
}
function login_user(login, senha){
    var password_hashed = hash(senha);
    var data = {
        user: login,
        pass: password_hashed
    }
    request = $.ajax({
        url: "./backend/login.php",
        type: "post",
        dataType: 'json',
        data: data,
        async: false
    });
    user_passUser_match = request.responseText;

    if(user_passUser_match == "login_sucess"){
        return true;
        window.location.href = './form-codigo.html';
    }else{
        return false;
    }
}
function register_user(_nome, _sobrenome, _email, _apelido, _telefone, _senha){
    var password = hash(senha);
    var userData = {
        nome: _nome,
        sobrenome: _sobrenome,
        email: _email,
        apelido: _apelido,
        telefone: _telefone,
        senha: password
    }


    request = $.ajax({
        url: "./backend/register.php",
        type: "post",
        dataType: 'json',
        data: userData,
        async: false
    });

    if(request.responseText == true){
        return true;
    }else{
        //retornar erros futuramente para conseguir informar ao user o que rolou
        return false;
    }

}
