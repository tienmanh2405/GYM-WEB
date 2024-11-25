<?php
require_once '../models/ThietBiModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idThietBi = isset($_POST['idThietBi']) ? $_POST['idThietBi'] : null;

    if ($idThietBi) {
        $ThietBiModel = new Equipment();
        $result = $ThietBiModel->deleteThietBi($idThietBi);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
}
?>