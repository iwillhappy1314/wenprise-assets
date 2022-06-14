import Swiper from 'swiper/js/swiper.esm.browser.bundle';

import 'swiper/swiper.scss';

jQuery(document).ready(function($) {
  /*---------------------
   Main Slider
   -----------------------*/

  /*---------------------
  Main Slider Fade Effect
  -----------------------*/
  if ($('.swiper-main-slider-fade').length !== 0) {
    var swiper = new Swiper('.swiper-container', {
      effect             : 'fade',
      navigation         : {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination         : {
        el            : '.swiper-pagination',
        dynamicBullets: true,
      },
      paginationClickable: true,
      nextButton         : '.swiper-button-next',
      prevButton         : '.swiper-button-prev',
      spaceBetween       : 0,
      loop               : true,
      simulateTouch      : true,
      autoplay           : 5000,
      speed              : 1000,
      on                 : {
        slideChange: function(swiper) {
          console.log(swiper);
          const el = this;
          $('.swiper-slide').each(function() {
            if ($(this).index() === el.realIndex) {
              $(this).find('.slider-content').fadeIn(300);
            } else {
              $(this).find('.slider-content').fadeOut(300);
            }
          });
        },
      },
    });
  }

});