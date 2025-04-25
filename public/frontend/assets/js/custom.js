
(function ($) {
  "use strict";

  $(document).ready(function () {
   

    /*-----------------------------------
    07.slider 
    -----------------------------------*/

    // Intro slider 
    if ($('.intro-slider-active').length > 0) {
      const teamSlider = new Swiper(".intro-slider-active", {
        spaceBetween: 30,
        speed: 1300,
        loop: true,
        autoplay: false,
        navigation: {
          prevEl: ".slider-prev",
          nextEl: ".slider-next",
        },

        effect: "fade",
        fadeEffect: {
          crossFade: true,
        },

        breakpoints: {
          1199: {
            slidesPerView: 1,
          },
          991: {
            slidesPerView: 1,
          },
          767: {
            slidesPerView: 1,
          },
          575: {
            slidesPerView: 1,
          },
          0: {
            slidesPerView: 1,
          },
        },
      });
    }

    


  });

})(jQuery);

 jQuery(document).ready(function ($) {
    $('.counter-number').counterUp({
        delay: 10,
        time: 1000
    });
});


$('.whyus').owlCarousel({
     loop: false,
     items: 2,
     margin: 20,
     mouseDrag: true,
     autoplay: false,
     autoplayTimeout: 5000,
     dots: true,
     autoplayHoverPause: false,
     nav: false,
     navText: ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"],
     responsiveClass: true,
     responsive: {
         0: {
             items: 1
         },
         600: {
             items: 2
         },
         1000: {
             items: 3
         }
     }
});

$(".popup-video").magnificPopup({
        type: "iframe",
    });


AOS.init({
  once: true
})


$(document).ready(function() {
    var owl = $('.video-banner');
    owl.owlCarousel({
        margin: 30,
        nav: false,
        loop: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 4500,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 1
            },
            1400: {
                items: 1
            }
        }
    })
})