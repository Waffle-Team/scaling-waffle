<?php

require_once 'register.php';
require_once 'team_lib/functions.php';

if(isset ($_GET['codigo'])){
    $codigo = $_GET['codigo'];
    $apelido = $_GET['apelido']; // pega as duas variaveis da url
    $dados = pesquisaUsuario($apelido); //pega as informacoes na DB pelo functions.php a partir do apelido
    $chavedaconta = codigoverificacao($dados['nome'], $dados['sobrenome'], $dados['email'], $dados['telefone']); //recria o codigo a partir das informacoes
    if ($chavedaconta = $codigo) {
        validaConta($apelido); //se os codigo da url bate com o codigo feito com os dados da DB, altera na DB confirmado para 1
    }
    // echo "A conta foi validada";
}
else{
    die("Não foi possivel fazer a verificação");
}
