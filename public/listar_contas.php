<?php

require_once '../config/autoload.php';

require_once '../config/conexao.php';

require_once '../config/erros.php';

require_once '../templates/header.php';

try {

    $pdo = Conexao::conectar();

    $stmt = $pdo->query("SELECT * FROM contas ORDER BY criado_em DESC");

    $contas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {

    echo "<div class='alert alert-danger'>Erro ao buscar contas: " . $e->getMessage() . "</div>";

}

?>

<h2>Contas Cadastradas</h2>

<?php if (!empty($contas)): ?>

    <table class="table table-bordered table-striped mt-4">

        <thead class="table-dark">

            <tr>

                <th>ID</th>

                <th>Titular</th>

                <th>Número</th>

                <th>Tipo</th>

                <th>Saldo</th>

                <th>Taxa (%)</th>

                <th>Criado em</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach ($contas as $conta): ?>

                <tr>

                    <td><?= $conta['id'] ?></td>

                    <td><?= htmlspecialchars($conta['titular']) ?></td>

                    <td><?= htmlspecialchars($conta['numeroConta']) ?></td>

                    <td><?= ucfirst($conta['tipo']) ?></td>

                    <td><?= Formatador::moeda($conta['saldo']) ?></td>

                    <td><?= $conta['taxaRendimento'] !== null ? Formatador::porcentagem($conta['taxaRendimento']) : '-' ?></td>

                    <td><?= date('d/m/Y H:i', strtotime($conta['criado_em'])) ?></td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

<?php else: ?>

    <div class="alert alert-warning mt-4">Nenhuma conta cadastrada até o momento.</div>

<?php endif; ?>

<?php require_once '../templates/footer.php'; ?>