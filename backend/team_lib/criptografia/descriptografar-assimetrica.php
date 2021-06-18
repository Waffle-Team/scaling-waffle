<?php

function descriptografar($dadoscriptografados, $chave){

    openssl_private_decrypt(base64_decode($dadoscriptografados), $mensagem_descriptografada, $chave, OPENSSL_ZERO_PADDING);

    return $mensagem_descriptografada;
}

?>