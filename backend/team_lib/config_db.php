<!--usar para configurações do banco de dados -->
<!-- utilizar esteganografia -->
<?php
define('HOST','127.0.0.1');//Porta conectada
define('USUARIO','root');//Usuario do Bando de Dados
define('SENHA','');//Senha VER COMO FAZER COM ESTEGANOGRAFIA
define('DB', 'waffle');//Nome do Banco de Dados
$conexao = mysqli_connect(HOST,USUARIO,SENHA,DB) or die('Nao foi possivel conectar');