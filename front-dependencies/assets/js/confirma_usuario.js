$(document).ready(function() {
    var codigo = getUrlParameter('codigo');
    var apelido = getUrlParameter('apelido');

    var mailData = {
        codigo: codigo,
        apelido: apelido
    }
    request = $.ajax({
        url: "./backend/verificar.php",
        type: "post",
        dataType: 'json',
        data: mailData,
        async: false
    });
    $res_back = JSON.parse(request.responseText);
    $confirmado = $res_back.sucess;
    $msg = $res_back.msg;
    
    if($confirmado){
        $('#mensage').html($msg);
    }else{
        $('#mensage').html($msg);
    }


});
