<?php
require_once 'team_lib/functions.php';
require_once 'team_lib/mail.php';

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

        //gerar codido 6 digitos aleatorio e enviar no email
        $key_space = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for ($i = 0; $i < 6; $i++) {
            $randstring[$i] = $key_space[rand(0, strlen($key_space))];
        }
        $randstring = implode("",$randstring);
        $mail_msg = 'Seu codigo de comfirmação é: '.$randstring;;
        email_2fa($mail_msg, $user_db['email']);

        //setar codigo aleatorio gerado e gravar no banco de dados
        $mail2f = hash('md5', $randstring.date('d'));
        set_2fa($mail2f, $login);

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
