<?php
require_once '../Dao/config.php';
require_once '../Dao/PedidoDAO.php';

session_start();

$pedidoDAO = new PedidoDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($pedidoDAO->excluirPedido($pdo, $id)) {
        $_SESSION['mensagem'] = "Pedido excluído com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Falha ao excluir pedido!";
    }
} else {
    $_SESSION['mensagem'] = "ID do pedido não fornecido!";
}

header("Location: ../View/home.php");
exit();
?>
