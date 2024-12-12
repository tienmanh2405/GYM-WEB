<!-- <?php ?> -->
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
    <!-- css -->
    <style>
        
        /* ẩn năm của bộ lọc */
        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
        }

        input[type="date"]::-webkit-datetime-edit-year-field {
            color: white;
        }

        input[type="date"]::-webkit-datetime-edit-text {
            margin: 0 0.2em;
        }

        input[type="date"]::-webkit-datetime-edit-month-field,
        input[type="date"]::-webkit-datetime-edit-day-field {
            color: white;
}
    </style>
</head>
<body>
    <?php require_once('../views/Admin/layout/header.php'); ?>

    <?php require_once('../views/Admin/layout/sidebar.php'); ?>

    <?php require_once('../views/Admin/layout/spinner.php'); ?>
    <div class="container-fluid pt-4 px-4 my-1">
    <!-- cố định năm theo $currentYear (chỉ được nhập ngày/tháng) -->
        <?php
            $startDate = $currentYear . "-01-01"; // Ngày bắt đầu: 1/1 của năm hiện tại
            $endDate = $currentYear . "-12-31";  // Ngày kết thúc: 31/12 của năm hiện tại
        ?>
    <h2>Báo cáo doanh thu năm <?= $currentYear ?></h2>
        <!-- <h1>Báo Cáo Doanh Thu Năm <?php echo $year; ?></h1> -->
        
        
<div class="mb-3" style="flex-grow: 1; max-width: 900px; padding-left: 10px;">
    <div class="row">
        <div class="col-md-6">
            <!-- Tìm kiếm -->
            <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm theo tên khách hàng hoặc gói đăng ký">
        </div>
        <div class="col-md-6">
            <div class="input-group ">
                <!-- lọc ngày/tháng -->
                <table>
                    <tr>
                        <td>Từ:</td>
                        <td><input type="date" id="startDate" class="form-control" value="<?php echo $startDate; ?>"></td>
                        <td>Đến: </td>
                        <td><input type="date" id="endDate" class="form-control" value="<?php echo $endDate; ?>"></td>
                    </tr>
                </table>
                <!-- <input type="date" id="startDate" class="form-control"> 
                <input type="date" id="endDate" class="form-control"> -->
            </div>
        </div>
    </div>
</div>
        <?php
$totalAmount = 0;  // Biến tổng tiền

?>
<!-- Bảng doanh thu -->
<table class="table table-striped text-center">
    <thead>
        <tr>
            <th>Ngày thanh toán</th>
            <th>Tên Khách hàng</th>
            <th>Gói đăng ký</th>
            <th>Thành tiền</th>
            
        </tr>
    </thead>
    <tbody id="customerTable">
    <?php if (!empty($doanhThu)) : ?>
    <?php foreach ($doanhThu as $item) : ?>
    <?php
        // Sắp xếp mảng $doanhThu theo ngày thanh toán (giảm dần)
    usort($doanhThu, function($a, $b) {
        return strtotime($b['ngayThanhToan']) - strtotime($a['ngayThanhToan']);
    });
    ?>
        <!-- Hiển thị dữ liệu từ biến $item ở đây -->
        <tr>
            <td><?php echo $item['ngayThanhToan']; ?></td>
            <td><?php echo $item['tenKhachHang']; ?></td>
            <td><?php echo $item['tenGoiTap']; ?></td>
            <td><?php echo number_format($item['tongTien'], 0, '', '.'); ?></td>
        </tr>
        <?php $totalAmount += $item['tongTien']; ?> <!--  Cập nhật biến tổng tiền -->
    <?php endforeach; ?>
<?php endif; ?>
    </tbody>
</table>

<!-- Hiển thị tổng tiền -->
<div class="text-right mt-3">
    <strong>Tổng tiền: <?php echo number_format($totalAmount, 0, '', '.'); ?> VND</strong>
</div>


        <!-- Phân trang -->
        <div id="pagination" class="d-flex justify-content-center">
            <a href="/GYM-WEB/public/Admin/baoCaoDoanhThu?page=<?= max(1, $currentPage - 1) ?>" class="btn btn-secondary">Trang Trước</a>
            <span class="mx-3">Trang <?= $currentPage ?> / <?= $totalPages ?></span>
            <a href="/GYM-WEB/public/Admin/baoCaoDoanhThu?page=<?= min($totalPages, $currentPage + 1) ?>" class="btn btn-secondary">Trang Tiếp</a>
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
    // Lấy các phần tử từ HTML
    const searchInput = document.getElementById("searchInput");
    const customerTable = document.getElementById("customerTable");
    const startDateInput = document.getElementById("startDate");
    const endDateInput = document.getElementById("endDate");

    // Lắng nghe sự kiện tìm kiếm
    searchInput.addEventListener("keyup", function() {
        filterTable();
    });

    // Lắng nghe sự kiện chọn ngày
    startDateInput.addEventListener("change", function() {
        filterTable();
    });

    endDateInput.addEventListener("change", function() {
        filterTable();
    });

    // Hàm lọc bảng
function filterTable() {
    const searchValue = searchInput.value.toLowerCase();  // Lấy giá trị tìm kiếm và chuyển thành chữ thường
    const startDateValue = startDateInput.value;  // Lấy giá trị ngày bắt đầu
    const endDateValue = endDateInput.value;  // Lấy giá trị ngày kết thúc
    const rows = customerTable.getElementsByTagName("tr");  // Lấy tất cả các dòng trong bảng

    let totalFilteredAmount = 0; // Biến tổng tiền mới

    // Lặp qua từng dòng và kiểm tra nội dung
    Array.from(rows).forEach(row => {
        const nameCell = row.getElementsByTagName("td")[1];  // Cột Tên Khách Hàng
        const packageCell = row.getElementsByTagName("td")[2];  // Cột Gói đăng ký
        const dateCell = row.getElementsByTagName("td")[0];  // Cột Ngày thanh toán
        const amountCell = row.getElementsByTagName("td")[3]; // Cột Thành tiền

        if (nameCell && packageCell && dateCell && amountCell) {
            const name = nameCell.textContent.toLowerCase();  // Lấy tên khách hàng và chuyển thành chữ thường
            const pack = packageCell.textContent.toLowerCase();  // Lấy gói đăng ký và chuyển thành chữ thường
            const date = dateCell.textContent;  // Lấy ngày thanh toán
            const amount = parseInt(amountCell.textContent.replace(/\./g, "")) || 0; // Lấy giá trị thành tiền

            // Kiểm tra nếu từ khóa tìm kiếm có trong tên khách hàng hoặc gói đăng ký và ngày thanh toán nằm trong khoảng ngày
            if (
                (name.includes(searchValue) || pack.includes(searchValue)) &&
                (startDateValue === "" || (date >= startDateValue)) &&
                (endDateValue === "" || (date <= endDateValue))
            ) {
                row.style.display = "";  // Hiển thị dòng
                totalFilteredAmount += amount; // Cộng giá trị thành tiền vào tổng tiền
            } else {
                row.style.display = "none";  // Ẩn dòng nếu không khớp
            }
        }
    });

    // Cập nhật tổng tiền hiển thị
    const totalAmountElement = document.querySelector(".text-right strong");
    totalAmountElement.textContent = `Tổng tiền: ${totalFilteredAmount.toLocaleString()} VND`;
}
</script>


<script>

</script>
</html>
