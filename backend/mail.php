<?php


// Definir o uso dos arquivos do PHPMailer
require './lib/PHPMailer.php';
require './lib/SMTP.php';
require './lib/Exception.php';

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
    $mail->Password   = "";
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
?>
