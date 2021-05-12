<?php
require_once 'team_lib/functions.php';

session_start();
$JsonReturn = new stdClass();

if ($_SESSION['senha'] == FALSE){
    $JsonReturn->sucess = FALSE;
    $JsonReturn->msg = 'A senha do usuario ainda não foi verificada';
    print(json_encode($JsonReturn));
    exit();
}

$codigo = $_POST['codigo'];
$codigo_db = get_2fa($_SESSION['user_name']);

$codigo = hash('md5', $codigo);



if ($codigo == $codigo_db){
    $_SESSION['2FA'] = TRUE;
    $JsonReturn->sucess = TRUE;
    $JsonReturn->msg = 'Codigo deu match';
}else{
    set_2fa('',$_SESSION['user_name']);
    $_SESSION['user_name'] = '';
    $_SESSION['senha'] = FALSE;
    $_SESSION['2FA'] = FALSE;
    $JsonReturn->sucess = FALSE;
    $JsonReturn->msg = 'Tente o login novamente, codigo invalido';
}


print(json_encode($JsonReturn));
?>
