<?php
include (dirname(__FILE__).'\team_lib\_criptoClasses.php');
session_start();

$c = new AES_CRIPT_Internal();



print($_SESSION['AES_iv']);



?>
