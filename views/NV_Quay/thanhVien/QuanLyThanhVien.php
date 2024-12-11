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
</head>
<body>
    <?php require_once('../views/NV_Quay/layout/header.php'); ?>

    <?php require_once('../views/NV_Quay/layout/sidebar.php'); ?>

    <?php require_once('../views/NV_Quay/layout/spinner.php'); ?>
    <div class="container-fluid pt-4 px-4 my-1">
    <h2 class="mb-4">Quản Lý Thành Viên</h2>

    <!-- Tìm kiếm khách hàng -->
    <div class="row mb-3">
        <div class="col-sm-12 col-xl-10">
            <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm khách hàng theo số điện thoại">
        </div>
        <div class="col-sm-3 col-xl-2">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMemberModal">Thêm Thành Viên Mới</button>
        </div>
    </div>

    <!-- Bảng danh sách khách hàng -->
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>Mã Khách Hàng</th>
                <th>Tên Khách Hàng</th>
                <th>Email</th>
                <th>Số Điện Thoại</th>
                <th>Ngày Sinh</th>
                <th>Vai Trò</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody id="customerTable">
            <?php foreach ($members as $member): ?>
                <tr data-id="<?= $member['userID'] ?>">
                    <td><?= $member['userID'] ?></td>
                    <td><?= $member['hoTen'] ?></td>
                    <td><?= $member['email'] ?></td>
                    <td><?= $member['sdt'] ?></td>
                    <td><?= $member['ngaySinh'] ?></td>
                    <td class="status"><?= $member['vaiTro'] ?></td>
                    <td class="text-center">
                        <a href="/GYM-WEB/public/NV_Quay/thanhVien/chiTietThanhVien?userID=<?= $member['userID'] ?>" class="btn btn-info">Xem Thông Tin</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <div id="pagination" class="d-flex justify-content-center align-items-center mt-4 mb-4">
        <a href="/GYM-WEB/public/NV_Quay/thanhVien?page=<?= max(1, $currentPage - 1) ?>" class="btn btn-secondary">Trang Trước</a>
        <span class="mx-3">Trang <?= $currentPage ?> / <?= $totalPages ?></span>
        <a href="/GYM-WEB/public/NV_Quay/thanhVien?page=<?= min($totalPages, $currentPage + 1) ?>" class="btn btn-secondary">Trang Tiếp</a>
    </div>
</div>

