<?php
require_once (dirname(__FILE__).'\functions.php');


class RSA_CRIPT{
    private $pubkey;
    private $privkey;

    function __construct(){
        $this->privkey = fread(fopen('privateKey.pem', "r"),filesize("privateKey.pem"));
        $this->pubkey =fread(fopen('publicKey.pem', "r"),filesize("publicKey.pem"));
    }


    public function getPubKey(){
        return $this->pubkey;
    }

    /*
    Retorna dados encriptados em base64
    */
    public function encrypt($dados){
        if(openssl_public_encrypt($dados, $encrypted, $this->pubkey)){
            $dados = base64_encode($encrypted);
        }else{
            /*
            Exessão ocorre devido ao tamnho dos dados a serem criptografados, em caso de exeção considerar
            almentar o tamnho da chave ou mudar a estratégia, como é utilizado apenas para o handshake da chave
            simetrica, provavelmente não teremos problemas.
            */

            throw new Exception('Dados extensos de mais para serem criptografados');
        }
        return $dados;
    }
    public function decrypt($dados){
        if (openssl_private_decrypt(base64_decode($dados), $decrypted, $this->privkey)){
            $dados = $decrypted;
        }else{
            $dados = '';
        }

        return $dados;
    }
}

function handshake(){//handshake controler
    $JsonReturn = new stdClass();
    $crip_assimetrico = new RSA_CRIPT();
    $_SESSION['handshake'] = FALSE;//chumbo
    $_SESSION['handshake_time'] = time();
    $call = $_POST['call'];//sanitizar o post call

    switch ($call) {
        case 'status':
            $JsonReturn->status = $_SESSION['handshake'];
            break;
        case 'negociate':
            $secret_key = $_POST['key'];//sanitizar
            $_SESSION['AES_key'] = $secret_key;
            $JsonReturn->chave_no_back = $secret_key;
            break;
        default:
            echo "call status invalida";
            break;
    }
    print(json_encode($JsonReturn));
}
/*
//session_status retornos possiveis
_DISABLED = 0
_NONE = 1
_ACTIVE = 2
*/
$crip_assimetrico = new RSA_CRIPT();
$JsonReturn = new stdClass();
$status = session_status();

if($status == 0){//Servidor apache mal configurado
    $JsonReturn->sucess = FALSE;
    $JsonReturn->msg = "As funções de seção estão desativadas no servidor";
}elseif ($status == 1){//Sessão não foi inicializada no arquivo, iniciar seção e inicirar handshake
    session_start();
    handshake();
}else{//Sesão ativa e pronta para iniciar o processo de negociação de chave
    handshake();
}





?>
