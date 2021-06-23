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
?>
