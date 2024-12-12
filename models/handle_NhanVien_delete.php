<?php
require_once '../models/NhanVienModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNhanVien = isset($_POST['idNhanVien']) ? $_POST['idNhanVien'] : null;

    if ($idNhanVien) {
        $nhanVienModel = new Employees();
        $result = $nhanVienModel->deleteNhanVien($idNhanVien);

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