<?php

abstract class ContaBancaria
{

    private string $titular;

    private string $numeroConta;

    private float $saldo;

    public const LIMITE_SAQUE = 1000;

    public function __construct(string $titular, string $numeroConta)
    {

        $this->titular = $titular;

        $this->numeroConta = $numeroConta;

        $this->saldo = 0.0;

    }

    // Getters

    public function getTitular(): string
    {

        return $this->titular;

    }

    public function getNumeroConta(): string
    {

        return $this->numeroConta;

    }

    public function getSaldo(): float
    {

        return $this->saldo;

    }

    // Setters

    public function setTitular(string $titular): void
    {

        $this->titular = $titular;

    }

    public function setNumeroConta(string $numeroConta): void
    {

        $this->numeroConta = $numeroConta;

    }

    // Métodos principais

    public function depositar(float $valor): void
    {

        if ($valor <= 0) {

            throw new Exception("Valor de depósito deve ser positivo.");

        }

        $this->saldo += $valor;

    }

    public function sacar(float $valor): void
    {

        if ($valor <= 0) {

            throw new Exception("Valor de saque deve ser positivo.");

        }

        if ($valor > self::LIMITE_SAQUE) {

            throw new Exception("Valor excede o limite de saque permitido.");

        }

        if ($valor > $this->saldo) {

            throw new Exception("Saldo insuficiente.");

        }

        $this->saldo -= $valor;

    }

    public function verSaldo(): string
    {

        return "Saldo atual: R$ " . number_format($this->saldo, 2, ',', '.');

    }

    // Método estático

    public static function mostrarLimite(): string
    {

        return "Limite de saque: R$ " . number_format(self::LIMITE_SAQUE, 2, ',', '.');

    }

    // Método abstrato

    abstract public function calcularTarifa(): float;

}