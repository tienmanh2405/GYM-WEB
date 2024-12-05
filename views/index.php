<?php
require_once __DIR__ . '/../controllers/AuthController.php';
$authController = new AuthController(); // Tạo đối tượng từ lớp AuthController

$userId = $authController->checkLoginStatus(); // Gọi phương thức checkLoginStatus
if ($userId) {
    // Lấy thông tin user từ AuthController
    $user = $authController->getUser($userId);
} 
//else {
//     echo "<script>alert('Hãy đăng nhập');</script>";
//     header('Location: ./login-signup.php');
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="zxx">
    <?php
    require_once __DIR__ . '/../includes/head.php';
    ?>
<body>
    <!-- Header Section Begin -->
    <?php
    require_once  __DIR__ .'/../includes/header.php';
    ?>
    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-item " style="background-image:url('../asset/img/hero-slider/hero-7.jpg')" >
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hero-text">
                                <h2>Tập Luyện Ngay Thôi Nào</h2>
                                <h1>NO FIT, NO MEAT</h1>
                                <a href="#" class="primary-btn">Mua Gói Ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-item" style="background-image:url('../asset/img/hero-slider/hero-5.jpg')" >
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hero-text">
                                <h2>Tập Luyện Ngay Thôi Nào</h2>
                                <h1>NO FIT, NO MEAT</h1>
                                <a href="#" class="primary-btn">Mua Gói Ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-item" style="background-image:url('../asset/img/hero-slider/hero-4.jpg')" >
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hero-text">
                                <h2>Tập Luyện Ngay Thôi Nào</h2>
                                <h1>NO FIT, NO MEAT</h1>
                                <a href="#" class="primary-btn">Mua Gói Ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero End -->
      <!-- This is for About Section Begin -->
      <section id="home-about" class="home-about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <h2>CHÚNG TÔI LÀ THIENTAI CENTER GYM</h2>
                        <p class="short-details"> Là thương hiệu về sức khỏe lớn nhất Đại học Công Nghiệp TpHCM, được 
                            xây dựng để mang lại hạnh phúc và tạo ra những khoảnh khắc viên mãn 
                            cho bạn trong cuộc sống bằng việc cung cấp các dịch vụ phát triển sức khỏe thể chất, và tinh thần toàn diện.</p>
                        <a href="#" class="primary-btn about-btn">Learn More</a>
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
 
    <section class="testimonial-section set-bg spad" data-setbg="../asset/img/testimonial1-bg.jpg">
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
    </section>
    <!--Testimonial Section end -->

    <!-- Price Plan Section Begin -->
    <section id="price" class="price-section spad set-bg" data-setbg="../asset/img/price1-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>CHOOSE YOUR PRICING PLAN</h2>
                        <p>These reports started to surface when Congress was having hearings about the<br />
                            painkiller, Vioxx. A Food and Drug Administration staff member.</p>
                    </div>
                    <div class="toggle-option">
                        <ul>
                            <li>Monthly</li>
                            <li>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </li>
                            <li>Years</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-price-plan">
                        <h4>Normal</h4>
                        <div class="price-plan">
                            <h2>55 <span>$</span></h2>
                            <p>Monthly</p>
                        </div>
                        <ul>
                            <li>Unlimited access to the gym</li>
                            <li>1 classes per week</li>
                            <li>FREE drinking package</li>
                            <li>1 Free personal training</li>
                        </ul>
                        <a href="#" class="primary-btn price-btn">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-price-plan">
                        <h4>Professional</h4>
                        <div class="price-plan">
                            <h2>95 <span>$</span></h2>
                            <p>Monthly</p>
                        </div>
                        <ul>
                            <li>Unlimited access to the gym</li>
                            <li>2 classes per week</li>
                            <li>FREE drinking package</li>
                            <li>2 Free personal training</li>
                        </ul>
                        <a href="#" class="primary-btn price-btn">Get Started</a>
                        <div class="tic-text">
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-price-plan">
                        <h4>Advanced</h4>
                        <div class="price-plan">
                            <h2>165 <span>$</span></h2>
                            <p>Monthly</p>
                        </div>
                        <ul>
                            <li>Unlimited access to the gym</li>
                            <li>6 classes per week</li>
                            <li>FREE drinking package</li>
                            <li>5 Free personal training</li>
                        </ul>
                        <a href="#" class="primary-btn price-btn">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cta Section Begin -->
    <section id='contact'class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-text">
                        <h3>GeT Started Today</h3>
                        <p>New student special! $30 unlimited Gym for the first week anh 50% of our member!</p>
                    </div>
                    <a href="#" class="primary-btn cta-btn">book now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Cta Section End -->

    <!-- Map Section Begin -->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d188618.51311104256!2d-71.236572!3d42.381647!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1576756626784!5m2!1sen!2sbd" height="590" style="border: 0" allowfullscreen=""></iframe>
            <div class="map-contact-detalis">
            <div class="open-time">
                <h5>Weekday:</h5>
                <ul>
                    <li>Weekday: <span>06:30 - 11:00</span></li>
                    <li>Saturday: <span>07:00 - 22:00</span></li>
                    <li>Sunday: <span>09:00 - 18:00</span></li>
                </ul>
            </div>
            <div class="map-contact-form">
                <h5>Contact Us</h5>
                <form action="#">
                    <input type="text" placeholder="Name">
                    <input type="text" class="phone" placeholder="Phone">
                    <textarea placeholder="Message"></textarea>
                    <button type="submit" class="site-btn">Submit Now</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Map Section End -->

    <!-- Footer Section Begin -->
    <?php
    require_once  __DIR__ .'/../includes/footer.php';
    ?>
    <!-- Footer Section End -->

    <!-- Js Plugiasset/ns -->
    <?php
    require_once  __DIR__ .'/../includes/idexjs.php';
    ?>
</body>
</html>