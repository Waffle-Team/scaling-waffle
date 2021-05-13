<?php
// <!--usar para configurações do banco de dados -->
// <!-- utilizar esteganografia -->
//pega arquivo
//pega oq tem no arquivo
//joga pra varivavel


define('HOST', '127.0.0.1');//IP do maquina
define('USUARIO', 'root');//Nome usuario
define('SENHA', '');//Senha
define('DB', 'waffle');//Nome do banco

function conecta_db(){
   $con = new mysqli(HOST, USUARIO, SENHA, DB, 3306);
   // Check connection
   if ($con->connect_error) {
      die("ERRO DE CONECÇÃO:" . $con->connect_error);
  }
//   echo "CONECTADO AO DB\n";
  return $con;
}
