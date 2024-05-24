<?php
require_once '../Dao/config.php';
require_once '../Dao/PedidoDAO.php';

session_start();

$pedidoDAO = new PedidoDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pedido = $pedidoDAO->obterPedidoPorId($pdo, $id);

    if (!$pedido) {
        $_SESSION['mensagem'] = "Pedido não encontrado!";
        header("Location: ../View/home.php");
        exit();
    }
} else {
    header("Location: ../View/home.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $id_lanche = $_POST['lanche'];
    $quantidade = $_POST['quantidade'];

    if ($pedidoDAO->atualizarPedido($pdo, $id, $nome, $telefone, $endereco, $id_lanche, $quantidade)) {
            echo "
            <META HTTP-EQUIV=REFRESH CONTENT='0; URL=../View/home.php'>
            <script type=\"text/javascript\">
            alert(\"Pedido alterado com sucesso!\");
            </script>
            ";
            } 
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Editar Pedido</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li>
                <a class="navbar-brand" href="#">Lanchonete Winx</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../View/home.php">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../View/cardapio.php">CARDAPIO</a>
            </li>
        </ul>

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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title">Editar Pedido</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['mensagem'])): ?>
                        <div class="alert <?php echo strpos($_SESSION['mensagem'], 'sucesso') !== false ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                            <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
                        </div>
                    <?php endif; ?>
                    <form action="editarPedido.php?id=<?php echo $id; ?>" method="post">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Cliente:</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($pedido['nome_cliente']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($pedido['telefone']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço:</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo htmlspecialchars($pedido['endereco']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="lanche" class="form-label">Lanche:</label>
                            <select class="form-select" id="lanche" name="lanche" required>
                                <?php
                                $stmt = $pdo->query("SELECT * FROM lanches");
                                while ($lanche = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $selected = $lanche['id'] == $pedido['id_lanche'] ? 'selected' : '';
                                    echo "<option value='{$lanche['id']}' $selected>{$lanche['nome']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantidade" class="form-label">Quantidade:</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" value="<?php echo htmlspecialchars($pedido['quantidade']); ?>" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a href="../View/home.php" class="btn btn-secondary mt-2">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
