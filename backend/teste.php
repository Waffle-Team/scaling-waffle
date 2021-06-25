<?php
include (dirname(__FILE__).'\team_lib\_criptoClasses.php');
session_start();
//iv: db11ef716478972d
//key: 2f1b593b807bd12a8a152b4c1e47b7f7

$c = new AES_CRIPT();

$c_text = $c->encrypt('Ola mundo');
$p_text = $c->decrypt($c_text);

print($c_text);





?>
