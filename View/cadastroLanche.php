<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Aula_09 - PHP</title>
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
        <form action="../Controller/InserirLanche.php" method="post" enctype="multipart/form-data" style="max-width: 500px; width: 100%;" class="bg-light mx-auto border border-2 p-4">
            <h2>CADASTRO DE LANCHES</h2>    
            <hr class="my-3">
            <div class="mb-3">
                <label class="form-label fw-bold">Nome:</label>
                <input type="text" class="form-control" placeholder="Nome do Lanche" name="nome" required>
            </div>
            
            <div class="mb-3 mt-3">
                <label class="form-label fw-bold">Preço:</label>
                <input type="text" class="form-control" placeholder="Entre com o preço" name="preco" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label fw-bold">Imagem:</label>
                <input type="file" name="figura" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-dark">Cadastrar</button>
        </form>
    </div>
</body>
</html>
