<?php
require_once (dirname(__FILE__).'\team_lib\functions_logged.php');
//headers include pege
$assets = new pageAssets();
$assets->addCss("../front-dependencies/assets/css/logged/lista.css");
$assets->addJs("../front-dependencies/assets/js/logged/lista.js");
require_once (dirname(__FILE__).'\common_parts\header.php');
?>


<section id="lista-app-area">

    <div class="lista">
        <h1 class="titulo-lista">Backlog</h1>
        <div class="card-tarefa">
            <h2 class="titulo">
                <button class="left"><</button>
                Tarefa 001
                <button class="right">></button>
            </h2>
            <div class="descricao">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
        </div>
        <div class="buttons-end-lista">
            <button class="nova-tarefa">nova tarefa</button>
        </div>
    </div>

</section>
