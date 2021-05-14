<?php
<<<<<<< Updated upstream
// <!--usar para configurações do banco de dados -->
// <!-- utilizar esteganografia -->

define('HOST', '127.0.0.1');//IP do maquina
define('USUARIO', 'root');//Nome usuario
define('SENHA', '');//Senha 
=======
include('../lib/esteganografia/decrypt.php');


define('HOST', '127.0.0.1');//IP do maquina
define('USUARIO', 'waffle');//Nome usuario
define('SENHA', decript_estegano('../lib/esteganografia/result633.png'));//Senha
>>>>>>> Stashed changes
define('DB', 'waffle');//Nome do banco

function conecta_db(){
   $con = new mysqli(HOST, USUARIO, SENHA, DB, 3306);
   // Check connection
   if ($con->connect_error) {
      die("ERRO DE CONECÇÃO:" . $con->connect_error);
      return FALSE;
  }
//   echo "CONECTADO AO DB\n";
  return $con;
}

