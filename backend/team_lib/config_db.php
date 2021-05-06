<!--usar para configurações do banco de dados -->
<!-- utilizar esteganografia -->
<?php

define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'waffle');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
echo "pica";
/*define('HOST','localhost');//Porta conectada
define('USUARIO','root');//Usuario do Bando de Dados
define('SENHA','');//Senha VER COMO FAZER COM ESTEGANOGRAFIA
define('DB', 'waffle');//Nome do Banco de Dados
$conexao = mysqli_connect(HOST,USUARIO,SENHA,DB);*/

/*if(!$conexao){
   echo "errno: " . mysqli_connect_errno() . PHP_EOL;
   echo "error: " . mysqli_connect_error() . PHP_EOL;
}
echo "Sucesso: Sucesso ao conectar-se com a base de dados MySQL." . PHP_EOL;
 
function falar(){
   echo"aaaaaa";
   return;
}*/