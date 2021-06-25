<?php
include (dirname(__FILE__).'\..\lib\esteganografia\decrypt_dbpass.php');

class AES_CRIPT_Internal{

    function __construct(){
        $this->key = '2f1b593b807bd12a8a152b4c1e47b7f7';
        $this->iv = 'db11ef716478972d';
    }

    public function encrypt($value){
        return openssl_encrypt($value, "aes-256-cbc", $this->key, 0, $this->iv);
    }
    public function decrypt($value){
        return openssl_decrypt($value, "aes-256-cbc", $this->key, 0, $this->iv);
    }

}
class AES_CRIPT{
    function __construct(){
        if(!isset($_SESSION['AES_key'])){
            throw new Exception('$_SESSION["AES_key"] não existe');
        }
        if(!isset($_SESSION['AES_iv'])){
            throw new Exception('$_SESSION["AES_iv"] não existe');
        }
    }

    public function encrypt($value){
        return openssl_encrypt($value, "aes-256-cbc", $_SESSION['AES_key'], 0, $_SESSION['AES_iv']);
    }
    public function decrypt($value){
        return openssl_decrypt($value, "aes-256-cbc", $_SESSION['AES_key'], 0, $_SESSION['AES_iv']);
    }

}
class RSA_CRIPT{
    private $pubkey;
    private $privkey;

    function __construct(){
        $c = new AES_CRIPT_Internal();
        $this->privkey = $c->decrypt(fread(fopen(dirname(__FILE__).'\GenericBlob', "r"),filesize(dirname(__FILE__).'\GenericBlob')));//esteganografar a chave publica
        $this->pubkey = fread(fopen('publicKey.pem', "r"), filesize("publicKey.pem"));
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
?>
