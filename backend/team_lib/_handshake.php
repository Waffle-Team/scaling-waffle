<?php
// DEBUG: dev here
class AES_CRIPT{
    private $secret_key;
    private $iv;

    function __construct(){
        if(!isset($_SESSION['AES_key'])){
            throw new Exception('$_SESSION["AES_key"] não existe');
        }
        if(!isset($_SESSION['AES_iv'])){
            throw new Exception('$_SESSION["AES_iv"] não existe');
        }
        $this->secret_key = $_SESSION['AES_key'];
        $this->secret_key = $_SESSION['AES_iv'];
    }

    public function encrypt($value){
        $encrypted_data = openssl_encrypt($value, 'aes-256-cbc', $this->secret_key, OPENSSL_RAW_DATA, $this->iv);
        return base64_encode($encrypted_data);
    }
    public function decrypt($value){
        $value = base64_decode($value);
        $data = openssl_decrypt($value, 'aes-256-cbc', $this->secret_key, OPENSSL_RAW_DATA, $this->iv);
        return $data;
    }

}
class RSA_CRIPT{
    private $pubkey;
    private $privkey;

    function __construct(){
        //implementar gerenciamento de segredos
        $this->privkey = fread(fopen('privateKey.pem', "r"),filesize("privateKey.pem"));
        $this->pubkey = fread(fopen('publicKey.pem', "r"),filesize("publicKey.pem"));
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


    $call = $_POST['call'];//sanitizar o post call
    switch ($call) {
        case 'status':
            $JsonReturn->status = $_SESSION['handshake'];
            /*
            temp start
            */
                            //$JsonReturn->key = $_SESSION['AES_key'];
            /*
            temp end
            */
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

$_SESSION['handshake'] = FALSE;

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
