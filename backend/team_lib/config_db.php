<?php
// <!--usar para configurações do banco de dados -->
// <!-- utilizar esteganografia -->
//pega arquivo
//pega oq tem no arquivo
//joga pra varivavel


function conecta_db(){
   $con = new mysqli('127.0.0.1', 'waffle', MarioDB('../lib/esteganografia/result633.png'), 'waffle', 3306);
   // Check connection
   if ($con->connect_error) {
      die("ERRO DE CONECÇÃO:" . $con->connect_error);
  }
//   echo "CONECTADO AO DB\n";
  return $con;
}
