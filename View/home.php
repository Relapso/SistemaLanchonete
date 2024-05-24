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
?>

<!DOCTYPE html>
<html lang="pt">    
<head>
  <title>Lanchonete Winx</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li>
                <a class="navbar-brand" href="#">Lanchonete Winx</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="home.php">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cardapio.php">CARDAPIO</a>
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
        <h2 class=".text-dark">Pedidos-
            <!--Botão para cadastrar novo usuário-->
            <a href="../View/cadastroPedido.php" class="btn btn-dark btn-sm">Novo Pedido +</a>
        </h2>       
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th>Cliente</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Lanche</th>
                <th>Quantidade</th>
                <th>Preço total</th>

                <th>Ações</th> <!-- Coluna para os botões de ação -->
            </tr>
            </thead>
           <tbody>
    <?php
    // Selecionar todos os pedidos da tabela pedidos
    $sql = "SELECT p.*, l.nome AS nome_lanche, l.preco AS preco_lanche FROM pedidos p INNER JOIN lanches l ON p.id_lanche = l.id";
    $stmt = $pdo->query($sql);
    // Verificar se há pedidos
    if ($stmt->rowCount() > 0) {
        // Loop através dos resultados e exibir cada pedido
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['nome_cliente']}</td>";
            echo "<td>{$row['telefone']}</td>";
            echo "<td>{$row['endereco']}</td>";
            echo "<td>{$row['nome_lanche']}</td>";
            echo "<td>{$row['quantidade']}</td>";

            // Calcular o preço total do pedido
            $preco_total = $row['quantidade'] * $row['preco_lanche'];

            // Exibir o preço total
            echo "<td>R$ " . number_format($preco_total, 2, ',', '.') . "</td>";

            echo "<td>";
            echo "<a href='../Controller/editarPedido.php?id={$row['id']}' class='btn btn-primary btn-sm'>Editar</a> ";
            echo "<a href='../Controller/excluirPedido.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir este pedido?\")'>Excluir</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        // Se não houver pedidos, exibir uma linha indicando que nenhum pedido foi encontrado
        echo "<tr><td colspan='7'>Nenhum pedido encontrado.</td></tr>";
    }
    ?>
</tbody>
        </table>
    </div>

</body>
</html>
