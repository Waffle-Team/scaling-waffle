<?php
require_once (dirname(__FILE__).'\team_lib\functions.php');
require_once (dirname(__FILE__).'\team_lib\_criptoClasses.php');

$JsonReturn = new stdClass();

if (!isset($_POST['codigo']) or !isset($_POST['apelido'])) {
    $JsonReturn->sucess = FALSE;
    $JsonReturn->msg = 'Link de verificação invalido';
    print(json_encode($JsonReturn));//retorno
    exit();
}
session_start();
// pega as duas variaveis da url
$codigo = $_POST['codigo'];
$apelido = $_POST['apelido'];
$rc = new AES_CRIPT();
$codigo = $rc->decrypt($codigo);
$apelido = $rc->decrypt($apelido);


$dados = pesquisaUsuario($apelido); //pega as informacoes na DB pelo functions.php a partir do apelido
$chavedaconta = codigoverificacao($dados['nome'], $dados['sobrenome'], $dados['email'], $dados['telefone']); //recria o codigo a partir das informacoes

if ($chavedaconta == $codigo) {
    validaConta($apelido); //se os codigo da url bate com o codigo feito com os dados da DB, altera na DB confirmado para 1
    $JsonReturn->sucess = TRUE;
    $JsonReturn->msg = 'Email confimado com sucesso, agora é só começar a usar';
    print(json_encode($JsonReturn));//retorno
    exit();
}else{
    $JsonReturn->sucess = FALSE;
    $JsonReturn->msg = 'Codigo de verificação invalido';
    print(json_encode($JsonReturn));//retorno
    exit();
}
