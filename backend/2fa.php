<?php
require_once (dirname(__FILE__).'\team_lib\functions.php');
require_once (dirname(__FILE__).'\team_lib\_criptoClasses.php');

session_start();
$JsonReturn = new stdClass();

if(!isset($_SESSION['senha'])){
    $_SESSION['senha'] = FALSE;
}


if ($_SESSION['senha'] == FALSE){
    $JsonReturn->sucess = FALSE;
    $JsonReturn->msg = 'A senha do usuario ainda nao foi verificada';
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
