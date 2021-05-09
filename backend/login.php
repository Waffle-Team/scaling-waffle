<?php

require_once 'register.php';

$login = $_POST['user'];
$senha = $_POST['pass'];

$informacoes = pesquisaUsuario($login);

if ($informacoes != false) {
    $senhacomsalt = hashsenha($informacoes['nome'], $informacoes['sobrenome'], $informacoes['email'], $informacoes['telefone'], $senha);
    if ($senhacomsalt == $informacoes['senha']) {
        //as senhas batem o usuario esta autenticado
    }
    else {
        //senha incorreta
    }
}
else{
    //nao encontrou
}



/*
Autenticação MFA

Gerar sessão
*/

print(true);