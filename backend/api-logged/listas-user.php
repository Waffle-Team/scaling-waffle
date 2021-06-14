<pre>
<?php
$RETURN = '{
  "Pasta":{
    "lista": {
      "cards": {
        "Card0": {
          "Descrição": "texto longo",
          "Atributo": "seila"
        },
        "Card1": {
          "Descrição": "texto longo",
          "Atributo": "seila"
        },
        "Card2": {
          "Descrição": "texto longo",
          "Atributo": "seila"
        }
      }
    },
    "backlog": {
      "cards": {
        "Tarefa1": {
          "Descrição": "texto longo",
          "Atributo": "seila"
        },
        "Tarefa213": {
          "Descrição": "texto longo",
          "Atributo": "seila"
        },
        "Tarefa1": {
          "Descrição": "texto longo",
          "Atributo": "seila"
        }
      }
    }
  }
}';
print($RETURN);

class Tarefa{
    private $titulo;
    private $descri;
    private $data_entrega;
    private $data_create;



}
class Lista{
    private $tarefas = [];

    public function addTarefa(Tarefa $tarefa){

    }
    public function removeTarefa(Tarefa $tarefa){

    }


}
// $lista0 = "Backlog";
// $lista1 = "sprint";
// $lista = [$lista0];

// print_r(json_decode($RETURN, true));
// $JsonReturn = new stdClass();
// $JsonReturn->lista[0] = new stdClass();
// $JsonReturn->lista[0]->cards = new stdClass();
//
// $JsonReturn->lista[0]->cards->Card0 = new stdClass();
// $JsonReturn->lista[0]->cards->Card0->desc = "um texto aleatorio de descrição do card0";
//
// $JsonReturn->lista[0]->cards->Card1 = new stdClass();
// $JsonReturn->lista[0]->cards->Card1->desc = "um texto aleatorio de descrição do card1";
//
// $JsonReturn->lista[0]->cards->Card2 = new stdClass();
// $JsonReturn->lista[0]->cards->Card2->desc = "um texto aleatorio de descrição do card2";
//
//
// echo "______________________________________________________________________________________\n";
// print_r(json_encode($JsonReturn));
//
// echo "\n______________________________________________________________________________________\n";



?>
</pre>
