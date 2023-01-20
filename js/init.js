jQuery(document).ready(function ($) {
    "use strict";
    // Params
    let mainSliderSelector = '.main-slider',
        navSliderSelector = '.nav-slider',
        interleaveOffset = 0.5;

    // Main Slider
    let mainSliderOptions = {
        loop: true,
        slidesPerView: 1,
        speed: 1000,
        autoplay: {
            delay: 3000
        },
        loopAdditionalSlides: 10,
        grabCursor: true,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        on: {
            init: function () {
                this.autoplay.stop();
            },
            imagesReady: function () {
                this.el.classList.remove('loading');
                this.autoplay.start();
            },
            slideChangeTransitionEnd: function () {
                let swiper = this,
                    captions = swiper.el.querySelectorAll('.caption');
                for (let i = 0; i < captions.length; ++i) {
                    captions[i].classList.remove('show');
                }
                swiper.slides[swiper.activeIndex].querySelector('.caption').classList.add('show');
            },
            progress: function () {
                let swiper = this;
                for (let i = 0; i < swiper.slides.length; i++) {
                    let slideProgress = swiper.slides[i].progress,
                        innerOffset = swiper.width * interleaveOffset,
                        innerTranslate = slideProgress * innerOffset;

                    swiper.slides[i].querySelector(".slide-bgimg").style.transform =
                        "translateX(" + innerTranslate + "px)";
                }
            },
            touchStart: function () {
                let swiper = this;
                for (let i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = "";
                }
            },
            setTransition: function (speed) {
                let swiper = this;
                for (let i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = speed + "ms";
                    swiper.slides[i].querySelector(".slide-bgimg").style.transition =
                        speed + "ms";
                }
            }
        }
    };
    let mainSlider = new Swiper(mainSliderSelector, mainSliderOptions);

    // Navigation Slider
    let navSliderOptions = {
        loop: true,
        loopAdditionalSlides: 10,
        speed: 1000,
        spaceBetween: 5,
        slidesPerView: 5,
        centeredSlides: true,
        touchRatio: 0.2,
        slideToClickedSlide: true,
        direction: 'vertical',
        on: {
            imagesReady: function () {
                this.el.classList.remove('loading');
            },
            click: function () {
                mainSlider.autoplay.stop();
            }
        }
    };
    let navSlider = new Swiper(navSliderSelector, navSliderOptions);

    // Matching sliders
    if (mainSlider.controller) {
        mainSlider.controller.control = navSlider;
        navSlider.controller.control = mainSlider;
    }

    var newSwiper = new Swiper(".new-swiper", {
        slidesPerView: 5,
        spaceBetween: 30,
        slidesPerGroup: 1,
        loop: true,
        loopFillGroupWithBlank: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

    });


    // Load more
    function loadMore(event) {
        var loadMoreButton = $(event.target)
        if (loadMoreButton.prop('disabled')) {
            return;
        }
        loadMoreButton.prop('disabled', true);
        $.ajax({
            url: loadMoreButton.data('href'),
            method: 'GET',
            success: function (res) {
                var loadedList = $(res).find('#product-list');
                $('#product-list').append(loadedList[0].innerHTML);
                var a = $('.navigation.pagination .nav-links').find('a').first();
                a.after('<span aria-current="page" class="page-numbers current">' + a.text() + '</span>');
                a.remove();
                if ($(res).find('#load-more-wrapper').length) {
                    $(document).find('#load-more-wrapper').html(
                        $(res).find('#load-more-wrapper')[0].innerHTML
                    );
                } else {
                    $(document).find('#load-more-wrapper').remove();
                    $(document).find('.navigation.pagination').remove();
                }
            },
            complete: function () {
                loadMoreButton.prop('disabled', false);
            }
        });
    }

    $(document).on('click', '#load-more-wrapper button', loadMore);
    $(".mobile-menu").click(function (e) {
        e.preventDefault();
        $('#header').addClass('menu-fixed__open');
        $('.wrapp-no-scroll').addClass('open-mob');
        $(".menu-fixed .first-level").show();
        $('.menu-fixed').addClass('menu_fixed__open');
    });
    $(".close-first-level").click(function (e) {
        e.preventDefault();
        $('#header').removeClass('menu-fixed__open');
        $(".menu-fixed .first-level").hide();
        $(".menu-fixed .first-level").removeClass('first_level_hide');
        $('.menu-fixed').removeClass('menu_fixed__open');
        $('.wrapp-no-scroll').removeClass('open-mob');
    });
    $(".is-parent-li.open > a").click(function () {
        $(this).parent().removeClass("open");
        $(".menu-fixed .fixed-menu-list > li").removeClass("hide");
        return false;
    });
    $(".is-parent-li > a").click(function () {
        $(this).parent().addClass("open");
        // $(".menu-fixed .fixed-menu-list > li").addClass("hide");
        return false;
    });
    $(".is-parent").click(function () {
        $(".is-parent-li").removeClass("open");
        $(".menu-fixed .fixed-menu-list > li").removeClass("hide");
        return false;
    });


    $(document).on("mouseover", ".is-parent", function () {
        $(this).parent().addClass("hover_link");
    });
    $(document).on("mouseout", ".is-parent", function () {
        $(this).parent().removeClass("hover_link");
    });
    var $menu = $("#left-sidebar #costume_tax");
    $(window).scroll(function () {
        // if ($(this).scrollTop() > 465 && !$menu.hasClass("fixed")) {
        //     $menu.addClass("fixed");
        //
        // } else if ($(this).scrollTop() <= 465 && $menu.hasClass("fixed")) {
        //     $menu.removeClass("fixed");
        // }


        // var top = ($(this).scrollTop() > 465) ? $(this).scrollTop() - 465 : 0;
        // $menu.css({
        //     top: top
        // })
    });



    $("#mobile_catalog_menu").click(function (e) {
        e.preventDefault();
        console.log("sadasd")
        $('#header').addClass('menu-fixed__open_2');
        $('.wrapp-no-scroll').addClass('open-mob_2');
        $(".menu-fixed_2 .first-level_2").show();
        $('.menu-fixed_2').addClass('menu_fixed__open_2');
    });
    $(".close-first-level_2").click(function (e) {
        e.preventDefault();
        $('#header').removeClass('menu-fixed__open_2');
        $(".menu-fixed_2 .first-level_2").hide();
        $(".menu-fixed_2 .first-level_2").removeClass('first_level_hide_2');
        $('.menu-fixed_2').removeClass('menu_fixed__open_2');
        $('.wrapp-no-scroll_2').removeClass('open-mob_2');
    });
    $(".is-parent-li_2.open > a").click(function () {
        $(this).parent().removeClass("open_2");
        $(".menu-fixed_2 .fixed-menu-list_2 > li").removeClass("hide_2");
        return false;
    });
    $(".is-parent-li_2 > a").click(function () {
        $(this).parent().addClass("open_2");
        // $(".menu-fixed .fixed-menu-list > li").addClass("hide");
        return false;
    });
    $(".is-parent_2").click(function () {
        $(".is-parent-li_2").removeClass("open_2");
        $(".menu-fixed_2 .fixed-menu-list_2 > li").removeClass("hide_2");
        return false;
    });


    $(document).on("mouseover", ".is-parent_2", function () {
        $(this).parent().addClass("hover_link_2");
    });
    $(document).on("mouseout", ".is-parent_2", function () {
        $(this).parent().removeClass("hover_link_2");
    });
    var $menu = $("#left-sidebar #costume_tax");
    $(window).scroll(function () {
        // if ($(this).scrollTop() > 465 && !$menu.hasClass("fixed")) {
        //     $menu.addClass("fixed");
        //
        // } else if ($(this).scrollTop() <= 465 && $menu.hasClass("fixed")) {
        //     $menu.removeClass("fixed");
        // }


        // var top = ($(this).scrollTop() > 465) ? $(this).scrollTop() - 465 : 0;
        // $menu.css({
        //     top: top
        // })
    });





    if($('#product').length) {
        $('#product').val(
            $('h1 span').text()
        );
    }
});

