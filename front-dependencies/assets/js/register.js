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
        //catando os valores dos campos e remomendo espaços antes e depois
        var nome = $('#nome').val().trim();
        var sobrenome = $('#sobrenome').val().trim();
        var email = $('#email').val().trim();
        var apelido = $('#apelido').val().trim();
        var telefone = $('#telefone').val().trim();
        var senha = $('#senha').val().trim();
        var confirmarsenha = $('#confirmarsenha').val().trim();

        //variavel de apoio atualizada pelos testes
        var valid_inputs = true;

        // check campos de input se input n passa no test deixa a borda do input vermelha

        //nome
        if(nome == ''){
            $('#alert-area').append("- O campo 'Nome' é obrigatorio\n");
            $('#nome').css('border','1px red ridge');
            valid_inputs = false;
        }else{
            $('#nome').css('border','0');
        }

        //sobrenome
        if (sobrenome == '') {
            $('#alert-area').append("- O campo 'Sobrenome' é obrigatorio\n");
            $('#sobrenome').css('border','1px red ridge');
        }else{
            $('#sobrenome').css('border','0');
        }

        //sobrenome
        if(email == ''){
            $('#alert-area').append("- O campo 'Email' é obrigatorio\n");
            $('#email').css('border','1px red ridge');
            valid_inputs = false;
        }else if(!validaEmail(email)){
            $('#alert-area').append("- Digite um email valido\n");
            $('#email').css('border','1px red ridge');
            valid_inputs = false;
        }else{
            $('#email').css('border','0');
        }


        //apelido
        if(apelido == ''){
            $('#alert-area').append("- O campo 'Apelido' é obrigatorio\n");
            $('#apelido').css('border','1px red ridge');
            valid_inputs = false;
        }else{
            $('#apelido').css('border','0');
        }

        //telefone
        if(telefone == ''){
            //implementar verificação de telefone mais rigida
            $('#alert-area').append("- O campo 'Telefone' é obrigatorio\n");
            $('#telefone').css('border','1px red ridge');
            valid_inputs = false;
        }else{
            $('#telefone').css('border','0');
        }

        // check senha
        if(!validaSenha(senha)){
            $('#alert-area').append("- Senha fraca:\n");
            $('#alert-area').append("**deve conter ao menos uma letra minúscula\n");
            $('#alert-area').append("**deve conter ao menos uma letra maiúscula\n");
            $('#alert-area').append("**deve conter ao menos um caractere especial\n");
            $('#alert-area').append("**tamanho minimo de 10 caracteres\n");
            valid_inputs = false;
        }
        if (senha !== confirmarsenha) {
            $('#alert-area').append("As senhas devem ser iguais\n");
            $('#confirmarsenha').css('border','1px red ridge');
            valid_inputs = false;
        }else{
            $('#confirmarsenha').css('border','0');
        }

        //chama função do master para registrar usuario, to colocando todas as funções lá
        if (valid_inputs) {
            var return_registro = register_user(nome, sobrenome, email, apelido, telefone, senha);
        }

        if(return_registro){
            console.log('Usuario registrado temporariamente');
            window.location.href = './form-confirmar.html';

        }else{
            console.log("Os inputs do usuario não são validos");
        }



    });

});
