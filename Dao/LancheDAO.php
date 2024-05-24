<?php
require_once 'config.php';

class LancheDAO {
    public function listarLanches($pdo) {
        $sql = "SELECT * FROM lanches";
        $stmt = $pdo->query($sql);
        $lanches = [];
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lanches[] = $row;
            }
        }
        return $lanches;
    }
    
    public function obterLanchePorId($pdo, $id) {
        $sql = "SELECT * FROM lanches WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarLanche($pdo, $id, $nome, $preco, $figura) {
        $sql = "UPDATE lanches SET nome = ?, preco = ?, figura = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nome, $preco, $figura, $id]);
    }    

    public function excluirLanche($pdo, $id) {
        $sql = "DELETE FROM lanches WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function inserirLanche($pdo, $nome, $preco, $figura) {
        try {
            $sql = "INSERT INTO lanches (nome, preco, figura) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$nome, $preco, $figura]);
        } catch (PDOException $e) {
            echo "Erro no banco de dados: " . $e->getMessage();
            return false;
        }
    }
}
?>
