<?php 
require_once __DIR__ . '/../controllers/AuthController.php';
$authController = new AuthController(); // Tạo đối tượng từ lớp AuthController

$userId = $authController->checkLoginStatus(); // Gọi phương thức checkLoginStatus
if ($userId)
    // Lấy thông tin user từ AuthController
$user = $authController->getUser($userId);
require_once __DIR__ . '../../controllers/GoiTapController.php';
$goiTapController = new GoiTapController();
$data = $goiTapController->getAllGoiTap(null);
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
<?php
    require_once __DIR__ . '/../includes/head.php';
?>
</head>

<body>
    
    <!-- Header Section Begin -->
    <?php
    require_once __DIR__ . '/../includes/header.php';
    ?>
    <!-- Header Section End -->
    <!-- This is for About Section Begin -->
    <section id="home-about" class="home-about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                    <h2>CHÚNG TÔI LÀ THIEN TAI<br> GYM CENTER</h2>
                        <p class="short-details"> Là thương hiệu về sức khỏe lớn nhất Đại học Công Nghiệp TpHCM, được
                            xây dựng để mang lại hạnh phúc và tạo ra những khoảnh khắc viên mãn
                            cho bạn trong cuộc sống bằng việc cung cấp các dịch vụ phát triển sức khỏe thể chất, và tinh thần toàn diện.</p>
                        <a href="#" class="primary-btn about-btn">Tìm hiểu thêm</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="../asset/img/home-about.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Aboutus main Section End -->
    <!-- Aboutus sub Section Begin -->
    <section id="home-about" class="home-about spad">
        <div class="container">
            <div class="aboutus-page-text">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 m-auto">
                        <div class="section-title">
                            <h2>Mọi thứ bạn cần đều ở đây</h2>
                            <p>Chúng tôi tự hào mang đến một hệ thống gym hiện đại, nơi bạn không
                                chỉ rèn luyện sức khỏe mà còn tìm thấy động lực và cảm hứng mỗi ngày</p>
                        </div>
                    </div>
                </div>
                <img src="../asset/img/about-us.jpg" alt="">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-us">
                            <h4>ĐÔI LÉT</h4>
                            <p>Chúng tôi là một đội ngũ tận tâm, luôn hướng đến việc mang lại giá trị thực sự cho cộng đồng.
                                Với sứ mệnh không ngừng cải tiến và đổi mới, chúng tôi cung cấp những dịch vụ và sản phẩm chất lượng cao,
                                được thiết kế để đáp ứng nhu cầu và kỳ vọng của khách hàng.</p>
                            <p>Từ sự chuyên nghiệp trong công việc đến mối quan hệ chân thành với khách hàng, chúng tôi cam kết đem lại những
                                trải nghiệm tuyệt vời và góp phần xây dựng một tương lai tươi sáng hơn.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-quality">
                            <h4>CHẤT LƯỢNG</h4>
                            <p>Hãy đến và trải nghiệm sự khác biệt, nơi chất lượng là ưu tiên hàng đầu của chúng tôi!</p>
                            <ul>
                                <li><i class="fa fa-check-circle-o"></i>Chúng tôi tự hào mang đến cho bạn một gói tập toàn diện, kết hợp phòng tập hiện đại với trang thiết bị tối tân,
                                    tạo không gian lý tưởng để bạn đạt được mục tiêu sức khỏe.</li>
                                <li><i class="fa fa-check-circle-o"></i>Đội ngũ huấn luyện viên chuyên nghiệp và giàu kinh nghiệm sẽ đồng hành cùng bạn,
                                    đảm bảo mỗi buổi tập không chỉ hiệu quả mà còn đầy cảm hứng.</li>
                                <li><i class="fa fa-check-circle-o"></i>Chúng tôi cam kết cung cấp dịch vụ với giá cả hợp lý, luôn mang lại giá trị vượt trội cho mỗi khách hàng.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Aboutus Section End -->

    <!-- Trainer Section Begin -->
    <section class="trainer-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>HUẤN LUYỆN VIÊN CHUYÊN NGHIỆP</h2>
                        <p>Với kinh nghiệm dày dặn trong việc thức khuya dậy muộn, tụi em mong điểm cao</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="trainer-item">
                        <div class="ti-pic">
                            <img src="../asset/img/trainer/trainer-1.jpg" alt="">
                            <div class="ti-links">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                            <div class="trainer-text">
                                <h5>Becky Taylor <span>- Gymer</span></h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="trainer-item">
                        <div class="ti-pic">
                            <img src="../asset/img/trainer/trainer-2.jpg" alt="">
                            <div class="ti-links">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                            <div class="trainer-text">
                                <h5>Noah Leonard <span>- Trainer</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="trainer-item">
                        <div class="ti-pic">
                            <img src="../asset/img/trainer/trainer-3.jpg" alt="">
                            <div class="ti-links">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                            <div class="trainer-text">
                                <h5>Evelyn Fields <span>- Gymer</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="trainer-item">
                        <div class="ti-pic">
                            <img src="../asset/img/trainer/trainer-4.jpg" alt="">
                            <div class="ti-links">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                            <div class="trainer-text">
                                <h5>Leroy Guzman <span>- Manager</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Trainer Section End -->

    <!-- Testimonial Section start -->

    <!-- <section class="testimonial-section set-bg spad" data-setbg="../asset/img/testimonial1-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="testimonial-slider owl-carousel">
                        <div class="ts-item">
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h4>The “Minimal-Repair Technique” is a revolutionary surgical procedure in the treatment
                                for hernia. Initially intended for correcting inguinal hernia.</h4>
                            <div class="author-name">
                                <h5>Stacy Mc Neeley</h5>
                                <span>CEP’s Director</span>
                            </div>
                            <div class="author-pic">
                                <img src="../asset/img/author-pic.png" alt="">
                            </div>
                        </div>
                        <div class="ts-item">
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h4>The “Minimal-Repair Technique” is a revolutionary surgical procedure in the treatment
                                for hernia. Initially intended for correcting inguinal hernia.</h4>
                            <div class="author-name">
                                <h5>Stacy Mc Neelek</h5>
                                <span>CEP’s Director</span>
                            </div>
                            <div class="author-pic">
                                <img src="../asset/img/author-pic.png" alt="">
                            </div>
                        </div>
                        <div class="ts-item">
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h4>The “Minimal-Repair Technique” is a revolutionary surgical procedure in the treatment
                                for hernia. Initially intended for correcting inguinal hernia.</h4>
                            <div class="author-name">
                                <h5>Stacy Mc Neelel</h5>
                                <span>CEP’s Director</span>
                            </div>
                            <div class="author-pic">
                                <img src="../asset/img/author-pic.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!--Testimonial Section end -->

    <!-- Price Plan Section Begin -->
    <section id="price" class="price-section spad set-bg" data-setbg="../asset/img/price1-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>CÁC GÓI TẬP THỊNH HÀNH</h2>
                        <p>Mua gói tập từ 1 năm trở lên sẽ nhận được nhiều ưu đãi hấp dẫn</p>
                    </div>
                    <div class="toggle-option">
                        <ul>
                            <li>Gói Tháng</li>
                            <li>
                                <label class="switch">
                                    <input type="checkbox" id="billingToggle" checked>
                                    <span class="slider"></span>
                                </label>
                            </li>
                            <li>Gói Năm</li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="row">

                <div class="price-carousel owl-carousel owl-theme "> 
                </div>

            </div>
        </div>
    </section>
    <!-- Price Plan Section END -->


    <!-- Cta Section Begin -->
    <section id='contact' class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-text">
                        <h3>Hãy tham gia tập luyện ngay hôm nay</h3>
                        <p>Có rất nhiều ưu đãi hấp dẫn đang chờ bạn đó!</p>
                    </div>
                    <a href="login-signup.php" class="primary-btn cta-btn">Đăng ký ngay!!</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Cta Section End -->

    <!-- Map Section Begin -->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.
                858237982643!2d106.68427047480563!3d10.822158889329419!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1
                !3m3!1m2!1s0x3174deb3ef536f31%3A0x8b7bb8b7c956157b!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ
                2hp4buHcCBUUC5IQ00!5e0!3m2!1svi!2s!4v1733595051538!5m2!1svi!2s" height="590" 
            style="border: 0" allowfullscreen=""></iframe>
        <div class="map-contact-detalis">
            <div class="open-time">
                <h5>Lịch làm việc:</h5>
                <ul>
                    <li>Hàng ngày: <span>06:30 - 11:00</span></li>
                    <li>Thứ bảy: <span>07:00 - 22:00</span></li>
                    <li>Chủ Nhật: <span>09:00 - 18:00</span></li>
                </ul>
            </div>
            <div class="map-contact-form">
                <h5>Nếu có thắc mắc hãy liên hệ với chúng tôi</h5>
                <form action="#">
                    <input type="text" placeholder="Name">
                    <input type="text" class="phone" placeholder="Phone">
                    <textarea placeholder="Message"></textarea>
                    <button type="submit" class="site-btn">Gửi Ngay</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Map Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-logo-item">
                        <div class="f-logo">
                            <a href="#"><img src="../asset/img/logo.png" alt=""></a>
                        </div>
                        <p>Despite growth of the Internet over the past seven years, the use of toll-free phone numbers
                            in television advertising continues.</p>
                        <div class="social-links">
                            <h6>Follow us</h6>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Our Blog</h5>
                        <div class="footer-blog">
                            <a href="#" class="fb-item">
                                <h6>Most people who work</h6>
                                <span class="blog-time"><i class="fa fa-clock-o"></i> Jan 02, 2019</span>
                            </a>
                            <a href="#" class="fb-item">
                                <h6>Freelance Design Tricks How </h6>
                                <span class="blog-time"><i class="fa fa-clock-o"></i> Jan 02, 2019</span>
                            </a>
                            <a href="#" class="fb-item">
                                <h6>have a computer at home have had </h6>
                                <span class="blog-time"><i class="fa fa-clock-o"></i> Jan 02, 2019</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>Program</h5>
                        <ul class="workout-program">
                            <li><a href="#">Bodybuilding</a></li>
                            <li><a href="#">Running</a></li>
                            <li><a href="#">Streching</a></li>
                            <li><a href="#">Weight Loss</a></li>
                            <li><a href="#">Gym Fitness</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <h5>Get Info</h5>
                        <ul class="footer-info">
                            <li>
                                <i class="fa fa-phone"></i>
                                <span>Phone:</span>
                                (12) 345 6789
                            </li>
                            <li>
                                <i class="fa fa-envelope-o"></i>
                                <span>Email:</span>
                                Colorlib.info@gmail.com
                            </li>
                            <li>
                                <i class="fa fa-map-marker"></i>
                                <span>Address</span>
                                Iris Watson, Box 283 8562, NY
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Footer Section End -->

    <!-- Js Plugiasset/ns -->
<?php
    require_once __DIR__ . '/../includes/idexjs.php';
?>

</body>

</html>