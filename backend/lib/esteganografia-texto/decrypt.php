<?php
    $resultado = fopen("resultado.txt", "w");
    $script = fopen("script.txt", "r");
    $codigo = fopen("saida.txt", "r");

    
    $linhascodigo= count(file("saida.txt"));

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