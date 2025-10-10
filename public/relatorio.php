<?php
require_once '../config/autoload.php';
require_once '../config/conexao.php';
require_once '../config/erros.php';
require_once '../templates/header.php';

$pdo = Conexao::conectar();
$stmt = $pdo->query("SELECT * FROM contas");
$contas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
  <h3 class="mb-4">Relatório de Contas</h3>
  <table class="table table-bordered">
    <thead class="table-light">
      <tr>
        <th>Nº Conta</th>
        <th>Titular</th>
        <th>Tipo</th>
        <th>Saldo</th>
        <th>Tarifa</th>
        <th>Limite</th>
        <th>Taxa Rendimento</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($contas as $c): ?>
        <?php
          if ($c['tipo'] === 'corrente') {
            $conta = new ContaCorrente($c['titular'], $c['numeroConta']);
          } else {
            $conta = new ContaPoupanca($c['titular'], $c['numeroConta'], $c['taxaRendimento']);
          }
          $conta->depositar($c['saldo']);
        ?>
        <tr>
          <td><?= $c['numeroConta'] ?></td>
          <td><?= $c['titular'] ?></td>
          <td><?= ucfirst($c['tipo']) ?></td>
          <td><?= $conta->verSaldo() ?></td>
          <td>R$ <?= number_format($conta->calcularTarifa(), 2, ',', '.') ?></td>
          <td>R$ <?= number_format($conta::mostrarLimite(), 2, ',', '.') ?></td>
          <td><?= $c['taxaRendimento'] ?? '-' ?>%</td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require_once '../templates/footer.php'; ?>