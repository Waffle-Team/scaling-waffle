<?php

 //scalingwaffle@gmail.com
 //gawamos@gmail.com

// Definir o uso dos arquivos do PHPMailer
require 'lib/PHPMailer/PHPMailer.php';
require 'lib/PHPMailer/SMTP.php';
require 'lib/PHPMailer/Exception.php';

// Usar dos arquivos do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    
// Usa do PHPMailer para o envio de um e-mail
$mail = new PHPMailer();

// Configurações do servidor
// Devine o uso de SMTP no envio
$mail->isSMTP();
// Informações específicadas pelo Google
$mail->Host = 'smtp.gmail.com';
// Habilita a autenticação SMTP
$mail->SMTPAuth = "true";
// Criptografia do envio SSL também é aceita
$mail->SMTPSecure = 'tls';
// Usuário da conta que for enviar o e-mail
$mail->Username   = 'scalingwaffle@gmail.com';
// Senha da conta que for enviar o e-mail
$mail->Password   = AAAAAAAAAAAA;// NÃO DEIXAR A CONTA SALVA NO CÓDIGO - CRIPTOGRAFAR POSTERIORMENTE
$mail->Subject = "E-mail de teste";// 'E-mail de teste';
// Define o remetente
$mail->setFrom("scalingwaffle@gmail.com");// ('scalingwaffle@gmail.com', 'Scaling Waffle');
// Conteúdo da mensagem
$mail->Body = "Sera que vai chegar agora?";// 'Chegou em <b>negrito</b>';
// Define o destinatário
$mail->addAddress("gawamos@gmail.com");////// Mudar para o e-mail que for inserido no input //////
// Porta do Google
$mail->Port = 587;
// Se foi enviado, notificar
if($mail->send()){
    echo "e-mail foi";
}
// Se não foi enviado, notificar
else{
    echo "e-mail n foi";
}
// Fechar a conexão
$mail->smtpClose();
?>