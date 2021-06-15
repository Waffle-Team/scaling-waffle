<?php
class Tarefa{
    public $titulo;
    public $descri;
    public $data_entrega;
    public $data_create;


    function __construct($titulo, $descri, $dataCreate){
       $this->setTitulo($titulo);
       $this->setDescricao($descri);
       $this->setDateCreate($dataCreate);
       $this->setDateEntrega("Sem prazo");
    }

    //SETERS
    public function setTitulo($value){
        $this->titulo = $value;
    }
    public function setDescricao($value){
        $this->descri = $value;
    }
    public function setDateEntrega($value){
        $this->data_entrega = $value;
    }
    public function setDateCreate($value){
        $this->data_create = $value;
    }

    //GETTERS
    public function getTitulo($value){
        return $this->titulo;
    }
    public function getDescricao($value){
        return $this->descri;
    }
    public function getDateEntrega($value){
        return $this->data_entrega;
    }
    public function getDateCreate($value){
        return $this->data_create;
    }

}
class Lista{
    public $list_name;
    public $tarefas = [];

    function __construct($value){
        $this->list_name = $value;
    }
    public function addTarefa(Tarefa $tarefa){
        array_push($this->tarefas, $tarefa);
    }
    public function removeTarefa(Tarefa $tarefa){
        array_diff($this->tarefas, [$tarefa]);
    }
    public function getTarefas(){
        return $this;
    }

}

$tarefa[] = new Tarefa("tarefa 1", "breve descrição da tarefa 1", "14.06.2021");
$tarefa[] = new Tarefa("tarefa 2", "breve descrição da tarefa 2", "17.06.2021");
$tarefa[] = new Tarefa("tarefa 3", "breve descrição da tarefa 3", "12.06.2021");
$tarefa[] = new Tarefa("tarefa 4", "breve descrição da tarefa 4", "13.06.2021");
$tarefa[] = new Tarefa("tarefa 5", "breve descrição da tarefa 5", "15.06.2021");
$tarefa[] = new Tarefa("tarefa 6", "breve descrição da tarefa 6", "13.06.2021");
$tarefa[] = new Tarefa("tarefa 7", "breve descrição da tarefa 7", "11.06.2021");
$tarefa[] = new Tarefa("tarefa 8", "breve descrição da tarefa 9", "12.06.2021");



$pasta[] = new Lista("lista 0");
$pasta[0]->addTarefa($tarefa[0]);
$pasta[0]->addTarefa($tarefa[1]);
$pasta[0]->addTarefa($tarefa[2]);
$pasta[0]->addTarefa($tarefa[3]);
$pasta[0]->addTarefa($tarefa[4]);
$pasta[0]->addTarefa($tarefa[5]);
$pasta[0]->addTarefa($tarefa[6]);
$pasta[0]->addTarefa($tarefa[7]);

$pasta[] = new Lista("lista 1");
$pasta[1]->addTarefa($tarefa[0]);
$pasta[1]->addTarefa($tarefa[1]);
$pasta[1]->addTarefa($tarefa[2]);
$pasta[1]->addTarefa($tarefa[3]);

$pasta[] = new Lista("lista 2");
$pasta[2]->addTarefa($tarefa[4]);
$pasta[2]->addTarefa($tarefa[5]);
$pasta[2]->addTarefa($tarefa[6]);
$pasta[2]->addTarefa($tarefa[7]);


print_r(json_encode($pasta, JSON_FORCE_OBJECT));


?>
