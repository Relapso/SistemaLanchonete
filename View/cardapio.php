<?php
require '../Dao/config.php';
require '../Controller/LancheController.php';

session_start();

$lancheController = new LancheController();
$listaLanches = $lancheController->listarLanches($pdo);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Cardápio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

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
                <a class="nav-link active" href="cardapio.php">CARDAPIO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="analisarVendas.php">ANALISAR VENDAS</a>
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

<div class="container mt-3">
    <h2 class="text-dark">Cardápio
    <a href="cadastroLanche.php" class="btn btn-dark btn-sm">Cadastrar Lanche +</a>
    </h2>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Figura</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php
// Verificar se há lanches cadastrados
if (empty($listaLanches)) {
    echo "<tr>";
    echo "<td colspan='4'>Nenhum lanche cadastrado</td>";
    echo "</tr>";
} else {
    // Loop através dos lanches e exibir cada um deles
    foreach ($listaLanches as $lanche) {
        echo "<tr>";
        echo "<td>{$lanche['nome']}</td>";
        echo "<td>{$lanche['preco']}</td>";
        
        echo "<td><img src=\"{$lanche['figura']}\" alt=\"{$lanche['nome']}\" style=\"max-width: 100px; max-height: 100px;\"></td>";
        echo "<td>";
        echo "<a href='../Controller/editarLanche.php?id={$lanche['id']}' class='btn btn-primary btn-sm'>Editar</a> ";
        echo "<a href='../Controller/excluirLanche.php?id={$lanche['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir este lanche?\")'>Excluir</a>";
        echo "</td>";
        echo "</tr>";
    }
}
?>
        </tbody>
    </table>
</div>
<?php
?>
</body>
</html>
