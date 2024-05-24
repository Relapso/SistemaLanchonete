<?php
require_once 'config.php';

class PedidoDAO {
    public function listarPedidos($pdo) {
        $sql = "SELECT p.*, l.nome AS nome_lanche 
                FROM pedidos p 
                INNER JOIN lanches l ON p.id_lanche = l.id";
        $stmt = $pdo->query($sql);
        $pedidos = [];
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $pedidos[] = $row;
            }
        }
        return $pedidos;
    }
    
    public function obterPedidoPorId($pdo, $id) {
        $sql = "SELECT * FROM pedidos WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarPedido($pdo, $id, $nome, $telefone, $endereco, $id_lanche, $quantidade) {
        $sql = "UPDATE pedidos SET nome_cliente = ?, telefone = ?, endereco = ?, id_lanche = ?, quantidade = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nome, $telefone, $endereco, $id_lanche, $quantidade, $id]);
    }    

    public function excluirPedido($pdo, $id) {
        $sql = "DELETE FROM pedidos WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function inserirPedido($pdo, $nome, $telefone, $endereco, $id_lanche, $quantidade) {
        try {
            $sql = "INSERT INTO pedidos (nome_cliente, telefone, endereco, id_lanche, quantidade) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$nome, $telefone, $endereco, $id_lanche, $quantidade]);
        } catch (PDOException $e) {
            echo "Erro no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public function listarLanches($pdo) {
        $sql = "SELECT * FROM lanches";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
