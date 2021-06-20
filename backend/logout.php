<?php
session_start();//Inicia area de codigo de seção
session_unset();//deleta variaveis da sessão
if (isset($_SERVER['HTTP_COOKIE'])) {//deleta cookies
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie){
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
session_destroy();//Destroi a seção
header('location: ../');


?>
