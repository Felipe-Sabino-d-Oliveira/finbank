<?php require_once '../config/autoload.php';
require_once '../config/conexao.php';
require_once '../config/erros.php';
require_once '../templates/header.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = Conexao::conectar();
        $numeroContaOrigem = $_POST['numeroContaOrigem'] ?? null;
        $numeroContaDestino = $_POST['numeroContaDestino'] ?? null;
        $acao = $_POST['acao'];
        $valor = floatval($_POST['valor']);

        $stmt = $pdo->prepare("SELECT * FROM contas WHERE numeroConta = ?");
        $stmt->execute([$numeroContaOrigem]);
        $dadosOrigem = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dadosOrigem)
            throw new Exception("Conta de origem não encontrada.");

        if ($dadosOrigem['tipo'] === 'corrente') {
            $contaOrigem = new ContaCorrente($dadosOrigem['titular'], $dadosOrigem['numeroConta']);
        } else {
            $contaOrigem = new ContaPoupanca($dadosOrigem['titular'], $dadosOrigem['numeroConta'], $dadosOrigem['taxaRendimento']);
        }

        $contaOrigem->carregarSaldo($dadosOrigem['saldo']);

        if ($acao === 'depositar') {
            $contaOrigem->depositar($valor);
            $tipoOperacao = 'deposito';
        } elseif ($acao === 'sacar') {
            $contaOrigem->sacar($valor);
            $tipoOperacao = 'saque';
        } elseif ($acao === 'rendimento' && $contaOrigem instanceof ContaPoupanca) {
            $contaOrigem->aplicarRendimento();
            $tipoOperacao = 'rendimento';
            $valor = 0;
        } elseif ($acao === 'transferir') {
            $stmt = $pdo->prepare("SELECT * FROM contas WHERE numeroConta = ?");
            $stmt->execute([$numeroContaDestino]);
            $dadosDestino = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dadosDestino)
                throw new Exception("Conta de destino não encontrada.");

            if ($dadosDestino['tipo'] === 'corrente') {
                $contaDestino = new ContaCorrente($dadosDestino['titular'], $dadosDestino['numeroConta']);
            } else {
                $contaDestino = new ContaPoupanca($dadosDestino['titular'], $dadosDestino['numeroConta'], $dadosDestino['taxaRendimento']);
            }

            $contaDestino->depositar($dadosDestino['saldo']);
            $contaOrigem->sacar($valor);
            $contaDestino->depositar($valor);

            $stmt = $pdo->prepare("UPDATE contas SET saldo = ? WHERE numeroConta = ?");
            $stmt->execute([$contaDestino->getSaldo(), $numeroContaDestino]);
            $tipoOperacao = 'transferencia';
        }

        $stmt = $pdo->prepare("UPDATE contas SET saldo = ? WHERE numeroConta = ?");
        $stmt->execute([$contaOrigem->getSaldo(), $numeroContaOrigem]);

        $stmt = $pdo->prepare("INSERT INTO historico_operacoes (numeroConta, tipoOperacao, valor, contaDestino) VALUES (?, ?, ?, ?)");
        $stmt->execute([$numeroContaOrigem, $tipoOperacao, $valor, $numeroContaDestino]);

        $mensagem = "<div class='alert alert-success'>Operação realizada com sucesso!</div>";

    } catch (Exception $e) {
        $mensagem = "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    }
} ?>

<div class="card shadow-sm card-create">
    <div class="card-header bg-info text-white">
        <h4 class="mb-0">Operações Bancárias</h4>
    </div>
    <div class="card-body">
        <?= $mensagem ?>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="numeroContaOrigem" class="form-label">Número da Conta Origem</label>
                <input type="text" name="numeroContaOrigem" id="numeroContaOrigem" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="acao" class="form-label">Ação</label>
                <select name="acao" id="acao" class="form-select" required>
                    <option value="depositar">Depositar</option>
                    <option value="sacar">Sacar</option>
                    <option value="rendimento">Aplicar Rendimento (Poupança)</option>
                    <option value="transferir">Transferir</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="numeroContaDestino" class="form-label">Número da Conta Destino (para Transferência)</label>
                <input type="text" name="numeroContaDestino" id="numeroContaDestino" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" step="0.01" name="valor" id="valor" class="form-control" required />
            </div>
            <button type="submit" class="btn btn-info">Executar</button>
        </form>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>