<?php
include (dirname(__FILE__).'\_criptoClasses.php');
function handshake(){//handshake controler
    $JsonReturn = new stdClass();


    $call = $_POST['call'];//sanitizar o post call
    switch ($call) {
        case 'status':
            $JsonReturn->status = $_SESSION['handshake'];

            if($_SESSION['handshake_time'] >= time() + 3600){//pede a troca de chave a cada 1hr de uso da chave simetrica
                $_SESSION['handshake'] = FALSE;
            }
            $JsonReturn->sucess = TRUE;
            $JsonReturn->msg = "";
            break;
        case 'negociate':
            $_SESSION['handshake_time'] = time();//seta momento de negociação de uma chave
            // IDEA: sanitizar posts
            $secret_key = $_POST['key'];
            $iv = $_POST['iv'];


            $cripher_RSA = new RSA_CRIPT();//decripta chave simetrica que o usuario deseja usar para comunicação
            $secret_key = $cripher_RSA->decrypt($secret_key);
            $iv = $cripher_RSA->decrypt($iv);

            $_SESSION['AES_key'] = $secret_key;//seta chave na seção do usuario
            $_SESSION['AES_iv'] = $iv;
            $_SESSION['handshake'] = TRUE;//seta flag de handshake

            $JsonReturn->sucess = TRUE;
            $JsonReturn->msg = "";
            break;
        default:
            $JsonReturn->sucess = FALSE;
            $JsonReturn->msg = "call status invalida";
            break;
    }
    print(json_encode($JsonReturn));
}
/*
    #session_status retornos possiveis#
    _DISABLED = 0
    _NONE = 1
    _ACTIVE = 2
*/

//temp start
    //session_start();
    //session_destroy();
//temp end

$JsonReturn = new stdClass();
$status = session_status();
if($status == 0){//Servidor apache mal configurado
    $JsonReturn->sucess = FALSE;
    $JsonReturn->msg = "As funções de seção estão desativadas no servidor";
}elseif ($status == 1){//Sessão não foi inicializada no arquivo, iniciar seção e inicirar handshake
    session_start();
    if(!isset($_SESSION['handshake'])){
        $_SESSION['handshake'] = FALSE;
    }
    if(!isset($_SESSION['AES_key'])){
        $_SESSION['AES_key'] = FALSE;
    }
    if(!isset($_SESSION['handshake_time'])){
        $_SESSION['handshake_time'] = FALSE;
    }
    handshake();
}else{//Sesão ativa e pronta para iniciar o processo de negociação de chave
    if(!isset($_SESSION['handshake'])){
        $_SESSION['handshake'] = FALSE;
    }
    if(!isset($_SESSION['AES_key'])){
        $_SESSION['AES_key'] = FALSE;
    }
    if(!isset($_SESSION['handshake_time'])){
        $_SESSION['handshake_time'] = FALSE;
    }
    handshake();
}

?>
