<?php
require_once 'team_lib/functions.php';
require_once 'filtro.php';
require_once 'mail.php';
$valido = true;

// $nome = validar_texto("Felipe"/*$_POST['nome']*/);
// $sobrenome = validar_texto("noleto"/*$_POST['sobrenome']*/);
// $email = validar_email("felipe.a.d.noleto@gmail.com"/*$_POST['email']*/);
// $apelido = validar_texto("splef"/*$_POST['apelido']*/);
// $telefone = preg_replace('/[+|\-|.| ]/', '', validar_telefone("041984004755"/*$_POST['telefone']*/)); //ao validar e limpar o telefone, podem sobrar alguns caracteres e espacos, o preg_replace serve para removelos e deixar apenas o numero
// $senha = "cykablyat"/*$_POST['senha']*/;

$nome = validar_texto($_POST['nome']);
$sobrenome = validar_texto($_POST['sobrenome']);
$email = validar_email($_POST['email']);
$apelido = validar_texto($_POST['apelido']);
$telefone = preg_replace('/[+|\-|.| ]/', '', validar_telefone($_POST['telefone'])); //ao validar e limpar o telefone, podem sobrar alguns caracteres e espacos, o preg_replace serve para removelos e deixar apenas o numero
$senha = $_POST['senha'];

//se qualquer valor estiver vazio, ele nao passou no filtro.php
if (empty($nome) || empty($sobrenome) || empty($email) || empty($apelido) || empty($telefone) || empty($senha)){
    $valido = false;
    print(false);
}

//testa se o email é valido
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $valido = false;
    print(false);
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

function codigoverificacao($nome, $sobrenome, $email, $telefone) { //cria um hash md5 baseado na formatacao de alguns dados do ususario
    $codigo = implode ('', array(substr($nome, strlen($nome)/2), substr($sobrenome, 0, strlen($sobrenome)/2), strlen($email), substr($telefone, strlen($telefone)/6, - strlen($telefone)/6)));
    return md5($codigo);
}

//se nenhuma etapa falhou, cria o hash junto do salt e adicionar todos esses dados no banco de dados
if ($valido == true) {
    $hashsenha = hashsenha($nome, $sobrenome, $email, $telefone, $senha);
    if (insereUsuario($nome, $sobrenome, $email, $apelido, $telefone, $hashsenha) == TRUE){
        $codigo = codigoverificacao($nome, $sobrenome, $email, $telefone); //codigo da verificacao
        $mensagem = "<a href='http://localhost/backend/verificar.php?codigo=$codigo&apelido=$apelido'>Verificar conta</a>"; // mensagem que sera mandada para verificacao
        emaildeverificacao($email, $mensagem); // manda o email para verificar a conta
        echo json_encode(true); //caso seja possivel adiciona-lo no banco de dados, retorna para o ajax do master.js como true
    }
}
else echo json_encode(false); // caso nao seja possivel adicionar no banco de dados, ou alguma etava de verificacao falhe, retorna como false

