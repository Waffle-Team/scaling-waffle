<?php
include('../lib/esteganografia/decrypt_dbpass.php');


define('HOST', '127.0.0.1');//IP do maquina
define('USUARIO', 'waffle');//Nome usuario
define('SENHA', MarioDB('../lib/esteganografia/result633.png'));//Senha
define('DB', 'waffle');//Nome do banco

function conecta_db(){
   $con = new mysqli(HOST, USUARIO, SENHA, DB, 3306);
   // Check connection
   if ($con->connect_error) {
      die("ERRO DE CONECÇÃO:" . $con->connect_error);
      return FALSE;
  }
echo "CONECTADO AO DB\n";
  return $con;
}
