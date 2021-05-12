<?php
require_once 'team_lib/functions.php';

$login = $_POST['user'];
$senha = $_POST['pass'];

$user_db = pesquisaUsuario($login);

//Objeto para retorno do json
//Objeto->chave = valor;
$JsonReturn = new stdClass();
$JsonReturn->sucess = FALSE;
$JsonReturn->msg = '';


if ($user_db != false) {
    $senha_salt = hashsenha($user_db['nome'], $user_db['sobrenome'], $user_db['email'], $user_db['telefone'], $senha);
    if ($senha_salt == $user_db['senha']) {
        //as senhas batem o usuario esta autenticado
        session_start();
        $_SESSION['login'] = TRUE;
        $_SESSION['senha'] = TRUE;
        $_SESSION['2FA'] = FALSE;
        //gerar codido 6 digitos aleatorio

        $JsonReturn->sucess = TRUE;
        $JsonReturn->msg = '';
    }
    else{
        //senha incorreta
        $JsonReturn->sucess = FALSE;
        $JsonReturn->msg = 'Usuario ou senha incorretos';
    }
}
else{
    $JsonReturn->sucess = FALSE;
    $JsonReturn->msg = 'Usuario não existe';
}
print(json_encode($JsonReturn));
