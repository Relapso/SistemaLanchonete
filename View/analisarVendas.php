<?php
require_once '../Dao/config.php';
require_once '../Dao/PedidoDAO.php';
require_once '../Model/User.php';

session_start();

$nome = '';
if (isset($_SESSION['nome'])) {
    $nome = $_SESSION['nome'];
}   

// Instanciar o PedidoDAO
$pedidoDAO = new PedidoDAO();
$pedidos = $pedidoDAO->listarPedidos($pdo); // Passando $pdo como parâmetro

// Processar os dados para obter a quantidade de cada tipo de lanche vendido
$lanches_quantidade = [];

// Recuperar os nomes dos lanches (assumindo que existe um método que faz isso)
$lanches = $pedidoDAO->listarLanches($pdo); // Método hipotético que retorna uma lista de lanches com 'id' e 'nome'
$lanches_nomes = [];

foreach ($lanches as $lanche) {
    $lanches_nomes[$lanche['id']] = $lanche['nome'];
}

// Agrupar e somar as quantidades de cada lanche vendido
foreach ($pedidos as $pedido) {
    $id_lanche = $pedido['id_lanche'];
    $quantidade = $pedido['quantidade'];
    
    if (isset($lanches_quantidade[$id_lanche])) {
        $lanches_quantidade[$id_lanche] += $quantidade;
    } else {
        $lanches_quantidade[$id_lanche] = $quantidade;
    }
}

// Preparar os dados para o gráfico
$labels = [];
$values = [];

foreach ($lanches_quantidade as $id_lanche => $quantidade) {
    $labels[] = $lanches_nomes[$id_lanche];
    $values[] = $quantidade;
}
?>

<!DOCTYPE html>
<html lang="pt">    
<head>
  <title>Lanchonete Winx</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
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
            <li class="nav-item">
                <a class="nav-link active" href="analisarVendas.php">ANALISAR VENDAS</a>
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
<body>
    
    <div id="graficoPizza" style="width:100%;height:400px;"></div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var labels = <?= json_encode($labels) ?>;
        var values = <?= json_encode($values) ?>;

        var data = [{
            values: values,
            labels: labels,
            type: 'pie'
        }];

        var layout = {
            title: 'Quantidade de Lanches Vendidos'
        };

        Plotly.newPlot('graficoPizza', data, layout);
    });
    </script>
</body>
</html>
