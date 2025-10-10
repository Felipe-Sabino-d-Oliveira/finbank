<?php

require_once '../config/autoload.php';

require_once '../config/erros.php';

require_once '../templates/header.php';

?>

<div class="text-center" style="height: 100%; margin-block: auto;">

    <h1 class="mb-4">Bem-vindo ao FinBank 💳</h1>

    <p class="lead">Gerencie suas contas bancárias com segurança e praticidade.</p>

    <div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Criar Conta</h5>
          <p class="card-text">Abra uma nova conta bancária.</p>
          <a href="criar_conta.php" class="btn btn-primary">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Listar Contas</h5>
          <p class="card-text">Visualize todas as contas cadastradas.</p>
          <a href="listar_contas.php" class="btn btn-primary">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Operações Bancárias</h5>
          <p class="card-text">Realize depósitos, saques, transferências e rendimentos.</p>
          <a href="operacoes.php" class="btn btn-primary">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Relatório</h5>
          <p class="card-text">Gere relatórios detalhados das contas.</p>
          <a href="relatorio.php" class="btn btn-primary">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Editar Conta</h5>
          <p class="card-text">Atualize os dados de uma conta existente.</p>
          <a href="editar_conta.php" class="btn btn-primary">Acessar</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Histórico de Operações</h5>
          <p class="card-text">Consulte o histórico de movimentações de uma conta.</p>
          <a href="historico.php" class="btn btn-primary">Acessar</a>
        </div>
      </div>
    </div>
  </div>

</div>

<?php require_once '../templates/footer.php'; ?>