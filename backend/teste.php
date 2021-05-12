<?php
    session_id('12');//Seta o ID da seção pra 12, se não passar id é gerado aleatoriamente
    session_start();//Inicia area de seção no código
    $_SESSION['OI'] = "VARIAVEL OI"; //Setar variaveis no session
    var_dump(session_id());
    var_dump($_SESSION);
    print('</br>');
    session_unset();//Deleta tods as vativeis da seção
    session_destroy();//Destroi a seção com o id e outras informações
    var_dump(session_id());
    var_dump($_SESSION);
?>
