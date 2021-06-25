$(document).ready(function() {
    var codigo = getUrlParameter('codigo');
    var apelido = getUrlParameter('apelido');

    var c12 = new AesCript();
    codigo = c12.encrypt(codigo);
    apelido = c12.encrypt(apelido);


    var mailData = {
        codigo: codigo,
        apelido: apelido
    }
    request = $.ajax({
        url: "./backend/verificar_email.php",
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
        $('#bt_login').css('display','block');
    }else{
        $('#mensage').html($msg);
    }


});
