<?php
class LancheModel {
    public function listarLanches($pdo) {
        $sql = "SELECT * FROM lanches";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
