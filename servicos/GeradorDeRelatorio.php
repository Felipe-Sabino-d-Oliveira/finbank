<?php

class GeradorDeRelatorio {
    private ContaBancaria $conta;

    public function __construct(ContaBancaria $conta) {
        $this->conta = $conta;
    }

    public function gerar(): void {
        echo "<h2>Relatório da Conta</h2>";
        echo "<ul>";
        echo "<li><strong>Titular:</strong> " . $this->conta->getTitular() . "</li>";
        echo "<li><strong>Número da Conta:</strong> " . $this->conta->getNumeroConta() . "</li>";
        echo "<li><strong>Saldo:</strong> R$ " . number_format($this->conta->getSaldo(), 2, ',', '.') . "</li>";
        echo "<li><strong>Tarifa:</strong> R$ " . number_format($this->conta->calcularTarifa(), 2, ',', '.') . "</li>";

        // Verifica se é uma conta poupança para exibir taxa de rendimento
        if ($this->conta instanceof ContaPoupanca) {
            echo "<li><strong>Taxa de Rendimento:</strong> " . $this->conta->getTaxaRendimento() . "%</li>";
        }

        echo "</ul>";
    }
}
