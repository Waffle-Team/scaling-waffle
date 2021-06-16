<?php
require_once (dirname(__FILE__).'\team_lib\functions.php');
require_once (dirname(__FILE__).'\team_lib\filtro.php');

if(!isset($_POST['senha']) or !isset($_POST['token']) or !isset($_POST['user'])){
    exit();
}


$JsonReturn = new stdClass();

$nova_senha = $_POST['senha'];
$token_user = $_POST['token'];
$user = $_POST['user'];

$user_data = pesquisaUsuario($user);

$token_server = $user_data['nome'].substr($user_data['senha'], -10);
$token_server = hash('md5', $token_server);

if ($token_user == $token_server){
    alteraSenha($user, $nova_senha);
    $JsonReturn->sucess = TRUE;
    $JsonReturn->erro_msg = 'senha alterada com sucesso';
    print(json_encode($JsonReturn));
}else{
    $JsonReturn->sucess = FALSE;
    $JsonReturn->erro_msg = 'Token invalido';
    print(json_encode($JsonReturn));
}
