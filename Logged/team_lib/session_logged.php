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
        if(time() >= $_SESSION['sess_validade']+300){//resataura a sessao a cada 5min
            unset($_SESSION);
            header("location: ../../backend/logout");
        }else{
            $_SESSION['sess_validade'] = time();
        }
    }
}

?>
