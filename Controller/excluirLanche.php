<?php
require_once '../Dao/config.php';
require_once '../Dao/LancheDAO.php';

session_start();

$LancheDAO = new LancheDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Verificar se o ID é numérico e maior que zero
    if (!is_numeric($id) || $id <= 0) {
        $_SESSION['mensagem'] = "ID de lanche inválido!";
    } else {
        if ($LancheDAO->excluirLanche($pdo, $id)) {
            $_SESSION['mensagem'] = "Lanche excluído com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Falha ao excluir lanche!";
        }
    }
} else {
    $_SESSION['mensagem'] = "ID do lanche não fornecido!";
}

header("Location: ../View/cardapio.php");
exit();
?>