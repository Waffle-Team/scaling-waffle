<?php
require_once './team_lib/config_db.php';
require_once './team_lib/functions.php';
require_once './filtro.php';

$valido = true;

$nome = validar_texto($_POST['nome']);
$sobrenome = validar_texto($_POST['sobrenome']);
$email = validar_email($_POST['email']);
$apelido = validar_texto($_POST['apelido']);
$telefone = preg_replace('/[+|\-|.| ]/', '', validar_telefone($_POST['telefone'])); //ao validar e limpar o telefone, podem sobrar alguns caracteres e espacos, o preg_replace serve para removelos e deixar apenas o numero
$senha = $_POST['senha'];

//se qualquer valor estiver vazio, ele nao passou no filtro.php
if (empty($nome) || empty($sobrenome) || empty($email) || empty($apelido) || empty($telefone) || empty($senha)){
    $valido = false;
}

//testa se o email é valido
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $valido = false;
}

//faz o hash e o salt da senha, que ja passou por um hash
function hashsenha($nome, $sobrenome, $email, $telefone, $senha){
    $numerosini = implode('', array(substr($telefone, -2), substr($telefone, -4, -2)));
    $numerosfim = implode('', array(substr($telefone, -6, -4), substr($telefone, -8, -6)));
    $tamanho1 = strlen($email);
    $tamanho2 = strlen(implode('', array($nome, $sobrenome)));
    $hashtemperado = implode('', array($numerosini, $tamanho1, $senha, $numerosfim, $tamanho2));
    return hash("sha256", $hashtemperado);
}

$registrar = false; // true (registrou o usuario na tabela temp) e false(não registrou o usuario)
print($registrar); //funciona como nosso return só que para enviar pro front