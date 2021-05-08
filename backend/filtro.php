<?php

//limpa os valores para evitar sql injection

function validar_texto($texto){
    if(!empty($texto)){
        $cortado = trim($texto);
        $limpo = filter_var($cortado, FILTER_SANITIZE_STRING);
        return $limpo;
    }
    return '';
}

function validar_email($email){
    if(!empty($email)){
        $cortado = trim($email);
        $limpo = filter_var($cortado, FILTER_SANITIZE_EMAIL);
        return $limpo;
    }
    return '';
}

function validar_telefone($telefone){
    if(!empty($telefone)){
        $cortado = trim($telefone);
        $limpo = filter_var($cortado, FILTER_SANITIZE_NUMBER_INT);
        return $limpo;
    }
    return '';
}
?>