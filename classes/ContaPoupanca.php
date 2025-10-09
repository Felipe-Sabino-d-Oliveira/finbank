<?php

require_once __DIR__ . '/../abstratas/ContaBancaria.php';

require_once __DIR__ . '/../interfaces/OperacoesBancarias.php';

class ContaPoupanca extends ContaBancaria implements OperacoesBancarias
{

    private float $taxaRendimento;

    public function __construct(string $titular, string $numeroConta, float $taxaRendimento = 0.5)
    {

        parent::__construct($titular, $numeroConta);

        $this->taxaRendimento = $taxaRendimento;

    }

    public function aplicarRendimento(): void
    {

        $rendimento = $this->getSaldo() * ($this->taxaRendimento / 100);

        $this->depositar($rendimento);

    }

    public function calcularTarifa(): float
    {

        // Exemplo: tarifa reduzida para poupança

        return 5.00;

    }

    // Interface methods

    public function depositar(float $valor): void
    {

        parent::depositar($valor);

    }

    public function sacar(float $valor): void
    {

        parent::sacar($valor);

    }

    public function verSaldo(): string
    {

        return parent::verSaldo();

    }

    // Getter para taxa

    public function getTaxaRendimento(): float
    {

        return $this->taxaRendimento;

    }

    public function setTaxaRendimento(float $taxa): void
    {

        $this->taxaRendimento = $taxa;

    }

}