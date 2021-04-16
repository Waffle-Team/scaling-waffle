$(document).ready(function(){
    // limpando campos
    $('#nome').val('');
    $('#sobrenome').val('');
    $('#email').val('');
    $('#apelido').val('');
    $('#telefone').val('');
    $('#senha').val('');
    $('#confirmarsenha').val('');

    $('#alert-area').html('');

    $("#bt-registrar").click(function(){
        $('#alert-area').html('');
        //catando os valores dos campos e remomendo espaçõs antes e depois
        var nome = $('#nome').val().trim();
        var sobrenome = $('#sobrenome').val().trim();
        var email = $('#email').val().trim();
        var apelido = $('#apelido').val().trim();
        var telefone = $('#telefone').val().trim();
        var senha = $('#senha').val().trim();
        var confirmarsenha = $('#confirmarsenha').val().trim();

        //variavel de apoio atualizada pelos testes
        var valid_imputs = false;

        // check campos de input se imput n passa no test deixa a borda do imput vermelha
        if(nome == ''){
            $('#alert-area').append("- O campo 'Nome' é obrigatorio\n");
            $('#nome').css('border','1px red ridge');
            valid_imputs = false;
        }else{
            $('#nome').css('border','0');
            valid_imputs = true;
        }


        if (sobrenome == '') {
            $('#alert-area').append("- O campo 'Sobrenome' é obrigatorio\n");
            $('#sobrenome').css('border','1px red ridge');
            valid_imputs = false;
        }else{
            $('#sobrenome').css('border','0');
            valid_imputs = true;
        }

        if(email == ''){
            $('#alert-area').append("- O campo 'Email' é obrigatorio\n");
            $('#email').css('border','1px red ridge');
            valid_imputs = false;
        }else if(!validaEmail(email)){
            $('#alert-area').append("- Digite um email valido\n");
            $('#email').css('border','1px red ridge');
            valid_imputs = false;
        }else{
            $('#email').css('border','0');
            valid_imputs = true;
        }

        if(apelido == ''){
            $('#alert-area').append("- O campo 'Apelido' é obrigatorio\n");
            $('#apelido').css('border','1px red ridge');
            valid_imputs = false;
        }else{
            $('#apelido').css('border','0');
            valid_imputs = true;
        }

        if(telefone == ''){
            //implementar verificação de telefone mais rigida
            $('#alert-area').append("- O campo 'Telefone' é obrigatorio\n");
            $('#telefone').css('border','1px red ridge');
            valid_imputs = false;
        }else{
            $('#telefone').css('border','0');
            valid_imputs = true;
        }

        // check senha
        if(!validaSenha(senha)){
            $('#alert-area').append("- Senha fraca:\n");
            $('#alert-area').append("**deve conter ao menos uma letra minúscula\n");
            $('#alert-area').append("**deve conter ao menos uma letra maiúscula\n");
            $('#alert-area').append("**deve conter ao menos um caractere especial\n");
            $('#alert-area').append("**tamanho minimo de 10 caracteres\n");
            valid_imputs = false;
        }
        if (senha !== confirmarsenha) {
            $('#alert-area').append("As senhas devem ser iguais\n");
            $('#confirmarsenha').css('border','1px red ridge');
            valid_imputs = false;
        }else{
            $('#confirmarsenha').css('border','0');
            valid_imputs = true;
        }

        //chama função do master para registrar usuario, to colocando todas as funções lá
        var return_registro = register_user(nome, sobrenome, email, apelido, telefone, senha);

        if(return_registro){
            console.log('Usuario registrado temporariamente');
            window.location.href = './form-confirmar.html';

        }else{
            console.log("Os inputs do usuario não são validos");
        }



    });

});
