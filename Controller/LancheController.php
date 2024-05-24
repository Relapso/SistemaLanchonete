<?php
require '../Model/LancheModel.php';

class LancheController {
    public function listarLanches($pdo) {
        $lancheModel = new LancheModel();
        return $lancheModel->listarLanches($pdo);
    }
}
?>