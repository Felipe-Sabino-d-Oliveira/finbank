<?php

class Formatador
{

    public static function moeda(float $valor): string
    {

        return "R$ " . number_format($valor, 2, ',', '.');

    }

    public static function porcentagem(float $valor): string
    {

        return number_format($valor, 2, ',', '.') . "%";

    }

    public static function dataHoraAtual(): string
    {

        return date('d/m/Y H:i:s');

    }

}