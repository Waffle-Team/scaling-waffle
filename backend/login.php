<?php
require_once (dirname(__FILE__).'\team_lib\functions.php');
require_once (dirname(__FILE__).'\team_lib\mail.php');
require_once (dirname(__FILE__).'\team_lib\criptografia\descriptografar-assimetrica.php');
require_once (dirname(__FILE__).'\team_lib\esteganografia-texto\decrypt.php');


$dadoscriptografados = $_POST["dados"];
$chave = decifrar(fopen("team_lib/esteganografia-texto/saida.txt", "r"), fopen("team_lib/esteganografia-texto/resultado.txt", "w"), fopen("team_lib/esteganografia-texto/script.txt", "r"));$dados = json_decode(descriptografar($dadoscriptografados, $chave));

if(!isset($dados->user) or !isset($dados->pass)){
    exit();
}

$login = $dados->user;
$senha = $dados->pass;
$user_db = pesquisaUsuario($login);


$JsonReturn = new stdClass();


if ($user_db != false) {
    if ($user_db['confirmado'] == 1){
        $senha_salt = hashsenha($user_db['nome'], $user_db['sobrenome'], $user_db['email'], $user_db['telefone'], $senha);
        if ($senha_salt == $user_db['senha']) {
            //as senhas batem o usuario esta autenticado
            session_start();
            $_SESSION['user_name'] = $user_db['apelido'];
            $_SESSION['senha'] = TRUE;
            $_SESSION['2FA'] = FALSE;

            //gerar codido 6 digitos aleatorio e enviar no email
            $key_space = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            for ($i = 0; $i < 6; $i++) {
                $randstring[$i] = $key_space[rand(0, strlen($key_space))];
            }
            $randstring = implode("",$randstring);
            $mail_msg = 'Seu codigo de comfirmação é: ['.$randstring.']';
            email_2fa($mail_msg, $user_db['email']);

            //setar codigo aleatorio gerado e gravar no banco de dados

            $mail2f = hash('md5', $randstring);
            set_2fa($mail2f, $login);

            $JsonReturn->sucess = TRUE;
            $JsonReturn->msg = '';
            print(json_encode($JsonReturn));
        }
        else{
            //senha incorreta
            $JsonReturn->sucess = FALSE;
            $JsonReturn->msg = 'Usuario ou senha incorretos';
            print(json_encode($JsonReturn));
        }
    }
    else{
        //email nao confirmado
        $JsonReturn->sucess = FALSE;
        $JsonReturn->msg = 'Email nao confirmado';
        print(json_encode($JsonReturn));
    }
}
else{
    $JsonReturn->sucess = FALSE;
    $JsonReturn->msg = 'Usuario não existe';
    print(json_encode($JsonReturn));
}
?>
