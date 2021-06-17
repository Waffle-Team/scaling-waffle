<?php
include (dirname(__FILE__).'\..\lib\esteganografia\decrypt_dbpass.php');


function conecta_db(){
   $con = new mysqli('frwahxxknm9kwy6c.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'kucxhz8wbo4w9mvn', MarioDB(dirname(__FILE__).'\..\lib\esteganografia\result949.png'), 'j9rlfrj0194lftm8', 3306);
   // Check connection
   if ($con->connect_error) {
        die("ERRO DE CONECÇÃO:" . $con->connect_error);
        return FALSE;
    }
    echo "CONECTADO AO DB\n";
    return $con;
}
conecta_db();
?>
