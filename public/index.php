<?php
require_once '../config/autoload.php';
require_once '../config/erros.php';
require_once '../templates/header.php';
?>

<div class="text-center" style="height: 100%; margin-block: auto;">
    <h1 class="mb-4">Bem-vindo ao FinBank 💳</h1>
    <p class="lead">Gerencie suas contas bancárias com segurança e praticidade.</p>

    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Criar Nova Conta</h5>
                    <p class="card-text">Cadastre uma conta corrente ou poupança.</p>
                    <a href="criar_conta.php" class="btn btn-primary">Criar Conta</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-3 mt-md-0">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title">Listar Contas</h5>
                    <p class="card-text">Veja todas as contas cadastradas no sistema.</p>
                    <a href="listar_contas.php" class="btn btn-success">Ver Contas</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>
