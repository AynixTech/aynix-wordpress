jQuery(document).ready(function ($) {
    var swiper = new Swiper(".portfolio-gallery.swiper", {
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        slidesPerView: 2,
        spaceBetween: 10,
        breakpoints: {
            1024: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2,
            },
            480: {
                slidesPerView: 1,
            },
            0: {
                slidesPerView: 1,
            }
        }
    });
});