<!-- Modal Thêm Thành Viên -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberModalLabel">Thêm Thành Viên Mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addMemberForm">
                <div class="modal-body">
                    <div id="error-message" style="color: red"></div>
                    <div class="mb-3">
                        <label for="hoTen" class="form-label">Họ Tên</label>
                        <input type="text" class="form-control" style="color: white;" id="hoTen" name="hoTen" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" style="color: white;" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="sdt" class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control" style="color: white;" id="sdt" name="sdt" required>
                    </div>
                    <div class="mb-3">
                        <label for="ngaySinh" class="form-label">Ngày Sinh</label>
                        <input type="date" class="form-control" style="color: white;" id="ngaySinh" name="ngaySinh" required>
                    </div>
                    <div class="mb-3">
                        <label for="matKhau" class="form-label">Mật Khẩu</label>
                        <input type="password" class="form-control" style="color: white;" id="matKhau" name="matKhau" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Thêm Thành Viên</button>
                </div>
            </form>
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
<!-- JavaScript cho tìm kiếm khách hàng -->
    <script>
        // Lấy các phần tử từ HTML
        const searchInput = document.getElementById("searchInput");
        const customerTable = document.getElementById("customerTable");
        // Lấy các phần tử từ HTML
        const emailInput = document.getElementById("email");
        const phoneInput = document.getElementById("sdt");
        const birthDateInput = document.getElementById("ngaySinh");
        const addMemberForm = document.getElementById("addMemberForm");
        const errorMessage = document.createElement("div");  // Để hiển thị thông báo lỗi

        // Thêm thông báo lỗi vào modal nếu có lỗi
        document.getElementById("error-message").appendChild(errorMessage);

        // Lắng nghe sự kiện khi người dùng nhập email và số điện thoại
        function checkUniqueValues() {
            const emailValue = emailInput.value.trim();
            const phoneValue = phoneInput.value.trim();
            const birthDateValue = birthDateInput.value.trim();
        
            // Lấy tất cả các dòng trong bảng khách hàng
            const rows = document.getElementById("customerTable").getElementsByTagName("tr");
            let errorMessageContent = "";
            let isFormValid = true;
            
            // Kiểm tra ngày sinh có hợp lệ không (người dùng phải trên 14 tuổi)
            if (birthDateValue) {
                const today = new Date();
                const birthDate = new Date(birthDateValue);
                const age = today.getFullYear() - birthDate.getFullYear();
                const month = today.getMonth() - birthDate.getMonth();
                if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
            
                if (age < 14) {
                    errorMessageContent += "Phải trên 14 tuổi để đăng ký.<br>";
                    isFormValid = false;
                }
            }
            // Lặp qua từng dòng trong bảng để kiểm tra
            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const emailCell = row.getElementsByTagName("td")[2];  // Cột email (giả sử cột email ở vị trí thứ 2)
                const phoneCell = row.getElementsByTagName("td")[3];  // Cột số điện thoại (giả sử cột số điện thoại ở vị trí thứ 3)
            
                if (emailCell && phoneCell) {
                    const existingEmail = emailCell.textContent.trim();
                    const existingPhone = phoneCell.textContent.trim();
                
                    // Kiểm tra email và số điện thoại có trùng không
                    if (existingEmail === emailValue) {
                        errorMessageContent += "Email đã tồn tại. Vui lòng nhập email khác.<br>";
                        isFormValid = false;
                    }
                
                    if (existingPhone === phoneValue) {
                        errorMessageContent += "Số điện thoại đã tồn tại. Vui lòng nhập số điện thoại khác.<br>";
                        isFormValid = false;
                    }
                }
            }
        
            // Hiển thị thông báo lỗi
            if (errorMessageContent) {
                errorMessage.innerHTML = errorMessageContent;
                errorMessage.style.color = "red";
                addMemberForm.querySelector("button[type='submit']").disabled = true;  // Vô hiệu hóa nút Submit
            } else {
                errorMessage.innerHTML = "";  // Xóa thông báo lỗi nếu không có lỗi
                addMemberForm.querySelector("button[type='submit']").disabled = false;  // Kích hoạt nút Submit
            }
        }

        // Lắng nghe sự kiện khi người dùng nhập vào ô email hoặc số điện thoại
        emailInput.addEventListener("input", checkUniqueValues);
        phoneInput.addEventListener("input", checkUniqueValues);
        birthDateInput.addEventListener("input", checkUniqueValues);
        
        // Lắng nghe sự kiện tìm kiếm
        searchInput.addEventListener("keyup", function() {
            const searchValue = searchInput.value.toLowerCase();  // Lấy giá trị tìm kiếm và chuyển thành chữ thường
            const rows = customerTable.getElementsByTagName("tr");  // Lấy tất cả các dòng trong bảng

            // Lặp qua từng dòng và kiểm tra nội dung
            Array.from(rows).forEach(row => {
                const phoneCell = row.getElementsByTagName("td")[3];  // Cột Số Điện Thoại

                if (phoneCell) {
                    const phone = phoneCell.textContent.toLowerCase();  // Lấy số điện thoại và chuyển thành chữ thường

                    // Kiểm tra nếu từ khóa tìm kiếm có trong số điện thoại
                    if (phone.includes(searchValue)) {
                        row.style.display = "";  // Hiển thị dòng
                    } else {
                        row.style.display = "none";  // Ẩn dòng nếu không khớp
                    }
                }
            });
        });
    </script>
    <script>
        document.getElementById('addMemberForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Lấy giá trị từ form
            const hoTen = document.getElementById('hoTen').value.trim();
            const email = document.getElementById('email').value.trim();
            const sdt = document.getElementById('sdt').value.trim();
            const ngaySinh = document.getElementById('ngaySinh').value;
            const matKhau = document.getElementById('matKhau').value.trim();

            // Kiểm tra dữ liệu nhập
            if (!hoTen || !/^[A-Z][a-zA-z]*(\s[A-Z][a-zA-Z]*)*$/.test(hoTen)) {
                alert('Họ và tên trống hoặc sai định dạng');
                return;
            }
        
            if (!email || !/^[a-zA-Z0-9]+\@[a-zA-Z]{4,7}\.[a-zA-Z]{3}$/.test(email)) {
                alert('Email không hợp lệ.');
                return;
            }
        
            if (!sdt || !/^\d{10}$/.test(sdt)) {
                alert('Số điện thoại phải bao gồm 10 chữ số.');
                return;
            }
        
            if (!ngaySinh) {
                alert('Vui lòng chọn ngày sinh.');
                return;
            }
        
            if (!matKhau || matKhau.length < 6) {
                alert('Mật khẩu phải có ít nhất 6 ký tự.');
                return;
            }
        
            const formData = new FormData(this);
            fetch('models/add_member_handler.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Thành viên đã được thêm thành công!');
                    location.reload(); // Tải lại trang để cập nhật danh sách
                } else {
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>

</html>
