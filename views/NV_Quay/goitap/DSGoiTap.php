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
  <div class="container mx-auto mt-4">
    <div class="row g-4">
      <?php foreach ($goitap_list as $goitap): ?>
        <div class="col-sm-12 col-md-6 col-xl-4">
  <div class="h-100 bg-secondary rounded p-4">
    <div class="card d-flex align-items-center justify-content-between text-center" 
          data-bs-toggle="modal" 
          data-bs-target="#goiTapModal"
          data-magoitap="<?= htmlspecialchars($goitap['maGoiTap']) ?>"
          data-tengoitap="<?= htmlspecialchars($goitap['tenGoiTap']) ?>"
          data-thoihan="<?= htmlspecialchars($goitap['thoiHan']) ?>"
          data-gia="<?= htmlspecialchars($goitap['gia']) ?>"
          data-mota="<?= htmlspecialchars($goitap['moTa']) ?>"
          data-anhgoitap="<?= htmlspecialchars('asset/image/' . ($goitap['anhGoiTap']) ?? 'https://i.imgur.com/ZTkt4I5.jpg') ?>">
      <img src="<?= htmlspecialchars('asset/image/' . ($goitap['anhGoiTap']) ?? 'https://i.imgur.com/ZTkt4I5.jpg') ?>" class="card-img-top custom-img" style="" alt="...">
      <div class="card-body ">
        <p class="card-title" style=""><?= htmlspecialchars($goitap['tenGoiTap'] ?? 'Tên Gói Tập Mặc Định') ?></p>
        <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars(number_format($goitap['gia'] ?? 0, 0, '.', '')) ?> VNĐ</h6>
        <!-- <p class="card-text flex-grow-1"><?= htmlspecialchars($goitap['moTa'] ?? 'Mô tả không có sẵn') ?></p> -->
      </div>
    </div>
  </div>
</div>

      <?php endforeach; ?>
    </div>
  </div>


   <!-- Phân trang -->
<div id="pagination" class="d-flex justify-content-center align-items-center mt-4 mb-4">
    <!-- Trang trước -->
    <a href="?page=<?= max(1, $currentPage - 1) ?>" class="btn btn-secondary <?= ($currentPage == 1) ? 'disabled' : ''; ?>">Trang Trước</a>
    
    <!-- Hiển thị số trang -->
    <span class="mx-3">Trang <?= $currentPage ?> / <?= $totalPages ?></span>
    
    <!-- Trang tiếp -->
    <a href="?page=<?= min($totalPages, $currentPage + 1) ?>" class="btn btn-secondary <?= ($currentPage == $totalPages) ? 'disabled' : ''; ?>">Trang Tiếp</a>
</div>
<!-- Modal chi tiết gói tập -->
<div class="modal fade" id="goiTapModal" tabindex="-1" aria-labelledby="goiTapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="goiTapModalLabel">Chi Tiết Gói Tập</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img id="modalAnhGoiTap" src="" alt="Ảnh Gói Tập" class="img-fluid mb-3">
        <p><strong>Mã Gói Tập:</strong> <span id="modalMaGoiTap"></span></p>
        <p><strong>Tên Gói Tập:</strong> <span id="modalTenGoiTap"></span></p>
        <p><strong>Thời Hạn:</strong> <span id="modalThoiHan"></span> tháng</p>
        <p><strong>Giá:</strong> <span id="modalGia"></span></p>
        <p><strong>Mô Tả:</strong> <span id="modalMoTa"></span></p>
      </div>
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
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('goiTapModal');

    modal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget; // Button kích hoạt modal
      const maGoiTap = button.getAttribute('data-magoitap');
      const tenGoiTap = button.getAttribute('data-tengoitap');
      const thoiHan = button.getAttribute('data-thoihan');
      const gia = button.getAttribute('data-gia');
      const moTa = button.getAttribute('data-mota');
      const anhGoiTap = button.getAttribute('data-anhgoitap');

      // Hiển thị dữ liệu trong modal
      modal.querySelector('#modalMaGoiTap').textContent = maGoiTap;
      modal.querySelector('#modalTenGoiTap').textContent = tenGoiTap;
      modal.querySelector('#modalThoiHan').textContent = thoiHan;
      modal.querySelector('#modalGia').textContent = gia;
      modal.querySelector('#modalMoTa').textContent = moTa;
      modal.querySelector('#modalAnhGoiTap').src = anhGoiTap;
    });
  });
</script>


</html>
