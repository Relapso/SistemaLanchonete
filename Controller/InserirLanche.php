<?php
require '../Dao/config.php';
require '../Model/LancheModel.php';

session_start();

if (
    isset($_POST['nome' ]) && !empty($_POST[ 'nome']) &&
    isset($_POST['preco']) && !empty($_POST['preco']) &&
    isset($_FILES['figura'])
    )
    {
    $nome = addslashes($_POST['nome']);
    $preco = addslashes($_POST['preco']);
    
    // Define o local onde será feito o upload da foto do lanche
    $diretorio = "../img/";
    
    // Reescreve o nome do arquivo
    $extensao = strtolower(substr($_FILES['figura']['name'], -4));
    $novo_nome = md5(time()) . $extensao;
    
    // Move o arquivo para a pasta "img" com o novo nome
    if (move_uploaded_file($_FILES['figura']['tmp_name'], $diretorio . $novo_nome)) {
        // Caminho completo da imagem para ser salvo no banco de dados
        $caminhoImagem = $diretorio . $novo_nome;
        
        // Faz a inserção de dados no BD
        $sql = "INSERT INTO lanches SET nome = '$nome', preco = '$preco', figura = '$caminhoImagem'";
        // PDO executa a query SQL do INSERT
        if ($pdo->query($sql)) {
        // JavaScript que retorna para o usuario que foi cadastrado com sucesso
        // Direciona para a página cardapio
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT='0; URL=../View/cardapio.php'>
        <script type=\"text/javascript\">
        alert(\"Lanche cadastrado com sucesso!\");
        </script>
        ";
        } else {
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT='0; URL=../view/cadastroLanche.php'>
        <script type=\"text/javascript\">
        alert(\"Falha ao cadastrar!\");
        </script>
        ";
        }
    }
    }
    ?>