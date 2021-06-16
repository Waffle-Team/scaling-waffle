<?php
//arquivo de funções de uso geral durante o programa

require_once (dirname(__FILE__).'\config_db.php');
require_once (dirname(__FILE__).'\filtro.php');

//Funções para uso do banco de dados
function insereUsuario($nome, $sobrenome, $email, $apelido, $telefone, $senha){ //Cadastra usuario
    $query = "SELECT COUNT(*) AS total FROM user WHERE apelido = '$apelido' OR email = '$email'";// Comando mysql pra ver as parada no banco
    $con = conecta_db();//Chama a funcao q faz a conexao
    $result = $con->query($query);//Executa a query
    $rows = $result->fetch_assoc();//Retorna as linhas que foram encontradas

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
            'confirmado' => $row['confirmado'],
        ];
        $con->close();
        return $user_data;
    }else{
        $con->close();
        return false;
    }
}
function alteraUsuario($apelido){
    //recebe apelido e altera(nome, sobrenome, email, telefone, senha) retorna boolean
}
function alteraSenha($apelidoEmail, $novasenha){
    $con = conecta_db();
    $dados = pesquisaUsuario($apelidoEmail);
    $senha = $novasenha;
    if (empty($senha)){ //senha nao passou verificação  
        $con->close();
        return FALSE;
    }
    else{ //senha passou verificação
        $hashsenha = hashsenha($dados['nome'], $dados['sobrenome'], $dados['email'], $dados['telefone'], $senha);
        $inserir = "UPDATE user SET senha = '$hashsenha' WHERE apelido = '$apelidoEmail' OR email = '$apelidoEmail'";
        $con->query($inserir);
        $con->close();
        return TRUE;
    }
}
function validaConta($email_apelido){ //muda confirmado para 1
    $query = "UPDATE user SET confirmado = 1 WHERE apelido = '$email_apelido' OR email = '$email_apelido'";
    $con = conecta_db();
    $con->query($query);
    $con->close();
}
function set_2fa($md5, $email_apelido){
    $query = "UPDATE user SET mail2FA = '$md5' WHERE apelido = '$email_apelido' OR email = '$email_apelido'";
    $con = conecta_db();
    $con->query($query);
    $con->close();
}
function get_2fa($email_apelido){
    $query = "SELECT mail2FA FROM user WHERE apelido = '$email_apelido' OR email = '$email_apelido'";
    $con = conecta_db();
    $result = $con->query($query);
    $row = $result->fetch_assoc();
    $con->close();
    return $row['mail2FA'];
}
// function inserePasta($apelido,$nomePasta,){//Cadastra um Pasta. Campos $pertenceATime e $time_nome existe mas sao not null
//     $query = "INSERT INTO pasta (nomePasta, user_apelido) VALUES ('$nomePasta', '$apelido')";
//     $con = conecta_db();
//     $result = $con->query($query);

// }
// function modificaPasta(){

// }

// function insereTarefa($nomeTarefa,$idLista){//Cadasta uma tarefa. IdListadeve ser obtido automaticamente, campos not null prazo
//     // e descricao
//     $sql = "INSERT INTO tarefa (nomeTarefa, descricao, prazo, lista_idLista) VALUES
//      ('$nomeTarefa', 'fazer trabalho exp criativa', '', '$idLista')";
// }
// function modificaTarefa(){

// }
/*
//O APELIDO DEVE SER PASSADO DE FORMA AUTOMATICA DAQUI EM DIANTE
insereLista($nomeLista,$idPasta){//Cadastra uma Lista. O idPasta deve ser passado automaticamente
    $sql = "INSERT INTO lista (nomeLista, idPasta) VALUES ('$nomeLista', '$idPasta');";
}
insereTime($nome,$apelido){//Cadastra um time. Nome se refere ao nome do time
    $sql = "INSERT INTO time (nome, criador) VALUES ('$nome', '$apelido');"
}

*/



// Funções gerais

//faz o hash e o salt da senha, que ja passou por um hash
function hashsenha($nome, $sobrenome, $email, $telefone, $senha){
    $numerosini = implode('', array(substr($telefone, -2), substr($telefone, -4, -2)));
    $numerosfim = implode('', array(substr($telefone, -6, -4), substr($telefone, -8, -6)));
    $tamanho1 = strlen($email);
    $tamanho2 = strlen(implode('', array($nome, $sobrenome)));
    $hashtemperado = implode('', array($numerosini, $tamanho1, $senha, $numerosfim, $tamanho2));
    return hash("sha256", $hashtemperado);
}

function codigoverificacao($nome, $sobrenome, $email, $telefone) { //cria um hash md5 baseado na formatacao de alguns dados do ususario
    $codigo = implode ('', array(substr($nome, strlen($nome)/2), substr($sobrenome, 0, strlen($sobrenome)/2), strlen($email), substr($telefone, strlen($telefone)/6, - strlen($telefone)/6)));
    return md5($codigo);
}
