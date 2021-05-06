<?php
// require_once './team_lib/config_db.php';
// require_once './team_lib/functions.php';
require_once './filtro.php';

$valido = true;

$nome = validar_texto($_POST['nome']);
$sobrenome = validar_texto($_POST['sobrenome']);
$email = "felipe.a.d.noleto@gmail.com"; //validar_email($_POST['email']);
$apelido = validar_texto($_POST['apelido']);
$telefone = //validar_telefone($_POST['telefone']);
$senha = $_POST['senha'];



//se qualquer valor estiver vazio, ele nao passou na validacao
if (empty($nome) || empty($sobrenome) || empty($email) || empty($apelido) || empty($telefone) || empty($senha)){
    $valido = false;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $valido = false;
}

preg_replace('/[+|\-|.]/', '', $telefone);

function hashsenha($senha, $telefone){
    $numeros = implode('', array(substr($telefone, -4, -2), substr($telefone, -6, -4)));
    $tamanho = strlen($email);
}


/*
A fazer

*$senha
    -Se o recebido é um valor de sha256
        -Regex \b[A-Fa-f0-9]{64}\b
    -Fazer o salt do hash recebido (redundancia), salt deve ser "aleatorio";


registar usuario em uma tabela de usuarios temporarios

se tudo deu boa print true se não false
*/
$registrar = false; // true (registrou o usuario na tabela temp) e false(não registrou o usuario)
print($registrar);//funciona como nosso return só que para enviar pro front