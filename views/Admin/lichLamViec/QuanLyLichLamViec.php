<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <base href="/GYM-WEB/">
    <!-- Favicon -->
    <link href="../asset/image/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="asset/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="asset/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="asset/css/style.css" rel="stylesheet">
    
    <!-- Custom Styles for Table Borders -->
    <style>
        table {
        border-collapse: collapse;
        width: 100%;
        color: #333;
        font-family: Arial, sans-serif;
        font-size: 14px;
        text-align: left;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        margin: auto;
        margin-top: 50px;
        margin-bottom: 50px;
        background-color: #fff;
        }
        table th {
            background-color: #ff9800;
            color: blaclk;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid #ccc;
        } 
        table tr, td{
            border: 1px solid #ccc;
            text-align: center;
        vertical-align: middle;
        }  
        .span-user{
            background-color: black; /* Màu nền xanh dương đậm */
            color: white; /* Màu chữ trắng */
            padding: 5px 10px; /* Khoảng cách trong */
            border-radius: 3px; /* Bo góc */
        }
        /* CSS riêng cho modal */
#scheduleModal .form-select,
#scheduleModal .form-control {
    color: white;
}
#scheduleModal .form-label {
    color: black;
    font-weight: bold;
}
#scheduleModal .modal-title {
        color: black; /* Màu chữ đen */
    }
    .btn-align-right {
        display: block;
        margin-left: auto;
        margin-right: 0;
    }
    .span-user {
    background-color: black; /* Màu nền */
    color: white; /* Màu chữ */
    padding: 5px 10px; /* Khoảng cách trong */
    border-radius: 3px; /* Bo góc */
    display: inline-block; /* Để có thể áp dụng margin */
    margin-bottom: 5px; /* Tạo khoảng cách giữa các tên */
}


    </style>
</head>
<body>
    <?php require_once('../views/Admin/layout/header.php'); ?>
    <?php require_once('../views/Admin/layout/sidebar.php'); ?>
    <?php require_once('../views/Admin/layout/spinner.php'); ?>

        <!-- Bảng danh sách lịch làm việc -->
        <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12"> 
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="mb-0">Lịch làm việc</h2>
                </div>
                    <?php 
                        // Lấy các ngày trong tuần hiện tại
                        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        $currentDate = date('Y-m-d');
                        $firstDayOfWeek = date('Y-m-d', strtotime('last Monday', strtotime($currentDate))); // Tính ngày đầu tuần (thứ 2)
                        $weekDates = [];  // Mảng để chứa các ngày trong tuần

                        // Tính tất cả các ngày trong tuần hiện tại (từ thứ Hai đến Chủ Nhật)
                        for ($i = 0; $i < 7; $i++) {
                            $weekDates[] = date('Y-m-d', strtotime("+$i day", strtotime($firstDayOfWeek)));
                        }

                        echo '<table class="table ">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th scope="col">Ca làm việc</th>';

                        // Hiển thị các ngày trong tuần (tên ngày)
                        foreach ($weekDates as $date) {
                            $dayOfWeek = date('l', strtotime($date));  // Lấy tên ngày trong tuần
                            echo "<th scope=\"col\">$dayOfWeek<br>($date)</th>";
                        }
                        echo '</tr>';
                        echo '</thead>';

                        echo '<tbody>';

                        // Các ca làm việc trong ngày
                        $shifts = ['Ca sáng', 'Ca chiều'];

                        foreach ($shifts as $shift) {
                            echo '<tr>';
                            echo "<td><strong>$shift</strong></td>";
                            foreach ($weekDates as $date) {
                                echo '<td>';
                                if (isset($lichLamViec[$date][$shift])) {
                                    foreach ($lichLamViec[$date][$shift] as $entry) {
                                        $user = $entry['user'];
                                        $maLich = $entry['maLich'];
                                        // Thêm maLich vào thẻ <a> để gửi tham số xóa
                                        echo "<span class='span-user'> $user</span> 
                                            <a href='models/handle_LichLamViec_delete.php?maLich=$maLich' class='btn-remove' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>x</a>
                                        <br>";
                                    }
                                } else {
                                    echo ""; // Nếu không có người làm việc trong ca này
                                }
                                echo '</td>';
                            }
                            
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    ?>
                </div>
            </div>
        </div>

        <!-- Button to open modal -->
        <div class="d-flex justify-content-end">
    <button type="button" class="btn btn-primary me-4" data-bs-toggle="modal" data-bs-target="#scheduleModal">
        Tạo lịch làm việc
    </button>
</div>


<!-- Modal structure -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">Tạo lịch làm việc</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="models/handle_LichLamViec_add.php" method="post">
                    <div class="mb-3">
                        <label for="ngayLamViec" class="form-label">Ngày làm việc</label>
                        <select class="form-select" id="ngayLamViec" name="ngayLamViec" required>
                            <?php
                            // Tạo mảng các ngày trong tuần từ thứ Hai đến Chủ Nhật
                            $daysOfWeek = [];
                            $currentDate = new DateTime(); // Ngày hiện tại
                            $startOfWeek = clone $currentDate;
                            $startOfWeek->modify('monday this week');

                            for ($i = 0; $i < 7; $i++) {
                                $date = clone $startOfWeek;
                                $date->modify("+$i day");
                                $formattedDate = $date->format('Y-m-d');
                                $dayName = $date->format('l'); // Tên ngày trong tuần
                                echo "<option value='$formattedDate'>$dayName ($formattedDate)</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userID" class="form-label">Nhân viên</label>
                        <select class="form-select" id="userID" name="userID[]" multiple required>
                            <?php
                            require_once "../config/database.php";
                            $database = new Database();
                            $conn = $database->connect();

                            $result = $conn->query("SELECT userID, hoTen FROM nguoidung WHERE vaiTro IN ('NVQuay', 'HuongDanVien', 'NVBaoTri')");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['userID']}'>{$row['hoTen']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="caLamViec" class="form-label">Ca làm việc</label>
                        <select class="form-select" id="caLamViec" name="caLamViec" required>
                            <option value="Ca sáng">Ca sáng</option>
                            <option value="Ca chiều">Ca chiều</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-align-right" >Tạo lịch làm việc</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="asset/lib/chart/chart.min.js"></script>
    <script src="asset/lib/easing/easing.min.js"></script>
    <script src="asset/lib/waypoints/waypoints.min.js"></script>
    <script src="asset/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="asset/lib/tempusdominus/js/moment.min.js"></script>
    <script src="asset/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="asset/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    
</body>

<!-- Template Javascript -->
<script src="asset/js/main.js"></script>
<script>
   
</script>
</html>
