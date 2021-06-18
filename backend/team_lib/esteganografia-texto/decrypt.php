<?php

function decifrar($codigo){
    $resultado = fopen("resultado.txt", "w"); //codigo decifrado
    $script = fopen("script.txt", "r"); //o script base
    //$codigo = fopen("saida.txt", "r"); //script com o codigo

    
    $linhascodigo = count(file("saida.txt")); //conta as linhas do script com o codigo

    for ($i = 0; $i < $linhascodigo; $i++) { //deleta o primeiro caractere de todas as linhas
        fwrite($resultado, substr(fgets($codigo), 0, 1));
    }

    fclose($resultado);
    $texto = file('resultado.txt');
    $resultado = fopen("resultado.txt", "w");

    $linhas = count($texto); //conta as linhas do script com o codigo
    unset($texto[$linhas - 1]); 
    

    for ($i = 1; $i < $linhas - 1; $i++){ //deleta completamente a ultima linha
        $texto[$i] = substr($texto[$i], 1);
    }
    
    fwrite($resultado, implode('', $texto));

    $chavelimpa = file_get_contents("resultado.txt"); //le o conteúdo para uma variavel $chavelimpa

    unlink("resultado.txt"); //deleta o arquivo com a chave

    fclose($codigo);
    fclose($script);

    return $chavelimpa;
}

?>