<?php
require '../Controller/LancheController.php';
require '../Dao/config.php';

$lancheController = new LancheController();
$lanches = $lancheController->listarLanches($pdo);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Cadastro de Pedido</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-secondary" style="min-height: 100vh;">
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li>
                <a class="navbar-brand" href="#">Lanchonete Winx</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="home.php">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cardapio.php">CARDAPIO</a>
            </li>
        </ul>

        <!-- dicionando dropdown para Perfil do Usuário e Logout -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

    <div class="d-flex justify-content-center mt-5">
        <form action="../Controller/inserirPedido.php" method="post" enctype="multipart/form-data" style="max-width: 500px; width: 100%;" class="bg-light mx-auto border border-2 p-4">
            <h2>CADASTRAR NOVO PEDIDO</h2>    
            <hr class="my-3">
            <div class="mb-3">
                <label class="form-label fw-bold">Nome do cliente</label>
                <input type="text" class="form-control" placeholder="Nome do Cliente" name="nome" required>
            </div>
            
            <div class="mb-3 mt-3">
                <label class="form-label fw-bold">Telefone do cliente:</label>
                <input type="text" class="form-control" placeholder="Digite aqui o telefone" name="telefone" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label fw-bold">Endereço do cliente</label>
                <input type="text" class="form-control" placeholder="Digite aqui o endereço do cliente" name="endereco" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label fw-bold">Selecione o lanche</label>
                <select class="form-control" name="lanche" required>
                    <option disabled selected>Selecione um lanche</option>
                    <?php foreach ($lanches as $lanche): ?>
                        <option value="<?= $lanche['id']; ?>"><?= htmlspecialchars($lanche['nome']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-3 mt-3">
                <label class="form-label fw-bold">Quantidade</label>
                <input type="number" class="form-control" name="quantidade" min="1" value="1" required>
            </div>

            <button type="submit" class="btn btn-dark">Cadastrar</button>
        </form>
    </div>
</body>
</html>
