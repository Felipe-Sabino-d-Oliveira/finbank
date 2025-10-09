<?php
require_once '../config/autoload.php';
require_once '../config/conexao.php';
require_once '../templates/header.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = Conexao::conectar();
        $numeroConta = $_POST['numeroConta'];
        $novoTitular = $_POST['titular'];
        $novaTaxa = $_POST['taxaRendimento'];

        $stmt = $pdo->prepare("UPDATE contas SET titular = ?, taxaRendimento = ? WHERE numeroConta = ?");
        $stmt->execute([$novoTitular, $novaTaxa, $numeroConta]);

        $mensagem = "<div class='alert alert-success'>Conta atualizada com sucesso!</div>";
    } catch (Exception $e) {
        $mensagem = "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="card shadow-sm card-create">
    <div class="card-header bg-warning text-white">
        <h4 class="mb-0">Editar Conta</h4>
    </div>
    <div class="card-body">
        <?= $mensagem ?>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="numeroConta" class="form-label">Número da Conta</label>
                <input type="text" name="numeroConta" id="numeroConta" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="titular" class="form-label">Novo Titular</label>
                <input type="text" name="titular" id="titular" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="taxaRendimento" class="form-label">Nova Taxa de Rendimento (se aplicável)</label>
                <input type="number" step="0.01" name="taxaRendimento" id="taxaRendimento" class="form-control">
            </div>
            <button type="submit" class="btn btn-warning">Atualizar</button>
        </form>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>