<?php
require_once '../models/GoiTapModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idGoiTap = isset($_POST['idGoiTap']) ? $_POST['idGoiTap'] : null;

    if ($idGoiTap) {
        $GoiTapModel = new GoiTapModel();
        $result = $GoiTapModel->deleteGoiTap($idGoiTap);

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