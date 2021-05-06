<!-- arquivo de funções de uso geral durante o programa -->
<?php


require_once 'config_db.php';
//Verifica se esta acessando por outra maneira
/*if(empty($_POST['nome']) || empty($_POST['password'])){
    header('Location:../../form-login.html');// Pagina q retorna
    exit();
}*/

function insereUsuario($nome, $sobrenome, $email, $apelido, $telefone, $senha){ //Cadastra usuario
    $query = "SELECT COUNT(*) AS total FROM user WHERE apelido = '$apelido' OR  email = '$email'";
    //$result = mysqli_query($conexao,$query);
    echo $query;exit;
}   
    /*
    $result = mysqli_query($conexao,$query);
    $row = mysqli_fetch_assoc($result);
    if($row['total'] == 1){
        header('Location:../../form-register.hmtl');//volta pra pagina do cadastro
        return("Usuario ja existe");// Fala q o usuario existe
    }
    $sql = " INSERT INTO 'waffle'.'user' ('nome', 'sobrenome', 'email', 'apelido', 'telefone', 'senha', 'tempo', 'confirmado') VALUES 
    ('$nome', '$sobrenome', '$email', '$apelido', '$telefone', '$senha', convert(now(),time), '0')"; 
    if($conexao->query($sql) === TRUE){
        $_SESSION['status_cadastro'] = true;
    }
    $conexao->close();

$retorna = inserirUsuario('nome','sobrenome','email','apelido','telefone','senha');
echo $retorna;
*/
/*
login($email,$apelido,$senha){
    // select * from user where apelido = 'shrimp' and senha = '123';
    //select * from user where email = 'aleisterlima@yahoo.com.br' and senha = '123';
    //select * from user where apelido = 'shrimp' or  email = 'aleisterlima@yahoo.com.br'and senha = '123'; esse é o mais certo mais n ta verificando o email
    $query = "SELECT * FROM user WHERE apelido = '$apelido' and senha = '$senha'";
    $result = mysqli_query($conexao,$query);
    $row = mysqli_num_rows($result);
    if($row == 1){// aqui é o que ele faz se ele loga
        $_SESSION['usuario'] = $usuario;//Pega o nome do usuario pra sessao, talvez a gente use isso
        //header('Location: logado.html'); pagina pois login
        exit();
    }else{//Aqui ele n loga
        header('Location: form-register.html');
        exit();
    }
}
deslogar(){
    session_destroy();
    header("Location: index.html");
    exit();
}

*/
//O APELIDO DEVE SER PASSADO DE FORMA AUTOMATICA DAQUI EM DIANTE 
inserePasta($apelido,$nomePasta,){//Cadastra um Pasta. Campos $pertenceATime e $time_nome existe mas sao not null
    $sql = "INSERT INTO `waffle`.`pasta` (`nomePasta`, `user_apelido`) VALUES ('$nomePasta', '$apelido')";
}

insereLista($nomeLista,$idPasta){//Cadastra uma Lista. O idPasta deve ser passado automaticamente
    $sql = "INSERT INTO `waffle`.`lista` (`nomeLista`, `idPasta`) VALUES ('$nomeLista', '$idPasta');";
}
insereTarefa($nomeTarefa,$idLista){//Cadasta uma tarefa. IdListadeve ser obtido automaticamente, campos not null prazo
    // e descricao 
    $sql = "INSERT INTO `waffle`.`tarefa` (`nomeTarefa`, `descricao`, `prazo`, `lista_idLista`) VALUES
     ('$nomeTarefa', 'fazer trabalho exp criativa', '', '$idLista')";
}
insereTime($nome,$apelido){//Cadastra um time. Nome se refere ao nome do time
    $sql = "INSERT INTO `waffle`.`time` (`nome`, `criador`) VALUES ('$nome', '$apelido');"
}