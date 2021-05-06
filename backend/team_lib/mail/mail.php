<?php

 //scalingwaffle@gmail.com
 //gawamos@gmail.com
 

require '../../../front-dependencies/lib/PHPMailer/PHPMailer.php';
require '../../../front-dependencies/lib/PHPMailer/SMTP.php';
require '../../../front-dependencies/lib/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    
$mail = new PHPMailer();

// Configurações do servidor
$mail->isSMTP();//Devine o uso de SMTP no envio
// Informações específicadas pelo Google
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = "true"; //Habilita a autenticação SMTP
// Criptografia do envio SSL também é aceita
$mail->SMTPSecure = 'tls';
$mail->Username   = 'scalingwaffle@gmail.com';
$mail->Password   = AAAAAAAAAAAA;//Senha da conta que for enviar o e-mail
$mail->Subject = "E-mail de teste";//'E-mail de teste';
// Define o remetente
$mail->setFrom("scalingwaffle@gmail.com");//('scalingwaffle@gmail.com', 'Scaling Waffle');
// Conteúdo da mensagem
$mail->Body = "Sera que vai chegar agora?";//'Chegou em <b>negrito</b>';
// Define o destinatário
$mail->addAddress("gawamos@gmail.com");//E-mail que for inserido no input
$mail->Port = 587;
// Enviar
if($mail->send()){
    echo "email foi";
}
else{
    echo "email n foi";
}
$mail->smtpClose();


?>