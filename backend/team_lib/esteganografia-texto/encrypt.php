<?php

    $saida = fopen("saida.txt", "w"); //resultado do script do filme com o codigo
    $script = fopen("script.txt", "r"); //o script base
    $codigo = fopen("chave_privada.pem", "r"); // o codigo

    $linhascript = count(file("script.txt"));

    for ($i = 0; $i < $linhascript; $i++) {
        fwrite($saida, fgetc($codigo) . fgets($script));
    }
    fclose($codigo);
    fclose($script);
    fclose($saida);
?>