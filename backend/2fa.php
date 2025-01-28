<?php

require_once(dirname(__FILE__) . '/team_lib/functions.php');
require_once(dirname(__FILE__) . '/team_lib/_criptoClasses.php');

session_start();
$JsonReturn = new stdClass();

// Verifica se a senha foi verificada
if (empty($_SESSION['senha'])) {
    $_SESSION['senha'] = false;
}

if ($_SESSION['senha'] === false) {
    $JsonReturn->sucess = false;
    $JsonReturn->msg = 'A senha do usuário ainda não foi verificada';
    echo json_encode($JsonReturn);
    exit();
}

// Recebe o código POSTado
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';

// Recupera o código de verificação do banco de dados
$codigo_db = get_2fa($_SESSION['user_name']);

// Gera o hash MD5 do código informado
$codigoHash = hash('md5', $codigo);

// Verifica se o código informado é válido
if ($codigoHash === $codigo_db) {
    $_SESSION['2FA'] = true;
    $JsonReturn->sucess = true;
    $JsonReturn->msg = 'Código de verificação válido';
} else {
    // Se o código for inválido, reinicia a sessão e limpa dados sensíveis
    set_2fa('', $_SESSION['user_name']);
    $_SESSION['user_name'] = '';
    $_SESSION['senha'] = false;
    $_SESSION['2FA'] = false;
    $JsonReturn->sucess = false;
    $JsonReturn->msg = 'Código inválido. Tente fazer login novamente.';
}

// Retorna o JSON com o resultado
echo json_encode($JsonReturn);
?>
