<?php
require_once (dirname(__FILE__).'\team_lib\functions.php');
require_once (dirname(__FILE__).'\team_lib\mail.php');
require_once (dirname(__FILE__).'\team_lib\filtro.php');
require_once (dirname(__FILE__).'\team_lib\criptografia\descriptografar-assimetrica.php');

$dadoscriptografados = $_POST["dados"];
$chave = file_get_contents('team_lib/esteganografia-texto/resultado.txt');
$dados = json_decode(descriptografar($dadoscriptografados, $chave));

if( !isset($dados->nome) or 
    !isset($dados->sobrenome) or 
    !isset($dados->email) or 
    !isset($dados->apelido) or 
    !isset($dados->telefone) or 
    !isset($dados->senha)){
        exit();
}


$valido = TRUE;


$post_nome = $dados->nome;
$post_sobrenome = $dados->sobrenome;
$post_email = $dados->email;
$post_apelido = $dados->apelido;
$post_telefone = $dados->telefone;
$post_senha = $dados->senha;


$JsonReturn = new stdClass();

$nome = validar_texto($post_nome);
$sobrenome = validar_texto($post_sobrenome);
$email = validar_email($post_email);
$apelido = validar_texto($post_apelido);
$telefone = preg_replace('/[+|\-|.| ]/', '', validar_telefone($post_telefone)); //ao validar e limpar o telefone, podem sobrar alguns caracteres e espacos, o preg_replace serve para removelos e deixar apenas o numero
$senha = $post_senha;

//se qualquer valor estiver vazio, ele nao passou no filtro.php
if (empty($nome) || empty($sobrenome) || empty($email) || empty($apelido) || empty($telefone) || empty($senha)){
    $valido = FALSE;
    $JsonReturn->sucess = $valido;
    $JsonReturn->erro_msg = 'Inputs vazios foram enviados ao backend';
    print(json_encode($JsonReturn));//retorno
    exit();
}

//testa se o email é valido
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $valido = FALSE;
    $JsonReturn->sucess = $valido;
    $JsonReturn->erro_msg = 'Inputs vazios foram enviados ao backend';
    print(json_encode($JsonReturn));//retorno
    exit();
}



//se nenhuma etapa falhou, cria o hash junto do salt e adicionar todos esses dados no banco de dados
if ($valido == TRUE) {
    $hashsenha = hashsenha($nome, $sobrenome, $email, $telefone, $senha);
    if (insereUsuario($nome, $sobrenome, $email, $apelido, $telefone, $hashsenha) == TRUE){
        $codigo = codigoverificacao($nome, $sobrenome, $email, $telefone); //codigo da verificacao
        $mensagem = '<a href=http://localhost/form-confirmado.html?codigo='.$codigo.'&apelido='.$apelido.'>Verificar conta</a>';// mensagem que sera mandada para verificacao

        emaildeverificacao($mensagem, $email); // manda o email para verificar a conta

        $JsonReturn->sucess = TRUE;
        $JsonReturn->erro_msg = '';
        print(json_encode($JsonReturn)); //caso seja possivel adiciona-lo no banco de dados, retorna para o ajax do master.js como true
    }else{
        $JsonReturn->sucess = FALSE;
        $JsonReturn->erro_msg = 'Usuario ja existe';
        print(json_encode($JsonReturn));
    }
}
else{
    $JsonReturn->sucess = FALSE;
    $JsonReturn->erro_msg = 'erro desconhecido';
    print(json_encode($JsonReturn)); // caso nao seja possivel adicionar no banco de dados, ou alguma etava de verificacao falhe, retorna como false
}
?>
