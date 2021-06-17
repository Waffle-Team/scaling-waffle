<?php
session_start();


if (!$_SESSION){
    header('location:../form-login');
    

}elseif(!($_SESSION['2FA'] and $_SESSION['senha'])){
    $_SESSION['user_name'] = NULL;
    $_SESSION['senha'] = NULL;
    $_SESSION['2FA'] = NULL;
    header('location:../form-login');
    
}else{
    //Resetar sessão a cada 5min;
    if(!isset($_SESSION['sess_validade'])){//primeiro login
        $_SESSION['sess_validade'] = time();
    }else{
        if(time() >= $_SESSION['sess_validade']+300){//mata a sessão AFK 5min
            unset($_SESSION);
            header("location: ../../backend/logout");
        }else{//restaura sessao
            $_SESSION['sess_validade'] = time();
        }
    }

    //sessão de uma hora
    if(!isset($_SESSION['1h_validade'])){//primeiro login
        $_SESSION['1h_validade'] = time();
    }else{
        if(time() >= $_SESSION['1h_validade']+3600){//mata a sessão 1h
            unset($_SESSION);
            header("location: ../../backend/logout");
        }
    }
}

?>
