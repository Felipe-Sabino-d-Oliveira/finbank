<?php
require_once '../config/autoload.php';
require_once '../config/conexao.php';
require_once '../config/erros.php';
require_once '../templates/header.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = Conexao::conectar();

        $titular = $_POST['titular'];
        $numeroConta = $_POST['numeroConta'];
        $tipo = $_POST['tipo'];
        $taxa = $tipo === 'poupanca' ? $_POST['taxaRendimento'] : null;

        $stmt = $pdo->prepare("INSERT INTO contas (titular, numeroConta, saldo, tipo, taxaRendimento) VALUES (?, ?, 0.00, ?, ?)");
        $stmt->execute([$titular, $numeroConta, $tipo, $taxa]);

        $mensagem = "<div class='alert alert-success'>Conta criada com sucesso!</div>";
    } catch (Exception $e) {
        $mensagem = "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="card shadow-sm card-create">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Criar Nova Conta</h4>
    </div>
    <div class="card-body">
        <?= $mensagem ?>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="titular" class="form-label">Titular</label>
                <input type="text" name="titular" id="titular" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="numeroConta" class="form-label">Número da Conta</label>
                <input type="text" name="numeroConta" id="numeroConta" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Conta</label>
                <select name="tipo" id="tipo" class="form-select" onchange="toggleTaxa()" required>
                    <option value="corrente">Corrente</option>
                    <option value="poupanca">Poupança</option>
                </select>
            </div>

            <div class="mb-3" id="taxaContainer" style="display: none;">
                <label for="taxaRendimento" class="form-label">Taxa de Rendimento (%)</label>
                <input type="number" step="0.01" name="taxaRendimento" id="taxaRendimento" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Criar Conta</button>
        </form>
    </div>
</div>
<script>
function toggleTaxa() {
    const tipo = document.getElementById('tipo').value;
    const taxaContainer = document.getElementById('taxaContainer');
    taxaContainer.style.display = tipo === 'poupanca' ? 'block' : 'none';
}
</script>

<?php require_once '../templates/footer.php'; ?>
