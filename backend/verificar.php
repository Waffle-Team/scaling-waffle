<?php

require_once 'team_lib/functions.php';


// pega as duas variaveis da url
$codigo = $_POST['codigo'];
$apelido = $_POST['apelido'];
$JsonReturn = new stdClass();


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
    $JsonReturn->msg = 'Não foi possivel verificar conta';
    print(json_encode($JsonReturn));//retorno
    exit();
}
