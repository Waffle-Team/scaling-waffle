<?php
    $resultado = fopen("resultado.txt", "w"); //codigo decifrado
    $script = fopen("script.txt", "r"); //o script base
    $codigo = fopen("saida.txt", "r"); //script com o codigo

    
    $linhascodigo = count(file("saida.txt"));

    for ($i = 0; $i < $linhascodigo; $i++) {
        fwrite($resultado, substr(fgets($codigo), 0, 1));
    }

    fclose($resultado);
    $texto = file('resultado.txt'); 
    $resultado = fopen("resultado.txt", "w");

    $linhas = count($texto);
    unset($texto[$linhas - 1]); 
    
    for ($i = 1; $i < $linhas - 1; $i++){
        $texto[$i] = substr($texto[$i], 1);
    }

    fwrite($resultado, implode('', $texto));
    
    fclose($codigo);
    fclose($script);
    fclose($resultado);


?>