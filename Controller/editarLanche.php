<?php
require_once '../Dao/config.php';
require_once '../Dao/LancheDAO.php';

session_start();

$lancheDAO = new LancheDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $lanche = $lancheDAO->obterLanchePorId($pdo, $id);

    if (!$lanche) {
        $_SESSION['mensagem'] = "Lanche não encontrado!";
        header("Location: ../View/cardapio.php");
        exit();
    }
} else {
    header("Location: ../View/cardapio.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $figura = $_FILES['figura']['name']; // Obtenha o nome do arquivo da imagem
    
    // Verifica se foi enviado um arquivo
    if (isset($_FILES['figura']['name']) && $_FILES['figura']['error'] == 0) {
        $figura_tmp = $_FILES['figura']['tmp_name']; // Nome temporário do arquivo
        move_uploaded_file($figura_tmp, "../caminho/para/salvar/".$figura); // Move o arquivo para o destino desejado
    } else {
        $figura = $lanche['figura']; // Se não for enviado um novo arquivo, mantém o nome da imagem existente
    }

    if ($lancheDAO->atualizarLanche($pdo, $id, $nome, $preco, $figura)) {
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT='0; URL=../View/cardapio.php'>
        <script type=\"text/javascript\">
        alert(\"Lanche alterado com sucesso!\");
        </script>
        ";
        exit();
    } else {
        $_SESSION['mensagem'] = "Falha ao atualizar lanche!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Editar Lanche</title>
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
                    <h4 class="card-title">Editar Lanche</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['mensagem'])): ?>
                        <div class="alert <?php echo strpos($_SESSION['mensagem'], 'sucesso') !== false ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                            <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="editarLanche.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Lanche:</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($lanche['nome']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço:</label>
                            <input type="text" class="form-control" id="preco" name="preco" value="<?php echo htmlspecialchars($lanche['preco']); ?>" required>
                        </div>  
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a href="../View/cardapio.php" class="btn btn-secondary mt-2">Cancelar</a>
                        </div>
                    </form>
