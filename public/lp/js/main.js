$(document).ready(function() {

//switcher
    $('.tab-switcher').click(function () {
        $('.tab-switcher').removeClass('active');
        $(this).addClass('active');

        if ($(this).hasClass('first')) {
            $('.plan').removeClass('active');
            $('.plan-first').addClass('active');
            $('.plugin__list .plugin__list-item .col').removeClass('active');
            $('.plugin__list .plugin__list-item .first').addClass('active');
        }
        if ($(this).hasClass('second')) {
            $('.plan').removeClass('active');
            $('.plan-second').addClass('active');
            $('.plugin__list .plugin__list-item .col').removeClass('active');
            $('.plugin__list .plugin__list-item .second').addClass('active');
        }
        if ($(this).hasClass('third')) {
            $('.plan').removeClass('active');
            $('.plan-third').addClass('active');
            $('.plugin__list .plugin__list-item .col').removeClass('active');
            $('.plugin__list .plugin__list-item .third').addClass('active');
        }
    });


    function myFunction() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");

        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Скопировано: " + copyText.value;
    }

    function outFunc() {
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Скопировать email";
    }

    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 30,
        loopFillGroupWithBlank: true,
        autoplay: {
            delay: 5000,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        breakpoints: {
            // when window width is <= 320px
            768: {
                slidesPerView: 2,
                spaceBetween: 15
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 60
            },
            1600: {
                slidesPerView: 4,
                spaceBetween: 80
            }

        }
    });

// Same height for tile
    function ourDevHeight() {
        var maxHeight = 0;
        var height = 0;

        $('.swiper-slide').each(function () {
            height = $(this).height();
            if (maxHeight <= height) {
                maxHeight = height;
            }
        });

        $('.ourdev-wrapper').each(function () {
            $(this).css('min-height', maxHeight);
        });
    }

    ourDevHeight();

    $(window).resize(function () {
        $('.ourdev-wrapper').each(function () {
            $(this).css('min-height', 'unset');
        });
        ourDevHeight();
    });

    function topMenu() {
        if ($(".navbar").offset().top > 80) {
            $(".navbar").addClass("scrolling").removeClass("no-scroll");
            $("a.login").addClass("btn-blue").removeClass("btn-border");
        } else {
            $(".navbar").removeClass("scrolling").addClass("no-scroll");
            $("a.login").addClass("btn-border").removeClass("btn-blue");
        }
    }
    topMenu();
    $(window).scroll(function() {
        topMenu();
    });

    $('.nav-link').on('click', function(){
        $('.navbar-collapse').collapse('hide');
    });

    $('#support-form').submit(function (e) {
        $.post($(this).attr('action'), $(this).serialize(), function (r) {

        }, 'json');

        $(this).fadeOut(function () {
            $('#success-form').fadeIn();
        });

        e.preventDefault();
    });
});

$(document).on('click', 'a[href*="#"]:not([href="#"]):not([href*="/#/"]):not(".not-anchor")', function (event) {
    event.preventDefault();
    $('.nav-link').removeClass('active');
    $(this).addClass('active');
    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
});

var coin = document.getElementById("coin");
window.addEventListener("scroll", function() {
    coin.style.transform = "rotate(+"+window.pageYOffset / 4+"deg)";
});

new WOW({ mobile:false }).init();
