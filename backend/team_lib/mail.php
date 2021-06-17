<?php


// Definir o uso dos arquivos do PHPMailer
require (dirname(__FILE__).'\..\lib\Mailer\PHPMailer.php');
require (dirname(__FILE__).'\..\lib\Mailer\SMTP.php');
require (dirname(__FILE__).'\..\lib\Mailer\Exception.php');

// Usar dos arquivos do PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function emaildeverificacao($mensagem, $email){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure = 'tls';
    $mail->Username   = 'scalingwaffle@gmail.com';
    $mail->Password   = "Gamb26feit.";
    $mail->Subject = "Verificação da conta Waffle";
    $mail->setFrom("scalingwaffle@gmail.com");
    $mail->isHTML(true);
    $mail->Body = $mensagem;
    $mail->addAddress($email);
    $mail->Port = 587;
    // Se foi enviado, notificar
    if($mail->send()){
        $send = TRUE;
    }
    // Se não foi enviado, notificar
    else{
        $send = $mail->ErrorInfo;
    }
    $mail->smtpClose();

    return $send;
}
function email_2fa($mensagem, $email){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure = 'tls';
    $mail->Username   = 'scalingwaffle@gmail.com';
    $mail->Password   = "Gamb26feit.";
    $mail->Subject = "Codigo de Verificação waffle";
    $mail->setFrom("scalingwaffle@gmail.com");
    $mail->isHTML(true);
    $mail->Body = $mensagem;
    $mail->addAddress($email);
    $mail->Port = 587;
    // Se foi enviado, notificar
    if($mail->send()){
        $send = TRUE;
    }
    // Se não foi enviado, notificar
    else{
        $send = $mail->ErrorInfo;
    }
    $mail->smtpClose();

    return $send;
}
function email_rec($mensagem, $email){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure = 'tls';
    $mail->Username   = 'scalingwaffle@gmail.com';
    $mail->Password   = "Gamb26feit.";
    $mail->Subject = "Recuperação de senha";
    $mail->setFrom("scalingwaffle@gmail.com");
    $mail->isHTML(true);
    $mail->Body = $mensagem;
    $mail->addAddress($email);
    $mail->Port = 587;
    // Se foi enviado, notificar
    if($mail->send()){
        $send = TRUE;
    }
    // Se não foi enviado, notificar
    else{
        $send = $mail->ErrorInfo;
    }
    $mail->smtpClose();

    return $send;
}
?>
