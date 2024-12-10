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

    </style>
</head>
<body>
    <?php require_once('../views/Admin/layout/header.php'); ?>
    <?php require_once('../views/Admin/layout/sidebar.php'); ?>
    <?php require_once('../views/Admin/layout/spinner.php'); ?>
    
    <!-- Bảng tạo lịch làm việc -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12"> 
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="mb-0">Quản Lý Lịch làm việc</h2>
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
                                    foreach ($lichLamViec[$date][$shift] as $user) {
                                        echo "<span class='span-user'> $user</span> <br>";  // Hiển thị tên và mã người dùng
                                    }
                                }
                                 else {
                                    // Thêm nút + trong ô
                                    echo "<button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#addUserModal' 
                                    data-date='$date' data-shift='$shift'>
                                    +
                                    </button>";
                                    echo '</td>';                                
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
        <!-- Nút Tạo Lịch Làm Việc -->
<button id="saveScheduleButton" class="btn btn-primary mt-3">Tạo Lịch Làm Việc</button>

<!-- Modal Thêm Nhân Viên -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addUserForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Thêm Nhân Viên Vào Lịch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="dateInput" name="date">
                    <input type="hidden" id="shiftInput" name="shift">
                    <div class="form-group">
                        <label for="employeeSelect">Chọn nhân viên:</label>
                        <select id="employeeSelect" multiple class="form-select">
                            <!-- Các tùy chọn nhân viên sẽ được thêm bằng Ajax -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" id="addSelectedEmployees" class="btn btn-success">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>


        <!-- Bảng danh sách lịch làm việc -->
        <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12"> 
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lịch làm việc</h6>
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
                                    foreach ($lichLamViec[$date][$shift] as $user) {
                                        echo "<span class='span-user'> $user</span> <br>";  // Hiển thị tên và mã người dùng
                                    }
                                } else {
                                    echo "";  // Nếu không có người làm việc trong ca này
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
