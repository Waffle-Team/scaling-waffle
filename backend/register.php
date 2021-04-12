<?php
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$apelido = $_POST['apelido'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];

/*
A fazer

*$nome & $sobrenome
    -verificar se contem somente letras A-Z
    -verificar se não temos espaços no final e começo da string
    -verificar se contem somente letras A-Z

*$email
    -verificar se é um email valido
    -verificar se não há espaçõs antes e depois da string

*$apelido
    -Verificar se apelido Tem somente letras, numeros e '_ , .'

*$telefone
    -verificar se telefone contem é um numero valido
    -tranformar em uma string com somente numeros

*$senha
    -Se o recebido é um valor de sha256
    -Fazer o salt do hash recebido (redundancia), salt deve ser "aleatorio";


registar usuario em uma tabela de usuarios temporarios

se tudo deu boa print true se não false
*/

$registrar = false // true (registrou o usuario na tabela temp) e false(não registrou o usuario)
print($registrar);//funciona como nosso return só que para enviar pro front



?>
