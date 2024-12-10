<?php
    require_once '../models/QuanLyLichLamViecModel.php'; 

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $lichLamViec = new LichLamViec();
        $employeeList = $lichLamViec->getEmployeeList();
    
        // Trả về danh sách nhân viên dưới dạng JSON
        echo json_encode($employeeList);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $date = $_POST['date'];
        $shift = $_POST['shift'];
        $userID = $_POST['userID'];
    
        // Tạo thể hiện của lớp LichLamViec
        $lichLamViec = new LichLamViec();
        
        // Gọi phương thức để thêm nhân viên vào lịch làm việc
        $result = $lichLamViec->addEmployeeToSchedule($date, $shift, $userID);
    
        // Trả về kết quả dưới dạng JSON
        echo json_encode($result);
    }

?>
