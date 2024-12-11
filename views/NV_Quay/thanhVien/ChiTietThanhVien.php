<?php 
    require_once '../models/ThanhVienModel.php';
    require_once '../models/LichSuHoatDongModel.php';
    require_once '../models/GoiTapModel.php';

    $thanhVienModel = new Member();
    $lichSuHoatDongModel = new LichSuHoatDong();
    $goitap = new GoitapModel();

    $userID = isset($_GET['userID']) ? $_GET['userID'] : null;

    $hasActivePackage = $thanhVienModel->hasActivePackage($userID);
    $goiTapList = $goitap->getGoitap();

    $checkinRecord = $lichSuHoatDongModel->getCheckinStatusByUserID($userID);
    $isCheckedIn = false;
    if ($checkinRecord) {
        if ($checkinRecord['trangthai'] == 'checkin' && $checkinRecord['thoiGianRa'] == null) {
            $isCheckedIn = true;  // Người dùng đã check-in
        }
    }
    if ($userID) {
        // Lấy thông tin thành viên
        $thanhVien = $thanhVienModel->getMembersByUserID($userID);
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
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center mb-4">
                <button onclick="window.history.back()" class="btn btn-secondary mb-0 me-3">
                    <i class="bi bi-arrow-left"></i> Trở lại
                </button>
                <h4 class="mb-0">Thông Tin Thành Viên</h4>
            </div>

               <!-- Nút Check-in -->
                <div class="d-flex mb-4">
                    <?php if ($hasActivePackage): // Kiểm tra nếu có gói hoạt động ?>
                        <?php if (!$isCheckedIn): ?>
                            <!-- Nút màu xanh nếu chưa check-in -->
                            <button id="checkinButton" class="btn btn-success">Check-in</button>
                        <?php else: ?>
                            <!-- Nút màu đỏ nếu đã check-in -->
                            <button id="checkoutButton" class="btn btn-danger">Check-out</button>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- Thông báo nếu không có gói hoạt động -->
                        <span class="text-warning">Bạn cần có một gói hoạt động để Check-in.</span>
                    <?php endif; ?>
                </div>

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item"><strong>ID Thành Viên:</strong> <?= $thanhVien['userID'] ?></li>
                    <li class="list-group-item"><strong>Tên Thành Viên:</strong> <?= $thanhVien['hoTen'] ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?= $thanhVien['email'] ?></li>
                    <li class="list-group-item"><strong>SĐT:</strong> <?= $thanhVien['sdt'] ?></li>
                    <li class="list-group-item"><strong>Ngày Sinh:</strong> <?= $thanhVien['ngaySinh'] ?></li>
                    <li class="list-group-item">
                        <strong>Mật Khẩu:</strong>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control" value="<?= $thanhVien['matKhau'] ?>" readonly>
                            <span class="input-group-text">
                                <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </li>
                </ul>
                
                <div class="row mb-3">
                    <div class="col-sm-12 col-xl-10">
                    <h4 class="mb-4">Thông Tin Gói Đăng Ký</h4>
                    </div>
                    <div class="col-sm-3 col-xl-2">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addGoitapForCustomerModal">Đăng ký mới</button>
                    </div>
                </div>
                <?php
                    $goiDangKyList = $thanhVienModel->getGoiDangKyByUserID($userID);
                    if (!empty($goiDangKyList)) {
                        foreach ($goiDangKyList as $item) {
                ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <p><strong>ID Gói Đăng Ký:</strong> <?= $item['idDangKy'] ?></p>
                        <p><strong>Mã Gói Tập:</strong> <?= $item['maGoiTap'] ?></p>
                        <p><strong>Ngày Hết Hạn:</strong> <?= $item['ngayHetHan'] ?></p>
                        <p><strong>Trạng Thái:</strong> <?= $item['trangThai'] ?></p>
                        <p><strong>Ngày Mua:</strong> <?= $item['ngayMua'] ?></p>
                    </div>
                </div>
                <?php
                        }
                    } else {
                        echo '<div class="alert alert-warning">Không có thông tin gói đăng ký cho thành viên này.</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Không tìm thấy thông tin thành viên.</div>';
                }
                ?>
            </div>
            <div id="invoiceContainer" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hóa đơn</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="invoiceDetails"></div>
                            <div id="qrCodeContainer" style="margin-top: 10px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Modal Thêm Gói Tập Cho Khách Hàng -->
<div class="modal fade" id="addGoitapForCustomerModal" tabindex="-1" aria-labelledby="addGoitapForCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGoitapForCustomerModalLabel">Thêm Gói Tập Cho Khách Hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addGoitapForCustomerForm">
                <div class="modal-body">
                    <!-- Thông tin khách hàng -->
                    <div class="mb-3" style="display: none;">
                        <label for="customerName" class="form-label">customerUserID</label>
                        <input type="text" class="form-control" id="customerUserID" name="customerUserID" value="<?php echo htmlspecialchars($thanhVien['userID']); ?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Tên Khách Hàng</label>
                        <input type="text" class="form-control" id="customerName" name="customerName" value="<?php echo htmlspecialchars($thanhVien['hoTen']); ?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="customerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="customerEmail" name="customerEmail" value="<?php echo htmlspecialchars($thanhVien['email']); ?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="customerPhone" class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control" id="customerPhone" name="customerPhone" value="<?php echo htmlspecialchars($thanhVien['sdt']); ?>" required readonly>
                    </div>
                    <!-- Dropdown Chọn Gói Tập -->
                    <div class="mb-3">
                        <label for="maGoiTap" class="form-label">Chọn Gói Tập</label>
                        <select class="form-select" id="maGoiTap" name="maGoiTap" required>
                            <option value="">Chọn Mã Gói Tập</option>
                            <?php
                            foreach ($goiTapList as $goiTap) {
                                echo "<option value='" . $goiTap['maGoiTap'] . "' data-gia='" . $goiTap['gia'] . "'>" . $goiTap['tenGoiTap'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Dropdown Chọn Khuyến Mãi -->
                    <div class="mb-3">
                        <label for="khuyenMai" class="form-label">Chọn Khuyến Mãi</label>
                        <select class="form-select" id="khuyenMai" name="khuyenMai" required>
                        </select>
                    </div>

                    <!-- Hiển thị giá sau khuyến mãi -->
                    <div class="mb-3">
                        <label for="giaSauKhuyenMai" class="form-label">Giá Sau Khuyến Mãi</label>
                        <input type="text" class="form-control" id="giaSauKhuyenMai" name="giaSauKhuyenMai" readonly>
                    </div>

                    <!-- Phương Thức Thanh Toán -->
                    <div class="mb-3">
                        <label for="phuongThucThanhToan" class="form-label">Phương Thức Thanh Toán</label>
                        <select class="form-select" id="phuongThucThanhToan" name="phuongThucThanhToan" required>
                            <option value="">Chọn Phương Thức Thanh Toán</option>
                            <option value="Tiền mặt">Tiền Mặt</option>
                            <option value="Chuyển khoản">Chuyển Khoản</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Thêm Gói Tập Cho Khách Hàng</button>
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
<script>
    // Lắng nghe sự kiện thay đổi gói tập hoặc khuyến mãi để cập nhật giá
    document.getElementById('maGoiTap').addEventListener('change', updateGiaSauKhuyenMai);
    document.getElementById('khuyenMai').addEventListener('change', updateGiaSauKhuyenMai);

    function updateGiaSauKhuyenMai() {
    // Lấy giá trị gói tập từ thuộc tính data-gia
    const selectedOption = document.getElementById('maGoiTap').selectedOptions[0];
    const giaGoiTap = parseFloat(selectedOption.getAttribute('data-gia'));

    // Lấy giá trị giảm giá từ dropdown khuyến mãi
    const khuyenMaiSelected = document.getElementById('khuyenMai').selectedOptions[0];
    const khuyenMai = parseInt(khuyenMaiSelected?.getAttribute('data-giamgia') || 0); // Nếu không có giá trị giảm giá, mặc định là 0

    if (giaGoiTap > 0) {
        // Tính giá sau khuyến mãi (nếu có khuyến mãi, áp dụng; nếu không, giữ giá hiện tại)
        const giaSauKhuyenMai = khuyenMai > 0 ? giaGoiTap * (1 - khuyenMai / 100) : giaGoiTap;

        // Hiển thị giá sau khuyến mãi
        document.getElementById('giaSauKhuyenMai').value = giaSauKhuyenMai.toLocaleString('vi-VN') + " VND";

        // Lưu giá trị này vào một biến toàn cục hoặc làm gì đó với giá trị mới
        window.giaSauKhuyenMaiValue = giaSauKhuyenMai;
    } else {
        // Đặt giá trị mặc định nếu chưa chọn gói tập
        document.getElementById('giaSauKhuyenMai').value = "0 VND";

        // Đảm bảo giá trị toàn cục là null hoặc không xác định
        window.giaSauKhuyenMaiValue = null;
    }
}


    document.getElementById('maGoiTap').addEventListener('change', function () {
        const maGoiTap = this.value;
        if (maGoiTap) {
            // Gọi API để lấy danh sách khuyến mãi
            fetch(`utils/getKhuyenMai.php?maGoiTap=${maGoiTap}`)
                .then(response => response.json())
                .then(data => {
                    const khuyenMaiSelect = document.getElementById('khuyenMai');
                    khuyenMaiSelect.innerHTML = '<option value="">Chọn Khuyến Mãi</option>'; // Reset options

                    if (data.length > 0) {
                        // Thêm các khuyến mãi khả dụng
                        data.forEach(km => {
                            khuyenMaiSelect.innerHTML += `
                                <option value="${km.maKhuyenMai}" data-giamgia="${km.giamGia}">${km.moTa} - Giảm ${km.giamGia}%</option>
                            `;
                        });
                    } else {
                        // Không có khuyến mãi áp dụng
                        khuyenMaiSelect.innerHTML = '<option value="0" data-giamgia="0">Không có khuyến mãi áp dụng</option>';
                    }
                })
                .catch(err => console.error('Error fetching khuyen mai:', err));
        } else {
            // Nếu không chọn gói tập nào, reset khuyến mãi
            document.getElementById('khuyenMai').innerHTML = '<option value="">Chọn Khuyến Mãi</option>';
        }
    });

    
    // Hiển thị/ẩn mật khẩu khi click vào biểu tượng
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = this;
        
        // Kiểm tra kiểu hiện tại của ô mật khẩu
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text'; // Chuyển sang dạng text
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            passwordInput.type = 'password'; // Chuyển về dạng password
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    });
    document.getElementById('addGoitapForCustomerForm').addEventListener('submit', function (e) {
        e.preventDefault();
        // Lấy giá trị từ form
        const userID = document.getElementById('customerUserID').value.trim();
        const customerName = document.getElementById('customerName').value.trim();
        const customerEmail = document.getElementById('customerEmail').value.trim();
        const customerPhone = document.getElementById('customerPhone').value.trim();
        const maGoiTap = document.getElementById('maGoiTap').value.trim();
        const maKhuyenMai = document.getElementById('khuyenMai').value.trim();
        const phuongThucThanhToan = document.getElementById('phuongThucThanhToan').value.trim();
        const giaSauKhuyenMai = window.giaSauKhuyenMaiValue;

        if (!maGoiTap || !userID || !customerName || !customerEmail || !customerPhone) {
            alert('Vui lòng điền đầy đủ thông tin.');
            return;
        }

        const formData = new FormData(this);
        formData.append('userID', userID);
        formData.append('customerName', customerName);
        formData.append('customerEmail', customerEmail);
        formData.append('customerPhone', customerPhone);
        formData.append('maGoiTap', maGoiTap);
        if (maKhuyenMai) {
        formData.append('maKhuyenMai', maKhuyenMai);
        }
        formData.append('phuongThucThanhToan', phuongThucThanhToan);
        formData.append('giaSauKhuyenMai', giaSauKhuyenMai);

        const addGoitapForCustomerModal = document.getElementById('addGoitapForCustomerModal');
        addGoitapForCustomerModal.style.display = 'none';
        const form = document.getElementById('addGoitapForCustomerForm');
        form.reset();  // Reset tất cả trường trong form
        fetch('utils/add_goitap_for_customer_handler.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => {
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const invoiceContainer = document.getElementById('invoiceContainer');
                    const modal = new bootstrap.Modal(invoiceContainer);
                    const invoiceDetails = document.getElementById('invoiceDetails');
                    const qrCodeContainer = document.getElementById('qrCodeContainer');
                    const invoiceData = data.invoice;
                    const tenGoiTap = data.tenGoiTap;
                    // Cập nhật nội dung hóa đơn
                    invoiceDetails.innerHTML = `
                        <p><strong>Mã hóa đơn:</strong> ${invoiceData.maHoaDon}</p>
                        <p><strong>Gói tập:</strong> ${tenGoiTap}</p>
                        <p><strong>Số tiền:</strong> ${invoiceData.soTien} VND</p>
                        <p><strong>Phương thức thanh toán:</strong> ${invoiceData.phuongThucThanhToan}</p>
                        <p><strong>Ngày thanh toán:</strong> ${invoiceData.ngayThanhToan || 'Chưa thanh toán'}</p>
                        <p><strong>Trạng thái:</strong> ${invoiceData.trangThai || 'Chưa thanh toán'}</p>
                        <button id="confirmPaymentBtn">Xác nhận thanh toán</button>
                        <button id="cancelPaymentBtn">Hủy</button>
                    `;

                    // Hiển thị hóa đơn
                    modal.show();
                    modal.hide();
                    // Hiển thị QR Code nếu cần
                    if (phuongThucThanhToan === "Chuyển khoản" && invoiceData.paymentLink) {
                        qrCodeContainer.innerHTML = '';
                        new QRCode(qrCodeContainer, {
                            text: invoiceData.paymentLink,
                            width: 128,
                            height: 128,
                            colorDark: "#000000",
                            colorLight: "#ffffff",
                            correctLevel: QRCode.CorrectLevel.H
                        });
                    }

                    document.getElementById('cancelPaymentBtn').addEventListener('click', function () {
                        // Reload lại trang khi bấm nút Hủy
                        location.reload();
                    });
                    // Xử lý nút xác nhận thanh toán
                    document.getElementById('confirmPaymentBtn').addEventListener('click', function () {
                        fetch('utils/update_invoice_status.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                maHoaDon: invoiceData.maHoaDon,
                                ngayThanhToan: new Date().toISOString().split('T')[0],
                                trangThai: 'Đã thanh toán',
                                idDangKy: invoiceData.idDangKy,
                            }),
                        })
                            .then(res => res.json())
                            .then(result => {
                                if (result.success) {
                                    alert('Hóa đơn đã được xác nhận!');
                                    // Update trạng thái gói tập
                                    fetch('utils/update_goidangky_status.php', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json' },
                                        body: JSON.stringify({
                                            idDangKy: invoiceData.idDangKy,
                                            trangThai: 'Đang hoạt động',
                                        }),
                                    })
                                        .then(res => res.json())
                                        .then(res => {
                                            if (res.success) {
                                                alert('Gói tập đã kích hoạt!');
                                                location.reload();
                                            } else alert('Lỗi cập nhật gói tập!');
                                        });
                                } else alert('Lỗi xác nhận hóa đơn!');
                            });
                    });
                } else {
                    alert('Có lỗi: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });

    

    // Checkout button logic
    const checkoutButton = document.getElementById('checkoutButton');
    if (checkoutButton) {
        checkoutButton.addEventListener('click', function () {
            console.log("Checkout button clicked!");
            const userID = <?= json_encode($userID) ?>; // Chuyển userID từ PHP sang JavaScript

            if (userID) {
                // Gửi yêu cầu check-out
                fetch('models/checkin.php', {
                    method: 'POST',
                    body: JSON.stringify({ action: 'checkout', userID: userID }),
                    headers: { 'Content-Type': 'application/json' }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Check-out thành công!');
                            window.location.reload(); // Tải lại trang để cập nhật giao diện
                        } else {
                            alert(data.message || 'Có lỗi xảy ra khi check-out!');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Không thể kết nối đến máy chủ.');
                    });
            } else {
                alert('UserID không tồn tại.');
            }
        });
    }

    // Checkin button logic
    const checkinButton = document.getElementById('checkinButton');
    if (checkinButton) {
        checkinButton.addEventListener('click', function () {
            const userID = <?= json_encode($userID) ?>; // Chuyển userID từ PHP sang JavaScript

            if (userID) {
                // Gửi yêu cầu check-in
                fetch('models/checkin.php', {
                    method: 'POST',
                    body: JSON.stringify({ action: 'checkin', userID: userID }),
                    headers: { 'Content-Type': 'application/json' }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Check-in thành công!');
                            window.location.reload(); // Tải lại trang để cập nhật giao diện
                        } else {
                            alert(data.message || 'Có lỗi xảy ra khi check-in!');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Không thể kết nối đến máy chủ.');
                    });
            } else {
                alert('UserID không tồn tại.');
            }
        });
    }
</script>

</html>
