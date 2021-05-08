<!-- arquivo de funções de uso geral durante o programa -->
<?php


require_once 'config_db.php';
//Verifica se esta acessando por outra maneira
/*if(empty($_POST['nome']) || empty($_POST['password'])){
    header('Location:../../form-login.html');// Pagina q retorna
    exit();
}*/

function insereUsuario($nome, $sobrenome, $email, $apelido, $telefone, $senha){ //Cadastra usuario
    $query = "SELECT COUNT(*) AS total FROM user WHERE apelido = '$apelido' OR email = '$email'";// Comando mysql pra ver as parada no banco
    $con = conecta_db();//Chama a funcao q faz a conexao
    $result = $con->query($query);//Executa a query
    $rows = $result->fetch_assoc();//Retorna as linha que foram encontradas

    if($rows['total'] != 0){//Caso encontrar algum apelido/email ja cadastrado
        $con->close();//Fecha a conexao
        return FALSE;
    }
    $sql = "INSERT INTO user (nome, sobrenome, email, apelido, telefone, senha, tempo, confirmado) VALUES ('$nome', '$sobrenome', '$email', '$apelido', '$telefone', '$senha', convert(now(),time), '0')";
    $result = $con->query($sql);
    $con->close();
    return TRUE;
} 

function pesquisaUsuario($email_apelido){//recebe apelido ou email e retorna (nome, sobrenome, email, telefone)
    $query = "SELECT * FROM user WHERE apelido = '$email_apelido' OR email = '$email_apelido'";
    $con = conecta_db();
    $result = $con->query($query);
    $row = $result->fetch_assoc();
    
    if($row != NULL){
        $user_data = [
            'nome' => $row['nome'],
            'sobrenome' => $row['sobrenome'],
            'apelido' => $row['apelido'],
            'email' => $row['email'],
            'telefone' => $row['telefone'],
            'senha' => $row['senha'],
            'tempo' => $row['tempo'],
            'comfirmado' => $row['confirmado'],
        ];
        return $user_data;
    }else{
        return false;
    }  
}

function inserePasta($apelido,$nomePasta,){//Cadastra um Pasta. Campos $pertenceATime e $time_nome existe mas sao not null
    $query = "INSERT INTO pasta (nomePasta, user_apelido) VALUES ('$nomePasta', '$apelido')";
    $con = conecta_db();
    $result = $con->query($query);

}
function modificaPasta(){

}

function insereTarefa($nomeTarefa,$idLista){//Cadasta uma tarefa. IdListadeve ser obtido automaticamente, campos not null prazo
    // e descricao 
    $sql = "INSERT INTO tarefa (nomeTarefa, descricao, prazo, lista_idLista) VALUES
     ('$nomeTarefa', 'fazer trabalho exp criativa', '', '$idLista')";
}
function modificaTarefa(){

}
/*
//O APELIDO DEVE SER PASSADO DE FORMA AUTOMATICA DAQUI EM DIANTE 
//O APELIDO DEVE SER PASSADO DE FORMA AUTOMATICA DAQUI EM DIANTE 
insereLista($nomeLista,$idPasta){//Cadastra uma Lista. O idPasta deve ser passado automaticamente
    $sql = "INSERT INTO lista (nomeLista, idPasta) VALUES ('$nomeLista', '$idPasta');";
}
insereTime($nome,$apelido){//Cadastra um time. Nome se refere ao nome do time
    $sql = "INSERT INTO time (nome, criador) VALUES ('$nome', '$apelido');"
}



function alteraUsuario(){//recebe apelido e altera(nome, sobrenome, email, telefone, senha) retorna boolean    
}
*/