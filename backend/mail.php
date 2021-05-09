<?php

 //scalingwaffle@gmail.com
 //gawamos@gmail.com

// Definir o uso dos arquivos do PHPMailer
require './lib/PHPMailer.php';
require './lib/SMTP.php';
require './lib/Exception.php';

// Usar dos arquivos do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// // Usa do PHPMailer para o envio de um e-mail
// $mail = new PHPMailer();

// // Configurações do servidor
// // Define o uso de SMTP no envio
// $mail->isSMTP();
// // Informações específicadas pelo Google
// $mail->Host = 'smtp.gmail.com';
// // Habilita a autenticação SMTP
// $mail->SMTPAuth = "true";
// // Criptografia do envio SSL também é aceita
// $mail->SMTPSecure = 'tls';
// // Usuário da conta que for enviar o e-mail
// $mail->Username   = 'scalingwaffle@gmail.com';
// // Senha da conta que for enviar o e-mail
// $mail->Password   = "";// NÃO DEIXAR A CONTA SALVA NO CÓDIGO - CRIPTOGRAFAR POSTERIORMENTE
// $mail->Subject = "Assunto do e-mail";// 'E-mail de teste';
// // Define o remetente
// $mail->setFrom("scalingwaffle@gmail.com");// ('scalingwaffle@gmail.com', 'Scaling Waffle');
// //Define se a mensagem é html
// $mail->isHTML(true);
// // Conteúdo da mensagem
// $mail->Body = "<a href='http://localhost/backend/verificar.php?codigo=4b9b6e70cc65f67c34c81249cc6472e2&apelido=splef'>Verificar conta</a>";// 'Chegou em <b>negrito</b>';
// // Define o destinatário
// $mail->addAddress("felipe.a.d.noleto@gmail.com");////// Mudar para o e-mail que for inserido no input //////
// // Porta do Google
// $mail->Port = 587;
// // Se foi enviado, notificar
// if($mail->send()){
//     echo "e-mail foi";
// }
// // Se não foi enviado, notificar
// else{
//     echo "e-mail n foi";
// }
// // Fechar a conexão
// $mail->smtpClose();

function emaildeverificacao($mensagem, $email){
    $mail = new PHPMailer();
    $mail->isSMTP();
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
    $mail->send();
    $mail->smtpClose();
}

?>