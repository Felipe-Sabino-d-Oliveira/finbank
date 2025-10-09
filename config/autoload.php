<?php

spl_autoload_register(function ($class) {

    // Lista de pastas onde as classes podem estar

    $pastas = [

        '../abstratas/',

        '../classes/',

        '../interfaces/',

        '../servicos/',

        '../utils/',

    ];

    foreach ($pastas as $pasta) {

        $caminho = __DIR__ . "/$pasta$class.php";

        if (file_exists($caminho)) {

            require_once $caminho;

            return;

        }

    }

    // Opcional: lançar erro se a classe não for encontrada

    throw new Exception("Classe '$class' não encontrada em nenhuma das pastas.");

});