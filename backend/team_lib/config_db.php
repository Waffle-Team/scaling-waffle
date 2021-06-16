<?php
include (dirname(__FILE__).'\..\lib\esteganografia\decrypt_dbpass.php');


function conecta_db(){
   $con = new mysqli('127.0.0.1', 'waffle_db', MarioDB(dirname(__FILE__).'\..\lib\esteganografia\result633.png'), 'waffle', 3306);
   // Check connection
   if ($con->connect_error) {
        die("ERRO DE CONECÇÃO:" . $con->connect_error);
        return FALSE;
    }
    //echo "CONECTADO AO DB\n";
    return $con;
}
?>
