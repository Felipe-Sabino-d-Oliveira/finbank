<?php
require_once '../config/autoload.php';
require_once '../config/conexao.php';
require_once '../templates/header.php';
require_once '../config/erros.php';

$historico = [];
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $pdo = Conexao::conectar();
    $numeroConta = $_POST['numeroConta'];
    $stmt = $pdo->prepare("SELECT * FROM historico_operacoes WHERE numeroConta = ? ORDER BY data_operacao DESC");
    $stmt->execute([$numeroConta]);
    $historico = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    $mensagem = "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
  }
}
?>

<div class="container mt-5">
  <h3 class="mb-4">Histórico de Operações</h3>
  <?= $mensagem ?>
  <form method="POST" class="mb-4">
    <div class="input-group">
      <input type="text" name="numeroConta" class="form-control" placeholder="Digite o número da conta" required>
      <button class="btn btn-secondary" type="submit">Buscar</button>
    </div>
  </form>

  <?php if (!empty($historico)): ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Data</th>
          <th>Operação</th>
          <th>Valor</th>
          <th>Conta Destino</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($historico as $op): ?>
          <tr>
            <td><?= date('d/m/Y H:i', strtotime($op['data_operacao'])) ?></td>
            <td><?= ucfirst($op['tipoOperacao']) ?></td>
            <td>R$ <?= number_format($op['valor'], 2, ',', '.') ?></td>
            <td><?= $op['contaDestino'] ?? '-' ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <div class="alert alert-warning">Nenhuma operação encontrada para esta conta.</div>
  <?php endif; ?>
</div>

<?php require_once '../templates/footer.php'; ?>