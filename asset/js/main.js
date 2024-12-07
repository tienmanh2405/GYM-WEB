/*  ---------------------------------------------------
  Template Name: Activitar
  Description:  Activitar Fitness HTML Template
  Author: Colorlib
  Author URI: https://colorlib.com
  Version: 1.0
  Created: Colorlib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.gallery-controls ul li').on('click', function() {
            $('.gallery-controls ul li').removeClass('active');
            $(this).addClass('active');
        });
        if($('.gallery-filter').length > 0 ) {
            var containerEl = document.querySelector('.gallery-filter');
            var mixer = mixitup(containerEl);
        }

        $('.blog-gird').masonry({
			itemSelector: '.grid-item',
			columnWidth: '.grid-sizer',
		});

    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
		Menu Hover
	--------------------*/
    $(".header-section .nav-menu .mainmenu ul li").on('mousehover', function() {
        $(this).addClass('active');
    });
    $(".header-section .nav-menu .mainmenu ul li").on('mouseleave', function() {
        $('.header-section .nav-menu .mainmenu ul li').removeClass('active');
    });

    /*------------------
        Carousel Slider
    --------------------*/
    $(".hero-items").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        dots: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navText: ['<i class="arrow_carrot-left"></i>', '<i class="arrow_carrot-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
    });

    /*------------------
        Testimonial Slider
    --------------------*/
   $(".testimonial-slider").owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        items: 1,
        dots: true,
        navText: ['<i class="arrow_carrot-left"></i>', '<i class="arrow_carrot-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    /*------------------
        Magnific Popup
    --------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    $('.image-popup').magnificPopup({
        type: 'image'
    });

    /*------------------
        Magnific Popup
    --------------------*/
    $('.show-result-select').niceSelect();

    /*------------------
       Timetable Filter
    --------------------*/
    $('.timetable-controls ul li').on('click', function() {
        var tsfilter = $(this).data('tsfilter');
        $('.timetable-controls ul li').removeClass('active');
        $(this).addClass('active');
        
        if(tsfilter == 'all') {
            $('.classtime-table').removeClass('filtering');
            $('.ts-item').removeClass('show');
        } else {
            $('.classtime-table').addClass('filtering');
        }
        $('.ts-item').each(function(){
            $(this).removeClass('show');
            if($(this).data('tsmeta') == tsfilter) {
                $(this).addClass('show');
            }
        });
    });

//  code mới
      $(".price-carousel").owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            1024: { items: 3 },
        },
    });

      // Load the default plan (monthly)
      loadPlans('Mỗi Tháng');

      // Toggle event for billing cycle (monthly/yearly)
      $("#billingToggle").on("change", function () {
          const billingCycle = $(this).is(":checked") ? "Mỗi Tháng" : "Mỗi Năm";
          loadPlans(billingCycle);
      });

      function loadPlans(billingCycle) {
          $.ajax({
              url: "handle-toggle.php",
              type: "POST",
              data: { billingCycle: billingCycle },
              success: function (response) {
                  try {
                      const data = response;
                      console.log("Data received:", data);

                      let carouselContent = "";
                      data.forEach((item) => {
                          carouselContent += `
                              <div class="item">
                                  <div class="single-price-plan">
                                      <img src="../asset/img/gallery/${item["anh"]}"
                                      <br>
                                      <h4>${item["tenGoiTap"]}</h4>
                                      <div class="price-plan">
                                          <h2>${item["gia"]} <span>đ</span></h2>
                                          <p>${billingCycle === 'Mỗi Tháng' ? "MỖI THÁNG" : "MỖI NĂM"}</p>
                                      </div>
                                      <ul>
                                          <li>${item["moTa"]}</li>
                                      </ul>
                                      <a href="./payment.php?id=${item["maGoiTap"]}" class="primary-btn price-btn">Mua Gói</a>
                                  </div>
                              </div>
                          `;
                      });

                      // Update the content
                      const $carousel = $(".owl-carousel");
                      $carousel.trigger("destroy.owl.carousel"); // Destroy existing instance
                      $carousel.html(carouselContent); // Replace content
                      $carousel.owlCarousel({
                          loop: true,
                          margin: 30,
                          nav: true,
                          dots: true,
                          autoplay: true,
                          autoplayTimeout: 3000,
                          autoplayHoverPause: true,
                          responsive: {
                              0: { items: 1 },
                              768: { items: 2 },
                              1024: { items: 3 },
                          },
                      });
                  } catch (error) {
                      console.error("Error parsing response:", error);
                  }
              },
              error: function (xhr, status, error) {
                  console.error("Error:", error);
              }
          });
      }
  
})(jQuery);

