<?php
require_once 'team_lib/functions.php';

session_start();
if ($_SESSION['senha'] == FALSE){
    exit();
}

$codigo = $_POST['codigo'];
$codigo_db = get_2fa($_SESSION['user_name']);

$codigo = hash('md5', $codigo.date('d'));

$JsonReturn = new stdClass();
$JsonReturn->sucess = FALSE;
$JsonReturn->msg = '';

if ($codigo == $codigo_db){
    $_SESSION['2FA'] = TRUE;
    $JsonReturn->sucess = FALSE;
    $JsonReturn->msg = '';
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
