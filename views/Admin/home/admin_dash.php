<?php
if (!isset($_SESSION['user']) || $_SESSION['user_entry']['vaiTro'] !== 'Admin') {
    // Redirect to the login page if the user is not logged in or does not have the admin role
    header('Location: ..' );
    exit();
}
?>
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
    <link href="asset/image/favicon.ico" rel="icon">

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
    <style>
        #dongho{
            padding: 17.19px;
        }
    </style>
</head>
<body>
<?php require_once('../views/Admin/layout/header.php'); ?>

<?php require_once('../views/Admin/layout/sidebar.php'); ?>

<?php require_once('../views/Admin/layout/spinner.php'); ?>


<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Đăng ký mới -->
        <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user-plus fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Đăng ký mới</p>
                        <h6 class="mb-0"><?php echo $newRegistrations; ?></h6>
                    </div>
                </div>
            </div>
            <!-- Doanh thu hôm nay -->
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-dollar-sign fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Doanh thu hôm nay</p>
                        <h6 class="mb-0"><?php echo number_format($todayRevenue, 2); ?> VNĐ</h6>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between" id="dongho">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-clock fa-3x text-primary me-3"></i>
                        <div class="ms-3">
                            <p class="mb-2">Đồng hồ và Thời tiết</p>
                            <h6 id="clock" class="clock mb-0"></h6>
                        </div>
                    </div>
                    <div id="weather" class="d-flex flex-column align-items-center">
                        <img id="weather-icon" src="" alt="Weather" width="40">
                        <p id="weather-temp" class="mb-0"></p>
                    </div>
                </div>
            </div>
            
            <!-- Tổng thành viên -->
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Thành viên hiện tại</p>
                        <h6 class="mb-0"><?php echo $currentMembers; ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Doanh Thu 3 Tháng Gần Nhất</h6>
                    </div>
                        <canvas id="revenueChart"></canvas>
                    </div>
            </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <iframe class="position-relative rounded w-100 h-100"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.8582378431365!2d106.6868454!3d10.8221589!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174deb3ef536f31%3A0x8b7bb8b7c956157b!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2hp4buHcCBUUC5IQ00!5e0!3m2!1svi!2s!4v1731661078117!5m2!1svi!2s"
                frameborder="0" allowfullscreen="" aria-hidden="false"
                tabindex="0" style="filter: grayscale(100%) invert(92%) contrast(83%); border: 0;"></iframe>
                
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-xl-12 pt-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Thành viên hiện tại</h6>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Tên Khách Hàng</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Ngày Sinh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?php echo $member['hoTen']; ?></td>
                        <td><?php echo $member['email']; ?></td>
                        <td><?php echo $member['sdt']; ?></td>
                        <td><?php echo $member['ngaySinh']; ?></td>
                        <!-- <td><a class="btn btn-sm btn-primary" href="">Detail</a></td> -->
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                        <a class="page-link" href="/GYM-WEB/public/?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php endfor; ?>
                </ul>
            </nav>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
<!-- Template Javascript -->
<script src="asset/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Fetch dữ liệu từ API
    fetch('models/handle_DoanhThu.php')
        .then(response => response.json())
        .then(data => {
            // Xử lý dữ liệu từ API
            const labels = data.map(item => `Tháng ${item.month}`);
            const revenues = data.map(item => item.revenue);

            // Tạo biểu đồ
            const ctx = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Loại biểu đồ
                data: {
                    labels: labels, // Nhãn (tháng)
                    datasets: [{
                        label: 'Doanh Thu (VNĐ)',
                        data: revenues, // Dữ liệu doanh thu
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
</script>
<script>
function updateClock() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    var clockElement = document.getElementById('clock');
    clockElement.textContent = padZero(hours) + ':' + padZero(minutes) + ':' + padZero(seconds);
}

function padZero(number) {
    return String(number).padStart(2, '0');
}

setInterval(updateClock, 1000); // Cập nhật đồng hồ mỗi 1 giây
updateClock(); // Cập nhật đồng hồ ngay lập tức

// Function to update weather information
function updateWeather() {
    const apiKey = '547ae409811f0b5ece59c9218aea2f9c'; // Thay YOUR_API_KEY bằng API Key của bạn 547ae409811f0b5ece59c9218aea2f9c

    const city = 'Ho Chi Minh City'; // Thành phố bạn muốn lấy dự báo thời tiết
    const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`;

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            const iconCode = data.weather[0].icon; // Mã icon thời tiết
            const temp = Math.round(data.main.temp); // Nhiệt độ hiện tại

            // Cập nhật giao diện
            document.getElementById('weather-icon').src = `https://openweathermap.org/img/wn/${iconCode}@2x.png`;
            document.getElementById('weather-temp').textContent = `${temp}°C`;
        })
        .catch(error => console.error('Error fetching weather data:', error));
}

// Cập nhật thời tiết mỗi 10 phút
updateWeather();
setInterval(updateWeather, 10 * 60 * 1000);
</script>
