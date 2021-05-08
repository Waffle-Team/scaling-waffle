<!--usar para configurações do banco de dados -->
<!-- utilizar esteganografia -->
<?php

define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'waffle');


echo "pica\n";

function conecta_db(){
   return $con = new mysqli(HOST, USUARIO, SENHA, DB, 3306);
   // Check connection
   if ($con->connect_error) {
      die("ERROO DE CONEÇÃO:" . $con->connect_error);
  }
  echo "CONECTADO AO DB\n";
}

