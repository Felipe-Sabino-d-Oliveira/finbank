<?php

require_once __DIR__ . '/../abstratas/ContaBancaria.php';

class ContaCorrente extends ContaBancaria
{

    public function calcularTarifa(): float
    {

        // Exemplo: tarifa fixa de R$ 10,00

        return 10.00;

    }

}