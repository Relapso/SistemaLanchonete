<?php
require '../Dao/config.php';
require '../Dao/PedidoDAO.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $id_lanche = $_POST['lanche'];
    $quantidade = $_POST['quantidade'];

    $pedidoDAO = new PedidoDAO();
    if ($pedidoDAO->inserirPedido($pdo, $nome, $telefone, $endereco, $id_lanche, $quantidade)) {
        $_SESSION['mensagem'] = "Pedido cadastrado com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Falha ao cadastrar pedido!";
    }
    header("Location: ../View/home.php");
    exit();
}
?>
